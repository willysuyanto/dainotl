@extends('layouts.app')

@section('title')
    <title>Daino TL System | Produk</title>
@endsection

@section('breadcrumb')
<div class="page-header">
    <h4 class="page-title">Produk</h4>
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
            <a href="#">Master data</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Product</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <a href="{{route('product.create')}}">
                <button class="btn btn-primary btn-sm"><span class="btn-label">
                    <i class="fa icon-plus"></i>
                </span>
                Tambah Produk
            </button>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-sm table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Selisih Harga</th>
                            <th>Trip Quantity</th>
                            <th>Warna Tabel</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Selisih Harga</th>
                            <th>Trip Quantity</th>
                            <th>Warna Tabel</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{$product->product_name}}</td>
                            <td>Rp. {{number_format($product->purchase_price, 1)}}</td>
                            <td>Rp. {{number_format($product->selling_price, 0)}}</td>
                            <td>Rp. {{number_format($product->selling_price - $product->purchase_price, 1)}}</td>
                            <td>Rp. {{number_format($product->quantity_per_trip)}}</td>
                            <td>
                                <div class="picker" style="background: {{$product->color}}; border-width: 1px; border-color: #D1D1D1"></div>
                            </td>
                            <td>
                                <div class="row justify-content-center">
                                    <a href="{{route('product.show', $product->id)}}">
                                        <button class="btn btn-info btn-xs mr-1">
                                            <span class="btn-label">
                                                <i class="fa icon-eye"></i>
                                            </span>
                                            Lihat
                                        </button>
                                    </a>
                                    <a href="{{route('product.edit', $product->id)}}">
                                        <button class="btn btn-primary btn-xs mr-1">
                                            <span class="btn-label">
                                                <i class="fa icon-pencil"></i>
                                            </span>
                                            Edit
                                        </button>
                                    </a>
                                    <button onclick="return false" data-id="{{$product->id}}" data-nama="{{$product->product_name}}" class="confirmDelete btn btn-danger btn-xs">
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
        $('#basic-datatables').DataTable({
            columnDefs: [
       { targets: 1,
         type: "num",
         render: function ( data, type, full, meta ) {
                if (type === 'sort') {
                    data = data.replace('Rp. ', '');
                    data = data.replace(',-', '');
                    data = data.replace(',', '');
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
                    data = data.replace(',', '');
                    console.log(data);
                    return data;
                }
            return data;
            }
       },
       { targets: 3,
         type: "num",
         render: function ( data, type, full, meta ) {
                if (type === 'sort') {
                    data = data.replace('Rp. ', '');
                    data = data.replace(',-', '');
                    data = data.replace(',', '');
                    console.log(data);
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