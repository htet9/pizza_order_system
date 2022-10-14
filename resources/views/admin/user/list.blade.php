@extends('admin.layout.master')

@section('title', 'User List')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool-left col-6 d-flex">
                    <h2 class="title-1 me-5">User List</h2>
                    <p class="mt-2 me-3">Total : {{ $users->total() }}<i class="fa-solid fa-database mx-1"></i></p>
                </div>

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 mt-4">
                        <thead>
                            <tr class="col-lg-12">
                                <th>image</th>
                                <th>name</th>
                                <th>email</th>
                                <th>gender</th>
                                <th>phone</th>
                                <th>address</th>
                                <th>role</th>
                                <th>delete</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($users as $user)
                                <tr class="col-lg-12 tr-shadow">
                                    <td>
                                        @if ($user->image == null)
                                        <img src="{{ asset('image/default_user.jpg') }}" class="rounded-circle shadow-sm">
                                        @else
                                            <img src="{{ asset('storage/'.$user->image) }}" class="rounded-circle shadow-sm">
                                        @endif
                                    </td>
                                    <input type="hidden" id="userId" value="{{ $user->id }}">
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>
                                        <select class="rounded statusChange">
                                            <option value="user" @if($user->role == 'user') selected @endif>User</option>
                                            <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="{{ route('admin#userDelete', $user->id) }}">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $users->links() }}
                    </div>
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
        //* role change
        $('.statusChange').change(function() {
            $parentNode = $(this).parents('tr');
            $currentStatus = $(this).val();
            $userId = $parentNode.find('#userId').val();

            $data = {'userId' : $userId, 'role': $currentStatus};

            $.ajax({
                type : 'get',
                url : '/user/change/role',
                data : $data,
                dataType : 'json',
            });
            location.reload();
        });
    });
</script>
@endsection
