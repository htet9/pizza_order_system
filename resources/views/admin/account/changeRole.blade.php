@extends('admin.layout.master')

@section('title', 'Admin Role Change')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('admin#list') }}">
                            <div class="ms-3">
                                <i class="fa-solid fa-circle-left text-dark"></i>
                            </div>
                        </a>
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Role</h3>
                        </div>
                        <hr>
                        <form action="{{ route('admin#change', $account->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="row mb-5 justify-content-center">
                                        @if ($account->image == null)
                                            <img src="{{ asset('image/default_user.jpg') }}" class="rounded-circle shadow-sm" style="width: 250px" />
                                        @else
                                            <img src="{{ asset('storage/'.$account->image) }}" class="rounded-circle" />
                                        @endif
                                    </div>
                                    <div class="row mt-2">
                                        <button type="submit" class="btn btn-warning">
                                            <span id="payment-button-amount">Change</span>
                                            <i class="fa-solid fa-circle-right"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="role" class="control-label mb-1">Role</label>
                                            <select name="role" class="form-control">
                                                <option value="admin" @if($account->role == 'admin') selected @endif>Admin</option>
                                                <option value="user" @if($account->role == 'user') selected @endif>User</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="control-label mb-1">Name</label>
                                            <input disabled id="name" name="name" type="text" value="{{ old('name', $account->name) }}" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Admin Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="control-label mb-1">Email</label>
                                            <input disabled id="email" name="email" type="email" value="{{ old('email', $account->email) }}" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Admin Email">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="control-label mb-1">Phone</label>
                                            <input disabled id="phone" name="phone" type="text" value="{{ old('phone', $account->phone) }}" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone">
                                        </div>
                                        <div class="form-group">
                                            <label for="gender" class="control-label mb-1">Gender</label>
                                            <select disabled name="gender" id="gender" class="form-control">
                                                <option value="">Choose gender...</option>
                                                <option value="male" @if ($account->gender == 'male') selected @endif>Male</option>
                                                <option value="female" @if ($account->gender == 'female') selected @endif>Female</option>
                                                <option value="others" @if ($account->gender == 'others') selected @endif>Others</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="control-label mb-1">Address</label>
                                            <textarea disabled name="address" id="address" class="form-control" cols="5" rows="3" placeholder="Enter Admin Address">{{ old('address', $account->address) }}</textarea>
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
