@extends('layouts.main')

@section('main')
  <main>
    <section class="pt-sm-7">
      <div class="container pt-3 pt-xl-5">
        <div class="row">

          <div class="col-lg-4 col-xl-3">
            <div class="offcanvas-lg offcanvas-start h-100" tabindex="-1" id="offcanvasSidebar">
              <div class="offcanvas-header bg-light">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Filter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasSidebar"
                  aria-label="Close"></button>
              </div>
              <div class="offcanvas-body p-0">
                <div class="card border p-3 w-100">
                  <div class="card-header text-center border-bottom">
                    <h6 class="mb-0">Filter kategori</h6>
                  </div>

                  <form action="{{ route('product.index') }}" method="GET" class="card-body p-0 mt-4">
                    <input class="form-control pe-5 bg-light mb-4" type="search" placeholder="Search" name="search"
                      aria-label="Search">

                    @foreach ($categories as $item)
                      <div class="form-check my-2">
                        <input type="checkbox" class="form-check-input" name="categories[]"
                          id="checkbox-{{ $item->id }}" value="{{ $item->id }}"
                          {{ in_array($item->id, request()->input('categories', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="checkbox-{{ $item->id }}">{{ $item->name }}</label>
                      </div>
                    @endforeach

                    <button type="submit" class="btn btn-primary w-100 mt-3">Terapkan Filter</button>
                  </form>
                </div>
              </div>
            </div>
          </div>


          <div class="col-lg-8 col-xl-9 ps-lg-4 ps-xl-6">
            <div class="d-flex justify-content-between align-items-center mb-5 mb-sm-6">
              <h1 class="h3 mb-0">Produk kami</h1>

              <button class="btn btn-primary d-lg-none flex-shrink-0 ms-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                <i class="fas fa-sliders-h"></i> Filter
              </button>
            </div>

            <div class="row g-4 g-sm-5">
              @if ($products->isEmpty())
                <div class="d-flex justify-content-center w-100">
                  <img src="{{ asset('images/empty.png') }}" alt="empty" class="image-empty ">
                </div>
              @else
                @foreach ($products as $item)
                  <div class="col-sm-6 col-lg-4 col-xl-4">

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
        </div>
      </div>
    </section>
  </main>
@endsection
