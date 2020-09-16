@extends('layouts.admin.app')

@section('title', 'Tambah Peserta')

@section('subheader')

<h3 class="kt-subheader__title">
    Peserta
</h3>
<span class="kt-subheader__separator kt-hidden"></span>
<div class="kt-subheader__breadcrumbs">
    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="" class="kt-subheader__breadcrumbs-link">
        Tambah Data Peserta </a>
    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
</div>

@endsection

@section('content')

<div class="row justify-content-center">
  <div class="col-9">
    @include('layouts.admin.alert')
  </div>
</div>

<form action="{{ route('peserta.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
  @csrf
  <div class="row justify-content-center">
    <div class="col-lg-9 col-md-9 col-sm-12">
      <div class="kt-portlet">
        <div class="kt-portlet__body">

          <div class="form-group">
            <label>No. Registrasi</label>
            <input class="form-control @error('noreg') is-invalid @enderror" type="text"
                name="noreg" id="noreg" value="{{ old('noreg') }}" placeholder="001" required autofocus>
          </div>

          <div class="form-group">
            <label>Nama Lengkap</label>
            <input class="form-control @error('nama') is-invalid @enderror" type="text"
                name="nama" id="nama" value="{{ old('nama') }}" placeholder="Tyler Otwell" required>
          </div>

          <div class="form-group">
            <label>Konsentrasi</label>
            <select class="form-control @error('konsentrasi') is-invalid @enderror" id="konsentrasi"
                name="konsentrasi" required>
                @foreach ($konsentrasis as $konsentrasi)
                <option value="{{ $konsentrasi->id }}">
                    {{ $konsentrasi->nama }}
                </option>
                @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>Hari Agenda Menginap</label>
            <select class="form-control @error('menginap') is-invalid @enderror" id="menginap"
                name="menginap" required>
                <option value="Belum Ada" selected>Belum Ada</option>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
                <option value="Minggu">Minggu</option>
            </select>
          </div>

        </div>

        <div class="kt-portlet__foot">
          <div class="row align-items-center">
            <div class="col-12 kt-align-center">
              <button type="submit" class="btn btn-success">
                <i class="fa fa-plus"></i>
                Tambah Data
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

@endsection

