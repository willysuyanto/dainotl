<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class CreateNozzle extends Component
{
    public $nozzleProduct = [];
    public $products = [];

    public $listeners = ['selected_so', 'selected_item'];

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function mount()
    {
        $this->products = Product::all();
        $this->nozzleProduct = [
            []
        ];
    }

    public function add()
    {
        $this->nozzleProduct[] = [];
    }

    public function remove($index)
    {
        unset($this->nozzleProduct[$index]);
        $this->nozzleProduct = array_values($this->nozzleProduct);
    }

    public function render()
    {
        return view('livewire.create-nozzle');
    }
}
