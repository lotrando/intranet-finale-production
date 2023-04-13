<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            DB::table('users')->insert([
                'personal_number' => $employee->personal_number,
                'name' => $employee->last_name . ' ' . $employee->first_name,
                'email' => $employee->last_name . '@khn.cz',
                'email_verified_at' => now(),
                'role' => 'user',
                'password' => Hash::make($employee->personal_number),
                'remember_token' => Str::random(15),
            ]);
        }
    }
}
