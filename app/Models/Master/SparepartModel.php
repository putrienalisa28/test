<?php

namespace App\Models\Master;

use App\Models\Transaction\PmModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparepartModel extends Controller
{
    protected $table = 'tbl_mst_sparepart';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'item_id',
        'item_name',
        'doc_no',
        'interval',
        'actual_interval',
        'spare_part_no',
        'tag',
        'deleted_at',
        'deleted_by'
    ];
    public $timestamps = true;

    public function sparepartDtl()
    {
        return $this->hasMany(SparepartModelDtlMachine::class, 'id_sparepart', 'id');
    }

    public function pm()
    {
        return $this->hasMany(PmModel::class, 'sparepart_id', 'id');
    }
    public function rencanaTpmDetail()
    {
        return $this->hasMany(RencanaTpmDetailModel::class, 'sparepart_id', 'id');
    }
}
