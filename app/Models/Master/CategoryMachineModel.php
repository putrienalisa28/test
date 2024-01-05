<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryMachineModel extends Model
{
  
    protected $table = 'tbl_mst_category_mesin';
    protected $primaryKey = 'idcategorymesin';
    protected $fillable= [
        'idcategorymesin',
        'namacategorymesin'
    ];
    public $timestamps = true;
}
