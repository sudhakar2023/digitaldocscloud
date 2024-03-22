<section class="pricing py-100" id="pricing" style="background: linear-gradient(45deg, #45B69F, #283480);
">
	<div class="row">
		<div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1">
			<div class="land-title">
				<h2 class="wow fadeInUp" data-wow-duration="1s" style="visibility: visible; animation-duration: 1s; animation-name: fadeInUp; color: #FFFFFF;">Pricing</h2>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row d-flex justify-content-center">
			@foreach ($subscriptions as $index => $subscription)
				<div class="col-md-3 col-sm-6">
					<div class="pricingTable {{ $index == 1 ? "blue" : "" }} {{ $index == 2 ? "green" : "" }}">
						<div class="pricingTable-header">
{{--							<i class="fa fa-adjust"></i>--}}
							<div class="price-value"> ${{ $subscription->price  }} <span class="month">{{ $subscription->duration  }}</span> </div>
						</div>
						<h3 class="heading">Standard</h3>
						<div class="pricing-content">
							<ul>
								<li><b>{{ $subscription->total_user  }}</b> User Limit</li>
								<li><b>{{ $subscription->total_document  }}</b> Document Limit</li>
								<li>Document History  <b>{{ $subscription->enabled_document_history ? "Enabled" : "Disabled"  }}</b></li>
								<li>User History <b>{{ $subscription->enabled_user_history ? "Enabled" : "Disabled" }}</b></li>
							</ul>
						</div>
						<div class="pricingTable-signup">
							<a href="{{ route('subscriptions.show', \Illuminate\Support\Facades\Crypt::encrypt($subscription->id)) }}">Purchase</a>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</section>
