<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function home(Request $request): View
    {
        $latestProducts = Product::query()
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();

        $latestMenProducts = Product::query()->whereHas('gender', function ($query) {
            return $query->where('id', 1);
        })
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        $latestWomenProducts = Product::query()->whereHas('gender', function ($query) {
            return $query->where('id', 2);
        })
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        return view('pages.home', [
            'latestProducts' => $latestProducts,
            'latestMenProducts' => $latestMenProducts,
            'latestWomenProducts' => $latestWomenProducts,
        ]);
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function faqs(): View
    {
        return view('pages.faqs');
    }

    public function policies(): View
    {
        return view('pages.policies');
    }
}
