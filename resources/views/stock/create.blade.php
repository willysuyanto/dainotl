@extends('layouts.app')

@section('title')
    <title>Daino TL System | Stok BBM Datang</title>
@endsection

@section('breadcrumb')
    <div class="page-header">
        <h4 class="page-title">Stok BBM Datang</h4>
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
                <a href="{{ route('supply.index') }}">Stock BBM</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Stock BBM Datang</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form BBM Datang</h4>
            </div>
            @livewire('stock-form', ['shift' => $shift])
        </div>
    </div>
@endsection

@section('script')
    <script>
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

            window.initSelect2 = () => {
                $('#select-so').select2({
                    theme:'bootstrap',
                    placeholder: 'Pilih nomor SO'
                })

                $('#select-so1').select2({
                    theme:'bootstrap',
                    placeholder: 'Pilih item BBM datang'
                });
            }

            initSelect2();

            $('#select-so').on('change', (e)=>{
                livewire.emit('selected_so', e.target.value);
            });

            window.livewire.on('select2',()=>{
                initSelect2();
            });
        });
    </script>
@endsection
