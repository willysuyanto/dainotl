@extends('layouts.app')

@section('title')
    <title>Daino TL System | Lihat Karyawan</title>
@endsection

@section('breadcrumb')
<div class="page-header">
    <h4 class="page-title">Lihat Karyawan</h4>
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
            <a href="#">Lihat Karyawan</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Lihat Karyawan</h4>
        </div>
        <div class="card-body">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Lengkap</strong>
                    <p>{{$employee->full_name}}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nomor Karyawan</strong>
                    <p>{{$employee->employee_number}}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jabatan</strong>
                    <p>{{$employee->position}}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Bekerja Sejak</strong>
                    <p>{{$employee->working_since}}</p>
                </div>
            </div>
        </div>
        <div class="card-footer row justify-content-end">
            <div class="col-xs-12 col-sm-12 col-md-2 mx-2 mb-2">
                <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-primary btn-block" >Edit Data</a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2 mx-2">
                <a href="{{ route('employee.index') }}" class="btn btn-danger btn-block" >Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script >
   
</script>
@endsection