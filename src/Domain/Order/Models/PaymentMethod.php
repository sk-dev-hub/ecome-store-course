<?php

namespace Domain\Order\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;
use Support\Casts\PriceCast;

class PaymentMethod extends Model
{
    use HasFactory;
    use MassPrunable;


    protected $fillable = [
        'title',
        'redirect_to_pay'
    ];



}
