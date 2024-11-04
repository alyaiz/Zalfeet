@extends('layouts.main-auth')

@section('main')
  <main>
    <div class="row g-0">
      <div class="col-lg-7 vh-100 d-none d-lg-block">
        <div class="swiper h-100"
          data-swiper-options='{
                "pagination":{
                    "el":".swiper-pagination",
                    "clickable":"true"
                }}'>
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="card rounded-0 h-100" data-bs-theme="dark"
                style="background-image: url('{{ asset('images/auth/01.jpg') }}'); background-position: center left; background-size: cover;">
                <div class="bg-overlay bg-dark opacity-5"></div>

              </div>
            </div>

            <div class="swiper-slide">
              <div class="card rounded-0 h-100" data-bs-theme="dark"
                style="background-image: url('{{ asset('images/auth/03.jpg') }}'); background-position: center left; background-size: cover;">
                >
                <div class="bg-overlay bg-dark opacity-5"></div>

              </div>
            </div>

            <div class="swiper-slide">
              <div class="card rounded-0 h-100" data-bs-theme="dark"
                style="background-image: url('{{ asset('images/auth/03.jpg') }}'); background-position: center left; background-size: cover;">
                <div class="bg-overlay bg-dark opacity-5"></div>

              </div>
            </div>

          </div>

          <div class="swiper-pagination swiper-pagination-line mb-3"></div>
        </div>
      </div>

      <div class="col-sm-10 col-lg-5 d-flex m-auto vh-100">
        <div class="row w-100 m-auto">
          <div class="col-sm-10 my-5 m-auto">

            {{-- <a href="index.html"><img src="{{ asset('images/logo-icon.svg') }}" class="h-50px mb-4" alt="logo"></a> --}}

            <h2 class="mb-0">Selamat datang kembali</h2>
            <p class="mb-0">Silakan masukkan detail Anda</p>

            {{-- <div class="row mt-5">
              <div class="col-xxl-6 d-grid">
                <a href="#" class="btn border bg-light mb-2 mb-xxl-0"><i
                    class="fab fa-fw fa-google text-google-icon me-2"></i>Signup with Google</a>
              </div>

              <div class="position-relative my-3">
                <hr>
                <p class="small position-absolute top-50 start-50 translate-middle bg-body px-4">Or</p>
              </div>
            </div> --}}

            <form method="POST" action="{{ route('login') }}" class="mt-5">
              @csrf
              <div class="input-floating-label form-floating mb-3">
                <input type="email" name="email" class="form-control" id="floatingInput"
                  placeholder="name@example.com">
                <label for="floatingInput">Email</label>
              </div>

              @if ($errors->has('email'))
                <div class="alert alert-danger mt-2" role="alert">
                  {{ $errors->first('email') }}
                </div>
              @endif

              <div class="input-floating-label form-floating mb-3 position-relative">
                <input type="password" name="password" class="form-control fakepassword pe-6" id="psw-input"
                  placeholder="Enter your password">
                <label for="floatingInput">Password</label>
                <span class="position-absolute top-50 end-0 translate-middle-y p-0 me-2">
                  <i class="fakepasswordicon fas fa-eye-slash cursor-pointer p-2"></i>
                </span>
              </div>

              @if ($errors->has('password'))
                <div class="alert alert-danger mt-2" role="alert">
                  {{ $errors->first('password') }}
                </div>
              @endif

              <div class="mb-3 d-flex justify-content-between">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="checkbox-1">
                  <label class="form-check-label" for="checkbox-1">Ingat saya</label>
                </div>

                {{-- <a href="forgot-password.html" class="link-underline-primary"> Forgot password?</a> --}}
              </div>

              <div class="align-items-center mt-0">
                <div class="d-grid">
                  <button class="btn btn-dark mb-0" type="submit">Masuk</button>
                </div>
              </div>
            </form>

            <div class="mt-3 text-center">
              <span>Belum terdaftar?<a href="{{ route('register') }}"> Buat akun</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection

{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
