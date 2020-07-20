@extends('layouts.admin.app')

@section('title', 'Agenda')

@section('page_style')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('subheader')

<h3 class="kt-subheader__title">
    Agenda
</h3>
<span class="kt-subheader__separator kt-hidden"></span>
<div class="kt-subheader__breadcrumbs">
    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="" class="kt-subheader__breadcrumbs-link">
        Tabel Data Agenda </a>
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
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                        fill="#000000" />
                                    <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1" />
                                    <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1" />
                                </g>
                            </svg>
                        </span>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Tabel Data Agenda
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            &nbsp;
                            <a href="{{ route("agenda.create") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                Tambah Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="table"
                    role="grid" aria-describedby="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Agenda</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>

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
        ajax: "{{ route('agenda.index') }}",
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'nama', name: 'nama'},
          {data: 'action', name: 'action'},
        ],
        columnDefs: [
          {
            className: 'text-center',
            targets: [0,2],
          },
        ],
        pagingType: "full_numbers"
      });
    });
</script>
@endsection
