<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MenuHeader extends Model
{
    protected $table = 'zhl_gen_tbl_utl_menu_hdr';
    protected $primaryKey = 'menuhdr_id';

    public function subMenus()
    {
        return $this->hasMany(SubMenu::class, 'menuhdr_id', 'menuhdr_id');
    }


    public function menuAccess()
    {
        return $this->hasMany(MenuAccess::class, 'menu_id', 'menuhdr_id');
    }


    public function scopeByGroupId($query, $group_id)
    {
        return $query->whereHas('menuAccess', function ($query) use ($group_id) {
            $query->where('user_group_id',  $group_id);
        });
    }
}

class SubMenu extends Model
{
    protected $table = 'zhl_gen_tbl_utl_menu_dtl';
    protected $primaryKey = 'menudtl_id';

    public function menuHeader()
    {
        return $this->belongsTo(MenuHeader::class, 'menuhdr_id', 'menuhdr_id');
    }
    function subMenuDetails()
    {
        return $this->hasMany(SubMenuDetail::class, 'menudtl_id', 'menudtl_id');
    }
}

class SubMenuDetail extends Model
{
    protected $table = 'zhl_gen_tbl_utl_menu_dtlsub';
    protected $primaryKey = 'menudtlsub_id';
    public function subMenu()
    {
        return $this->belongsTo(SubMenu::class, 'menudtl_id', 'menudtl_id');
    }
}

class MenuAccess extends Model
{
    protected $table = 'zhl_gen_tbl_utl_menu_access';
    protected $primaryKey = 'user_group_id';


    public function menusHeader()
    {
        return $this->hasMany(MenuHeader::class, 'menu_id', 'menu_id');
    }
}

class GroupUser extends Model
{
    protected $table = 'gen_tbl_utl_user_group';
    protected $primaryKey = 'user_group_id';


    public function getAllGroup()
    {
        return $this->hasMany(MenuHeader::class, 'menu_id', 'menu_id');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'group_id', 'user_group_id'); // (Model, foreign key, local key)
    }
}
