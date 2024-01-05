<?php

namespace App\Models\Transaction;

use App\Models\Master\SparepartModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction\PmdtlModel;
use App\Models\Master\MachineModel;
use App\Models\Master\SparepartModelDtlMachine;

class PmModel extends Model
{
    use HasFactory;

    protected $table = 'tb_trn_pm_hdr';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'sparepart_id',
        'machine_id',
        'category_maintenance',
        'last_interval',
        'work_time_m',
        'next_interval_estimate',
        'last_maintenance'
    ];
    public $timestamps = true;

    public function sparepart()
    {
        return $this->hasOne(SparepartModel::class, 'id', 'sparepart_id');
    }

    public function machine()
    {
        return $this->hasOne(MachineModel::class, 'machine_id', 'machine_id');
    }

    public function pmDetail()
    {
        return $this->hasMany(PmdtlModel::class, 'hdr_id', 'id');
    }

    public function pmIntervalDetail()
    {
        return $this->hasMany(PmIntervalDetail::class, 'hdr_id', 'id');
    }

    public function sparepartByMachine()
    {
        return $this->hasMany(SparepartModelDtlMachine::class, 'id_sparepart', 'sparepart_id');
    }
}
