<?php

namespace App\Models\Transaction\FRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrmSys014aVerifikasiModel extends Model
{
    protected $table = 'tbl_frmsys014a_verifikasiqa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'headerid',
        'soal',
        'status'
    ];
    public $timestamps = true;
}
