<?php

namespace App\DataTables;

use App\Models\Project;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProjectDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('client.name', function (Project $model) {
                return isset($model->client) ? $model->client->name : null;
            })
            ->editColumn('manager.name', function (Project $model) {
                return isset($model->manager) ? $model->manager->name : null;
            })
            ->editColumn('created_at', function (Project $model) {
                return $model->created_at;
            })
            ->editColumn('updated_at', function (Project $model) {
                return $model->updated_at;
            })
            ->editColumn('deleted_at', function (Project $model) {
                return $model->deleted_at;
            })
            ->addColumn('action', 'projects.action')
            ->setRowClass(function (Project $model) {
                return $model->trashed() ? 'alert-danger' : '';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Project $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Project $model)
    {
        return $model->newQuery()
            ->with('client')
            ->with('manager')
            ->withTrashed();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
//            ->setTableId('project-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1, 'asc')
            ->scrollX(true)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title(trans('common.id')),
            Column::make('name')->title(trans('projects.name')),
            Column::make('description')->title(trans('projects.description')),
            Column::make('client.name')->title(trans('projects.client')),
            Column::make('start_date')->title(trans('projects.start_date')),
            Column::make('end_date')->title(trans('projects.end_date')),
            Column::make('manager.name')->title(trans('projects.manager')),
            Column::make('created_at'),
            Column::make('updated_at'),
//            Column::make('deleted_at')->title(trans('common.deleted_at')),
            Column::computed('action')
                ->title(trans('common.actions'))
                ->exportable(false)
                ->printable(false)
                ->width('15%')
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'projects_' . date('YmdHis');
    }
}
