<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="#">BookedID</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link {{ Request()->is('login') ? 'active' : '' }}" aria-current="page"
                            href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request()->is('register') ? 'active' : '' }}" aria-current="page"
                            href="/register">Register</a>
                    </li>
                @else
                    <li class="nav-item">
                        <form action="/logout" method="post">
                            @csrf
                            <button class="nav-link">Logout</button>
                        </form>
                    </li>
                @endguest

            </ul>
        </div>
    </div>
</nav>
