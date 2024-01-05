<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceModel extends Model
{
    use HasFactory;
    protected $table = 'tb_trn_maintenance_hdr';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'maintenance_date',
        'machine_id',
        'remarks',
        'created_at'
    ];

    public $timestamps = true;
}
