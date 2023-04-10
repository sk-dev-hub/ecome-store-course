<?php 

namespace Domain\Order\Payment\Gateways;

use Domain\Order\Contracts\PaymentGatewayContract;
use Domain\Order\Exceptions\PaymentProviderException;
use Domain\Order\Payment\PaymentData;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;

final class YooKassa implements PaymentGatewayContract
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

    
    
    
    
    
    
    // это пример из курса


    // protected Client $client;

    // protected PaymentData $paymentData;

    // protected string $errorMessage;

    // public function __construct(array $config)
    // {
    //     $this->client = new Client();

    //     $this->configure($config);
        
    // }

    
    // public function paymentId(): string
    // {
    //     return $this->paymentData->id;
    // }

    // public function configure(array $config): void
    // {
    //     $this->client->setAuth(...$config);
    // }

    // public function data(PaymentData $data): self
    // {
    //     $this->paymentData = $data;

    //     return $this;
    // }

    // public function request(): mixed
    // {
    //     return json_decode(file_get_contents('php://input'), true);
    // }

    // public function response(): JsonResponse
    // {
    //     return response()->json();
    // }
    // // /**
    // //  * @throws PaymentProviderException
    // //  */
    // // public function response(): JsonResponse
    // // {

    // //     try {
            
    // //         $response = $this->client
    // //             ->capturePayment(
    // //                 $this->payload(),
    // //                 $this->paymentObject()->getId(),
    // //                 $this->idempotenceKey()
    // //             );

    // //     } catch (Throwable $th) {
            
    // //         $this->errorMessage = $e->getMessage();

    // //         throw new PaymentProviderException($e->getMessage());

    // //         return response()->json(
    // //             $response
    // //         );

    // //     };

    // // }

    // /**
    //  * @throws PaymentProviderException
    //  */
    // public function url(): string
    // {
        
    //     try {
            
    //         $response = $this->client->createPayment(
    //             $this->payload(),
    //             $this->idempotenceKey
    //         );

    //         return $response
    //                 ->getConfirmation()
    //                 ->getConfirmationUrl();

    //     } catch (Exception $e) {
            
    //         throw new PaymentProviderException($e->getMessage());

    //     }

    // }

    
    // /**
    //  * @throws PaymentProviderException
    //  */
    // public function validate(): bool
    // {
    //     $meta = $this->paymentObject()->getMetadata()->toArray();
        
    //     $this->data(new PaymentData(
    //         $this->paymetObject()->getId(),
    //         $this->paymentObject()->getDescription(),
    //         '',
    //         Price::make(
    //             $this->paymetObject()->getAmount()->getIntegerValue(),
    //             $this->paymetObject()->getAmount()->getCurrency(),
    //         ),
    //         collect($meta)
    //     ));

    //     return $this->paymentObject()->getStatus() === PaymentSatus::WAITING_FOR_CAPTURE;

    // }

    // /**
    //  * @throws PaymentProviderException
    //  */
    // public function paid(): bool
    // {

    //     return $this->paymentObject()->getPaid();

    // }

    // public function errorMessage(): string
    // {

    //     return $this->errorMessage;

    // }

    // public function payload(): string
    // {

    //     return [
    //         'amount' => [
    //             'value' => $this->paymentData->amount->value(),
    //             'currency' => $this->paymentData->amount->currency()
    //         ],
    //         'confirmation' => [

    //         ]
    //         ];

    // }

    // public function paymentObject()
    // {


    // }



    
}