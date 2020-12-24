@extends('layouts.app')

@section('breadcrumbs',Breadcrumbs::render('clients.show', $model) )

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-sm-12">

            @include('flash::message')

            <div class="card">
                <div class="card-header">
                    <h2 class="float-left">
                        <i class="{{ App\Models\Client::ICON }}"></i> {{ $model->name }}
                    </h2>
                    @if(Auth::user()->can('update', $model))
                        <a href="{{ route('clients.edit', $model->id) }}" class="btn btn-primary float-right m-0" title="{{ trans('buttons.edit') }}">
                            <i class="fa fa-edit"></i> @lang('buttons.edit')
                        </a>
                    @endif
                </div>

                <div class="card-body">
                    <dl class="row">
                        <dd class="col-sm-4">@lang('clients.name'):</dd>
                        <dd class="col-sm-8">{{ $model->name }}</dd>
                        <dd class="col-sm-4">@lang('clients.description'):</dd>
                        <dd class="col-sm-8">{{ $model->description }}</dd>
                        <dd class="col-sm-4">@lang('common.created_at'):</dd>
                        <dd class="col-sm-8">{{ $model->created_at }}</dd>
                        <dd class="col-sm-4">@lang('common.updated_at'):</dd>
                        <dd class="col-sm-8">{{ $model->updated_at }}</dd>
                        @if($model->trashed())
                        <dd class="col-sm-4 text-danger">@lang('common.deleted_at'):</dd>
                        <dd class="col-sm-8 text-danger">{{ $model->deleted_at }}</dd>
                        @endif
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
