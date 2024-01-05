<?php

namespace App\Models\Transaction\Eform;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction\Eform\FormsysdtlModel;

class FormsysModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_trn_formsys_hdr';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'form_id',
        'mesin_id',
        'code',
        'dept',
        'nosurat',
        'month',
        'created_by',
        'updated_by',
        'acknowledged_by',
        'acknowledged_date'

    ];
    public $timestamps = true;

    public function FormsysDetail()
    {
        return $this->hasMany(FormsysdtlModel::class, 'hdr_id', 'id');
    }
}
