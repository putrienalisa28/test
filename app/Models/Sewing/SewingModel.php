<?php

namespace App\Models\Sewing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    function getSize($date, $style)
{
    $data = $this->select('size_name')
        ->from('lygSewingOutput')
        ->where('style_code', '=', $style)
        ->where('trn_date', '=', $date)
        ->groupBy('size_name')
        ->orderByRaw("
            CASE 
                WHEN size_name = 'XS' THEN 1
                WHEN size_name = 'S' THEN 2
                WHEN size_name = 'M' THEN 3
                WHEN size_name = 'L' THEN 4
                WHEN size_name = 'XL' THEN 5
                WHEN size_name = 'XXL' THEN 6
                ELSE CAST(size_name AS INTEGER)  -- Jika size_name bukan XS, S, M, L, XL, XXL
            END
        ")
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

    public function countIlygSewingOutput($date, $style, $size)
    {
        $selectStatements = [];
    
        foreach ($size as $name) {
            $selectStatements[] = DB::raw("SUM(CASE WHEN a.size_name = '{$name->size_name}' THEN a.qty_output ELSE 0 END) AS \"size_{$name->size_name}\"");
        }
    
        $data = $this->select(
                array_merge(['a.operator_name'], $selectStatements, [
                    DB::raw('SUM(a.qty_output) AS TotalQty'),
                    'b.destination_code AS Destination'
                ])
            )
            ->from('lygSewingOutput as a')
            ->join('lygDestination as b', 'a.destination_code', '=', 'b.destination_code')
            ->where('a.style_code', '=', $style)
            ->where('a.trn_date', '=', $date)
            ->groupBy('a.operator_name', 'b.destination_code')
            ->orderBy('a.operator_name', 'DESC')
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
