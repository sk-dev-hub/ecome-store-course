<?php

namespace Domain\Order\Actions;

use App\Http\Requests\OrderFormRequest;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewUserDTO;
use Domain\Auth\Models\User;
use Domain\Order\DTOs\OrderCustomerDTO;
use Domain\Order\DTOs\OrderDTO;
use Domain\Order\Models\Order;
use Illuminate\Auth\Events\Registered;

final class NewOrderAction 
{
    // нужно переддеать неправильно передавать формреквест!!!
    // это временное решшение препделать!!!
    
    public function __invoke(OrderDTO $order, OrderCustomerDTO $customer, bool $createAccount): Order
    {
        $registerAction = app(RegisterNewUserContract::class);

        if($createAccount) {
            $registerAction(NewUserDTO::make(
                $customer->fullName(),
                $customer->email,
                $order->password
            ));
        }

        return Order::query()->create([
            //'user_id' => auth()->id(),
             'payment_method_id' => $order->payment_method_id,
             'delivery_type_id' => $order->delivery_type_id 
        ]);
        
        // плохое исполнение
        // $customer = $request->get('customer');

        // if($request->boolean('create_account')) {

        //     $registerAction(NewUserDTO::make(
        //         $customer['first_name'] . ' ' . $customer['last_name'],
        //         $customer['email'],
        //         $request->get('password')
        //     ));
        // }
        
        // return Order::query()->create([
        //     'user_id' => auth()->id(),
        //     'payment_method_id' => $request->get('payment_method_id'),
        //     'delivery_type_id' => $request->get('delivery_type_id'), 
        // ]);
    }
}
