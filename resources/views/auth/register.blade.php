@extends('layouts.header')
@section('content')
    <div style="height: 100vh;"
         class="is-flex is-align-items-center is-justify-content-center  has-background-grey-lighter">
        <form class="box login-box" method="post" action="{{ route('register') }}">
            <div class="box is-success is-shadowless has-background-danger-light">
                جهت استفاده از امکانات سایت مانند درج توییت و یا قراردادن دیدگاه در سایت ثبت نام کنید.
            </div>
            @csrf
            <div class="field">
                <label class="label">نام</label>
                <div class="control">
                    <input class="input @error('name') is-danger @enderror" type="name" name="name"
                           placeholder="e.g. alex" required autocomplete="name">
                    @error('name')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="field mt-5">
                <label class="label">ایمیل</label>
                <div class="control">
                    <input class="input @error('email') is-danger @enderror" type="email" name="email"
                           placeholder="e.g. alex@example.com" required autocomplete="email">
                    @error('email')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="field mt-5">
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
                <label class="label">تکرار پسورد</label>
                <div class="control">
                    <input class="input " id="password-confirm" type="password" name="password_confirmation" required
                           placeholder="********" autocomplete="new-password">
                </div>
            </div>

            <div class="has-text-centered mt-6">
                <button class="button is-danger px-6">ثبت نام</button>
                <a href="{{route('login')}}" class="button is-info">ورود</a>
            </div>
            <br>
        </form>
    </div>
@endsection
