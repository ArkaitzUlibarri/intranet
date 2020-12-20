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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ContractDataTable $dataTable)
    {
        $authUser = Auth::user();

        Log::info('ContractController@index', ['user_id' => $authUser->id]);

        if ($authUser->cannot('viewAny', Contract::class))
            abort(403);

        return $dataTable->render('contracts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract  $contract)
    {
        $authUser = Auth::user();

        Log::info('ContractController@show', ['user_id' => $authUser->id]);

        $model = Contract::withTrashed()
            ->with('user')
            ->with('contractType')
            ->find($contract->id);

        if (!$model)
            abort(404);

        if ($authUser->cannot('view', $model))
            abort(403);

        return view('contracts.show', ['model' => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract  $contract)
    {
        $authUser = Auth::user();

        Log::info('ContractController@edit', ['user_id' => $authUser->id]);

        $model = Contract::with('user', 'contractType')
            ->find($contract->id);

        if (!$model)
            abort(404);

        if ($authUser->cannot('update', $model))
            abort(403);

        $contractTypes = ContractType::orderBy('code', 'asc')->orderBy('name', 'asc')->get();
        $users = User::orderBy('name', 'asc')->get();

        return view('contracts.form', ['model' => $model, 'contractTypes' => $contractTypes, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Contract  $contract, Request $request)
    {
        $authUser = Auth::user();

        Log::info('ContractController@update', ['user_id' => $authUser->id, 'request' => $request->all()]);

        $model = Contract::find($contract->id);

        if (!$model)
            abort(404);

        if ($authUser->cannot('update', $model))
            abort(403);

        $this->validate($request, Contract::$rules);

        $model->update($request->only(array_keys(Contract::$rules)));

        Flash::success(trans('messages.updated'));
        return redirect()->route('contracts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Contract $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        $authUser = Auth::user();

        Log::info('ContractController@destroy', ['user_id' => $authUser->id]);

        $model = Contract::find($contract->id);

        if (!$model)
            abort(404);

        if ($authUser->cannot('delete', $model))
            abort(403);

        $model->delete();

        Flash::success(trans('messages.deleted'));
        return redirect()->route('contracts.index');
    }
}
