<?php

namespace App\Models\Transaction\FRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CekSys014aModelHdr extends Model
{
    protected $table = 'tbl_frmsys014a_cek_hdr';
    protected $primaryKey = 'id';
    protected $fillable = [
        'headerid',
        'no_ref',
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
        'status_komplit',
        'created_by'
    ];
    public $timestamps = true;

    public function FormCeksys014aDetail()
    {
        return $this->hasmany(CekSys014aModel::class, 'headerid', 'id');
    }

}
