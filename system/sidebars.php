<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 */

defined('IHS_EXEC') or die('Silent is golden!');


$main_sidebar = null;

$main_sidebar .= '<aside class="main-sidebar sidebar-dark-secondary elevation-4">';

// <!-- Brand Logo -->
$main_sidebar .= '<a href="?" class="brand-link navbar-'.$navbar_color.'">';
$main_sidebar .= '<img src="templates/default/assets/img/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">';
$main_sidebar .= '<span class="brand-text">' . IHS_APP_NAME . '</span>';
$main_sidebar .= '</a>';

//<!-- Sidebar -->
$main_sidebar .= '<div class="sidebar">';


$main_sidebar .= '<nav class="mt-2">';
$main_sidebar .= '<ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">';


$main_sidebar .= '<li class="nav-item has-treeview menu-open">';

$main_sidebar .= '<a href="#" class="nav-link active">';
$main_sidebar .= '<i class="nav-icon fab fa-wordpress-simple"></i>';
$main_sidebar .= '<p style="max-width: 180px;">';
if (isset($_SESSION['CURRENT_PROJECT_DATA']))
{
    $main_sidebar .= $_SESSION['CURRENT_PROJECT_DATA']['project']['project-name'];
} else
{
    $main_sidebar .= __e('New Project');
}
$main_sidebar .= '<i class="right fas fa-angle-left"></i>';
$main_sidebar .= '</p>';
$main_sidebar .= '</a>';

$main_sidebar .= '<ul class="nav nav-treeview">';
foreach ($sideItems as $sideItem)
{
    if (!isset($sideItem['have-child']))
    {
        $sideItem['have-child'] = false;
    }
    if ($sideItem['have-child'] == false)
    {
        $item_active = '';
        if ($sideItem['name'] == $_GET['p'])
        {
            $item_active = 'active';
        }
        $main_sidebar .= '<li class="nav-item">';
        $main_sidebar .= '<a href="./?p=' . $sideItem['name'] . '" class="nav-link ' . $item_active . '">';
        $main_sidebar .= '<i class="nav-icon ' . $sideItem['icon'] . '"></i>';
        $main_sidebar .= '<p>';
        $main_sidebar .= $sideItem['label'];
        if (isset($sideItem['badge']))
        {
            if ($sideItem['badge'] != '')
            {
                $main_sidebar .= $sideItem['badge'];
            }
        }
        $main_sidebar .= '</p>';
        $main_sidebar .= '</a>';
        $main_sidebar .= '</li>';
    } else
    {
        $menu_open = 'menu-open';
        if (IHS_COLLAPSE_MENU == true)
        {
            $menu_open = '';
            foreach ($sideItem['childs'] as $child)
            {
                if ($child['name'] == $_GET['p'])
                {
                    $menu_open = 'menu-open';
                }
            }
        }
        $main_sidebar .= '<li class="nav-item ' . $menu_open . '">';
        $main_sidebar .= '<a href="#" class="nav-link">';
        $main_sidebar .= '<i class="nav-icon ' . $sideItem['icon'] . '"></i>';
        $main_sidebar .= '<p>';
        $main_sidebar .= $sideItem['label'];
        $main_sidebar .= '<i class="right fas fa-angle-left"></i>';
        $main_sidebar .= '</p>';
        $main_sidebar .= '</a>';
        $main_sidebar .= '<ul class="nav nav-treeview">';
        foreach ($sideItem['childs'] as $child)
        {
            $item_active = '';
            if ($child['name'] == $_GET['p'])
            {
                $item_active = 'active';
            }
            $main_sidebar .= '<li class="nav-item">';
            $main_sidebar .= '<a href="./?p=' . $child['name'] . '" class="nav-link ' . $item_active . '">';
            $main_sidebar .= '<i class="nav-icon ' . $child['icon'] . '"></i>';
            $main_sidebar .= '<p>';
            $main_sidebar .= $child['label'];
            if (isset($child['badge']))
            {
                if ($child['badge'] != '')
                {
                    $main_sidebar .= $child['badge'];
                }
            }
            $main_sidebar .= '</p>';
            $main_sidebar .= '</a>';
            $main_sidebar .= '</li>';
        }
        $main_sidebar .= '</ul>';
        $main_sidebar .= '</li>';
    }
}
$main_sidebar .= '</ul>';


$main_sidebar .= '</li>';
$main_sidebar .= '</ul>';
$main_sidebar .= '</nav>';
$main_sidebar .= '</div>'; //sidebar
$main_sidebar .= '</aside>';


define('IHS_LAYOUT_MAIN_SIDEBAR', $main_sidebar);

?>