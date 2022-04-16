@extends('layouts.header')
@section('content')
    <div style="height: 100vh;"
         class="is-flex is-align-items-center is-justify-content-center  has-background-grey-lighter">
        <form class="box login-box" method="post" action="{{ route('password.email') }}">
            <div class="box is-success is-shadowless has-background-danger-light">
                اگر پسورد خود را فراموش کرده اید، ایمیل خود را وارد کنید تا لینک بازیابی برایتان ارسال شود.
            </div>
            @csrf
            <div class="field">
                <label class="label">ایمیل</label>
                <div class="control">
                    <input class="input @error('email') is-danger @enderror" type="email" name="email"
                           placeholder="e.g. alex@example.com"
                           value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <br>
            <div class="has-text-centered mt-4">
                <button class="button is-danger">ارسال لینک بازیابی پسورد</button>
                <a href="{{route('login')}}" class="button is-info">ورود</a>
            </div>
        </form>
    </div>
@endsection
