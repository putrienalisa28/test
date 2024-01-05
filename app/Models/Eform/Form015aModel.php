<?php

namespace App\Models\Eform;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Eform\Form015acategory;
use App\Models\Eform\FormDeptMesin_Model;


class Form015aModel extends Model
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
        return $this->hasMany(Form015acategory::class, 'machine_id', 'machine_id');
    }

    public function mesinAccessDept()
    {
        return $this->hasMany(FormDeptMesin_Model::class, 'mesinperalatan_id', 'machine_id');
    }
}
