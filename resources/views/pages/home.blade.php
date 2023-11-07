@extends('layouts.master', ['title' => 'خانه'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/Home.css') }}">
@endpush

@section('content')
    <div class="mainBox">
        <div class="headerImage">
            <div class="rightHeader">
                <img class="imgRightTop" src="{{ asset('IMAGE/home/home-header-right-top.jpg') }}" alt="headerRightTop">
                <img class="imgRightBottom" src="{{ asset('IMAGE/home/home-header-right-bottom.jpg') }}" alt="headerRightBottom">
            </div>
            <div class="leftHeader">
                <img class="imgleft" src="{{ asset('IMAGE/home/home-header-left.jpg') }}" alt="hedareLeft">
            </div>

        </div>
        <div class="partition">
            <h1>آخرین محصولات</h1>
            <hr>
        </div>
        <div class="lastProduct">
            @foreach($latestProducts as $latestProduct)
                <div class="imageBox">
                    <span class="discount"></span>
                    <a href="{{ route('products.show', $latestProduct) }}"><img src="{{ asset('IMAGE/' . ($latestProduct->photos[0] ?? 'product/notfound.jpg')) }}" alt="{{ $latestProduct->title }}"></a>
                    <div class="secondImageBox">
                        <a href="{{ route('products.show', $latestProduct) }}"><img src="{{ asset('IMAGE/' . ($latestProduct->photos[1] ?? 'product/notfound.jpg')) }}" alt="{{ $latestProduct->title }}"></a>
                        <a href="{{ route('products.show', $latestProduct) }}"><div>جزئیات</div></a>
                    </div>
                    <div class="productName">
                        <a href="{{ route('products.show', $latestProduct) }}"><p>{{ $latestProduct->title }}</p></a>
                        <a href=""> <img src="{{ asset('IMAGE/menu/ShopingCartLogo.png') }}" alt="ShopingCartLogo"></a>
                    </div>
                    @if($latestProduct->tags)
                        <div class="tag">
                            @foreach($latestProduct->tags as $tag)
                                <span><a href="{{ route('products.index', ['tags[]' => $tag->id]) }}">{{ $tag->title }}</a></span> {{ !$loop->last ? ',' : '' }}
                            @endforeach
                        </div>
                    @endif
                    <div class="price">
                        @if($latestProduct->off_price)
                            <del>{{ $latestProduct->price }} ريال</del>
                            <ins>{{ $latestProduct->off_price }} ريال</ins>
                        @else
                            <ins>{{ $latestProduct->price }} ريال</ins>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="partition">
            <h1>آخرین محصولات مردانه</h1>
            <hr>
        </div>
        <div class="menProduct">
            @foreach($latestMenProducts as $latestMenProduct)
                <div class="imageBox">
                    <span class="discount"></span>
                    <a href="{{ route('products.show', $latestMenProduct) }}"><img src="{{ asset('IMAGE/' . ($latestMenProduct->photos[0] ?? 'product/notfound.jpg')) }}" alt="{{ $latestMenProduct->title }}"></a>
                    <div class="secondImageBox">
                        <a href="{{ route('products.show', $latestMenProduct) }}"><img src="{{ asset('IMAGE/' . ($latestMenProduct->photos[1] ?? 'product/notfound.jpg')) }}" alt="{{ $latestMenProduct->title }}"></a>
                        <a href="{{ route('products.show', $latestMenProduct) }}"><div>جزئیات</div></a>
                    </div>
                    <div class="productName">
                        <a href="{{ route('products.show', $latestMenProduct) }}"><p>{{ $latestMenProduct->title }}</p></a>
                        <a href=""> <img src="{{ asset('IMAGE/menu/ShopingCartLogo.png') }}" alt="ShopingCartLogo"></a>
                    </div>
                    @if($latestMenProduct->tags)
                        <div class="tag">
                            @foreach($latestMenProduct->tags as $tag)
                                <span><a href="{{ route('products.index', ['tags[]' => $tag->id]) }}">{{ $tag->title }}</a></span> {{ !$loop->last ? ',' : '' }}
                            @endforeach
                        </div>
                    @endif
                    <div class="price">
                        @if($latestMenProduct->off_price)
                            <del>{{ $latestMenProduct->price }} ريال</del>
                            <ins>{{ $latestMenProduct->off_price }} ريال</ins>
                        @else
                            <ins>{{ $latestMenProduct->price }} ريال</ins>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="partition">
            <h1>آخرین محصولات زنانه</h1>
            <hr>
        </div>
        <div class="womenProduct">
            @foreach($latestWomenProducts as $latestWomenProduct)
                <div class="imageBox">
                    <span class="discount"></span>
                    <a href="{{ route('products.show', $latestWomenProduct) }}"><img src="{{ asset('IMAGE/' . ($latestWomenProduct->photos[0] ?? 'product/notfound.jpg')) }}" alt="{{ $latestWomenProduct->title }}"></a>
                    <div class="secondImageBox">
                        <a href="{{ route('products.show', $latestWomenProduct) }}"><img src="{{ asset('IMAGE/' . ($latestWomenProduct->photos[1] ?? 'product/notfound.jpg')) }}" alt="{{ $latestWomenProduct->title }}"></a>
                        <a href="{{ route('products.show', $latestWomenProduct) }}"><div>جزئیات</div></a>
                    </div>
                    <div class="productName">
                        <a href="{{ route('products.show', $latestWomenProduct) }}"><p>{{ $latestWomenProduct->title }}</p></a>
                        <a href=""> <img src="{{ asset('IMAGE/menu/ShopingCartLogo.png') }}" alt="ShopingCartLogo"></a>
                    </div>
                    @if($latestWomenProduct->tags)
                        <div class="tag">
                            @foreach($latestWomenProduct->tags as $tag)
                                <span><a href="{{ route('products.index', ['tags[]' => $tag->id]) }}">{{ $tag->title }}</a></span> {{ !$loop->last ? ',' : '' }}
                            @endforeach
                        </div>
                    @endif
                    <div class="price">
                        @if($latestWomenProduct->off_price)
                            <del>{{ $latestWomenProduct->price }} ريال</del>
                            <ins>{{ $latestWomenProduct->off_price }} ريال</ins>
                        @else
                            <ins>{{ $latestWomenProduct->price }} ريال</ins>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
