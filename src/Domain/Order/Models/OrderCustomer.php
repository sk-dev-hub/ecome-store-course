<?php

namespace Domain\Order\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderCustomer extends Model
{
    use HasFactory;
    use MassPrunable;


    protected $fillable = [
        'order_id',
        'first_name',
        'last_name',
        'phone',
        'email',
        'city',
        'address'
    ];




}
