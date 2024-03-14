<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Doctor::all()->each(function ($doctor) {
            \App\Models\DoctorSchedule::factory()->count(1)->create([
                'doctor_id' => $doctor->id,
            ]);
        });
    }
}
