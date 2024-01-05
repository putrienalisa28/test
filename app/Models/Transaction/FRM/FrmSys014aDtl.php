<?php

namespace App\Models\Transaction\FRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\FRM\SubCategoryModel;

class FrmSys014aDtl extends Model
{
    protected $table = 'tbl_frmsys014a_dtl';
    protected $primaryKey = 'detailid';
    protected $fillable = [
        'headerid',
        'category_name',
        'subcategory_name',
        'minggu_ke1',
        'minggu_ke2',
        'minggu_ke3',
        'minggu_ke4',
        'minggu_ke5',
        'frekuensi',
        'keterangan',
    ];
    public $timestamps = true;

    public function FormSys014aDtlSub()
    {
        return $this->belongsTo(SubCategoryModel::class, 'subcategory_id', 'subcategory_id');
    }
}
