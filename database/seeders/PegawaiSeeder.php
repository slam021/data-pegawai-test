<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $data = [
            [
                'foto' => 'default.png',
                'nama_lengkap' => 'John Doe',
                'nama_panggilan' => 'John',
                'jabatan' => 'Manager',
                'tanggal_lahir' => Carbon::create('1985', '05', '15')->format('Y-m-d'),
                'kelamin' => 1, // Laki-laki
                'alamat' => 'Jl. Kebon Jeruk No. 12, Jakarta',
            ],
            [
                'foto' => 'default.png',
                'nama_lengkap' => 'Jane Smith',
                'nama_panggilan' => 'Jane',
                'jabatan' => 'Developer',
                'tanggal_lahir' => Carbon::create('1990', '12', '20')->format('Y-m-d'),
                'kelamin' => 2, // Perempuan
                'alamat' => 'Jl. Melati No. 45, Bandung',
            ],
            [
                'foto' => 'default.png',
                'nama_lengkap' => 'Aldi Jaya',
                'nama_panggilan' => 'Aldi',
                'jabatan' => 'QA',
                'tanggal_lahir' => Carbon::create('1993', '11', '05')->format('Y-m-d'),
                'kelamin' => 1, // Laki-laki
                'alamat' => 'Jl. Mawar No. 30, Bogor',
            ],
            [
                'foto' => 'default.png',
                'nama_lengkap' => 'Dani Irawan',
                'nama_panggilan' => 'Dani',
                'jabatan' => 'Backend',
                'tanggal_lahir' => Carbon::create('1998', '05', '15')->format('Y-m-d'),
                'kelamin' => 1, // Laki-laki
                'alamat' => 'Jl. Kebon Salak No. 12, Jakarta',
            ],
            [
                'foto' => 'default.png',
                'nama_lengkap' => 'Jack Supardi',
                'nama_panggilan' => 'Jack',
                'jabatan' => 'Analyst',
                'tanggal_lahir' => Carbon::create('1994', '11', '21')->format('Y-m-d'),
                'kelamin' => 1, // Laki-laki
                'alamat' => 'Jl. Merpati No. 12, Bandung',
            ],
            [
                'foto' => 'default.png',
                'nama_lengkap' => 'Moh Agus',
                'nama_panggilan' => 'Agus',
                'jabatan' => 'UX/UI',
                'tanggal_lahir' => Carbon::create('1998', '12', '11')->format('Y-m-d'),
                'kelamin' => 1, // Laki-laki
                'alamat' => 'Jl. Kaliurang No. 45, Jogja',
            ],
            [
                'foto' => 'default.png',
                'nama_lengkap' => 'Fajar Setiawan',
                'nama_panggilan' => 'Fajar',
                'jabatan' => 'Moblie Developer',
                'tanggal_lahir' => Carbon::create('1999', '05', '09')->format('Y-m-d'),
                'kelamin' => 1, // Laki-laki
                'alamat' => 'Jl. Delingan No. 90, Karanganyar',
            ],
            [
                'foto' => 'default.png',
                'nama_lengkap' => 'Kurnia Indah',
                'nama_panggilan' => 'Indah',
                'jabatan' => 'Developer',
                'tanggal_lahir' => Carbon::create('2000', '12', '05')->format('Y-m-d'),
                'kelamin' => 2, // Perempuan
                'alamat' => 'Jl. Pendopo No. 45, Karanganyar',
            ],
            [
                'foto' => 'default.png',
                'nama_lengkap' => 'Kahfi Nur',
                'nama_panggilan' => 'Kahfi',
                'jabatan' => 'Sekretaris',
                'tanggal_lahir' => Carbon::create('1995', '11', '21')->format('Y-m-d'),
                'kelamin' => 2, // Perempuan
                'alamat' => 'Jl. Jati No. 100, Karanganyar',
            ],
            [
                'foto' => 'default.png',
                'nama_lengkap' => 'Noviyan Indra',
                'nama_panggilan' => 'Indra',
                'jabatan' => 'CS',
                'tanggal_lahir' => Carbon::create('1995', '11', '09')->format('Y-m-d'),
                'kelamin' => 1, // Laki-laki
                'alamat' => 'Jl. Jumantono No. 11, Karanganyar',
            ],
            [
                'foto' => 'default.png',
                'nama_lengkap' => 'Marzuki Irawan',
                'nama_panggilan' => 'Zuki',
                'jabatan' => 'Desain Grafis',
                'tanggal_lahir' => Carbon::create('1995', '11', '09')->format('Y-m-d'),
                'kelamin' => 1, // Laki-laki
                'alamat' => 'Jl. Jumantono No. 55, Karanganyar',
            ],
        ];

        DB::table('pegawais')->insert($data);
    }
}
