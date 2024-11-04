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
              <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Keranjang saya</a></li>
              <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
          </nav>
        </div>
        <h1 class="h3 mb-0 mt-3">Checkout</h1>
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
                  <h5 class="mb-0">Alamat pengiriman</h5>
                </div>

                <div class="card-body px-0">
                  <div class="row align-items-xl-center">
                    @if (is_null($address))
                      <div class="col-12">
                        <p class="mb-1">Belum ada alamat pengiriman, silangkan tambahkan <a
                            href="{{ route('profile.index', ['p' => 'shipping-address']) }}">disini!</a></p>
                      </div>
                    @else
                      <div class="col-12">
                        <div class="mb-1 d-flex align-items-center gap-2">
                          <h6 class="mb-0">{{ $address->recipient_name }}</h6>
                          @if ($address->is_primary == true)
                            <div class="badge text-bg-primary">Alamat utama</div>
                          @endif
                        </div>
                        <p class="mb-1" style="font-size: 0.875rem">{{ $address->recipient_contact }}</p>
                        <p class="mb-1" style="font-size: 0.875rem">{{ $address->city }}, {{ $address->province }}</p>
                        <p class="mb-1" style="font-size: 0.875rem">{{ $address->address }}</p>
                        <p class="mb-1" style="font-size: 0.875rem">Catatan: {{ $address->notes }}</p>
                      </div>
                    @endif
                  </div>
                  <hr>
                </div>
              </div>

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
                          <div class="col-xl-8">
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
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span>Pengiriman</span>
                      <span class="heading-color fw-semibold mb-0">{{ 'Rp ' . number_format(0, 0, ',', '.') }}</span>
                    </li>
                  </ul>
                </div>
                <div class="card-footer bg-transparent border-top p-0 pt-3">
                  <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="heading-color fw-normal">Total</span>
                    <span class="h6 mb-0">{{ 'Rp ' . number_format($totalPrice, 0, ',', '.') }}</span>
                  </div>
                  <div class="d-grid">
                    @if ($address)
                      <button id="pay-button" data-address-id="{{ $address->id }}" class="btn btn-lg btn-primary mb-0">
                        Proses Pembayaran
                      </button>
                    @else
                      <button id="pay-button" class="btn btn-lg btn-primary mb-0" disabled>
                        Proses Pembayaran
                      </button>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endif
      </div>
    </section>
  </main>

  <!-- Modal -->
  <div class="modal fade" id="transaksiBelumDibayarModal" tabindex="-1" aria-labelledby="transaksiBelumDibayarLabel"
    aria-hidden="true" style="padding-right: 0 !important">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="transaksiBelumDibayarLabel">Hemm, Pembayaran belum selesai!</h5>
        </div>
        <div class="modal-body">
          <p class="mb-0">Pesanan kamu belum bisa diprosess, silahkan selesaikan pembayaran pada menu transaksi.</p>
        </div>
        <div class="modal-footer">
          <a href="{{ route('profile.index', ['p' => 'waiting-for-payment']) }}" class="btn btn-primary">Lihat
            Transaksi</a>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}">
  </script>

  <script>
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $('#pay-button').click(function() {
      const addressId = $(this).data('address-id');

      $.ajax({
        url: '{{ route('checkout.store') }}',
        type: 'POST',
        data: {
          address_id: addressId,
          _token: CSRF_TOKEN
        },
        success: function(data) {
          console.log(data);
          if (data.snapToken) {
            snap.pay(data.snapToken, {
              onSuccess: function(result) {
                console.log(result);
                $.ajax({
                  url: '{{ route('checkout.update', ['checkout' => 'orderId']) }}'.replace('orderId',
                    data.orderId),
                  type: 'PUT',
                  data: {
                    _token: CSRF_TOKEN
                  },
                  success: function(result) {
                    if (result.success) {
                      window.location.href =
                        '{{ route('profile.index', ['p' => 'order-history']) }}';
                    } else {
                      console.error('Error:', result.message);
                    }
                  },
                  error: function(xhr, status, error) {
                    console.error('Error updating stock:', xhr.status, error);
                    console.error('Response:', xhr.responseText);
                  }
                });
              },
              onPending: function(result) {
                console.log(result);
              },
              onError: function(result) {
                console.log(result);
              },
              onClose: function() {
                $('#transaksiBelumDibayarModal').modal({
                  backdrop: 'static',
                  keyboard: false
                }).modal('show');
              }
            });
          } else {
            console.error('Gagal mendapatkan snap token:', data.message);
          }
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
          console.error('Response:', xhr.responseText);
        }
      });
    });
  </script>
@endpush
