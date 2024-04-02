@php
				$admin_logo = \App\Models\Custom::getValByName('company_logo');
				$logo_name = $admin_logo ? $admin_logo : 'logo.png';
				$logo = \Illuminate\Support\Facades\Storage::disk('public')->url('upload/logo/' . $logo_name);
@endphp
<footer class="lan-footer py-5">
				<div class="container">
								<div class="row">
												<!-- Helpful links -->
												<div class="col d-flex align-items-center">
													<a href="/" class="d-block mb-3">
														<img style="height: 50px; width: 50px !important; margin-right: 50px"
															 class="img-fluid wow fadeInUp landing-logo" src="{{ $logo }}" alt="">
													</a>
																<div class="d-flex">
																				<a href="#" class="text-decoration-none me-3">Home</a>
																				<a href="#features" class="text-decoration-none me-3">Features</a>
																	<a href="/terms" class="text-decoration-none me-3">Terms And Conditions</a>
																	<a href="/privacy" class="text-decoration-none me-3">Privacy Policy</a>
																</div>
												</div>

												<!-- Logo and copyright -->
												<div class="col text-end">

																<p class="p-10">{{ __('Copyright') }} {{ date('Y') }} {{ '©' }} {{ env('APP_NAME') }}
																				{{ 'All rights reserved' }}
																</p>
												</div>
								</div>
				</div>
</footer>
