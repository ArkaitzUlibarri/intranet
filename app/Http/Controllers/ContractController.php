<?php

namespace App\Http\Controllers;

use App\DataTables\ContractDataTable;
use App\Models\Contract;
use App\Models\ContractType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laracasts\Flash\Flash;

class ContractController extends Controller
{
    public function index(ContractDataTable $dataTable)
    {
        $authUser = Auth::user();

        Log::info('ContractController@index', ['user_id' => $authUser->id]);

        if ($authUser->cannot('viewAny', Contract::class))
            abort(403);

        return $dataTable->render('contracts.index');
    }

    public function show($id)
    {
        $authUser = Auth::user();

        Log::info('ContractController@show', ['user_id' => $authUser->id]);

        $model = Contract::withTrashed()
            ->with('user')
            ->with('contractType')
            ->find($id);

        if (!$model)
            abort(404);

        if ($authUser->cannot('view', $model))
            abort(403);

        return view('contracts.show', ['model' => $model]);
    }

    public function edit($id)
    {
        $authUser = Auth::user();

        Log::info('ContractController@edit', ['user_id' => $authUser->id]);

        $model = Contract::with('user', 'contractType')
            ->find($id);

        if (!$model)
            abort(404);

        if ($authUser->cannot('update', $model))
            abort(403);

        $contractTypes = ContractType::orderBy('code', 'asc')->orderBy('name', 'asc')->get();
        $users = User::orderBy('name', 'asc')->get();

        return view('contracts.form', ['model' => $model, 'contractTypes' => $contractTypes, 'users' => $users]);
    }

    public function update($id, Request $request)
    {
        $authUser = Auth::user();

        Log::info('ContractController@update', ['user_id' => $authUser->id, 'request' => $request->all()]);

        $model = Contract::find($id);

        if (!$model)
            abort(404);

        if ($authUser->cannot('update', $model))
            abort(403);

        $this->validate($request, Contract::$rules);

        $model->update($request->only(array_keys(Contract::$rules)));

        Flash::success(trans('messages.updated'));
        return redirect()->route('contracts.index');
    }

    public function create()
    {
        $authUser = Auth::user();

        Log::info('ContractController@create', ['user_id' => $authUser->id]);

        if ($authUser->cannot('create', Contract::class))
            abort(403);

        $contractTypes = ContractType::orderBy('code', 'asc')->orderBy('name', 'asc')->get();
        $users = User::orderBy('name', 'asc')->get();

        return view('contracts.form', ['contractTypes' => $contractTypes, 'users' => $users]);
    }

    public function store(Request $request)
    {
        $authUser = Auth::user();

        Log::info('ContractController@store', ['user_id' => $authUser->id, 'request' => $request->all()]);

        if ($authUser->cannot('create', Contract::class))
            abort(403);

        $this->validate($request, Contract::$rules);

        $model = Contract::create($request->only(array_keys(Contract::$rules)));

        Flash::success(trans('messages.saved'));
        return redirect()->route('contracts.index');
    }

    public function destroy($id)
    {
        $authUser = Auth::user();

        Log::info('ContractController@destroy', ['user_id' => $authUser->id]);

        $model = Contract::find($id);

        if (!$model)
            abort(404);

        if ($authUser->cannot('delete', $model))
            abort(403);

        $model->delete();

        Flash::success(trans('messages.deleted'));
        return redirect()->route('contracts.index');
    }
}
