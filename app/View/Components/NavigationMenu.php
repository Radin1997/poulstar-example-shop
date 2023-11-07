<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class NavigationMenu extends Component
{
    public Collection $inCartProducts;
    public array $cart;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->inCartProducts = Product::query()->whereIn('id', [])->get();

        $cartSessionInCollection = collect(session('cart') ?? []);

        $this->cart = $cartSessionInCollection->mapWithKeys(function($item){
            return [$item['product_id'] => $item];
        })->toArray();

        if(session()->has('cart')) {
            $this->inCartProducts = Product::query()->whereIn('id', $cartSessionInCollection->pluck('product_id')->toArray())->get();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navigation-menu');
    }
}
