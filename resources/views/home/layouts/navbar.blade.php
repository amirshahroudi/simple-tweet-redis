<nav class="navbar has-background-grey-lighter" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="https://bulma.io">
            <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false"
           data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="{{url('/')}}">
                خانه
            </a>
            <a class="navbar-item button is-danger is-light my-auto" href="{{url('/mock')}}">
                داده ی ماک
            </a>
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                @guest
                    <div class="buttons">
                        <a class="button is-danger" href="{{route('register')}}">
                            ثبت نام
                        </a>
                        <a class="button is-link" href="{{route('login')}}">
                            ورود
                        </a>
                    </div>
                @endguest
                @auth
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="button is-dark">خروج</button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</nav>
