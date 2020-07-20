<?php

namespace App\Http\Controllers;

use App\Konsentrasi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KonsentrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $konsentrasis = Konsentrasi::get();

            return DataTables::of($konsentrasis)
                ->addColumn('action', function ($konsentrasi) {
                    return view('konsentrasi.index_action', compact('konsentrasi'))->render();
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('konsentrasi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('konsentrasi.create');
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
            'nama' => 'required|max:255'
        ]);

        Konsentrasi::create([
            'nama' => $request['nama']
        ]);

        return redirect()->route('konsentrasi.index')->with('success', 'Konsentrasi ' . $request['nama'] . ' telah ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Konsentrasi  $konsentrasi
     * @return \Illuminate\Http\Response
     */
    public function show(Konsentrasi $konsentrasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Konsentrasi  $konsentrasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Konsentrasi $konsentrasi)
    {
        return view('konsentrasi.edit', compact('konsentrasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Konsentrasi  $konsentrasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Konsentrasi $konsentrasi)
    {
        $request->validate([
            'nama' => 'required|max:255'
        ]);

        $konsentrasi->nama = $request['nama'];
        $konsentrasi->save();

        return redirect()->route('konsentrasi.index')->with('success', 'Konsentrasi ' . $request['old_nama'] . ' telah diubah menjadi ' . $request['nama'] . '.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Konsentrasi  $konsentrasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Konsentrasi $konsentrasi)
    {
        $konsentrasi->delete();

        return redirect()->route('konsentrasi.index')->with('success', 'Konsentrasi ' . $konsentrasi->nama . ' telah dihapus.');
    }
}
