<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laracasts\Flash\Flash;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryDataTable $dataTable)
    {
        $authUser = Auth::user();

        Log::info('CategoryController@index', ['user_id' => $authUser->id]);

        if ($authUser->cannot('viewAny', Category::class))
            abort(403);

        return $dataTable->render('categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authUser = Auth::user();

        Log::info('CategoryController@create', ['user_id' => $authUser->id]);

        if ($authUser->cannot('create', Category::class))
            abort(403);

        return view('categories.form');
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

        Log::info('CategoryController@store', ['user_id' => $authUser->id, 'request' => $request->all()]);

        if ($authUser->cannot('create', Category::class))
            abort(403);

        $this->validate($request, Category::$rules);

        $model = Category::create($request->only(array_keys(Category::$rules)));

        Flash::success(trans('messages.saved'));
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $authUser = Auth::user();

        Log::info('CategoryController@show', ['user_id' => $authUser->id]);

        $model = Category::withTrashed()
            ->find($category->id);

        if (!$model)
            abort(404);

        if ($authUser->cannot('view', $model))
            abort(403);

        return view('categories.show', ['model' => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $authUser = Auth::user();

        Log::info('CategoryController@edit', ['user_id' => $authUser->id]);

        $model = Category::find($category->id);

        if (!$model)
            abort(404);

        if ($authUser->cannot('update', $model))
            abort(403);

        return view('categories.form', ['model' => $model]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $authUser = Auth::user();

        Log::info('CategoryController@update', ['user_id' => $authUser->id, 'request' => $request->all()]);

        $model = Category::find($category->id);

        if (!$model)
            abort(404);

        if ($authUser->cannot('update', $model))
            abort(403);

        $this->validate($request, Category::$rules);

        $model->update($request->only(array_keys(Category::$rules)));

        Flash::success(trans('messages.updated'));
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $authUser = Auth::user();

        Log::info('CategoryController@destroy', ['user_id' => $authUser->id]);

        $model = Category::find($category->id);

        if (!$model)
            abort(404);

        if ($authUser->cannot('delete', $model))
            abort(403);

        $model->delete();

        Flash::success(trans('messages.deleted'));
        return redirect()->route('categories.index');
    }
}
