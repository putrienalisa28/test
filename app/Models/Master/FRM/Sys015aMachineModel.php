<?php

namespace App\Models\Master\FRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\FRM\CategoryModel;
use App\Models\Master\DepartementDtlModel;

class Sys015aMachineModel extends Model
{
    protected $table = 'tbl_mst_sys015a';
    protected $primaryKey = 'machine_id';
    protected $fillable = [
        'machine_id',
        'machine_name'
    ];
    public $timestamps = true;
    
    public function fm015category()
    {
        return $this->hasMany(CategoryModel::class, 'machine_id', 'machine_id');
    }

    public function deptDtl()
    {
        return $this->hasMany(DepartementDtlModel::class, 'machine_id', 'machine_id');
    }
}
