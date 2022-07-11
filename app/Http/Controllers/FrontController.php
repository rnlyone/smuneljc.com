<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Pages;
use App\Models\Pengurus;
use App\Models\Setting;
use App\Models\Socials;
use Illuminate\Http\Request;

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
}
