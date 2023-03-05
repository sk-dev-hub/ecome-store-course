<?php

namespace Tests\Feature\Auth\DTOs;

use App\Http\Requests\SignUpFormRequest;
use Domain\Auth\DTOs\NewUserDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewUserDTOTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * @test
     * @return void
     */
    public function test_instance_created_from_form_request()
    {
        $dto = NewUserDTO::fromRequest(new SignUpFormRequest([
            'name' => 'test',
            'email' => 'test@gamil.com',
            'password' => '1234567890'
        ]));

        $this->assertInstanceOf(NewUserDTO::class, $dto);
    }
}
