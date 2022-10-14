@extends('admin.layout.master')

@section('title', 'Category List')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="row">
        <div class="col-3 offset-7 mb-2">
            @if (session('updateSuccess'))
                    <div class="">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><i class="fa-solid fa-pen"></i> {{ session('updateSuccess')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
        </div>
    </div>
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Info</h3>
                        </div>
                        <hr>
                        <div class="row mx-2 my-3">
                            <div class="col-4">
                                @if (Auth::user()->image == null)
                                    <img src="{{ asset('image/default_user.jpg') }}" class="rounded-circle shadow-sm" />
                                @else
                                    <img src="{{ asset('storage/'.Auth::user()->image) }}" class="rounded-circle" />
                                @endif
                            </div>
                            <div class="col">
                                <p class="mx-2 my-2"><b><i class="fa-solid fa-user"></i> : </b>{{ Auth::user()->name }}</p>
                                <p class="mx-2 my-2"><b><i class="fa-solid fa-envelope"></i> : </b>{{ Auth::user()->email }}</p>
                                <p class="mx-2 my-2"><b><i class="fa-solid fa-phone"></i> : </b>{{ Auth::user()->phone }}</p>
                                <p class="mx-2 my-2"><b><i class="fa-solid fa-map-location"></i> : </b>{{ Auth::user()->address }}</p>
                                <p class="mx-2 my-2"><b><i class="fa-solid fa-venus-mars"></i> : </b>{{ Auth::user()->gender }}</p>
                                <p class="mx-2 my-2"><b><i class="fa-regular fa-calendar-plus"></i> : </b>{{ Auth::user()->created_at->format('j-F-Y') }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <a href="{{ route('admin#edit') }}">
                                <div class="col">
                                    <button class="btn btn-info" type="submit"><i class="fa-solid fa-user-pen"></i> Edit</button>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
