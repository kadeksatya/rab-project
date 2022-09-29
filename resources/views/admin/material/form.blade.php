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
            <div class="card-body">
                <form action="{{isset($data) ? route('material.update', $data->kode_bm) : route('material.store')}}" method="post">
                @csrf

                @if (isset($data))
                @method('PUT')
                @else
                @method('POST')
                @endif
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="">Jenis Bahan</label>
                        <input type="text" class="form-control" value="{{$data->jenis_bahan ?? ''}}" name="jenis_bahan">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Nama Bahan</label>
                        <input type="text" class="form-control" name="nama_bahan" value="{{$data->nama_bahan ?? ''}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Satuan Bahan</label>
                        <input type="text" class="form-control" name="satuan_bm" value="{{$data->satuan_bm ?? ''}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Harga Bahan</label>
                        <input type="number" class="form-control" name="harga_sbahan" value="{{$data->harga_sbahan ?? ''}}">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                @include('admin.components.button', [

                        'link' => route('material.index')
                ])
            </div>
        </form>
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
