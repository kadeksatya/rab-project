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
                <a href="{{route('material.create')}}" class="btn btn-primary"><i class="anticon anticon-plus"></i> Tambah Data</a>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th >Kode Material</th>
                            <th >Jenis Bahan</th>
                            <th >Nama Bahan</th>
                            <th >Satuan Material</th>
                            <th >Harga Material</th>
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
            ajax: "{{route('material.index')}}?type=datatable",
            processing: true,
            orderable: true,
            autoWidth: false,
            order: [[ 1, "asc" ]],
            // bFilter: true,
            // bSort: false,
            columns: [
                { data: "kode_bm", name: "kode_bm", orderable: true },
                { data: "jenis_bahan", name: "jenis_bahan", orderable: true },
                { data: "nama_bahan", name: "nama_bahan", orderable: true },
                { data: "satuan_bm", name: "satuan_bm", orderable: true },
                { data: "harga_sbahan", name: "harga_sbahan", orderable: true },
                { data: "action", name: "action", orderable: false },
            ]
        });
    });
</script>
@endpush
