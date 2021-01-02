<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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
            ->editColumn('email_verified_at', function (User $model) {
                return $model->email_verified_at;
            })
            ->editColumn('created_at', function (User $model) {
                return $model->created_at;
            })
            ->editColumn('updated_at', function (User $model) {
                return $model->updated_at;
            })
            ->editColumn('deleted_at', function (User $model) {
                return $model->deleted_at;
            })
            ->addColumn('action', 'users.action')
            ->setRowClass(function (User $model) {
                return $model->trashed() ? 'alert-danger' : '';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->withTrashed();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
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
            Column::make('name')->title(trans('common.name')),
            Column::make('email')->title(trans('common.email')),
            Column::make('email_verified_at')->title(trans('common.email_verified_at')),
            Column::make('created_at')->title(trans('common.created_at')),
            Column::make('updated_at')->title(trans('common.updated_at')),
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
        return 'users_' . date('YmdHis');
    }
}
