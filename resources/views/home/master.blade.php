@include('home.layouts.header')
<body dir="rtl">
@include('home.layouts.navbar')
<main class="custom-container mt-6" style="min-height: 88vh;">
    @guest
        <strong class="box is-success is-shadowless has-background-danger-light has-text-centered">
            جهت استفاده از امکانات سایت مانند درج توییت و یا قراردادن دیدگاه در سایت <a
                href="{{ route('login') }}">وارد</a> شده و یا
            <a href="{{route('register')}}">ثبت نام</a> کنید
        </strong>
    @endguest
    @yield('content')
</main>
<script src="{{ asset('/js/script.js') }}"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
