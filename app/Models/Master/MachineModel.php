<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction\PmModel;
use App\Models\Transaction\RencanaTpmModel;

class MachineModel extends Model
{
    protected $table = 'tbl_mst_mesin';
    protected $primaryKey = 'machine_id';
    protected $fillable = [
        'machine_id',
        'machine_name',
        'location',
        'tag',
        'created_at',
        'updated_at',
        'tbl_from_prk_server',
        'serial_number',
        'deleted_at',
        'deleted_by'
    ];
    public $timestamps = true;

    public function sparepartDtl()
    {
        return $this->hasMany(SparepartModelDtlMachine::class, 'id_machine', 'machine_id');
    }

    public function pm()
    {
        return $this->hasMany(PmModel::class, 'machine_id', 'machine_id');
    }
    public function rencanaTpm()
    {
        return $this->hasMany(RencanaTpmModel::class, 'machine_id', 'machine_id');
    }
}
