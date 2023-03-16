<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Illuminate\Contracts\Database\Eloquent\Builder;

class CatalogController extends Controller
{
    public function __invoke(?Category $category)
    {
        
        $categories = Category::query()
            ->select(['id', 'title', 'slug'])
            ->has('products')
            ->get();

        $products = Product::query()
                ->select(['id', 'title', 'slug', 'price', 'thumbnail'])   //в поля для сортировки необходимо дбовлять индексы для ускорения
                ->when(request('s'), function (Builder $query) {
                    $query->whereFullText(['title', 'text'], request('s'));
                })

                ->when($category->exists, function (Builder $query) use($category){
                    $query->whereRelation(
                        'categories',
                        'categories.id',
                        '=',
                        $category->id
                    );
                })
            ->filtered()
            ->sorted()
            ->paginate(6);

        return view('catalog.index', [
            'products' => $products,
            'categories' => $categories,
            'category' => $category,
        ]);
    }
}
