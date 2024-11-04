@extends('layouts.main')

@section('main')
  <main x-data="{
      amount: 1,
      selectedStock: null,
      stocks: {{ json_encode($stocks) }},
      updateAmount(quantity) {
          this.selectedStock = quantity;
          this.amount = 1;
      }
  }">
    <section>
      <div class="container">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start md:align-items-center gap-3 w-100">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dots pt-0 pb-0 mb-0">
              <li class="breadcrumb-item"><a href="/">Beranda</a></li>
              <li class="breadcrumb-item active" aria-current="page">Produk</li>
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


        <div class="row mt-4">
          <div class="col-md-5 mb-5 mb-md-0">
            <div class="swiper"
              data-swiper-options='{
            "loop": false, 
            "grabCursor": true,
            "autoplay": false,
            "navigation":{
              "nextEl":".swiper-button-next",
              "prevEl":".swiper-button-prev"
            }}'>

              <div class="swiper-wrapper">
                @foreach ($product->images as $item)
                  <!-- Item Slider -->
                  <div class="swiper-slide">
                    <a class="w-100 h-100" data-glightbox data-gallery="gallery"
                      href="{{ asset('storage/image-filepond/' . $item->image_url) }}">
                      <div class="card card-element-hover overflow-hidden">

                        <img src="{{ asset('storage/image-filepond/' . $item->image_url) }}" class="rounded-3"
                          alt="">

                        <div class="hover-element w-100 h-100">
                          <i
                            class="bi bi-fullscreen fs-6 text-white position-absolute top-50 start-50 translate-middle bg-dark rounded-1 p-2 lh-1"></i>
                        </div>
                      </div>
                    </a>
                  </div>
                @endforeach
              </div>

              <!-- Tambahkan elemen pagination dan navigasi di sini -->
              <div class="d-flex justify-content-between position-absolute top-50 start-0 w-100">
                <a href="#" class="btn btn-dark btn-icon rounded-circle mb-0 swiper-button-prev"><i
                    class="bi bi-arrow-left"></i></a>
                <a href="#" class="btn btn-dark btn-icon rounded-circle mb-0 swiper-button-next"><i
                    class="bi bi-arrow-right"></i></a>
              </div>
            </div>

          </div>

          <div class="col-md-7 ps-md-6">
            <div class="badge text-bg-dark mb-3">Sepatu</div>

            <h1 class="h2 mb-4">{{ $product->name }}</h1>

            <div class="d-flex align-items-center flex-wrap mb-4">
              <ul class="list-inline mb-0">
                <li class="list-inline-item me-0"><i class="fas fa-star text-warning"></i></li>
                <li class="list-inline-item me-0"><i class="fas fa-star text-warning"></i></li>
                <li class="list-inline-item me-0"><i class="fas fa-star text-warning"></i></li>
                <li class="list-inline-item me-0"><i class="fas fa-star text-warning"></i></li>
                <li class="list-inline-item me-0"><i class="fas fa-star-half-alt text-warning"></i></li>
                <li class="list-inline-item me-0 heading-color fw-normal">(4.5)</li>
              </ul>
              <span class="text-secondary opacity-3 mx-2 mx-sm-3">|</span>
              <a href="#" class="heading-color text-primary-hover mb-0">345 ulasan</a>
              <span class="text-secondary opacity-3 mx-2 mx-sm-3">|</span>
              <span>86 terjual</span>
            </div>

            <h4 class="text-success mb-4"> {{ 'Rp ' . number_format($product->price, 0, ',', '.') }}</h4>

            <form method="POST" action="{{ route('cart.store') }}">
              @csrf
              <input type="hidden" name="product_id" value="{{ $product->id }}">
              <input type="hidden" name="quantity" :value="amount">

              <div class="d-flex align-items-center gap-1 gap-sm-3 flex-wrap mt-2 mb-4">
                <span class="d-block">Ukuran:</span>
                <div class="d-flex align-items-center gap-1 gap-sm-3 flex-wrap">
                  @foreach ($stocks as $stock)
                    <div class="form-check ps-0">
                      <input type="radio" class="btn-check" name="stock_id" id="stock_{{ $stock->id }}"
                        value="{{ $stock->id }}" required {{ $stock->quantity === 0 ? 'disabled' : '' }}
                        @change="updateAmount({{ $stock->quantity }})" />
                      <label class="btn btn-sm btn-light border btn-primary-soft-check mb-0"
                        for="stock_{{ $stock->id }}">
                        {{ $stock->size->name }} (sisa {{ $stock->quantity }})
                      </label>
                    </div>
                  @endforeach
                </div>

              </div>

              <div class="d-flex align-items-center gap-1 gap-sm-3 flex-wrap mt-2 mb-4">
                <span class="d-block">Jumlah:</span>
                <div class="d-flex flex-row align-items-center">
                  <button type="button" class="btn btn-sm btn-light border btn-primary-soft-check mb-0"
                    @click="amount = Math.max(amount - 1, 1)" :disabled="!selectedStock || amount <= 1">-</button>
                  <div class="btn">
                    <span class="text-dark" x-text="amount"></span>
                  </div>
                  <button type="button" class="btn btn-sm btn-light border btn-primary-soft-check mb-0"
                    @click="amount = Math.min(amount + 1, selectedStock)" :disabled="!selectedStock">+</button>
                </div>
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-primary mb-0 w-100"><i class="bi bi-cart2 me-2"></i>Tambah ke
                  Keranjang</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </section>

    <section class="pt-0">
      <div class="container">
        <h2 class="h4 mb-3">Deskripsi</h2>
        {!! $product->description !!}
      </div>
    </section>

    {{-- <section class="pt-0">
      <div class="container">
        <h2 class="h4 mb-5">Rating & Ulasan</h2>

        <div class="row">
          <div class="col-lg-5 pe-lg-5 mb-5 mb-lg-0">
            <div class="border rounded-2 p-4">
              <div class="row">
                <div class="col-md-5">
                  <h2 class="mb-0">4.5</h2>
                  <ul class="list-inline mb-2">
                    <li class="list-inline-item me-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item me-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item me-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item me-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item me-0"><i class="fas fa-star-half-alt text-warning"></i></li>
                  </ul>
                  <p class="mb-2">Berdasarkan 56 Ulasan</p>
                </div>

                <div class="col-md-7">
                  <div class="d-flex align-items-center">
                    <div class="progress progress-sm bg-warning bg-opacity-15 w-100 me-3">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 95%" aria-valuenow="95"
                        aria-valuemin="0" aria-valuemax="100">
                      </div>
                    </div>
                    <span class="heading-color">5</span>
                  </div>

                  <div class="d-flex align-items-center">
                    <div class="progress progress-sm bg-warning bg-opacity-15 w-100 me-3">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75"
                        aria-valuemin="0" aria-valuemax="100">
                      </div>
                    </div>
                    <span class="heading-color">4</span>
                  </div>

                  <div class="d-flex align-items-center">
                    <div class="progress progress-sm bg-warning bg-opacity-15 w-100 me-3">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100">
                      </div>
                    </div>
                    <span class="heading-color">3</span>
                  </div>

                  <div class="d-flex align-items-center">
                    <div class="progress progress-sm bg-warning bg-opacity-15 w-100 me-3">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 10%" aria-valuenow="10"
                        aria-valuemin="0" aria-valuemax="100">
                      </div>
                    </div>
                    <span class="heading-color">2</span>
                  </div>

                  <div class="d-flex align-items-center">
                    <div class="progress progress-sm bg-warning bg-opacity-15 w-100 me-3">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 5%" aria-valuenow="5"
                        aria-valuemin="0" aria-valuemax="100">
                      </div>
                    </div>
                    <span class="heading-color">1</span>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="col-lg-7">
            <h2 class="h6 mb-3">Tinggalkan Ulasan Anda</h2>
            <form>
              <div class="mb-3">
                <textarea class="form-control" rows="5" placeholder="Tulis ulasan Anda di sini..."></textarea>
              </div>

              <div class="mb-3">
                <div class="d-flex align-items-center">
                  <span class="me-3">Rating:</span>
                  <ul class="list-inline mb-0">
                    <li class="list-inline-item me-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item me-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item me-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item me-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item me-0"><i class="fas fa-star-half-alt text-warning"></i></li>
                  </ul>
                </div>
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-primary mb-0">Kirim Ulasan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section> --}}
  </main>
@endsection
