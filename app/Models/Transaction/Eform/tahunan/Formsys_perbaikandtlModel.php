<?php

namespace App\Models\Transaction\Eform\tahunan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction\Eform\tahunan\Formsys_perbaikanModel;

class Formsys_perbaikandtlModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_formsys_perbaikan_dtl';
    protected $primaryKey = 'id';


    public function perbaikanHeader()
    {
        return $this->belongsTo(Formsys_perbaikanModel::class, 'id', 'hdr_id');
    }
}
