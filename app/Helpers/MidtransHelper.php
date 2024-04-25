<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransHelper
{
    public static function initPaymentGateway()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_PRODUCTION');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public static function getSnapUrl($params)
    {
        self::initPaymentGateway();
        return Snap::getSnapUrl($params);
    }

    public static function getTransactionStatus($id)
    {
        self::initPaymentGateway();
        $response = Http::withBasicAuth(Config::$serverKey, '')
            ->get(env('MIDTRANS_BASE_URL') . "/$id/status");
        return $response->json();
    }
}
