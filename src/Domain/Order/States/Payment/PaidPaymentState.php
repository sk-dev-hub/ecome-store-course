<?php

namespace Domain\Order\States;


final class PaidPaymentState extends PaymentState
{
    
    public static string $name = 'paid';

}