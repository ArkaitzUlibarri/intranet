<?php

namespace App\Http\Controllers;

use App\DataTables\ContractTypeDataTable;
use App\Models\ContractType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laracasts\Flash\Flash;

class ContractTypeController extends Controller
{
    public function index(ContractTypeDataTable $dataTable)
    {
        $authUser = Auth::user();

        Log::info('ContractTypeController@index', ['user_id' => $authUser->id]);

        if ($authUser->cannot('viewAny', ContractType::class))
            abort(403);

        return $dataTable->render('contractTypes.index');
    }

    public function show($id)
    {
        $authUser = Auth::user();

        Log::info('ContractTypeController@show', ['user_id' => $authUser->id]);

        $model = ContractType::withTrashed()->find($id);

        if (!$model)
            abort(404);

        if ($authUser->cannot('view', $model))
            abort(403);

        return view('contractTypes.show', ['model' => $model]);
    }

    public function edit($id)
    {
        $authUser = Auth::user();

        Log::info('ContractTypeController@edit', ['user_id' => $authUser->id]);

        $model = ContractType::find($id);

        if (!$model)
            abort(404);

        if ($authUser->cannot('update', $model))
            abort(403);

        return view('contractTypes.form', ['model' => $model]);
    }

    public function update($id, Request $request)
    {
        $authUser = Auth::user();

        Log::info('ContractTypeController@update', ['user_id' => $authUser->id, 'request' => $request->all()]);

        $model = ContractType::find($id);

        if (!$model)
            abort(404);

        if ($authUser->cannot('update', $model))
            abort(403);

        $this->validate($request, ContractType::$rules);

        $model->update($request->only(array_keys(ContractType::$rules)));

        Flash::success(trans('messages.updated'));
        return redirect()->route('contractTypes.index');
    }

    public function create()
    {
        $authUser = Auth::user();

        Log::info('ContractTypeController@create', ['user_id' => $authUser->id]);

        if ($authUser->cannot('create', ContractType::class))
            abort(403);

        return view('contractTypes.form');
    }

    public function store(Request $request)
    {
        $authUser = Auth::user();

        Log::info('ContractTypeController@store', ['user_id' => $authUser->id, 'request' => $request->all()]);

        if ($authUser->cannot('create', ContractType::class))
            abort(403);

        $this->validate($request, ContractType::$rules);

        $model = ContractType::create($request->only(array_keys(ContractType::$rules)));

        Flash::success(trans('messages.saved'));
        return redirect()->route('contractTypes.index');
    }

    public function destroy($id)
    {
        $authUser = Auth::user();

        Log::info('ContractTypeController@destroy', ['user_id' => $authUser->id]);

        $model = ContractType::find($id);

        if (!$model)
            abort(404);

        if ($authUser->cannot('delete', $model))
            abort(403);

        $model->delete();

        Flash::success(trans('messages.deleted'));
        return redirect()->route('contractTypes.index');
    }
}
