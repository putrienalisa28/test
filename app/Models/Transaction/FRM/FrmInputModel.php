<?php

namespace App\Models\Transaction\FRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrmInputModel extends Model
{
    protected $table = 'tbl_mst_form';
    protected $primaryKey = 'form_id';
    protected $fillable = [
        'form_id',
        'form_name',
        'form_judul',
        'form_revisi',
        'form_efektif'
    ];
    public $timestamps = true;
}
