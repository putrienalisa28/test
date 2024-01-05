<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmdtlModel extends Model
{
    protected $table = 'tb_trn_pm_dtl';
    protected $primaryKey = 'id';


    public function pmHeader()
    {
        return $this->hasOne(PmModel::class, 'id', 'hdr_id');
    }
}
