<?php

namespace App\Http\Controllers;

use App\Konsentrasi;
use App\Peserta;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PesertaController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pesertas = Peserta::with('konsentrasi')->get();

            return DataTables::of($pesertas)
                ->addColumn('action', function ($peserta) {
                    return view('peserta.index_action', compact('peserta'))->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('peserta.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $konsentrasis = Konsentrasi::orderBy('id')->get();
        return view('peserta.create', compact('konsentrasis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'noreg' => 'required|max:255|unique:pesertas,noreg',
            'nama' => 'required|max:255',
            'konsentrasi' => 'required|max:255',
        ]);

        Peserta::create([
            'noreg' => $request['noreg'],
            'nama' => $request['nama'],
            'konsentrasi_id' => $request['konsentrasi']
        ]);

        return redirect()->route('peserta.index')->with('success', 'Peserta (' . $request['noreg'] . ') ' . $request['nama'] . ' telah ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function show(Peserta $peserta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function edit(Peserta $peserta)
    {
        $konsentrasis = Konsentrasi::orderBy('id')->get();

        $selectedKonsentrasi = Peserta::select('konsentrasi_id')
            ->where('konsentrasi_id', '=', $peserta->konsentrasi_id)->first();

        return view('peserta.edit', compact('peserta','konsentrasis', 'selectedKonsentrasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peserta $peserta)
    {
        $request->validate([
            'noreg' => "required|max:255|unique:pesertas,noreg,$peserta->id",
            'nama' => 'required|max:255',
            'konsentrasi' => 'required|max:255'
        ]);

        $peserta->noreg = $request['noreg'];
        $peserta->nama = $request['nama'];
        $peserta->konsentrasi_id = $request['konsentrasi'];
        $peserta->save();

        return redirect()->route('peserta.index')
        ->with('success', 'Peserta (' . $request['old_noreg'] . ') ' . $request['old_nama'] . ' telah diubah menjadi (' . $request['noreg'] . ') ' . $request['nama'] . '.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peserta $peserta)
    {
        $peserta->delete();

        return redirect()->route('peserta.index')->with('success', 'Peserta (' . $peserta->noreg . ') ' . $peserta->nama . ' telah dihapus.');
    }
}
