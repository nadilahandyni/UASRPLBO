<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pegawai = [
            [
                'nip' => '196207301983031004',
                'nama' => 'H. JONLI, S.Sos, M.Si',
                'jenis_kelamin' => 'laki-laki',
                'tempat_lahir' => 'pekanbaru',
                'tgl_lahir' => '1962-07-30',
                'hp' => '08127123450',
                'alamat' => 'Jl. Sudirman', //kepala dinas
            ], [
                'nip' => '197907112005011006',
                'nama' => 'ASHANTY ANANG, ST',
                'jenis_kelamin' => 'perempuan',
                'tempat_lahir' => 'pekanbaru',
                'tgl_lahir' => '1979-07-11',
                'hp' => '081212209890',
                'alamat' => 'Jl. Sudirman', //admin sekretariat
            ], [
                'nip' => '197806052005011006',
                'nama' => 'ANANG HERMANSYAH, ST',
                'jenis_kelamin' => 'laki-laki',
                'tempat_lahir' => 'pekanbaru',
                'tgl_lahir' => '1978-06-05',
                'hp' => '081212209890',
                'alamat' => 'Jl. Sudirman', //kepala bidang pengawasan ketenagakerjaan
            ], [
                'nip' => '197002151996032004',
                'nama' => 'EKA AYU, Sos, M.Si',
                'jenis_kelamin' => 'perempuan',
                'tempat_lahir' => 'pekanbaru',
                'tgl_lahir' => '1970-02-15',
                'hp' => '081212209890',
                'alamat' => 'Jl. Sudirman', //admin bidang pengawasan ketenagakerjaan
            ], [
                'nip' => '198010052000121000',
                'nama' => 'HERU HARYO PRAYITNO, SE, M.Si',
                'jenis_kelamin' => 'laki-laki',
                'tempat_lahir' => 'pekanbaru',
                'tgl_lahir' => '1980-01-05',
                'hp' => '081212209890',
                'alamat' => 'Jl. Sudirman', //kepala bidang transmigrasi
            ], [
                'nip' => '197302201996032004',
                'nama' => 'SANDIKA AYU, Sos, M.Si',
                'jenis_kelamin' => 'perempuan',
                'tempat_lahir' => 'pekanbaru',
                'tgl_lahir' => '1973-02-20',
                'hp' => '081212209890',
                'alamat' => 'Jl. Sudirman', //admin bidang transmigrasi
            ], [
                'nip' => '197611221997021002',
                'nama' => 'DEVI RIZALDO, S.STP, M.Si',
                'jenis_kelamin' => 'perempuan',
                'tempat_lahir' => 'pekanbaru',
                'tgl_lahir' => '1976-11-22',
                'hp' => '081212209890',
                'alamat' => 'Jl. Sudirman', //kepala bidang hubungan industrial
            ], [
                'nip' => '197304151996032004',
                'nama' => 'SITI NUR, Sos, M.Si',
                'jenis_kelamin' => 'perempuan',
                'tempat_lahir' => 'pekanbaru',
                'tgl_lahir' => '1973-04-15',
                'hp' => '081212209890',
                'alamat' => 'Jl. Sudirman', //admin bidang hubungan industrial
            ], [
                'nip' => '197002151996032003',
                'nama' => 'EVA ISMAIL, Sos, M.Si',
                'jenis_kelamin' => 'perempuan',
                'tempat_lahir' => 'pekanbaru',
                'tgl_lahir' => '1970-02-15',
                'hp' => '081212209890',
                'alamat' => 'Jl. Sudirman', //kepala bidang penempatan dan pelatihan
            ], [
                'nip' => '197502151996032004',
                'nama' => 'HAYATI, Sos, M.Si',
                'jenis_kelamin' => 'perempuan',
                'tempat_lahir' => 'pekanbaru',
                'tgl_lahir' => '1970-02-15',
                'hp' => '081212209890',
                'alamat' => 'Jl. Sudirman', //admin bidang pelatihan dan penempatan
            ]
        ];

        DB::table('pegawais')->insert($pegawai);
    }
}
