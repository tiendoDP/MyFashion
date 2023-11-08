<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CartModel;

class QuantityCart extends Component
{
    public $carts = null;

    public function mount() {
        $this->updateCartData();
    }

    private function updateCartData() {
        $this->carts = CartModel::getRecord();
    }

    public function decrementQuantity($id) {
        $cart = $this->carts->firstWhere('id', $id);
        if (!$cart) {
            $this->dispatch('show-alert', 'Cart not exist!');
            return;
        }
        $cart->decrement('quantity');
        $cart->money = $cart->quantity * $cart->price;
        $cart->save();
        $this->updateCartData();
    }

    public function incrementQuantity($id) {
        $cart = $this->carts->firstWhere('id', $id);
        if (!$cart) {
            $this->dispatch('show-alert', 'Cart not exist!');
            return;
        }
        $cart->increment('quantity');
        $cart->money = $cart->quantity * $cart->price;
        $cart->save();
        $this->updateCartData();
    }

    public function render()
    {
        return view('livewire.quantity-cart', [
            'all_cart' => $this->carts
        ]);
    }
}
