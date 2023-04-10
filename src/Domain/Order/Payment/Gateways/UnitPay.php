<?php 

namespace Domain\Order\Payment;

use Domain\Order\Contracts\PaymentGatewayContract;

final class UnitPay implements PaymentGatewayContract
{
    
    public function paymentId(): string
    {

    }

    public function configure(array $config): void
    {

    }

    public function data(PaymentData $data): self
    {

    }

    public function request(): mixed
    {

    }

    public function response(): JsonResponse
    {

    }

    public function url(): string
    {

    }

    public function validate(): bool
    {

    }

    public function paid(): bool
    {

    }

    public function errorMessage(): string
    {
        
    }



    
}