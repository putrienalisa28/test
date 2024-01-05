<?php

namespace App\Models\Transaction\Eform;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction\Eform\FormsysModel;
use App\Models\Eform\form015asubcategory;

class FormsysdtlModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_trn_formsys_dtl';
    protected $primaryKey = 'id';


    public function FormsyHeader()
    {
        return $this->belongsTo(FormsysModel::class, 'id', 'hdr_id');
    }

    public function mst_category()
    {
        return $this->hasMany(form015asubcategory::class, 'subcategory_id', 'sub_category_id');
    }
}
