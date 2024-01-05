<?php

namespace App\Models\Transaction\FRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrmSys014aPerbaikanDtl extends Model
{
    protected $table = 'tbl_frmsys014a_perbaikan_dtl';
    protected $primaryKey = 'id';
    protected $fillable = [
        'headerid',
        'element_dibawa',
        'sparepart_dibawa',
        'quantity_dibawa',
        'element_kembali',
        'sparepart_kembali',
        'element_kembali',
        'quantity_kembali',
        'keterangan',
    ];
    public $timestamps = true;
}
