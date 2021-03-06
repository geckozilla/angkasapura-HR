<?php

namespace App\DataTables;

use App\Models\karyawan_os;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Auth;
class karyawan_osDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'karyawan_os.datatables_actions')
        ->editColumn('is_active', function ($inquiry) {
            if ($inquiry->is_active == 'A') return "<span class='label label-success'>Aktif</span>";
            if ($inquiry->is_active == 'R') return "<span class='label label-danger'>Ditolak</span>";
            if ($inquiry->is_active == 'N') return "<span class='label label-warning'>Non-Aktif</span>";
            if ($inquiry->status_pensiun == null) return "<span class='label label-default'>Menunggu Persetujuan</span>";
        })
        ->with('all_data', function() use ($query) {
            return $query->get();
        })
        ->rawColumns(['is_active','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\karyawan_os $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(karyawan_os $model)
    {
        $user = Auth::user();
        $roles = $user->getRoleNames();
        if($roles[0] == "Vendor"){
            $id_vendor = \App\Models\vendor_os::where('email','=',$user->email)->first();
            return $model->with(['unitkerja','jabatan_os','fungsi','vendor'])->where('id_vendor','=',$id_vendor->id)->newQuery();
        }
        return $model->with(['unitkerja','jabatan_os','fungsi','vendor'])->newQuery();
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
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'     => 'Blfrtip',
                'order'   => [[0, 'desc']],
                'buttons' => [
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
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
            ['data'=>'id','title'=>'id','visible'=>false],
            ['data'=>'nik','title'=>'NIK'],
            ['data'=>'nama','title'=>'Nama'],
            ['data'=>'fungsi.nama_fungsi','title'=>'Fungsi'],
            ['data'=>'unitkerja.nama_uk','title'=>'Unit Kerja'],
            ['data'=>'tgl_lahir','title'=>'Tanggal Lahir'],
            ['data'=>'gender','title'=>'Jenis Kelamin'],
            ['data'=>'vendor.nama_vendor','title'=>'Nama Vendor'],
            ['data'=>'is_active','title'=>'Status'],
            // ['data'=>'penempatan','title'=>'Penempatan'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'karyawan_osdatatable_' . time();
    }
}
