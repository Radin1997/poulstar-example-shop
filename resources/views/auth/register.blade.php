@extends('layouts.master', ['title' => 'ثبت نام'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/Register.css') }}">
@endpush

@section('content')
    <div class="mainBox register">
        <h1>ثبت نام</h1>
        <hr>
        @if($errors->count() !== 0)
            <div class="alert-danger" style="padding: 2rem">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="registerBox">
            <form action="{{ route('process_registration') }}" method="POST" autocomplete="on">
                @csrf
                <input type="text" name="name" value="{{ old('name') }}"
                       placeholder="نام و نام خانوادگی خود را وارد کنید">
                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="شماره تماس خود را وارد کنید">
                <input type="text" name="email" value="{{ old('email') }}" placeholder="پست الکترونیک خود را وارد کنید">
                <input type="text" name="password" placeholder="رمز عبور خود را وارد کنید">
                <input type="submit" value="ارسال کن">
            </form>
        </div>
        <div class="guideBox">
            <p>فرم آزمایشی پروژه پل استار جهت آموزش بهتر و کاردبری تر با ضاهر مناسب جهت ارتباط گیری بیشتر با مبحث تحصیلی
                می باشد</p>
            <p>شماره تماس: 34911-013</p>
            <p>آدرس: گیلان - رشت - گلسار - چهار راه اصفهان</p>
            <p>پست الکترونیک: info@poulstar.com</p>
        </div>
    </div>
@endsection
