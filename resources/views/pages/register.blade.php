@extends('layouts.app')

@section('content')

<style>
    .register-wrapper {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;

        background-image: url('{{ asset('images/bg-login.png') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>

<div class="register-wrapper">

    <div class="col-xl-4 col-lg-5 col-md-6">

        <div class="card o-hidden border-0 shadow-lg">
            <div class="card-body p-5">

                <h4 class="text-center mb-4">Register</h4>

                <form action="{{ url('/register') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                        @error('email') 
                            <small class="text-danger">{{ $message }}</small> 
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label>Password (min 6 karakter)</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button class="btn btn-danger w-100 mt-4">Register</button>

                    <hr>

                    <div class="text-center">
                        <a href="{{ route('login') }}">Already have an account? Login!</a>
                    </div>

                </form>

            </div>
        </div>

    </div>

</div>

@endsection
