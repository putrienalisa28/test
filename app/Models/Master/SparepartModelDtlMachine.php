<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction\PmModel;

class SparepartModelDtlMachine extends Model
{
    protected $table = 'tblsparepardtl_machines';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_machine',
        'id_sparepart'
    ];
    public $timestamps = true;

    public function machine()
    {
        return $this->hasOne(MachineModel::class, 'machine_id', 'id_machine');
    }

    public function sparepart()
    {
        return $this->hasOne(SparepartModel::class, 'id', 'id_sparepart')->orderBy('item_name');
    }

    public function pmHeader()
    {
        return $this->hasOne(PmModel::class, 'sparepart_id', 'id_sparepart');
    }
}
