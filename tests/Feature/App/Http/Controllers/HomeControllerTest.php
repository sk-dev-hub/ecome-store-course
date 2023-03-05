<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Http\Controllers\HomeController;
use Database\Factories\BrandFactory;
use Database\Factories\CategoryFactory;
use Database\Factories\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{

    use RefreshDatabase;



    /**
     * @test
     * @return void
     */
    public function it_success_response(): void
    {
        CategoryFactory::new()->count(5)
            ->create([
                'on_home_page' => true,
                'sorting' => 999
            ]);

        $category = CategoryFactory::new()
        ->createOne([
            'on_home_page' => true,
            'sorting' => 1
        ]); 
        
        
        ProductFactory::new()->count(5)
            ->create([
                'on_home_page' => true,
                'sorting' => 999
            ]);

        $product = ProductFactory::new()
        ->createOne([
            'on_home_page' => true,
            'sorting' => 1
        ]);    
        
        BrandFactory::new()->count(5)
        ->create([
            'on_home_page' => true,
            'sorting' => 999
        ]);

        $brand = BrandFactory::new()
        ->createOne([
            'on_home_page' => true,
            'sorting' => 1
        ]);
        
             
        $this->get(action([HomeController::class]))
            ->assertOk()
            ->assertStatus(200)
            ->assertViewHas('categories.0', $category)
            ->assertViewHas('products.0', $product)
            ->assertViewHas('brands.0', $brand)
            ->assertViewIs('index');
    }

//     /**
//      * @test
//      * @return void
//      */
//     public function it_handle_success(): void
//     {
        
//         $password = '123456789';

//         $user = UserFactory::new()->create([
//             'email' => 'test@mail.ru',
//             'password' => bcrypt($password)
//         ]);

//         $request = SignInFormRequest::factory()->create([
//             'email' => $user->email,
//             'password' => $password,
//         ]);

//         $response = $this->post(action([SignInController::class, 'handle']), $request);

//         $response->assertValid()
//             ->assertRedirect(route('home'));

//         $this->assertAuthenticatedAs($user);
//     }

//    /**
//      * @test
//      * @return void
//      */
//     public function it_handle_fail(): void
//     {
        
//         $request = SignInFormRequest::factory()->create([
//             'email' => 'notfound@mail.ru',
//             'password' => str()->random(10)
//         ]);

//         $response = $this->post(action([SignInController::class, 'handle']), $request);

//         $response->assertInvalid(['email']);

//         $this->assertGuest();

//     }

//     /**
//      * @test
//      * @return void
//      */
//     public function it_logout_success(): void
//     {
        
//         $user = UserFactory::new()->create([
//             'email' => 'test@mail.ru',
//         ]);
        
//         $this->actingAs($user)->delete(action([SignInController::class, 'logOut']));

//         $this->assertGuest();
//     }

//     /**
//      * @test
//      * @return void
//      */
//     public function it_logout_guest_middleware_fail(): void
//     {
        
//         $this->delete(action([SignInController::class, 'logOut']))
//             ->assertRedirect(route('home'));

//     }

}
