<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\student;

class StudentSeeder extends Seeder
{
    public function run()
    {
        student::create(['name'=>'Prakhar',
        'rollNo'=>23,
        'branch'=>'MCA']);
    }
}