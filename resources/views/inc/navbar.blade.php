<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">{{ config('app.name', 'Survey Builder') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="{{ route('index') }}">Home</a>
            <a class="nav-item nav-link" href="{{ route('about') }}">About</a>
        </div>
        <div class="navbar-nav ml-auto">
            @if(Auth::guest())
                <a class="nav-item nav-link" href="{{ route('login') }}">Login</a>
                <a class="nav-item nav-link" href="{{ route('register') }}">Register</a>
            @else
                <div class="dropdown show">
                    <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        My Account
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                        <a class="dropdown-item" href="{{ route('surveys.create') }}">New Survey</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            @endif
        </div>
      </div>
  </div>
</nav>
