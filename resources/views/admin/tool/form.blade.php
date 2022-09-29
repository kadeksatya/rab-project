@extends('admin.layouts.app')

@push('breadcrumb')

@include('admin.components.breadcrumb', [
    'breadcrumb' => []
])
@endpush

@section('content')
<div class="row">
    <div class="col-md-8 col-lg-8">
        <div class="card">
            <div class="card-body">
                <form action="{{isset($data) ? route('tool.update', $data->kode_alat) : route('tool.store')}}" method="post">
                @csrf

                @if (isset($data))
                @method('PUT')
                @else
                @method('POST')
                @endif
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="">Jenis Alat</label>
                        <input type="text" class="form-control" value="{{$data->jenis_alat ?? ''}}" name="jenis_alat">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Kapasitas</label>
                        <input type="text" class="form-control" name="kapasitas" value="{{$data->kapasitas ?? ''}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Biaya sewa</label>
                        <input type="number" min="0" class="form-control" name="biaya_sewa" value="{{$data->biaya_sewa ?? ''}}">
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
