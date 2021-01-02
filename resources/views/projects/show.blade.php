@extends('layouts.app')

@section('breadcrumbs',Breadcrumbs::render('projects.show', $model) )

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-sm-12">

            @include('flash::message')

            <div class="card">
                <div class="card-header">
                    <h2 class="float-left">
                        <i class="{{ App\Models\Project::ICON }}"></i> {{ $model->name }}
                    </h2>
                    <a href="{{ route('projects.edit', $model->id) }}" class="btn btn-primary float-right m-0" title="{{ trans('buttons.edit') }}">
                        <i class="fa fa-edit"></i> @lang('buttons.edit')
                    </a>
                </div>

                <div class="card-body">
                    <dl class="row">
                        <dd class="col-sm-6">@lang('projects.name'):</dd>
                        <dd class="col-sm-6">{{ $model->name }}</dd>
                        <dd class="col-sm-6">@lang('projects.description'):</dd>
                        <dd class="col-sm-6">{{ $model->description }}</dd>
                        <dd class="col-sm-6">@lang('projects.client'):</dd>
                        <dd class="col-sm-6">{{ $model->client->name }}</dd>
                        <dd class="col-sm-6">@lang('projects.start_date'):</dd>
                        <dd class="col-sm-6">{{ $model->start_date }}</dd>
                        <dd class="col-sm-6">@lang('projects.end_date'):</dd>
                        <dd class="col-sm-6">{{ $model->end_date }}</dd>
                        <dd class="col-sm-6">@lang('projects.manager'):</dd>
                        <dd class="col-sm-6">{{ $model->manager->name }}</dd>
                        <dd class="col-sm-6">@lang('common.created_at'):</dd>
                        <dd class="col-sm-6">{{ $model->created_at }}</dd>
                        <dd class="col-sm-6">@lang('common.updated_at'):</dd>
                        <dd class="col-sm-6">{{ $model->updated_at }}</dd>
                        @if($model->trashed())
                        <dd class="col-sm-6 text-danger">@lang('common.deleted_at'):</dd>
                        <dd class="col-sm-6 text-danger">{{ $model->deleted_at }}</dd>
                        @endif
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
