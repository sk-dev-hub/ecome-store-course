<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Http\Controllers\CatalogController;
use Database\Factories\BrandFactory;
use Database\Factories\CategoryFactory;
use Database\Factories\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Tests\TestCase;

class CatalogControllerTest extends TestCase
{

    use RefreshDatabase;



     /**
     * @test
     * @return void
     */
    public function it_success_response(): void
    {
        // Возможно не правильно
        
        BrandFactory::new()->count(5)
        ->create([
            'on_home_page' => true,
            'sorting' => 999
        ]);
        
        
        CategoryFactory::new()->count(5)
            ->create([
                'on_home_page' => true,
                'sorting' => 999
            ]);

        ProductFactory::new()->count(5)
            ->create([
                'on_home_page' => true,
                'sorting' => 999
            ]);    


             
        $this->get(action([CatalogController::class]))
            ->assertOk()
            ->assertStatus(200)
            ->assertViewIs('catalog.index');
    }



}
