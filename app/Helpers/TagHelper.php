<?php

if (!function_exists('getTagName')) {
    function getTagName($tag)
    {
        $tagModel = app('App\Models\Master\TagModel');
        // $tagData = $tagModel->find($tag);
        $tagData = $tagModel->where('tag_abbr', $tag)->value('tag_desc');

        return $tagData;
    }
}

if (!function_exists('getMachineName')) {
    function getMachineName($tag)
    {
        $model = app('App\Models\Master\MachineModel');
        $data = $model->where('machine_id', $tag)->value('machine_name');

        return $data;
    }
}

if (!function_exists('getCategoryMachineName')) {
    function getCategoryMachineName($tag)
    {
        $model = app('App\Models\Master\CategoryMachineModel');
        $data = $model->where('machine_category_id', $tag)->value('name_category_mesin');

        return $data;
    }
}


if (!function_exists('swal')) {
    function swal($title = '', $text = '', $icon = 'info')
    {
        $script = <<<SCRIPT
            <script>
                Swal.fire({
                    title: '{$title}',
                    text: '{$text}',
                    icon: '{$icon}',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                });
            </script>
        SCRIPT;

        return $script;
    }
}
