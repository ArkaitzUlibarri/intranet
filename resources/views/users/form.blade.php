@extends('adminlte::page')

@if(isset($user))
@section('breadcrumbs', Breadcrumbs::render('users.edit',$user))
@else
@section('breadcrumbs', Breadcrumbs::render('users.create'))
@endif


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-sm-12">

            @include('flash::message')

            <form action="{{ isset($user) ? route('users.update',[$user->id]): route('users.store') }}" method="post" autocomplete="off">
                @if(isset($user)) {{ method_field('PUT') }} @endif
                {{ csrf_field() }}

                <div class="card">

                    <div class="card-header">
                        <h2 class="float-left">
                            <i class="{{ \App\Models\User::ICON }}"></i> @lang('common.new_user')
                        </h2>
                    </div>

                    <div class="card-body">

                        <div class="form-group row {{ $errors->has('name') ? 'is-invalid' : '' }}">
                            <label class="col-md-3 col-form-label" for="name">@lang('common.name') *</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name',isset($user) ? $user->name : null) }}"  required @if($errors->has('name')) autofocus @endif>
                                @if ($errors->has('name'))
                                <em class="text-danger">{!! $errors->first('name') !!}</em>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('email') ? 'is-invalid' : '' }}">
                            <label class="col-md-3 col-form-label" for="email"><i class="fa fa-envelope"></i> @lang('common.email') *</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" name="email" id="email" value="{{ old('email',isset($user) ? $user->email : null) }}"  required @if($errors->has('email')) autofocus @endif>
                                @if ($errors->has('email'))
                                <em class="text-danger">{!! $errors->first('email') !!}</em>
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
