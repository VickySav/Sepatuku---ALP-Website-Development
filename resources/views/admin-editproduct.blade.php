@section("title", "Admin - CRUD")
@section("title", "Admin - Edit Product")
@extends("Template.admin-main")
<style>
    .alert {
      padding: 20px;
      opacity: 1;
      transition: opacity 0.6s;
      margin-bottom: 15px;
    }

    .alert.success {background-color: #D4EDDA;color:#155724; border-radius: 5px;}
    .alert.danger {background-color: #F9D7DA; color: #721C23; border-radius:5px;}

    .closebtnsuccess {
      margin-left: 15px;
      color: #78A27F;
      font-weight: bold;
      float: right;
      font-size: 22px;
      line-height: 20px;
      cursor: pointer;
      transition: 0.3s;
    }
    .closebtndanger {
      margin-left: 15px;
      color: #B77B7F;
      font-weight: bold;
      float: right;
      font-size: 22px;
      line-height: 20px;
      cursor: pointer;
      transition: 0.3s;
    }

    .closebtndanger:hover{
      color: black;
    }
    .closebtnalert:hover{
        color: black
    }
</style>

@section("body")
<body>
    <section class="login_box_area section_gap">
        <div class="container ft-30">
            <div class="table-wrapper">
                {{-- <h2>halo</h2> --}}
                @if (session()->has('success'))
                    <div class="alert success">
                        <span class="closebtnsuccess">&times;</span>
                        {{ session()->get('success') }}
                    </div>
                @endif

                @if($errors->any())
                <div class="alert danger">
                    <span class="closebtndanger">&times;</span>
                    @foreach ($errors->all() as $e)
                    {{ $e }} <br>
                    @endforeach
                  </div>
                @endif

                @if (session()->has('error'))
                <div class="alert danger">
                    <span class="closebtndanger">&times;</span>
                    {{ session()->get('error') }}
                  </div>
                @endif

                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2 class="text-white">Manage Products</h2>
                        </div>
                        <div class="col sm-12 md-9">
                            <a href="#addProductModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Product</span></a>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($products as $product)
                        <tr>
                            <td>{{$product->nama_produk}}</td>
                            <td><img class="img-fluid" src="/{{$product->image}}" alt="" width="200px"></td>
                            <td>{{$product->deskripsi}}</td>
                            <td style="width:200px;">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>

                            <td>
                                {{-- data-id="{{ $product->produk_id }}" id="edit_{{ $product->produk_id }}" data-toggle="modal" onclick="sendIdToController({{ $product->produk_id }})" --}}
                                {{-- <a href="{{ route('ShowEditProduct', ['id' => $product->produk_id]) }}" class="edit" > --}}
                                <a href="#editProductModal" class="edit" data-toggle="modal" >
                                    <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                </a>
                                <a href="{{ route('DeleteProduct', ['id' => $product->produk_id]) }}" class="delete">
                                    <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                </a>

                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

                <div class="clearfix">
                    <div class="hint-text">Showing <b>{{ $products->count() }}</b> out of <b>{{ $products->total() }}</b> entries</div>
                     {{ $products->links() }}
                </div>
            </div>
        </div>

       <!-- Edit Modal HTML -->
        <div id="editProductModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('EditProduct') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Product</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="produkid" name="produkid" value="{{$produk->produk_id}}">
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ $produk->nama_produk }}">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea id="description" name="description" class="form-control description">{{ $produk->deskripsi }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <div class="dropdown">
                                    <button style="width: 340px;" class="btn btn-secondary dropdown-toggle btn-light" type="button" id="category" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        @if ($produk->kategori_id == 1)
                                            Laki laki
                                        @elseif ($produk->kategori_id == 2)
                                            Perempuan
                                        @else
                                            Anak anak
                                        @endif
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <a class="dropdown-item" href="#" id="1" onclick="changeButtonText(this)">Laki laki</a>
                                        <a class="dropdown-item" href="#" id="2" onclick="changeButtonText(this)">Perempuan</a>
                                        <a class="dropdown-item" href="#" id="3" onclick="changeButtonText(this)">Anak anak</a>
                                    </div>
                                    <input type="hidden" id="selected_category_id" name="kategori_id" value="{{ $produk->kategori_id }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" id="price" name="price" class="form-control price" value="{{ $produk->harga }}">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Size</label>
                                        @foreach ($dproduct as $d)
                                            <input type="text" class="form-control size" id="size" name="size[]" value="{{ $d->ukuran }}"><br>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        @foreach ($dproduct as $d)
                                            <input type="text" class="form-control amount" id="amount" name="amount[]" value="{{ $d->jumlah }}"><br>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" id="image" name="image" class="form-control image">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{route('manageproduct')}}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-info">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


</body>
<script>
    function changeButtonText(element) {
        // Get the text content of the clicked dropdown item
        var newText = element.textContent.trim();

        // Find the dropdown button element
        var dropdownButton = document.getElementById('category');

        // Set the text content of the dropdown button to the clicked item's text
        dropdownButton.textContent = newText;

        // Get the id of the clicked element
        var clickedId = element.id;

        // Set the value of the hidden input field
        document.getElementById('selected_category_id').value = clickedId;

        // Optionally, submit the form if you want to auto-submit on selection
        // document.getElementById('yourFormId').submit();
    }
</script>
<script>
    var close = document.getElementsByClassName("closebtndanger");
    var i;

    for (i = 0; i < close.length; i++) {
      close[i].onclick = function(){
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; },1);
      }
    }

    var close = document.getElementsByClassName("closebtnsuccess");
    var i;

    for (i = 0; i < close.length; i++) {
      close[i].onclick = function(){
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; },1);
      }
    }
</script>
<script>
    function sendIdToController(productId) {
        // Implement the function to handle the product ID
        console.log("Product ID:", productId);
        // You can use AJAX to send the ID to the controller if needed
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Find all elements with class 'edit' and trigger a click event on them
        document.querySelectorAll('.edit').forEach(function (element) {
            element.click();
        });
    });
</script>
<script>
    function changeButtonText(element) {
        var newText = element.textContent.trim();
        var dropdownButton = document.getElementById('category');
        dropdownButton.textContent = newText;
        var clickedId = element.id;
        document.getElementById('selected_category_id').value = clickedId;
    }
</script>
@endsection
