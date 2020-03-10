<?php

namespace Tests\Feature;

use App\PhoneVerification;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegisterTest extends TestCase
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

    /** @test **/
    public function name_is_required_for_create_a_new_account()
    {
        $phone = factory(PhoneVerification::class)->create(['status' => 1]);

        $this->postJson('api/v1/register', [
            'name' => null,
            'phone' => $phone->phone,
            'password' => 'password',
            'password_confirmation' => 'password'
        ])->assertJsonValidationErrors(['name']);
    }

    /** @test **/
    public function name_should_be_string()
    {
        $phone = factory(PhoneVerification::class)->create(['status' => 1]);

        $this->postJson('api/v1/register', [
            'name' => 123,
            'phone' => $phone->phone,
            'password' => 'password',
            'password_confirmation' => 'password'
        ])->assertJsonValidationErrors(['name']);
    }

    /** @test **/
    public function phone_is_required_for_create_a_new_account()
    {
        $this->postJson('api/v1/register', [
            'name' => 'John dOe',
            'phone' => null,
            'password' => 'password',
            'password_confirmation' => 'password'
        ])->assertJsonValidationErrors(['phone']);
    }

    /** @test **/
    public function phone_should_be_number()
    {
        $this->postJson('api/v1/register', [
            'name' => 'John dOe',
            'phone' => 'test',
            'password' => 'password',
            'password_confirmation' => 'password'
        ])->assertJsonValidationErrors(['phone']);
    }

    /** @test **/
    public function phone_should_be_unique()
    {
        $user = factory(User::class)->create(['phone' => '09215420796']);

        $this->postJson('api/v1/register', [
            'name' => 'John dOe',
            'phone' => $user->phone,
            'password' => 'password',
            'password_confirmation' => 'password'
        ])->assertJsonValidationErrors(['phone']);
    }

    /** @test **/
    public function password_is_required_for_create_a_new_account()
    {
        $this->postJson('api/v1/register', [
            'name' => 'John dOe',
            'phone' => '09215420796',
            'password' => null,
            'password_confirmation' => 'password'
        ])->assertJsonValidationErrors(['password']);
    }

    /** @test **/
    public function password_confirmation_is_required_for_create_a_new_account()
    {
        $this->postJson('api/v1/register', [
            'name' => 'John dOe',
            'phone' => '09215420796',
            'password' => 'password',
            'password_confirmation' => null
        ])->assertJsonValidationErrors(['password']);
    }

    /** @test **/
    public function password_and_password_confirmation_must_be_equal()
    {
        $this->postJson('api/v1/register', [
            'name' => 'John dOe',
            'phone' => '09215420796',
            'password' => 'password',
            'password_confirmation' => 'passworddd'
        ])->assertJsonValidationErrors(['password']);
    }
}
