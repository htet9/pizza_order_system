@extends('admin.layout.master')

@section('title', 'Product Details')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="ms-3">
                            <i class="fa-solid fa-circle-left" onclick="history.back()"></i>
                        </div>
                        <div class="row mx-5">
                            <div class="col-4">
                                <img src="{{ asset('storage/'.$pizza->image) }}" />
                            </div>
                            <div class="col-7 offset-1">
                                <h3 class="mb-4">{{ $pizza->name }}</></h3>
                                <p class="mx-2 my-3"><i class="fa-solid fa-pizza-slice me-2"></i>{{ $pizza->category_name }}</p>
                                <p class="mx-2"><b><i class="fa-solid fa-circle-info me-2"></i></b>{{ $pizza->description }}</p>
                                <div class="my-4">
                                    <span class="btn bg-light text-danger"><b><i class="fa-solid fa-sack-dollar me-2"></i></b>{{ $pizza->price }} MMK</span>
                                    <span class="btn bg-light text-danger"><b><i class="fa-solid fa-hourglass-half me-2"></i></b>{{ $pizza->waiting_time }} min</span>
                                    <span class="btn bg-light text-danger"><b><i class="fa-solid fa-eye me-2"></i></b>{{ $pizza->view_count }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
