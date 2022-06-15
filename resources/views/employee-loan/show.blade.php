@extends('layouts.app')

@section('title')
    <title>Daino TL System | Detail Hutang Karyawan</title>
@endsection

@section('breadcrumb')
<div class="page-header">
    <h4 class="page-title">Detail Hutang Karyawan</h4>
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
            <a href="{{route('employee.index')}}">Piutang Karyawan</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Detail Hutang Karyawan</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Detail Hutang Karyawan</h4>
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
                    <strong>Detail Hutang</strong>
                    @if(!empty($employee->loans))
                    <table id="basic-datatables" class="display table table-sm table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th>Nominal</th>
                                <th>Jenis</th>
                                <th>Tanggal</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nominal</th>
                                <th>Jenis</th>
                                <th>Tanggal</th>
                                <th>Catatan</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($employee->loans as $item)
                            <tr>
                                <td>Rp. {{number_format($item->nominal)}},-</td>
                                <td>{{$item->type == 'hutang'? "Hutang" : "Pembayaran"}}</td>
                                <td>{{format($item->created_at, "d/m/Y")}}</td>
                                <td>{{$item->notes}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer row justify-content-end">
            <div class="col-xs-12 col-sm-12 col-md-2 mx-2">
                <a href="{{ route('employee-loan.index') }}" class="btn btn-danger btn-block" >Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script >
   
</script>
@endsection