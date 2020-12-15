@extends('layouts.app')

@section('breadcrumbs',Breadcrumbs::render('users.show', $user) )

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-sm-12">

            @include('flash::message')

            <div class="card">
                <div class="card-header">
                    <h2 class="float-left">
                        <i class="{{ \App\Models\User::ICON }}"></i> {{ $user->name }}
                    </h2>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary float-right m-0" title="{{ trans('buttons.edit') }}">
                        <i class="fa fa-edit"></i> @lang('buttons.edit')
                    </a>
                </div>

                <div class="card-body">
                    <dl class="row">
                        <dd class="col-sm-4">@lang('common.name'):</dd>
                        <dd class="col-sm-8">{{ $user->name }}</dd>
                        <dd class="col-sm-4"><i class="fa fa-envelope"></i> @lang('common.email'):</dd>
                        <dd class="col-sm-8">{{ $user->email }}</dd>
                        <dd class="col-sm-4">@lang('common.last_login'):</dd>
                        <dd class="col-sm-8">{{ $user->last_login ? $user->last_login : '-' }}</dd>
                        <dd class="col-sm-4">@lang('common.created_at'):</dd>
                        <dd class="col-sm-8">{{ $user->created_at }}</dd>
                        <dd class="col-sm-4">@lang('common.updated_at'):</dd>
                        <dd class="col-sm-8">{{ $user->updated_at }}</dd>
                        @if($user->trashed())
                        <dd class="col-sm-4 text-danger">@lang('common.deleted_at'):</dd>
                        <dd class="col-sm-8 text-danger">{{ $user->deleted_at }}</dd>
                        @endif
                    </dl>

                    <button class="btn collapsed" data-toggle="collapse" data-target="#collapseSessions" aria-expanded="false" aria-controls="collapseSessions">
                        <i class="fa fa-plus-circle"></i> @lang('common.sessions') ({{ $user->sessions->count() }})
                    </button>

                    <div id="collapseSessions" class="collapse mt-3" aria-labelledby="headingTwo" data-parent="#accordion">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>IP</th>
                                <th>Login</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->sessions as $session)
                            <tr>
                                <td>{{ $session->ip_address }}</td>
                                <td>{{ $session->last_activity }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
