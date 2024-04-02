@extends('layouts.app')
@section('page-title')
    {{__('Packages')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{__('Packages')}}</a>
        </li>
    </ul>
@endsection
@section('card-action-btn')
    @if(\Auth::user()->type=='super admin' &&  (env('STRIPE_PAYMENT') == 'on' ))
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="md"
           data-url="{{ route('subscriptions.create') }}"
           data-title="{{__('Create Package')}}"> <i class="ti-plus mr-5"></i>{{__('Create Package')}}</a>
    @endif
@endsection
@section('content')
    <div class="row">
        @foreach($subscriptions as $subscription)
            <div class="col-md-4">
                <div class="codex-pricingtbl">
                    <div class="price-header">
                        <h2>{{__($subscription->name)}}</h2>
                        <div class="price-value">{{env('CURRENCY_SYMBOL').$subscription->price}} / {{__($subscription->duration)}}
                        </div>
                    </div>
                    <ul class="cdxprice-list">
                        <li><span>{{$subscription->total_user - (Auth::user()->subscription == $subscription->id ? Auth::user()->user_usage : 0)}}</span>{{__('User Limit')}}</li>
                        <li><span>{{$subscription->total_document  - (Auth::user()->subscription == $subscription->id ? Auth::user()->document_usage : 0)}}</span>{{__('Document Limit')}}</li>
                        <li>
                            <div class="delet-mail">
                                @if($subscription->enabled_logged_history==1)
                                    <i class="text-success mr-4" data-feather="check-circle"></i>
                                @else
                                    <i class="text-danger mr-4" data-feather="x-circle"></i>
                                @endif
                                {{__('User History')}}
                            </div>
                        </li>
                        <li>
                            <div class="delet-mail">
                                @if($subscription->enabled_document_history==1)
                                    <i class="text-success mr-4" data-feather="check-circle"></i>
                                @else
                                    <i class="text-danger mr-4" data-feather="x-circle"></i>
                                @endif
                                {{__('Document History')}}
                            </div>
                        </li>
                        @if(\Auth::user()->type!='super admin' && \Auth::user()->subscription == $subscription->id)
                            <li>
                                <span>{{\Auth::user()->subscription_expire_date ? \Auth::user()->dateFormat(\Auth::user()->subscription_expire_date):__('Unlimited')}}</span>{{__('Expiry Date') }}
                            </li>
                        @endif
                    </ul>
                    @if(\Auth::user()->type=='admin' && \Auth::user()->subscription == $subscription->id)
                        <a href="#" class="badge badge-success">{{__('Active')}}</a>
                    @endif
                    @if(\Auth::user()->type=='admin' && \Auth::user()->subscription != $subscription->id && !(\Auth::user()->awsCustomer))
                        <a class="text-success" data-bs-toggle="tooltip" data-bs-original-title="{{__('Detail')}}"
                           href="{{route('subscriptions.show',\Illuminate\Support\Facades\Crypt::encrypt($subscription->id))}}"><i data-feather="shopping-cart"></i></a>
                    @elseif(\Auth::user()->awsCustomer)
                        <a class="text-success" data-bs-toggle="tooltip" data-bs-original-title="{{__('Detail')}}"
                           href="#">Billing By Aws</a>
                    @endif
                    @if(\Auth::user()->type=='super admin')
                        {!! Form::open(['method' => 'DELETE', 'route' => ['subscriptions.destroy', $subscription->id]]) !!}
                        <div class="date-info">
                            <a class="text-success customModal" data-bs-toggle="tooltip"
                               data-bs-original-title="{{__('Edit')}}" href="#"
                               data-url="{{ route('subscriptions.edit',$subscription->id) }}"
                               data-title="{{__('Edit Package')}}"> <i data-feather="edit"></i></a>
                            <a class=" text-danger confirm_dialog" data-bs-toggle="tooltip"
                               data-bs-original-title="{{__('Detete')}}" href="#"> <i data-feather="trash-2"></i></a>
                        </div>
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection

