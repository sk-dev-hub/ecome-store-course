<?php

namespace App\Models;

use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Support\Traits\Models\HasSlug;
use Support\Traits\Models\HasThumbnail;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Pipeline\Pipeline;
use Support\Casts\PriceCast;

class Product extends Model
{
    use HasFactory;
    use HasSlug;
    use HasThumbnail;

    
    protected $casts = [
        'price' => PriceCast::class
    ];
    
    protected $fillable = [
        'title',
        'slug',
        'brand_id',
        'price',
        'thumbnail',
        'on_home_page',
        'sorting',
        'text',
    ];



    public function scopeFiltered(Builder $query)
    {
        return app(Pipeline::class)
            ->send($query)
            ->through(filters())
            ->thenReturn();
        
        // альтернативная реализация
        // foreach (filters() as $filter) {
        //     $query = $filter->apply($query);
        // }
    }

    public function scopeSorted(Builder $query)
    {
        $query->when(request('sort'), function (Builder $q) {
            
            $column = request()->str('sort');

            if($column->contains(['price', 'title'])) {
                
                $direction = $column->contains('-') ? 'DESC' : 'ASC';

                $q->orderBy((string) $column->remove('-'), $direction);
            }


        });
    }
    
    protected function thumbnailDir(): string
    {
        return 'products';
    }

    public function scopeHomePage(Builder $query)
    {
        $query->where('on_home_page', true)
            ->orderBy('sorting')
            ->limit(6);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
