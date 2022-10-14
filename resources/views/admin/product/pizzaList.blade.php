@extends('admin.layout.master')

@section('title', 'Pizza List')

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
                            <h2 class="title-1 me-5">Product List</h2>
                            <p class="me-5">Total : {{ $pizzas->total() }} <i class="fa-solid fa-database"></i></p>
                            <p class="me-5">SearchKey : <span class="text-danger">{{ request('key') }}</span></p>
                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('product#create') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add product
                            </button>
                        </a>
                    </div>
                </div>

                @if (session('pizzaDelete'))
                    <div class="col-5 offset-7">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fa-solid fa-trash"></i> {{ session('pizzaDelete')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                @if (session('pizzaUpdate'))
                    <div class="col-5 offset-7">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><i class="fa-solid fa-pen"></i> {{ session('pizzaUpdate')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                <div class="mb-3">
                    <form class="form-header" action="{{ route('product#list') }}" method="">
                        @csrf
                        <input class="au-input au-input--xl" type="text" name="key" placeholder="Search for pizza ..." value="{{ request('key') }}" />
                        <button class="au-btn--submit" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                </div>

                @if (count ($pizzas) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr class="col-lg-12">
                                <th>image</th>
                                <th>pizza name</th>
                                <th>price</th>
                                <th>category</th>
                                <th>viewer</th>
                                <th>actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pizzas as $pizza )
                            <tr class="col-lg-12 tr-shadow">
                                <td class="col-2"><img src="{{ asset('storage/'.$pizza->image) }}" class="img-thumbnail shadow-sm"></td>
                                <td class="col-2">{{ $pizza->name }}</td>
                                <td class="col-2">{{ $pizza->price }} MMK</td>
                                <td class="col-2">{{ $pizza->category_name }}</td>
                                <td class="col-2"><i class="fa-solid fa-eye"></i> {{ $pizza->view_count }}</td>
                                <td class="col-2">
                                    <div class="table-data-feature">
                                        <a href="{{ route('pizza#details', $pizza->id) }}">
                                            <button class="item me-1" data-toggle="tooltip" data-placement="top" title="View">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('pizza#edit', $pizza->id) }}" method="get">
                                            <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('pizza#delete', $pizza->id) }}">
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
                        {{ $pizzas->links() }}
                    </div>
                </div>
                @else
                <h3 class="text-secondary text-center mt-5">There is no Product Data here.</h3>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
