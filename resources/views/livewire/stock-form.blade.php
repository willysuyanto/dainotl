<div class="card-body">
    {!! Form::open(['route' => 'stock.store', 'method' => 'POST', 'spellcheck' => 'false', 'autocomplete' => 'off']) !!}
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div wire:ignore class="form-group">
            <strong>Nomor SO</strong>
            <select  name="so_number" wire:change="$emit('selected_so',$event.target.value)" id="select-so" class="form-control">
                <option value="">Pilih Nomor SO</option>
                @foreach($supplies as $key => $supply)
                <option value="{{$supply->id}}">{{$supply->so_number}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Item BBM Datang</strong>
            <select name="selected_item" id="select-so1" class="form-control">
                <option value="">Pilih Item BBM Datang</option>
                @foreach($items as $key => $item)
                <option value="{{$item->id}}">{{$item->product()->get()->first()->product_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <input type="hidden" name="shift" value="{{$shift}}">
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
{{-- @push('js')
<script>
//     $(document).ready(function() {

//         $('#select-so').select2({
//             theme:'bootstrap',
//             placeholder: 'Pilih nomor SO'
//         })

//         $('#select-so').on('change', (e)=>{
//             @this.set('selectedSO', e.target.value);
//         })

//         $('#select-so1').select2({
//             theme:'bootstrap',
//             placeholder: 'Pilih item BBM datang'
//         });

// });
</script>
@endpush --}}