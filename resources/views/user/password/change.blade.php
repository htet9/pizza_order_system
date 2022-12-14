@extends('user.layouts.master')

@section('content')
    <div class="col-6 offset-3">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Password Reset</h3>
                </div>
                @if (session('success'))
                    <div>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><i class="fa-solid fa-key mx-2"></i>{{ session('success')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
                <hr>
                <form action="{{ route('user#changePassword') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="oldPassword" class="control-label mb-1">Old Password</label>
                        <input id="oldPassword" name="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Old Password">
                        @error('oldPassword')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="newPassword" class="control-label mb-1">New Password</label>
                        <input id="newPassword" name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New Password">
                        @error('newPassword')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword" class="control-label mb-1">Confirm Password</label>
                        <input id="confirmPassword" name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Confirm Password">
                        @error('confirmPassword')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block">
                            <span id="payment-button-amount">Reset</span>
                            <span id="payment-button-sending" style="display:none;">Sending???</span>
                            <i class="fa-solid fa-key mx-1"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
