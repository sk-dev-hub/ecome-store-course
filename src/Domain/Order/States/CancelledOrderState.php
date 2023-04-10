<?php

namespace Domain\Order\States;


use Domain\Order\States\OrderState;


final class CancelledOrderState extends OrderState
{
    protected array $allowedTransitions = [
        
    ];
    
    public function canBeChanged(): bool
    {
        return false;
    }

    public function value(): string
    {
        return 'cancelled';
    }

    public function humanValue(): string
    {
        return 'Отмененный';
    }

}