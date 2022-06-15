@extends('layouts.app')

@section('title')
    <title>Daino TL System | Shift 1</title>
@endsection

@section('breadcrumb')
    <div class="page-header">
        <h4 class="page-title">Shift 1 Pagi 06:00 - 14:00</h4>
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
                <a href="#">Shift 1</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-center">
                <h3>{{ Carbon\Carbon::Now()->format('d F Y') }}</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="sales-datatables" class="display table table-sm table-bordered">
                        <thead>
                            <tr style="background-color: #99cc00;">
                                <th>Nozzle</th>
                                <th>Jenis BBM</th>
                                <th>Totalizer Awal</th>
                                <th>Totalizer Akhir</th>
                                <th>Pulau</th>
                                <th>Penjualan (L)</th>
                                <th>Jumlah (Rp. )</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Total Shift 1</th>
                                <th>Pulau</th>
                                <th>{{ number_format($totalSalesQuantity, 1) }} Liter</th>
                                <th>Rp. {{ number_format($totalSalesAmount, 1) }}</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($nozzles as $index => $nozzle)
                                <tr>
                                    <td style="background-color: {{ $nozzle->product->color }};">{{ $index + 1 }}</td>
                                    <td style="background-color: {{ $nozzle->product->color }};">
                                        {{ $nozzle->product->product_name }}</td>
                                    <td style="background-color: {{ $nozzle->product->color }};">
                                        {{ number_format($nozzle->today_sales == null? $nozzle->past_sales->last_totalizer: $nozzle->today_sales->first_totalizer, 1) }}
                                    </td>
                                    <td style="background-color: {{ $nozzle->product->color }};">
                                        {{ number_format($nozzle->today_sales == null? $nozzle->past_sales->last_totalizer: $nozzle->today_sales->last_totalizer, 1) }}
                                    </td>
                                    <td>{{ $nozzle->group }}</td>
                                    <td style="background-color: {{ $nozzle->product->color }};">
                                        {{ number_format($nozzle->today_sales == null? 0 : $nozzle->today_sales->sales_on_litre, 1) }}</td>
                                    <td style="background-color: {{ $nozzle->product->color }};">
                                        Rp.{{ number_format($nozzle->today_sales == null? 0 : $nozzle->today_sales->sales_on_rupiah,1)}}
                                    </td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <button onclick="return false" data-shift="1"
                                                data-id="{{ $nozzle->id }}"
                                                data-last="{{ $nozzle->today_sales == null? $nozzle->past_sales->last_totalizer:$nozzle->today_sales->last_totalizer }}"
                                                class="setLastTotalizer btn btn-primary btn-xs">
                                                <span class="btn-label">
                                                    <i class="fa icon-pencil"></i>
                                                </span>
                                                Set Totalizer Akhir
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
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('customer.create') }}">
                    <button class="btn btn-primary btn-sm"><span class="btn-label">
                            <i class="fa icon-plus"></i>
                        </span>
                        Piutang Baru
                    </button>
                </a>
                <a href="{{ route('customer.create') }}">
                    <button class="btn btn-primary btn-sm"><span class="btn-label">
                            <i class="fa icon-plus"></i>
                        </span>
                        Pembayaran
                    </button>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="customer-datatables" class="display table table-sm table-bordered">
                        <thead>
                            <tr style="background-color: #99cc00;">
                                <th>Nama Pelanggan</th>
                                <th>Piutang Awal</th>
                                <th>Pembayaran</th>
                                <th>Piutang Baru</th>
                                <th>Total Piutang</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th>0</th>
                                <th>0</th>
                                <th>0</th>
                                <th>0</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td {{ $customer->initial_credit < 0 ? 'style=color:red' : '' }}>Rp.
                                        {{ $customer->initial_credit > 0 ? number_format($customer->initial_credit) : number_format($customer->initial_credit * -1) }}
                                    </td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>-</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('stock.create', ['shift' => 'shift1']) }}">
                    <button class="btn btn-primary btn-sm"><span class="btn-label">
                            <i class="fa icon-plus"></i>
                        </span>
                        Stok BBM Datang
                    </button>
                </a>
                <a href="{{ route('supply.create', ['shift' => '1']) }}">
                    <button class="btn btn-primary btn-sm"><span class="btn-label">
                            <i class="fa icon-plus"></i>
                        </span>
                        Penebusan BBM
                    </button>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="stock-datatables" class="display table table-sm table-bordered">
                        <thead>
                            <tr style="background-color: #99cc00;">
                                <th>Nama Produk</th>
                                <th>Persediaan Awal</th>
                                <th>BBM Datang</th>
                                <th>Barang Dagang</th>
                                <th>Jumlah Penjualan</th>
                                <th>Persediaan Akhir</th>
                                <th>Penebusan BBM</th>
                                <th>DO Belum Terkirim</th>
                                <th>DO Titipan</th>
                                {{-- <th>Aksi</th> --}}
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th>0</th>
                                <th>0</th>
                                <th>0</th>
                                <th>0</th>
                                <th>0</th>
                                <th>0</th>
                                <th>0</th>
                                <th>0</th>
                                {{-- <th></th> --}}
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td style="background-color: {{ $product->color }}">{{ $product->product_name }}
                                    </td>
                                    <td style="background-color: {{ $product->color }}">
                                        {{-- {{number_format($product->getTotalQuantity(),1)}} --}}
                                    </td>
                                    <td style="background-color: {{ $product->color }}">
                                        {{-- {{$product}} --}}
                                    </td>
                                    <td style="background-color: {{ $product->color }}">
                                        {{-- {{$product->pastStock('shift1')}} --}}
                                    </td>
                                    <td style="background-color: {{ $product->color }}">
                                        {{-- {{$product->pastSupplies('shift1')}} --}}
                                    </td>
                                    <td style="background-color: {{ $product->color }}">
                                        0
                                    </td>
                                    <td style="background-color: {{ $product->color }}">
                                        {{-- {{$product->todayFuelOrder('shift1')}} --}}
                                    </td>
                                    <td style="background-color: {{ $product->color }}">
                                        {{-- {{$product->todayFuelOrder('shift1')}} --}}
                                    </td>
                                    <td style="background-color: {{ $product->color }}">
                                        0
                                    </td>
                                    {{-- <td>
                                    <div class="row justify-content-center">
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
                                </td> --}}
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
    <script>
        $(document).ready(function() {

            $('#sales-datatables').DataTable({
                lengthChange: false,
                searching: false,
                paging: false,
                info: false,
                "columnDefs": [{
                    "visible": false,
                    "targets": 4
                }],
                "order": [
                    [4, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;

                    api.column(4, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                               
                            );

                            last = group;
                        }
                    });
                }
            });

            $('#customer-datatables').DataTable({
                lengthChange: false,
                searching: false,
                paging: false,
                info: false,
            });

            $('#stock-datatables').DataTable({
                lengthChange: false,
                searching: false,
                paging: false,
                info: false,
            });

            @if ($message = Session::get('success'))
                $.notify({
                    icon: 'flaticon-alarm-1',
                    title: 'Sukses',
                    message: '{{ $message }}',
                }, {
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



        $('.setLastTotalizer').click(function(e) {
            let shift = e.target.dataset.shift;
            let id = e.target.dataset.id;
            let last = e.target.dataset.last;
            let quantity = e.target.dataset.qty;
            let amount = e.target.dataset.amt;
            let URL = "{{ url('sales') }}" + "/1/" + id;
            var maskOptions = {
                lazy: true,
                mask: Number,
                signed: false,
                thousandsSeparator: '.'
            }
            var element = document.createElement('input');
            element.setAttribute("class", "form-control");
            element.setAttribute("placeholder", "Totalizer Akhir")
            element.value = last;
            var elementMask = IMask(element, maskOptions);
            swal({
                title: "Masukkan Totalizer Akhir",
                content: element,
                buttons: {
                    confirm: {
                        text: 'Simpan',
                        className: 'btn btn-success'
                    },
                    cancel: {
                        text: "Batal",
                        visible: true,
                        className: 'btn btn-danger'
                    }
                }
            }).then((okay) => {
                if (okay) {
                    $.ajax({
                        type: "POST",
                        url: URL,
                        header: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: {
                            _token: '{{ csrf_token() }}',
                            new_totalizer: elementMask.unmaskedValue,
                            last_totalizer: last,
                        },
                        success: function(data) {
                            swal.close();
                            console.log(data);
                            $.notify({
                                icon: 'flaticon-alarm-1',
                                title: 'Sukses',
                                message: data,
                            }, {
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
                            var errors = JSON.parse(XMLHttpRequest.responseText);
                            $.notify({
                                icon: 'flaticon-error',
                                title: 'Gagal',
                                message: errors.message,
                            }, {
                                type: 'danger',
                                placement: {
                                    from: "top",
                                    align: "center"
                                },
                                time: 500,
                                autoHideDelay: 1000,
                            });

                        }
                    });
                } else {
                    swal.close();
                }
            });
        });
    </script>
@endsection
