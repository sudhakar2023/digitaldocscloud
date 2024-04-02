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
				<link rel="shortcut icon" href="{{ asset(Storage::url('upload/logo')) . '/favicon.png' }}" type="image/x-icon">
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
				<!-- header start-->
				<header class="land-header fixed mb-0" style="background: linear-gradient(45deg, #834bff, #ff6f00);">
								<div class="container">
												<div class="row">
																<div class="col-12">
																				<div class="header-contain position-relative">
																								<div class="codex-brand">
																												<a href="#">
																																<img class="img-fluid dark-logo landing-logo"
																																				src="{{ asset('assets/images/logo/default-monochrome.svg') }}" alt="">
																												</a>
																								</div>
																								<div class="d-flex align-items-center">
																												<div class="menu-block">
																																<ul class="menu-list">
																																				<li class="d-xl-none">
																																								<a class="close-menu" href="javascript:void(0);">
																																												<div class="menu-brand">
																																																<img class="img-fluid" src="{{ asset('assets/images/logo/logo.png') }}"
																																																				alt=""><i data-feather="x"></i>
																																												</div>
																																								</a>
																																				</li>
																																				<li class="menu-item"><a href="/">{{ __('Home') }}</a></li>
																																				<li class="menu-item"><a href="/about">{{ __('About') }}</a></li>
																																				<li class="menu-item"><a href="/#contact">{{ __('Contact Us') }}</a></li>
																																				<li class="menu-item"><a href="/#features">{{ __('Features') }}</a></li>
																																				<li class="menu-item"><a href="/pricing">{{ __('Pricing') }}</a></li>
																																				<li class="menu-item">
																																								<a class="btn btn-primary me-2"
																																												href="{{ route('login') }}">{{ __('Login') }} </a>
																																								<a class="btn btn-primary" href="{{ route('register') }}">{{ __('Register') }}
																																								</a>
																																				</li>

																																</ul>
																																<a class="menu-action d-xl-none" href="javascript:void(0);"><i
																																								class="fa fa-bars"></i></a>
																												</div>
																								</div>
																				</div>
																</div>
												</div>
								</div>
				</header>


				<!-- Pricing Section -->

				<section class="pricing py-5 " style="background: linear-gradient(45deg, #834bff, #ff6f00);">
								<div class="container">
												<div class="row">
																<?php
																
																$plans = [
																    [
																        'name' => '<span style="color: #0d6efd;">BASIC</span>',
																        'price' => '<span style="font-weight: bold; font-family: Arial, sans-serif;">0.00</span>',
																        'period' => 'Monthly',
																        'features' => [
																            'User Limit' => 1,
																            'Document Limit' => 5,
																            'User History' => true,
																            'Document History' => true,
																        ],
																        'color' => '#0d6efd',
																    ],
																    [
																        'name' => '<span style="color: #0d6efd;">STANDARD</span>',
																        'price' => '<span style="font-weight: bold; font-family: Arial, sans-serif;">19.99</span>',
																        'period' => 'Monthly',
																        'features' => [
																            'User Limit' => 3,
																            'Document Limit' => 12,
																            'User History' => true,
																            'Document History' => true,
																        ],
																        'color' => 'green',
																    ],
																    [
																        'name' => '<span style="color: #0d6efd;">PREMIUM</span>',
																        'price' => '<span style="font-weight: bold; font-family: Arial, sans-serif;">39.99</span>',
																        'period' => 'Monthly',
																        'features' => [
																            'User Limit' => 5,
																            'Document Limit' => 20,
																            'User History' => true,
																            'Document History' => true,
																        ],
																        'color' => 'orange',
																    ],
																    [
																        'name' => '<span style="color: #0d6efd;">ENTERPRISE</span>',
																        'price' => '<span style="font-weight: bold; font-family: Arial, sans-serif;">79.99</span>',
																        'period' => 'Monthly',
																        'features' => [
																            'User Limit' => 'Unlimited',
																            'Document Limit' => 'Unlimited',
																            'User History' => true,
																            'Document History' => true,
																        ],
																        'color' => 'red',
																    ],
																];
																
																foreach ($plans as $plan) {
																    echo '<div class="col-lg-4">';
																    echo '<div class="card mb-5 mb-lg-0">';
																    echo '<div class="card-body">';
																    echo "<h5 class=\"card-title text-muted text-uppercase text-center\">{$plan['name']}</h5>";
																    echo "<h6 class=\"card-price text-center\">{$plan['price']}<span class=\"period\">44444444</span></h6>";
																    echo '<hr>';
																    echo '<ul class="fa-ul">';
																    foreach ($plan['features'] as $feature => $value) {
																        echo '<li>';
																        if (is_bool($value)) {
																            echo $value ? '<span class="fa-li"><i class="fa fa-check" style="color: #0d6efd;"></i></span>' : '<span class="fa-li"><i class="fa fa-times" style="color: #0d6efd;"></i></span>';
																        } else {
																            echo "<span class=\"fa-li\"><i class=\"fa fa-check\" style=\"color: #0d6efd;\"></i></span> {$value}";
																        }
																        echo " {$feature}</li>";
																    }
																    echo '</ul>';
																    echo '<hr>';
																    echo '<div class="text-center">';
																    echo '</div>';
																    echo '</div>';
																    echo '</div>';
																    echo '</div>';
																}
																?>
												</div>
								</div>
				</section>

				<footer class="codex-footer" style="background: #051722;">
								<p>{{ __('Copyright') }} {{ date('Y') }} © {{ env('APP_NAME') }} {{ __('All rights reserved') }}.</p>
				</footer>

</body>

</html>
