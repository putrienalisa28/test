<?php

namespace App\Models\Eform;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Eform\Form015aModel;


class FormDeptMesin_Model extends Model
{
    protected $table = 'tbl_mst_dept_mesinperalatan';
    protected $primaryKey = 'mesinperalatan_id';
    public $timestamps = true;

    public function Peralatan()
    {
        return $this->belongsTo(Form015aModel::class, 'mesinperalatan_id', 'machine_id');
    }
}
