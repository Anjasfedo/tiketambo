@extends('layouts.guest')

@section('content')
    <section class="section">
        <div class="d-flex flex-wrap align-items-stretch">
            <!-- Left side with registration form -->
            <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                <div class="p-4 m-3">
                    <img src="{{ asset('assets/images/stisla-fill.svg') }}" alt="logo" width="80"
                        class="shadow-light rounded-circle mb-5 mt-2" />
                    <h4 class="text-dark font-weight-normal">Create an Account on <span class="font-weight-bold">Mail</span>
                    </h4>
                    <p class="text-muted">Register to get started with our services.</p>

                    <!-- Registration Form -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name Input -->
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Email Input -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Confirm Password Input -->
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" required>
                            @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Already Registered and Submit Button -->
                        <!-- Sudah Punya Akun dan Tombol Daftar -->
                        <div class="form-group text-right">
                            <a href="{{ route('login') }}" class="float-left mt-3">Sudah punya akun? Masuk di sini</a>
                            <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                                Daftar
                            </button>
                        </div>

                    </form>

                    <div class="text-center mt-5 text-small">
                        Copyright &copy; Anjasfedo. Made with 💙 by Stisla
                    </div>
                </div>
            </div>

            <!-- Right side with background image and overlay text -->
            <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom"
                style="background-image: url('{{ asset('assets/images/unsplash/login-bg.jpg') }}');">
                <div class="absolute-bottom-left index-2">
                    <div class="text-light p-5 pb-2">
                        <div class="mb-5 pb-3">
                            <h1 class="mb-2 display-4 font-weight-bold">Join Us</h1>
                            <h5 class="font-weight-normal text-muted-transparent">Bali, Indonesia</h5>
                        </div>
                        Photo by <a class="text-light bb" target="_blank"
                            href="https://unsplash.com/photos/a8lTjWJJgLA">Justin Kauffman</a> on <a class="text-light bb"
                            target="_blank" href="https://unsplash.com">Unsplash</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
