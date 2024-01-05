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
        $data = ItemlygSewingOutput::selectRaw('
            trn_date AS Date,
            style_code AS Style,
            COUNT(DISTINCT size_name) AS TotalSize,
            SUM(qty_output) AS TotalOutput
        ')
        ->groupBy('trn_date', 'style_code')
        ->get();
        return $data;
    }

    function joinIlygSewingOutput()
    {
        $data = $this->select('s.*', 'd.*')
            ->from('lygSewingOutput as s')
            ->join('lygDestination as d', 's.destination_code', '=', 'd.destination_code')
            ->get();

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
