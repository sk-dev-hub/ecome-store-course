<?php 

namespace Domain\Order\Payment;

use Closure;
use Domain\Order\Contracts\PaymentGatewayContract;
use Domain\Order\Exceptions\PaymentProcessException;
use Domain\Order\Exceptions\PaymentProviderException;
use Domain\Order\Models\Payment;
use Domain\Order\Models\PaymentHistory;
use Domain\Order\States\CancelledPaymentState;
use Domain\Order\States\PaidPaymentState;
use Domain\Order\Traits\PaymentEvents;

final class PaymentSystem
{
    
    use PaymentEvents;

    protected static PaymentGatewayContract $provider;

    public static function provider(PaymentGatewayContract|Closure $providerOrClosure): void
    {
        if(is_callable($providerOrClosure)) {
            $providerOrClosure = call_user_func($providerOrClosure);
        }

        if(!$providerOrClosure instanceof PaymentGatewayContract)
        {
            throw PaymentProviderException::providerRequired();
        }

        self::$provider = $providerOrClosure;
    }

    public static function create(PaymentData $paymentData): PaymentGatewayContract
    {
        if(!self::$provider instanceof PaymentGatewayContract)
        {
            throw PaymentProviderException::providerRequired();
        }

        Payment::query()->create([
            'payment_id' => $paymentData->id,
            /// и т д 
        ]);
        
        if(is_callable(self::$onCreating)) {
            $paymentData = call_user_func(self::$onCreating, $paymentData );
        }
        
        return self::$provider->data($paymentData);
    }

    public static function validate(PaymentData $paymentData): PaymentGatewayContract
    {
        if(!self::$provider instanceof PaymentGatewayContract)
        {
            throw PaymentProviderException::providerRequired();
        }

        PaymentHistory::query()->create([
            'method' => request()->method(),
            'payload' => self::$provider->request(),
            'payment_gateway' => get_class(self::$provider)

        ]);

        if(is_callable(self::$onValidating)) {
            call_user_func(self::$onValidating);
       }
        
        
        if(self::$provider->validate() && self::$provider->paid()) {

            try {
                
                $payment = Payment::query()
                    ->where('payment_id', self::$provider->paymentId())
                    ->firstOr(function () {

                        throw PaymentProcessException::paymentNotFound();

                    });

                if(is_callable(self::$onSuccess)) {
                     call_user_func(self::$onSuccess, $payment );
                }

                $payment->state()->trasitionTo(CancelledPaymentState::class);

            } catch (PaymentProcessException $e) {
                
                $payment->state()->trasitionTo(PaidPaymentState::class);
                
                if(is_callable(self::$onError)) {
                    call_user_func(
                        self::$onError, 
                        self::$provider->errorMessage() ?? $e->getMessage()
                    );
               }

            }

        }
        
        return self::$provider;
    }

    
}