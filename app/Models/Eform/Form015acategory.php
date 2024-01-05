<?php

namespace App\Models\Eform;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Eform\Form015aModel;
use App\Models\Eform\Form015asubcategory;

class Form015acategory extends Model
{
    protected $table = 'tbl_mst_sys015a_category';
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'category_id',
        'machine_id',
        'category_name'

    ];
    public $timestamps = true;

    public function Form015aModel()
    {
        return $this->belongsTo(Form015aModel::class, 'machine_id', 'machine_id');
    }

    public function Form015asubcategory()
    {
        return $this->hasmany(Form015asubcategory::class, 'category_id', 'category_id');
    }
}
