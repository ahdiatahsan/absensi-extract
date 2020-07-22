<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Agenda;
use App\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use illuminate\Database\Eloquent\ModelNotFoundException;

class AbsensiController extends Controller
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
    public function index()
    {
        return view('absensi.index');
    }

    /**
     * Fungsi tabel absensi -> terpenuhi.
     *
     * @return \Illuminate\Http\Response
     */
    public function absensi_terpenuhi(Request $request)
    {
        if ($request->ajax()) {
            $absensis = Absensi::with('peserta', 'agenda')->where('status', '=', 'Terpenuhi')->get();

            return DataTables::of($absensis)
                ->addColumn('action', function ($absensi) {
                    return view('absensi.index_action', compact('absensi'))->render();
                })
                ->editColumn('tanggal', function ($absensi) {
                    return $absensi->jam_datang ? with(new Carbon($absensi->jam_datang))->format('d-m-Y') : '';
                })
                ->editColumn('jam_datang', function ($absensi) {
                    return $absensi->jam_datang ? with(new Carbon($absensi->jam_datang))->format('H:i:s') : '';
                })
                ->editColumn('jam_pulang', function ($absensi) {
                    return $absensi->jam_pulang ? with(new Carbon($absensi->jam_pulang))->format('H:i:s') : '';
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Fungsi tabel absensi -> belum terpenuhi.
     *
     * @return \Illuminate\Http\Response
     */
    public function absensi_belum_terpenuhi(Request $request)
    {
        if ($request->ajax()) {
            $absensis = Absensi::with('peserta', 'agenda')->where('status', '=', 'Belum Terpenuhi')->get();

            return DataTables::of($absensis)
                ->addColumn('action', function ($absensi) {
                    return view('absensi.index_action_confirm', compact('absensi'))->render();
                })
                ->editColumn('tanggal', function ($absensi) {
                    return $absensi->jam_datang ? with(new Carbon($absensi->jam_datang))->format('d-m-Y') : '';
                })
                ->editColumn('jam_datang', function ($absensi) {
                    return $absensi->jam_datang ? with(new Carbon($absensi->jam_datang))->format('H:i:s') : '';
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agendas = Agenda::orderBy('id')->get();
        return view('absensi.create', compact('agendas'));
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
            'noreg' => 'required|max:255',
            'agenda' => 'required|max:255',
        ]);

        try {
            $noreg = Peserta::select('id','noreg')->where('noreg', '=', $request->noreg)->firstorFail();
        } catch(ModelNotFoundException $err) {
            return redirect()->route('absensi.create')
            ->with('not_found', 'No. registrasi yang Anda masukkan tidak dapat ditemukan.');
        }

        //dd($noreg);

        $agenda = Agenda::findOrFail($request->agenda);
        $agenda_nama = Agenda::select('nama')->where('id', '=', $agenda->id)->get();

        Absensi::create([
            'peserta_id' => $noreg['id'],
            'agenda_id' => $request['agenda'],
            'jam_datang' => date('Y-m-d H:i:s'),
            'jam_pulang' => date('Y-m-d H:i:s'),
            'status' => 'Belum Terpenuhi'
        ]);

        return redirect()->route('absensi.create')
        ->with('success', 'Absensi no. registrasi ' . $request->noreg . '
                           pada agenda '. $agenda_nama[0]['nama'] . ' ( ' . date('d-m-Y')  .' ) telah ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi)
    {
        $peserta = Peserta::select('noreg')->where('id', '=', $absensi->peserta_id)->get();

        $agendas = Agenda::orderBy('id')->get();

        $selectedAgenda = Absensi::with('agenda')->select('agenda_id')
            ->where('agenda_id', '=', $absensi->agenda_id)->first();

        return view('absensi.edit', compact('absensi','agendas', 'selectedAgenda', 'peserta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi)
    {
        $request->validate([
            'agenda' => 'required|max:255',
        ]);

        $absensi->agenda_id = $request['agenda'];
        $absensi->save();

        $tanggal = (new Carbon($request['tanggal']))->format('d-m-Y');
        $agenda_new = Agenda::select('nama')->where('id', '=', $request['agenda'])->get();

        return redirect()->route('absensi.index')
        ->with('success', 'Absensi no. registrasi ' . $request['noreg'] . ' pada agenda '. $request['old_agenda'] . ' - ' . $tanggal .
        ' telah diubah menjadi agenda ' . $agenda_new[0]['nama'] . ' .');
    }

    /**
     * Konfirmasi absen - jam pulang.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function absensi_konfirmasi(Request $request, Absensi $absensi)
    {
        $absensi->jam_pulang = date('Y-m-d H:i:s');
        $absensi->status = 'Terpenuhi';
        $absensi->save();

        $tanggal = (new Carbon($absensi->jam_datang))->format('d-m-Y');
        $noreg = Peserta::select('noreg')->where('id', '=', $absensi->peserta_id)->get();
        $agenda = Agenda::select('nama')->where('id', '=', $absensi->agenda_id)->get();

        return redirect()->route('absensi.index')
        ->with('success', 'Absensi no. registrasi' . $noreg[0]['noreg'] . ' pada agenda '. $agenda[0]['nama'] . ' - ' . $tanggal .
        ' telah dikonfimasi jam pulangnya.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $absensi = Absensi::with('peserta', 'agenda')->findOrFail($id);
        $tanggal = (new Carbon($absensi->jam_datang))->format('d-m-Y');
        $absensi->delete();

        return redirect()->route('absensi.index')
        ->with('success', 'Absensi (' . $absensi->peserta->noreg . ') ' . $absensi->peserta->nama .
                          ' pada agenda '. $absensi->agenda->nama . ' ( ' . $tanggal .' ) telah dihapus.');
    }
}
