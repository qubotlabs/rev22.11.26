<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 */

defined('IHS_EXEC') or die('Silent is golden!');


$main_header = null;

$main_header .= '<nav class="main-header navbar navbar-expand navbar-dark navbar-'.$navbar_color.'">';

$main_header .= '<ul class="navbar-nav">';

$main_header .= '<li class="nav-item">';
$main_header .= '<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>';
$main_header .= '</li>';

$main_header .= '<li class="nav-item d-none d-sm-inline-block">';
$main_header .= '<a href="./" class="nav-link">Home</a>';
$main_header .= '</li>';

if (isset($_SESSION['CURRENT_PROJECT_DATA']))
{
    $main_header .= '<li class="nav-item d-none d-sm-inline-block">';
    $main_header .= '<a href="./?p=codeBrowser" class="nav-link">Code Browser</a>';
    $main_header .= '</li>';

    $main_header .= '<li class="nav-item d-none d-sm-inline-block">';
    $main_header .= '<a href="./?p=codeSnippet" class="nav-link">Code Snippet</a>';
    $main_header .= '</li>';
}

$main_header .= '<li class="nav-item d-none d-sm-inline-block">';
$main_header .= '<a target="_blank" href="./wp-test/wp-admin" class="nav-link">WP Live Test</a>';
$main_header .= '</li>';

$main_header .= '<li class="nav-item d-none d-sm-inline-block">';
$main_header .= '<a href="mailto:iwpdev@ihsana.com?subject=iWP-Dev Toolz Issue" class="nav-link">Contact Support</a>';
$main_header .= '</li>';


$main_header .= '</ul>';

$main_header .= '<ul class="navbar-nav ml-auto">';
$main_header .= '<li class="nav-item">';
$main_header .= '<a class="nav-link" href="./?p=config">';
$main_header .= '<i class="fas fa-cogs"></i>';
$main_header .= '</a>';
$main_header .= '</li>';
$main_header .= '</ul>';


$main_header .= '</nav>';


define('IHS_LAYOUT_MAIN_HEADER', $main_header);

?>