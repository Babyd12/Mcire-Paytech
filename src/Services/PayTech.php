<?php

namespace Mcire\PayTech\Services;

use Illuminate\Support\Facades\Http;

class PayTech
{
    public function requestPayment(array $data)
    {
        $config = config('paytech');
        
        $postfields = array_merge($data, [
            'env' => $config['env'],
            'ipn_url' => $config['ipn_url'],
            'success_url' => $config['success_url'],
            'cancel_url' => $config['cancel_url'],
        ]);

        $response = Http::withHeaders([
            'API_KEY' => $config['api_key'],
            'API_SECRET' => $config['api_secret'],
        ])->post('https://paytech.sn/api/payment/request-payment', $postfields);

        if ($response->status() == 200) {
            return $response->json();
        }

        throw new \Exception("PayTech API Error: " . $response->body());
    }
}
