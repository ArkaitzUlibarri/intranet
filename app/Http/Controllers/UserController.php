<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laracasts\Flash\Flash;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        $authUser = Auth::user();

        Log::info('UserController@index', ['user_id' => $authUser->id]);

        if ($authUser->cannot('viewAny', User::class))
            abort(403);

        return $dataTable->render('users.index');
    }

    public function show($id)
    {
        $authUser = Auth::user();

        Log::info('UserController@show', ['user_id' => $authUser->id]);

        $user = User::withTrashed()->with('sessions')->find($id);

        if (!$user)
            abort(404);

        if ($authUser->cannot('view', $user))
            abort(403);

        return view('users.show', ['user' => $user]);
    }

    public function edit($id)
    {
        $authUser = Auth::user();

        Log::info('UserController@edit', ['user_id' => $authUser->id]);

        $user = User::find($id);

        if (!$user)
            abort(404);

        if ($authUser->cannot('update', $user))
            abort(403);

        return view('users.form', ['user' => $user]);
    }

    public function update($id, Request $request)
    {
        $authUser = Auth::user();

        Log::info('UserController@update', ['user_id' => $authUser->id, 'request' => $request->all()]);

        $user = User::find($id);

        if (!$user)
            abort(404);

        if ($authUser->cannot('update', $user))
            abort(403);

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id . '|max:255',
        ]);

        $parameters = $request->only(array_keys(User::$rules));

        $user->update($parameters);

        Flash::success(trans('messages.updated'));
        return redirect()->route('users.index');
    }

    public function create()
    {
        $authUser = Auth::user();

        Log::info('UserController@create', ['user_id' => $authUser->id]);

        if ($authUser->cannot('create', User::class))
            abort(403);

        return view('users.form');
    }

    public function store(Request $request)
    {
        $authUser = Auth::user();

        Log::info('UserController@store', ['user_id' => $authUser->id, 'request' => $request->all()]);

        if ($authUser->cannot('create', User::class))
            abort(403);

        $this->validate($request, User::$rules);

        $parameters = $request->only(array_keys(User::$rules));

        $user = User::create([
            'name' => $parameters['name'],
            'email' => $parameters['email'],
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        Flash::success(trans('messages.saved'));
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $authUser = Auth::user();

        Log::info('UserController@destroy', ['user_id' => $authUser->id]);

        $user = User::find($id);

        if (!$user)
            abort(404);

        if ($authUser->cannot('delete', $user))
            abort(403);

        $user->delete();

        Flash::success(trans('messages.deleted'));
        return redirect()->route('users.index');
    }
}
