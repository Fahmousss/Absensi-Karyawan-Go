@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center">

                                        <img class="" src="./images/logo-grey.png" alt="">
                                    </div>
                                    {{-- <h4 class="text-center mb-4">Sign in</h4> --}}
                                    @if (Session::has('msg'))
                                        <p class="text-danger">{{ session('msg') }}</p>
                                    @endif

                                    <form class="form-valide" action="{{ route('login') }}" method="POST">
                                        {{ method_field('post') }}
                                        @csrf
                                        <div class="form-group">
                                            <label><strong>Email</strong></label>
                                            <input name="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Email" value="{{ old('email') }}" required
                                                autocomplete="email" autofocus>
                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input id="val-password" name="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Password" required autocomplete="current-password">
                                            @error('password')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            {{-- blank space --}}
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
