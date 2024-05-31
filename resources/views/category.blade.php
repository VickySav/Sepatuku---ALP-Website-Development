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
                            <ul>
                                <form class="form-inline">
                                    <div class="form-group mr-2">
                                        <label for="input1" class="sr-only">Input 1</label>
                                        <input type="text" class="form-control form-control-sm small-input" id="rupiah" placeholder="Input 1" style="width: 90px;" oninput="formatNumber(this)">
                                    </div>
                                    <div class="form-group">
                                        <label for="input2" class="sr-only">Input 2</label>
                                        <input type="text" class="form-control form-control-sm small-input" id="rupiah" placeholder="Input 1" style="width: 90px;" oninput="formatNumber(this)">
                                    </div>
                                </form>
                            <ul>
                           <br> <br> <br>
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


	<!-- Modal Quick Product View -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="container relative">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="product-quick-view">
					<div class="row align-items-center">
						<div class="col-lg-6">
							<div class="quick-view-carousel">
								<div class="item" style="background: url(img/organic-food/q1.jpg);">

								</div>
								<div class="item" style="background: url(img/organic-food/q1.jpg);">

								</div>
								<div class="item" style="background: url(img/organic-food/q1.jpg);">

								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="quick-view-content">
								<div class="top">
									<h3 class="head">Mill Oil 1000W Heater, White</h3>
									<div class="price d-flex align-items-center"><span class="lnr lnr-tag"></span> <span class="ml-10">$149.99</span></div>
									<div class="category">Category: <span>Household</span></div>
									<div class="available">Availibility: <span>In Stock</span></div>
								</div>
								<div class="middle">
									<p class="content">Mill Oil is an innovative oil filled radiator with the most modern technology. If you are
										looking for something that can make your interior look awesome, and at the same time give you the pleasant
										warm feeling during the winter.</p>
									<a href="#" class="view-full">View full Details <span class="lnr lnr-arrow-right"></span></a>
								</div>
								<div class="bottom">
									<div class="color-picker d-flex align-items-center">Color:
										<span class="single-pick"></span>
										<span class="single-pick"></span>
										<span class="single-pick"></span>
										<span class="single-pick"></span>
										<span class="single-pick"></span>
									</div>
									<div class="quantity-container d-flex align-items-center mt-15">
										Quantity:
										<input type="text" class="quantity-amount ml-15" value="1" />
										<div class="arrow-btn d-inline-flex flex-column">
											<button class="increase arrow" type="button" title="Increase Quantity"><span class="lnr lnr-chevron-up"></span></button>
											<button class="decrease arrow" type="button" title="Decrease Quantity"><span class="lnr lnr-chevron-down"></span></button>
										</div>

									</div>
									<div class="d-flex mt-20">
										<a href="#" class="view-btn color-2"><span>Add to Cart</span></a>
										<a href="#" class="like-btn"><span class="lnr lnr-layers"></span></a>
										<a href="#" class="like-btn"><span class="lnr lnr-heart"></span></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <script>
       var rupiah = document.getElementById('rupiah');
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, 'Rp. ');
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
    </script>
@endsection
