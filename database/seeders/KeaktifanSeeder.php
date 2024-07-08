<?php

namespace Database\Seeders;

use App\Models\Keaktifan;
use App\Models\Pendaftar;
use App\Models\Periode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeaktifanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pendaftars = Pendaftar::all();

        foreach ($pendaftars as $pendaftar) {
            Keaktifan::create([
                'id_anggota' => $pendaftar->id,
                'id_periode' => Periode::latest()->first()->id,
                // Isi data lain sesuai kebutuhan Anda
            ]);
        }
    }
}
