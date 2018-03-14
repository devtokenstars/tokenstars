<?php

namespace App\Http\Controllers;

use App\Models\Accounts\Promo;
use App\Repositories\AccountRepository;
use App\Repositories\PriceRepository;
use Illuminate\Http\Request;

class DataController extends Controller
{
    protected $accountRepository;

    public function __construct(
        AccountRepository $accountRepository
    ) {
        parent::__construct();
        $this->accountRepository = $accountRepository;
    }


    public function amounts(Request $request, $promoId) {
        $promo = Promo::where('id', $promoId)->first();
        return response()->json($this->accountRepository->getCollected($promo));
    }
}
