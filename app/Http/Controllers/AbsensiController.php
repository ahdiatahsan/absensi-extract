<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Agenda;
use App\Peserta;
use App\Tahap;
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
        $tahaps = Tahap::orderBy('id')->get();
        return view('absensi.index', compact('tahaps'));
    }

    /**
     * Fungsi tabel absensi -> terpenuhi.
     *
     * @return \Illuminate\Http\Response
     */
    public function absensi_terpenuhi(Request $request)
    {
        if ($request->ajax()) {

            if (!empty($request->filter_tahap)) {
                $absensis = Absensi::with('peserta', 'agenda')
                            ->where('status', '=', 'Terpenuhi')
                            ->where('tahap_id', '=', $request->filter_tahap)
                            ->get();
            }
            else {
                $absensis = Absensi::with('peserta', 'agenda')
                            ->where('status', '=', 'Terpenuhi')
                            ->get();
            }

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

            if (!empty($request->filter_tahap)) {
                $absensis = Absensi::with('peserta', 'agenda')
                            ->where('status', '=', 'Belum Terpenuhi')
                            ->where('tahap_id', '=', $request->filter_tahap)
                            ->get();
            }
            else {
                $absensis = Absensi::with('peserta', 'agenda')
                            ->where('status', '=', 'Belum Terpenuhi')
                            ->get();
            }
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
        $tahaps = Tahap::orderBy('id')->get();
        return view('absensi.create', compact('agendas', 'tahaps'));
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
            'tahap' => 'required|max:255',
            'agenda' => 'required|max:255',
        ]);

        try {
            $noreg = Peserta::select('id','noreg')->where('noreg', '=', $request->noreg)->firstorFail();
        } catch(ModelNotFoundException $err) {
            return redirect()->route('absensi.create')
            ->with('not_found', 'No. registrasi yang Anda masukkan tidak dapat ditemukan.');
        }

        $agenda = Agenda::findOrFail($request->agenda);
        $agenda_nama = Agenda::select('nama')->where('id', '=', $agenda->id)->get();

        $tahap = Tahap::findOrFail($request->tahap);
        $tahap_nama = Tahap::select('nama')->where('id', '=', $tahap->id)->get();

        Absensi::create([
            'peserta_id' => $noreg['id'],
            'tahap_id' => $request['tahap'],
            'agenda_id' => $request['agenda'],
            'jam_datang' => date('Y-m-d H:i:s'),
            'jam_pulang' => date('Y-m-d H:i:s'),
            'status' => 'Belum Terpenuhi'
        ]);

        return redirect()->route('absensi.create')
        ->withInput()
        ->with('success', 'Absensi '. $tahap_nama[0]['nama'] .' oleh no. registrasi ' . $request->noreg . '
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

        $tahaps = Tahap::orderBy('id')->get();
        $selectedTahap = Absensi::with('tahap')->select('tahap_id')
            ->where('tahap_id', '=', $absensi->tahap_id)->first();

        return view('absensi.edit', compact('absensi', 'agendas', 'selectedAgenda', 'tahaps', 'selectedTahap', 'peserta'));
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
            'tahap' => 'required|max:255',
            'agenda' => 'required|max:255',
        ]);

        $absensi->tahap_id = $request['tahap'];
        $absensi->agenda_id = $request['agenda'];
        $absensi->save();

        $tanggal = (new Carbon($request['tanggal']))->format('d-m-Y');

        return redirect()->route('absensi.index')
        ->with('success', 'Data absensi peserta no. registrasi ' . $request['noreg'] . ' pada agenda '. $request['old_agenda'] . ' - ' . $tanggal .
               ' , ' . $request['old_tahap'] .' berhasil diubah.');
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
        $tahap = Tahap::select('nama')->where('id', '=', $absensi->tahap_id)->get();

        return redirect()->route('absensi.index')
        ->with('success', 'Absensi '. $tahap[0]['nama'] .' no. registrasi' . $noreg[0]['noreg'] . ' pada agenda '. $agenda[0]['nama'] . ' - ' . $tanggal .
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
        $absensi = Absensi::with('peserta', 'agenda', 'tahap')->findOrFail($id);
        $tanggal = (new Carbon($absensi->jam_datang))->format('d-m-Y');
        $absensi->delete();

        return redirect()->route('absensi.index')
        ->with('success', 'Absensi '. $absensi->tahap->nama .' oleh (' . $absensi->peserta->noreg . ') ' . $absensi->peserta->nama .
                          ' pada agenda '. $absensi->agenda->nama . ' ( ' . $tanggal .' ) telah dihapus.');
    }
}
