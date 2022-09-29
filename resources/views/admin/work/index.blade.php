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
                <a href="{{route('work.create')}}" class="btn btn-primary"><i class="anticon anticon-plus"></i> Tambah Data</a>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th >Kode Pekerjaan</th>
                            <th >Jenis Pekerjaan</th>
                            <th >Nama Pekerjaan</th>
                            <th >Satuan Pekerjaan</th>
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
            ajax: "{{route('work.index')}}?type=datatable",
            processing: true,
            orderable: true,
            autoWidth: false,
            order: [[ 1, "asc" ]],
            // bFilter: true,
            // bSort: false,
            columns: [
                { data: "kode_p", name: "kode_p", orderable: true },
                { data: "jenis_p", name: "jenis_p", orderable: true },
                { data: "nama_p", name: "nama_p", orderable: true },
                { data: "satuan_p", name: "satuan_p", orderable: true },
                { data: "action", name: "action", orderable: false },
            ]
        });
    });
</script>
@endpush
