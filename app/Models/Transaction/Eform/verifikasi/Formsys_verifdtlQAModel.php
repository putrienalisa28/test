<?php

namespace App\Models\Transaction\Eform\verifikasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction\Eform\verifikasi\Formsys_verifModel;

class Formsys_verifdtlQAModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_formsys_verifidtlQa';
    protected $primaryKey = 'id';


    public function verifikasiHeader()
    {
        return $this->belongsTo(Formsys_verifModel::class, 'id', 'hdr_id');
    }
}
