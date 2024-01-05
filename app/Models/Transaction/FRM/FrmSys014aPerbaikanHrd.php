<?php

namespace App\Models\Transaction\FRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrmSys014aPerbaikanHrd extends Model
{
    protected $table = 'tbl_frmsys014a_perbaikan_hdr';
    protected $primaryKey = 'id';
    protected $fillable = [
        'checkid',
        'nomor',
        'tanggal',
        'kode',
        'area',
        'shift',
        'jam_mulai',
        'jam_selesai',
        'total_jam',
        'jenis_kerusakan',
        'tindakan',
        'dikerjakan_by',
        'dikerjakan2_by',
        'dikerjakan3_by',
        'dikerjakan4_by',
        'app1_by',
        'app1_jabatan',
        'app1_regno',
        'app1_status',
        'app2_by',
        'app2_jabatan',
        'app2_regno',
        'app2_status',
        'app3_by',
        'app3_jabatan',
        'app3_regno',
        'app3_status',
        'dept_id',
        'status_komplit'
    ];
    public $timestamps = true;
}
