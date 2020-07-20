@extends('layouts.admin.app')

@section('title', 'Ubah Peserta')

@section('subheader')

<h3 class="kt-subheader__title">
    Peserta
</h3>
<span class="kt-subheader__separator kt-hidden"></span>
<div class="kt-subheader__breadcrumbs">
    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="" class="kt-subheader__breadcrumbs-link">
        Ubah Data Peserta </a>
    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
</div>

@endsection

@section('content')

<div class="row justify-content-center">
  <div class="col-9">
    @include('layouts.admin.alert')
  </div>
</div>

<form action="{{ route('peserta.update', $peserta->id) }}" method="POST" enctype="multipart/form-data"
  autocomplete="off">
  @csrf
  @method('PATCH')
  <div class="row justify-content-center">
    <div class="col-lg-9 col-md-9 col-sm-12">
      <div class="kt-portlet">
        <div class="kt-portlet__body">
          <div class="form-group">
            <label>No. Registrasi</label>
            <input type="hidden" name="old_noreg" value="{{ $peserta->noreg }}">
            <input class="form-control @error('noreg') is-invalid @enderror" type="text"
                name="noreg" id="noreg" value="{{ $peserta->noreg }}" required autofocus>
          </div>

          <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="hidden" name="old_nama" value="{{ $peserta->nama }}">
            <input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama" id="nama"
                value="{{ $peserta->nama }}" required>
          </div>

          <div class="form-group">
            <label>Konsentrasi</label>
            <select class="form-control @error('konsentrasi') is-invalid @enderror" id="konsentrasi"
                name="konsentrasi" required>
                @foreach ($konsentrasis as $konsentrasi)
                <option value="{{ $konsentrasi->id }}" {{ ($konsentrasi->id == $selectedKonsentrasi->konsentrasi_id) ? 'selected' : '' }}>
                    {{ $konsentrasi->nama }}
                </option>
                @endforeach
            </select>
          </div>

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
