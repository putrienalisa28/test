<?php

namespace App\Models\Transaction\Eform;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction\Eform\Formsys_bildtlModel;

class Formsys_bilModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_formsys_bil_hdr';
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
        'dept',
        'mesinid',
        'mesinname'

    ];
    public $timestamps = true;

    public function bilingualDetail()
    {
        return $this->hasMany(Formsys_bildtlModel::class, 'hdr_id', 'id');
    }
}
