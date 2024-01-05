<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\SparepartModel;
use App\Models\Master\MachineModel;

class RencanaTpmModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_trn_rencana_tpms';
    protected $primaryKey = 'id';

    public function rencanaTpmDetail()
    {
        return $this->hasMany(RencanaTpmDetail::class, 'machine_id', 'machine_id');
    }

    public function machine()
    {
        return $this->belongsTo(MachineModel::class, 'machine_id', 'machine_id');
    }

    function getSparepart($id)
    {
        $data = RencanaTpmDetail::join('tbl_trn_rencana_tpms', 'tbl_trn_rencana_tpms_detail.hdr_id', '=', 'tbl_trn_rencana_tpms.id')
            ->where(function ($query) {
                $query->whereNull('status_stock')->orWhere('status_stock', 2);
            })->where('tbl_trn_rencana_tpms.machine_id', $id)->get();

        return $data;
    }

    function getRencanaTpmDetail($param)
    {
        $where = [];
        if ($param['machine_id'] > 0) {
            $where[] = ['tbl_trn_rencana_tpms_detail.machine_id', '=', $param['machine_id']];
        }
        if ($param['sparepart_id'] > 0) {
            $where[] = ['tbl_trn_rencana_tpms_detail.sparepart_id', '=', $param['sparepart_id']];
        }
        $data = RencanaTpmDetail::where($where)->first();

        return $data;
    }

    function updateRencanaTpmDetail($param)
    {
        $data = RencanaTpmDetail::where(['sparepart_id' => $param['sparepart_id'], 'machine_id' => $param['machine_id']])->update($param);

        return $data;
    }
}


class RencanaTpmDetail extends RencanaTpmModel
{
    use HasFactory;

    protected $table = 'tbl_trn_rencana_tpms_detail';
    protected $primaryKey = 'id';
    protected $timestamp = false;

    public function rencanaTpm()
    {
        return $this->belongsTo(RencanaTpmModel::class, 'machine_id', 'machine_id');
    }

    public function sparepart()
    {
        return $this->belongsTo(SparepartModel::class, 'sparepart_id', 'id');
    }
}
