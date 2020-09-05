<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $peserta = DB::table('pesertas')->count();
        $konsentrasi = DB::table('konsentrasis')->count();
        $agenda = DB::table('agendas')->count();
        $tahap = DB::table('tahaps')->count();

        return view('home', compact(
            'peserta',
            'konsentrasi',
            'agenda',
            'tahap'
        ));
    }
}
