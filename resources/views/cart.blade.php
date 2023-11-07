@extends('layouts.master', ['title' => 'سبد خرید'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/Cart.css') }}">
@endpush

@section('content')
    <div class="mainBox finalCart">
        <h1>سبد خرید</h1>
        <table>
            <thead>
            <tr>
                <th></th>
                <th>تصویر محصول</th>
                <th>نام محصول</th>
                <th>قیمت</th>
                <th>تعداد</th>
                <th>قیمت کل</th>
            </tr>
            </thead>
            <tbody>
            @foreach($inCartProducts as $inCartProduct)
                <tr>
                    <td>
                        <a href="{{ route('delete_from_cart', $inCartProduct) }}"><img class="removeImage" src="{{ asset('IMAGE/logo/removeIcon.png') }}" alt="removeIcon"></a>
                    </td>
                    <td>
                        <a href="{{ route('products.show', $inCartProduct) }}"><img class="productImage" src="{{ asset('IMAGE/' . ($inCartProduct->photos[0] ?? 'product/notfound.jpg')) }}" alt="{{ $inCartProduct->title }}"></a>
                    </td>
                    <td>{{ $inCartProduct->title }}</td>
                    <td>{{ $inCartProduct->getPrice() }} ريال</td>
                    <td>
                        <input type="button" value="+">
                        <input type="text" value="1">
                        <input type="button" value="-">
                    </td>
                    <td>{{ $cart->where('product_id', $inCartProduct->id)->first()['sum'] }} ريال</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="underTable">
            <div class="rightPart">
                <a href="{{ route('checkout') }}"><button>تایید نهایی</button></a>
            </div>
            <div class="leftPart">
                <input type="text" name="giftCode" placeholder="کد تخفیف خود را وارد کنید">
                <a href=""><button>ثبت کد تخفیف</button></a>
            </div>
        </div>
        <div class="factor">
            <table>
                <thead>
                <tr>
                    <th colspan="2">جمع بندی سبد خرید</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>جمع کل سبد خرید</td>
                    <td>{{ $total }} ﷼</td>
                </tr>
                <tr>
                    <td>هزینه ارسال</td>
                    <td>رایگان</td>
                </tr>
                <tr>
                    <td>کد تخفیف</td>
                    <td>ندارد</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>جمع کل </th>
                    <th>{{ $total }} ﷼</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
