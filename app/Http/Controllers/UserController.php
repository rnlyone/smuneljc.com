<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function indexLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        $attr = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        if (Auth::attempt($attr)){
            Auth::login($user);
        return redirect()->intended('/dash')->with('sukses', "Login Sukses");
        } else {
            return back()->with('gagal', 'Username / Password Salah!');
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->intended('/login')->with('sukses', 'logout berhasil');
    }

    public function indexDash()
    {
        $pagetitle = 'dashboard';

        #barchart
        $years = json_encode([2017, 2018, 2019, 2020, 2021, 2022]);
        $total2022 = Pendaftar::all()->count();
        $totaldaftar = json_encode([32, 19, 27, 20, 41, $total2022]);

        #doughnutchart
        try {
            $pria = Pendaftar::where('JK', 'pria')->count() / $total2022 * 100;
        } catch (\Throwable $th) {
            $pria = 0;
        }

        try {
            $wanita = Pendaftar::where('JK', 'wanita')->count() / $total2022 * 100;
        } catch (\Throwable $th) {
            $wanita = 0;
        }
        $p = Pendaftar::where('JK', 'pria')->count();
        $w = Pendaftar::where('JK', 'wanita')->count();
        $datajk = json_encode([$pria, $wanita]);

        $latest5 = Pendaftar::orderBy('id', 'desc')->take(5)->get();

        $pesandefault = Setting::where('NamaSetting', 'PesanDefault')->first();





        return view('auth.dashboard', [
            'pagetitle' => $pagetitle,
            'years' => $years,
            'totaldaftar' => $totaldaftar,
            'total2022' => $total2022,
            'datajk' => $datajk,
            'totalp' => $p,
            'totalw' => $w,
            'latest5' => $latest5,
            'pesandefault' => $pesandefault]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
