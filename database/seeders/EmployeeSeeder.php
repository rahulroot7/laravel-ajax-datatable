<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employees;
use Illuminate\Database\Eloquent\Model;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $employees = [
            [
                'username' => 'rahulroot7',
                'name' => 'Rahul Chaurasia',
                'email' => 'root@gmail.com',
                'city' => 'Lucknow',
                'gender' => 'Male',
            ],
            [
                'username' => 'amit1995',
                'name' => 'Amit Chaurasia',
                'email' => 'amit002@gmail.com',
                'city' => 'Kushinagar',
                'gender' => 'Male',
            ],
            [
                'username' => 'anamikaroot7',
                'name' => 'Anamika Chaurasia',
                'email' => 'anamika@gmail.com',
                'city' => 'ramkola',
                'gender' => 'Female',
            ],
            [
                'username' => 'Parkash1995',
                'name' => 'Parkash Madhesiya',
                'email' => 'parkash@gmail.com',
                'city' => 'Tekuatar',
                'gender' => 'Male',
            ],
            [
                'username' => 'vinita001',
                'name' => 'Vinita',
                'email' => 'vinnita@gmail.com',
                'city' => 'Kanpur',
                'gender' => 'Female',
            ],
        ];

        foreach ($employees as $employee) {
            Employees::create(
                $employee
            );
        }
    }
}
