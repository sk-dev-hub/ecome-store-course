<?php 

namespace Domain\Order\Processes;

use Domain\Order\Contracts\OrderProcessContract;
use Domain\Order\DTOs\OrderCustomerDTO;
use Domain\Order\Exceptions\OrderProcessException;
use Domain\Order\Models\Order;

final class AssignCustomer implements OrderProcessContract
{
    public function __construct(protected OrderCustomerDTO $customer)
    {
        
    }
    
    public function handle(Order $order, $next)
    {

        $order->orderCustomer()
            ->create($this->customer->toArray());

        return $next($order);
    }
    
}