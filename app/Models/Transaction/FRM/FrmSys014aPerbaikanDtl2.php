<?php

namespace App\Models\Transaction\FRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrmSys014aPerbaikanDtl2 extends Model
{
    protected $table = 'tbl_frmsys014a_perbaikan_dtl2';
    protected $primaryKey = 'id';
    protected $fillable = [
        'headerid',
        'element_pasang',
        'sparepart_pasang',
        'quantity_pasang',
        'element_rusak',
        'sparepart_rusak',
        'quantity_rusak',
        'keterangan'
    ];
    public $timestamps = true;
}
