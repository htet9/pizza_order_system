@extends('user.layouts.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid" style="height: 400px">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive offset-2 mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-2">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" id="dataTable">
                        @foreach ($order as $o)
                        <tr>
                            <td class="align-middle">{{ $o->created_at->format('F-j-Y') }}</td>
                            <td class="align-middle">{{ $o->order_code }}</td>
                            <td class="align-middle">{{ $o->total_price }} MMK</td>
                            <td class="align-middle">
                                @if ($o->status == 0)
                                    <span class="text-warning"><i class="fa-solid fa-spinner mx-1"></i>Pending</span>
                                @elseif ($o->status == 1)
                                    <span class="text-success"><i class="fa-regular fa-circle-check mx-1"></i>Success</span>
                                @elseif ($o->status == 2)
                                    <span class="text-danger"><i class="fa-solid fa-triangle-exclamation mx-1"></i>Cancelled</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <span>{{ $order->links() }}</span>
            </div>
        </div>
    </div>
    <!-- Cart End -->

@endsection
