@extends('layouts.app')

@section('title')
    <title>Daino TL System | Lihat Produk</title>
@endsection

@section('breadcrumb')
<div class="page-header">
    <h4 class="page-title">Lihat Produk</h4>
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
            <a href="{{route('product.index')}}">Produk</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Lihat Produk</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Lihat Produk</h4>
        </div>
        <div class="card-body">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Produk</strong>
                    <p>{{$product->product_name}}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Harga Beli</strong>
                    <p>{{toRupiah($product->purchase_price)}}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Harga Jual</strong>
                    <p>{{toRupiah($product->selling_price)}}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Warna Tabel</strong>
                    <div class="picker" style="background: {{$product->color}}; border-width: 1px; border-color: #D1D1D1"></div>
                </div>
            </div>
        </div>
        <div class="card-footer row justify-content-end">
            <div class="col-xs-12 col-sm-12 col-md-2 mx-2 mb-2">
                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary btn-block" >Edit Data</a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2 mx-2">
                <a href="{{ route('product.index') }}" class="btn btn-danger btn-block" >Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script >
   
</script>
@endsection