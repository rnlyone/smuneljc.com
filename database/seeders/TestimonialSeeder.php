<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        // Only seed if table is empty — prevents duplicate defaults
        if (Testimonial::count() > 0) {
            return;
        }

        Testimonial::insert([
            [
                'nama'       => 'Rosneneng Juanda',
                'peran'      => 'Guru Bahasa Jepang SMAN 5 Makassar',
                // Uses existing static asset — no conflict with uploads in images/testimonial/
                'image_path' => 'assetshome/img/persons/rossensei.png',
                'kutipan'    => 'Smunel Japanese Community adalah ekstrakulikuler tepat untuk mengembangkan diri dalam hal budaya Jepang karena memiliki lingkungan sosial yang baik serta progresif.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama'       => 'Muhammad Nabil Taufik',
                'peran'      => 'Mahasiswa Sastra Jepang UNHAS',
                // Uses existing static asset — no conflict with uploads in images/testimonial/
                'image_path' => 'assetshome/img/persons/nabil.png',
                'kutipan'    => 'Jujur, SJC telah menjadi tempat terbaik ku mengembangkan diri. Terima kasih telah memberikan saya tempat dan kesempatan untuk berkembang.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
