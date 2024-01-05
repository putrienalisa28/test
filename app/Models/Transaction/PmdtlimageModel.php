<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmdtlimageModel extends Model
{
    protected $table = 'tbl_trn_pm_image_detail';
    protected $primaryKey = 'dtl_id';
    public $timestamps = false;

    // public function header()
    // {
    //     return $this->belongsTo(PmdtlModel::class, 'dtl_id');
    // }
}
