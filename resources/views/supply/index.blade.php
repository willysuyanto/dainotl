@extends('layouts.app')

@section('title')
    <title>Daino TL System | Penebusan BBM</title>
@endsection

@section('breadcrumb')
<div class="page-header">
    <h4 class="page-title">Penebusan BBM</h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="/">
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
            <a href="#">Penebusan BBM</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <a href="{{route('supply.create')}}">
                <button class="btn btn-primary btn-sm"><span class="btn-label">
                    <i class="fa icon-plus"></i>
                </span>
                Tambah Penebusan BBM
            </button>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-sm table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>Nomor SO</th>
                            <th>Nomor Referensi</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Status Pemesanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nomor SO</th>
                            <th>Nomor Referensi</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Status Pemesanan</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($supplies as $supply)
                        <tr>
                            <td>{{$supply->so_number}}</td>
                            <td>{{$supply->ref_number}}</td>
                            <td>{{$supply->getOrderDate()}}</td>
                            <td>{{$supply->getSupplyStatus()}}</td>
                            <td>
                                <div class="row justify-content-center">
                                    <a href="{{route('supply.details', $supply->id)}}">
                                        <button class="btn btn-info btn-xs mr-1">
                                            <span class="btn-label">
                                                <i class="fa icon-eye"></i>
                                            </span>
                                            Lihat
                                        </button>
                                    </a>
                                    <a href="{{route('supply.edit', $supply->id)}}">
                                        <button class="btn btn-primary btn-xs mr-1">
                                            <span class="btn-label">
                                                <i class="fa icon-pencil"></i>
                                            </span>
                                            Edit
                                        </button>
                                    </a>
                                    <button onclick="return false" data-id="{{$supply->id}}" data-nama="{{$supply->so_number}}" class="confirmDelete btn btn-danger btn-xs">
                                        <span class="btn-label">
                                            <i class="fa icon-trash"></i>
                                        </span>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script >
    $(document).ready(function() {
        $('#basic-datatables').DataTable();

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

    $('.confirmDelete').click(function(e) {
        let nama = e.target.dataset.nama;
        let id = e.target.dataset.id;
        let deleteURL = "{{url('supply')}}"+"/"+id;
        swal({
            title: "Apakah anda yakin untuk menghapus SO "+nama+"?",
            text: "Data yang telah dihapus tidak dapat dikembalikan",
            icon: 'warning',
            buttons:{
                confirm: {
                    text : 'Ya, Hapus',
                    className : 'btn btn-success'
                },
                cancel: {
                    text : "Tidak",
                    visible: true,
                    className: 'btn btn-danger'
                }
            }
        }).then((Delete) => {
            console.log(deleteURL);
            console.log(id);
            console.log(nama);
            if (Delete) {
                $.ajax({
                type: "POST",
                url: deleteURL,
                header:{
                  'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                data: {
                    _token:'{{ csrf_token() }}',
                    _method: 'DELETE'
                },
                success: function (data) {
                 swal.close();
                 console.log(data);
                 $.notify({
                        icon: 'flaticon-alarm-1',
                        title: 'Sukses',
                        message: data,
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

                 setTimeout(() => {
                    window.location.reload();
                 }, 1500);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
            } else {
                swal.close();
            }
        });
    });

</script>
@endsection