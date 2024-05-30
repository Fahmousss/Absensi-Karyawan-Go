<?php

namespace Database\Seeders;

use Database\Seeders\RolesTableSeeder as SeedersRolesTableSeeder;
use Database\Seeders\UsersTableSeeder as SeedersUsersTableSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use RolesTableSeeder;
use UsersTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SeedersRolesTableSeeder::class);
        $this->call(SeedersUsersTableSeeder::class);
    }
}
