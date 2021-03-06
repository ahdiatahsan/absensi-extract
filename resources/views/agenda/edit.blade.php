@extends('layouts.admin.app')

@section('title', 'Ubah Agenda')

@section('subheader')

<h3 class="kt-subheader__title">
    Agenda
</h3>
<span class="kt-subheader__separator kt-hidden"></span>
<div class="kt-subheader__breadcrumbs">
    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="" class="kt-subheader__breadcrumbs-link">
        Ubah Data Agenda </a>
    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
</div>

@endsection

@section('content')

<div class="row justify-content-center">
  <div class="col-9">
    @include('layouts.admin.alert')
  </div>
</div>

<form action="{{ route('agenda.update', $agenda->id) }}" method="POST" enctype="multipart/form-data"
  autocomplete="off">
  @csrf
  @method('PATCH')
  <div class="row justify-content-center">
    <div class="col-lg-9 col-md-9 col-sm-12">
      <div class="kt-portlet">
        <div class="kt-portlet__body">
          <div class="form-group">
            <label>Nama Agenda</label>
            <input type="hidden" name="old_nama" value="{{ $agenda->nama }}">
            <input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama" id="nama"
                value="{{ $agenda->nama }}" required autofocus>
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
