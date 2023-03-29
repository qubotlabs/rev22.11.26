<?php

/**
 * @author Jasman
 * @copyright Ihsana Global Solusindo 2022
 * @package No project loaded
 * @license Commercial License
 * @website https://ihsana.com/
 */

$plugin_file = IHS_WORDPRESS_ROOT . '/wp-content/plugins/' . $_SESSION['CURRENT_PROJECT_PREFIX'] . '/' . $_SESSION['CURRENT_PROJECT_PREFIX'] . '.php';
if (file_exists($plugin_file))
{
    file_put_contents($plugin_file, '');
}


$breadcrumb_tags = $content_tags = $_content_tags = null;

$breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
$breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
$breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("Reset Output") . '</li>';
$breadcrumb_tags .= '</ol>';


$content_tags .= '<div class="card card-outline card-primary">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-th"></i>&nbsp;';
$content_tags .= __e("General");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- AJAX REQUESTS --|-- FORM
$content_tags .= '<div class="card-body">';


$content_tags .= '<p>' . __e('The generated plugin has been removed, please check: <a target="_blank" href="./wp-test/wp-admin/plugins.php">Installed Plugins</a>') . '</p>';


$content_tags .= '</div>';
$content_tags .= '</div>';

define('IHS_LAYOUT_CONTENT', $content_tags);
define('IHS_LAYOUT_BREADCRUMB', $breadcrumb_tags);
define('IHS_PAGE_NAME', 'Reset Output');
define('IHS_PAGE_DESC', __e("WordPress Live Test fix"));

?>