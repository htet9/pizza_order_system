@extends('admin.layout.master')

@section('title', 'Contact List')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left col-6 d-flex">
                        <h2 class="title-1 me-5">Contact List</h2>
                        <p class="mt-2 me-3">Total : {{count($contact)}} <i class="fa-solid fa-database"></i></p>
                    </div>
                </div>

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 mt-4">
                        <thead>
                            <tr class="col-lg-12">
                                <th>user id</th>
                                <th>user name</th>
                                <th>user email</th>
                                <th>message</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($contact as $con)
                            <tr class="col-lg-12 tr-shadow">
                                <td>{{ $con->id }}</td>
                                <td>{{ $con->name }}</td>
                                <td>{{ $con->email }}</td>
                                <td>{{ $con->message }}</td>
                            </tr>
                            <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <div class="mt-3">
                        {{ $order->links() }}
                    </div> --}}
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
