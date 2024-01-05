<?php

namespace App\Models\Master\FRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\FRM\Sys015aMachineModel;
use App\Models\Master\FRM\SubCategoryModel;

class CategoryModel extends Model
{
    protected $table = 'tbl_mst_sys015a_category';
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'category_id',
        'category_name',
        'machine_id',
    ];
    public $timestamps = true;
   

    public function Form015aModel()
    {
        return $this->belongsTo(Sys015aMachineModel::class, 'machine_id', 'machine_id');
    }

    public function Form015asubcategory()
    {
        return $this->hasmany(SubCategoryModel::class, 'category_id', 'category_id');
    }

}
