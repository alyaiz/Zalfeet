<header class="header-sticky header-absolute">
  <nav class="navbar navbar-expand-xl">
    <div class="container">
      <a class="navbar-brand me-5" href="/">
        <img class="light-mode-item navbar-brand-item" src="{{ asset('images/logo.png') }}" alt="logo">
      </a>

      <div class="navbar-collapse collapse" id="navbarCollapse">
        <ul class="navbar-nav navbar-nav-scroll dropdown-hover">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('product.index', ['categories' => [1]]) }}">Pria</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('product.index', ['categories' => [2]]) }}">Wanita</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('product.index', ['categories' => [3]]) }}">Anak</a>
          </li>
        </ul>
      </div>

      <ul class="nav align-items-center dropdown-hover ms-sm-2">
        <li class="nav-item flex-nowrap align-items-center ms-3 d-none d-md-block">
          <form action="{{ route('product.index') }}" method="GET" class="position-relative">
            <input class="form-control pe-5 bg-light" type="search" placeholder="Search" name="search"
              aria-label="Search">
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
            <a class="" href="{{ route('profile.index') }}">
              <img src="{{ asset('images/profil-df.png') }}" alt="" class="image-avatar ms-3">
            </a>
          @else
            <a href="{{ route('login') }}" class="btn btn-primary ms-2 ms-sm-3 small">Masuk</a>
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
