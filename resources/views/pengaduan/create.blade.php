<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form pengaduan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('slick') }}/img/logoRR.png" type="image/png">
    <link rel="stylesheet" href="{{ asset('slick') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('slick') }}/css/animate.css">
    <link rel="stylesheet" href="{{ asset('slick') }}/css/LineIcons.css">
    <link rel="stylesheet" href="{{ asset('slick') }}/css/owl.carousel.css">
    <link rel="stylesheet" href="{{ asset('slick') }}/css/owl.theme.css">
    <link rel="stylesheet" href="{{ asset('slick') }}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('slick') }}/css/nivo-lightbox.css">
    <link rel="stylesheet" href="{{ asset('slick') }}/css/main.css">
    <link rel="stylesheet" href="{{ asset('slick') }}/css/responsive.css">
    <style>
        .mt-custom {
            margin-top: 8rem;
        }
    </style>
</head>
{{-- create.blade.php --}}
<body>
    <nav class="navbar navbar-expand-md bg-inverse fixed-top scrolling-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('slick/img/logonavbar.png') }}" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <i class="lni-menu"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="mr-auto navbar-nav w-100 justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#services">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#features">Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#team">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#contact">Mitra</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="{{ route('pengaduan.create') }}">Pengaduan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-custom">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mt-5 card">
                    <div class="card-body">
                        <h3 class="text-center">Form Pengaduan</h3>
                        <p class="mb-4 text-center">Ayo Ajukan Kritik Dan Saran untuk mengembangkan Komunitas Kami</p>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('pengaduan.store') }}">
                            @csrf
                            <div class="mt-4 form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama') }}">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success btn-block">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
