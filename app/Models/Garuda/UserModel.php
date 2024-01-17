<?php

namespace App\Models\Garuda;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;
    protected $connection = 'royalti_pgsql';
    protected $table = 'users';
    protected $primaryKey = 'id';
}
