<?php

namespace Database\Seeders;

use App\Attendance;
use App\Department;
use App\Employee;
use App\Role;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();
        DB::table('employees')->truncate();
        DB::table('departments')->truncate();
        DB::table('attendances')->truncate();
        $employeeRole = Role::where('name', 'employee')->first();
        $adminRole =  Role::where('name', 'admin')->first();

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin')
        ]);

        $employee = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user')
        ]);

        // 
        $employee->roles()->attach($employeeRole);
        $dob = new DateTime('1997-09-15');
        $join = new DateTime('2020-01-15');
        $admin->roles()->attach($adminRole);
        $employee = Employee::create([
            'user_id' => $employee->id,
            'first_name' => 'Lorem',
            'last_name' => 'Ipsum',
            'dob' => $dob->format('Y-m-d'),
            'sex' => 'Male',
            'desg' => 'Manager',
            'department_id' => '1',
            'join_date' => $join->format('Y-m-d'),
            'salary' => 200000
        ]);

        Department::create(['name' => 'Direktur']);
        Department::create(['name' => 'Produksi']);
        Department::create(['name' => 'Marketing']);
        Department::create(['name' => 'Design Grafis']);
        Department::create(['name' => 'Internship']);

        // Attendance seeder
        
    }
}
