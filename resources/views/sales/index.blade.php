@extends('layouts.app')

@section('title')
    <title>Daino TL System | Penjualan BBM</title>
@endsection

@section('breadcrumb')
<div class="page-header">
    <h4 class="page-title">Penjualan BBM</h4>
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
            <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-shift1-tab" data-toggle="pill" href="#pills-shift1" role="tab" aria-controls="pills-shift1" aria-selected="true">Shift 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-shift2-tab" data-toggle="pill" href="#pills-shift2" role="tab" aria-controls="pills-shift2" aria-selected="false">Shift 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-shift3-tab" data-toggle="pill" href="#pills-shift3" role="tab" aria-controls="pills-shift3" aria-selected="false">Shift 3</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content mt-2 mb-3" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-shift1" role="tabpanel" aria-labelledby="pills-shift1-tab">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-sm table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th>Nozzle</th>
                                    <th>Jenis BBM</th>
                                    <th>Totalizer Awal</th>
                                    <th>Totalizer Akhir</th>
                                    <th>Penjualan (L)</th>
                                    <th>Jumlah (Rp. )</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nozzle</th>
                                    <th>Jenis BBM</th>
                                    <th>Totalizer Awal</th>
                                    <th>Totalizer Akhir</th>
                                    <th>Penjualan (L)</th>
                                    <th>Jumlah (Rp. )</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($nozzles as $index => $nozzle)
                                {{-- <tr>
                                    <td style="background-color: {{$nozzle->product->color}};">{{$index + 1}}</td>
                                    <td style="background-color: {{$nozzle->product->color}};">{{$nozzle->product->product_name}}</td>
                                    <td style="background-color: {{$nozzle->product->color}};">{{$nozzle->todaySales('shift1')==null? number_format($nozzle->last_totalizer, 1) : $nozzle->todaySales('shift1')->first_totalizer}}</td>
                                    <td style="background-color: {{$nozzle->product->color}};">{{$nozzle->todaySales('shift1')==null? number_format($nozzle->last_totalizer, 1) : $nozzle->todaySales('shift1')->last_totalizer}}</td>
                                    <td style="background-color: {{$nozzle->product->color}};">{{number_format($nozzle->salesDifference('shift1'),1)}}</td>
                                    <td style="background-color: {{$nozzle->product->color}};">Rp. {{number_format($nozzle->salesDifference('shift1') * $nozzle->product->selling_price,1)}}</td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <a href="{{route('supply.details', $nozzle->id)}}">
                                                <button class="btn btn-info btn-xs mr-1">
                                                    <span class="btn-label">
                                                        <i class="fa icon-eye"></i>
                                                    </span>
                                                    Lihat
                                                </button>
                                            </a>
                                            <a href="{{route('supply.edit', $nozzle->id)}}">
                                                <button class="btn btn-primary btn-xs mr-1">
                                                    <span class="btn-label">
                                                        <i class="fa icon-pencil"></i>
                                                    </span>
                                                    Edit
                                                </button>
                                            </a>
                                            <button onclick="return false" data-id="{{$nozzle->id}}" data-nama="{{$nozzle->id}}" class="confirmDelete btn btn-danger btn-xs">
                                                <span class="btn-label">
                                                    <i class="fa icon-trash"></i>
                                                </span>
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr> --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-shift2" role="tabpanel" aria-labelledby="pills-shift2-tab">
                    <div class="table-responsive">
                        <table id="basic-datatables1" class="display table table-sm table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th>Nozzle</th>
                                    <th>Jenis BBM</th>
                                    <th>Totalizer Awal</th>
                                    <th>Totalizer Akhir</th>
                                    <th>Penjualan (L)</th>
                                    <th>Jumlah (Rp. )</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nozzle</th>
                                    <th>Jenis BBM</th>
                                    <th>Totalizer Awal</th>
                                    <th>Totalizer Akhir</th>
                                    <th>Penjualan (L)</th>
                                    <th>Jumlah (Rp. )</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($nozzles as $index => $nozzle)
                                <tr>
                                    <td>{{$index + 1}}</td>
                                    <td>{{$nozzle->product->product_name}}</td>
                                    <td>{{$nozzle->todaySales('shift1')==null? number_format($nozzle->last_totalizer, 1) : $nozzle->todaySales('shift1')->first_totalizer}}</td>
                                    <td>{{$nozzle->todaySales('shift1')==null? number_format($nozzle->last_totalizer, 1) : $nozzle->todaySales('shift1')->last_totalizer}}</td>
                                    <td>{{number_format($nozzle->salesDifference('shift1'),1)}}</td>
                                    <td>Rp. {{number_format($nozzle->salesDifference('shift1') * $nozzle->product->selling_price,1)}}</td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <a href="{{route('supply.details', $nozzle->id)}}">
                                                <button class="btn btn-info btn-xs mr-1">
                                                    <span class="btn-label">
                                                        <i class="fa icon-eye"></i>
                                                    </span>
                                                    Lihat
                                                </button>
                                            </a>
                                            <a href="{{route('supply.edit', $nozzle->id)}}">
                                                <button class="btn btn-primary btn-xs mr-1">
                                                    <span class="btn-label">
                                                        <i class="fa icon-pencil"></i>
                                                    </span>
                                                    Edit
                                                </button>
                                            </a>
                                            <button onclick="return false" data-id="{{$nozzle->id}}" data-nama="{{$nozzle->id}}" class="confirmDelete btn btn-danger btn-xs">
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
                <div class="tab-pane fade" id="pills-shift3" role="tabpanel" aria-labelledby="pills-shift3-tab">
                    <div class="table-responsive">
                        <table id="basic-datatables2" class="display table table-sm table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th>Nozzle</th>
                                    <th>Jenis BBM</th>
                                    <th>Totalizer Awal</th>
                                    <th>Totalizer Akhir</th>
                                    <th>Penjualan (L)</th>
                                    <th>Jumlah (Rp. )</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nozzle</th>
                                    <th>Jenis BBM</th>
                                    <th>Totalizer Awal</th>
                                    <th>Totalizer Akhir</th>
                                    <th>Penjualan (L)</th>
                                    <th>Jumlah (Rp. )</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($nozzles as $index => $nozzle)
                                <tr>
                                    <td>{{$index + 1}}</td>
                                    <td>{{$nozzle->product->product_name}}</td>
                                    <td>{{$nozzle->todaySales('shift1')==null? number_format($nozzle->last_totalizer, 1) : $nozzle->todaySales('shift1')->first_totalizer}}</td>
                                    <td>{{$nozzle->todaySales('shift1')==null? number_format($nozzle->last_totalizer, 1) : $nozzle->todaySales('shift1')->last_totalizer}}</td>
                                    <td>{{number_format($nozzle->salesDifference('shift1'),1)}}</td>
                                    <td>Rp. {{number_format($nozzle->salesDifference('shift1') * $nozzle->product->selling_price,1)}}</td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <a href="{{route('supply.details', $nozzle->id)}}">
                                                <button class="btn btn-info btn-xs mr-1">
                                                    <span class="btn-label">
                                                        <i class="fa icon-eye"></i>
                                                    </span>
                                                    Lihat
                                                </button>
                                            </a>
                                            <a href="{{route('supply.edit', $nozzle->id)}}">
                                                <button class="btn btn-primary btn-xs mr-1">
                                                    <span class="btn-label">
                                                        <i class="fa icon-pencil"></i>
                                                    </span>
                                                    Edit
                                                </button>
                                            </a>
                                            <button onclick="return false" data-id="{{$nozzle->id}}" data-nama="{{$nozzle->id}}" class="confirmDelete btn btn-danger btn-xs">
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
</div>
@endsection

@section('script')
<script >
    $(document).ready(function() {
        $('#basic-datatables').DataTable();
        $('#basic-datatables1').DataTable();
        $('#basic-datatables2').DataTable();

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