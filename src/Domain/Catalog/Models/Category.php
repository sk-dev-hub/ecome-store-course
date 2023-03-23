<?php

namespace Domain\Catalog\Models;

use Domain\Product\Models\Product;
use Database\Factories\BrandFactory;
use Domain\Catalog\Collections\CategoryCollection;
use Domain\Catalog\QueryBuilders\CategoryQueryBuilder;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Support\Traits\Models\HasSlug;
use Support\Traits\Models\HasThumbnail;

/**
 * @method static Category|CategoryQueryBuilder query()
 */

class Category extends Model
{
    use HasFactory;
    use HasSlug;
    use HasThumbnail;

    
    protected $fillable = [
        'title',
        'slug',
        'on_home_page',
        'sorting',
    ];

    protected function thumbnailDir(): string
    {
        return 'products';
    }
    
    public function newCollection(array $models = []): CategoryCollection
    {
        return new CategoryCollection($models);
    }
    
    public function newEloquentBuilder($query): CategoryQueryBuilder
    {
        return new CategoryQueryBuilder($query);
    }
    


    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }



}
