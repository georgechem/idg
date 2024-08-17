<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    private const RECORDS = 500;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run():void
    {
        User::factory(self::RECORDS)->create();
    }
}
