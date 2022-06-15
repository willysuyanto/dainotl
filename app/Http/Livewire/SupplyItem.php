<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class SupplyItem extends Component
{
    public $supplyItems = [];
    public $allProducts = [];
    public $shift;

    public function mount()
    {
        $this->allProducts = Product::all();
        $this->supplyItems = [
            ['material' => '', 'trip' => 1, 'trip_quantity' => 1]
        ];
        if (old('supplyItems')) {
            $this->supplyItems = old('supplyItems');
        }
    }

    public function add()
    {
        $this->supplyItems[] = ['material' => '', 'trip' => 1, 'trip_quantity' => 1];
    }

    public function remove($index)
    {
        unset($this->supplyItems[$index]);
        $this->supplyItems = array_values($this->supplyItems);
    }

    public function render()
    {
        //info($this->supplyItems);
        return view('livewire.supply-item');
    }
}
