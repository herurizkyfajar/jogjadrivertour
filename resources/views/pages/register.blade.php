@extends('layouts.app')

@section('title', 'Register - Yogyakarta Driver Tour')

@section('content')
<section class="page-banner">
    <div class="tf-container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="banner-title">Register</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Register</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="register-page pd-main">
    <div class="tf-container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="register-form">
                    <h3 class="form-title">Create New Account</h3>
                    <form>
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control" placeholder="Enter your full name" required>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Create a password" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" placeholder="Confirm your password" required>
                        </div>
                        <div class="form-group">
                            <div class="remember-me">
                                <input type="checkbox" id="terms" required>
                                <label for="terms">I agree to the <a href="#">Terms & Conditions</a></label>
                            </div>
                        </div>
                        <button type="submit" class="btn-main w-100">Register</button>
                    </form>
                    <p class="login-link">Already have an account? <a href="{{ route('login') }}">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
