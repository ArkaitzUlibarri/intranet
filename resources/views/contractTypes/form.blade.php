@extends('adminlte::page')

@if(isset($model))
@section('breadcrumbs', Breadcrumbs::render('contractTypes.edit',$model))
@else
@section('breadcrumbs', Breadcrumbs::render('contractTypes.create'))
@endif


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9 col-sm-12">

            @include('flash::message')

            <form action="{{ isset($model) ? route('contractTypes.update',[$model->id]): route('contractTypes.store') }}" method="post" autocomplete="off">
                @if(isset($model)) {{ method_field('PUT') }} @endif
                {{ csrf_field() }}

                <div class="card">

                    <div class="card-header">
                        <h2 class="float-left">
                            <i class="{{ App\Models\ContractType::ICON }}"></i>
                        </h2>
                    </div>

                    <div class="card-body">

                        <div class="form-group row {{ $errors->has('code') ? 'is-invalid' : '' }}">
                            <label class="col-md-4 col-form-label" for="code">@lang('contractTypes.code') *</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="code" maxlength="3" id="code" value="{{ old('code',isset($model) ? $model->code : null) }}"  required @if($errors->has('code')) autofocus @endif>
                                @if ($errors->has('code'))
                                <em class="text-danger">{!! $errors->first('code') !!}</em>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('name') ? 'is-invalid' : '' }}">
                            <label class="col-md-4 col-form-label" for="name">@lang('contractTypes.name') *</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name',isset($model) ? $model->name : null) }}"  required @if($errors->has('name')) autofocus @endif>
                                @if ($errors->has('name'))
                                <em class="text-danger">{!! $errors->first('name') !!}</em>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('working_day') ? 'is-invalid' : '' }}">
                            <label class="col-md-4 col-form-label" for="working_day">@lang('contractTypes.working_day') *</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="working_day" id="working_day" value="{{ old('working_day',isset($model) ? $model->working_day : null) }}"  required @if($errors->has('working_day')) autofocus @endif>
                                @if ($errors->has('working_day'))
                                <em class="text-danger">{!! $errors->first('working_day') !!}</em>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('characteristic_1') ? 'is-invalid' : '' }}">
                            <label class="col-md-4 col-form-label" for="characteristic_1">@lang('contractTypes.characteristic_1')</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="characteristic_1" id="characteristic_1" value="{{ old('characteristic_1',isset($model) ? $model->characteristic_1 : null) }}" @if($errors->has('characteristic_1')) autofocus @endif>
                                @if ($errors->has('characteristic_1'))
                                <em class="text-danger">{!! $errors->first('characteristic_1') !!}</em>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('characteristic_2') ? 'is-invalid' : '' }}">
                            <label class="col-md-4 col-form-label" for="characteristic_2">@lang('contractTypes.characteristic_2')</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="characteristic_2" id="characteristic_2" value="{{ old('characteristic_2',isset($model) ? $model->characteristic_2 : null) }}" @if($errors->has('characteristic_2')) autofocus @endif>
                                @if ($errors->has('characteristic_2'))
                                <em class="text-danger">{!! $errors->first('characteristic_2') !!}</em>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('holidays') ? 'is-invalid' : '' }}">
                            <label class="col-md-4 col-form-label" for="holidays">@lang('contractTypes.holidays')</label>
                            <div class="col-md-8">
                                <input type="number" class="form-control" name="holidays" id="holidays" value="{{ old('holidays',isset($model) ? $model->holidays : null) }}" @if($errors->has('holidays')) autofocus @endif>
                                @if ($errors->has('holidays'))
                                <em class="text-danger">{!! $errors->first('holidays') !!}</em>
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
