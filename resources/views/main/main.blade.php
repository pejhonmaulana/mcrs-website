@extends('layouts.master')
@section('title')
    Tempat Kuliner
@endsection
@section('slider')
    <section class="slider_section ">
        <div id="customCarousel1" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container ">
                        <div class="row">
                            <div class="col-md-7 col-lg-6 ">
                                <div class="detail-box">
                                    <h1>
                                        Rekomendasi Tempat Makan
                                    </h1>
                                    <p>
                                        website ini merupakan sebuah website untuk memberikan rekomendasi tempat makan di
                                        kota malang.
                                        website ini dibuat sebagai hasil skripsi dari .... dengan menggunakan metode MCRS.
                                    </p>
                                    <div class="btn-box">
                                        <a href="{{ route('rating.view') }}" class="btn1">
                                            Dapatkan Rekomendasi
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container ">
                        <div class="row">
                            <div class="col-md-7 col-lg-6 ">
                                <div class="detail-box">
                                    <h1>
                                        Rekomendasi Tempat Makan
                                    </h1>
                                    <p>
                                        website ini merupakan sebuah website untuk memberikan rekomendasi tempat makan di
                                        kota malang.
                                        website ini dibuat sebagai hasil skripsi dari .... dengan menggunakan metode MCRS.
                                    </p>
                                    <div class="btn-box">
                                        <a href="{{ route('rating.view') }}" class="btn1">
                                            Dapatkan Rekomendasi
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <ol class="carousel-indicators">
                    <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
                    <li data-target="#customCarousel1" data-slide-to="1"></li>
                </ol>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
@endsection
@section('content')
    <section class="food_section layout_padding-bottom">
        <div class="container">
            <div class="heading_container heading_center mt-3">
                <h1>
                    Daftar Rekomendasi Tempat Makan (Average Similarity)
                </h1>
            </div>



            @if (isset($recommendations))
                @if ($jumlahTerRating >= 3)
                    <div class="heading_container heading_center mt-3">
                        <h2>
                            Average Similarity
                        </h2>
                    </div>
                    <div class="filters-content">
                        <div class="row grid">
                            @foreach ($recommendations as $item)
                                <div class="col-sm-6 col-lg-4 all burger">
                                    <div class="box">
                                        <div>
                                            <div class="bg-warning text-center">
                                                <b class="text-dark">Rekomendasi</b>
                                            </div>
                                            <div class="img-box">
                                                <img src="{{ asset($item->tempatKuliner->image) }}" alt="">
                                            </div>
                                            <div class="detail-box">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <h5>
                                                            {{ $item->tempatKuliner->nama_tempat }}
                                                        </h5>
                                                    </div>
                                                    <div class="col">
                                                        <div class="rounded-circle bg-warning text-center text-dark">
                                                            <p>{{ $loop->iteration }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <p style="font-size: 10px">{{ $item->tempatKuliner->location }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="heading_container heading_center mt-3">
                        <h2>
                            Aggregate
                        </h2>
                    </div>
                    <div class="filters-content">
                        <div class="row grid">
                            @foreach ($agregateRecom as $item)
                                <div class="col-sm-6 col-lg-4 all burger">
                                    <div class="box">
                                        <div>
                                            <div class="bg-warning text-center">
                                                <b class="text-dark">Rekomendasi</b>
                                            </div>
                                            <div class="img-box">
                                                <img src="{{ asset($item->tempatKuliner->image) }}" alt="">
                                            </div>
                                            <div class="detail-box">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <h5>
                                                            {{ $item->tempatKuliner->nama_tempat }}
                                                        </h5>
                                                    </div>
                                                    <div class="col">
                                                        <div class="rounded-circle bg-warning text-center text-dark">
                                                            <p>{{ $loop->iteration }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <p style="font-size: 10px">{{ $item->tempatKuliner->location }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="mt-3">
                        <p class="text-center text-danger">
                            Klik "Dapatkan Rekomendasi" dan isi rating terlebih dahulu untuk mendapatkan rekomendasi
                        </p>
                    </div>
                @endif
            @else
                <div class="mt-3">
                    <p class="text-center text-danger">
                        Klik "Dapatkan Rekomendasi" dan isi rating terlebih dahulu untuk mendapatkan rekomendasi
                    </p>
                </div>
            @endif
        </div>
    </section>
@endsection
