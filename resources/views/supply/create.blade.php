@extends('layouts.app')

@section('title')
    <title>Daino TL System | Penebusan BBM</title>
@endsection

@section('breadcrumb')
    <div class="page-header">
        <h4 class="page-title">Penebusan BBM</h4>
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
                <a href="{{ route('supply.index') }}">Penebusan BBM</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Tambah Penebusan BBM</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Penebusan BBM</h4>
            </div>
            @livewire('supply-item', ['shift' => $shift])
        </div>
    </div>
@endsection

@section('script')
    <script>
        var maskOptions = {
            lazy: true,
            signed: false,
            mask: 'Rp.  num',
            mask: /^\d+$/,
            signed: false
        }
        var maskOptions2 = {
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

        var so_number = document.getElementById('so_number');
        var ref_number = document.getElementById('ref_number');
        var net_price = document.getElementById('net_price');
        var ppn = document.getElementById('ppn');
        var ppbkb = document.getElementById('ppbkb');
        var pph = document.getElementById('pph');

        var so_number_mask = IMask(so_number, maskOptions);
        var ref_number_mask = IMask(ref_number, maskOptions);
        var masked_net_price = IMask(net_price, maskOptions2);
        var masked_ppn = IMask(ppn, maskOptions2);
        var maksed_ppbkb = IMask(ppbkb, maskOptions2);
        var maksed_pph = IMask(pph, maskOptions2);
        
        function unmask(){
            $('#net_price_value').val(masked_net_price.unmaskedValue);
            $('#ppn_taxes').val(masked_ppn.unmaskedValue);
            $('#ppbkb_taxes').val(maksed_ppbkb.unmaskedValue);
            $('#pph_taxes').val(maksed_pph.unmaskedValue);
        }

        $(document).ready(function() {

            @if (count($errors) > 0)
                $.notify({
                icon: 'flaticon-error',
                title: 'Gagal Membuat Data',
                message: '{{ $errors->first() }}',
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
