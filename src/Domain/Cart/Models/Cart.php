<?php

namespace Domain\Cart\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;
    use MassPrunable;


    protected $fillable = [
        'storage_id',
        'user_id'
    ];

    /**
     * Get the prunable model query.
     */
    public function prunable(): Builder
    {
        return static::where('created_at', '<=', now()->subDay());
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }


}
