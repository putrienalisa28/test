<?php

namespace App\Models\Garuda;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemModel extends Model
{
    use HasFactory;
    protected $connection = 'royalti_pgsql';
    protected $table = 'item';
    protected $primaryKey = 'itemid';
}
