@extends('layouts.main')

@section('main')
  <main>
    <section class="pt-sm-7">
      <div class="container pt-3 pt-xl-5">
        <div class="row">
          @include('profile.partials.sidebar')

          <div class="col-lg-8 col-xl-9 ps-lg-4 ps-xl-6">
            <div class="d-flex justify-content-between align-items-center mb-5 mb-sm-6">
              <h1 class="h3 mb-0">Histori order</h1>

              <button class="btn btn-primary d-lg-none flex-shrink-0 ms-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                <i class="fas fa-sliders-h"></i> Menu
              </button>
            </div>

            <div class="card bg-transparent p-0">
              <div class="card-header bg-transparent border-bottom p-0 pb-3 mb-3">
                <h6 class="mb-0">Order yang belum dibayar</h6>
              </div>

              @foreach ($orders as $item)
                <div class="card-body px-0 py-0">
                  <div class="row align-items-xl-center">
                    <div class="col-12">
                      <div class="mb-3 d-flex align-items-center gap-2">
                        <p class="mb-0 text-dark fw-semibold">ORDER ID {{ $item->id }}</p>

                        <div class="badge text-bg-primary">Paid</div>
                      </div>
                      <p class="mb-3 text-dark" style="font-size: 0.875rem">Produk yang dibeli:</p>
                      @foreach ($item->orderItems as $orderItem)
                        <div class="row align-items-xl-center mb-2">
                          <div class="col-5 col-md-2">
                            <div class="bg-light p-2 rounded-2">
                              <img
                                src="{{ asset('storage/image-filepond/' . $orderItem->product->images->first()->image_url) }}"
                                alt="">
                            </div>
                          </div>

                          <div class="col-7 col-md-10">
                            <div class="row g-3 g-sm-4 d-flex align-items-center">
                              <div class="col-xl-8">
                                <h6 class="mb-1 text-primary">
                                  {{ $orderItem->product->name }}</h6>
                                <ul class="nav nav-divider small align-items-center mt-1">
                                  <li class="nav-item">Ukuran: {{ $orderItem->stock->size->name }}</li>
                                  <li class="nav-item">Jumlah: {{ $orderItem->quantity }} pcs</li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endforeach

                    </div>
                  </div>

                  <hr>
                </div>
              @endforeach
            </div>

          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
