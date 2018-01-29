<?php

namespace App\Repositories;

use App\Models\Accounts\Account;
use App\Models\Accounts\Transfer;
use App\Models\Bid;
use App\Models\User;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TransferRepository
 * @package namespace App\Repositories;
 */
interface TransferRepository extends RepositoryInterface
{
    public function createTransfer(Account $source, Account $destination, $amount, $reference, User $user=null, $price=null, $description=null);
    public function confirmTransfer(Transfer $transfer);

    /**
     * @param $reference
     * @return Transfer
     */
    public function confirmTransferByReference($reference);
    public function createTokensTransfer(Transfer $transfer, Bid $bid);
    public function reverseTransfer(Transfer $transfer, User $user = null, $description = null);
}
