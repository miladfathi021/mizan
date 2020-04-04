<?php

namespace Tests;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Passport;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function singIn($user = null)
    {
        $user = $user !== null ? $user : factory(User::class)->create();

        Passport::actingAs($user);

        return $user;
    }

    public function giveManagementLawyerRoleTo($user)
    {
        $permission = new Permission();
        $permission->name = 'ایجاد وکیل';
        $permission->slug = 'create-lawyer';
        $permission->save();

        $role = new Role();
        $role->name = 'مدیریت وکلا';
        $role->slug = 'management-lawyers';
        $role->save();


        $role->permissions()->attach($permission);
        $user->permissions()->attach($role);
        $user->roles()->attach($permission);

        return;
    }
}
