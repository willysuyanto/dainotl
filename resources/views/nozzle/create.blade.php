@extends('layouts.app')

@section('title')
    <title>Daino TL System | Tambah Nozzle</title>
@endsection

@section('breadcrumb')
<div class="page-header">
    <h4 class="page-title">Tambah Nozzle</h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="#">
                <i class="flaticon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Master Data</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="{{route('nozzle.index')}}">Nozzle</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Tambah Nozzle</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Tambah Nozzle</h4>
        </div>
        <div class="card-body">
            {!! Form::open(array('route' => 'nozzle.store','method'=>'POST', 'spellcheck'=>"false")) !!}
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Group</strong>
                    <select name="group" id="select-group" class="input-group form-control">
                        <option value="">Pilih Group</option>
                        <option value="P1">P1</option>
                        <option value="P2">P2</option>
                        <option value="P3">P3</option>
                        <option value="P4">P4</option>
                        <option value="P5">P5</option>
                        <option value="P6">P6</option>
                        <option value="P7">P7</option>
                        <option value="P8">P8</option>
                    </select>
                </div>
            </div>                
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jenis BBM</strong>
                    <select name="product" id="select-product" class="input-group form-control">
                        <option value="">Pilih Jenis BBM</option>
                        @foreach($products as $index => $product)
                        <option value="{{$product->id}}">{{$product->product_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Totalizer Terakhir</strong>
                    {!! Form::text('', null, array('placeholder' => 'Totalizer Terakhir', 'class' => 'form-control', 'id' => 'initialStock', 'onchange' => 'unmaskPurchase(value)')) !!}
                    {!! Form::hidden('last_totalizer', null, array('class' => 'form-control', 'id' => 'initial_stock')) !!}
                </div>
            </div>                
        </div>
        <div class="card-footer row justify-content-end">
            <div class="col-xs-12 col-sm-12 col-md-2 mx-2 mb-2">
                <button class="btn btn-primary btn-block">Simpan</button>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2 mx-2">
                <a href="{{ URL::previous() }}" class="btn btn-danger btn-block" > Batal</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('script')
<script >
     var maskOptions = {
        lazy: false,
        mask: Number,
        signed: false, 
        thousandsSeparator: '.', 
    }
    var element = document.getElementById('initialStock');

    var stockMask = IMask(element, maskOptions);
    function unmaskPurchase(){
        $('#initial_stock').val(stockMask.unmaskedValue);
    }

    $(document).ready(function() {

        $("#select-group").select2({
            placeholder: "Pilih Grup",
            theme: "bootstrap"
        });

        $("#select-product").select2({
            placeholder: "Pilih Jenis BBM",
            theme: "bootstrap"
        });

        @if (count($errors) > 0)
            $.notify({
                icon: 'flaticon-error',
                title: 'Gagal Membuat Data',
                message: '{{$errors->first()}}',
            },
            {
                type: 'danger',
                placement: {
                    from: "top",
                    align: "center"
                },
                time: 500,
                autoHideDelay: 1000,
            });
        @endif
    });
</script>
@endsection