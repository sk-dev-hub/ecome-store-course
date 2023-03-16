<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Http\Controllers\HomeController;
use Database\Factories\BrandFactory;
use Database\Factories\CategoryFactory;
use Database\Factories\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Tests\TestCase;

class ThumbnailControllerTest extends TestCase
{

    use RefreshDatabase;



    /**
     * @test
     * @return void
     */
    public function it_generated_success(): void
    {
        $size = '500x500';
        $method = 'resize';
        $storage = Storage::disk('images');
         
        config()->set('thumbnail', ['allowed_size' => [$size]]);

        $product = ProductFactory::new()->create();

        $response = $this->get($product->makeThumbnail($size, $method));

        // Image::shouldReceive('make')
        //     ->once()
        //     ->andReturnSelf()

        //     ->shouldReceive('resize')
        //     ->once()
        //     ->andReturnSelf()

        //     ->shouldReceive('save')
        //     ->once()
        //     ->andReturn();

        $response->assertOk();

        $storage->assertExists(
            "products/$method/$size/" . File::basename($product->thumbnail)
        );
    }



}
