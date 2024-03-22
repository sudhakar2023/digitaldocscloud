@php
				$admin_logo = \App\Models\Custom::getValByName('company_logo');
				$logo_name = $admin_logo ? $admin_logo : 'logo.png';
				$logo = \Illuminate\Support\Facades\Storage::disk('public')->url('upload/logo/' . $logo_name);
@endphp
<header class="land-header fixed">
				<div class="container">
								<div class="row">
												<div class="col-12">
																<div class="header-contain position-relative">
																				<div class="codex-brand">
																								<a href="#">
																												<img class="img-fluid dark-logo landing-logo" src="{{ $logo }}" alt="">
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
																																<li class="menu-item"><a href="#">{{ __('Home') }}</a></li>
																																<li class="menu-item"><a href="#features">{{ __('Features') }}</a></li>
																																<li class="menu-item"><a href="#pricing">{{ __('Pricing') }}</a></li>
																																<li class="menu-item">
																																				<!-- login and register routers incomplete -->
																																				<a class="btn btn-primary me-2" style="color: #fff"
																																								href="{{ route('login') }}">{{ __('Login') }} </a>
																																				<a class="btn btn-primary" style="color: #fff"
																																								href="{{ route('register') }}">{{ __('Register') }}
																																				</a>
																																</li>

																												</ul>
																												<a class="menu-action d-xl-none" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
																								</div>
																				</div>
																</div>
												</div>
								</div>
				</div>
</header>
