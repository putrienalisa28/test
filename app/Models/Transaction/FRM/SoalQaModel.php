<?php

namespace App\Models\Transaction\FRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class SoalQaModel extends Model
{
    protected $table = 'tbl_soal_qa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'soal'
    ];
    public $timestamps = true;
}
