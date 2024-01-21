<?php

namespace App\Livewire\Products;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProductModel;

class Filter extends Component
{
    use WithPagination;

    private $products;
    public $countProduct, $cate, $cateKey =[], $price = 1000000, $sortPrice, $keyword = '';
    protected $queryString = ['cateKey'];

    protected $paginationTheme = 'bootstrap';

    public function mount($cate) {
        $this->cate = $cate;
        $this->countProduct = count(ProductModel::getRecord());
        $this->products = ProductModel::paginate(6);
    }

    public function notFilter() {
        $this->products = ProductModel::paginate(6);
    }

    public function updatingFilter()
    {
        $this->resetPage();
    }

    public function applyFilter() {
        $this->products = ProductModel::
        when($this->cateKey, function($q) {
            $q->wherein('category_id', $this->cateKey);
        })
        ->when($this->sortPrice, function($q) {
            if($this->sortPrice !== 'all') $q->orderby('price', $this->sortPrice);
        })
        ->where('price', '<', $this->price)
        ->when($this->keyword, function($q) {
            $q->where('name', 'like', '%'.$this->keyword.'%');
        })
        ->paginate(6);
    }

    public function render()
    {
        return view('livewire.products.filter', ['products' => $this->products]);
    }
}
