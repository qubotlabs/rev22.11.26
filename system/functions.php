<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 */

function get_url()
{
    $get_dir = explode("/", $_SERVER["PHP_SELF"]);
    unset($get_dir[count($get_dir) - 1]);
    $_new_dir = array();
    foreach ($get_dir as $_dir)
    {
        if ($_dir != '')
        {
            $_new_dir[] = $_dir;
        }
    }
    $dir_domain = implode("/", $_new_dir) . "/";
    $main_url = "http://" . $_SERVER["HTTP_HOST"] . '/' . $dir_domain;
    return $main_url;
}

?>