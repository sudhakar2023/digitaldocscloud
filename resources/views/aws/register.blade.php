@extends('layouts.auth')
@section('tab-title')
    {{ __('Verify') }}
@endsection
@push('script-page')
	<script>
		const form = document.getElementById('aws-register-form');
		form.addEventListener('submit', (e) => {
			e.preventDefault();

			const params = new Proxy(new URLSearchParams(window.location.search), {
  				get: (searchParams, prop) => searchParams.get(prop),
			});

			var hiddenInput = document.createElement('input');
			hiddenInput.setAttribute('type', 'hidden');
			hiddenInput.setAttribute('name', 'clientId');
			hiddenInput.setAttribute('value', params.customer_id);

			e.target.addChild(hiddenInput);
			e.target.submit();
		});
	</script>
@endpush
@section('content')
    <div class="codex-authbox">
        <div class="auth-header">
            <div class="auth-icon"><i class="fa fa-unlock-alt"></i></div>
            <h3>{{ __('Create Account') }}</h3>
            <p>An Email With your login details will be sent to your email address</p>
            <form id="aws-register-form" method="POST">
                @csrf
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Please enter your email address">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm">Create Account</button>
                </div>
            </form>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ __('An email has been sent with your account deatils.') }}
                </div>
            @endif
        </div>
        <div class="auth-footer">
        </div>
    </div>
@endsection
