<?php 

namespace Domain\Order\Payment;

use Illuminate\Support\Collection;
use Support\ValueObjects\Price;

final class PaymentData
{
    public function __construct(
        public string $id,
        public string $descreiption,
        public string $returnUrl,
        public Price $amount,
        public Collection $meta
    )
    {
        
    }


    
}