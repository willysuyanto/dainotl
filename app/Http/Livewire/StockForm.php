<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Supply;

class StockForm extends Component
{
    public $supplies;
    public $items = [];
    
    public $selectedSO = null;
    public $selectedItem = null;
    public $shift;

    public $listeners = ['selected_so', 'selected_item'];

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function mount(){
        $this->supplies = Supply::all();

        if (old('so_number')) {
            $this->selectedSO = old('so_number');
        }
    }

    public function render()
    {
        return view('livewire.stock-form');
    }

    public function selected_so($value){
        info($value);
        $this->selectedSO = $value;
        $this->items = $this->supplies->find($this->selectedSO)->items->where('status','Dalam Perjalanan');
    }

    

    // public function updatedSelectedSO(){
    //     info($this->supplies->find($this->selectedSO)->items);
    //     $this->items = $this->supplies->find($this->selectedSO)->items;

    // }

}
