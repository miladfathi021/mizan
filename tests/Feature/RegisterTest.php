<?php

namespace Tests\Feature;

use App\PhoneVerification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function the_user_can_register_on_the_site()
    {
        $this->withoutExceptionHandling();

        $phone = '09215420796';

        $this->postJson('/api/v1/phone-verification', [
            'phone' => $phone,
        ])->assertJson(['status' => 201, 'phone' => $phone]);

        $this->assertDatabaseHas('phone-verifications', [
            'phone' => $phone,
            'status' => 0
        ]);
    }

    /** @test **/
    public function phone_is_required_for_create_account()
    {
        $this->postJson('/api/v1/phone-verification', [
            'phone' => null,
        ])->assertJsonValidationErrors(['phone']);
    }

    /** @test **/
    public function phone_should_be_number()
    {
        $this->postJson('/api/v1/phone-verification', [
            'phone' => 'lorem',
        ])->assertJsonValidationErrors(['phone']);
    }

    /** @test **/
    public function The_user_must_enter_the_received_code_to_continue_registration()
    {
        $this->withoutExceptionHandling();

        $code = factory(PhoneVerification::class)->create();

        $this->post('/api/v1/success-phone-verification', [
            'code' => $code->code,
            'phone' => $code->phone,
        ])->assertJson(['status' => 200]);

        $this->assertDatabaseHas('phone-verifications', [
            'phone' => $code->phone,
            'status' => 1
        ]);
    }

    /** @test **/
    public function The_user_must_enter_the_correct_received_code()
    {
        $this->withoutExceptionHandling();

        $code = factory(PhoneVerification::class)->create();

        $this->post('/api/v1/success-phone-verification', [
            'code' => 1123,
            'phone' => $code->phone,
        ])->assertJson(['status' => 404]);

        $this->assertDatabaseHas('phone-verifications', [
            'phone' => $code->phone,
            'status' => 0
        ]);
    }

    /** @test **/
    public function code_is_required()
    {
        $this->postJson('/api/v1/success-phone-verification', [
            'code' => null,
            'phone' => '09123456789',
        ])->assertJsonValidationErrors(['code']);
    }

    /** @test **/
    public function Verification_code_should_be_number()
    {
        $this->postJson('/api/v1/success-phone-verification', [
            'code' => 'test',
            'phone' => '09123456789',
        ])->assertJsonValidationErrors(['code']);
    }

    /** @test **/
    public function code_should_be_at_least_4_number()
    {
        $this->postJson('/api/v1/success-phone-verification', [
            'code' => 123,
            'phone' => '09123456789',
        ])->assertJsonValidationErrors(['code']);
    }

    /** @test **/
    public function code_should_be_at_most_4_number()
    {
        $this->postJson('/api/v1/success-phone-verification', [
            'code' => 12345,
            'phone' => '09123456789',
        ])->assertJsonValidationErrors(['code']);
    }
    
}
