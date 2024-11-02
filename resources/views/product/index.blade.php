@extends('layouts.main')

@section('main')
  <!-- **************** MAIN CONTENT START **************** -->
  <main>

    <!-- =======================
            Hero START -->
    <section>
      <div class="container">
        <!-- Title and breadcrumb -->
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-dots pb-0 mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">All product</a></li>
            <li class="breadcrumb-item"><a href="#">Cart</a></li>
            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
          </ol>
        </nav>

        <!-- Content START -->
        <div class="row mt-7">
          <!-- Images -->
          <div class="col-md-5 mb-5 mb-md-0">

            <!-- Slider START -->
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
                  <!-- Slider items -->
                  <div class="swiper-slide">
                    <a class="w-100 h-100" data-glightbox data-gallery="gallery"
                      href="{{ asset('storage/image-filepond/' . $item->image_url) }}">
                      <div class="card card-element-hover overflow-hidden">
                        <!-- Image -->
                        <img src="{{ asset('storage/image-filepond/' . $item->image_url) }}" class="rounded-3"
                          alt="">
                        <!-- Full screen button -->
                        <div class="hover-element w-100 h-100">
                          <i
                            class="bi bi-fullscreen fs-6 text-white position-absolute top-50 start-50 translate-middle bg-dark rounded-1 p-2 lh-1"></i>
                        </div>
                      </div>
                    </a>
                  </div>
                @endforeach
              </div>

              <!-- Add pagination and navigation elements here -->
              <div class="d-flex justify-content-between position-absolute top-50 start-0 w-100">
                <a href="#" class="btn btn-dark btn-icon rounded-circle mb-0 swiper-button-prev"><i
                    class="bi bi-arrow-left"></i></a>
                <a href="#" class="btn btn-dark btn-icon rounded-circle mb-0 swiper-button-next"><i
                    class="bi bi-arrow-right"></i></a>
              </div>
            </div>

          </div>

          <!-- Product detail -->
          <div class="col-md-7 ps-md-6">
            <!-- Badge -->
            <div class="badge text-bg-dark mb-3">Shoe</div>

            <!-- Title -->
            <h1 class="h2 mb-4">{{ $product->name }}</h1>

            <!-- Rating list -->
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
              <a href="#" class="heading-color text-primary-hover mb-0">345 reviews</a>
              <span class="text-secondary opacity-3 mx-2 mx-sm-3">|</span>
              <span>86 sold</span>
            </div>

            <!-- Price -->
            <h4 class="text-success mb-4"> {{ 'Rp ' . number_format($product->price, 0, ',', '.') }}</h4>

            {{-- <!-- Storage choice -->

            <div class="d-flex align-items-center gap-1 gap-sm-3 flex-wrap mt-2 mb-4">
              <span class="d-block">Memory storage:</span>
              <!-- First button -->
              <input type="radio" class="btn-check" name="btnradio" id="btnradio1" checked>
              <label class="btn btn-sm btn-light border btn-primary-soft-check mb-0" for="btnradio1">256 GB</label>
              <!-- Second button -->
              <input type="radio" class="btn-check" name="btnradio" id="btnradio2">
              <label class="btn btn-sm btn-light border btn-primary-soft-check mb-0" for="btnradio2">512 GB</label>
              <!-- Third button -->
              <input type="radio" class="btn-check" name="btnradio" id="btnradio3">
              <label class="btn btn-sm btn-light border btn-primary-soft-check mb-0" for="btnradio3">1 TB</label>
            </div>

            <!-- Color choice -->
            <div class="color-check-radio d-flex align-items-center gap-3 mt-2 mb-4">
              <span class="d-block">Select color:</span>
              <div>
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"
                  style="background-color: #9a0a0a;">
                <label class="form-check-label" for="flexRadioDefault1"></label>

                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                  style="background-color: #32C7F5;">
                <label class="form-check-label" for="flexRadioDefault2"></label>

                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3"
                  style="background-color: #F7C32E;">
                <label class="form-check-label" for="flexRadioDefault3"></label>

                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4" checked
                  style="background-color: #333369;">
                <label class="form-check-label" for="flexRadioDefault4"></label>
              </div>
            </div>

            <!-- Quantity -->
            <div class="d-flex align-items-center gap-3 mt-2 mb-4">
              <span class="d-block">Select quantity:</span>
              <!-- Select -->
              <div class="col-md-2">
                <select class="form-select" aria-label="Default select example">
                  <option value="1">01</option>
                  <option value="2">02</option>
                  <option value="3">03</option>
                </select>
              </div>
            </div>

            <p class="mb-4">Packed with cutting-edge features and innovations, this smartphone is more than just a
              communication tool, it's a lifestyle companion that keeps up with your needs.</p> --}}

            <!-- Button -->
            <div class="d-grid">
              <a href="shop-cart.html" class="btn btn-primary mb-0 w-100"><i class="bi bi-cart2 me-2"></i>Add to
                Cart</a>
            </div>

          </div>
        </div>
        <!-- Content END -->

      </div>
    </section>
    <!-- =======================
            Hero END -->

    <!-- =======================
            Specification START -->
    <section class="pt-0">
      <div class="container">
        <h2 class="h4 mb-3">Specification</h2>
        <p class="mb-5">Please note that this is a generic example, and actual specifications may vary depending on the
          specific mobile phone model and brand. Mobile phone specifications typically include information about the
          display, performance, camera capabilities, battery, operating system, connectivity options, and additional
          features. Please note that this is a generic example, and actual specifications may vary depending on the
          specific mobile phone model and brand.</p>
      </div>
    </section>
    <!-- =======================
            Specification END -->

    <!-- =======================
            Rating & review START -->
    <section class="pt-0">
      <div class="container">
        <!-- Title -->
        <h2 class="h4 mb-5">Rating & review</h2>

        <div class="row">
          <!-- Rating START -->
          <div class="col-lg-5 pe-lg-5 mb-5 mb-lg-0">
            <!-- Rating and progressbar -->
            <div class="border rounded-2 p-4">
              <div class="row">
                <!-- Total rating -->
                <div class="col-md-5">
                  <!-- Info -->
                  <h2 class="mb-0">4.5</h2>
                  <!-- Star -->
                  <ul class="list-inline mb-2">
                    <li class="list-inline-item me-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item me-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item me-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item me-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item me-0"><i class="fas fa-star-half-alt text-warning"></i></li>
                  </ul>
                  <p class="mb-2">Based on 56 Reviews</p>
                </div>

                <!-- Progress bar -->
                <div class="col-md-7">
                  <!-- Progress item -->
                  <div class="d-flex align-items-center">
                    <div class="progress progress-sm bg-warning bg-opacity-15 w-100 me-3">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 95%" aria-valuenow="95"
                        aria-valuemin="0" aria-valuemax="100">
                      </div>
                    </div>
                    <span class="heading-color">5</span>
                  </div>

                  <!-- Progress item -->
                  <div class="d-flex align-items-center">
                    <div class="progress progress-sm bg-warning bg-opacity-15 w-100 me-3">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75"
                        aria-valuemin="0" aria-valuemax="100">
                      </div>
                    </div>
                    <span class="heading-color">4</span>
                  </div>

                  <!-- Progress item -->
                  <div class="d-flex align-items-center">
                    <div class="progress progress-sm bg-warning bg-opacity-15 w-100 me-3">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 55%" aria-valuenow="55"
                        aria-valuemin="0" aria-valuemax="100">
                      </div>
                    </div>
                    <span class="heading-color">3</span>
                  </div>

                  <!-- Progress item -->
                  <div class="d-flex align-items-center">
                    <div class="progress progress-sm bg-warning bg-opacity-15 w-100 me-3">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 35%" aria-valuenow="35"
                        aria-valuemin="0" aria-valuemax="100">
                      </div>
                    </div>
                    <span class="heading-color">2</span>
                  </div>

                  <!-- Progress item -->
                  <div class="d-flex align-items-center">
                    <div class="progress progress-sm bg-warning bg-opacity-15 w-100 me-3">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100">
                      </div>
                    </div>
                    <span class="heading-color">1</span>
                  </div>
                </div>
              </div> <!-- Row END -->
            </div>

            <!-- Review images -->
            <div class="mt-5">
              <!-- Images -->
              <h5 class="mb-4">Reviews with images</h5>

              <div class="row g-4">
                <!-- Image -->
                <div class="col-4 col-sm-2 col-lg-3">
                  <a class="w-100 h-100" data-glightbox data-gallery="gallery" href="assets/images/shop/review/01.jpg">
                    <div class="card card-element-hover overflow-hidden">
                      <!-- Image -->
                      <img src="assets/images/shop/review/01.jpg" class="rounded-3" alt="">
                      <!-- Full screen button -->
                      <div class="hover-element w-100 h-100">
                        <i
                          class="bi bi-fullscreen fs-6 text-white position-absolute top-50 start-50 translate-middle bg-dark rounded-1 p-2 lh-1"></i>
                      </div>
                    </div>
                  </a>
                </div>

                <!-- Image -->
                <div class="col-4 col-sm-2 col-lg-3">
                  <a class="w-100 h-100" data-glightbox data-gallery="gallery" href="assets/images/shop/review/02.jpg">
                    <div class="card card-element-hover overflow-hidden">
                      <!-- Image -->
                      <img src="assets/images/shop/review/02.jpg" class="rounded-3" alt="">
                      <!-- Full screen button -->
                      <div class="hover-element w-100 h-100">
                        <i
                          class="bi bi-fullscreen fs-6 text-white position-absolute top-50 start-50 translate-middle bg-dark rounded-1 p-2 lh-1"></i>
                      </div>
                    </div>
                  </a>
                </div>

                <!-- Image -->
                <div class="col-4 col-sm-2 col-lg-3">
                  <a class="w-100 h-100" data-glightbox data-gallery="gallery" href="assets/images/shop/review/03.jpg">
                    <div class="card card-element-hover overflow-hidden">
                      <!-- Image -->
                      <img src="assets/images/shop/review/03.jpg" class="rounded-3" alt="">
                      <!-- Full screen button -->
                      <div class="hover-element w-100 h-100">
                        <i
                          class="bi bi-fullscreen fs-6 text-white position-absolute top-50 start-50 translate-middle bg-dark rounded-1 p-2 lh-1"></i>
                      </div>
                    </div>
                  </a>
                </div>

                <!-- Image -->
                <div class="col-4 col-sm-2 col-lg-3">
                  <a class="w-100 h-100" data-glightbox data-gallery="gallery" href="assets/images/shop/review/04.jpg">
                    <div class="card card-element-hover overflow-hidden">
                      <!-- Image -->
                      <img src="assets/images/shop/review/04.jpg" class="rounded-3" alt="">
                      <!-- Full screen button -->
                      <div class="hover-element w-100 h-100">
                        <i
                          class="bi bi-fullscreen fs-6 text-white position-absolute top-50 start-50 translate-middle bg-dark rounded-1 p-2 lh-1"></i>
                      </div>
                    </div>
                  </a>
                </div>

                <!-- Image -->
                <div class="col-4 col-sm-2 col-lg-3">
                  <a class="w-100 h-100" data-glightbox data-gallery="gallery" href="assets/images/shop/review/05.jpg">
                    <div class="card card-element-hover overflow-hidden">
                      <!-- Image -->
                      <img src="assets/images/shop/review/05.jpg" class="rounded-3" alt="">
                      <!-- Full screen button -->
                      <div class="hover-element w-100 h-100">
                        <i
                          class="bi bi-fullscreen fs-6 text-white position-absolute top-50 start-50 translate-middle bg-dark rounded-1 p-2 lh-1"></i>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <!-- Rating END -->

          <!-- Review START -->
          <div class="col-lg-7">
            <!-- Title and Select -->
            <div class="d-flex justify-content-between align-items-center">
              <!-- Title -->
              <h5 class="mb-0">Sort by</h5>
              <!-- Select -->
              <div class="col-xl-3">
                <select class="form-select" aria-label="Default select example">
                  <option value="1">Most Recent</option>
                  <option value="2">Most Viewed</option>
                  <option value="3">Helpful</option>
                </select>
              </div>
            </div>

            <hr class="my-4"> <!-- Divider -->

            <!-- Review item -->
            <div class="d-flex">
              <img class="avatar avatar-md rounded-circle float-start me-3" src="assets/images/avatar/01.jpg"
                alt="avatar">
              <div>
                <div class="d-sm-flex justify-content-between mb-2">
                  <div>
                    <h6 class="m-0">Allen Smith</h6>
                    <span class="me-3 small">June 11, 2022, at 6:01 am </span>
                  </div>
                  <!-- Rating Star -->
                  <ul class="list-inline mb-0">
                    <li class="list-inline-item small me-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item small me-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item small me-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item small me-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item small me-0"><i class="fas fa-star-half-alt text-warning"></i></li>
                  </ul>
                </div>
                <p>Warrant private blushes removed an in equally totally if. Delivered dejection necessary objection do Mr
                  prevailed. Mr feeling does chiefly cordial in do. </p>

                <span>Was it helpful?</span>
                <div class="btn-group ms-md-2" role="group" aria-label="Basic radio toggle button group">
                  <!-- Yes button -->
                  <input type="radio" class="btn-check" name="btnradio1" id="btnradior1">
                  <label class="btn btn-outline-secondary btn-sm mb-0" for="btnradior1"><i
                      class="far fa-thumbs-up me-1"></i> Yes</label>
                  <!-- No button -->
                  <input type="radio" class="btn-check" name="btnradio1" id="btnradior2">
                  <label class="btn btn-outline-secondary btn-sm mb-0" for="btnradior2"> No <i
                      class="far fa-thumbs-down ms-1"></i></label>
                </div>
              </div>
            </div>

            <hr class="my-4"> <!-- Divider -->

            <!-- Review item -->
            <div class="d-flex">
              <img class="avatar avatar-md rounded-circle float-start me-3" src="assets/images/avatar/02.jpg"
                alt="avatar">
              <div>
                <div class="d-sm-flex justify-content-between mb-2">
                  <div>
                    <h6 class="m-0">Louis Ferguson</h6>
                    <span class="me-3 small">June 14, 2022, at 6:01 am </span>
                  </div>
                  <!-- Rating Star -->
                  <ul class="list-inline mb-0">
                    <li class="list-inline-item small me-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item small me-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item small me-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item small me-0"><i class="fas fa-star text-warning"></i></li>
                    <li class="list-inline-item small me-0"><i class="fas fa-star-half-alt text-warning"></i></li>
                  </ul>
                </div>
                <p>Delivered dejection necessary objection do Mr prevailed. Mr feeling does chiefly cordial in do. </p>

                <span>Was it helpful?</span>
                <div class="btn-group ms-md-2" role="group" aria-label="Basic radio toggle button group">
                  <!-- Yes button -->
                  <input type="radio" class="btn-check" name="btnradio" id="btnradior3">
                  <label class="btn btn-outline-secondary btn-sm mb-0" for="btnradior3"><i
                      class="far fa-thumbs-up me-1"></i> Yes</label>
                  <!-- No button -->
                  <input type="radio" class="btn-check" name="btnradio" id="btnradior4">
                  <label class="btn btn-outline-secondary btn-sm mb-0" for="btnradior4"> No <i
                      class="far fa-thumbs-down ms-1"></i></label>
                </div>
              </div>
            </div>

            <!-- button -->
            <div class="mt-4 text-end">
              <a class="btn btn-primary-soft mb-0" data-bs-toggle="collapse" href="#collapseExample" role="button"
                aria-expanded="false" aria-controls="collapseExample">
                Write a review
              </a>
            </div>

            <!-- Collapse body -->
            <div class="collapse" id="collapseExample">
              <div class="card card-body">
                <form>
                  <select class="form-select mb-3" aria-label="Default select example">
                    <option value="1">★★★★★ (5/5)</option>
                    <option value="2">★★★★☆ (4/5)</option>
                    <option value="3">★★★☆☆ (3/5)</option>
                    <option value="3">★★☆☆☆ (2/5)</option>
                    <option value="3">★☆☆☆☆ (1/5)</option>
                  </select>
                  <!-- Text area -->
                  <textarea class="form-control mb-3" id="exampleFormControlTextarea1" placeholder="Your review" rows="3"></textarea>
                  <!-- Button -->
                  <button type="submit" class="btn btn-primary mb-0">Post It <i
                      class="bi fa-fw bi-arrow-right ms-2"></i></button>
                </form>
              </div>
            </div>

          </div>
          <!-- Review END -->
        </div>
      </div>
    </section>
    <!-- =======================
            Rating & review END -->

  </main>
  <!-- **************** MAIN CONTENT END **************** -->
@endsection
