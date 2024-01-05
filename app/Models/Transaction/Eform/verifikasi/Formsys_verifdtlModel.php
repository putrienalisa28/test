<?php

namespace App\Models\Transaction\Eform\verifikasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction\Eform\verifikasi\Formsys_verifModel;

class Formsys_verifdtlModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_formsys_verif_dtl';
    protected $primaryKey = 'id';


    public function verifikasiHeader()
    {
        return $this->belongsTo(Formsys_verifModel::class, 'id', 'hdr_id');
    }
}
