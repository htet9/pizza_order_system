@extends('user.layouts.master')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Info</h3>
                        </div>
                        @if (session('updateSuccess'))
                            <div>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong><i class="fa-solid fa-circle-check mx-2"></i>{{ session('updateSuccess')}}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <hr>
                        <form action="{{ route('user#accountChange', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="row mb-3 justify-content-center">
                                        @if (Auth::user()->image == null)
                                            <img src="{{ asset('image/default_user.jpg') }}" class="rounded-circle shadow-sm" style="width: 250px" />
                                        @else
                                            <img src="{{ asset('storage/'.Auth::user()->image) }}" class="rounded-circle shadow-sm" style="width: 250px"/>
                                        @endif
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="form-group">
                                            <label for="image">Select Image</label>
                                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-2 mx-4">
                                        <button type="submit" class="btn btn-dark rounded">
                                            <span id="payment-button-amount">Update</span>
                                            <i class="fa-solid fa-circle-right"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="role" class="control-label mb-1">Role</label>
                                            <input id="role" name="role" type="text" value="{{ old('role', Auth::user()->role) }}" class="form-control" aria-required="true" aria-invalid="false" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="control-label mx-2 mb-1">Name</label>
                                            <input id="name" name="name" type="text" value="{{ old('name', Auth::user()->name) }}" class="form-control mx-2 @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Name">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="control-label mb-1">Email</label>
                                            <input id="email" name="email" type="email" value="{{ old('email', Auth::user()->email) }}" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Email">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="control-label mx-2 mb-1">Phone</label>
                                            <input id="phone" name="phone" type="text" value="{{ old('phone', Auth::user()->phone) }}" class="form-control mx-2 @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="gender" class="control-label mb-1">Gender</label>
                                            <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                                                <option value="">Choose gender...</option>
                                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                                <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                                <option value="others" @if (Auth::user()->gender == 'others') selected @endif>Others</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="control-label mb-1">Address</label>
                                            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" cols="50" rows="4" placeholder="Enter Admin Address">{{ old('address', Auth::user()->address) }}</textarea>
                                            @error('address')
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

@endsection
