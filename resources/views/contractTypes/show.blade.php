@extends('adminlte::page')

@section('breadcrumbs',Breadcrumbs::render('contractTypes.show', $model) )

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-sm-12">

            @include('flash::message')

            <div class="card">
                <div class="card-header">
                    <h2 class="float-left">
                        <i class="{{ App\Models\ContractType::ICON }}"></i> {{ $model->code }} - {{ $model->name }}
                    </h2>
                    <a href="{{ route('contractTypes.edit', $model->id) }}" class="btn btn-primary float-right m-0" title="{{ trans('buttons.edit') }}">
                        <i class="fa fa-edit"></i> @lang('buttons.edit')
                    </a>
                </div>

                <div class="card-body">
                    <dl class="row">
                        <dd class="col-sm-4">@lang('contractTypes.code'):</dd>
                        <dd class="col-sm-8">{{ $model->code }}</dd>
                        <dd class="col-sm-4">@lang('contractTypes.name'):</dd>
                        <dd class="col-sm-8">{{ $model->name }}</dd>
                        <dd class="col-sm-4">@lang('contractTypes.working_day'):</dd>
                        <dd class="col-sm-8">{{ $model->working_day }}</dd>
                        <dd class="col-sm-4">@lang('contractTypes.characteristic_1'):</dd>
                        <dd class="col-sm-8">{{ $model->characteristic_1 }}</dd>
                        <dd class="col-sm-4">@lang('contractTypes.characteristic_2'):</dd>
                        <dd class="col-sm-8">{{ $model->characteristic_2 }}</dd>
                        <dd class="col-sm-4">@lang('contractTypes.holidays'):</dd>
                        <dd class="col-sm-8">{{ $model->holidays }}</dd>
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
