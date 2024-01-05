<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\DepartementModel;

class DepartementModel extends Model
{
    protected $table = 'tbl_mst_dept_hdr';
    protected $primaryKey = 'header_id';
    protected $fillable = [
        'dept_id',
        'dept_abbr',
        'nama_panjang'
    ];
    public $timestamps = true; 


    public function deptDtl()
    {
        return $this->hasMany(DepartementDtlModel::class, 'header_id', 'header_id');
    }
}
