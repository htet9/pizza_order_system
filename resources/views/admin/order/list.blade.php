@extends('admin.layout.master')

@section('title', 'Order List')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left col-6 d-flex">
                        <h2 class="title-1 me-5">Order List</h2>
                        <p class="mt-2 me-3">Total : {{count($order)}} <i class="fa-solid fa-database"></i></p>
                    </div>
                </div>

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 mt-4">
                        <thead>
                            <tr class="col-lg-12">
                                <th>user id</th>
                                <th>user name</th>
                                <th>order date</th>
                                <th>order code</th>
                                <th>amount</th>
                                <th>status</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($order as $o)
                            <tr class="col-lg-12 tr-shadow">
                                <input type="hidden" class="orderId" value="{{ $o->id }}">
                                <td>{{ $o->user_id }}</td>
                                <td>{{ $o->user_name }}</td>
                                <td>{{ $o->created_at->format('F-j-Y') }}</td>
                                <td>
                                    <a href="{{ route('admin#listInfo', $o->order_code) }}" class="text-info">{{ $o->order_code }}</a>
                                </td>
                                <td>{{ $o->total_price }} MMK</td>
                                <td>
                                    <select name="status" class="statusChange text-center rounded">
                                        <option value="0" @if($o->status == 0) selected @endif>Pending</option>
                                        <option value="1" @if($o->status == 1) selected @endif>Accept</option>
                                        <option value="2" @if($o->status == 2) selected @endif>Cancel</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection

@section('scriptSection')
<script>
    $(document).ready(function() {
        $('.statusChange').change(function() {
            $parentNode = $(this).parents('tr');
            $currentStatus = $(this).val();
            $orderId = $parentNode.find('.orderId').val();

            $data = {
                'status' : $currentStatus,
                'orderId' : $orderId,
            };

            $.ajax({
                type : 'get',
                url : '/order/ajax/change/status',
                data : $data,
                dataType : 'json',
            });
            location.reload();
        })
    });
</script>
@endsection
