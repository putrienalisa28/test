<?php

namespace App\Models\Transaction\Eform\tahunan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction\Eform\tahunan\Formsys_perbaikandtlModel;

class Formsys_perbaikanModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_formsys_perbaikan_hdr';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'jenisform',
        'nosurat',
        'created_by',
        'checked_by',
        'acknowledged_by',
        'acknowledged_date',
        'checked_date',
        'hdrsys',
        'dept'

    ];
    public $timestamps = true;

    public function perbaikanDetail()
    {
        return $this->hasMany(Formsys_perbaikandtlModel::class, 'hdr_id', 'id');
    }
}
