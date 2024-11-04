@extends('layouts.main')

@section('main')
  <main>
    <section class="pb-5 pb-sm-7">
      <div class="container">
        <div
          class="d-flex flex-column flex-lg-row justify-content-between align-items-start md:align-items-center gap-3 w-100">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dots pt-0 pb-0 mb-0">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Semua produk</a></li>
              <li class="breadcrumb-item active" aria-current="page">Keranjang saya</li>
            </ol>
          </nav>

          @if (session('success'))
            <div class="alert alert-success mb-0" role="alert" x-data="{ show: true }" x-show="show" x-transition
              x-init="setTimeout(() => show = false, 3000)">
              {{ session('success') }}
            </div>
          @endif

          @if (session('error'))
            <div class="alert alert-danger mb-0" role="alert" x-data="{ show: true }" x-show="show" x-transition
              x-init="setTimeout(() => show = false, 3000)">
              {{ session('error') }}
            </div>
          @endif
        </div>
        <h1 class="h3 mb-0 mt-3">Keranjang saya</h1>
      </div>
    </section>

    <section class="pt-0">
      <div class="container">
        @if ($carts->isEmpty())
          <div class="d-flex justify-content-center w-100">
            <img src="{{ asset('images/empty.png') }}" alt="empty" class="image-empty ">
          </div>
        @else
          <div class="row">
            <div class="col-lg-8 mb-6 mb-lg-0">
              <div class="card bg-transparent">
                <div
                  class="card-header bg-transparent d-flex justify-content-between align-items-center border-bottom px-0 pt-0">
                  <h5 class="mb-0">{{ $totalQuantity }} produk</h5>
                </div>

                <div class="card-body px-0">
                  @foreach ($carts as $item)
                    <div class="row align-items-xl-center">
                      <div class="col-5 col-md-2">
                        <div class="bg-light p-2 rounded-2">
                          <img src="{{ asset('storage/image-filepond/' . $item->product->images->first()->image_url) }} "
                            alt="">
                        </div>
                      </div>

                      <div class="col-7 col-md-10">
                        <div class="row g-3 g-sm-4 d-flex align-items-center">
                          <div class="col-xl-6">
                            <h6 class="mb-1">{{ $item->product->name }}</h6>
                            <ul class="nav nav-divider small align-items-center mt-1">
                              <li class="nav-item">Ukuran: {{ $item->stock->size->name }}</li>
                              <li class="nav-item">Jumlah: {{ $item->quantity }} pcs</li>
                              <li class="nav-item">Harga: {{ 'Rp ' . number_format($item->product->price, 0, ',', '.') }}
                              </li>
                            </ul>
                          </div>

                          <div class="col-sm-6 col-md-4 col-xl-4 text-md-center">
                            <h5 class="mb-0">
                              {{ 'Rp ' . number_format($item->product->price * $item->quantity, 0, ',', '.') }}</h5>
                          </div>

                          <div class="col-sm-6 col-md-4 col-xl-2 text-md-center">
                            <form method="POST" action="{{ route('cart.destroy', $item->id) }}">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn text-danger small" style="white-space: nowrap">
                                <i class="bi bi-x-lg"></i> Hapus
                              </button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    <hr>
                  @endforeach
                </div>
              </div>
            </div>

            <div class="col-lg-4 ps-xl-6">
              <div class="card border p-4">
                <div class="card-header p-0 pb-3">
                  <h5 class="card-title mb-0">Ringkasan order</h5>
                </div>
                <div class="card-body p-0 pb-3 mt-2">
                  <ul class="list-group list-group-borderless">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span>Subtotal</span>
                      <span
                        class="heading-color fw-semibold mb-0">{{ 'Rp ' . number_format($totalPrice, 0, ',', '.') }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span>Diskon</span>
                      <span class="heading-color fw-semibold mb-0">-</span>
                    </li>
                  </ul>
                </div>
                <div class="card-footer bg-transparent border-top p-0 pt-3">
                  <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="heading-color fw-normal">Total</span>
                    <span class="h6 mb-0">{{ 'Rp ' . number_format($totalPrice, 0, ',', '.') }}</span>
                  </div>
                  <div class="d-grid"><a href="{{ route('checkout.index') }}"
                      class="btn btn-lg btn-primary mb-0">Lanjutkan
                      ke Checkout</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endif
      </div>
    </section>
  </main>
@endsection
