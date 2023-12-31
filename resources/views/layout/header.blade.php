<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ Route('profile') }}">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ Route('logoutUser') }}">Logout</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ Route('loginPage') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ Route('registerPage') }}">Register</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
