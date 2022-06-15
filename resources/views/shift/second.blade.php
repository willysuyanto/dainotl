@extends('layouts.app')

@section('title')
    <title>Daino TL System | Shift 1</title>
@endsection

@section('breadcrumb')
    <div class="page-header">
        <h4 class="page-title">Shift 2 Siang 14:00 - 22:00</h4>
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
                <a href="#">Shift 2</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="sales-datatables" class="display table table-sm table-bordered">
                        <thead>
                            <tr style="background-color: #fcf305;">
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
                                <th>Total Shift 2</th>
                                <th>Pulau</th>
                                <th>{{ number_format($totalSalesQuantity) }} Liter</th>
                                <th>Rp. {{ number_format($totalSalesAmount) }}</th>
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
                                       {{  number_format(count($nozzle->todaySales('shift2')) > 0 ? $nozzle->todaySales('shift2')->sum('first_totalizer') : $nozzle->last_totalizer, 1) }}
                                    </td>
                                    <td style="background-color: {{ $nozzle->product->color }};">
                                        {{ number_format(count($nozzle->todaySales('shift2')) > 0 ? $nozzle->todaySales('shift2')->sum('last_totalizer') : $nozzle->last_totalizer, 1) }}
                                    </td>
                                    <td>{{ $nozzle->group }}</td>
                                    <td style="background-color: {{ $nozzle->product->color }};">
                                        {{ number_format(count($nozzle->todaySales('shift2')) > 0 ? $nozzle->todaySales('shift2')->sum('last_totalizer') - $nozzle->todaySales('shift2')->sum('first_totalizer'):"0", 1) }}</td>
                                    <td style="background-color: {{ $nozzle->product->color }};">Rp.
                                        {{ number_format(count($nozzle->todaySales('shift2')) > 0 ? ($nozzle->todaySales('shift2')->sum('last_totalizer') - $nozzle->todaySales('shift2')->sum('first_totalizer'))*$nozzle->product->selling_price :"0", 1) }}
                                    </td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <button onclick="return false" data-shift="shift2"
                                                data-id="{{ $nozzle->id }}"
                                                data-last="{{count($nozzle->todaySales('shift2')) > 0 ? $nozzle->todaySales('shift2')->sum('first_totalizer') : $nozzle->last_totalizer}}"
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
                                '<tr class="group"><td colspan="7">' + group + '</td></tr>'
                            );

                            last = group;
                        }
                    });
                }
            });

            @if ($message = Session::get('success'))
                $.notify({
                icon: 'flaticon-alarm-1',
                title: 'Sukses',
                message: '{{ $message }}',
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



        $('.setLastTotalizer').click(function(e) {
            let shift = e.target.dataset.shift;
            let id = e.target.dataset.id;
            let last = e.target.dataset.last;
            let URL = "{{ url('sales') }}" + "/shift2/" + id;
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
