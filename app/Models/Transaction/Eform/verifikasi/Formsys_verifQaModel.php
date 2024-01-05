<?php

namespace App\Models\Transaction\Eform\verifikasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formsys_verifQaModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_formsys_verifqa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'namaperalantan', 'kode', 'ketidaksesuaian', 'tindakan', 'mulai', 'selesai', 'statusverifikasi', 'paraf'



    ];
    public $timestamps = true;

    // public function verifikasiDetail()
    // {
    //     return $this->hasMany(Formsys_verifdtlModel::class, 'hdr_id', 'id');
    // }
}
