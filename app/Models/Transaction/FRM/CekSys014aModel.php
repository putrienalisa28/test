<?php

namespace App\Models\Transaction\FRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CekSys014aModel extends Model
{
    protected $table = 'tbl_frmsys014a_cek';
    protected $primaryKey = 'id';
    protected $fillable = [
        'headerid',
        'nama_peralatan',
        'kode',          
        'kerusakan',
        'tindakan',
        'tanggal',
        'mulai',
        'selesai',
        'jam',
        'keterangan',
        'nama',         
        'paraf_by'
    ];
    public $timestamps = true;

    public function ceksys()
    {
        return $this->belongsTo(FrmSys014aHdr::class, 'headerid', 'headerid');
    }

    public function FormCeksys014aDetail()
    {
        return $this->belongsTo(CekSys014aModelHdr::class, 'id', 'headerid');
    }
}
