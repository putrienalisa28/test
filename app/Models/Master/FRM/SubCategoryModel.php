<?php

namespace App\Models\Master\FRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\FRM\CategoryModel;
use App\Models\Transaction\FRM\FrmSys014aDtl;

class SubCategoryModel extends Model
{
    protected $table = 'tbl_mst_sys015a_subcategory';
    protected $primaryKey = 'subcategory_id';
    protected $fillable = [
        'subcategory_id',
        'subcategory_name',
        'category_id',
    ];
    public $timestamps = true;

   
    public function Form015acategory()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id', 'category_id');
    }

    public function FormSys014aDtl()
{
    return $this->hasMany(FrmSys014aDtl::class, 'subcategory_id', 'subcategory_id')
                ->orderBy('detailid', 'asc');
}

    
}
