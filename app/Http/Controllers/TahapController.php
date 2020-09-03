<?php

namespace App\Http\Controllers;

use App\Tahap;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TahapController extends Controller
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
            $tahaps = Tahap::get();

            return DataTables::of($tahaps)
                ->addColumn('action', function ($tahap) {
                    return view('tahap.index_action', compact('tahap'))->render();
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('tahap.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tahap.create');
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

        Tahap::create([
            'nama' => $request['nama']
        ]);

        return redirect()->route('tahap.index')->with('success', 'Tahap -> ' . $request['nama'] . ' telah ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tahap  $tahap
     * @return \Illuminate\Http\Response
     */
    public function show(Tahap $tahap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tahap  $tahap
     * @return \Illuminate\Http\Response
     */
    public function edit(Tahap $tahap)
    {
        return view('tahap.edit', compact('tahap'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tahap  $tahap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tahap $tahap)
    {
        $request->validate([
            'nama' => 'required|max:255'
        ]);

        $tahap->nama = $request['nama'];
        $tahap->save();

        return redirect()->route('tahap.index')->with('success', $request['old_nama'] . ' telah diubah menjadi ' . $request['nama'] . '.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tahap  $tahap
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tahap $tahap)
    {
        $tahap->delete();

        return redirect()->route('tahap.index')->with('success', 'Tahap -> ' . $tahap->nama . ' telah dihapus.');
    }
}
