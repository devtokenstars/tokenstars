<?php


namespace App\Services;

use App\Models\Item;
use App\Models\Bid;
use GuzzleHttp\Client as GuzzleHttp;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class EthereumService
{
    /**
     * Http Client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client = null;
    protected $maxTokens;
    protected $weiPerToken;
    protected $tokenAddress;
    protected $aceTokenAddress;
    protected $teamTokenAddress;

    public function __construct()
    {
        $config = config('services.ethereum');
        $this->maxTokens = env('AUCTION_MAX_TOKENS', 50);
        $this->weiPerToken = env('AUCTION_WEI_PER_TOKEN', 2400000000000000);
        $this->tokenAddress = env('AUCTION_TOKEN_ADDRESS', '0x13c3d31ead50ce33990a533ac41c6cac63490e84');
        $this->aceTokenAddress = env('ACE_TOKEN_ADDRESS');
        $this->teamTokenAddress = env('TEAM_TOKEN_ADDRESS');
        // construct client
        $this->client = new GuzzleHttp([
            'base_uri' => "${config['scheme']}://${config['host']}:${config['port']}",
        ]);
    }

    /**
     * Запрос данных
     *
     * @param string|null $contract
     * @param $method
     * @param array $args
     * @param int $value
     * @param string $privateKey
     * @param bool $estimate
     * @return mixed
     */
    public function contract(String $urlPath, string $contractType, $contract, string $method, array $args=[], $value = 0, $extra = [])
    {
        $data = [
            'contract' => $contractType,
            'method' => $method,
            'at' => $contract,
            'args' => $args,
        ];
        if ($value) {
            $data['value'] = $value;
        }
        if ($extra) {
            $data = array_merge($data, $extra);
        }
        if (config('app.debug')) {
            Log::info("contract $method", $data);
        }
        $response = $this->client->post("/$urlPath", [
            'json' => $data,
        ]);
        $result = json_decode($response->getBody(), true);
        if (array_key_exists('error', $result) || !array_key_exists('result', $result)) {
            Log::error("contract $method, error", $result);
            throw new \Exception('Error accessing geth client proxy: ' . json_encode($result));
        }
        if (config('app.debug')) {
            Log::info("contract $method, result", $result);
        }
        return $result['result'];
    }

    public function createAuction(Item $item)
    {
        $response = $this->client->post('/contract', [
            'json' => [
                "contract" => "AuctionFactory",
                "method" => "produceForOwnerCustomToken",
                "at" => env('AUCTION_FACTORY_ADDRESS'),
        /* address _owner, address _wallet, address _token, uint _endSeconds, uint256 _weiPerToken, string _item, bool _allowManagedBids */
                "args" => [
                    $item->owner_address,
                    $item->wallet_address,
                    $this->tokenAddress,
                    $item->date_end->getTimestamp(),
                    $this->weiPerToken,
                    $this->maxTokens,
                    $item->name,
                    $this->weiPerToken,
                    true,
                ],
            ]
        ]);
        $result = json_decode($response->getBody(), true);
        if (array_key_exists('error', $result)) {
            Log::error($result);
            throw new \Exception($result['error']);
        }
        return $result['result'];
    }

    public function makeBidding(Bid $bid, $amount)
    {
        if (!$bid->item->auction_address) {
            Log::error('Empty auction hex address: ' . $bid->user->email . ',  ' . $bid->amount . ', ' . $bid->item->id);
            return null;
        }
        $total = round(bcmul($amount, '1000000000000000000', 18));
        $response = $this->client->post('/contract', [
            'json' => [
                "contract" => "Auction",
                "method" => $bid->user->wallet ? "managedBid2" : "managedBid",
                "at" => $bid->item->auction_address,
                /* uint64 _managedBidder, uint256 _managedBid */
                "args" => $bid->user->wallet ? [
                    $bid->user->id,
                    $total,
                    $bid->user->wallet,
                ] : [$bid->user->id, $total],
            ]
        ]);
        $result = json_decode($response->getBody(), true);
        if (array_key_exists('error', $result) || !array_key_exists('result', $result)) {
            Log::error($result);
            return null;
        }
        return $result['result']['tx'];
    }

    public function getEvents($auction)
    {
        $response = $this->client->get('/events/' . $auction);
        $result = json_decode($response->getBody(), true);
        if (!is_array($result) || array_key_exists('error', $result) || !array_key_exists('result', $result)) {
            Log::error($result);
            return [];
        }
        return $result['result'];
    }

    public function getTransaction($txnId)
    {
        $response = $this->client->post('/getTransaction', [
            'json' => [
                "args" => [$txnId],
            ]
        ]);
        $result = json_decode($response->getBody(), true);
        if (array_key_exists('error', $result) || !array_key_exists('result', $result)) {
            Log::error($result);
            return null;
        }
        return $result['result'];
    }

    /**
     * @param string $wallet
     * @param string $contract
     * @return mixed
     */
    public function getBalance(string $wallet, string $contract)
    {
        return $this->contract('getBalance', 'BasicToken', $contract, 'balanceOf', [$wallet]);
    }

    public function isValidETHAddress($address) {
        $result = null;
        $cmd = 'python -c "from eth_utils.address import is_address; print is_address(\"'. $address . '\")"';
        exec($cmd, $result);
        return count($result) > 0 && $result[0] === 'True';
    }

}
