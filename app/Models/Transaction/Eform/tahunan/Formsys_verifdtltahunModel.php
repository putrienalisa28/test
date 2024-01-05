<?php

namespace App\Models\Transaction\Eform\tahunan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction\Eform\tahunan\Formsys_veriftahunModel;

class Formsys_verifdtltahunModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_formsys_veriftahun_dtl';
    protected $primaryKey = 'id';


    public function verifikasiHeader()
    {
        return $this->belongsTo(Formsys_veriftahunModel::class, 'id', 'hdr_id');
    }
}
