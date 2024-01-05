<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class PrkServerModel extends Model
{
    use HasFactory;
    // protected $connection = 'secondary';
    // protected $table = 'vtis';
    // protected $primaryKey = 'ID';

    // Vtis
    public function vtisGetAllWithPage($page)
    {
        $data = VtisModel::paginate($page);
        return $data;
    }
    public function vtisGetById(int $id)
    {
        $data = VtisModel::find($id);
        return $data;
    }
    // End Vtis


}

class VtisModel extends Model
{
    use HasFactory;
    protected $connection = 'secondary';
    protected $table = 'vtis';
    protected $primaryKey = 'ID';
}
