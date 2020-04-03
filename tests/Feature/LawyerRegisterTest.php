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
    public function Lawyer_can_send_request_for_create_a_new_account()
    {
        $this->withoutExceptionHandling();

        $this->postJson('api/v1/lawyer/register', [
            'name' => 'John Doe',
            'license_number' => '1234567',
            'national_no' => '1234567890',
            'province' => 'tehran',
            'city' => 'tehran',
            'phone' => '09215420796',
            'lawyer_experience' => 12,
            'internet_consultation' => 3,
        ])->assertJson(['status' => 201]);

        $this->assertDatabaseHas('lawyer_account_request', [
            'name' => 'John Doe',
            'phone' => '09215420796',
            'status' => 0
        ]);
    }

    /** @test **/
    public function name_is_required()
    {
        $this->postJson('api/v1/lawyer/register', [
            'name' => null,
            'license_number' => '1234567',
            'national_no' => '1234567890',
            'province' => 'tehran',
            'city' => 'tehran',
            'phone' => '09215420796',
            'lawyer_experience' => 12,
            'internet_consultation' => 3,
        ])->assertJsonValidationErrors(['name']);
    }

    /** @test **/
    public function license_number_is_required()
    {
        $this->postJson('api/v1/lawyer/register', [
            'name' => 'John Doe',
            'license_number' => null,
            'national_no' => '1234567890',
            'province' => 'tehran',
            'city' => 'tehran',
            'phone' => '09215420796',
            'lawyer_experience' => 12,
            'internet_consultation' => 3,
        ])->assertJsonValidationErrors(['license_number']);
    }

    /** @test **/
    public function national_no_is_required()
    {
        $this->postJson('api/v1/lawyer/register', [
            'name' => 'John Doe',
            'license_number' => '123456',
            'national_no' => null,
            'province' => 'tehran',
            'city' => 'tehran',
            'phone' => '09215420796',
            'lawyer_experience' => 12,
            'internet_consultation' => 3,
        ])->assertJsonValidationErrors(['national_no']);
    }

    /** @test **/
    public function province_is_required()
    {
        $this->postJson('api/v1/lawyer/register', [
            'name' => 'John Doe',
            'license_number' => '123456',
            'national_no' => '1234567890',
            'province' => null,
            'city' => 'tehran',
            'phone' => '09215420796',
            'lawyer_experience' => 12,
            'internet_consultation' => 3,
        ])->assertJsonValidationErrors(['province']);
    }

    /** @test **/
    public function city_is_required()
    {
        $this->postJson('api/v1/lawyer/register', [
            'name' => 'John Doe',
            'license_number' => '123456',
            'national_no' => '1234567890',
            'province' => 'tehran',
            'city' => null,
            'phone' => '09215420796',
            'lawyer_experience' => 12,
            'internet_consultation' => 3,
        ])->assertJsonValidationErrors(['city']);
    }

    /** @test **/
    public function phone_is_required()
    {
        $this->postJson('api/v1/lawyer/register', [
            'name' => 'John Doe',
            'license_number' => '123456',
            'national_no' => '1234567890',
            'province' => 'tehran',
            'city' => 'tehran',
            'phone' => null,
            'lawyer_experience' => 12,
            'internet_consultation' => 3,
        ])->assertJsonValidationErrors(['phone']);
    }

    /** @test **/
    public function lawyer_experience_is_required()
    {
        $this->postJson('api/v1/lawyer/register', [
            'name' => 'John Doe',
            'license_number' => '123456',
            'national_no' => '1234567890',
            'province' => 'tehran',
            'city' => 'tehran',
            'phone' => '09215420796',
            'lawyer_experience' => null,
            'internet_consultation' => 3,
        ])->assertJsonValidationErrors(['lawyer_experience']);
    }

    /** @test **/
    public function internet_consultation_is_required()
    {
        $this->postJson('api/v1/lawyer/register', [
            'name' => 'John Doe',
            'license_number' => '123456',
            'national_no' => '1234567890',
            'province' => 'tehran',
            'city' => 'tehran',
            'phone' => '09215420796',
            'lawyer_experience' => 12,
            'internet_consultation' => null,
        ])->assertJsonValidationErrors(['internet_consultation']);
    }
}
