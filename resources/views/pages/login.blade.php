@extends('layouts.app')

@section('title', 'Login - Joga Driver Tour')

@section('content')
<section class="breadcumb-section">
    <div class="tf-container">
        <div class="row">
            <div class="col-lg-12 center z-index1">
                <h1 class="title">Login</h1>
                <ul class="breadcumb-list flex-five">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><span>Login</span></li>
                </ul>
                <img class="bcrumb-ab" src="{{ asset('template/assets/images/page/mask-bcrumb.png') }}" alt="">
            </div>
        </div>
    </div>
</section>

<section class="login pd-main">
    <div class="tf-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="login-wrap flex">
                    <div class="image">
                        <img src="{{ asset('template/assets/images/page/sign-up.jpg') }}" alt="image">
                    </div>
                    <div class="content">
                        <div class="inner-header-login">
                            <h3 class="title">Login to Your Account</h3>
                            <div class="flex-three">
                                <span class="sale">Welcome</span>
                                <p>Access your dashboard and manage tours</p>
                            </div>
                        </div>
                        @if($errors->any())
                            <div class="alert alert-danger" style="padding: 10px 15px; margin-bottom: 20px; border-radius: 8px; background: #fee; border: 1px solid #fcc; color: #c33;">
                                {{ $errors->first() }}
                            </div>
                        @endif
                        <form action="{{ route('login') }}" method="POST" id="login" class="login-user">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-wrap">
                                        <label>Email</label>
                                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email*" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-wrap">
                                        <div class="flex-two">
                                            <label>Your password</label>
                                        </div>
                                        <input type="password" name="password" placeholder="Enter your password*" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-30">
                                    <div class="input-wrap-social">
                                        <div class="checkbox">
                                            <input type="checkbox" name="remember" id="remember" value="1">
                                            <label for="remember">Remember me</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-30">
                                    <button type="submit" class="btn-submit">Sign In</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="flex-three">
                                        <span class="account">Don't have an account?</span>
                                        <a href="{{ route('register') }}" class="link-login">Register</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
