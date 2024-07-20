<?php

namespace App\Trait;

use Moyasar\Moyasar;

trait ApiKeyMoyasar
{
    protected function useApiKey($id) {
        //  check if api key is set in the request
        $apiKey = config('moyasar.publishable_key');

        Moyasar::setApiKey($apiKey);

        $paymentService = new \Moyasar\Providers\PaymentService();

        $payment = $paymentService->fetch($id);

        return $payment;
    }
}
