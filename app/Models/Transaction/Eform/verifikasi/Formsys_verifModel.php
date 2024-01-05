<?php

namespace App\Models\Transaction\Eform\verifikasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction\Eform\verifikasi\Formsys_verifdtlModel;
use App\Models\Transaction\Eform\verifikasi\Formsys_verifdtlQAModel;

class Formsys_verifModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_formsys_verif_hdr';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'hdrsys', 'dtlsys', 'dept', 'idbilingual', 'tanggalverif', 'namamesin', 'area', 'jam', 'totaljam', 'jeniskerusakan', 'tindakan', 'code', 'shift', 'created_by', 'updated_by',  'checked_by', 'checked_date', 'jabatan_checker', 'jabatan_creater', 'verived_by', 'verived_date', 'jabatan_veriver'


    ];
    public $timestamps = true;

    public function verifikasiDetail()
    {
        return $this->hasMany(Formsys_verifdtlModel::class, 'hdr_id', 'id');
    }


    public function verifikasiQADetail()
    {
        return $this->hasMany(Formsys_verifdtlQAModel::class, 'hdr_id', 'id');
    }
}
