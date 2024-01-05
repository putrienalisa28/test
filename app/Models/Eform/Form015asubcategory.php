<?php

namespace App\Models\Eform;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Eform\Form015acategory;
use App\Models\Transaction\Eform\FormsysdtlModel;

class Form015asubcategory extends Model
{
    protected $table = 'tbl_mst_sys015a_subcategory';
    protected $primaryKey = 'subcategory_id';
    protected $fillable = [
        'category_id',
        'sub_category_name'

    ];
    public $timestamps = true;

    public function Form015acategory()
    {
        return $this->belongsTo(Form015acategory::class, 'category_id', 'category_id');
    }

    public function formdetailtrans()
    {
        return $this->belongsTo(FormsysdtlModel::class, 'sub_category_id', 'subcategory_id');
    }
}
