<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MysamInModel extends Model
{
    use HasFactory;
    protected $connection = 'mysamin';

    function getItemById($keyword)
    {
        $data = ItemModel::where('ItemName', 'LIKE', "%$keyword%")
            ->orWhere('ItemID', 'LIKE', "%$keyword%")
            ->get();
        // $data = ItemModel::where('ItemName', 'LIKE', "%$keyword%")->paginate(10); // Menampilkan 10 item per halaman
        return $data;
    }
}

class ItemModel extends Model
{
    protected $connection = 'mysamin';
    protected $table = 'tblMstItem';
    protected $primaryKey = 'ItemID';
}
