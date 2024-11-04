@extends('layouts.main')

@section('main')
  <main>
    <section class="pt-5 pt-xl-7">
      <div class="swiper overflow-hidden pt-5"
        data-swiper-options='{
        "autoplay":{
          "delay": 4000, 
          "disableOnInteraction": false
        },
        "pagination":{
          "el":".swiper-pagination",
          "clickable":"true"
        }}'>
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="card overflow-hidden h-500px h-xl-750px rounded-0"
              style="background-image:url({{ asset('images/shop/bg/01.jpg') }}); background-position: center left; background-size: cover;">
              <div class="bg-overlay bg-dark opacity-5 d-lg-none"></div>
              <div class="card-img-overlay d-flex align-items-center">
                <div class="container">
                  <div class="row">
                    <div class="col-sm-11 col-lg-8 col-xl-5">
                      <span class="d-inline-block text-bg-dark small rounded-pill px-3 py-2 mb-4">New
                        release mizz-VR</span>
                      <h1 class="text-white display-6 mb-4">Dive into Virtual Reality Adventure</h1>

                      <p class="text-white mb-4"> Whether you're a gaming enthusiast or simply seeking
                        an extraordinary escape from reality, our Virtual VR product is your portal
                        to endless excitement. </p>
                      <a class="btn btn-lg btn-outline-white icon-link icon-link-hover mb-0" href="#">Show details<i
                          class="bi bi-arrow-right"></i> </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="card overflow-hidden h-500px h-xl-750px rounded-0"
              style="background-image:url({{ asset('images/shop/bg/02.jpg') }}); background-position: center left; background-size: cover;">
              <div class="bg-overlay bg-dark opacity-5 d-lg-none"></div>
              <div class="card-img-overlay d-flex align-items-center">
                <div class="container">
                  <div class="row">
                    <div class="col-md-11 col-lg-8 col-xl-5 ms-auto">

                      <p class="fs-4 fw-normal text-white mb-3">Festival Collection <span
                          class="text-bg-dark rounded px-3">2023</span></p>
                      <h1 class="text-white display-4 mb-3">FLAT 50% OFF</h1>

                      <p class="text-white mb-4"> Step into a world of quality and craftsmanship –
                        it's time to put your best foot forward.</p>
                      <a class="btn btn-lg btn-dark icon-link icon-link-hover mb-0" href="#">Show now<i
                          class="bi bi-arrow-right"></i> </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="swiper-pagination swiper-pagination-line position-absolute bottom-0 mb-3"></div>
      </div>
    </section>

    <section class="pt-0">
      <div class="container">
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
          <h3>Produk terbaru</h3>
          <a class="icon-link icon-link-hover text-body-secondary text-primary-hover"
            href="{{ route('product.index') }}">Lihat semua produk<i class="bi bi-arrow-right"></i> </a>
        </div>

        <div class="row g-4 g-sm-5">
          @if ($products->isEmpty())
            <div class="d-flex justify-content-center w-100">
              <img src="{{ asset('images/empty.png') }}" alt="empty" class="image-empty ">
            </div>
          @else
            @foreach ($products as $item)
              <div class="col-sm-6 col-lg-4 col-xl-3">

                <div class="card border bg-transparent overflow-hidden p-0 h-100">
                  <div class="position-absolute top-0 start-0 p-3">
                    <span class="badge text-bg-dark">Sepatu</span>
                  </div>

                  <div class="card-header bg-light rounded m-2">
                    @if (!empty($item->images) && isset($item->images[0]->image_url))
                      <img src="{{ asset('storage/image-filepond/' . $item->images[0]->image_url) }}" alt="">
                    @endif
                  </div>

                  <div class="card-body pb-0">
                    <h6 class="card-title"><a href="{{ route('product.show', ['product' => $item->slug]) }}"
                        class="stretched-link">{{ $item->name }}</a></h6>
                    <ul class="list-inline">
                      <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
                      <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
                      <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
                      <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
                      <li class="list-inline-item me-0 small"><i class="fas fa-star-half-alt text-warning"></i></li>
                    </ul>
                  </div>

                  <div class="card-footer bg-transparent d-flex justify-content-between align-items-center pt-0">
                    <p class="fw-bold text-success mb-0"> {{ 'Rp ' . number_format($item->price, 0, ',', '.') }}</p>
                  </div>
                </div>
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </section>
  </main>
@endsection
