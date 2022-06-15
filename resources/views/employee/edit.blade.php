@extends('layouts.app')

@section('title')
    <title>Daino TL System | Edit Karyawan</title>
@endsection

@section('breadcrumb')
<div class="page-header">
    <h4 class="page-title">Edit Karyawan</h4>
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
            <a href="{{route('employee.index')}}">Karyawan</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Edit Karyawan</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Edit Karyawan</h4>
        </div>
        <div class="card-body">
            {!! Form::model($employee, ['method' => 'PATCH','route' => ['employee.update', $employee->id]]) !!}
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Lengkap</strong>
                    {!! Form::text('full_name', null, array('placeholder' => 'Nama Lengkap','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nomor Karyawan</strong>
                    {!! Form::text('employee_number', null, array('placeholder' => 'Nomor Karyawan','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jabatan</strong>
                    {!! Form::select('position', $positions, 1, array('class' => 'select2-input','id' => 'position', 'style'=>"width: 100%")) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Bekerja Sejak</strong>
                    {!! Form::text('working_since', null, array('placeholder' => 'Bekerja Sejak','class' => 'form-control', 'id' => 'datepick')) !!}
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
        var current_date = new Date();
        $('#datepick').datetimepicker({
			format: 'DD/MM/YYYY',
            maxDate: current_date, 
		});

        $('#datepick').val("{{format($employee->working_since, 'd/m/Y')}}");

        $('#position').select2({
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