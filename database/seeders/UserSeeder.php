<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'nip' => '196207301983031004',
                'password' => Hash::make('12345678'),
                'jabatan' => 'Kepala Dinas',
            ], [
                'nip' => '197907112005011006',
                'password' => Hash::make('12345678'),
                'jabatan' => 'Admin Sekretariat',
            ], [
                'nip' => '197806052005011006',
                'password' => Hash::make('12345678'),
                'jabatan' => 'Kepala Bidang Pengawasan Ketenagakerjaan',
            ], [
                'nip' => '197002151996032004',
                'password' => Hash::make('12345678'),
                'jabatan' => 'Admin Bidang Pengawasan Ketenagakerjaan',
            ], [
                'nip' => '198010052000121000',
                'password' => Hash::make('12345678'),
                'jabatan' => 'Kepala Bidang Transmigrasi',
            ], [
                'nip' => '197302201996032004',
                'password' => Hash::make('12345678'),
                'jabatan' => 'Admin Bidang Transmigrasi',
            ], [
                'nip' => '197611221997021002',
                'password' => Hash::make('12345678'),
                'jabatan' => 'Kepala Bidang Hubungan Industrial',
            ], [
                'nip' => '197304151996032004',
                'password' => Hash::make('12345678'),
                'jabatan' => 'Admin Bidang Hubungan Industrial',
            ], [
                'nip' => '197002151996032003',
                'password' => Hash::make('12345678'),
                'jabatan' => 'Kepala Bidang Penempatan dan Pelatihan',
            ], [
                'nip' => '197502151996032004',
                'password' => Hash::make('12345678'),
                'jabatan' => 'Admin Bidang Penempatan dan Pelatihan',
            ]
        ];

        DB::table('users')->insert($user);
    }
}
