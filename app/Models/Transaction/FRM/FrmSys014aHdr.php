<?php

namespace App\Models\Transaction\FRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrmSys014aHdr extends Model
{
    protected $table = 'tbl_frmsys014a_hdr';
    protected $primaryKey = 'headerid';
    protected $fillable = [
        'nomor',
        'kode_periode',
        'jenis_mesin',
        'kode',
        'department',
        'status_komplit',
        'app1_by',          
        'app1_jabatan',
        'app1_regno',
        'app1_at',
        'app1_status',
        'app2_by',          
        'app2_jabatan',
        'app2_regno',
        'app2_at',
        'app2_status',
        'status_cek',
        'status_verifikasi',
        'nama_bagian',
        'area',
    ];
    public $timestamps = true;

    public function FormCeksys014a()
    {
        return $this->hasmany(CekSys014aModelHdr::class, 'headerid', 'headerid');
    }
}
