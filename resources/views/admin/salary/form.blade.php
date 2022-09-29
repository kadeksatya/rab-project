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
                <form action="{{isset($data) ? route('salary.update', $data->kode_uk) : route('salary.store')}}" method="post">
                @csrf

                @if (isset($data))
                @method('PUT')
                @else
                @method('POST')
                @endif
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="">Pekerja</label>
                        <input type="text" class="form-control" value="{{$data->pekerja ?? ''}}" name="pekerja">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Satuan Updah Kerja</label>
                        <input type="text" class="form-control" name="satuan_uk" value="{{$data->satuan_uk ?? ''}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Harga Upah Kerja</label>
                        <input type="number" min="0" class="form-control" name="hargas_uk" value="{{$data->hargas_uk ?? ''}}">
                    </div>

                </div>
            </div>
            <div class="card-footer">
                @include('admin.components.button', [
                        'link' => route('salary.index')
                ])
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
