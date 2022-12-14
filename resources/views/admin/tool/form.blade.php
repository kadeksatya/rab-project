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
                        'link' => route('tool.index')
                ])
            </div>
        </form>
        </div>
    </div>
</div>
@endsection

