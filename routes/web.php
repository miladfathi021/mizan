<?php

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@homepage')->name('pages.homepage');
Route::get('/role', function () {
    $dev_permission = Permission::where('slug','create-tasks')->first();
    $manager_permission = Permission::where('slug', 'edit-users')->first();

    //RoleTableSeeder.php
    $dev_role = new Role();
    $dev_role->slug = 'developer';
    $dev_role->name = 'Front-end Developer';
    $dev_role->save();
    $dev_role->permissions()->attach($dev_permission);

    $manager_role = new Role();
    $manager_role->slug = 'manager';
    $manager_role->name = 'Assistant Manager';
    $manager_role->save();
    $manager_role->permissions()->attach($manager_permission);

    $dev_role = Role::where('slug','developer')->first();
    $manager_role = Role::where('slug', 'manager')->first();

    $createTasks = new Permission();
    $createTasks->slug = 'create-tasks';
    $createTasks->name = 'Create Tasks';
    $createTasks->save();
    $createTasks->roles()->attach($dev_role);

    $editUsers = new Permission();
    $editUsers->slug = 'edit-users';
    $editUsers->name = 'Edit Users';
    $editUsers->save();
    $editUsers->roles()->attach($manager_role);

    $dev_role = Role::where('slug','developer')->first();
    $manager_role = Role::where('slug', 'manager')->first();
    $dev_perm = Permission::where('slug','create-tasks')->first();
    $manager_perm = Permission::where('slug','edit-users')->first();


    $developer = User::where('id', 1)->first();
    $manager = User::where('id', 2)->first();


    $developer->roles()->attach($dev_role);
    $developer->permissions()->attach($dev_perm);

    $manager->roles()->attach($manager_role);
    $manager->permissions()->attach($manager_perm);


    return 'Ok';
});
