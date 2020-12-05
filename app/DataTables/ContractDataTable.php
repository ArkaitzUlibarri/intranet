<?php

namespace App\DataTables;

use App\Models\Contract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ContractDataTable extends DataTable
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
            ->editColumn('contractType', function (Contract $model) {
                return isset($model->contractType)
                    ? $model->contractType->code . ' - ' . $model->contractType->name
                    : null;
            })
            ->addColumn('action', 'contracts.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Contract $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Contract $model)
    {
        return $model->newQuery()
            ->select('contracts.*')
            ->with('user')
            ->with('contractType');
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
            Column::make('user.name')->title(trans('common.user')),
            Column::make('contractType')->title(trans('common.contractType')),
            Column::make('start_date')->title(trans('contracts.start_date')),
            Column::make('estimated_end_date')->title(trans('contracts.estimated_end_date')),
            Column::make('end_date')->title(trans('contracts.end_date')),
            Column::make('week_hours')->title(trans('contracts.week_hours')),
            Column::make('created_at')->title(trans('common.created_at')),
            Column::make('updated_at')->title(trans('common.updated_at')),
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
        return 'contracts_' . date('YmdHis');
    }
}
