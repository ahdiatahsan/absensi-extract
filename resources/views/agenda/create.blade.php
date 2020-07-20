@extends('layouts.admin.app')

@section('title', 'Tambah Agenda')

@section('subheader')

<h3 class="kt-subheader__title">
    Agenda
</h3>
<span class="kt-subheader__separator kt-hidden"></span>
<div class="kt-subheader__breadcrumbs">
    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="" class="kt-subheader__breadcrumbs-link">
        Tambah Data Agenda </a>
    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
</div>

@endsection

@section('content')

<div class="row justify-content-center">
  <div class="col-9">
    @include('layouts.admin.alert')
  </div>
</div>

<form action="{{ route('agenda.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
  @csrf
  <div class="row justify-content-center">
    <div class="col-lg-9 col-md-9 col-sm-12">
      <div class="kt-portlet">
        <div class="kt-portlet__body">
          <div class="form-group">
            <label>Nama Agenda</label>
            <input class="form-control @error('nama') is-invalid @enderror" type="text"
                name="nama" id="nama" placeholder="Pembelajaran Program"
                value="{{ old('nama') }}" required autofocus>
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
