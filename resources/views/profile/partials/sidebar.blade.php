<div class="col-lg-4 col-xl-3">
  <div class="offcanvas-lg offcanvas-start h-100" tabindex="-1" id="offcanvasSidebar">
    <div class="offcanvas-header bg-light">
      <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Profil saya</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasSidebar"
        aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
      <div class="card border p-3 w-100">
        <div class="card-header text-center border-bottom">
          <div class="avatar avatar-xl position-relative mb-2">
            <img class="avatar-img rounded-circle border border-2 border-white"
              src="{{ asset('images/profil-df.png') }}" alt="">
            <a href="{{ route('profile.index') }}"
              class="btn btn-sm btn-round btn-dark position-absolute top-50 start-100 translate-middle mt-4 ms-n3"
              data-bs-toggle="tooltip" data-bs-title="Edit profile">
              <i class="bi bi-pencil-square"></i>
            </a>
          </div>
          <h6 class="mb-0">{{ Auth::user()->name }}</h6>
          <a href="{{ route('profile.index') }}"
            class="text-reset text-primary-hover small">{{ Auth::user()->email }}</a>
        </div>

        <div class="card-body p-0 mt-4">
          @php
            $currentPage = request()->query('p') ?? 'profile';
          @endphp
          <ul class="nav nav-pills-primary-border-start flex-column">
            <li class="nav-item">
              <a class="nav-link {{ $currentPage === 'profile' ? 'active' : '' }}"
                href="{{ route('profile.index', ['p' => 'profile']) }}"><i class="bi bi-person fa-fw me-2"></i>Profil
                saya</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ $currentPage === 'shipping-address' ? 'active' : '' }}" href="{{ route('profile.index', ['p' => 'shipping-address']) }}"><i
                  class="bi bi-truck fa-fw me-2"></i>Alamat
                pengiriman</a>
            </li>
            <li class="nav-item {{ $currentPage === 'waiting-for-payment' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('profile.index', ['p' => 'waiting-for-payment']) }}"><i
                  class="bi bi-wallet fa-fw me-2"></i>Belum bayar</a>
            </li>
            <li class="nav-item {{ $currentPage === 'order-history' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('profile.index', ['p' => 'order-history']) }}"><i
                  class="bi bi-basket fa-fw me-2"></i>Histori order</a>
            </li>
            <li class="nav-item">
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <a class="nav-link text-danger" href="{{ route('logout') }}"
                  onclick="event.preventDefault(); this.closest('form').submit();"><i
                    class="fas fa-sign-out-alt fa-fw me-2"></i>Sign
                  Out</a>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
