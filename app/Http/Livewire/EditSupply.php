<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class EditSupply extends Component
{
    public $supplyItems = [];
    public $allProducts = [];
    public $supply;

    public function mount()
    {
        $this->allProducts = Product::all();
        // $this->supplyItems = [
        //     ['material' => '', 'trip' => 1, 'trip_quantity' => 1]
        // ];
        // if (old('supplyItems')) {
        //     $this->supplyItems = old('supplyItems');
        // }
        foreach ($this->supply->items as $item) {
            $this->supplyItems[] = ['id' => $item->id, 'material' => $item->product()->first()->id, 'trip' => $item->trip, 'trip_quantity' => $item->trip_quantity];
        }
    }

    public function add()
    {
        $this->supplyItems[] = ['id' => '', 'material' => '', 'trip' => 1, 'trip_quantity' => 1];
    }

    public function remove($index)
    {
        unset($this->supplyItems[$index]);
        $this->supplyItems = array_values($this->supplyItems);
    }

    public function render()
    {
        //info($this->supplyItems);
        return view('livewire.edit-supply');
    }
}
