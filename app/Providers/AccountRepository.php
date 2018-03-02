<?php

namespace App\Repositories;

use App\Models\Accounts\Account;
use App\Models\Accounts\Promo;
use App\Models\Item;
use App\Models\User;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface AccountRepository
 * @package namespace App\Repositories;
 */
interface AccountRepository extends RepositoryInterface
{
    public function createCoinSource($currency);
    public function getOrCreate(User $user, $currency, Item $item);
    public function getOrCreateNonWallet(User $user, $currency);

    /**
     * @param Item $item
     * @param $currency
     * @return Account
     */
    public function getOrCreateItemWallet(Item $item, $currency);
    public function getOrCreateUserETHWallet($address);
    public function getCollected(Promo $promo, $extra=0);
    public function isValidETHAddress($address);
}
