@extends('layout.master')
@section('title', 'Product Show')

@section('content')

    <section class="single_page_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="row gy-5">
                        <div class="col-md-6">
                            <h3 class="fw-bold mb-4">{{ $product->name }}</h3>

                            @if ($product->is_on_sale)
                                <h5 class="mb-3">
                                    <del>{{ number_format($product->price) }}</del>
                                    {{ number_format($product->sale_price) }}
                                    تومان
                                    <div class="text-danger fs-6">
                                        {{ $product->sale_percent }}% تخفیف
                                    </div>
                                </h5>
                            @else
                                <h5>
                                    {{ number_format($product->price) }}
                                    تومان
                                </h5>
                            @endif

                            <p>{{ $product->description }}</p>

                            <form x-data="{ quantity: 1 }" action="#" class="mt-5 d-flex">
                                <button class="btn-add">افزودن به سبد خرید</button>
                                <div class="input-counter ms-4">
                                    <span @click="quantity++" class="plus-btn">
                                        +
                                    </span>
                                    <div class="input-number" x-text="quantity"></div>
                                    <span @click="quantity > 1 && quantity--" class="minus-btn">
                                        -
                                    </span>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                        class="active"></button>
                                    @foreach ($product->images as $key => $image)
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="{{ $key + 1 }}"></button>
                                    @endforeach
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{ product_image_url($product->primary_image) }}" class="d-block w-100"
                                            alt="primary image" />
                                    </div>
                                    @foreach ($product->images as $image)
                                        <div class="carousel-item">
                                            <img src="{{ product_image_url($image->name) }}" class="d-block w-100"
                                                alt="other images" />
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr>

    <section class="food_section my-5">
        <div class="container">
            <div class="row gx-3 justify-content-center">
                @foreach ($randomProducts as $randomProduct)
                    @if ($randomProduct->id !== $product->id)
                        <div class="col-sm-6 col-lg-3">
                            <div class="box">
                                <div>
                                    <div class="img-box">
                                        <a href="{{ route('products.show', ['product' => $randomProduct->slug]) }}">
                                            <img class="img-fluid"
                                                src="{{ product_image_url($randomProduct->primary_image) }}"
                                                alt="img" />
                                        </a>
                                    </div>
                                    <div class="detail-box">
                                        <a href="{{ route('products.show', ['product' => $randomProduct->slug]) }}">
                                            <h6>
                                                {{ $randomProduct->name }}
                                            </h6>
                                        </a>
                                        <div class="options">
                                            @if ($randomProduct->is_on_sale)
                                                <h6 class="mb-3">
                                                    <del>{{ number_format($randomProduct->price) }}</del>
                                                    {{ number_format($randomProduct->sale_price) }}
                                                    تومان
                                                    <div class="text-danger fs-6">
                                                        {{ $randomProduct->sale_percent }}% تخفیف
                                                    </div>
                                                </h6>
                                            @else
                                                <h5>
                                                    {{ number_format($randomProduct->price) }}
                                                    تومان
                                                </h5>
                                            @endif
                                            <div class="d-flex">
                                                <a class="me-2" href="">
                                                    <i class="bi bi-cart-fill text-white fs-6"></i>
                                                </a>
                                                <a href="{{ route('wishlist-add-to' , ['product_id' => $randomProduct->id]) }}">
                                                    <i class="bi bi-heart-fill  text-white fs-6"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
@endsection
