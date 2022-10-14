@extends('admin.layout.master')

@section('title', 'Category List')

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
                            <h2 class="title-1 me-5">Category List</h2>
                            <p class="me-5">Total : {{ $categories->total() }} <i class="fa-solid fa-database"></i></p>
                            <p class="me-5">SearchKey : <span class="text-danger">{{ request('key') }}</span></p>
                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('category#createPage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add category
                            </button>
                        </a>
                    </div>
                </div>

                @if (session('categoryDelete'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fa-solid fa-trash"></i> {{ session('categoryDelete')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                @if (session('categoryUpdate'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong><i class="fa-solid fa-pen"></i> {{ session('categoryUpdate')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                <div class="mb-3">
                    <form class="form-header" action="{{route('category#list') }}" method="get">
                        @csrf
                        <input class="au-input au-input--xl" type="text" name="key" placeholder="Search for categories ..." value="{{ request('key') }}" />
                        <button class="au-btn--submit" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                </div>

                @if (count ($categories) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>category name</th>
                                <th>created at</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $cat )
                            <tr class="tr-shadow">
                                <td>{{ $cat->id }}</td>
                                <td>{{ $cat->name }}</td>
                                <td>{{ $cat->created_at->format('j-F-Y')}}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{ route('category#editPage', $cat->id) }}" method="get">
                                            <button class="item me-3" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('category#delete', $cat->id) }}">
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
                        {{ $categories->links() }}
                    </div>
                </div>
                @else
                <h3 class="text-secondary text-center mt-5">There is no Category Data here.</h3>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
