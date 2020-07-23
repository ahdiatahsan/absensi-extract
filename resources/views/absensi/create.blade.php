@extends('layouts.admin.app')

@section('title', 'Tambah Absensi')

@section('subheader')

<h3 class="kt-subheader__title">
    Absensi
</h3>
<span class="kt-subheader__separator kt-hidden"></span>
<div class="kt-subheader__breadcrumbs">
    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="" class="kt-subheader__breadcrumbs-link">
        Tambah Data Absensi </a>
    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
</div>

@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-9">
        @include('layouts.admin.alert')
    </div>
</div>

<form action="{{ route('absensi.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-9 col-sm-12">
            <div class="kt-portlet">
                <div class="kt-portlet__body">

                    <div class="form-group">
                        <label>Agenda</label>
                        <select class="form-control @error('agenda') is-invalid @enderror" id="agenda"
                            name="agenda" required>
                            @foreach ($agendas as $agenda)
                                <option value="{{ $agenda->id }}" {{ (old('agenda') == $agenda->id) ? 'selected' : '' }}>
                                    {{ $agenda->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>No. Registrasi</label>
                        <input class="form-control @error('noreg') is-invalid @enderror" type="text" name="noreg"
                            id="noreg" required autofocus>
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
