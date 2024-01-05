<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\FRM\Sys015aMachineModel;

class DepartementDtlModel extends Model
{
    // use HasFactory;
    protected $table = 'tbl_mst_dept_dtl';
    protected $primaryKey = 'detail_id';
    protected $fillable = [
        'header_id',
        'machine_id'
    ];
    public $timestamps = true;

    public function machine()
    {
        return $this->hasOne(Sys015aMachineModel::class, 'machine_id', 'machine_id');
    }
}
