@extends('layouts.app')

@section('title')
    <title>Daino TL System | Ubah Password</title>
@endsection

@section('breadcrumb')
<div class="page-header">
    <h4 class="page-title">Ubah Password</h4>
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
            <a href="#">Ubah Password</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            {!! Form::open(array('route' => 'password.update','method'=>'POST')) !!}
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Password Lama</strong>
                    {!! Form::password('password', array('placeholder' => 'Password Lama','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Password Baru</strong>
                    {!! Form::password('new_password', array('placeholder' => 'Password Baru','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Konfirmasi Password Baru</strong>
                    {!! Form::password('confirm_new_password', array('placeholder' => 'Konfirmasi Password Baru','class' => 'form-control')) !!}
                </div>
            </div>
        </div>
        <div class="card-footer row justify-content-end">
            <div class="col-xs-12 col-sm-12 col-md-2 my-2 mb-2">
                <button class="btn btn-primary btn-block">Ubah Password</button>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2 my-2 mx-2">
                <a href="{{ route('dashboard') }}" class="btn btn-danger btn-block" >Batal</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('script')
<script >
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