@section("title", "Sepatuku Cart")
@extends("template.main")
@section("body")
  <!-- Start Banner Area -->
  <section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Wishlist</h1>

            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->
<section class="cart_area">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="img/category/c3.jpg" width= 100 alt="">
                                    </div>
                                    <div class="media-body">
                                        <p>Nike Air</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5>$360.00</h5>
                            </td>

                            <td>
                                <a class="delete"><span class="ti-trash"></span></a>
                            </td>
                        </tr>
                        <tr class="out_button_area">

                            <td>

                            </td>
                    <td>
                        
                    </td>
                            <td>
                                <div class="checkout_btn_inner float-right d-flex align-items-center">
                                    <a class="primary-btn" href="#">Continue Shopping</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--================End Cart Area =================-->

@endsection
