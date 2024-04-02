<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <title>{{ env('APP_NAME') }}</title>
    <!-- shortcut icon-->
    <link rel="icon" href="{{ asset(Storage::url('upload/logo')) . '/favicon.png?v=1' }}" type="image/png">
    <!-- Fonts css-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <!-- Font awesome -->
    <link href="{{ asset('assets/css/vendor/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/vendor/icoicon/icoicon.css') }}" rel="stylesheet">
    <!-- animat css-->
    <link href="{{ asset('assets/css/vendor/animate.css') }}" rel="stylesheet">
    <!-- Bootstrap css-->
    <link href="{{ asset('assets/css/vendor/bootstrap.css') }}" rel="stylesheet">
    <!-- Custom css-->

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>

<body>
<style>
    .white-mode {
        text-decoration: none;
        padding: 17px 40px;
        background-color: yellow;
        border-radius: 3px;
        color: black;
        transition: .35s ease-in-out;
        position: absolute;
        left: 15px;
        bottom: 15px
    }
    .pricingTable {
        text-align: center;
        background: #fff;
        margin: 0 -15px;
        box-shadow: 0 0 10px #ababab;
        padding-bottom: 40px;
        border-radius: 10px;
        color: #cad0de;
        transform: scale(1);
        transition: all .5s ease 0s
    }

    .pricingTable:hover {
        transform: scale(1.05);
        z-index: 1
    }

    .pricingTable .pricingTable-header {
        padding: 40px 0;
        background: #f5f6f9;
        border-radius: 10px 10px 50% 50%;
        transition: all .5s ease 0s
    }

    .pricingTable:hover .pricingTable-header {
        background: #ff9624
    }

    .pricingTable .pricingTable-header i {
        font-size: 50px;
        color: #858c9a;
        margin-bottom: 10px;
        transition: all .5s ease 0s
    }

    .pricingTable .price-value {
        font-size: 35px;
        color: #ff9624;
        transition: all .5s ease 0s
    }

    .pricingTable .month {
        display: block;
        font-size: 14px;
        color: #cad0de
    }

    .pricingTable:hover .month,
    .pricingTable:hover .price-value,
    .pricingTable:hover .pricingTable-header i {
        color: #fff
    }

    .pricingTable .heading {
        font-size: 24px;
        color: #ff9624;
        margin-bottom: 20px;
        text-transform: uppercase
    }

    .pricingTable .pricing-content ul {
        list-style: none;
        padding: 0;
        margin-bottom: 30px
    }

    .pricingTable .pricing-content ul li {
        line-height: 30px;
        color: #a7a8aa
    }

    .pricingTable .pricingTable-signup a {
        display: inline-block;
        font-size: 15px;
        color: #fff;
        padding: 10px 35px;
        border-radius: 20px;
        background: #ffa442;
        text-transform: uppercase;
        transition: all .3s ease 0s
    }

    .pricingTable .pricingTable-signup a:hover {
        box-shadow: 0 0 10px #ffa442
    }

    .pricingTable.blue .heading,
    .pricingTable.blue .price-value {
        color: #4b64ff
    }

    .pricingTable.blue .pricingTable-signup a,
    .pricingTable.blue:hover .pricingTable-header {
        background: #4b64ff
    }

    .pricingTable.blue .pricingTable-signup a:hover {
        box-shadow: 0 0 10px #4b64ff
    }

    .pricingTable.red .heading,
    .pricingTable.red .price-value {
        color: #ff4b4b
    }

    .pricingTable.red .pricingTable-signup a,
    .pricingTable.red:hover .pricingTable-header {
        background: #ff4b4b
    }

    .pricingTable.red .pricingTable-signup a:hover {
        box-shadow: 0 0 10px #ff4b4b
    }

    .pricingTable.green .heading,
    .pricingTable.green .price-value {
        color: #00b89f
    }

    .pricingTable.green .pricingTable-signup a,
    .pricingTable.green:hover .pricingTable-header {
        background: #00b89f
    }

    .pricingTable.green .pricingTable-signup a:hover {
        box-shadow: 0 0 10px #00b89f
    }

    .pricingTable.blue:hover .price-value,
    .pricingTable.green:hover .price-value,
    .pricingTable.red:hover .price-value {
        color: #fff
    }

    @media screen and (max-width:990px) {
        .pricingTable {
            margin: 0 0 20px
        }
    }
</style>
    <!-- header start-->
    @include("home.header")

    @yield("content")

    <!-- footer start-->
    @include('home.footer')

    <!-- footer end-->
    <!-- tap to top start-->
    <div class="scroll-top"><i class="fa fa-angle-double-up"></i></div>
    <!-- tap to top end-->
    <!-- main jquery-->
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <!-- Feather iocns js-->
    <script src="{{ asset('assets/js/icons/feather-icon/feather.js') }}"></script>
    <!-- Wow js-->
    <script src="{{ asset('assets/js/vendors/wow.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap.bundle.js') }}"></script>
    <script>
        //*** Header Js ***//
        $(window).scroll(function() {
            if ($(window).scrollTop() > 100) {
                $('header').addClass('sticky');
            } else {
                $('header').removeClass('sticky');
            }
        });

        //*** Menu Js ***//
        $(document).on("click", '.menu-action', function() {
            $('.menu-list').toggleClass('open');
        });
        $(document).on("click", '.close-menu', function() {
            $('.menu-list').removeClass('open');
        });

        //*** BACK TO TOP START ***//
        $(window).scroll(function() {
            if ($(window).scrollTop() > 450) {
                $('.scroll-top').addClass('show');
            } else {
                $('.scroll-top').removeClass('show');
            }
        });
        $(document).ready(function() {
            $(document).on("click", '.scroll-top', function() {
                $('html, body').animate({
                    scrollTop: 0
                }, '450');
            });
        });

        //*** WOW Js ***//
        new WOW().init();
    </script>
</body>

</html>
