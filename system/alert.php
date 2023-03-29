<?php

/**
 * @author Jasman
 * @copyright 2020
 */


$alert = null;
if (isset($_GET['alert']))
{
    $alert .= '$(document).ready(function(){' . "\r\n";
    if (isset($_SESSION['CURRENT_PROJECT_NOTICE']))
    {
        if ($_SESSION['CURRENT_PROJECT_NOTICE'] !== '')
        {
            $alert .= "\t" . 'const Toast = Swal.mixin({' . "\r\n";
            $alert .= "\t\t" . 'toast: true,' . "\r\n";
            $alert .= "\t\t" . 'position: "top-end",' . "\r\n";
            $alert .= "\t\t" . 'showConfirmButton: false,' . "\r\n";
            $alert .= "\t\t" . 'timer: 3000' . "\r\n";
            $alert .= "\t" . '});' . "\r\n";
            $alert .= "\t" . 'Toast.fire({' . "\r\n";
            $alert .= "\t\t" . 'icon: "'.htmlentities($_GET['alert']).'",' . "\r\n";
            $alert .= "\t\t" . 'title: "' . htmlentities($_SESSION['CURRENT_PROJECT_NOTICE']) . '"' . "\r\n";
            $alert .= "\t" . '})' . "\r\n";
        }
    }
    $alert .= '});' . "\r\n";

    $_SESSION['CURRENT_PROJECT_NOTICE'] = '';
}
define('IHS_LAYOUT_ALERT', $alert);

?>