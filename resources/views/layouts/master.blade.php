<!DOCTYPE html>
<html>

<head>
    @include('layouts.head')
</head>

<body @yield('subpage')>

    <div class="hero_area">
        <div class="bg-box">
            <img src="{{ asset('assets/images/hero-bg.jpg') }}" alt="">
        </div>
        <!-- header section strats -->
        <header class="header_section">
            @include('layouts.header')
        </header>
        <!-- end header section -->
        <!-- optional -->
        @yield('slider')
    </div>

    <!-- main section -->
    @yield('content')
    <!-- end main section -->

    <!-- footer section -->
    @include('layouts.footer')
    <!-- footer section -->

    @include('layouts.script')

</body>

</html>
