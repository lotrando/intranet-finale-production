<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\JobSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            NavitemSeeder::class,
            DepartmentSeeder::class,
            JobSeeder::class,
            CategorySeeder::class,
        ]);

        User::factory(865)->create();
    }
}
