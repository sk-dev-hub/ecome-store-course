<?php

namespace App\Http\Controllers;

use App\View\ViewModels\CatalogViewModel;
use Domain\Product\Models\Product;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Illuminate\Contracts\Database\Eloquent\Builder;

class CatalogController extends Controller
{
    public function __invoke(?Category $category)
    {
        
        // $categories = Category::query()
        //     ->select(['id', 'title', 'slug'])
        //     ->has('products')
        //     ->get();

        // $products = Product::query()
        //         ->select(['id', 'title', 'slug', 'price', 'thumbnail', 'json_properties'])   //в поля для сортировки необходимо дбовлять индексы для ускорения
        //         ->search()
        //         ->withCategory($category)
        //         ->filtered()
        //         ->sorted()
        //         ->paginate(6);

        // return view('catalog.index', [
        //     'products' => $products,
        //     'categories' => $categories,
        //     'category' => $category,
        // ]);

        // return view('catalog.index', new CatalogViewModel($category));

         return (new CatalogViewModel($category))
                ->view('catalog.index');
    }
}
