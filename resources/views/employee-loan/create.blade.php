@extends('layouts.app')

@section('title')
    <title>Daino TL System | Tambah Karyawan</title>
@endsection

@section('breadcrumb')
<div class="page-header">
    <h4 class="page-title">Hutang Baru</h4>
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
            <a href="{{route('employee-loan.index')}}">Piutang Karyawan</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Piutang Baru</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Hutang Karyawan</h4>
        </div>
        <div class="card-body">
            {!! Form::open(array('route' => 'employee-loan.store','method'=>'POST', 'spellcheck'=>"false", 'autocomplete' => 'off')) !!}
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Karyawan</strong>
                    <select name="employee" id="employee" class="select2-input form-control">
                        <option value="">Pilih Karyawan</option>
                        @foreach($employees as $emp)
                        <option value="{{$emp->id}}">{{$emp->full_name}} ({{$emp->employee_number}})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nominal Hutang</strong>
                    {!! Form::text('', null, array('placeholder' => 'Nominal Hutang','class' => 'form-control', 'id' => 'loan', 'onchange' => 'unmaskLoan(value)')) !!}
                    {!! Form::hidden('nominal', null, array('class' => 'form-control', 'id' => 'loan_nominal')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Catatan</strong>
                    {!! Form::text('notes', null, array('placeholder' => 'Catatan', 'class' => 'form-control', 'id' => 'loan')) !!}
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

    var maskOptions = {
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
    var loanElement = document.getElementById('loan');
    var loanMask = IMask(loanElement, maskOptions);

    function unmaskLoan(){
        $('#loan_nominal').val(loanMask.unmaskedValue);
    }

    $(document).ready(function() {


        $('#employee').select2({
			theme: "bootstrap",
            placeholder: "Pilih Karyawan"
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