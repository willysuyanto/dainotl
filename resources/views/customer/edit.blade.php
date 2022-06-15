@extends('layouts.app')

@section('title')
    <title>Daino TL System | Edit Pelanggan</title>
@endsection

@section('breadcrumb')
<div class="page-header">
    <h4 class="page-title">Edit Pelanggan</h4>
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
            <a href="{{route('customer.index')}}">Pelanggan</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Edit Pelanggan</a>
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
            {!! Form::model($customer, ['method' => 'PATCH','route' => ['customer.update', $customer->id]]) !!}
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Customer</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Nama Customer','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Piutang Awal</strong>
                    {!! Form::text('', null, array('placeholder' => 'Piutang Awal', 'class' => 'form-control', 'id' => 'purchase', 'onchange' => 'unmaskPurchase(value)')) !!}
                    {!! Form::hidden('initial_credit', null, array('class' => 'form-control', 'id' => 'purchase_price')) !!}
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
            mask: 'Rp.  num',
            blocks: {
                num: {
                mask: Number,
                signed: false, 
                thousandsSeparator: '.', 
            },
        }
    }
    $('#purchase').val({{$customer->initial_credit}});
    var purchaseElement = document.getElementById('purchase');
    var purchaseMask = IMask(purchaseElement, maskOptions);
    function unmaskPurchase(){
        $('#purchase_price').val(purchaseMask.unmaskedValue);
    }

    $(document).ready(function() {
        

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