<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Business, Service">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">
    <title>Recycle Reward</title>
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

</head>

<body>

    <header id="home" class="hero-area">
        <div class="overlay">
            <span></span>
            <span></span>
        </div>
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
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="{{ route('pengaduan.create') }}">pengaduan</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-signin" href="{{ route('filament.user.auth.login') }}">Sign In</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row space-100">
                <div class="col-lg-6 col-md-12 col-xs-12">
                    <div class="contents">
                        <h2 class="head-title">Recycle Reward</h2>
                        <p>Gabung ke komunitas kami </br> Kirimkan Sampahmu, Tukarkan ke REWARDS!</p>
                        <div class="header-button">
                            <a href="/user/register" rel="nofollow" class="btn btn-border page-scroll">Sign Up</a>
                            <a href="/user/login" rel="nofollow" class="btn btn-border-filled">Sign In</a>
                        </div>
                    </div>
                </div>
                <div class="p-0 col-lg-6 col-md-12 col-xs-12">
                    <div class="intro-img">
                        <img src="{{ asset('slick') }}/img/introRR.png" alt="Logo" width="981" height="794">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="services" class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12 d-flex align-items-stretch">
                    <div class="p-3 text-center border services-item w-100">
                        <div class="icon">
                            <i class="lni-cog"></i>
                        </div>
                        <h4>LATAR BELAKANG</h4>
                        <p>Tantangan besar saat ini adalah memastikan keberlanjutan lingkungan dengan pengelolaan limbah
                            yang efektif. Meskipun kesadaran masyarakat meningkat, kurangnya insentif dan akses
                            membatasi partisipasi dalam daur ulang. "RecycleRewards" hadir sebagai solusi untuk
                            meningkatkan efektivitas daur ulang dengan memberikan insentif kepada masyarakat.</p>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-xs-12 d-flex align-items-stretch">
                    <div class="p-3 text-center border services-item w-100">
                        <div class="icon">
                            <i class="lni-brush"></i>
                        </div>
                        <h4>DESKRIPSI</h4>
                        <p>Sebuah Website yang bergerak dibidang pengelolaan limbah daur ulang dimana para Pengguna
                            sebagai active agent dapat berpartisipasi dalam pengumpulan limbah daur ulang. Sesuai
                            namanya “RecycleReward” menawarkan para pengguna dengan Point sebagai reward yang dapat
                            ditukar dengan Hadiah menarik. Di sisi lain “RecycleReward” Menawarkan sistem ranking. maka
                            dengan semakin tinggi peringkat pengguna, pengguna dapat menerima Reward yang lebih besar.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="business-plan">
        <div class="container">
            <div class="row">
                <div class="pl-0 pr-5 col-lg-6 col-md-12 pt-70">
                    <div class="business-item-img">
                        <img src="{{ asset('slick') }}/img/business/recycle.jpg" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="pl-4 col-lg-6 col-md-12">
                    <div class="business-item-info">
                        <h3>Apa itu Recycle?</h3>
                        <p class="text-justify">
                            Recycle adalah istilah atau kata yang menggambarkan mengenai upaya manusia untuk mengolah
                            limbah yang dihasilkannya. Dengan mendaur ulang sampah memang bukan solusi atau jalan keluar
                            untuk mengatasi masalah sampah yang semakin meningkat. Namun dengan memilah sampah yang
                            dapat didaur ulang, maka jumlah limbah bisa sedikit berkurang.
                        </p>
                        <p class="text-justify">
                            Dalam Kamus Besar Bahasa Indonesia (KBBI), kata daur ulang memiliki arti suatu kegiatan atau
                            pemrosesan kembali bahan yang pernah digunakan. Berdasarkan penjelasan tersebut, maka kita
                            dapat mengartikan bahwa recycle merupakan kegiatan untuk mendaur ulang kembali barang bekas
                            seperti kertas, plastik, dan lain sebagainya.
                        </p>
                        <a class="btn btn-common"
                            href="https://www.gramedia.com/literasi/recycle-adalah/">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="bg-white section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center features-text section-header">
                        <div>
                            <h2 class="section-title">Barang Daur Ulang</h2>
                            <div class="desc-text">
                                <p>Terdapat 6 kategori barang daur ulang yang kami terima:</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row featured-bg">
                <div class="p-3 col-lg-6 col-md-6 col-xs-12">
                    <div class="p-3 border h-100">
                        <div class="feature-info">
                            <h4>Plastik</h4>
                            <p>Botol plastik, kemasan snack, kantong plastik, sedotan, wadah makanan plastik, dan semua
                                jenis plastik yang dapat didaur ulang.</p>
                        </div>
                    </div>
                </div>

                <div class="p-3 col-lg-6 col-md-6 col-xs-12">
                    <div class="p-3 border h-100">
                        <div class="feature-info">
                            <h4>Kertas</h4>
                            <p>Kertas lembaran, buku, majalah, koran, kardus, karton, dan semua jenis kertas yang dapat
                                didaur ulang.</p>
                        </div>
                    </div>
                </div>
                <div class="p-3 col-lg-6 col-md-6 col-xs-12">
                    <div class="p-3 border h-100">
                        <div class="feature-info">
                            <h4>Logam</h4>
                            <p>Kaleng minuman, kaleng makanan, aluminium foil, wadah logam, paku, sekrup, dan semua
                                jenis logam yang dapat didaur ulang.</p>
                        </div>
                    </div>
                </div>
                <div class="p-3 col-lg-6 col-md-6 col-xs-12">
                    <div class="p-3 border h-100">
                        <div class="feature-info">
                            <h4>Tekstil</h4>
                            <p>Baju, tas, kain perca, sepatu, selimut, dan semua jenis produk tekstil yang dapat didaur
                                ulang.</p>
                        </div>
                    </div>
                </div>
                <div class="p-3 col-lg-6 col-md-6 col-xs-12">
                    <div class="p-3 border h-100">
                        <div class="feature-info">
                            <h4>Kaca</h4>
                            <p>Botol kaca, gelas kaca, jendela kaca, dan semua jenis kaca yang dapat didaur ulang.</p>
                        </div>
                    </div>
                </div>
                <div class="p-3 col-lg-6 col-md-6 col-xs-12">
                    <div class="p-3 border h-100">
                        <div class="feature-info">
                            <h4>Elektronik</h4>
                            <p>Perangkat elektronik kecil seperti ponsel, tablet, remote, mainan elektronik, dan semua
                                jenis perangkat elektronik yang dapat didaur ulang.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="team" class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center team-text section-header">
                        <div>
                            <h2 class="section-title">Team Members</h2>
                            <div class="desc-text">
                                <p>Team perancang Recycler Rewards</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="single-team">
                        <div class="team-thumb">
                            <img src="{{ asset('slick') }}/img/team/nasywa.jpg" class="img-fluid" alt="">
                        </div>
                        <div class="team-details">
                            <div class="text-center team-inner">
                                <h5 class="team-title">Nasywa Raichanah</h5>
                                <p>L0122121</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="single-team">
                        <div class="team-thumb">
                            <img src="{{ asset('slick') }}/img/team/ridlo.jpg" class="img-fluid" alt="">
                        </div>

                        <div class="team-details">
                            <div class="text-center team-inner">
                                <h5 class="team-title">Ridlo Abdullah Ulinnuha</h5>
                                <p>L0122138</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="single-team">
                        <div class="team-thumb">
                            <img src="{{ asset('slick') }}/img/team/whilyan.jpg" class="img-fluid" alt="">
                        </div>

                        <div class="team-details">
                            <div class="text-center team-inner">
                                <h5 class="team-title">Whilyan Pratama</h5>
                                <p>L0122151</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center contact-text section-header">
                        <div>
                            <h2 class="section-title">MITRA</h2>
                            <div class="desc-text">
                                <p>AYO MENJADI MITRA RECYCLE REWARD</p>
                                <p>CINTAI LINGKUNGAN INI BERGABUNG BERSAMA KAMI</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="text-center col-12">
                    <img src="{{ asset('slick') }}/img/Mitra.png" class="mb-4 img-fluid" alt="">
                </div>
                <div class="text-center col-12">
                    <div class="submit-button">
                        <a href="https://wa.me/088227698614" rel="nofollow" class="btn btn-border-filled">Join Us</a>
                    </div>
                </div>
                <div class="col-lg-1">
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="contact-img">
                        <img src="img/contact/01.png" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-1">
                </div>
            </div>
        </div>
    </section>


    <footer>
        <section id="footer-Content">
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center site-info">
                                <p>Contact Us <br> <a rel="nofollow">rr.recyclerrewards@gmail.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </footer>
    <a href="#" class="back-to-top">
        <i class="lni-chevron-up"></i>
    </a>
    <div id="preloader">
        <div class="loader" id="loader-1"></div>
    </div>
    <script src="{{ asset('slick') }}/js/jquery-min.js"></script>
    <script src="{{ asset('slick') }}/js/popper.min.js"></script>
    <script src="{{ asset('slick') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('slick') }}/js/owl.carousel.js"></script>
    <script src="{{ asset('slick') }}/js/jquery.nav.js"></script>
    <script src="{{ asset('slick') }}/js/scrolling-nav.js"></script>
    <script src="{{ asset('slick') }}/js/jquery.easing.min.js"></script>
    <script src="{{ asset('slick') }}/js/nivo-lightbox.js"></script>
    <script src="{{ asset('slick') }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('slick') }}/js/main.js"></script>
</body>

</html>
