<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction\RencanaTpmDetail;

class PmIntervalDetail extends Model
{
    use HasFactory;
    protected $table = 'tb_trn_pm_interval';
    protected $primaryKey = "id";


    public function pmHeader()
    {
        return $this->belongsTo(PmModel::class, 'hdr_id', 'id');
    }
}
