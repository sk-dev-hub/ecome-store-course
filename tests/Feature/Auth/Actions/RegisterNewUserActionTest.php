<?php

namespace Tests\Feature\Auth\Actions;

use App\Http\Requests\SignUpFormRequest;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewUserDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterNewUserActionTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * @test
     * @return void
     */
    public function it_success_user_created()
    {
        $this->assertDatabaseMissing('users', [
            'email' => 'testing@gmail.com',
        ]);
        
        $action = app(RegisterNewUserContract::class);

        $action( NewUserDTO::make(
            'Test',
            'testing@gmail.com',
            '1234567890'
        ));
        
        $this->assertDatabaseHas('users', [
            'email' => 'testing@gmail.com',
        ]);

    }
}
