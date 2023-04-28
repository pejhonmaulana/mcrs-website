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
                                        Silahkan rating minimal 3 tempat makan
                                    </h1>
                                    <p>
                                        website ini merupakan sebuah website untuk memberikan rekomendasi tempat makan di
                                        kota malang.
                                        website ini dibuat sebagai hasil skripsi dari .... dengan menggunakan metode MCRS.
                                    </p>
                                    <div class="btn-box">
                                        <a href="{{ route('home') }}" class="btn1">
                                            Kembali ke Home
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
                <h2>
                    @if ($jumlahTerRating >= 3)
                        Silahkan update rating untuk memperbaharui rekomendasi tempat makan
                    @else
                        Silahkan rating {{ 3 - $jumlahTerRating }} tempat makan untuk mendapat rekomendasi
                    @endif
                </h2>
            </div>
            <div class="filters-content">
                <div class="row grid">
                    @foreach ($tempatKuliners as $item)
                        <div class="row">
                            <div class="col-sm-6 col-lg-4 all burger">
                                <div class="box">
                                    <div>
                                        <div class="img-box">
                                            <img src="{{ asset($item->image) }}" alt="">
                                        </div>

                                        <div class="row">
                                            <div class="col-8">
                                                <div class="detail-box">
                                                    <h5>
                                                        {{ $item->nama_tempat }}
                                                    </h5>
                                                    <p style="font-size: 10px">{{ $item->location }}</p>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-sm btn-primary mt-4"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $item->id }}">
                                                    @if (isset($item->ratings->first()->overall))
                                                        @if ($item->ratings->first()->overall != null)
                                                            Update
                                                        @else
                                                            Rating
                                                        @endif
                                                    @else
                                                        Rating
                                                    @endif
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel{{ $item->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-dark"
                                                                    id="exampleModalLabel{{ $item->id }}">
                                                                    Rating
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form
                                                                action="{{ route('rating.store', ['tempat_kuliner_id' => $item->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="label"
                                                                            class="form-label text-dark">Tempat
                                                                            Parkir</label>
                                                                        <br>
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input"
                                                                                    type="radio" name="tempat_parkir"
                                                                                    name="tempat_parkir" id="tempat_parkir"
                                                                                    value="{{ $i }}" required>
                                                                                <label class="form-check-label text-dark"
                                                                                    for="tempat_parkir">{{ $i }}</label>
                                                                            </div>
                                                                        @endfor
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="label"
                                                                            class="form-label text-dark">Harga</label>
                                                                        <br>
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input"
                                                                                    type="radio" name="harga"
                                                                                    id="harga"
                                                                                    value="{{ $i }}" required>
                                                                                <label class="form-check-label text-dark"
                                                                                    for="harga">{{ $i }}</label>
                                                                            </div>
                                                                        @endfor
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="label"
                                                                            class="form-label text-dark">Pegawai</label>
                                                                        <br>
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input"
                                                                                    type="radio" name="pegawai"
                                                                                    id="pegawai"
                                                                                    value="{{ $i }}" required>
                                                                                <label class="form-check-label text-dark"
                                                                                    for="pegawai">{{ $i }}</label>
                                                                            </div>
                                                                        @endfor
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="label"
                                                                            class="form-label text-dark">Menu</label>
                                                                        <br>
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input"
                                                                                    type="radio" name="menu"
                                                                                    id="menu"
                                                                                    value="{{ $i }}" required>
                                                                                <label class="form-check-label text-dark"
                                                                                    for="menu">{{ $i }}</label>
                                                                            </div>
                                                                        @endfor
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="label"
                                                                            class="form-label text-dark">Akses
                                                                            Jalan</label>
                                                                        <br>
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input"
                                                                                    type="radio" name="akses_jalan"
                                                                                    id="akses_jalan"
                                                                                    value="{{ $i }}" required>
                                                                                <label class="form-check-label text-dark"
                                                                                    for="akses_jalan">{{ $i }}</label>
                                                                            </div>
                                                                        @endfor
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="label"
                                                                            class="form-label text-dark">Mushola</label>
                                                                        <br>
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input"
                                                                                    type="radio" name="musholla"
                                                                                    id="musholla"
                                                                                    value="{{ $i }}" required>
                                                                                <label class="form-check-label text-dark"
                                                                                    for="musholla">{{ $i }}</label>
                                                                            </div>
                                                                        @endfor
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="label"
                                                                            class="form-label text-dark">Keseluruhan</label>
                                                                        <br>
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input"
                                                                                    type="radio" name="overall"
                                                                                    id="overall"
                                                                                    value="{{ $i }}" required>
                                                                                <label class="form-check-label text-dark"
                                                                                    for="overall">{{ $i }}</label>
                                                                            </div>
                                                                        @endfor
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Kembali</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
