@extends('admin.layout.master')

@section('title', 'Product Update')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="ms-3">
                            <i class="fa-solid fa-circle-left" onclick="history.back()"></i>
                        </div>
                        <div class="card-title">
                            <h3 class="text-center title-2">Update Info</h3>
                        </div>
                        <hr>
                        <form action="{{ route('pizza#update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
                                    <div class="row justify-content-center">
                                        <img src="{{ asset('storage/'.$pizza->image) }}" />
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="image">Select Image</label>
                                            <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid @enderror">
                                            @error('pizzaImage')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <a href="{{ route('pizza#update') }}">
                                            <button type="submit" class="btn btn-warning">
                                                <span id="payment-button-amount">Update</span>
                                                <i class="fa-solid fa-circle-right"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="pizzaName" class="control-label mb-1">Name</label>
                                            <input id="pizzaName" name="pizzaName" type="text" value="{{ old('pizzaName', $pizza->name) }}" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name">
                                            @error('pizzaName')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="pizzaCategory" class="control-label mb-1">Category</label>
                                            <select name="pizzaCategory" id="pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror">
                                                <option value="">Choose category...</option>
                                                @foreach ($category as $cat)
                                                <option value="{{$cat->id}}" @if ($cat->id == $pizza->category_id) selected @endif>{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('pizzaCategory')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="pizzaDescription" class="control-label mb-1">Description</label>
                                            <textarea name="pizzaDescription" id="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" cols="5" rows="3" placeholder="Enter Pizza Description">{{ old('pizzaDescription', $pizza->description) }}</textarea>
                                            @error('pizzaDescription')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="pizzaPrice" class="control-label mb-1">Price</label>
                                            <input id="pizzaPrice" name="pizzaPrice" type="number" value="{{ old('pizzaPrice', $pizza->price) }}" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Price">
                                            @error('pizzaPrice')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="pizzaWaitingTime" class="control-label mb-1">Waiting Time</label>
                                            <input id="pizzaWaitingTime" name="pizzaWaitingTime" type="number" value="{{ old('pizzaWaitingTime', $pizza->waiting_time) }}" class="form-control @error('pizzaWaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza waitingTime">
                                            @error('pizzaWaitingTime')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
