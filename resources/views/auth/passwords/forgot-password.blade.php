@extends('layouts.app')
@section('title')
<title> Forgot Password</title>
@endsection
<style>
    .sectin_div{
        height: 55vh;
        margin-top: 150px;
        margin-bottom: 10px;
    }
    .password_btn:hover{
        color: #fff !important;
        background-color: #00B3FF !important;
    }
    
</style>
@section('content')
<div class="sectin_div" id="wrapper">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background:#fff;">{{ __('Problems signing in?')}}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('get_password_link') }}">
                        @csrf
                        @if(Session::has('message'))
                            <div class="alert alert-success text-center">
                                {{Session::get('message')}}
                            </div>
                        @endif
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0 mt-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn main_color password_btn main_border">
                                    {{ __('Get Reset Password Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
