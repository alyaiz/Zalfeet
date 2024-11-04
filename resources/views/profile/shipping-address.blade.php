@extends('layouts.main')

@section('main')
  <main>
    <section class="pt-sm-7">
      <div class="container pt-3 pt-xl-5">
        <div class="row">
          @include('profile.partials.sidebar')

          <div class="col-lg-8 col-xl-9 ps-lg-4 ps-xl-6">
            <div class="d-flex justify-content-between align-items-center mb-5 mb-sm-6">
              <h1 class="h3 mb-0">Alamat pengiriman</h1>

              <button class="btn btn-primary d-lg-none flex-shrink-0 ms-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                <i class="fas fa-sliders-h"></i> Menu
              </button>
            </div>

            <form method="POST" action="{{ route('profile.update') }}">
              @csrf
              @method('PUT')
              <div class="card bg-transparent p-0">
                <div
                  class="card-header bg-transparent border-bottom mb-3 p-0 pb-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
                  <h6 class="mb-0">Alamat anda</h6>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah alamat
                  </button>
                </div>

                @if ($address->isEmpty())
                  <div class="d-flex justify-content-center w-10 mt-5">
                    <img src="{{ asset('images/empty.png') }}" alt="empty" class="image-empty ">
                  </div>
                @else
                  @foreach ($address as $item)
                    <div class="card-body px-0 py-0">
                      <div class="row align-items-xl-center">
                        <div class="col-12">
                          <div class="mb-1 d-flex align-items-center gap-2">
                            <p class="mb-0 text-dark fw-semibold">{{ $item->recipient_name }}</p>
                            @if ($item->is_primary == true)
                              <div class="badge text-bg-primary">Alamat utama</div>
                            @endif
                          </div>
                          <p class="mb-1" style="font-size: 0.875rem">{{ $item->recipient_contact }}</p>
                          <p class="mb-1" style="font-size: 0.875rem">{{ $item->city }}, {{ $item->province }}</p>
                          <p class="mb-1" style="font-size: 0.875rem">{{ $item->address }}</p>
                          <p class="mb-1" style="font-size: 0.875rem">Catatan: {{ $item->notes }}</p>
                        </div>
                      </div>

                      <hr>
                    </div>
                  @endforeach
                @endif
              </div>
            </form>

          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
      <form action="{{ route('address.store') }}" method="POST" class="modal-content">
        @csrf

        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah alamat</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row g-4">
            <div class="col-md-6">
              <label class="form-label">Nama Penerima</label>
              <input type="text" name="recipient_name" class="form-control" placeholder="Nama anda" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Kontak Penerima</label>
              <input type="text" name="recipient_contact" class="form-control" placeholder="085xxxxxxx" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Provinsi</label>
              <input type="text" name="province" class="form-control" placeholder="Provinsi alamat pengiriman"
                required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Kota / Kabupaten</label>
              <input type="text" name="city" class="form-control" placeholder="Kota / Kabupaten alamat pengiriman"
                required>
            </div>

            <div class="col-12">
              <label class="form-label">Kota / Kabupaten</label>
              <textarea class="form-control" name="address" cols="30" rows="3" placeholder="Alamat lengkap anda" required></textarea>
            </div>

            <div class="col-12">
              <label class="form-label">Catatan untuk kurir</label>
              <textarea class="form-control" name="notes" cols="30" rows="3" placeholder="Catatan untuk kurir" required></textarea>
            </div>

            <div class="col-12">
              <input type="checkbox" class="form-check-input" name="is_primary" id="checkbox-1">
              <label class="form-check-label" for="checkbox-1">Jadikan alamat utama</label>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
@endsection
