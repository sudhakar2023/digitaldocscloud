@extends('layouts.app')
@section('page-title')
    {{__('Document')}}
@endsection

@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{__('Document')}}</a>
        </li>
    </ul>
@endsection
@section('card-action-btn')
    @if(Gate::check('create my document'))
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="md"
           data-url="{{ route('document.create') }}"
           data-title="{{__('Create Document')}}"> <i class="ti-plus mr-5"></i>{{__('Create Document')}}</a>
    @endif
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="display dataTable cell-border datatbl-advance">
                        <thead>
                        <tr>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Category')}}</th>
                            <th>{{__('Sub Category')}}</th>
                            <th>{{__('Tags')}}</th>
                            <th>{{__('Created By')}}</th>
                            <th>{{__('Created At')}}</th>
                            <th>{{__('Expired At')}}</th>
                            @if(Gate::check('edit my document') ||  Gate::check('delete my document') || Gate::check('show my document'))
                                <th class="text-right">{{__('Action')}}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($documents as $document)
                            <tr role="row">
                                <td>{{$document->name}}</td>
                                <td>
                                    {{ !empty($document->category)?$document->category->title:'-' }}
                                </td>
                                <td>
                                    {{ !empty($document->subCategory)?$document->subCategory->title:'-' }}
                                </td>
                                <td>
                                   @foreach($document->tags() as $tag)
                                       {{$tag->title}} <br>
                                   @endforeach
                                </td>
                                <td>{{!empty($document->createdBy)?$document->createdBy->name:''}}</td>
                                <td>{{\Auth::user()->dateFormat($document->created_at)}}</td>
                                <td>{{\Auth::user()->dateFormat($document->created_at)}}</td>
                                @if(Gate::check('edit my document') ||  Gate::check('delete my document') ||  Gate::check('show my document'))
                                    <td class="text-right">
                                        <div class="cart-action">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['document.destroy', $document->id]]) !!}
                                            @if(Gate::check('show my document'))
                                                <a class="text-warning" data-bs-toggle="tooltip"
                                                   data-bs-original-title="{{__('Show Details')}}" href="{{ route('document.show',\Illuminate\Support\Facades\Crypt::encrypt($document->id)) }}" > <i data-feather="eye"></i></a>
                                            @endcan
                                            @if(Gate::check('edit my document'))
                                                <a class="text-success customModal" data-bs-toggle="tooltip"
                                                   data-bs-original-title="{{__('Edit')}}" href="#"
                                                   data-url="{{ route('document.edit',$document->id) }}"
                                                   data-title="{{__('Edit Support')}}"> <i data-feather="edit"></i></a>
                                            @endcan
                                            @if( Gate::check('delete my document'))
                                                <a class=" text-danger confirm_dialog" data-bs-toggle="tooltip"
                                                   data-bs-original-title="{{__('Detete')}}" href="#"> <i
                                                        data-feather="trash-2"></i></a>
                                            @endcan
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

