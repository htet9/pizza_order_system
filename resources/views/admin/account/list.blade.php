@extends('admin.layout.master')

@section('title', 'Admin List')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1 me-5">Admin List</h2>
                            <p class="me-5">Total : {{ $admin->total() }} <i class="fa-solid fa-database"></i></p>
                            <p class="me-5">SearchKey : <span class="text-danger">{{ request('key') }}</span></p>
                        </div>
                    </div>
                </div>

                @if (session('deleteSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fa-solid fa-trash"></i> {{ session('deleteSuccess')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                <div class="mb-3">
                    <form class="form-header" action="{{route('admin#list') }}" method="get">
                        @csrf
                        <input class="au-input au-input--xl" type="text" name="key" placeholder="Search for admins ..." value="{{ request('key') }}" />
                        <button class="au-btn--submit" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                </div>

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>image</th>
                                <th>name</th>
                                <th>email</th>
                                <th>gender</th>
                                <th>phone</th>
                                <th>address</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admin as $a )
                            <tr class="tr-shadow">
                                <input type="hidden" id="adminId" value="{{ $a->id }}">
                                <td>
                                    @if ($a->image == null)
                                    <img src="{{ asset('image/default_user.jpg') }}" class="shadow-sm rounded-circle">
                                    @else<img src="{{ asset('storage/'.$a->image) }}" class="shadow-sm rounded-circle">
                                    @endif
                                </td>
                                <td>{{ $a->name }}</td>
                                <td>{{ $a->email }}</td>
                                <td>{{ $a->gender }}</td>
                                <td>{{ $a->phone }}</td>
                                <td>{{ $a->address }}</td>
                                <td>
                                    <div class="table-data-feature">
                                         @if (Auth::user()->id == $a->id)
                                        @else
                                            <select class="statusChange rounded me-2">
                                                <option value="admin">Admin</option>
                                                <option value="user">User</option>
                                            </select>
                                            <a href="{{ route('admin#delete', $a->id) }}">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $admin->links() }}
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
            $adminId = $parentNode.find('#adminId').val();

            $data = {'adminId' : $adminId, 'role': $currentStatus};

            $.ajax({
                type : 'get',
                url : '/admin/changeRole',
                data : $data,
                dataType : 'json',
            });
            location.reload();
        });
    });
</script>
@endsection
