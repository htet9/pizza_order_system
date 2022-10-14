@extends('user.layouts.master')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-body row">
          <div class="col-5 text-center d-flex align-items-center justify-content-center">
            <div class="">
              <h2>Pizza<strong>Shop</strong></h2>
              <p class="lead mb-5">123 Testing Ave, Testtown, 9876 NA<br>
                Phone: +1 234 56789012
              </p>
            </div>
          </div>
          <div class="col-7">
            <form action="{{ route('user#contactForm')}}" method="post">
                @csrf
                <div>
                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" name="name" id="inputName" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" />
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="inputEmail">E-Mail</label>
                        <input type="email" name="email" id="inputEmail" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" />
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="inputMessage">Message</label>
                        <textarea id="inputMessage" name="message" class="form-control @error('message') is-invalid @enderror" rows="4">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                      <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Send message">
                      </div>
                    </div>
                </div>
            </form>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
