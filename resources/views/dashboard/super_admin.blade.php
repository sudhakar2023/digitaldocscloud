@extends('layouts.app')
@section('page-title')
				{{ __('Dashboard') }}
@endsection
@section('breadcrumb')
				<ul class="breadcrumb mb-0">
								<li class="breadcrumb-item">
												<a href="{{ route('dashboard') }}">
																<h1>{{ __('Dashboard') }}</h1>
												</a>
								</li>

				</ul>
@endsection
@push('script-page')
				<script>
								var organizationByMonthData = {!! json_encode($data['organizationByMonth']['data']) !!};
								var organizationByMonthLabel = {!! json_encode($data['organizationByMonth']['label']) !!};
								var paymentByMonthData = {!! json_encode($data['paymentByMonth']['data']) !!};
								var paymentByMonthLabel = {!! json_encode($data['paymentByMonth']['label']) !!};
				</script>

				<script src="{{ asset('js/custom/super_dashboard.js') }}"></script>
@endpush
@section('content')
				<div class="row">
								<div class="col-md-4 cdx-xxl-10">
												<div class="card sale-revenue">
																<div class="card-header">
																				<h4>{{ __('Total Organizations') }}</h4>
																				<i class="ti-world" style="font-size: x-large; color:#44b59e;"></i>
																</div>
																<div class="card-body progressCounter">
																				<h2>{{ $data['totalOrganization'] }}</h2>
																</div>
												</div>
								</div>
								<div class="col-md-4 cdx-xxl-10">
												<div class="card sale-revenue">
																<div class="card-header">
																				<h4>{{ __('Total Subscription') }}</h4>
																				<i class="ti-clipboard" style="font-size: x-large; color:#44b59e;"></i>
																</div>
																<div class="card-body progressCounter">
																				<h2>{{ $data['totalSubscription'] }}</h2>
																</div>
												</div>
								</div>
								<div class="col-md-4 cdx-xxl-10">
												<div class="card sale-revenue">
																<div class="card-header">
																				<h4>{{ __('Total Transaction') }}</h4>
																				<i class="ti-receipt" style="font-size: x-large; color:#44b59e;"></i>
																</div>
																<div class="card-body progressCounter">
																				<h2>{{ $data['totalTransaction'] }}</h2>
																</div>
												</div>
								</div>
				</div>
				<div class="row">
								<div class="col-md-4 cdx-xxl-10">
												<div class="card sale-revenue">
																<div class="card-header">
																				<h4>{{ __('Total Income') }}</h4>
																				<i class="ti-wallet" style="font-size: x-large; color:#44b59e;"></i>
																</div>
																<div class="card-body progressCounter">
																				<h2>{{ env('CURRENCY_SYMBOL') . $data['totalIncome'] }}</h2>
																</div>
												</div>
								</div>
								<div class="col-md-4 cdx-xxl-10">
												<div class="card sale-revenue">
																<div class="card-header">
																				<h4>{{ __('Total Notes') }}</h4>
																				<i class="ti-notepad" style="font-size: x-large; color:#44b59e;"></i>
																</div>
																<div class="card-body progressCounter">
																				<h2>{{ $data['totalNote'] }}</h2>
																</div>
												</div>
								</div>

								<div class="col-md-4 cdx-xxl-10">
												<div class="card sale-revenue">
																<div class="card-header">
																				<h4>{{ __('Total Contact') }}</h4>
																				<i class="ti-wallet" style="font-size: x-large; color:#44b59e;"></i>
																</div>
																<div class="card-body progressCounter">
																				<h2>{{ $data['totalContact'] }}</h2>
																</div>
												</div>
								</div>
				</div>
				<div class="row">
								<div class="col-md-6">
												<div class="card overall-revenuetbl">
																<div class="card-header">
																				<h4>{{ __('Users By Month') }}</h4>
																</div>
																<div class="card-body">
																				<div id="organization_by_month"></div>
																</div>
												</div>
								</div>
								<div class="col-md-6">
												<div class="card overall-revenuetbl">
																<div class="card-header">
																				<h4>{{ __('Payments By Month') }}</h4>
																</div>
																<div class="card-body">
																				<div id="payments_by_month"></div>
																</div>
												</div>
								</div>
				</div>
				</div>
@endsection
