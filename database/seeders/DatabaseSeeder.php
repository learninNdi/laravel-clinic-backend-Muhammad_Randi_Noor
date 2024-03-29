<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => Hash::make('12345678'),
            'phone' => '081123456789',
        ]);

        \App\Models\ProfileClinic::factory()->create([
            'name' => 'Klinik 1',
            'address' => 'Cimahi',
            'phone' => '(022) 643821',
            'email' => 'klinik1@example.com',
            'doctor_name' => 'dr. Randi',
            'unique_code' => 'klinik_satu',
        ]);

        // call
        $this->call([
            DoctorSeeder::class,
            DoctorScheduleSeeder::class,
            PatientSeeder::class,
        ]);
    }
}
