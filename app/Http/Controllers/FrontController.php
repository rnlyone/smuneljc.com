<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Pages;
use App\Models\Pengurus;
use App\Models\Setting;
use App\Models\Socials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FrontController extends Controller
{
    public function welcome()
    {
        $penguruses = Pengurus::all();
        $settings = Setting::all();
        $gallerys = Gallery::all();
        $pages = Pages::all();
        $socials = Socials::all();
        return view('welcome', [
            'penguruses' => $penguruses,
            'settings' => $settings,
            'gallerys' => $gallerys,
            'pages' => $pages,
            'socials' => $socials
        ]);
    }

    public function kirimpesan(Request $request)
    {
        $notelp = Setting::find(2)->Value;
        $pesan = $request->pesan;
        $link = "https://api.whatsapp.com/send?phone=62".$notelp."&text=".$pesan;

        return redirect($link);
    }
}
