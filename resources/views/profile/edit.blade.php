@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <!-- Update Profile Information -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Profile Information</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('profile.update') }}" class="bg-white p-4 rounded shadow">
                                @csrf
                                @method('PATCH')

                                @include('profile.partials.update-profile-information-form')
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Update Password -->
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Password</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('password.update') }}" class="bg-white p-4 rounded shadow">
                                @csrf
                                @method('PUT')

                                @include('profile.partials.update-password-form')
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete User Account -->
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Delete Account</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('profile.destroy') }}" class="bg-white p-4 rounded shadow">
                                @csrf
                                @method('DELETE')

                                @include('profile.partials.delete-user-form')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
