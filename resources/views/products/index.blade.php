@extends('layouts.master', ['title' => 'محصولات'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/Product.css') }}">

@endpush

@push('scripts')
    <script rel="stylesheet" src="{{ asset('JS/Product.js') }}"></script>
@endpush

@section('content')
    <div class="mainBox customizeLayout">
        <div class="horizontalPart">
            <div class="horizontalRightPart">
                <ul>
                    <li><a href="{{ route('pages.home') }}">خانه</a></li>
                    /
                    <li><a href="{{ route('products.index') }}">آرشیو محصولات</a></li>
                    @if(request()->input('gender'))
                        /
                        <li><a href="{{ route('products.index', ['gender' => request()->input('gender')]) }}">{{ \App\Models\ProductGender::find(request()->input('gender'))->title }}</a></li>
                    @endif
                    @if(request()->input('category'))
                        /
                        <li><a href="{{ route('products.index', ['category' => request()->input('category')]) }}">{{ \App\Models\ProductCategory::find(request()->input('category'))->title }}</a></li>
                    @endif
                </ul>
            </div>
            <div class="horizontalLeftPart">
                <div class="productAmount">
                    <p>مجموع محصولات در حال نمایش: </p>
                    <span id="counter">{{ $products->count() }}</span>
                </div>
                <div class="sortProduct">
                    <select name="sorting" id="sort" oninput="selectMode()">
                        <option value="1">قدیمی ترین</option>
                        <option value="2">جدید ترین</option>
                        <option value="3">ارزان ترین</option>
                        <option value="4">گران ترین</option>
                    </select>
                </div>
                <div class="searchProduct">
                    <input type="search" name="searchBox" id="searchBox" placeholder="محصول مورد نظر خود را وارد کنید">
                    <button id="search" onclick="searchProduct()">&#9935;</button>
                </div>
            </div>
        </div>
        <div class="contectBox">
            <div class="helpPart">
                <div class="latestMenProduct">
                    <h1><a href="{{ route('products.index', ['gender' => '1']) }}">آخرین محصولات مردانه</a></h1>
                    @foreach($latestMenProducts as $menProduct)
                        <div class="smallShowProduct">
                            <div class="smallImage">
                                <a href="{{ route('products.show', $menProduct) }}"><img src="{{ asset('IMAGE/' . ($menProduct->photos[0] ?? 'product/notfound.jpg')) }}" alt="{{ $menProduct->title }}"></a>
                            </div>
                            <div class="smallDetail">
                                <a href="{{ route('products.show', $menProduct) }}"><p>{{ $menProduct->title }}</p></a>
                                @if($menProduct->off_price)
                                    <del>{{ $menProduct->price }} ريال</del>
                                    <ins>{{ $menProduct->off_price }} ريال</ins>
                                @else
                                    <ins>{{ $menProduct->price }} ريال</ins>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr>
                <div class="latestWomenProduct">
                    <h1><a href="{{ route('products.index', ['gender' => '2']) }}">آخرین محصولات زنانه</a></h1>
                    @foreach($latestWomenProducts as $womenProduct)
                        <div class="smallShowProduct">
                            <div class="smallImage">
                                <a href="{{ route('products.show', $womenProduct) }}"><img src="{{ asset('IMAGE/' . ($womenProduct->photos[0] ?? 'product/notfound.jpg')) }}" alt="{{ $womenProduct->title }}"></a>
                            </div>
                            <div class="smallDetail">
                                <a href="{{ route('products.show', $womenProduct) }}"><p>{{ $womenProduct->title }}</p></a>
                                @if($womenProduct->off_price)
                                    <del>{{ $womenProduct->price }} ريال</del>
                                    <ins>{{ $womenProduct->off_price }} ريال</ins>
                                @else
                                    <ins>{{ $womenProduct->price }} ريال</ins>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr>
                <div class="allTags">
                    <h1>تگ ها</h1>
                    @foreach($tags as $tag)
                        <button><a href="{{ route('products.index', ['tags[]' => $tag->id ]) }}">{{ $tag->title }}</a></button>
                    @endforeach
                </div>
            </div>
            <div id="productBox" class="showProduct">
                @foreach($products as $product)
                    <div id="{{ $product->id }}" data-price="{{ $product->off_price ?? $product->price  }}"
                         data-name="{{ $product->title }}" class="imageBox">
                        @if($product->off_price) <span class="discount"></span> @endif
                        <a href="{{ route('products.show', $product) }}"><img src="{{ asset('IMAGE/' . ($product->photos[0] ?? 'product/notfound.jpg')) }}"
                                        alt="skirt4"></a>
                        <div class="secondImageBox">
                            <a href="{{ route('products.show', $product) }}"><img src="{{ asset('IMAGE/' . ($product->photos[1] ?? 'product/notfound.jpg')) }}" alt="skirt4"></a>
                            <a href="{{ route('products.show', $product) }}">
                                <div>جزئیات</div>
                            </a>
                        </div>
                        <div class="productName">
                            <a href="{{ route('products.show', $product) }}"><p>{{ $product->title }}</p></a>
                            <a href="{{ route('cart') }}"><img src="{{ asset('IMAGE/menu/ShopingCartLogo.png') }}"
                                            alt="ShopingCartLogo"></a>
                        </div>
                        @if($product->tags)
                            <div class="tag">
                                @foreach($product->tags as $tag)
                                    <span><a href="{{ route('products.index', ['tags[]' => $tag->id]) }}">{{ $tag->title }}</a></span> {{ !$loop->last ? ',' : '' }}
                                @endforeach
                            </div>
                        @endif
                        <div class="price">
                            @if($product->off_price)
                                <del>{{ $product->price }} ريال</del>
                                <ins id="{{ $product->off_price }}">{{ $product->off_price }} ريال</ins>
                            @else
                                <ins id="{{ $product->price }}">{{ $product->price }} ريال</ins>
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="horizontalPart">
            <div id="pagination" class="pagination"></div>
        </div>
    </div>
@endsection
