<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function user_can_login()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create(['phone' => '09215420796']);

        Artisan::call('passport:install');

        $this->postJson('/api/v1/login', [
            'phone' => $user->phone,
            'password' => 'password'
        ])->assertJson(['status' => 200]);
    }

    /** @test **/
    public function phone_is_required()
    {
        $this->postJson('/api/v1/login', [
            'phone' => null,
            'password' => 'password'
        ])->assertJsonValidationErrors(['phone']);
    }

    /** @test **/
    public function phone_should_be_exists()
    {
        $this->postJson('/api/v1/login', [
            'phone' => '09210000000',
            'password' => 'password'
        ])->assertJsonValidationErrors(['phone']);
    }

    /** @test **/
    public function password_is_required()
    {
        $this->postJson('/api/v1/login', [
            'phone' => '09215420796',
            'password' => null
        ])->assertJsonValidationErrors(['password']);
    }
}
