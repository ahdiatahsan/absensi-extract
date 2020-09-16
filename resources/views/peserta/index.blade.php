@extends('layouts.admin.app')

@section('title', 'Peserta')

@section('page_style')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('subheader')

<h3 class="kt-subheader__title">
    Peserta
</h3>
<span class="kt-subheader__separator kt-hidden"></span>
<div class="kt-subheader__breadcrumbs">
    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="" class="kt-subheader__breadcrumbs-link">
        Tabel Data Peserta </a>
    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
</div>

@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-12">
        @include('layouts.admin.alert')
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-12">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <span class="kt-font-brand">
                            <span class="kt-menu__link-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <path
                                            d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        <path
                                            d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                            fill="#000000" fill-rule="nonzero" />
                                    </g>
                                </svg>
                            </span>
                        </span>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Tabel Data Peserta
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            &nbsp;
                            <a href="{{ route("peserta.create") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                Tambah Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="table-responsive">
                <!--begin: Datatable -->
                <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="table"
                    role="grid" aria-describedby="table">
                    <thead>
                        <tr>
                            <th>No. Registrasi</th>
                            <th>Nama Lengkap</th>
                            <th>Konsentrasi</th>
                            <th>Hari Agenda Menginap</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
                </div>
                <!--end: Datatable -->
            </div>
        </div>
    </div>
</div>

@endsection

@section('page_script')
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
    $(document).ready(function () {
      $('.dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('peserta.index') }}",
        columns: [
          {data: 'noreg', name: 'noreg'},
          {data: 'nama', name: 'nama'},
          {data: 'konsentrasi.nama', name: 'konsentrasi.nama'},
          {data: 'menginap', name: 'menginap'},
          {data: 'action', name: 'action'},
        ],
        columnDefs: [
          {
            className: 'text-center',
            targets: [0,4],
          },
        ],
        pagingType: "full_numbers"
      });
    });
</script>
@endsection
