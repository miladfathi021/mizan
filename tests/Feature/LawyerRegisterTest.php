<?php

namespace Tests\Feature;

use App\PhoneVerification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LawyerRegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function The_user_can_create_a_new_account_after_confirming_the_mobile_number()
    {
        $this->withoutExceptionHandling();

        $phone = factory(PhoneVerification::class)->create(['status' => 1]);

        $this->postJson('api/v1/register', [
            'name' => 'John Doe',
            'phone' => $phone->phone,
            'password' => 'password',
            'password_confirmation' => 'password'
        ])->assertJson(['status' => 201]);

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'phone' => $phone->phone,
        ]);
    }
}
