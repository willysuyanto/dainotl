@extends('layouts.app')

@section('title')
    <title>Daino TL System | Lihat Data Role</title>
@endsection

@section('breadcrumb')
<div class="page-header">
    <h4 class="page-title">Lihat Data Role</h4>
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
            <a href="#">Administration</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="{{route('roles.index')}}">Role Management</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Lihat Data Role</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Lihat Data Role</h4>
        </div>
        <div class="card-body">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Role</strong>
                    <p>{{ $role->name }}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Permissions:</strong>
                    @if(!empty($rolePermissions))
                        @foreach($rolePermissions as $v)
                            @if ($loop->iteration == count($rolePermissions))
                            <label class="label label-success">{{ $v->name }}</label>
                            @else
                            <label class="label label-success">{{ $v->name }},</label>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="card-footer row justify-content-end">
                <div class="col-xs-12 col-sm-12 col-md-2">
                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-block" >Edit Data</a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2">
                    <a href="{{ route('roles.index') }}" class="btn btn-danger btn-block" >Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script >
    $(document).ready(function() {
        $('#role').select2({
			theme: "bootstrap"
            
		}).enable(false);
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