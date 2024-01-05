<?php

namespace App\Models\Accounting\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coa extends Model
{
    protected $table = 'zhl_acc_master_coa';
    protected $primaryKey = 'NoCOA';
    protected $fillable = [
        'NoCOA',
        'AccountName',
        'GroupCOA',
        'updated_by',
        'created_by',
    ];
    public $timestamps = false;
}
