<div class="mainBox menu">
    <ul>
        <a class="linkMenu" href="{{ route('pages.home') }}">
            <li>خانه</li>
        </a>
        <li class="dropdown">
            <button class="dropbtn">محصولات</button>
            <div class="dropdown-content">
                <a class="linkMenu" href="{{ route('products.index', ['gender' => '1']) }}">مردانه</a>
                <a class="linkMenu" href="{{ route('products.index', ['gender' => '2']) }}">زنانه</a>
                <a class="linkMenu" href="{{ route('products.index', ['gender' => '3']) }}">کودکانه</a>
            </div>
        </li>
        <a class="linkMenu" href="{{ route('pages.contact') }}">
            <li>تماس با ما</li>
        </a>
        <a class="linkMenu" href="{{ route('pages.faqs') }}">
            <li>سوالات متداول</li>
        </a>
        <a class="linkMenu" href="{{ route('pages.policies') }}">
            <li>قوانین و مقررات</li>
        </a>
        <li class="ShopingCartLogo dropdown">
            <span class="ShopingCartCounter center dropbtn">{{ count($cart) }}</span>
            <div class="dropdown-content">
                @unless(empty($cart))
                    <a class="btn" href="{{ route('cart') }}">فاکتور کن</a>
                    @foreach($inCartProducts as $inCartProduct)
                        <a class="linkMenu" href="{{ route('products.show', $inCartProduct) }}">
                            <img class="cart" src="{{ asset('IMAGE/' . ($inCartProduct->photos[0] ?? 'product/notfound.jpg')) }}" alt="dress1-1">
                            <div class="box">
                                <div class="detail">
                                    <span>{{ $inCartProduct->title }}</span>
                                    @if($inCartProduct->off_price)
                                        <del>{{ $inCartProduct->price }} ريال</del>
                                        <ins>{{ $inCartProduct->off_price }} ريال</ins>
                                    @else
                                        <ins>{{ $inCartProduct->price }} ريال</ins>
                                    @endif
                                    <span>تعداد: {{ $cart[$inCartProduct->id]['quantity'] }}</span>
                                    <ins> {{ $cart[$inCartProduct->id]['sum'] }} ريال</ins>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endunless
            </div>
        </li>
    </ul>
</div>
