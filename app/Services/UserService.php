<?php

namespace App\Services;
use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Facades\Http;

class UserService
{
    private string $BASE_ROUTE_API = "wwww.route-third-party-api.com";

    /**
     * Update the information of all users in the database
     * Generate fake data and save it in the database
     * @return void
     */
    public function updateUsers(): void
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

    /**
     * Update the information of the users use a third-party api and save the information in the database
     * Total users to be updated: 1000
     * @param int $start
     * @param int $end
     * @return void
     */
    public function updateUserByBatch(int $start, int $limit): void
    {
        $users = User::select('email', 'name', 'time_zone')->offset($start)->take($limit)->get();
        $route_batch = $this->BASE_ROUTE_API . "/users/batch";
        $token = "";
        $data = [
            "subcribers" => $users
        ];
        $response = Http::withToken($token)->post($route_batch, $data);
        if ($response->successful()) {
            $users = $response->json();
            foreach ($users as $user) {
                $this->updateByEmail($user['email'], $user);
            }
        } else {
            \Log::error("Error with the api response");
            \Log::error($response->body());
        }
    }

    /**
     * Update the information use a third-party api and save the information in the database by email
     * @param string $email
     * @return void
     */
    public function updateUserIndividual(string $email): void
    {
        $route_individual = $this->BASE_ROUTE_API . "/users/" . $email;
        $token = "";
        $response = Http::withToken($token)->get($route_individual);
        if ($response->successful()) {
            $user = $response->json();
            $this->updateByEmail($email, $user);
        } else {
            \Log::error("Error with the api response");
            \Log::error($response->body());
        }
    }

    /**
     * Update the information of a user by email
     * @param string $email
     * @param array $data
     * @return User
     */
    public function updateByEmail(string $email, array $data): User
    {
        $user  = User::where('email', $email)->first();
        $user->name = $data['name'];
        $user->time_zone = $data['time_zone'];
        $user->save();
        return $user;
    }
}
