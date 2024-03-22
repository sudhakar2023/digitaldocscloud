@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.final.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-flag-checkered fa-fw" aria-hidden="true"></i>
    {{ trans('installer_messages.final.title') }}
@endsection

@section('container')

    <p>
        <strong class="text-danger "> Super Admin Login Details :</strong> <br>
        <strong class="text-danger"> Email : </strong> <strong>superadmin@gmail.com</strong> <br>
        <strong class="text-danger"> Password : </strong><strong> 123456</strong>
    </p>

    <p>
        <strong class="text-danger"> Owner Login Details:</strong> <br>
        <strong class="text-danger"> Email : </strong> <strong>owner@gmail.com</strong> <br>
        <strong class="text-danger"> Password : </strong><strong> 123456</strong>
    </p>
    <p>
        <strong class="text-danger"> Manage Login Details:</strong> <br>
        <strong class="text-danger"> Email : </strong> <strong>manager@gmail.com</strong> <br>
        <strong class="text-danger"> Password : </strong><strong> 123456</strong>
    </p>
    <p>
        <strong class="text-danger"> Employee Login Details:</strong> <br>
        <strong class="text-danger"> Email : </strong> <strong>employee@gmail.com</strong> <br>
        <strong class="text-danger"> Password : </strong><strong> 123456</strong>
    </p>
    @if(session('message')['dbOutputLog'])
        <p><strong><small>{{ trans('installer_messages.final.migration') }}</small></strong></p>
        <pre><code>{{ session('message')['dbOutputLog'] }}</code></pre>
    @endif

    <p><strong><small>{{ trans('installer_messages.final.console') }}</small></strong></p>
    <pre><code>{{ $finalMessages }}</code></pre>

    <p><strong><small>{{ trans('installer_messages.final.log') }}</small></strong></p>
    <pre><code>{{ $finalStatusMessage }}</code></pre>

    <p><strong><small>{{ trans('installer_messages.final.env') }}</small></strong></p>
    <pre><code>{{ $finalEnvFile }}</code></pre>

    <div class="buttons">
        <a href="{{ url('/') }}" class="button">{{ trans('installer_messages.final.exit') }}</a>
    </div>

@endsection
