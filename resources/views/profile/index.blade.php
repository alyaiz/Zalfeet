@extends('layouts.main')

@section('main')
  <main>
    <section class="pt-sm-7">
      <div class="container pt-3 pt-xl-5">
        <div class="row">
          @include('profile.partials.sidebar')

          <div class="col-lg-8 col-xl-9 ps-lg-4 ps-xl-6">
            <div class="d-flex justify-content-between align-items-center mb-5 mb-sm-6">
              <h1 class="h3 mb-0">Profil saya</h1>

              <button class="btn btn-primary d-lg-none flex-shrink-0 ms-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                <i class="fas fa-sliders-h"></i> Menu
              </button>
            </div>

            <form method="POST" action="{{ route('profile.update') }}">
              @csrf
              @method('PUT')
              <div class="card bg-transparent p-0">
                <div class="card-header bg-transparent border-bottom p-0 pb-3">
                  <h6 class="mb-0">Informasi pribadi</h6>
                </div>

                <div class="card-body px-0">
                  <div class="row g-4">
                    <div class="col-12">
                      <label class="form-label">Foto profil</label>
                      <div class="d-flex align-items-center">
                        <label class="position-relative me-2" title="Replace this pic">
                          <span class="avatar avatar-xl">
                            <img class="avatar-img rounded-circle border border-white border-3 shadow"
                              src="{{ asset('images/avatar/07.jpg') }}" alt="">
                          </span>
                        </label>
                        <label class="btn btn-sm btn-dark mb-0">Ubah</label>
                        <input class="form-control d-none" type="file">
                      </div>
                    </div>

                    {{-- <div class="col-12">
                      <label class="form-label">Full name</label>
                      <div class="input-group">
                        <input type="text" class="form-control" value="Jacqueline" placeholder="First name">
                        <input type="text" class="form-control" value="Miller" placeholder="Last name">
                      </div>
                    </div> --}}

                    <div class="col-md-6">
                      <label class="form-label">Nama</label>
                      <input type="text" name="name" class="form-control" value="{{ old('email', $user->name) }}"
                        placeholder="Nama anda">
                    </div>

                    <div class="col-md-6">
                      <label class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}"
                        placeholder="Email anda">
                    </div>

                    {{-- <div class="col-md-6">
                      <label class="form-label">Nationality</label>
                      <select class="form-select">
                        <option value="">Select your country</option>
                        <option>USA</option>
                        <option selected>Paris</option>
                        <option>India</option>
                        <option>UK</option>
                      </select>
                    </div> --}}

                    {{-- <div class="col-md-6">
                      <label class="form-label">Select Gender</label>
                      <div class="input-group">
                        <div class="form-control">
                          <div class="form-check radio-bg-light">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"
                              checked="">
                            <label class="form-check-label" for="flexRadioDefault1">
                              Male
                            </label>
                          </div>
                        </div>

                        <div class="form-control">
                          <div class="form-check radio-bg-light">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                              Female
                            </label>
                          </div>
                        </div>

                        <div class="form-control">
                          <div class="form-check radio-bg-light">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                            <label class="form-check-label" for="flexRadioDefault3">
                              Others
                            </label>
                          </div>
                        </div>
                      </div>
                    </div> --}}

                    {{-- <div class="col-12">
                      <label class="form-label">Address</label>
                      <textarea class="form-control" rows="3" spellcheck="false">2119 N Division Ave, New Hampshire, York, United States</textarea>
                    </div> --}}

                    <div class="col-12 text-end">
                      <button type="submit" class="btn btn-primary mb-0">Simpan</button>
                    </div>

                  </div>
                </div>
              </div>
            </form>

            {{-- <div class="text-center my-5"><i class="bi bi-three-dots"></i></div> --}}

            {{-- <form>
              <div class="card bg-transparent p-0">
                <div class="card-header bg-transparent border-bottom px-0">
                  <h6 class="mb-0">Update email</h6>
                </div>

                <div class="card-body px-0">
                  <div class="mb-4">
                    <p class="mb-4">Your current email address is <span class="text-primary">example@gmail.com</span>
                    </p>
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" value="hello@gmail.com" placeholder="Enter your email id">
                  </div>

                  <div class="text-end">
                    <a href="#" class="btn btn-primary mb-0">Simpan</a>
                  </div>
                </div>
              </div>
            </form> --}}

            {{-- <div class="text-center my-5"><i class="bi bi-three-dots"></i></div> --}}

            <form method="POST" action="{{ route('password.update') }}">
              @csrf
              @method('PUT')

              <div class="card bg-transparent p-0">
                <div class="card-header bg-transparent border-bottom px-0">
                  <h6 class="mb-0">Ubah password</h6>
                </div>

                <div class="card-body px-0">
                  <div class="mb-3">
                    <label class="form-label">Password lama</label>
                    <input class="form-control" name="current_password" type="password"
                      placeholder="Enter current password">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Password baru</label>
                    <div class="position-relative">
                      <input type="password" name="password" class="form-control fakepassword pe-6" id="psw-input"
                        placeholder="Enter your password">
                      <span class="position-absolute top-50 end-0 translate-middle-y p-0 me-2">
                        <i class="fakepasswordicon fas fa-eye-slash cursor-pointer p-2"></i>
                      </span>
                    </div>
                  </div>

                  <div>
                    <label class="form-label">Konfirmasi password baru</label>
                    <div class="position-relative">
                      <input type="password" name="password_confirmation" class="form-control fakepassword2 pe-6"
                        id="psw-input-2" placeholder="Enter your password">
                      <span class="position-absolute top-50 end-0 translate-middle-y p-0 me-2">
                        <i class="fakepasswordicon2 fas fa-eye-slash cursor-pointer p-2"></i>
                      </span>
                    </div>
                  </div>

                  <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary mb-0">Ubah password</button>
                  </div>
                </div>
              </div>
            </form>

          </div>
        </div>

      </div>
    </section>
  </main>
@endsection
