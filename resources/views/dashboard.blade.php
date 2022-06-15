@extends('layouts.app')

@section('title')
    <title>Daino TL System | Dashboard</title>
@endsection

@section('breadcrumb')
<div class="page-header">
    <h4 class="page-title">Dashboard</h4>
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
            <a href="#">Dashboard</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="col-md-12">
    Halaman Dashboard User
</div>
@endsection

@section('script')
<script >
     $(document).ready(function() {
        $('#basic-datatables').DataTable({
        });
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