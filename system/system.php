<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 */

$list_color[]= 'primary';
$list_color[]= 'secondary';
$list_color[]= 'danger';
$list_color[]= 'cyan';
$list_color[]= 'teal';
 
$navbar_color = $list_color[rand(0, count($list_color)-1 )]; 

if (!file_exists(IHS_PROJECT_DIR))
{
    mkdir(IHS_PROJECT_DIR, 0777, true);
}

if (!file_exists(IHS_ROOT_DIR . '/wp-test'))
{
    mkdir(IHS_ROOT_DIR . '/wp-test', 0777, true);
}

function __e($str)
{
    return $str;
}
require_once IHS_SYSTEM_DIR . '/functions.php';
require_once IHS_SYSTEM_DIR . '/options.php';
require_once IHS_SYSTEM_DIR . '/routes.php';
require_once IHS_SYSTEM_DIR . '/sideitems.php';
require_once IHS_SYSTEM_DIR . '/sidebars.php';
require_once IHS_SYSTEM_DIR . '/headers.php';

?>