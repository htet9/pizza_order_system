@extends('user.layouts.master')

@section('content')

    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by category</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <label for="price-all">Categories</label>
                            <span class="badge border font-weight-normal">{{ count($category) }}</span>
                        </div>
                        <div class="custom-control d-flex align-items-center justify-content-between mb-3">
                            <a href="{{ route('user#home') }}" class="text-dark">
                                <label>All</label>
                            </a>
                        </div>
                        @foreach ($category as $cat)
                            <div class="custom-control d-flex align-items-center justify-content-between mb-3">
                                <a href="{{ route('user#filter', $cat->id) }}" class="text-dark">
                                    <label>{{ $cat->name }}</label>
                                </a>
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{ route('user#cartList') }}">
                                    <button type="button" class="btn btn-dark position-relative rounded text-bold text-light">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($cart) }}
                                        </span>
                                    </button>
                                </a>
                                <a href="{{ route('user#cartHistory') }}">
                                    <button type="button" class="btn btn-dark position-relative rounded text-bold text-light">
                                        <i class="fa-solid fa-clock-rotate-left mx-1"></i>History
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($history) }}
                                        </span>
                                    </button>
                                </a>
                            </div>

                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sorting" id="sortingOption" class="form-control">
                                        <option value="">Sorting</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="dataList">
                        @if (count($pizza) != 0)
                            @foreach ($pizza as $p)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" id="myForm">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height: 250px;" src="{{ asset('storage/'.$p->image) }}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href="{{ route('user#pizzaDetails', $p->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $p->price }}</h5><span class="mx-1">MMK</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h5 class="text-uppercase text-info p-5 mx-5"><i class="fa-solid fa-circle-exclamation"></i> There is no product here.</h5>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

@endsection

@section('scriptSource')
<script>
    $('#sortingOption').change(function() {
    $eventOption = $('#sortingOption').val();
    console.log($eventOption);

    if ($eventOption == 'asc') {
        $.ajax({
            type : 'get',
            url : '/user/ajax/pizza/list',
            data : {'status' : 'asc'},
            dataType : 'json',
            success : function(response){
                $list = '';
                for ($i = 0; $i < response.length; $i++) {
                    $list += `<a href="detail.html">
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" id="myForm">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height: 250px;" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price}</h5><span class="mx-1">MMK</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>`;
                }
                $('#dataList').html($list);
            }
        });
    } else if($eventOption == 'desc') {
        $.ajax({
            type : 'get',
            url : '/user/ajax/pizza/list',
            data : {'status' : 'desc'},
            dataType : 'json',
            success : function(response){
                $list = '';
                for ($i = 0; $i < response.length; $i++) {
                    $list += `<a href="detail.html">
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" id="myForm">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height: 250px;" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price}</h5><span class="mx-1">MMK</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>`;
                }
                $('#dataList').html($list);
            }
        });
    }
});
</script>
@endsection
