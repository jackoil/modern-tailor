@extends('home.layouts.home')

@section('title')
    صفحه ای پروفایل
@endsection

@section('content')
    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="{{ route('home.index') }}">صفحه ای اصلی</a>
                    </li>
                    <li class="active"> پروفایل </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- my account wrapper start -->
    <div class="my-account-wrapper pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row text-right" style="direction: rtl;">
                            <div class="col-lg-3 col-md-4">
                                @include('home.sections.profile_sidebar')
                            </div>
                            <!-- My Account Tab Menu End -->
                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">

                                    <div class="myaccount-content">
                                        <h3> پروفایل </h3>
                                        <div class="account-details-form">
                                            <form method="POST" action="{{ route('home.users_profile.edit') }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="first_name" class="required">
                                                                نام
                                                            </label>
                                                            <input type="text" id="first_name" name="first_name"
                                                                value="{{ $first_name }}" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="last_name" class="required">
                                                                نام خانوادگی
                                                            </label>
                                                            <input type="text" id="last_name" name="last_name"
                                                                value="{{ $last_name }}" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="single-input-item">
                                                    <label for="email" class="required"> ایمیل </label>
                                                    <input type="email" name="email" id="email"
                                                        value="{{ $email }}" disabled />
                                                </div>

                                                <div class="single-input-item">
                                                    <button class="check-btn sqr-btn "> تبت تغییرات </button>
                                                </div>


                                            </form>
                                            <div class="col-lg-6"">

                                                @if (Auth::user()->hasVerifiedEmail())
                                                    <div class="alert alert-success" role="alert">
                                                        {{ __('Email has  confirmed already') }}
                                                    </div>
                                                @else
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ __('Email has not been confirmed') }}
                                                    </div>
                                                    <form method="POST" ,
                                                        action="{{ route('verification.send', ['email' => $email]) }}">
                                                        @csrf
                                                           <div class="single-input-item">
                                                        <button type="submit" class="check-btn sqr-btn "> تایید ایمیل
                                                        </button>
                                                           </div>
                                                    </form>
                                                    @if (session('status'))
                                                        <div class=" alert alert-info" role="alert">
                                                            {{  __(session('status')) }}
                                                        </div>
                                                    @endif
                                                @endif


                                            </div>
                                            <form action="#">
                                                <fieldset>
                                                    <legend> تغییر پسورد </legend>
                                                    <div class="single-input-item">
                                                        <label for="current-pwd" class="required">
                                                            رمز عبور
                                                        </label>
                                                        <input type="password" id="current-pwd" name="oldPassword" />
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="new-pwd" class="required">
                                                                    رمز عبور جدید
                                                                </label>
                                                                <input type="password" id="new-pwd" name="password" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="confirm-pwd" class="required"> تکرار
                                                                    رمز عبور </label>
                                                                <input type="password" id="confirm-pwd"
                                                                    name="password_confirmation" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <div class="single-input-item">
                                                    <button class="check-btn sqr-btn "> تغییر رمز عبور </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div> <!-- My Account Tab Content End -->
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>
    <!-- my account wrapper end -->

    <!-- Modal Order -->
    <div class="modal fade" id="ordersDetiles" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12" style="direction: rtl;">
                            <form action="#">
                                <div class="table-content table-responsive cart-table-content">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th> تصویر محصول </th>
                                                <th> نام محصول </th>
                                                <th> فی </th>
                                                <th> تعداد </th>
                                                <th> قیمت کل </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td class="product-thumbnail">
                                                    <a href="#"><img src="assets/img/cart/cart-3.svg"
                                                            alt=""></a>
                                                </td>
                                                <td class="product-name"><a href="#"> لورم ایپسوم </a></td>
                                                <td class="product-price-cart"><span class="amount">
                                                        20000
                                                        تومان
                                                    </span></td>
                                                <td class="product-quantity">
                                                    2
                                                </td>
                                                <td class="product-subtotal">
                                                    40000
                                                    تومان
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="product-thumbnail">
                                                    <a href="#"><img src="assets/img/cart/cart-4.svg"
                                                            alt=""></a>
                                                </td>
                                                <td class="product-name"><a href="#"> لورم ایپسوم متن ساختگی </a>
                                                </td>
                                                <td class="product-price-cart"><span class="amount">
                                                        10000
                                                        تومان
                                                    </span></td>
                                                <td class="product-quantity">
                                                    3
                                                </td>
                                                <td class="product-subtotal">
                                                    30000
                                                    تومان
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="product-thumbnail">
                                                    <a href="#"><img src="assets/img/cart/cart-5.svg"
                                                            alt=""></a>
                                                </td>
                                                <td class="product-name"><a href="#"> لورم ایپسوم </a></td>
                                                <td class="product-price-cart"><span class="amount">
                                                        40000
                                                        تومان
                                                    </span></td>
                                                <td class="product-quantity">
                                                    2
                                                </td>
                                                <td class="product-subtotal">
                                                    80000
                                                    تومان
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->
@endsection
