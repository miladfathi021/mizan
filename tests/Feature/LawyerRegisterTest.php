<?php

namespace Tests\Feature;

use App\LawyerAccountRequest;
use App\Permission;
use App\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LawyerRegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function Manager_can_create_a_account_for_a_new_lawyer ()
    {
        $this->withoutExceptionHandling();

        $user = $this->singIn();

        $this->giveManagementLawyerRoleTo($user);

        $lawyer_request = factory(LawyerAccountRequest::class)->create();

        $this->postJson('/api/v1/admin/lawyer/register', [
            "name" => $lawyer_request->name,
            "license_number" => $lawyer_request->license_number,
            "national_no" => $lawyer_request->national_no,
            "province" => $lawyer_request->province,
            "city" => $lawyer_request->city,
            "phone" => $lawyer_request->phone,
            "lawyer_experience" => $lawyer_request->lawyer_experience,
        ])->assertJson([
            'status' => 201
        ]);

        $this->assertDatabaseHas('users', [
            'phone' => $lawyer_request->phone,
        ]);

        $this->assertDatabaseHas('lawyers', [
            "license_number" => $lawyer_request->license_number,
            "national_no" => $lawyer_request->national_no,
        ]);
    }

    /** @test **/
    public function name_is_required()
    {
        $user = $this->singIn();

        $this->giveManagementLawyerRoleTo($user);

        $lawyer_request = factory(LawyerAccountRequest::class)->create();

        $this->postJson('/api/v1/admin/lawyer/register', [
            "name" => null,
            "license_number" => $lawyer_request->license_number,
            "national_no" => $lawyer_request->national_no,
            "province" => $lawyer_request->province,
            "city" => $lawyer_request->city,
            "phone" => $lawyer_request->phone,
            "lawyer_experience" => $lawyer_request->lawyer_experience,
        ])->assertJsonValidationErrors(['name']);
    }

    /** @test **/
    public function license_number_is_required()
    {
        $user = $this->singIn();

        $this->giveManagementLawyerRoleTo($user);

        $lawyer_request = factory(LawyerAccountRequest::class)->create();

        $this->postJson('/api/v1/admin/lawyer/register', [
            "name" => $lawyer_request->name,
            "license_number" => null,
            "national_no" => $lawyer_request->national_no,
            "province" => $lawyer_request->province,
            "city" => $lawyer_request->city,
            "phone" => $lawyer_request->phone,
            "lawyer_experience" => $lawyer_request->lawyer_experience,
        ])->assertJsonValidationErrors(['license_number']);
    }

    /** @test **/
    public function national_no_is_required()
    {
        $user = $this->singIn();

        $this->giveManagementLawyerRoleTo($user);

        $lawyer_request = factory(LawyerAccountRequest::class)->create();

        $this->postJson('/api/v1/admin/lawyer/register', [
            "name" => $lawyer_request->name,
            "license_number" => $lawyer_request->license_number,
            "national_no" => null,
            "province" => $lawyer_request->province,
            "city" => $lawyer_request->city,
            "phone" => $lawyer_request->phone,
            "lawyer_experience" => $lawyer_request->lawyer_experience,
        ])->assertJsonValidationErrors(['national_no']);
    }

    /** @test **/
    public function province_is_required()
    {
        $user = $this->singIn();

        $this->giveManagementLawyerRoleTo($user);

        $lawyer_request = factory(LawyerAccountRequest::class)->create();

        $this->postJson('/api/v1/admin/lawyer/register', [
            "name" => $lawyer_request->name,
            "license_number" => $lawyer_request->license_number,
            "national_no" => $lawyer_request->national_no,
            "province" => null,
            "city" => $lawyer_request->city,
            "phone" => $lawyer_request->phone,
            "lawyer_experience" => $lawyer_request->lawyer_experience,
        ])->assertJsonValidationErrors(['province']);
    }

    /** @test **/
    public function city_phone_and_lawyer_experience_is_required()
    {
        $user = $this->singIn();

        $this->giveManagementLawyerRoleTo($user);
        
        $lawyer_request = factory(LawyerAccountRequest::class)->create();

        $this->postJson('/api/v1/admin/lawyer/register', [
            "name" => $lawyer_request->name,
            "license_number" => $lawyer_request->license_number,
            "national_no" => $lawyer_request->national_no,
            "province" => $lawyer_request->province,
            "city" => null,
            "phone" => null,
            "lawyer_experience" => null,
        ])->assertJsonValidationErrors(['city', 'phone', 'lawyer_experience']);
    }

    /** @test **/
    public function Only_the_manager_can_create_a_new_account_for_the_lawyer()
    {
        $this->withoutExceptionHandling();

        $user = $this->singIn();

        $permission = new Permission();
        $permission->name = 'ایجاد وکیل';
        $permission->slug = 'create-lawyer';
        $permission->save();

        $role = new Role();
        $role->name = 'مدیریت وکلا';
        $role->slug = 'management-lawyers';
        $role->save();


        $role->permissions()->attach($permission);

        $lawyer_request = factory(LawyerAccountRequest::class)->create();

        $this->postJson('/api/v1/admin/lawyer/register', [
            "name" => $lawyer_request->name,
            "license_number" => $lawyer_request->license_number,
            "national_no" => $lawyer_request->national_no,
            "province" => $lawyer_request->province,
            "city" => $lawyer_request->city,
            "phone" => $lawyer_request->phone,
            "lawyer_experience" => $lawyer_request->lawyer_experience,
        ])->assertStatus(401);
    }
}
