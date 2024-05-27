@section("title", "Sepatuku Cart")
@extends("template.main")
@section("body")
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shopping Cart</h1>
                    <nav class="d-flex align-items-center">
                        <a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="/cart">Cart</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->
    @if(isset($dataCart) && count($dataCart) > 0)
    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Select</th>
                                <th scope="col">Product</th>
                                <th scope="col">Size</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--================ Foreach dri Database =================-->

                                @csrf
                            @foreach ($dataCart as $cart)
                            @php
                                $nameStrip = str($cart->NAMA_PRODUK)->replace(' ', '-');
                            @endphp
                            <tr>

                                <td>

                                    <div class="form-check">
                                        <input class="mx-auto form-check-input cart-checkbox" type="checkbox" value="" id="">
                                      </div>
                                </td>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <a href="{{ url("/product-details/{$cart->PRODUK_ID}-{$nameStrip}")}}">
                                            <img src="{{ $cart->IMAGE }}" alt="" style="width: 100px; height:100px; object-fit:cover;">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <p>{{ $cart->NAMA_PRODUK }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>{{ $cart->UKURAN }}</h5>
                                </td>
                                <td>
                                    <h5>Rp {{ number_format($cart->HARGA, 0, ',', '.') }}</h5>
                                </td>
                                <td>
                                    <div class="product_count">
                                        <input type="number" style="width:80px" min=1 max=99 data-id="{{ $cart->PRODUK_ID }}" data-harga = "{{ $cart->HARGA }}" data-size= "{{ $cart->UKURAN }}" data-route="{{ route('updateCart') }}" name="qty" id="sst-{{ $cart->PRODUK_ID }}" maxlength="2" value="{{ $cart->JUMLAH }}" title="Quantity:" class="input-text cart-qty">
                                </div>
                                </td>
                                <td>

                                    <h5 class="totalAmount">Rp {{ number_format($cart->HARGA * $cart->JUMLAH, 0, ',', '.') }}</h5>
                                </td>

                                <td>

                                    <a class="delete" href="/cart"><span class="ti-trash cart-trash" data-id="{{ $cart->PRODUK_ID }}" data-size = "{{ $cart->UKURAN }}" data-route="{{ route('deleteCart') }}"></span></a>

                                </td>


                            </tr>

                            @endforeach
                             <!--================ Foreach dri Database =================-->
                            <tr>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <h5>Subtotal</h5>
                                </td>
                                <td>
                                    <h5>$2160.00</h5>
                                </td>
                            </tr>
                            <tr class="out_button_area">
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <div class="checkout_btn_inner d-flex align-items-center">
                                        <a class="gray_btn" href="/shop">Continue Shopping</a>
                                        <a class="primary-btn" href="#">Proceed to checkout</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    @else
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner text-center"> <!-- Add text-center class to center align the content -->
                <h1>Shopping Cart is Empty</h1>
                <br>
                <p>Enjoy online shopping at Sepatuku</p>
                <div class="checkout_btn_inner d-flex align-items-center justify-content-center"> <!-- Add justify-content-center class to center align the button -->
                    <a class="gray_btn" href="/shop">Continue Shopping</a>
                </div>
            </div>
        </div>
    </section>

    @endif
    <!--================End Cart Area =================-->
</body>
@endsection
