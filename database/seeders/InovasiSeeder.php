<?php

namespace Database\Seeders;

use App\Models\Inovasi;
use Illuminate\Database\Seeder;

class InovasiSeeder extends Seeder
{
    public function run()
    {
        // Only seed if table is empty — prevents duplicate defaults
        if (Inovasi::count() > 0) {
            return;
        }

        Inovasi::insert([
            [
                'judul'      => 'Gakuensai ditayangkan live di Gakuensai App.',
                'subjudul'   => 'Gakuensai 2023',
                'link'       => 'https://gakuensai.smuneljc.com',
                // Uses existing static asset — no conflict with uploads in images/inovasi/
                'image_path' => 'assetshome/img/agency/0321.png',
                'video_link' => null,
                'urutan'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul'      => 'Aplikasi Web Gakuensai.',
                'subjudul'   => 'Gakuensai 2023',
                'link'       => 'https://gakuensai.smuneljc.com',
                // Uses existing static asset — no conflict with uploads in images/inovasi/
                'image_path' => 'assetshome/img/agency/097.png',
                'video_link' => 'https://www.youtube.com/watch?v=sfNtlzyya4g&t=46s',
                'urutan'     => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
