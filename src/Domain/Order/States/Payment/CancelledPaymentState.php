<?php

namespace Domain\Order\States;


final class CancelledPaymentState extends PaymentState
{
    
    public static string $name = 'failed';

}