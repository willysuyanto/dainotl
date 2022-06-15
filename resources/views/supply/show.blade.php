@extends('layouts.app')

@section('title')
    <title>Daino TL System | Detail Pemesanan BBM</title>
@endsection

@section('breadcrumb')
<div class="page-header">
    <h4 class="page-title">Detail Pemesanan BBM</h4>
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
            <a href="{{route('roles.index')}}">Pemesanan BBM</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Detail Pemesanan BBM</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Detail Pemesanan BBM</h4>
        </div>
        <div class="card-body row">
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Nomor SO</strong>
                    <p class="">{{ $supply->so_number }}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Nomor Referensi</strong>
                    <p>{{ $supply->ref_number }}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Harga Net</strong>
                    <p>{{ toRupiah($supply->net_price)}}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>PPn</strong>
                    <p>{{ toRupiah($supply->ppn_tax)}}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>PPBKB</strong>
                    <p>{{ toRupiah($supply->ppbkb_tax)}}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>PPh</strong>
                    <p>{{ toRupiah($supply->pph_tax)}}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Transfer Fee</strong>
                    <p>{{ toRupiah($supply->transfer_fee)}}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Total Harga</strong>
                    <p>{{ toRupiah($supply->total_debit_amount+$supply->transfer_fee)}}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Item Pemesanan BBM</strong>
                    @if(!empty($supply->items))
                    <table id="basic-datatables" class="display table table-sm table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th>Jenis BBM</th>
                                <th>Trip</th>
                                <th>Trip Terkirim</th>
                                <th>Quantity per Trip (L)</th>
                                <th>Total Quantity (L)</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Jenis BBM</th>
                                <th>Trip</th>
                                <th>Trip Terkirim</th>
                                <th>Quantity per Trip (L)</th>
                                <th>Total Quantity (L)</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($supply->items as $item)
                            <tr style="background-color: {{$item->product->first()->color}}">
                                <td>{{$item->product->first()->product_name}}</td>
                                <td>{{$item->trip}}</td>
                                <td>{{$item->trip_delivered}}</td>
                                <td>{{$item->trip_quantity}}</td>
                                <td>{{$item->confirmed_quantity}}</td>
                                <td>{{$item->status}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer row justify-content-end">
            <div class="col-xs-12 col-sm-12 col-md-2 mx-2 mb-2">
                <a href="{{ route('supply.edit', $supply->id) }}" class="btn btn-primary btn-block" >Edit Data</a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2 mx-2">
                <a href="{{ route('supply.index') }}" class="btn btn-danger btn-block" >Kembali</a>
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
<script >
    
</script>
@endsection