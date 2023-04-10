<?php

namespace Domain\Order\States;


final class PendingPaymentState extends PaymentState
{
    
    public static string $name = 'pending';

}