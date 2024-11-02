@extends('layouts.main-auth')

@section('main')
    <main>
        <div class="row g-0">
            <!-- left -->
            <div class="col-lg-7 vh-100 d-none d-lg-block">
                <!-- Slider START -->
                <div class="swiper h-100"
                    data-swiper-options='{
                "pagination":{
                    "el":".swiper-pagination",
                    "clickable":"true"
                }}'>

                    <!-- Slider items START -->
                    <div class="swiper-wrapper">
                        <!-- Item -->
                        <div class="swiper-slide">
                            <div class="card rounded-0 h-100" data-bs-theme="dark"
                                style="background-image:url(assets/images/auth/01.jpg); background-position: center left; background-size: cover;">
                                <!-- Bg overlay -->
                                <div class="bg-overlay bg-dark opacity-5"></div>

                                <!-- Card info -->
                                <div class="card-img-overlay z-index-2 p-7">
                                    <div class="d-flex flex-column justify-content-end h-100">
                                        <!-- Quote -->
                                        <h4 class="fw-light">"With unwavering determination, they navigate the complexities
                                            of the industry, forging strategic partnerships and driving transformative
                                            change."</h4>
                                        <!-- Info -->
                                        <div class="d-flex justify-content-between mt-5">
                                            <div>
                                                <h5 class="mb-0">Emma Watson</h5>
                                                <span>Founder, catalog</span>
                                            </div>
                                            <!-- Rating star -->
                                            <ul class="list-inline mb-1">
                                                <li class="list-inline-item small me-0"><i
                                                        class="fa-solid fa-star text-white"></i></li>
                                                <li class="list-inline-item small me-0"><i
                                                        class="fa-solid fa-star text-white"></i></li>
                                                <li class="list-inline-item small me-0"><i
                                                        class="fa-solid fa-star text-white"></i></li>
                                                <li class="list-inline-item small me-0"><i
                                                        class="fa-solid fa-star text-white"></i></li>
                                                <li class="list-inline-item small"><i
                                                        class="fa-solid fa-star-half-alt text-white"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Item -->
                        <div class="swiper-slide">
                            <div class="card rounded-0 h-100" data-bs-theme="dark"
                                style="background-image:url(assets/images/auth/02.jpg); background-position: center left; background-size: cover;">
                                <!-- Bg overlay -->
                                <div class="bg-overlay bg-dark opacity-5"></div>

                                <!-- Card info -->
                                <div class="card-img-overlay z-index-2 p-7">
                                    <div class="d-flex flex-column justify-content-end h-100">
                                        <!-- Quote -->
                                        <h4 class="fw-light">"An exceptional agency CEO is a visionary, constantly pushing
                                            the boundaries of creativity and pushing their team to new heights. They inspire
                                            with their passion and cultivate a culture of trust and respect."</h4>
                                        <!-- Info -->
                                        <div class="d-flex justify-content-between mt-5">
                                            <div>
                                                <h5 class="mb-0">Carolyn Ortiz</h5>
                                                <span>CEO, mizzle</span>
                                            </div>
                                            <!-- Rating star -->
                                            <ul class="list-inline mb-1">
                                                <li class="list-inline-item small me-0"><i
                                                        class="fa-solid fa-star text-white"></i></li>
                                                <li class="list-inline-item small me-0"><i
                                                        class="fa-solid fa-star text-white"></i></li>
                                                <li class="list-inline-item small me-0"><i
                                                        class="fa-solid fa-star text-white"></i></li>
                                                <li class="list-inline-item small me-0"><i
                                                        class="fa-solid fa-star text-white"></i></li>
                                                <li class="list-inline-item small"><i
                                                        class="fa-solid fa-star-half-alt text-white"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Item -->
                        <div class="swiper-slide">
                            <div class="card rounded-0 h-100" data-bs-theme="dark"
                                style="background-image:url(assets/images/auth/03.jpg); background-position: center left; background-size: cover;">
                                <!-- Bg overlay -->
                                <div class="bg-overlay bg-dark opacity-5"></div>

                                <!-- Card info -->
                                <div class="card-img-overlay z-index-2 p-7">
                                    <div class="d-flex flex-column justify-content-end h-100">
                                        <!-- Quote -->
                                        <h4 class="fw-light">" Through collaboration and strategic direction, they steer the
                                            agency towards its goals, navigating the ever-evolving landscape with agility
                                            and grace."</h4>
                                        <!-- Info -->
                                        <div class="d-flex justify-content-between mt-5">
                                            <div>
                                                <h5 class="mb-0">Dennis Barrett</h5>
                                                <span>Founder, catalog</span>
                                            </div>
                                            <!-- Rating star -->
                                            <ul class="list-inline mb-1">
                                                <li class="list-inline-item small me-0"><i
                                                        class="fa-solid fa-star text-white"></i></li>
                                                <li class="list-inline-item small me-0"><i
                                                        class="fa-solid fa-star text-white"></i></li>
                                                <li class="list-inline-item small me-0"><i
                                                        class="fa-solid fa-star text-white"></i></li>
                                                <li class="list-inline-item small me-0"><i
                                                        class="fa-solid fa-star text-white"></i></li>
                                                <li class="list-inline-item small"><i
                                                        class="fa-solid fa-star-half-alt text-white"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slider Pagination -->
                    <div class="swiper-pagination swiper-pagination-line mb-3"></div>
                </div>
            </div>

            <!-- Right -->
            <div class="col-sm-10 col-lg-5 d-flex m-auto vh-100">
                <div class="row w-100 m-auto">
                    <div class="col-sm-10 my-5 m-auto">

                        <a href="index.html"><img src="assets/images/logo-icon.svg" class="h-50px mb-4" alt="logo"></a>

                        <h2 class="mb-0">Welcome back</h2>
                        <p class="mb-0">Welcome back, please enter your detail</p>

                        {{-- <!-- Social buttons -->
                        <div class="row mt-5">
                            <!-- Social btn -->
                            <div class="col-xxl-6 d-grid">
                                <a href="#" class="btn border bg-light mb-2 mb-xxl-0"><i
                                        class="fab fa-fw fa-google text-google-icon me-2"></i>Signup with Google</a>
                            </div>
                            <!-- Divider with text -->
                            <div class="position-relative my-3">
                                <hr>
                                <p class="small position-absolute top-50 start-50 translate-middle bg-body px-4">Or</p>
                            </div>
                        </div> --}}

                        <!-- Form START -->
                        <form method="POST" action="{{ route('login') }}" class="mt-5">
                            @csrf
                            <!-- Email -->
                            <div class="input-floating-label form-floating mb-4">
                                <input type="email" name="email" class="form-control" id="floatingInput"
                                    placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="input-floating-label form-floating mb-4 position-relative">
                                <input type="password" name="password" class="form-control fakepassword pe-6" id="psw-input"
                                    placeholder="Enter your password">
                                <label for="floatingInput">Password</label>
                                <span class="position-absolute top-50 end-0 translate-middle-y p-0 me-2">
                                    <i class="fakepasswordicon fas fa-eye-slash cursor-pointer p-2"></i>
                                </span>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Check box -->
                            <div class="mb-4 d-flex justify-content-between">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox-1">
                                    <label class="form-check-label" for="checkbox-1">Remember me</label>
                                </div>

                                <a href="forgot-password.html" class="link-underline-primary"> Forgot password?</a>
                            </div>

                            <!-- Button -->
                            <div class="align-items-center mt-0">
                                <div class="d-grid">
                                    <button class="btn btn-dark mb-0" type="submit">Login</button>
                                </div>
                            </div>
                        </form>
                        <!-- Form END -->

                        <!-- Sign up link -->
                        <div class="mt-4 text-center">
                            <span>Not registered yet?<a href="sign-up.html"> Create an account</a></span>
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
