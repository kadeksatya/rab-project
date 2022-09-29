@extends('admin.layouts.app')

@push('breadcrumb')

@include('admin.components.breadcrumb', [
    'breadcrumb' => []
])
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header mt-2 p-3">
                <a href="{{route('tool.create')}}" class="btn btn-primary"><i class="anticon anticon-plus"></i> Tambah Data</a>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th >Kode Alat</th>
                            <th >Jenis Alat</th>
                            <th >Kapasitas</th>
                            <th >Biaya Sewa</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function(){
        dataTable = $("#datatable").DataTable({
            ajax: "{{route('tool.index')}}?type=datatable",
            processing: true,
            orderable: true,
            autoWidth: false,
            order: [[ 1, "asc" ]],
            // bFilter: true,
            // bSort: false,
            columns: [
                { data: "kode_alat", name: "kode_alat", orderable: true },
                { data: "jenis_alat", name: "jenis_alat", orderable: true },
                { data: "kapasitas", name: "kapasitas", orderable: true },
                { data: "biaya_sewa", name: "biaya_sewa", orderable: true },
                { data: "action", name: "action", orderable: false },
            ]
        });
    });
</script>
@endpush
