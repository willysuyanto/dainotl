@extends('layouts.app')

@section('title')
    <title>Daino TL System | Edit Role</title>
@endsection

@section('breadcrumb')
<div class="page-header">
    <h4 class="page-title">Edit Role</h4>
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
            <a href="#">Edit Role</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Edit Role</h4>
        </div>
        <div class="card-body">
            {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
            <div class="row justify-content-end">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nama Role</strong>
                        {!! Form::text('name', null, array('placeholder' => 'Nama Role','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Permission</strong>
                        <br/>
                        @foreach($permission as $value)
                        <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                            {{ $value->name }}</label>
                        <br/>
                        @endforeach
                    </div>
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
    $(document).ready(function() {
        $('#basic-datatables').DataTable({
        });
        $('#role').select2({
			theme: "bootstrap"
		});
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