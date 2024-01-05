<?php

use Illuminate\Support\HtmlString;

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

if (!function_exists('dateFormater')) {
    function dateFormater($date, $format = 'd/m/Y')
    {
        if (date("Y", strtotime($date)) == '0000' || date("Y", strtotime($date)) == '1970') return date($format, strtotime($date));

        return date($format, strtotime($date));
    }
}

if (!function_exists('loaderDiv')) {
    function loaderDiv()
    {
        return '<div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
                    <div class="sk-fold sk-primary text-center">
                        <div class="sk-fold-cube"></div>
                        <div class="sk-fold-cube"></div>
                        <div class="sk-fold-cube"></div>
                        <div class="sk-fold-cube"></div>
                    </div>
                </div>';
    }
}

if (!function_exists('showAlert')) {

    function showAlert($type, $message, $showClose = true)
    {
        $alertIcon = '<span class="alert-icon alert-icon-lg text-primary me-2">
                <i class="ti ti-info-circle ti-sm"></i>
            </span>';

        $alertContent = '<div class="d-flex flex-column ps-1">
                    <p class="mb-0">' . $message . '</p>';

        if ($showClose == true) {
            $alertContent .= '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        }

        $alertContent .= '</div>';

        $alert = '<div class="alert alert-' . $type . ' alert-dismissible d-flex align-items-baseline" role="alert">
            ' . $alertContent . '
        </div>';

        return new HtmlString($alert);
    }
}

if (!function_exists('getTTD')) {

    function getTTD($regno)
    {
        return "<img src='" . url('MasterTT/Karyawan/' . $regno) . ".png' alt='QR Code' class='img-thumbnail' style='width: 100px; font-weight: bold; display: block; margin: 0 auto;'";


        if (!function_exists('getConditionIcon')) {

            function getConditionIcon($condition)
            {
                if ($condition == null) {
                    return new HtmlString("<button class='btn btn-sm btn-primary' data-toggle='modal' data-target='#editRoleModal'><i class=''></i>&nbsp;Click to confirm stock</button>");
                }
                if ($condition == 1) {
                    return new HtmlString('<i class="fa fa-check-circle text-success"></i>');
                } else if ($condition == 2) {
                    return new HtmlString('<i class="fa fa-times-circle text-danger"></i>');
                }

            }
        }   
    }
}
