@extends('layout.loginLayout')

@section('content')
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    @if (session('success'))
                                        <p class="alert alert-success">{{ session('success') }}</p>
                                    @elseif (session('error'))
                                        <p class="alert alert-danger">{{ session('error') }}</p>
                                    @endif
                                    <div class="text-center">
                                        <img class="mb-4" src="brand/bootstrap-logo.svg" alt="" width="72"
                                            height="57">
                                        <h1 class="h4 text-gray-900 mb-4">Please Sign In</h1>
                                    </div>
                                    <form class="form-signin" action="{{ route('login.action') }}" method="POST">
                                        @csrf
                                        <div class="form-label-group">
                                            <input type="text" class="form-control" id="username" name="username"
                                                placeholder="Username">
                                            <label for="username">Username</label>
                                        </div>
                                        <div class="form-label-group">
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Password">
                                            <label for="password">Password</label>
                                        </div>
                                        {{-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> --}}
                                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                        {{-- <hr> --}}
                                        {{-- <div class="text-center">
                                            <a class="small" href="#">Forgot Password?</a>
                                        </div> --}}
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
