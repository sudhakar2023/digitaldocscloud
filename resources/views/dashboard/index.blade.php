@extends('layouts.app')
@section('page-title')
    {{__('Dashboard')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
    </ul>
@endsection
@php
    $settings=\App\Models\Custom::settings();
@endphp
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card sale-revenue">
                <div class="card-header">
                    <h4>{{__('Total User')}}</h4>
                    <i class="ti-user" style="font-size: x-large; color:F9BE4A;"></i>
                </div>
                <div class="card-body progressCounter">
                    <h2>
                        <span class="count">{{$data['totalUser']}}</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card sale-revenue">
                <div class="card-header">
                    <h4>{{__('Total Document')}}</h4>
                    <i class="ti-clipboard" style="font-size: x-large; color:#F9BE4A;"></i>
                </div>
                <div class="card-body progressCounter">
                    <h2>
                        <span class="count">{{$data['totalDocument']}}</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card sale-revenue">
                <div class="card-header">
                    <h4>{{__('Total Categories')}}</h4>
                    <i class="ti-list" style="font-size: x-large; color:#F9BE4A;"></i>
                </div>
                <div class="card-body progressCounter">
                    <h2>
                        <span class="count">{{$data['totalCategory']}}</span>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card sale-revenue">
                <div class="card-header">
                    <h4>{{__('Total Reminder')}}</h4>
                    <i class="ti-bell" style="font-size: x-large; color:#F9BE4A;"></i>
                </div>
                <div class="card-body progressCounter">
                    <h2>
                        <span class="count">{{$data['totalReminder']}}</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card sale-revenue">
                <div class="card-header">
                    <h4>{{__('Today Reminder')}}</h4>
                    <i class="ti-calendar" style="font-size: x-large; color:#F9BE4A;"></i>
                </div>
                <div class="card-body progressCounter">
                    <h2>
                        <span class="count">{{$data['todayReminder']}}</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card sale-revenue">
                <div class="card-header">
                    <h4>{{__('Total Support')}}</h4>
                    <i class="ti-headphone" style="font-size: x-large; color:#F9BE4A;"></i>
                </div>
                <div class="card-body progressCounter">
                    <h2>
                        <span class="count">{{$data['totalSupport']}}</span>
                    </h2>
                </div>
            </div>
        </div>
    </div>    
    </div>
    <div class="row">
        <div class="col-xxl-12 cdx-xxl-50">
            <div class="card overall-revenuetbl">
                <div class="card-header">
                    <h4>{{__('Document By Category')}}</h4>
                </div>
                <div class="card-body">
                    <div id="document_by_cat"></div>
                </div>
            </div>
        </div>
        <div class="col-xxl-12 cdx-xxl-50">
            <div class="card overall-revenuetbl">
                <div class="card-header">
                    <h4>{{__('Document By Sub Category')}}</h4>
                </div>
                <div class="card-body">
                    <div id="document_by_subcat"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-page')
    <script>
        var documentByCategoryData={!! json_encode($data['documentByCategory']['data']) !!};
        var documentByCategory= {!! json_encode($data['documentByCategory']['category']) !!};
        var documentBySubCategoryData= {!! json_encode($data['documentBySubCategory']['data']) !!};
        var documentBySubCategory= {!! json_encode($data['documentBySubCategory']['category']) !!};
    </script>

    <script src="{{ asset('js/custom/dashboard.js') }}"></script>

@endpush
