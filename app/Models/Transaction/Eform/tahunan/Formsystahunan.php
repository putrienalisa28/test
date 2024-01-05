<?php

namespace App\Models\Transaction\Eform\tahunan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction\Eform\tahunan\Formsystahunandtl;

class Formsystahunan extends Model
{
    use HasFactory;

    protected $table = 'tbl_formsys_tahun_hdr';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'mesin_id',
        'code',
        'dept',
        'nosurat',
        'tahun',
        'created_by',
        'updated_by',
        'acknowledged_by',
        'acknowledged_date'

    ];
    public $timestamps = true;

    public function Formsystahunandtl()
    {
        return $this->hasMany(Formsystahunandtl::class, 'hdr_id', 'id');
    }
}
