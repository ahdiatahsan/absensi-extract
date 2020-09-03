@extends('layouts.admin.app')

@section('title', 'Ubah Absensi')

@section('subheader')

<h3 class="kt-subheader__title">
    Absensi
</h3>
<span class="kt-subheader__separator kt-hidden"></span>
<div class="kt-subheader__breadcrumbs">
    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="" class="kt-subheader__breadcrumbs-link">
        Ubah Data Absensi </a>
    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
</div>

@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-9">
        @include('layouts.admin.alert')
    </div>
</div>

<form action="{{ route('absensi.update', $absensi->id) }}" method="POST" enctype="multipart/form-data"
    autocomplete="off">
    @csrf
    @method('PATCH')
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-9 col-sm-12">
            <div class="kt-portlet">
                <div class="kt-portlet__body">

                    <div class="form-group">
                        <label>No. Registrasi</label>
                        <input class="form-control" type="text" name="noreg_show"
                            id="noreg_show" value="{{ $peserta[0]['noreg'] }}" disabled>

                        <input class="form-control @error('noreg') is-invalid @enderror" type="text" name="noreg"
                            id="noreg" value="{{ $peserta[0]['noreg'] }}" hidden>

                        <input class="form-control @error('tanggal') is-invalid @enderror" type="text" name="tanggal"
                            id="tanggal" value="{{ $absensi->jam_datang }}" hidden>

                        <input class="form-control @error('old_tahap') is-invalid @enderror" type="text" name="old_tahap"
                            id="old_tahap" value="{{ $absensi->tahap->nama }}" hidden>

                        <input class="form-control @error('old_agenda') is-invalid @enderror" type="text" name="old_agenda"
                            id="old_agenda" value="{{ $absensi->agenda->nama }}" hidden>

                    </div>

                    <div class="form-group">
                        <label>Tahap</label>
                        <select class="form-control @error('tahap') is-invalid @enderror" id="tahap"
                            name="tahap" required>
                            @foreach ($tahaps as $tahap)
                            <option value="{{ $tahap->id }}"
                                {{ ($tahap->id == $selectedTahap->tahap_id) ? 'selected' : '' }}>
                                {{ $tahap->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Agenda</label>
                        <select class="form-control @error('agenda') is-invalid @enderror" id="agenda"
                            name="agenda" required>
                            @foreach ($agendas as $agenda)
                            <option value="{{ $agenda->id }}"
                                {{ ($agenda->id == $selectedAgenda->agenda_id) ? 'selected' : '' }}>
                                {{ $agenda->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="kt-portlet__foot">
                        <div class="row align-items-center">
                            <div class="col-12 kt-align-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                    Ubah Data
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</form>
@endsection
