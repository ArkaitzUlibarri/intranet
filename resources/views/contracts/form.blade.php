@extends('adminlte::page')

@if(isset($model))
@section('breadcrumbs', Breadcrumbs::render('contracts.edit',$model))
@else
@section('breadcrumbs', Breadcrumbs::render('contracts.create'))
@endif


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9 col-sm-12">

            @include('flash::message')

            <form action="{{ isset($model) ? route('contracts.update',[$model->id]): route('contracts.store') }}" method="post" autocomplete="off">
                @if(isset($model)) {{ method_field('PUT') }} @endif
                {{ csrf_field() }}

                <div class="card">

                    <div class="card-header">
                        <h2 class="float-left">
                            <i class="{{ App\Models\Contract::ICON }}"></i>
                        </h2>
                    </div>

                    <div class="card-body">

                        @if(isset($users))
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="user_id">@lang('common.user') *</label>
                                <div class="col-md-8">
                                    <select class="form-control {{ $errors->has('user_id') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required @if($errors->has('user_id')) autofocus @endif>
                                        <option value="">@lang('common.select_option')</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" @if(old('user_id',isset($model) ? $model->user_id : null) == $user->id) selected @endif>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('user_id'))
                                    <em class="text-danger">{!! $errors->first('user_id') !!}</em>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if(isset($contractTypes))
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="contract_type_id">@lang('common.contractType') *</label>
                                <div class="col-md-8">
                                    <select class="form-control {{ $errors->has('contract_type_id') ? 'is-invalid' : '' }}" name="contract_type_id" id="contract_type_id" required @if($errors->has('contract_type_id')) autofocus @endif>
                                        <option value="">@lang('common.select_option')</option>
                                        @foreach($contractTypes as $contractType)
                                            <option value="{{ $contractType->id }}" @if(old('contract_type_id',isset($model) ? $model->contract_type_id : null) == $contractType->id) selected @endif>
                                                {{ $contractType->code }} - {{ $contractType->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('contract_type_id'))
                                        <em class="text-danger">{!! $errors->first('contract_type_id') !!}</em>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="start_date">@lang('contracts.start_date') *</label>
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
                            <label class="col-md-4 col-form-label" for="estimated_end_date">@lang('contracts.estimated_end_date')</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control {{ $errors->has('estimated_end_date') ? 'is-invalid' : '' }}" name="estimated_end_date" id="estimated_end_date" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" value="{{ old('estimated_end_date',isset($model) ? $model->estimated_end_date : null) }}" @if($errors->has('estimated_end_date')) autofocus @endif>
                                </div>
                                @if ($errors->has('estimated_end_date'))
                                    <em class="text-danger">{!! $errors->first('estimated_end_date') !!}</em>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="end_date">@lang('contracts.end_date')</label>
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

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="week_hours">@lang('contracts.week_hours') *</label>
                            <div class="col-md-8">
                                <input type="number" class="form-control {{ $errors->has('week_hours') ? 'is-invalid' : '' }}" name="week_hours" id="week_hours" required value="{{ old('week_hours',isset($model) ? $model->week_hours : null) }}" @if($errors->has('week_hours')) autofocus @endif>
                                @if ($errors->has('week_hours'))
                                <em class="text-danger">{!! $errors->first('week_hours') !!}</em>
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
