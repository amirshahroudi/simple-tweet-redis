@extends('layouts.header')
@section('content')
    <div style="height: 100vh;"
         class="is-flex is-align-items-center is-justify-content-center  has-background-grey-lighter">
        <form class="box login-box" method="post" action="{{ route('login') }}">
            @csrf
            <div class="field">
                <label class="label">ایمیل</label>
                <div class="control">
                    <input class="input @error('email') is-danger @enderror" type="email" name="email"
                           placeholder="e.g. alex@example.com" required autocomplete="email">
                    @error('email')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="field">
                <label class="label">پسورد</label>
                <div class="control">
                    <input class="input  @error('password') is-danger @enderror" type="password" name="password"
                           placeholder="********" required
                           autocomplete="current-password">
                    @error('password')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="field">
                <label class="checkbox">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    مرا بخاطر داشته باش
                </label>
            </div>

            <div class="has-text-centered mt-4">
                <button class="button is-danger px-6">ورود</button>
                <a href="{{route('register')}}" class="button is-info">ثبت نام</a>
            </div>
            <br>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">رمز عبور خود را فراموش کردید؟</a>
            @endif

        </form>
    </div>
@endsection
