<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CartModel;

class MoneyShipping extends Component
{
    public $total, $fnTotal;
 
    public function mount()
    {
        $this->total = CartModel::total();
        $this->fnTotal = $this->total;
    }

    public function finalTotal($tt) {
        if($tt == 0) {
            $this->fnTotal = $this->total;
            session()->put('type_shipping', 'Free shipping');
        }
        else if($tt == 10) {
            $this->fnTotal = $this->total + $tt;
            session()->put('type_shipping', 'Standart');
        }
        else {
            $this->fnTotal = $this->total + $tt;
            session()->put('type_shipping', 'Express');
        }
        session()->put('fntotal', $this->fnTotal);
    }

    public function render()
    {
        //dd($this->fnTotal);
        return view('livewire.money-shipping', [
            'total' => $this->total,
            'fnTotal' => $this->fnTotal
        ]);
    }
}
