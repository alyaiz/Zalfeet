<header class="header-sticky header-absolute">
  <nav class="navbar navbar-expand-xl">
    <div class="container">
      <a class="navbar-brand me-5" href="/">
        <img class="light-mode-item navbar-brand-item" src="{{ asset('images/logo.svg') }}" alt="logo">
      </a>

      <div class="navbar-collapse collapse" id="navbarCollapse">
        <ul class="navbar-nav navbar-nav-scroll dropdown-hover">
          <li class="nav-item"> <a class="nav-link" href="contact-v1.html">Pria</a> </li>
          <li class="nav-item"> <a class="nav-link" href="contact-v1.html">Wanita</a> </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside"
              aria-haspopup="true" aria-expanded="false">Anak</a>
            <ul class="dropdown-menu">
              <li> <a class="dropdown-item" href="contact-v1.html">Contact v.1</a></li>
              <li> <a class="dropdown-item" href="contact-v2.html">Contact v.2</a></li>
            </ul>
          </li>
        </ul>
      </div>

      <ul class="nav align-items-center dropdown-hover ms-sm-2">
        <li class="nav-item flex-nowrap align-items-center ms-3 d-none d-md-block">
          <form class="position-relative">
            <input class="form-control pe-5 bg-light" type="search" placeholder="Search" aria-label="Search">
            <button
              class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset"
              type="submit">
              <i class="fas fa-search"></i>
            </button>
          </form>
        </li>

        <li class="nav-item position-relative ms-2 ms-sm-3">
          <a class="btn btn-light border btn-round mb-0" href="{{ route('cart.index') }}">
            <i class="bi bi-cart3 fa-fw"></i>
          </a>
          @if ($cartCount != 0)
            <span
              class="position-absolute top-0 start-100 translate-middle badge smaller rounded-circle bg-primary mt-xl-2 ms-n1">{{ $cartCount }}
              <span class="visually-hidden">unread messages</span>
            </span>
          @endif
        </li>

        <li class="nav-item">
          @auth
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                class="btn btn-outline-primary ms-2 ms-sm-3 small">
                Logout</a>
            </form>
          @else
            <a href="{{ route('login') }}" class="btn btn-primary ms-2 ms-sm-3 small">Login</a>
          @endauth
        </li>

        <li class="nav-item">
          <button class="navbar-toggler ms-3 p-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-animation">
              <span></span>
              <span></span>
              <span></span>
            </span>
          </button>
        </li>
      </ul>

    </div>
  </nav>
</header>
