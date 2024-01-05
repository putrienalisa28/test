<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmdtlteamModel extends Model
{
    protected $table = 'tb_trn_pm_dtl';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'sparepart_id',
        'machine_id',
        'last_interval',
        'work_time_m',
        'next_interval_estimate',
        'last_maintenance'

    ];
    public $timestamps = true;
}
