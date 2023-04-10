<?php

namespace App\Http\Controllers;

use Domain\Order\Payment\PaymentData;
use Domain\Order\Payment\PaymentSystem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class PurchaseController extends Controller
{
    public function index(): Redirector|Application|RedirectResponse
    {
        $data = PaymentSystem::create(new PaymentData(
            
        ))
            ->url();
        
        return redirect($data);
    }

    public function callback(): JsonResponse
    {
        $response  = PaymentSystem::validate()->response();
        
        return redirect($response);
    }
}
