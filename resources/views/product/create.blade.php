@extends('layouts.app')

@section('title')
    <title>Daino TL System | Tambah Produk</title>
@endsection

@section('breadcrumb')
    <div class="page-header">
        <h4 class="page-title">Tambah Produk</h4>
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
                <a href="{{ route('product.index') }}">Produk</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Tambah Produk</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Tambah Produk</h4>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'product.store', 'method' => 'POST', 'spellcheck' => 'false']) !!}
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nama Produk</strong>
                        {!! Form::text('product_name', null, ['placeholder' => 'Nama Produk', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Harga Beli</strong>
                        {!! Form::text('', null, ['placeholder' => 'Harga Beli', 'class' => 'form-control', 'id' => 'purchase', 'onchange' => 'unmaskPurchase(value)']) !!}
                        {!! Form::hidden('purchase_price', null, ['class' => 'form-control', 'id' => 'purchase_price']) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Harga Jual</strong>
                        {!! Form::text('', null, ['placeholder' => 'Harga Jual', 'class' => 'form-control', 'id' => 'selling', 'onchange' => 'unmaskSelling(value)']) !!}
                        {!! Form::hidden('selling_price', null, ['class' => 'form-control', 'id' => 'selling_price']) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Trip Quantity</strong>
                        {!! Form::text('', null, ['placeholder' => 'Trip Quantity', 'class' => 'form-control', 'id' => 'tripqty', 'onchange' => 'unmaskTQ(value)']) !!}
                        {!! Form::hidden('quantity_per_trip', null, ['class' => 'form-control', 'id' => 'quantity_per_trip']) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Warna Tabel</strong>
                        <div id="colorpick" class="input-group">
                            <div class="colorpicker-input-addon"><i></i></div>
                            {!! Form::hidden('color', null, ['class' => 'form-control', 'id' => 'color']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer row justify-content-end">
                <div class="col-xs-12 col-sm-12 col-md-2 mx-2 mb-2">
                    <button class="btn btn-primary btn-block">Simpan</button>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2 mx-2">
                    <a href="{{ URL::previous() }}" class="btn btn-danger btn-block"> Batal</a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('script')
    <script>
        var maskOptions = {
            lazy: false,
            mask: 'Rp.  num',
            blocks: {
                num: {
                    mask: Number,
                    signed: false,
                    thousandsSeparator: '.',
                },
            }
        }
        var maskOptions1 = {
            lazy: false,
            mask: Number,
            signed: false,
            thousandsSeparator: '.',
        }

        var purchaseElement = document.getElementById('purchase');
        var sellingElement = document.getElementById('selling');
        var tripqtyElement = document.getElementById('tripqty');

        var purchaseMask = IMask(purchaseElement, maskOptions);
        var sellingMask = IMask(sellingElement, maskOptions);
        var tripqtyMask = IMask(tripqtyElement, maskOptions1);

        function unmaskPurchase() {
            console.log(sellingMask.unmaskedValue);
            $('#purchase_price').val(purchaseMask.unmaskedValue);
        }

        function unmaskSelling() {
            console.log(sellingMask.unmaskedValue);
            $('#selling_price').val(sellingMask.unmaskedValue);
        }

        function unmaskTQ() {
            $('#quantity_per_trip').val(tripqtyMask.unmaskedValue);
        }

        $(document).ready(function() {

            $("#colorpick").colorpicker({
                horizontal: true,
                useAlpha: false,
                format: 'hex'
            }).on('colorpickerChange colorpickerCreate', function(e) {

            });

            @if (count($errors) > 0)
                $.notify({
                    icon: 'flaticon-error',
                    title: 'Gagal Membuat Data',
                    message: '{{ $errors->first() }}',
                }, {
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
