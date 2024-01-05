<?php

namespace App\Models\Eform;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class FormDeptModel extends Model
{
    protected $table = 'tbl_mst_department';
    protected $primaryKey = 'id_dept';
    public $timestamps = true;
}
