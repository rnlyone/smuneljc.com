<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\Pages;
use App\Models\Pendaftar;
use App\Models\Pengurus;
use App\Models\Setting;
use App\Models\Socials;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create();
        Setting::factory()->count(9)->sequence(
            ['id' => '1', 'NamaSetting' => 'Tahun', 'Value' => '2022'],
            ['id' => '2', 'NamaSetting' => 'NoTelp', 'Value' => '081354000500'],
            ['id' => '3', 'NamaSetting' => 'Email', 'Value' => 'admin@smuneljc.com'],
            ['id' => '4', 'NamaSetting' => 'Alamat', 'Value' => 'Jl. Taman Makam Pahlawan, No. 3.'],
            ['id' => '5', 'NamaSetting' => 'VideoLink', 'Value' => 'https://www.youtube.com/embed/sfNtlzyya4g'],
            ['id' => '6', 'NamaSetting' => 'HeadText', 'Value' => 'Ekskul Jepang Tidak Biasa.'],
            ['id' => '7', 'NamaSetting' => 'SubHeadText', 'Value' => 'Smunel Japanese Community.'],
            ['id' => '8', 'NamaSetting' => 'KodeDaftar', 'Value' => 'SJC2022'],
            ['id' => '9', 'NamaSetting' => 'PesanDefault', 'Value' => 'Kamu telah terdaftar di Ekskul Smunel Japanese Community, Silahkan Klik Link Berikut untuk masuk ke Grup SJC.'],
            )->create();

        Pengurus::factory()->count(9)->sequence(
            ['id' => '1', 'Posisi' => 'Ketua Umum (部長)', 'NamaLengkap' => 'Shelyn Wina Fidelia',
             'ImagePath' => 'assetshome/img/persons/shelyn.jpg',
             'LinkedIn' => 'https://www.linkedin.com',
             'Discord' => 'http://discordapp.com/users/733611794387566622',
             'Instagram' => 'https://www.instagram.com/shelyn25_'],

             ['id' => '2', 'Posisi' => 'Koordinator Umum (課長)', 'NamaLengkap' => 'Andi Ayu Rahayu',
             'ImagePath' => 'assetshome/img/persons/ayu.jpg',
             'LinkedIn' => 'https://www.linkedin.com/in/andi-ayu-rahayu-9a6902244',
             'Discord' => 'http://discordapp.com/users/721603779463479316',
             'Instagram' => 'https://instagram.com/andiayurrahayu'],

             ['id' => '3', 'Posisi' => 'Sekertaris Umum', 'NamaLengkap' => 'Kayla Nurul Fatimah',
             'ImagePath' => 'assetshome/img/persons/kayla.jpg',
             'LinkedIn' => 'https://www.linkedin.com/in/kaylaa-nrl-615061245',
             'Discord' => 'https://discord.com/users/995886317357498389',
             'Instagram' => 'https://instagram.com/kaylarn21'],

             ['id' => '4', 'Posisi' => 'Wakil Sekertaris', 'NamaLengkap' => 'Rangga Afrianza',
             'ImagePath' => 'assetshome/img/persons/rangga.jpg',
             'LinkedIn' => 'https://www.linkedin.com/in/rangga-afrianza-426849244',
             'Discord' => 'https://discord.com/users/537200869117132800',
             'Instagram' => 'https://instagram.com/mgel.gt'],

             ['id' => '5', 'Posisi' => 'Bendahara Umum', 'NamaLengkap' => 'Aziziah Megga H.',
             'ImagePath' => 'assetshome/img/persons/egha.jpg',
             'LinkedIn' => 'https://www.linkedin.com/in/aziziah-megga-a3784b244',
             'Discord' => 'http://discordapp.com/users/875779712574713886',
             'Instagram' => 'https://www.instagram.com/egha.png/'],

             ['id' => '6', 'Posisi' => 'Wakil Bendahara', 'NamaLengkap' => 'Jessyca Natasya Kaunang',
             'ImagePath' => 'assetshome/img/persons/jeje.jpg',
             'LinkedIn' => ' https://www.linkedin.com/in/jessyca-natasya-kaunang-751848244',
             'Discord' => 'http://discordapp.com/users949007545253646336',
             'Instagram' => 'https://instagram.com/jscanatsha_'],

             ['id' => '7', 'Posisi' => 'Koordinator Divisi Hi (火)', 'NamaLengkap' => 'Raiqah Zulal Salimah',
             'ImagePath' => 'assetshome/img/persons/raika.jpg',
             'LinkedIn' => 'https://www.linkedin.com/in/raiqah-zulal-salimah-186a59244',
             'Discord' => 'http://discordapp.com/users/871008443153125428',
             'Instagram' => 'https://instagram.com/ree929109'],

             ['id' => '8', 'Posisi' => 'Koordinator Divisi Kaze (風)', 'NamaLengkap' => 'Sri Rezqy Buana Tungga',
             'ImagePath' => 'assetshome/img/persons/sri.jpg',
             'LinkedIn' => 'https://www.linkedin.com/in/sri-rezqy-buana-tungga-b00a61244/',
             'Discord' => 'https://discord.com/users/994991700923666534',
             'Instagram' => 'https://instagram.com/srirezqyy'],

             ['id' => '9', 'Posisi' => 'Koordinator Divisi Mizu (水)', 'NamaLengkap' => 'Aziziah Megga H.',
             'ImagePath' => 'assetshome/img/persons/egha.jpg',
             'LinkedIn' => 'https://www.linkedin.com/in/aziziah-megga-a3784b244',
             'Discord' => 'http://discordapp.com/users/875779712574713886',
             'Instagram' => 'https://www.instagram.com/egha.png/'],
        )->create();

        Gallery::factory()->count(6)->sequence(
            ['Author' => 'Puko1270', 'Title' => 'The Train', 'Category' => 'Illustration', 'ImagePath' => 'gallery/thetrain.jpg'],
            ['Author' => 'Yuu00__', 'Title' => 'Yuuraishi Yun', 'Category' => 'Illustration', 'ImagePath' => 'gallery/yuu.jpg'],
            ['Author' => 'Ryshanee_', 'Title' => 'Itsuha & Itsuki', 'Category' => 'FanArt', 'ImagePath' => 'gallery/itsuhaitsuki.jpg'],
            ['Author' => 'Triple AL', 'Title' => 'Lone Wolf', 'Category' => 'FanArt', 'ImagePath' => 'gallery/legosi.jpg'],
            ['Author' => 'Kiyaa', 'Title' => 'Man with Cat', 'Category' => 'FanArt','ImagePath' => 'gallery/manwithcat.jpg'],
            ['Author' => 'Codename:Mgel', 'Title' => 'Justice', 'Category' => 'Illustration','ImagePath' => 'gallery/Justice.jpg'],
        )->create();


        Socials::factory()->count(3)->sequence(
            ['Platform' => 'Instagram', 'Link' => 'https://www.instagram.com/smuneljc/'],
            ['Platform' => 'Facebook', 'Link' => 'https://facebook.com/smuneljc'],
            ['Platform' => 'Youtube', 'Link' => 'https://www.youtube.com/channel/UCFYVFtNKJkwGWSS2HD0BpCQ'],
        )->create();

        Pages::factory()->count(3)->sequence(
            ['PageName' => 'Alumni', 'Link' => 'https://alumni.smuneljc.com'],
            ['PageName' => 'Pendaftaran', 'Link' => 'https://smuneljc.com/daftar'],
            ['PageName' => 'Portal Pengurus', 'Link' => 'https://smuneljc.com/login'],
            ['PageName' => 'Tenji Kyanpu', 'Link' => 'https://tenji.smuneljc.com'],
        )->create();

        Pendaftar::factory()->count(3)->sequence(
            ['NamaLengkap' => 'Muhammad Nabil Taufik', 'NISN' => '1234567890', 'Kelas' => 'X Bahasa', 'JK' => 'pria',
             'NoWA' => '081354000500', 'Instagram' => 'muh.nabill_t', 'PIN' => '123456'],
            ['NamaLengkap' => 'Shelyn Wina Fidelia', 'NISN' => '2234567890', 'Kelas' => 'X Bahasa', 'JK' => 'wanita',
             'NoWA' => '081354000500', 'Instagram' => 'muh.nabill_t', 'PIN' => '123456'],
            ['NamaLengkap' => 'Rangga Afrianza', 'NISN' => '3234567890', 'Kelas' => 'X Bahasa', 'JK' => 'pria',
             'NoWA' => '081354000500', 'Instagram' => 'muh.nabill_t', 'PIN' => '123456'],
        )->create();
    }
}
