@extends('layouts.app')

@section('title')
    <title>Daino TL System | Profil</title>
@endsection

@section('breadcrumb')
<div class="page-header">
    <h4 class="page-title">Profil</h4>
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
            <a href="#">Profil</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Lengkap</strong>
                    <p>{{$data->name}}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Username</strong>
                    <p>{{$data->username}}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email</strong>
                    <p>{{$data->email}}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nomor Telepon</strong>
                    <p>{{$data->phone_number}}</p>
                </div>
            </div>
        </div>
        <div class="card-footer row justify-content-end">
            <div class="col-xs-12 col-sm-12 col-md-2 mx-2 mb-2">
                <a href="{{ route('profile.edit')}}" class="btn btn-primary btn-block" >Edit Profil</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script >
    $(document).ready(function() {
    @if ($message = Session::get('success'))
            $.notify({
                icon: 'flaticon-alarm-1',
                title: 'Sukses',
                message: '{{$message}}',
            },
            {
                type: 'success',
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