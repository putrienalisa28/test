<?php

namespace App\Services;

use App\Models\MenuHeader;

class MenuService
{
    public function getMenuHeaders($groupId)
    {
        // return MenuHeader::byGroupId($groupId)->with(['subMenus', 'subMenus.subMenuDetails'])->get();
        return MenuHeader::byGroupId($groupId)
            ->with(['subMenus', 'subMenus.subMenuDetails'])
            ->orderBy('order', 'asc') // Replace 'column_name' with the desired column to order by
            ->get();
    }
}
