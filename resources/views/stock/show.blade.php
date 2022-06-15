@extends('layouts.app')

@section('title')
    <title>Daino TL System | Detail Stok BBM</title>
@endsection

@section('breadcrumb')
<div class="page-header">
    <h4 class="page-title">Detail Stok BBM</h4>
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
            <a href="#">Menu Utama</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="{{route('roles.index')}}">Stok BBM</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Detail Stok BBM</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
                <h4 class="card-title">{{$product->product_name}}</h4>
        </div>
        <div class="card-body">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <table id="basic-datatables" class="display table table-sm table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th>Jenis Stock</th>
                                <th>Quantity (L)</th>
                                <th>Nomor SO</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Jenis Stock</th>
                                <th>Quantity (L)</th>
                                <th>Nomor SO</th>
                                <th>Tanggal</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($product_stocks as $stock)
                            <tr>
                                @if($stock->stock_type == 'stock_in')
                                <td>Delivered</td>
                                @elseif($stock->stock_type == 'initial')
                                <td>Stok Awal</td>
                                @else
                                <td>Sold</td>
                                @endif
                                <td>{{number_format($stock->quantity, 1)}}</td>
                                <td>{{$stock->so_from}}</td>
                                <td>{{$stock->stock_date}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer row justify-content-end">
            <div class="col-xs-12 col-sm-12 col-md-2 mx-2">
                <a href="{{ route('stock.index') }}" class="btn btn-danger btn-block" >Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script >
   $('#basic-datatables').DataTable({});
</script>
@endsection