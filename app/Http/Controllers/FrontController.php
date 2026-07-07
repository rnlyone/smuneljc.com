<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Inovasi;
use App\Models\Pages;
use App\Models\Pengurus;
use App\Models\Periode;
use App\Models\Setting;
use App\Models\Socials;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FrontController extends Controller
{
    public function welcome()
    {
        $penguruses    = Pengurus::all();
        $settings      = Setting::all();
        $gallerys      = Gallery::all();
        $pages         = Pages::all();
        $socials       = Socials::all();
        $currentPeriode = Periode::latest('id')->first();
        $inovasis      = Inovasi::orderBy('urutan')->get();
        $testimonials  = Testimonial::latest()->get();

        return view('welcome', [
            'penguruses'     => $penguruses,
            'settings'       => $settings,
            'gallerys'       => $gallerys,
            'pages'          => $pages,
            'socials'        => $socials,
            'currentPeriode' => $currentPeriode,
            'inovasis'       => $inovasis,
            'testimonials'   => $testimonials,
        ]);
    }

    public function welcomeSetting()
    {
        $pagetitle    = 'Welcome Page Setting';
        $settings     = Setting::all();
        $galeri       = Gallery::latest()->get();
        $inovasis     = Inovasi::orderBy('urutan')->get();
        $testimonials = Testimonial::latest()->get();

        return view('auth.welcome-setting', compact(
            'pagetitle', 'settings', 'galeri', 'inovasis', 'testimonials'
        ));
    }

    public function kirimpesan(Request $request)
    {
        $notelp = Setting::find(2)->Value;
        $pesan = $request->pesan;
        $link = "https://api.whatsapp.com/send?phone=62".$notelp."&text=".$pesan;

        return redirect($link);
    }

    public function katsudohome()
    {
        #page_setup
        $customcss = '';
        $jmlsetting = Setting::all();
        $settings = ['title' => ': Home',
                    'customcss' => $customcss,
                    'pagetitle' => 'Home',
                    'navactive' => 'homenav',
                    'previous' => ''];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->NamaSetting] = $set->Value;
                    }
                    //  Auth::guard('pendaftar')->logout();

                    // dd(Auth::guard('pendaftar')->check());

        // Mendapatkan string lengkap
        $stringLengkap = Auth::guard('pendaftar')->user()->NamaLengkap;

        // Membagi string menjadi array kata
        $kata = explode(' ', $stringLengkap);

        // Mengambil kata pertama
        $nickname = $kata[0];

        // Menangani kasus khusus
        if (in_array($nickname, ["Muhammad", "Muhamad", "Muh."])) {
            // Jika kata pertama adalah salah satu dari kasus khusus, ambil kata kedua
            $nickname = $kata[1] ?? ''; // Jika tidak ada kata kedua, mengembalikan string kosong
        }

        // Sekarang $kataPertama berisi kata yang sesuai


        return view('katsudo.auth.home', [
            $settings['navactive'] => '-active-links',
            'nickname' => $nickname,
            'stgs' => $settings]);
    }
}
