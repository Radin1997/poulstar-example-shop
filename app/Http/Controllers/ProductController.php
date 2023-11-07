<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductTag;
use Illuminate\Cache\TaggableStore;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::query()
            ->with('tags')
            ->when($request->input('gender'), function (Builder $query) use ($request) {
                return $query->whereHas('gender', function ($query) use ($request) {
                    return $query->where('id', (int)$request->input('gender'));
                });
            })
            ->when($request->input('tags'), function (Builder $query) use ($request) {
                return $query->whereHas('tags', function ($query) use ($request) {
                    return $query->whereIn('id', $request->input('tags'));
                });
            })
            ->when($request->input('category'), function (Builder $query) use ($request) {
                return $query->whereHas('category', function ($query) use ($request) {
                    return $query->where('id', $request->input('category'));
                });
            })
            ->get();

        $latestMenProducts = Product::query()->whereHas('gender', function ($query) {
            return $query->where('id', 1);
        })
            ->limit(3)
            ->get();

        $latestWomenProducts = Product::query()->whereHas('gender', function ($query) {
            return $query->where('id', 2);
        })
            ->limit(3)
            ->get();

        $tags = ProductTag::all();

        return view('products.index', [
            'products' => $products,
            'latestMenProducts' => $latestMenProducts,
            'latestWomenProducts' => $latestWomenProducts,
            'tags' => $tags,
        ]);
    }

    public function show(Request $request, Product $product): View
    {
        $similarProducts = Product::query()->whereHas('category', function (Builder $query) use ($product) {
            return $query->where('id', $product->category->id);
        })
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();

        $product->load(['tags', 'category', 'gender']);
        return view('products.show', [
            'product' => $product,
            'similarProducts' => $similarProducts
        ]);
    }
}
