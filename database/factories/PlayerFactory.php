<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    private static $userIds = [];
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'first_name' => '',
            'last_name' => '',
            'nickname' => '',
            'email' => '',
            'phone' => $this->faker->phoneNumber(),
            'join_at' => Carbon::now(),
            'user_id' => null
        ];
    }

    public function forUser(User $user): PlayerFactory
    {
        // make sure you will not get two players
        // with the same user_id
        $names = explode(' ', $user->getName(), 2);
        $users = User::all();

        if(empty(self::$userIds)){
            self::$userIds = array_map(function($user){
                return $user['id'];
            }, $users->toArray());
        }
        $randomKey = array_rand(self::$userIds);
        $randomUserId = self::$userIds[$randomKey];
        unset(self::$userIds[$randomKey]);
        self::$userIds = array_values(self::$userIds);

        return $this->state([
            // not every player should be a user - more flexibility
            'user_id' => $this->faker->boolean() ? $randomUserId : null,
            'first_name' => $names[0] ?? 'No first Name',
            'last_name' => $names[1] ?? 'No last Name',
            'email' => $user->getEmail(),
            'nickname' => $this->faker->name(),
        ]);
    }
}
