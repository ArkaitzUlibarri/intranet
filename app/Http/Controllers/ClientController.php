<?php

namespace App\Http\Controllers;

use App\DataTables\ClientDataTable;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laracasts\Flash\Flash;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ClientDataTable $dataTable)
    {
        $authUser = Auth::user();

        Log::info('ClientController@index', ['user_id' => $authUser->id]);

        if ($authUser->cannot('viewAny', Client::class))
            abort(403);

        return $dataTable->render('clients.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authUser = Auth::user();

        Log::info('ClientController@create', ['user_id' => $authUser->id]);

        if ($authUser->cannot('create', Client::class))
            abort(403);

        return view('clients.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $authUser = Auth::user();

        Log::info('ClientController@store', ['user_id' => $authUser->id, 'request' => $request->all()]);

        if ($authUser->cannot('create', Client::class))
            abort(403);

        $this->validate($request, Client::$rules);

        $model = Client::create($request->only(array_keys(Client::$rules)));

        Flash::success(trans('messages.saved'));
        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $authUser = Auth::user();

        Log::info('ClientController@show', ['user_id' => $authUser->id]);

        $model = Client::withTrashed()
            ->find($client->id);

        if (!$model)
            abort(404);

        if ($authUser->cannot('view', $model))
            abort(403);

        return view('clients.show', ['model' => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $authUser = Auth::user();

        Log::info('ClientController@edit', ['user_id' => $authUser->id]);

        $model = Client::find($client->id);

        if (!$model)
            abort(404);

        if ($authUser->cannot('update', $model))
            abort(403);

        return view('clients.form', ['model' => $model]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $authUser = Auth::user();

        Log::info('ClientController@update', ['user_id' => $authUser->id, 'request' => $request->all()]);

        $model = Client::find($client->id);

        if (!$model)
            abort(404);

        if ($authUser->cannot('update', $model))
            abort(403);

        $this->validate($request, Client::$rules);

        $model->update($request->only(array_keys(Client::$rules)));

        Flash::success(trans('messages.updated'));
        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $authUser = Auth::user();

        Log::info('ClientController@destroy', ['user_id' => $authUser->id]);

        $model = Client::find($client->id);

        if (!$model)
            abort(404);

        if ($authUser->cannot('delete', $model))
            abort(403);

        $model->delete();

        Flash::success(trans('messages.deleted'));
        return redirect()->route('clients.index');
    }
}
