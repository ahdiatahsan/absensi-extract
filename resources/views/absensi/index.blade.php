@extends('layouts.admin.app')

@section('title', 'Absensi')

@section('page_style')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('subheader')

<h3 class="kt-subheader__title">
    Absensi
</h3>
<span class="kt-subheader__separator kt-hidden"></span>
<div class="kt-subheader__breadcrumbs">
    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="" class="kt-subheader__breadcrumbs-link">
        Tabel Data Absensi </a>
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
                                        d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z"
                                        fill="#000000" />
                                    <path
                                        d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                        fill="#000000" />
                                </g>
                            </svg>
                        </span>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Tabel Data Absensi
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            &nbsp;
                            <a href="{{ route("absensi.create") }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                Tambah Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group row">
                            <label for="filter_tahap" class="col-sm-6 col-md-4 col-form-label">Pilih Tahap Extract :</label>
                            <div class="col-8">
                                <select class="form-control" name="filter_tahap" id="filter_tahap" required>
                                    <option value="" selected hidden>- Pilih Tahap Extract -</option>
                                    @foreach ($tahaps as $tahap)
                                        <option value="{{ $tahap->id }}">
                                            {{ $tahap->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <button type="button" name="filter" id="filter" class="btn btn-success">Filter</button>
                            <button type="button" name="reset" id="reset" class="btn btn-danger">Reset</button>
                        </div>
                    </div>
                </div>

                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-2x nav-tabs-line-success" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#belum" role="tab">Belum Absen Pulang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#terpenuhi" role="tab">Absen Terpenuhi</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="belum" role="tabpanel">
                        <div class="table-responsive">
                            <!--begin: Datatable -->
                            <table class="table table-striped table-bordered table-hover belum no-footer dtr-inline"
                                id="tabel_belum" role="grid" aria-describedby="table" width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>No. Registrasi</th>
                                        <th>Nama Lengkap</th>
                                        <th>Agenda</th>
                                        <th>Tanggal</th>
                                        <th>Jam Datang</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                            <!--end: Datatable -->
                        </div>
                    </div>
                    <div class="tab-pane" id="terpenuhi" role="tabpanel">
                        <div class="table-responsive">
                            <!--begin: Datatable -->
                            <table class="table table-striped table-bordered table-hover terpenuhi no-footer dtr-inline"
                                id="tabel_terpenuhi" role="grid" aria-describedby="table" width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>No. Registrasi</th>
                                        <th>Nama Lengkap</th>
                                        <th>Agenda</th>
                                        <th>Tanggal</th>
                                        <th>Jam Datang</th>
                                        <th>Jam Pulang</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                            <!--end: Datatable -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page_script')
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
    $(document).ready(function () {

        fill_datatable();

        function fill_datatable(filter_tahap = '') {
            //datatable-belum-absen-pulang
            var dataTable1 = $('#tabel_belum').DataTable({
                processing: true,
                serverSide: true,
                dom: 'Bfrtip',
                buttons: [
                    {extend: 'pageLength'},
                    {extend: 'excel', exportOptions: { columns: [ 0, 1, 2, 3, 4, 5 ] } },
                ],
                ajax: {
                        "url"  : "{{ route('absensi_belum_terpenuhi') }}",
                        "data" : {filter_tahap:filter_tahap}
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'peserta.noreg', name: 'peserta.noreg'},
                    {data: 'peserta.nama', name: 'peserta.nama'},
                    {data: 'agenda.nama', name: 'agenda.nama'},
                    {data: 'tanggal', name: 'tanggal'},
                    {data: 'jam_datang', name: 'jam_datang'},
                    {data: 'action', name: 'action'},
                ],
                columnDefs: [
                    {
                    className: 'text-center',
                    targets: [0,6],
                    },
                ],
                pagingType: "full_numbers"
            });

            //datatable-absen-terpenuhi
            var dataTable2 = $('#tabel_terpenuhi').DataTable({
                processing: true,
                serverSide: true,
                dom: 'Bfrtip',
                buttons: [
                    {extend: 'pageLength'},
                    {extend: 'excel', exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6 ] } },
                ],
                ajax: {
                    "url"  : "{{ route('absensi_terpenuhi') }}",
                    "data" : {filter_tahap:filter_tahap}
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'peserta.noreg', name: 'peserta.noreg'},
                    {data: 'peserta.nama', name: 'peserta.nama'},
                    {data: 'agenda.nama', name: 'agenda.nama'},
                    {data: 'tanggal', name: 'tanggal'},
                    {data: 'jam_datang', name: 'jam_datang'},
                    {data: 'jam_pulang', name: 'jam_pulang'},
                    {data: 'action', name: 'action'},
                ],
                columnDefs: [
                    {
                    className: 'text-center',
                    targets: [0,7],
                    },
                ],
                pagingType: "full_numbers"
            });
        }

        //filter-button
        $('#filter').click(function(){
            var filter_tahap = $('#filter_tahap').val();
            if (filter_tahap != '') {
                $('#tabel_belum').DataTable().destroy();
                $('#tabel_terpenuhi').DataTable().destroy();
                fill_datatable(filter_tahap);
            } else {
                alert('Pilih filter tahap extract yang datanya ingin ditampilkan!');
            }
        })

        //reset-button
        $('#reset').click(function(){
            $('#filter_tahap').val('');
            $('#tabel_belum').DataTable().destroy();
            $('#tabel_terpenuhi').DataTable().destroy();
            fill_datatable();
        })

    });
</script>
@endsection
