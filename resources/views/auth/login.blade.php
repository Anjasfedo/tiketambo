@extends('layouts.guest')

@section('content')
    <section class="section">
        <div class="d-flex flex-wrap align-items-stretch">
            <!-- Left side with login form -->
            <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                <div class="p-4 m-3">
                    <img src="{{ asset('assets/images/stisla-fill.svg') }}" alt="logo" width="80"
                        class="shadow-light rounded-circle mb-5 mt-2" />
                    <h4 class="text-dark font-weight-normal">Welcome to <span class="font-weight-bold">Mail</span></h4>
                    <p class="text-muted">Before you get started, you must login.</p>

                    <!-- Login Form -->
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <!-- Email Input -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required autofocus>
                        </div>

                        <!-- Password Input -->
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="form-group text-right">
                            <a href="{{ route('register') }}" class="float-left mt-3">Belum memiliki akun? Daftar di
                                sini</a>
                            <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                                Masuk
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
                            <h1 class="mb-2 display-4 font-weight-bold">Good Morning</h1>
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
