@extends('layouts.master', ['title' => 'نمایش محصول'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/SingleProduct.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('JS/SingleProduct.js') }}"></script>
@endpush

@section('content')
    <div class="mainBox singleProduct">
        <div class="verticalPart">
            <div class="productRoute">
                <ul>
                    <li><a href="{{ route('pages.home') }}">خانه</a></li>
                    /
                    <li>
                        <a href="{{ route('products.index', ['gender' => $product->gender->id]) }}">{{ $product->gender->title }}</a>
                    </li>
                    /
                    <li>
                        <a href="{{ route('products.index', ['category' => $product->category->id]) }}">{{ $product->category->title }}</a>
                    </li>
                </ul>
            </div>
            <div class="productDescription">
                <h1>{{ $product->title }}</h1>
                <h2>{{ $product->description }}</h2>
                @if($product->off_price)
                    <del>{{ $product->price }} ريال</del>
                    <ins>{{ $product->off_price }} ريال</ins>
                @else
                    <ins>{{ $product->price }} ريال</ins>
                @endif
            </div>
            <div class="productCounter">
                <form action="{{ route('add_to_cart', $product) }}" method="POST">
                    @csrf
                    <input type="button" value="+" onclick="increment()">
                    <input type="number" name="quantity" value="1" id="productQuantity">
                    <input type="button" value="-" onclick="decrement()">
                    <input type="submit" value="افزودن به سبد خرید">
                </form>
            </div>
            <div class="productDetail">
                <div class="productCategory">
                    <span>دسته بندی: </span>
                    <p>
                        <a href="{{ route('products.index', ['category' => $product->category->id]) }}">{{ $product->category->title }}</a>
                    </p>
                </div>
                <div class="productTag">
                    <span>تگ ها: </span>

                    @foreach($product->tags as $tag)
                        <p><a href="{{ route('products.index', ['tags[]' => $tag->id ]) }}">{{ $tag->title }}</a>
                        </p> {{ !$loop->last ? '،' : '' }}
                    @endforeach
                </div>
            </div>
        </div>
        <div class="verticalPart">
            <div class="productImage">
                <img id="show" src="{{ asset('IMAGE/' . ($product->photos[0] ?? 'product/notfound.jpg')) }}" alt="{{ $product->title }}">
            </div>
            <div class="allImage">
                <img onclick="selectFirstImage()" id="first" src="{{ asset('IMAGE/' . ($product->photos[0] ?? 'product/notfound.jpg')) }}"
                     alt="{{ $product->title }}">
                <img onclick="selectSecondImage()" id="second" src="{{ asset('IMAGE/' . ($product->photos[1] ?? 'product/notfound.jpg')) }}"
                     alt="{{ $product->title }}">
            </div>
        </div>
        <div class="horizontalPart">
            <div class="tab">
                <button onclick="descriptionTab()">توضیحات</button>
                <button onclick="commentTab()">نظر ها (0)</button>
            </div>
            <div id="description" class="tabcontent">
                <p>{{ $product->title }}</p>
                <p>{{ $product->description }}</p>
            </div>
            <div id="comment" class="tabcontent">
                <div class="user">
                    <p>حسین پورقدیری</p>
                </div>
                <div class="userComment">
                    <p>لباس بسیار مناسبی است.</p>
                </div>
                <hr>
                <div class="newComment">
                    <form action="">
                        <textarea name="comment" placeholder="نظر خود را بنویسید ..."></textarea>
                        <input type="submit" value="ثبت نظر">
                    </form>
                </div>
            </div>
        </div>
        <div class="partition">
            <h1>آخرین محصولات مشابه</h1>
            <hr>
        </div>
        <div class="relatedProduct">
            @foreach($similarProducts as $similarProduct)
                <div class="imageBox">
                    <span class="discount"></span>
                    <a href="{{ route('products.show', $similarProduct) }}"><img src="{{ asset('IMAGE/' . ($similarProduct->photos[0] ?? 'product/notfound.jpg')) }}" alt="{{ $similarProduct->title }}"></a>
                    <div class="secondImageBox">
                        <a href="{{ route('products.show', $similarProduct) }}"><img src="{{ asset('IMAGE/' . ($similarProduct->photos[1] ?? 'product/notfound.jpg')) }}" alt="{{ $similarProduct->title }}"></a>
                        <a href="{{ route('products.show', $similarProduct) }}">
                            <div>جزئیات</div>
                        </a>
                    </div>
                    <div class="productName">
                        <a href="{{ route('products.show', $similarProduct) }}"><p>{{ $similarProduct->title }}</p></a>
                        <a href="{{ route('products.show', $similarProduct) }}"><img src="{{ asset('IMAGE/menu/ShopingCartLogo.png') }}" alt="ShopingCartLogo"></a>
                    </div>
                    <div class="tag">
                        @foreach($similarProduct->tags as $tag)
                            <span><a href="{{ route('products.index', ['tags[]' => $tag->id ]) }}">{{ $tag->title }}</a></span> {{ !$loop->last ? '،' : '' }}
                        @endforeach
                    </div>
                    <div class="price">
                        @if($similarProduct->off_price)
                            <del>{{ $similarProduct->price }} ريال</del>
                            <ins>{{ $similarProduct->off_price }} ريال</ins>
                        @else
                            <ins>{{ $similarProduct->price }} ريال</ins>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
