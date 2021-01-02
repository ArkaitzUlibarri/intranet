@extends('layouts.app')

@if(isset($model))
@section('breadcrumbs', Breadcrumbs::render('projects.edit',$model))
@else
@section('breadcrumbs', Breadcrumbs::render('projects.create'))
@endif


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9 col-sm-12">

            @include('flash::message')

            <form action="{{ isset($model) ? route('projects.update',[$model->id]): route('projects.store') }}" method="post" autocomplete="off">
                @if(isset($model)) {{ method_field('PUT') }} @endif
                {{ csrf_field() }}

                <div class="card">

                    <div class="card-header">
                        <h2 class="float-left">
                            <i class="{{ App\Models\Project::ICON }}"></i>
                        </h2>
                    </div>

                    <div class="card-body">

                        <div class="form-group row {{ $errors->has('name') ? 'is-invalid' : '' }}">
                            <label class="col-md-3 col-form-label" for="name">@lang('projects.name') *</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name',isset($model) ? $model->name : null) }}"  required @if($errors->has('name')) autofocus @endif>
                                @if ($errors->has('name'))
                                <em class="text-danger">{!! $errors->first('name') !!}</em>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('description') ? 'is-invalid' : '' }}">
                            <label class="col-md-3 col-form-label" for="description">@lang('projects.description') *</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="description" id="description" required @if($errors->has('description')) autofocus @endif>{{ old('description',isset($model) ? $model->description : null) }}</textarea>
                                @if ($errors->has('description'))
                                <em class="text-danger">{!! $errors->first('description') !!}</em>
                                @endif
                            </div>
                        </div>

                        @if(isset($clients))
                            <div class="form-group row {{ $errors->has('client_id') ? 'is-invalid' : '' }}">
                                <label class="col-md-3 col-form-label" for="client_id">@lang('projects.client') *</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="client_id" id="client_id" required @if($errors->has('client_id')) autofocus @endif>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('client_id'))
                                    <em class="text-danger">{!! $errors->first('client_id') !!}</em>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="start_date">@lang('projects.start_date') *</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }}" name="start_date" id="start_date" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" required value="{{ old('start_date',isset($model) ? $model->start_date : null) }}" @if($errors->has('start_date')) autofocus @endif>
                                </div>
                                @if ($errors->has('start_date'))
                                <em class="text-danger">{!! $errors->first('start_date') !!}</em>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="end_date">@lang('projects.end_date')</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="datetime" class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}" name="end_date" id="end_date" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" value="{{ old('end_date',isset($model) ? $model->end_date : null) }}" @if($errors->has('end_date')) autofocus @endif>
                                </div>
                                @if ($errors->has('end_date'))
                                    <em class="text-danger">{!! $errors->first('end_date') !!}</em>
                                @endif
                            </div>
                        </div>

                        @if(isset($managers))
                            <div class="form-group row {{ $errors->has('manager_id') ? 'is-invalid' : '' }}">
                                <label class="col-md-3 col-form-label" for="client_id">@lang('projects.manager') *</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="manager_id" id="manager_id" required @if($errors->has('manager_id')) autofocus @endif>
                                        @foreach($managers as $manager)
                                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('manager_id'))
                                    <em class="text-danger">{!! $errors->first('manager_id') !!}</em>
                                    @endif
                                </div>
                            </div>
                        @endif

                    </div>

                    <div class="card-footer">
                        <a class="btn btn-secondary" href="{{ URL::previous() }}">
                            <i class="fa fa-times mr-1"></i> @lang('buttons.cancel')
                        </a>
                        <button class="btn btn-primary" type="submit" title="{{ trans('buttons.save') }}">
                            <i class="fa fa-save mr-1"></i> @lang('buttons.save')
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>

@endsection
