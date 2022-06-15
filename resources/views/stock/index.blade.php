@extends('layouts.app')

@section('title')
    <title>Daino TL System | Stok BBM</title>
@endsection

@section('breadcrumb')
<div class="page-header">
    <h4 class="page-title">Stok BBM</h4>
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
            <a href="{{ route('supply.index') }}">Stok BBM</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <a href="{{route('stock.create')}}">
                <button class="btn btn-primary btn-sm"><span class="btn-label">
                    <i class="fa icon-plus"></i>
                </span>
                Stok BBM Datang
            </button>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Barang Jual (L)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Barang Jual (L)</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($datas as $product)
                        <tr>
                            <td>{{$product->product_name}}</td>
                            <td>
                               {{number_format($product->getTotalQuantity(),1)}}
                            </td>
                            <td>
                                <div class="row">
                                    <a href="{{route('stock.show', $product->id)}}">
                                        <button class="btn btn-info btn-xs mr-1">
                                            <span class="btn-label">
                                                <i class="fa icon-eye"></i>
                                            </span>
                                            Lihat Detail
                                        </button>
                                    </a>
                                    <a href="{{route('stock.stock-awal', $product->id)}}">
                                        <button class="btn btn-primary btn-xs mr-1">
                                            <span class="btn-label">
                                                <i class="fa icon-note"></i>
                                            </span>
                                            Set Stok Awal
                                        </button>
                                    </a>
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
        $('#basic-datatables').DataTable({
            columnDefs: [
       { targets: 1,
         type: "num",
         render: function ( data, type, full, meta ) {
                if (type === 'sort') {
                    data = data.replace('Rp. ', '');
                    data = data.replace(',-', '');
                    data = data.replace('.', '');
                    return data;
                }
            return data;
            }
       },
       { targets: 2,
         type: "num",
         render: function ( data, type, full, meta ) {
                if (type === 'sort') {
                    data = data.replace('Rp. ', '');
                    data = data.replace(',-', '');
                    data = data.replace('.', '');
                    return data;
                }
            return data;
            }
       }
     ]
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

    $('.confirmDelete').click(function(e) {
        let nama = e.target.dataset.nama;
        let id = e.target.dataset.id;
        let deleteURL = "{{url('product')}}"+"/"+id;
        swal({
            title: "Apakah anda yakin untuk menghapus "+nama+"?",
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
                }
            });
            } else {
                swal.close();
            }
        });
    });

</script>
@endsection