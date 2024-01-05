<?php

namespace App\Models\Transaction\Eform;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction\Eform\Formsys_bilModel;

class Formsys_bildtlModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_formsys_bil_dtl';
    protected $primaryKey = 'id';


    public function bilingualHeader()
    {
        return $this->belongsTo(Formsys_bilMode::class, 'id', 'hdr_id');
    }
}
