@extends('layouts.app')

@if(isset($model))
@section('breadcrumbs', Breadcrumbs::render('categories.edit',$model))
@else
@section('breadcrumbs', Breadcrumbs::render('categories.create'))
@endif


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-sm-12">

            @include('flash::message')

            <form action="{{ isset($model) ? route('categories.update',[$model->id]): route('categories.store') }}" method="post" autocomplete="off">
                @if(isset($model)) {{ method_field('PUT') }} @endif
                {{ csrf_field() }}

                <div class="card">

                    <div class="card-header">
                        <h2 class="float-left">
                            <i class="{{ \App\Models\Category::ICON }}"></i>
                        </h2>
                    </div>

                    <div class="card-body">

                        <div class="form-group row {{ $errors->has('name') ? 'is-invalid' : '' }}">
                            <label class="col-md-3 col-form-label" for="name">@lang('categories.name') *</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name',isset($model) ? $model->name : null) }}"  required @if($errors->has('name')) autofocus @endif>
                                @if ($errors->has('name'))
                                <em class="text-danger">{!! $errors->first('name') !!}</em>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('code') ? 'is-invalid' : '' }}">
                            <label class="col-md-3 col-form-label" for="code">@lang('categories.code') *</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="code" id="code"  maxlength="3" value="{{ old('code',isset($model) ? $model->code : null) }}"  required @if($errors->has('code')) autofocus @endif>
                                @if ($errors->has('code'))
                                <em class="text-danger">{!! $errors->first('code') !!}</em>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('description') ? 'is-invalid' : '' }}">
                            <label class="col-md-3 col-form-label" for="description">@lang('categories.description') *</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="description" id="description" required @if($errors->has('description')) autofocus @endif>{{ old('description',isset($model) ? $model->description : null) }}</textarea>
                                @if ($errors->has('description'))
                                <em class="text-danger">{!! $errors->first('description') !!}</em>
                                @endif
                            </div>
                        </div>

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
