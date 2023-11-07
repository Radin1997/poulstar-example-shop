<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function cart(Request $request): View
    {
        $cart = collect(session('cart'));
        $inCartProducts = Product::query()->whereIn('id', $cart->pluck('product_id')->toArray())->get();
        $total = $cart->pluck('sum')->sum();

        return view('cart', [
            'cart' => $cart,
            'inCartProducts' => $inCartProducts,
            'total' => $total
        ]);
    }

    public function deleteFromCart(Request $request, Product $product): RedirectResponse
    {
        $cartSession = session('cart');
        $newCart = $cartSession;
        $cartCollection = collect($cartSession);
        $cartCollection = $cartCollection->reject(function($item) use($product){
            return $item['product_id'] === $product->id;
        });
        $newCart = $cartCollection->toArray();
        session()->put('cart', $newCart);

        return redirect()->route('cart');
    }

    public function addToCart(Request $request, Product $product): RedirectResponse
    {
        $cartSession = session('cart');
        $newCart = $cartSession;
        $cartCollection = collect($cartSession);
        $thisProductAlreadyExists = $cartCollection->contains('product_id', $product->id);

        $newItem = [
            'product_id' => $product->id,
            'quantity' => (int)$request->input('quantity'),
            'sum' => $request->input('quantity') * $product->getPrice()
        ];

        if ($cartSession) {
            if ($thisProductAlreadyExists) {
                // We will not be concerned about this edge case for now
            } else {
                $cartCollection->push($newItem);
            }
            $newCart = $cartCollection->toArray();
        } else {
            $newCart = [
                $newItem
            ];
        }

        session()->put('cart', $newCart);
        return redirect()->route('cart');
    }
}
