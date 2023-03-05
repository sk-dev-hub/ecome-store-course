<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Database\Factories\UserFactory;
use Illuminate\Auth\Notifications\ResetPassword;
use Tests\TestCase;

class ForgotPasswordControllerTest extends TestCase
{

    use RefreshDatabase;


    private function  testingCredentials(): array
    {
        return [
            'email' => 'testing@gmail.ru',
        ];
    }

    /**
     * @test
     * @return void
     */
    public function it_page_success(): void
    {
        $this->get(action([ForgotPasswordController::class, 'page']))
            ->assertOk()
            ->assertStatus(200)
            ->assertSee('Забыли пароль')
            ->assertViewIs('auth.forgot-password');
    }

    /**
     * @test
     * @return void
     */
    public function it_handle_success(): void
    {

        $user = UserFactory::new()->create($this->testingCredentials());


        $this->post(action([ForgotPasswordController::class, 'handle']), $this->testingCredentials())
            ->assertRedirect();

        Notification::assertSentTo($user, ResetPassword::class);
    }

   /**
     * @test
     * @return void
     */
    public function it_handle_fail(): void
    {
        
        $this->assertDatabaseMissing('users', $this->testingCredentials());


        $response = $this->post(action([ForgotPasswordController::class, 'handle']), $this->testingCredentials());

        $response->assertInvalid(['email']);

        Notification::assertNothingSent();

    }

}
