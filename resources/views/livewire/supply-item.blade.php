<div class="card-body">
    {!! Form::open(['route' => 'supply.store', 'method' => 'POST', 'spellcheck' => 'false', 'autocomplete' => 'off']) !!}
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nomor SO</strong>
            {!! Form::text('so_number', null, ['placeholder' => 'Nomor SO', 'class' => 'form-control', 'id' => 'so_number']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nomor Referensi (Optional)</strong>
            {!! Form::text('ref_number', null, ['placeholder' => 'Nomor Referensi', 'class' => 'form-control', 'id' => 'ref_number']) !!}
        </div>
    </div>
    {!! Form::hidden('shift', $shift) !!}
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <div class="card">
                <div class="card-header">
                    <strong>Item Pesanan BBM</strong>
                </div>
                <div class="card-body">
                    @foreach ($supplyItems as $index => $item)
                    <div class="row justify-content-center align-items-end">
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <strong>Jenis BBM</strong>
                                <div>
                                    <select name="supplyItems[{{$index}}][material]" wire:model="supplyItems.{{$index}}.material" class="form-control">
                                        <option value="">Pilih Jenis BBM</option>
                                        @foreach($allProducts as $product)
                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <strong>Jumlah Trip</strong>
                                <div><input type="number"
                                    name="supplyItems[{{$index}}][trip]"
                                    class="form-control"
                                    wire:model="supplyItems.{{$index}}.trip" /></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <strong>Quantity Per Trip (L)</strong>
                                <div><input type="number"
                                    name="supplyItems[{{$index}}][trip_quantity]"
                                    class="form-control"
                                    wire:model="supplyItems.{{$index}}.trip_quantity" /></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-2">
                            <div class="form-group">
                                <button wire:click.prevent="remove({{$index}})" class="btn btn-danger btn-block">
                                    <span class="btn-label">
                                        <i class="fa fa-times"></i>
                                    </span>
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>                                      
                    @endforeach
                </div>
                <div class="card-footer">
                    <div class="col-xs-12 col-sm-12 col-md-2">
                        <button wire:click.prevent="add" class="btn btn-primary btn-block">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Tambah Item
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div wire:ignore class="form-group">
            <strong>Harga Net</strong>
            {!! Form::text('', null, array('placeholder' => 'Harga Net', 'class' => 'form-control', 'id' => 'net_price', 'onchange' => 'unmask()')) !!}
            {!! Form::hidden('net_price', null, array('class' => 'form-control', 'id' => 'net_price_value')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div wire:ignore class="form-group">
            <strong>PPn</strong>
            {!! Form::text('', null, array('placeholder' => 'PPn', 'class' => 'form-control', 'id' => 'ppn', 'onchange' => 'unmask()')) !!}
            {!! Form::hidden('ppn_tax', null, array('class' => 'form-control', 'id' => 'ppn_taxes')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div wire:ignore class="form-group">
            <strong>PPBKB</strong>
            {!! Form::text('', null, array('placeholder' => 'PPBKB', 'class' => 'form-control', 'id' => 'ppbkb', 'onchange' => 'unmask()')) !!}
            {!! Form::hidden('ppbkb_tax', null, array('class' => 'form-control', 'id' => 'ppbkb_taxes')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div wire:ignore class="form-group">
            <strong>PPh</strong>
            {!! Form::text('', null, array('placeholder' => 'PPh', 'class' => 'form-control', 'id' => 'pph', 'onchange' => 'unmask()')) !!}
            {!! Form::hidden('pph_tax', null, array('class' => 'form-control', 'id' => 'pph_taxes')) !!}
        </div>
    </div>
</div>
<div class="card-footer row justify-content-end">
    <div class="col-xs-12 col-sm-12 col-md-2 mx-2 mb-2">
        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-2 mx-2">
        <a href="{{ URL::previous() }}" class="btn btn-danger btn-block"> Batal</a>
    </div>
</div>

{!! Form::close() !!}
