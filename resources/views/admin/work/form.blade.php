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
                <form action="{{isset($data) ? route('work.update', $data->kode_p) : route('work.store')}}" method="post">
                @csrf

                @if (isset($data))
                @method('PUT')
                @else
                @method('POST')
                @endif
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="">Nama Pekerjaan</label>
                        <input type="text" class="form-control" value="{{$data->nama_p ?? ''}}" name="nama_p">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Jenis Pekerjaan</label>
                        <input type="text" class="form-control" name="jenis_p" value="{{$data->jenis_p ?? ''}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Satuan Pekerjaan</label>
                        <input type="text" class="form-control" name="satuan_p" value="{{$data->satuan_p ?? ''}}">
                    </div>

                </div>
            </div>
            <div class="card-footer">
                @include('admin.components.button', [
                        'link' => route('work.index')
                ])
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
