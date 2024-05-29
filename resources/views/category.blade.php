@section("title", "JUDUL")
@extends("template.main")
@section("body")

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Shopping Page</h1>
					<nav class="d-flex align-items-center">
						<a href="/">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="/shop">Shop</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="sidebar-categories">
					<div class="head">Browse Categories</div>
					<ul class="main-categories">
                        <li class="main-nav-list clearKategori" data-route={{ route('clearFilter') }}><a data-toggle="collapse" aria-expanded="false"> All </a>
                        </li>
                        @foreach ($dataCategories as $kategori)
                           <li class="main-nav-list kategoriShop" data-kategori={{ $kategori->NAMA_KATEGORI }} data-id={{ $kategori->KATEGORI_ID }} data-route={{ route('filterCategory') }}><a data-toggle="collapse" aria-expanded="false">{{ $kategori->NAMA_KATEGORI }}</a>
                            </li>
                        @endforeach
					</ul>
				</div>
				<div class="sidebar-filter mt-50">
					<div class="top-filter-head">Product Filters</div>
					<div class="common-filter">
						<div class="head">Brands</div>
							<ul>
								<li class="filter-list" data-route="{{ route('filterBrand')}}" data-brand="Adidas"><label for="asus">Adidas</label></li>
                                <li class="filter-list" data-route="{{ route('filterBrand')}}" data-brand="Converse"><label for="micromax">Converse</label></li>
                                <li class="filter-list" data-route="{{ route('filterBrand')}}" data-brand="Nike"><label for="apple">Nike</label></li>
                                <li class="filter-list" data-route="{{ route('filterBrand')}}" data-brand="New Balance"><label for="micromax">New Balance</label></li>
                                <li class="filter-list" data-route="{{ route('filterBrand')}}" data-brand="Puma"><label for="samsung">Puma</label></li>
                                <li class="filter-list" data-route="{{ route('filterBrand')}}" data-brand="Reebok"><label for="gionee">Reebok</label></li>
								<li class="filter-list" data-route="{{ route('filterBrand')}}" data-brand="Skechers"><label for="gionee">Skechers</label></li>
								<li class="filter-list" data-route="{{ route('filterBrand')}}" data-brand="Under Armour"><label for="samsung">Under Armour</label></li>
								<li class="filter-list" data-route="{{ route('filterBrand')}}" data-brand="Vans"><label for="samsung">Vans</label></li>

							</ul>
                            <div class="head">Price</div>
                            <div class="head">

                                    <div class="form-group mr-2">
                                        <input type="text" class="form-control form-control-sm small-input minPrice" id="rupiah1" placeholder="MIN" style="width: 150px;">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm small-input maxPrice" id="rupiah2" placeholder="MAX" style="width: 150px;">
                                    </div>

                            </ul>
                                <button type="button" class="btn btn-secondary btn-apply" data-route="{{ route('filterPrice', ['minPrice' => 0, 'maxPrice' => 0]) }}" style="padding: 5px 10px; font-size: 12px; margin: 5px;"> Apply </button> </div>

                            <br>
                        </div>
				</div>
			</div>
			<div class="col-xl-9 col-lg-8 col-md-7">
				<!-- Start Filter Bar -->
				<div class="filter-bar d-flex flex-wrap align-items-center">
                    <div class="sorting mr-auto">
					</div>
					<div class="pagination">
						{{ $dataProducts->links() }}
					</div>
				</div>
				<!-- End Filter Bar -->
				<!-- Start Best Seller -->
				<section class="lattest-product-area pb-40 category-list">
					<div class="row">
						<!-- single product -->
                        @foreach ($dataProducts as $produk)
                        @php
                            $nameStrip = str($produk->NAMA_PRODUK)->replace(' ', '-');
                        @endphp
                        @if (Session::has('ACCOUNT_ID') || isset($_COOKIE['ACCOUNT_ID']))
						<div class="col-lg-4 col-md-6">
							<div class="single-product">
								<a href="{{ url("/product-details/{$produk->PRODUK_ID}-{$nameStrip}")}}"> <img class="img-fluid" src="/{{$produk->IMAGE}}" alt=""> </a>
								<div class="product-details">
									<h6 style="height: 57.56px">{{ $produk->NAMA_PRODUK }}</h6>
									<div class="price">
										<h6>Rp {{ number_format($produk->HARGA, 0, ',', '.') }}</h6>
									</div>
									<div class="prd-bottom">
										<a href="{{ url("/product-details/{$produk->PRODUK_ID}-{$nameStrip}")}}" class="social-info">
											<span class="ti-bag"></span>
											<p class="hover-text">add to bag</p>
										</a>
                                        <a class="social-info">
                                            <span id ="add-wishlist" class="lnr lnr-heart" data-id="{{ $produk->PRODUK_ID }}" data-route="{{ route('addWishlist') }}" ></span>
                                        <p class="hover-text">Wishlist</p> </a>
									</div>
								</div>
							</div>
						</div>
                        @else
                        <div class="col-lg-4 col-md-6">
							<div class="single-product">
								<a href="{{ url("/product-details/{$produk->PRODUK_ID}-{$nameStrip}")}}"> <img class="img-fluid" src="/{{$produk->IMAGE}}" alt=""> </a>
								<div class="product-details">
									<h6>{{ $produk->NAMA_PRODUK }}</h6>
									<div class="price">
										<h6>Rp {{ number_format($produk->HARGA, 0, ',', '.') }}</h6>
									</div>
									<div class="prd-bottom">
										<a href="{{ url("/product-details/{$produk->PRODUK_ID}-{$nameStrip}")}}" class="social-info">
											<span class="ti-bag"></span>
											<p class="hover-text">add to bag</p>
										</a>
                                        <a> </a>
									</div>
								</div>
							</div>
						</div>
                        @endif
                        @endforeach
						<!-- single product -->
					</div>
				</section>
				<!-- End Best Seller -->
				<!-- Start Filter Bar -->
				<div class="filter-bar d-flex flex-wrap align-items-center">
                    <div class="sorting mr-auto">
					</div>
					<div class="pagination">
						{{ $dataProducts->links() }}
					</div>
				</div>
				<!-- End Filter Bar -->
			</div>
		</div>
	</div>

	<!-- Start related-product Area -->
	<section class="related-product-area section_gap">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 text-center">
					<div class="section-title">
						<h1>You Might Also Like</h1>
					</div>
				</div>
			</div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <div class="row">
                            {{-- RANDOM PRODUCTS --}}
                            @foreach ($dataRandomProducts as $randomProduct)
                            <div class="col-lg-4 col-md-4 col-sm-6 mb-20 d-flex justify-content-center">
                                <div class="single-related-product d-flex">
                                    <a href="#"><img src="/{{ $randomProduct->IMAGE }}" alt="" style="height: 80px"></a>
                                    <div class="desc">
                                        <a href="#" class="title">{{ $randomProduct->NAMA_PRODUK }}</a>
                                        <div class="price">
                                            <h6>{{ $randomProduct->HARGA }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            {{-- RANDOM PRODUCTS --}}
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</section>
	<!-- End related-product Area -->

    <script>
       var rupiah1 = document.getElementById('rupiah1');
       var rupiah2 = document.getElementById('rupiah2');

       let minPrice=0;
       let maxPrice=0;
		rupiah1.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            // if(this.classList.contains("minPrice")){

            // } else if(this.classList.contains("maxPrice")){
            //     maxPrice = this.value;
            // }
            minPrice = this.value.replace(/\D/g, '');
			rupiah1.value = formatRupiah(this.value, 'Rp. ');
		});

        rupiah2.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            // if(this.classList.contains("minPrice")){
            //     minPrice = this.value;
            // } else if(this.classList.contains("maxPrice")){
            //     maxPrice = this.value;
            // }

            maxPrice = this.value.replace(/\D/g, '');
			rupiah2.value = formatRupiah(this.value, 'Rp. ');
		});

		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}

			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}


    $(document).ready(function () {
        $(".btn-apply").click(function () {
            if (maxPrice === 0 || minPrice === 0)
            {
                alert('Please fill the minimum/maximum price first');
            } else
            {
                var route = $(this).data("route");
                var token = $('meta[name="csrf-token"]').attr("content");
                $.ajax({
                    url: route,
                    type: "POST",
                    data: {
                        minPrice: minPrice,
                        maxPrice: maxPrice,
                        _token: token,
                    },
                    success: function (response) {
                        alert('SUKSES');
                        window.location.href = `/shop/${minPrice}-${maxPrice}`;

                        // Handle success, e.g., display a success message
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                        // Handle errors
                    },
                });
            }

        });
    });
    </script>
@endsection
