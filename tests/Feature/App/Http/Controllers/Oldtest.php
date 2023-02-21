<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Http\Controllers\Auth\SignInController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\AuthController;
use App\Http\Requests\ForgotPasswordFormRequest;
use App\Http\Requests\SignInFormRequest;
use App\Http\Requests\SignUpFormRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use App\Listeners\SendEmailNewUserListener;
use Domain\Auth\Models\User;
use App\Notifications\NewUserNotification;
use Tests\TestCase;

class AuthControllerTest 
{



    /**
     * @test
     * @return void
     */
    public function it_login_page_success(): void
    {
        $response = $this->get(action([SignInController::class, 'page']));

        $response
            ->assertOk()
            ->assertSee('Вход в аккаунт')
            ->assertViewIs('auth.login')
            ->assertStatus(200);
    }

    /**
     * @test
     * @return void
     */
    public function it_sign_up_page_success(): void
    {
        $response = $this->get(action([AuthController::class, 'signUp']));

        $response
            ->assertOk()
            ->assertSee('Регистрация')
            ->assertViewIs('auth.sign-up')
            ->assertStatus(200);
    }


    /**
     * @test
     * @return void
     */
    public function it_forgot_page_success(): void
    {
        $response = $this->get(action([AuthController::class, 'forgot']));

        $response
            ->assertOk()
            ->assertSee('Забыли пароль')
            ->assertViewIs('auth.forgot-password')
            ->assertStatus(200);
    }

    /**
     * @test
     * @return void
     */
    public function it_sign_in_page_success(): void
    {
       
        $password = '123456789';
        $user = User::factory()->create([
            'email' => 'test@mail.ru',
            'password' => bcrypt($password)
        ]);


        $request = SignInFormRequest::factory()->create([
            'email' => $user->email,
            'password' => $password,
        ]);
        
        
        
        $response = $this->post(action([AuthController::class, 'signIn']), $request);

        $response
            ->assertValid()
            ->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     * @return void
     */
    public function it_store_success(): void
    {
        Notification::fake();
        Event::fake();

        $request = SignUpFormRequest::factory()->create([
            //'email' => 'test@mail.ru',
            'password' => '1234567890',
            'password_confirmation' => '1234567890'
        ]);

        // проверка на наличие в базе (если нет)
        $this->assertDatabaseMissing('users', [
            'email' => $request['email'],
        ]);

        $response = $this->post(
            action([AuthController::class, 'store']),
            $request
        );

        $response->assertValid();

        // проверка на наличие в базе (если есть)
        $this->assertDatabaseHas('users', [
            'email' => $request['email'],
        ]);

        $user = User::query()->where('email', $request['email'])->first();
        
        Event::assertDispatched(Registered::class);
        Event::assertListening(Registered::class, SendEmailNewUserListener::class);

        $event = new Registered($user);
        $listener = new SendEmailNewUserListener();
        $listener->handle($event);

        Notification::assertSentTo($user, NewUserNotification::class );

        $this->assertAuthenticatedAs($user);

        $response->assertRedirect(route('home'));

    }

    /**
     * @test
     * @return void
     */
    public function it_log_out_page_success(): void
    {
        
        $user = User::factory()->create([
            'email' => 'test@mail.ru',
        ]);
        
        $this->actingAs($user)->delete(action([AuthController::class, 'logOut']));

        $this->assertGuest();
    }

    /**
     * @test
     * @return void
     */
    public function it_forgot_password_page_success(): void
    {
        $user = User::factory()->create([
            'email' => 'test@mail.ru',
        ]);


        $request = ForgotPasswordFormRequest::factory()->create([
            'email' => $user->email,
        ]); 

        $response = $this->post(action([AuthController::class, 'forgotPassword']), $request);
        
       
        //dd($response);
       
        $response
        // ->assertSessionHasAll([
        //     "attributes" => [
        //         "shop_flash_message" => "We have emailed your password reset link!"
        // ]])
           ->assertRedirect(route('home'));
    }




}
