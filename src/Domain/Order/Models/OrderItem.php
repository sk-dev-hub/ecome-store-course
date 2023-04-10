<?php

namespace Domain\Order\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Support\Casts\PriceCast;
use Support\ValueObjects\Price;

class OrderItem extends Model
{
    use HasFactory;
    use MassPrunable;


    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'quantity',

    ];

    protected $casts = [
        'price' => PriceCast::class
    ];

    public function amount(): Attribute
    {
        return Attribute::make(
            get: fn() => Price::make(
                    $this->price->raw() * $this->quantity
            )
        );
    }





}
