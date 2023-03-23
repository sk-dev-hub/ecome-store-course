<?php

namespace App\View\ViewModels;

use Domain\Catalog\Models\Category;
use Spatie\ViewModels\ViewModel;
use Domain\Product\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CatalogViewModel extends ViewModel
{
    public function __construct(
        public Category $category
    )
    {
        //
    }

    public function products(): LengthAwarePaginator
    {
        return Product::query()
        ->select(['id', 'title', 'slug', 'price', 'thumbnail', 'json_properties'])   //в поля для сортировки необходимо дбовлять индексы для ускорения
        ->search()
        ->withCategory($this->category)
        ->filtered()
        ->sorted()
        ->paginate(6);
    }

    public function categories(): Collection
    {
        return Category::query()
        ->select(['id', 'title', 'slug'])
        ->has('products')
        ->get();
    }
}
