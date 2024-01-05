<?php

namespace App\Models\Sewing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SewingModel extends Model
{
    use HasFactory;
    protected $connection = 'second_pgsql';

    function getItemByIlygDestination()
    {
        $data = ItemlygDestination::all();
        return $data;
    }

    function getItemByIlygStyleSize()
    {
        $data = ItemlygStyleSize::all();
        return $data;
    }

    function getItemByIlygSewingOutput()
    {
        $data = ItemlygSewingOutput::all();
        return $data;
    }
}

class ItemlygDestination extends Model
{
    protected $connection = 'second_pgsql';
    protected $table = 'lygDestination';
    protected $primaryKey = 'id';
}

class  ItemlygStyleSize extends Model
{
    protected $connection = 'second_pgsql';
    protected $table = 'lygStyleSize';
    protected $primaryKey = 'id';
}

class  ItemlygSewingOutput extends Model
{
    protected $connection = 'second_pgsql';
    protected $table = 'lygSewingOutput';
    protected $primaryKey = 'id';
}
