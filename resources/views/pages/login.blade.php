@extends('layouts.app')

@section('content')

<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow-x: hidden; /* hilangkan scroll horizontal */
    }

    /* Background fullscreen */
    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-image: url('{{ asset('images/bg-login.png') }}');
        background-size: cover; /* cover seluruh layar */
        background-position: center;
        background-repeat: no-repeat;
        z-index: -1; /* supaya navbar dan card di atas */
    }
    /* Navbar full screen */
    .navbar-login {
        width: 100vw; /* full viewport width */
        background-color: #dc3545;
        color: #fff;
        padding: 1rem 2rem;
        font-weight: bold;
        font-size: 1.25rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        position: fixed; /* agar selalu di atas */
        top: 0;
        left: 0;
        z-index: 1000;
    }

    /* Wrapper login fullscreen */
    .login-wrapper {
        width: 100vw;
        height: calc(100vh - 68px); /* dikurangi tinggi navbar */
        display: flex;
        justify-content: center;
        align-items: center;
        background-image: url('{{ asset('images/bg-login.png') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        margin: 0;
        padding: 0;
    }

    /* Card login */
    .card-login {
        width: 100%;
        max-width: 400px; 
        border-radius: 0.5rem;
        background-color: rgba(255, 255, 255, 0.95);
        box-shadow: 0 0 15px rgba(0,0,0,0.2);
        margin: 0 1rem; /* beri sedikit margin mobile */
    }

    .card-body {
        padding: 2rem;
    }

    /* Hapus footer default */
    footer {
        display: none !important;
    }
</style>

<!-- Navbar -->
<div class="navbar-login">
    Vihara Budi Dharma Management System
</div>

<!-- Login Form -->
<div class="login-wrapper">
    <div class="card card-login o-hidden border-0 shadow-lg">
        <div class="card-body">

            <h4 class="text-center mb-4">Login</h4>

            <form action="{{ url('/login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group mt-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-danger w-100 mt-4">Login</button>  

            </form>

        </div>
    </div>
</div>

@endsection
