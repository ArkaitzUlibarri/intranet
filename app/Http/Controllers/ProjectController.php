<?php

namespace App\Http\Controllers;

use App\DataTables\ProjectDataTable;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laracasts\Flash\Flash;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectDataTable $dataTable)
    {
        $authUser = Auth::user();

        Log::info('ProjectController@index', ['user_id' => $authUser->id]);

        if ($authUser->cannot('viewAny', Project::class))
            abort(403);

        return $dataTable->render('projects.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authUser = Auth::user();

        Log::info('ProjectController@create', ['user_id' => $authUser->id]);

        if ($authUser->cannot('create', Project::class))
            abort(403);

        $clients = Client::all();
        $managers = User::all();//FIXME:PROVISIONAL

        return view('projects.form', ['clients' => $clients, 'managers' => $managers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $authUser = Auth::user();

        Log::info('ProjectController@store', ['user_id' => $authUser->id, 'request' => $request->all()]);

        if ($authUser->cannot('create', Project::class))
            abort(403);

        $this->validate($request, Project::$rules);

        $model = Project::create($request->only(array_keys(Project::$rules)));

        Flash::success(trans('messages.saved'));
        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $authUser = Auth::user();

        Log::info('ProjectController@show', ['user_id' => $authUser->id]);

        $model = Project::withTrashed()
            ->with('manager')
            ->with('client')
            ->find($project->id);

        if (!$model)
            abort(404);

        if ($authUser->cannot('view', $model))
            abort(403);

        return view('projects.show', ['model' => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $authUser = Auth::user();

        Log::info('ProjectController@edit', ['user_id' => $authUser->id]);

        $model = Project::with('manager')
            ->with('client')
            ->find($project->id);

        if (!$model)
            abort(404);

        if ($authUser->cannot('update', $model))
            abort(403);

        $clients = Client::all();
        $managers = User::all();//FIXME:PROVISIONAL

        return view('projects.form', ['model' => $model, 'clients' => $clients, 'managers' => $managers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $authUser = Auth::user();

        Log::info('ProjectController@update', ['user_id' => $authUser->id, 'request' => $request->all()]);

        $model = Project::find($project->id);

        if (!$model)
            abort(404);

        if ($authUser->cannot('update', $model))
            abort(403);

        $this->validate($request, Project::$rules);

        $model->update($request->only(array_keys(Project::$rules)));

        Flash::success(trans('messages.updated'));
        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $authUser = Auth::user();

        Log::info('ProjectController@destroy', ['user_id' => $authUser->id]);

        $model = Project::find($project->id);

        if (!$model)
            abort(404);

        if ($authUser->cannot('delete', $model))
            abort(403);

        $model->delete();

        Flash::success(trans('messages.deleted'));
        return redirect()->route('projects.index');
    }
}
