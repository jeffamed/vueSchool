<?php

namespace App\Services;
use App\Models\User;
use Faker\Factory;

class UserService
{
    public function updateUsers()
    {
        $users = User::all();
        $faker  =  Factory::create();
        foreach ($users as $user) {
            $user->name = $faker->name;
            $user->last_name = $faker->lastName;
            $user->time_zone = $faker->randomElement(["CET", "CST", "GMT+1"]);
            $user->save();
        }
    }
}
