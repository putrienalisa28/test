<?php

namespace App\Models\Transaction\Eform\tahunan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction\Eform\tahunan\Formsystahunan;

class Formsystahunandtl extends Model
{
    use HasFactory;

    protected $table = 'tbl_formsys_tahun_dtl';
    protected $primaryKey = 'id';



    public function FormsyHeader()
    {
        return $this->belongsTo(Formsystahunan::class, 'id', 'hdr_id');
    }
}
