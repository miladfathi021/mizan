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

        $this->postJson('api/v1/lawyer-contracts/register', [
            'name' => 'John Doe',
            'license_number' => '1234567',
            'national_no' => '1234567890',
            'province' => 'tehran',
            'city' => 'tehran',
            'phone' => '09215420796',
            'lawyer_experience' => 12,
            'internet_consultation' => 3,
        ])->assertJson(['status' => 201]);

        $this->assertDatabaseHas('lawyer_contracts', [
            'name' => 'John Doe',
            'phone' => '09215420796',
        ]);
    }
}
