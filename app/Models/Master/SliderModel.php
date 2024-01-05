<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderModel extends Model
{
    protected $table = 'tbl_mst_slider';
    protected $primaryKey = 'id_slider';
    protected $fillable = [
        'id_slider',
        'max_actualrun_hour',
        'min_actualrun_hour'
    ];
    public $timestamps = true;
}
