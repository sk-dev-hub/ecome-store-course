<?php

namespace Domain\Order\Providers;

use Domain\Order\Models\Payment;
use Domain\Order\Payment\Gateways\YooKassa;
use Domain\Order\Payment\PaymentData;
use Domain\Order\Payment\PaymentSystem;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        PaymentSystem::provider(function () {
            return new YooKassa(config('payment.providers.yookassa'));
        }); //добавляем сюда  необходимый класс с платежной системой

        PaymentSystem::onCreating(function (PaymentData $paymentData) {
            
        });

        PaymentSystem::onError(function (string $message, Payment $payment) {
            
        });
    }
}
