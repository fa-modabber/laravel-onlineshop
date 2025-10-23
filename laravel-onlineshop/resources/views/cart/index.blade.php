@extends('layout.master')
@section('title', 'Cart Page')

@section('content')
    @if (empty($cart))
        <div class="cart-empty">
            <div class="text-center">
                <div>
                    <i class="bi bi-basket-fill" style="font-size:80px"></i>
                </div>
                <h4 class="text-bold">سبد خرید شما خالی است</h4>
                <a href="{{ route('products.menu') }}" class="btn btn-outline-dark mt-3">مشاهده محصولات</a>
            </div>
        </div>
    @else
        <section class="single_page_section layout_padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="row gy-5">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                            <tr>
                                                <th>محصول</th>
                                                <th>نام</th>
                                                <th>قیمت</th>
                                                <th>تعداد</th>
                                                <th>قیمت کل</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cart as $key => $item)
                                                <tr>
                                                    <th>
                                                        <img class="rounded"
                                                            src="{{ product_image_url($item['primary_image']) }}"
                                                            width="100" alt="" />
                                                    </th>
                                                    <td class="fw-bold">{{ $item['name'] }}</td>
                                                    <td>
                                                        @if ($item['is_on_sale'])
                                                            <div>
                                                                <del>{{ number_format($item['price']) }}</del>
                                                                {{ number_format($item['sale_price']) }}
                                                                تومان
                                                            </div>
                                                            <div class="text-danger">
                                                                {{ $item['sale_percent'] }}%
                                                                تخفیف
                                                            </div>
                                                        @else
                                                            <div>
                                                                {{ number_format($item['price']) }}
                                                                تومان
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="input-counter">
                                                            <a href="{{ route('cart.increment', ['product_id' => $key]) }}"
                                                                class="plus-btn">
                                                                +
                                                            </a>
                                                            <div class="input-number">{{ $item['qty'] }}</div>
                                                            <a href="{{ route('cart.decrement', ['product_id' => $key]) }}"
                                                                class="minus-btn">
                                                                -
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @php
                                                            $price = $item['is_on_sale']
                                                                ? $item['sale_price']
                                                                : $item['price'];
                                                        @endphp
                                                        <span>{{ number_format($item['qty'] * $price) }}</span>
                                                        <span class="ms-1">تومان</span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('cart.remove', ['product_id' => $key]) }}">
                                                            <i class="bi bi-x text-danger fw-bold fs-4 cursor-pointer"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <a href="{{ route('cart.clear') }}" class="btn btn-primary mb-4">پاک کردن سبد خرید</a>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <form class="col-12 col-md-6" action="{{ route('cart.check-coupon') }}" method="POST">
                                @csrf
                                <div class="input-group mb-3">
                                    <input name="code" value="{{ old('code') }}" type="text" class="form-control" placeholder="کد تخفیف" />
                                    <button type="submit" class="input-group-text" id="basic-addon2">اعمال کد
                                        تخفیف</button>
                                </div>
                                <div class="form-text text-danger">
                                    @error('code')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </form>
                            <div class="col-12 col-md-6 d-flex justify-content-end align-items-baseline">
                                <div>
                                    انتخاب آدرس
                                </div>
                                <select style="width: 200px;" class="form-select ms-3" aria-label="Default select example">
                                    <option selected>منزل</option>
                                    <option value="1">محل کار</option>
                                </select>
                                <a href="profile.html" class="btn btn-primary">
                                    ایجاد آدرس
                                </a>
                            </div>
                        </div>

                        <div class="row justify-content-center mt-5">
                            <div class="col-12 col-md-6">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <h5 class="card-title fw-bold">مجموع سبد خرید</h5>
                                        <ul class="list-group mt-4">
                                            <li class="list-group-item d-flex justify-content-between">
                                                <div>مجموع قیمت :</div>
                                                <div>
                                                    {{ number_format($cart_total_price) }} تومان
                                                </div>
                                            </li>
                                            @php
                                                if (request()->session()->has('coupon')) {
                                                    $coupon = request()->session()->get('coupon');
                                                    $coupon_code = $coupon['code'];
                                                    $coupon_percentage = $coupon['percentage'];
                                                    $coupon_price = ($coupon_percentage * $cart_total_price) / 100;
                                                    $discounted_price = $cart_total_price - $coupon_price;
                                                }
                                            @endphp

                                            @if (isset($coupon) && $coupon != 0)
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <div>تخفیف :
                                                        <span class="text-danger ms-1">{{ $coupon_percentage }}%</span>
                                                    </div>
                                                    <div class="text-danger">
                                                        {{ number_format($coupon_price) }} تومان
                                                    </div>
                                                </li>
                                            @endif
                                            <li class="list-group-item d-flex justify-content-between">
                                                <div>قیمت پرداختی :</div>
                                                <div>
                                                    @if (isset($coupon) && $coupon != 0)
                                                        تومان {{ number_format($discounted_price) }}
                                                    @else
                                                        تومان {{ number_format($cart_total_price) }}
                                                    @endif
                                                </div>
                                            </li>
                                        </ul>
                                        <button class="user_option btn-auth mt-4">پرداخت</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
