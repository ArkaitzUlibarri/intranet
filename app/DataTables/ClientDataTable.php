<?php

namespace App\DataTables;

use App\Models\Client;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ClientDataTable extends DataTable
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
            ->editColumn('created_at', function (Client $model) {
                return $model->created_at;
            })
            ->editColumn('updated_at', function (Client $model) {
                return $model->updated_at;
            })
            ->editColumn('deleted_at', function (Client $model) {
                return $model->deleted_at;
            })
            ->addColumn('action', 'clients.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param Client $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Client $model)
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
//            ->setTableId('client-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1, 'asc')
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
            Column::make('id'),
            Column::make('name')->title(trans('clients.name')),
            Column::make('description')->title(trans('clients.description')),
            Column::make('created_at'),
            Column::make('updated_at'),
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
        return 'clients_' . date('YmdHis');
    }
}
