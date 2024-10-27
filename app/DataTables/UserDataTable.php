<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\CollectionDataTable;
use RouterOS\Query;

class UserDataTable extends DataTable
{
    public function dataTable($query): CollectionDataTable
    {
        return (new CollectionDataTable($query))
            ->addColumn('action', function ($user) {
                return '<a href="/user/edit/'.$user['name'].'" class="btn btn-sm btn-primary">Edit</a>';
            })
            ->setRowId('name');
    }

    public function query(): \Illuminate\Support\Collection
    {
        // Query data dari MikroTik
        $query = (new Query('/ip/hotspot/user/print'))
                    ->equal('.proplist', 'name,password,mac-address,limit-uptime,uptime,comment,profile');

        // Asumsikan Anda memiliki $client untuk melakukan koneksi API
        $users = $this->client->query($query)->read();

        // Kembalikan data sebagai Collection untuk kompatibilitas dengan CollectionDataTable
        return collect($users);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('user-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy([5, 'DESC'])
                    ->buttons([

                    ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('name')->title('Username'),
            Column::make('password'),
            Column::make('mac-address'),
            Column::make('limit-uptime'),
            Column::make('uptime'),
            Column::make('comment'),
            Column::make('profile'),
            Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}
