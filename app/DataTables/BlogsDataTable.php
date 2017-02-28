<?php

namespace App\DataTables;

use Auth;
use App\User;
use App\Blogs;
use Yajra\Datatables\Services\DataTable;

class BlogsDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', function ($data) {
                $isAdmin = Auth::user()->role == 'admin';
                return view('admin/partials/blogs/action', compact('data', 'isAdmin'));
            })
            ->editColumn('image', function ($data) {
                return view('admin/partials/image', compact('data'));
            })
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Blogs::with('user')->select('blogs.*');

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->ajax('')
            ->addAction([])
            ->parameters([
                'dom'          => 'Bfrtip',
                'buttons'      => ['export', 'print', 'reload'],
                'pageLength'   => 5,
                'order'        => [[ 0, "desc" ]],
                'initComplete' => "function () {
                            this.api().columns().every(function () {
                                var column = this;
                                var input = document.createElement(\"input\");
                                $(input).appendTo($(column.footer()).empty())
                                .on('change', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            });
                        }",
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'title',
            'content',
            'user.name',
            'image',
            'created_at',
            'updated_at',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'blogsdatatables_' . time();
    }
}
