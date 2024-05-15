@section("title", "Admin - Trasaction")
@extends("template.admin-main")
@section("body")
<body>

    <section class="login_box_area section_gap">
        <div class="container ft-30">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2 class="text-white">All Transactions</h2>
                        </div>
                    </div>
                </div>
                <table class="table-admin">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Product</th>
                            <th>Image</th>
                            <th>Size</th>
                            <th>Amount</th>
                            <th>Price</th>
                          </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2023-05-01</td>
                            <td>John Doe</td>
                            <td>addidas New Hammer sole for Sports person</td>
                            <td><img class="img-fluid" src="/img/product/p1.jpg" alt="" width="100px"></td>
                            <td>Large</td>
                            <td>45</td>
                            <td>$20.00</td>
                          </tr>
                          <tr>
                            <td>2023-04-15</td>
                            <td>Jane Smith</td>
                            <td>addidas New Hammer sole for Sports person</td>
                            <td><img class="img-fluid" src="/img/product/p2.jpg" alt="" width="100px"></td>
                            <td>44</td>
                            <td>1</td>
                            <td>$15.00</td>
                          </tr>
                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                    <ul class="pagination">
                        <li class="page-item disabled"><a href="#">Previous</a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item active"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                        <li class="page-item"><a href="#" class="page-link">5</a></li>
                        <li class="page-item"><a href="#" class="page-link">Next</a></li>
                    </ul>
                </div>
            </div>
        </div>


	</section>



<!-- Bootstrap JS and dependencies -->

</body>

@endsection
