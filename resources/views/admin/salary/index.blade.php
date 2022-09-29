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
                <a href="{{route('salary.create')}}" class="btn btn-primary"><i class="anticon anticon-plus"></i> Tambah Data</a>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th >Kode Upah Kerja</th>
                            <th >Pekerja</th>
                            <th >Satuan Upah Kerja</th>
                            <th >Harga Updah Kerja</th>
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
            ajax: "{{route('salary.index')}}?type=datatable",
            processing: true,
            orderable: true,
            autoWidth: false,
            order: [[ 1, "asc" ]],
            // bFilter: true,
            // bSort: false,
            columns: [
                { data: "kode_uk", name: "kode_uk", orderable: true },
                { data: "pekerja", name: "pekerja", orderable: true },
                { data: "satuan_uk", name: "satuan_uk", orderable: true },
                { data: "hargas_uk", name: "hargas_uk", orderable: true },
                { data: "action", name: "action", orderable: false },
            ]
        });
    });
</script>
@endpush
