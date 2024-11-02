@extends('dashboard.layouts.main')

@section('main')
  {{-- @dd($product) --}}
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 mb-4 mb-xl-0">
            <div
              class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center w-100">
              <div>
                <h3 class="font-weight-bold">Edit Data Produk</h3>
                <h6 class="font-weight-normal mb-0">Editkan data Produk Anda di sini!</h6>
              </div>

              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.product.index') }}">Produk</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <form action="{{ route('dashboard.product.update', ['product' => $product->id]) }}" method="POST"
              class="form-sample" enctype="multipart/form-data">
              @method('PUT')
              @csrf
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama produk"
                      value="{{ $product->name }}" required>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="price">Harga</label>
                    <input type="number" class="form-control" id="price" name="price"
                      placeholder="Tidak pakai tanda titik dan koma, contoh: 200000" value="{{ $product->price }}"
                      required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="weight">Berat (Gram)</label>
                    <input type="number" class="form-control" id="weight" name="weight"
                      placeholder="Berat dalam gram, contoh: 200, 300, 600" value="{{ $product->weight }}" required>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="type_size">Tipe Ukuran</label>
                    <select class="form-control" id="type_size" name="type_size" required>
                      @if ($product->type_size == 'shoe_size')
                        <option value="shoe_size">Shoe Size</option>
                      @elseif($product->type_size == 'kids_1_3_size')
                        <option value="kids_1_3_size">Kids 1-3 th</option>
                      @elseif($product->type_size == 'kids_4_6_size')
                        <option value="kids_4_6_size">Kids 4-6 th</option>
                      @endif
                    </select>
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label>Stok</label>
                <div class="row">
                  @foreach ($sizes as $item)
                    <div class="col-6 col-md-3 mb-2">
                      <div class="d-flex align-items-center gap-2">
                        <label for="{{ $item->name }}" class="mb-0">{{ $item->name }}</label>
                        <input type="number" name="stock[{{ $item->id }}]" id="{{ $item->name }}"
                          class="form-control" placeholder="200" value="{{ $stockQuantities[$item->id] ?? 0 }}" required>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>

              <div class="row">
                @foreach ($categories as $item)
                  <div class="col-md-3 col-lg-2">
                    <div class="form-check form-check-primary form-group">
                      <label id="category_{{ $item->id }}" class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="category_{{ $item->id }}"
                          name="category[]" type="checkbox" value="{{ $item->id }}"
                          @if ($product->categories->contains($item->id)) checked @endif />
                        {{ $item->name }}
                      </label>
                    </div>
                  </div>
                @endforeach
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="image">Gambar</label>
                    <input type="file" class="filepond image" name="image" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description"></textarea>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary mr-2">Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    FilePond.create(
      document.querySelector('.image'), {
        server: {
          load: (source, load, error, progress, abort, headers) => {
            fetch(source)
              .then(response => response.blob())
              .then(load)
              .catch(error);
          },
          process: "/dashboard/upload-image-multiple",
          revert: "/dashboard/cancel-image-multiple",
          remove: (source, load, error) => {
            fetch('/dashboard/product/remove-image-multiple', {
                method: 'DELETE',
                headers: {
                  'X-CSRF-TOKEN': CSRF_TOKEN,
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                  source: source
                })
              })
              .then(response => response.json())
              .then(data => {
                if (data.success) {
                  load();
                } else {
                  error('An error occurred while removing the file.');
                }
              })
              .catch(err => {
                error(err.message);
              });
          },
          headers: {
            "X-CSRF-TOKEN": CSRF_TOKEN,
          },
        },
        allowMultiple: true,
        allowReorder: true,
        allowFileSizeValidation: true,
        allowFileTypeValidation: true,
        maxFiles: 5,
        maxFileSize: '2MB',
        labelMaxFileSize: 'Maximum file size is {filesize}',
        acceptedFileTypes: ['image/*'],
        labelFileTypeNotAllowed: 'File of invalid type. Please upload PNG, JPG, or JPEG files only.',
        files: [
          @foreach ($images as $image)
            @if ($image->image_url)
              {
                source: "{{ asset('storage/image-filepond/' . $image->image_url) }}",
                options: {
                  type: 'local'
                }
              },
            @endif
          @endforeach
        ],
      }
    );

    CKEDITOR.ClassicEditor.create(document.querySelector('#description'), {
      toolbar: {
        items: [
          'heading', '|',
          'bold', 'italic', 'underline', 'subscript', 'superscript', 'link', "uploadImage", '|',
          'bulletedList', 'numberedList', 'blockQuote', '|',
          'undo', 'redo', 'sourceEditing',
          '-',
        ],
        shouldNotGroupWhenFull: true,
      },
      heading: {
        options: [{
            model: 'paragraph',
            title: 'Paragraph',
            class: 'ck-heading_paragraph'
          },
          {
            model: 'heading6',
            view: 'h6',
            title: 'Heading 6',
            class: 'ck-heading_heading6'
          }
        ],
      },
      placeholder: "Write Drescription",
      link: {
        decorators: {
          addTargetToExternalLinks: true,
          defaultProtocol: "https://",
          toggleDownloadable: {
            mode: "manual",
            label: "Downloadable",
            attributes: {
              download: "file",
            },
          },
        },
      },
      image: {
        resizeOptions: [{
            name: 'resizeImage:100',
            value: '100',
            icon: 'full'
          },
          {
            name: 'resizeImage:75',
            value: '75',
            icon: 'large'
          },
          {
            name: 'resizeImage:50',
            value: '50',
            icon: 'medium'
          },
          {
            name: 'resizeImage:original',
            value: null,
            icon: 'original'
          },
        ],
        styles: {
          options: [{
              name: 'alignLeft',
              title: 'Align Left',
              icon: 'left',
              className: 'image-align-left'
            },
            {
              name: 'alignCenter',
              title: 'Align Center',
              icon: 'center',
              className: 'image-align-center'
            },
            {
              name: 'alignRight',
              title: 'Align Right',
              icon: 'right',
              className: 'image-align-right'
            },
          ]
        },
        toolbar: [
          'imageStyle:alignLeft',
          'imageStyle:alignCenter',
          'imageStyle:alignRight',
          '|', 'resizeImage', 'toggleImageCaption', 'linkImage'
        ],
      },
      ckfinder: {
        uploadUrl: "{{ route('dashboard.product.image', ['_token' => csrf_token()]) }}",
      },
      removePlugins: [
        // 'ExportPdf',
        // 'ExportWord',
        "AIAssistant",
        // "CKBox",
        // "CKFinder",
        // "EasyImage",
        // 'Base64UploadAdapter',
        "RealTimeCollaborativeComments",
        "RealTimeCollaborativeTrackChanges",
        "RealTimeCollaborativeRevisionHistory",
        "PresenceList",
        "Comments",
        "TrackChanges",
        "TrackChangesData",
        "RevisionHistory",
        "Pagination",
        "WProofreader",
        "MathType",
        "SlashCommand",
        "Template",
        "DocumentOutline",
        "FormatPainter",
        "TableOfContents",
        "PasteFromOfficeEnhanced",
        "CaseChange",
      ],
    }).then(editor => {
      editor.setData(`
        {!! $product->description !!}
      `);
    }).catch(error => {
      console.error(error);
    });;
  </script>
@endpush
