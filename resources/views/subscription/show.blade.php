@extends('layouts.app')
@section('page-title')
				iii
				{{ __('Subscription') }}
@endsection

@push('script-page')
				<script src="https://js.stripe.com/v3/"></script>
				<script type="text/javascript">
								@if (
												$subscription->price > 0.0 &&
																env('STRIPE_PAYMENT') == 'on' &&
																!empty(env('STRIPE_KEY')) &&
																!empty(env('STRIPE_SECRET')))

												var form = document.getElementById('stripe-payment');
												var stripeBtn = document.getElementById('stripe_method');
												var paypalBtn = document.getElementById('paypal_method');

												stripeBtn.addEventListener('click', (e) => {
																e.preventDefault();
																var hiddenInput = document.createElement('input');
																hiddenInput.setAttribute('type', 'hidden');
																hiddenInput.setAttribute('name', 'payment_type');
																hiddenInput.setAttribute('value', 'stripe');
																form.appendChild(hiddenInput);
																form.requestSubmit();
												});

												paypalBtn.addEventListener('click', (e) => {
																e.preventDefault();
																var hiddenInput = document.createElement('input');
																hiddenInput.setAttribute('type', 'hidden');
																hiddenInput.setAttribute('name', 'payment_type');
																hiddenInput.setAttribute('value', 'paypal');
																form.appendChild(hiddenInput);
																form.requestSubmit();
												});

												// form.addEventListener('submit', function(event) {
												//     event.preventDefault();
												// console.log(card);
												// stripe.createToken(card).then(function (result) {
												//     if (result.error) {
												//         $("#card-errors").html(result.error.message);
												//         $.NotificationApp.send("Error", result.error.message, "top-right", "rgba(0,0,0,0.2)", "error");
												//     } else {
												//         stripeTokenHandler(result.token);
												//     }
												// });
												// stripe.createToken(card).then(function(result) {
												// }
												// });
												// });

												function stripeTokenHandler(token) {
																var form = document.getElementById('stripe-payment');
																var hiddenInput = document.createElement('input');
																hiddenInput.setAttribute('type', 'hidden');
																hiddenInput.setAttribute('name', 'stripeToken');
																hiddenInput.setAttribute('value', token.id);
																form.appendChild(hiddenInput);
																form.submit();
												}
								@endif
				</script>
@endpush
@section('breadcrumb')
				<ul class="breadcrumb mb-0">
								<li class="breadcrumb-item">
												<a href="{{ route('dashboard') }}">
																<h1>{{ __('Dashboard') }}</h1>
												</a>
								</li>
								<li class="breadcrumb-item">
												<a href="{{ route('subscriptions.index') }}">{{ __('Subscription') }}</a>
								</li>
								<li class="breadcrumb-item active">
												<a href="#">{{ __('Details') }}</a>
								</li>
				</ul>
@endsection
@section('content')
				<div class="row pricing-grid">
								<div class="col-xxl-3 cdx-xl-50 col-sm-6">
												<div class="codex-pricingtbl">
																<div class="price-header">
																				<h2>{{ $subscription->name }}</h2>
																				<div class="price-value">{{ env('CURRENCY_SYMBOL') . $subscription->price }}
																								<span>/ {{ $subscription->duration }}</span>
																				</div>
																</div>
																<ul class="cdxprice-list">
																				<li><span>{{ $subscription->total_user }}</span>{{ __('User Limit') }}</li>
																				<li><span>{{ $subscription->total_document }}</span>{{ __('Document Limit') }}</li>
																				<li>
																								<div class="delet-mail">
																												@if ($subscription->enabled_document_history == 1)
																																<i class="text-success mr-4" data-feather="check-circle"></i>
																												@else
																																<i class="text-danger mr-4" data-feather="x-circle"></i>
																												@endif

																												{{ __('Document History') }}
																								</div>
																				</li>
																				<li>
																								<div class="delet-mail">
																												@if ($subscription->enabled_logged_history == 1)
																																<i class="text-success mr-4" data-feather="check-circle"></i>
																												@else
																																<i class="text-danger mr-4" data-feather="x-circle"></i>
																												@endif
																												{{ __('User Logged History') }}
																								</div>
																				</li>
																</ul>
												</div>
								</div>
								<div class="col-lg-9">
												<div class="row">
																<div class="col-12">
																				<div class="card">
																								<div class="card-header">
																												<h4>Choose Payment Method</h4>
																								</div>
																								<div class="card-body">
																												<div class="row">
																																<div class="col-md-4 offset-md-2">
																																				<a href="#" id="stripe_method">
																																								<div class="card" style="max-width: 200px;">
																																												<div class="card-body p-0">
																																																<div class="card bg-dark text-white">
																																																				<img width="200" height="200"
																																																								src="{{ asset('/assets/images/payment/stripe.webp') }}"
																																																								class="card-img img-fluid" alt="stripe payment">
																																																</div>
																																												</div>
																																								</div>
																																				</a>
																																</div>
																																<div class="col-md-6">
																																				<a href="#" id="paypal_method">
																																								<div class="card" style="max-width: 200px;">
																																												<div class="card-body p-0">
																																																<div class="card bg-dark text-white">
																																																				<img width="200" height="200"
																																																								src="{{ asset('/assets/images/payment/paypal.webp') }}"
																																																								class="card-img img-fluid" alt="paypal payment">
																																																</div>

																																												</div>
																																								</div>
																																				</a>
																																</div>
																																<form class="hidden"
																																				action="{{ route('subscription.stripe.payment', \Illuminate\Support\Facades\Crypt::encrypt($subscription->id)) }}"
																																				method="post" class="require-validation" id="stripe-payment">
																																				@csrf
																																</form>
																												</div>
																								</div>
																				</div>
																</div>
												</div>
												{{--            <div class="accordion" id="accordionExample"> --}}
												{{--                <div class="accordion-item"> --}}
												{{--                    <h2 class="accordion-header"> --}}
												{{--                        <button class="accordion-button" type="button" data-bs-toggle="collapse" --}}
												{{--                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> --}}
												{{--                            <i class="ti-credit-card" style="font-size: x-large; color:#44b59e;"></i> Credit Card --}}
												{{--                        </button> --}}
												{{--                    </h2> --}}
												{{--                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample"> --}}
												{{--                        <div class="accordion-body"> --}}
												{{--                            @if (env('STRIPE_PAYMENT') == 'on' && !empty(env('STRIPE_KEY')) && !empty(env('STRIPE_SECRET'))) --}}
												{{--                                <div class="row"> --}}
												{{--                                    <div class="col-sm-12"> --}}
												{{--                                        <div class="card"> --}}
												{{--                                            <div class="card-body profile-user-box"> --}}
												{{--                                                <form --}}
												{{--                                                        action="{{ route('subscription.stripe.payment', \Illuminate\Support\Facades\Crypt::encrypt($subscription->id)) }}" --}}
												{{--                                                        method="post" class="require-validation" id="stripe-payment"> --}}
												{{--                                                    @csrf --}}
												{{--                                                    <input type="hidden" name="payment_type" value="stripe"> --}}
												{{--                                                    <div class="row"> --}}
												{{--                                                        <div class="col-md-12"> --}}
												{{--                                                            <div class="form-group"> --}}
												{{--                                                                <label for="card-name-on" --}}
												{{--                                                                       class="form-label text-dark">{{ __('Card Name') }}</label> --}}
												{{--                                                                <input type="text" name="name" id="card-name-on" --}}
												{{--                                                                       class="form-control required" --}}
												{{--                                                                       placeholder="{{ __('Card Holder Name') }}"> --}}
												{{--                                                            </div> --}}
												{{--                                                        </div> --}}
												{{--                                                        <div class="col-md-12"> --}}
												{{--                                                            <div id="card-element"> --}}
												{{--                                                            </div> --}}
												{{--                                                            <div id="card-errors" role="alert"></div> --}}
												{{--                                                        </div> --}}
												{{--                                                        <div class="col-sm-12 mt-15"> --}}
												{{--                                                            <input type="submit" value="{{ __('Pay') }}" --}}
												{{--                                                                   class="btn btn-primary"> --}}
												{{--                                                        </div> --}}
												{{--                                                    </div> --}}
												{{--                                                </form> --}}
												{{--                                            </div> --}}
												{{--                                        </div> --}}
												{{--                                    </div> --}}
												{{--                                </div> --}}
												{{--                            @endif --}}
												{{--                        </div> --}}
												{{--                    </div> --}}
												{{--                </div> --}}
												{{--                <div class="accordion-item"> --}}
												{{--                    <h2 class="accordion-header"> --}}
												{{--                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" --}}
												{{--                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> --}}
												{{--                            Paypal --}}
												{{--                        </button> --}}
												{{--                    </h2> --}}
												{{--                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample"> --}}
												{{--                        <div class="accordion-body"> --}}
												{{--                            <button class="btn btn-sm btn-primary">Pay Using Paypal</button> --}}
												{{--                        </div> --}}
												{{--                    </div> --}}
												{{--                </div> --}}
												{{--            </div> --}}
								</div>
				</div>
@endsection
