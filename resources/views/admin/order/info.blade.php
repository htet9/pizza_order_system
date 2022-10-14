@extends('admin.layout.master')

@section('title', 'Order Info')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <a href="{{ route('admin#orderList')}}" class="text-dark mb-3"><i class="fa-solid fa-circle-chevron-left me-1"></i>Back</a>
                <!-- DATA TABLE -->
                <div class="card">
                    <h3 class="card-header">Order Info</h3>
                    <div class="card-body">
                      <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="row mb-2">
                                <div class="col"><p><i class="fa-solid fa-user mx-4"></i>Name</p></div>
                                <div class="col">{{ $orderList[0]->user_name }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col"><p><i class="fa-solid fa-qrcode mx-4"></i>Order Code</p></div>
                                <div class="col">{{ $orderList[0]->order_code }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col"><p><i class="fa-regular fa-clock mx-4"></i>Order Date</p></div>
                                <div class="col">{{ $orderList[0]->created_at->format('F-j-Y') }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col"><p><i class="fa-solid fa-bicycle mx-4"></i>Delivery Fees</p></div>
                                <div class="col">3000 MMK</div>
                            </div>
                            <div class="row">
                                <div class="col"><p><i class="fa-solid fa-sack-dollar mx-4"></i>Total</p></div>
                                <div class="col">{{ $order->total_price }} MMK<small class="text-danger mx-1">(delivery charges included)</small></div>
                            </div>
                        </div>
                      </div>
                      <details>
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 mt-4">
                                <thead>
                                    <tr class="col-lg-12">
                                        <th>id</th>
                                        <th>image</th>
                                        <th>name</th>
                                        <th>price</th>
                                        <th>qty</th>
                                        <th>total</th>
                                    </tr>
                                </thead>
                                <tbody id="dataList">
                                    @foreach ($orderList as $o)
                                    <tr class="col-lg-12 tr-shadow">
                                        <td>{{ $o->id }}</td>
                                        <td><img src="{{ asset('storage/'. $o->product_image) }}" style="width: 50px; height: 50px"></td>
                                        <td>{{ $o->product_name }}</td>
                                        <td>{{ $o->product_price }} MMK</td>
                                        <td>{{ $o->qty }}</td>
                                        <td>{{ $o->total }} MMK</td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </details>
                    </div>
                  </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
