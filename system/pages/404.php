<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 */

$breadcrumb_tags = $content_tags = $_content_tags = null;

$breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
$breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
$breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("404") . '</li>';
$breadcrumb_tags .= '</ol>';


$_content_tags .= '<div class="error-page">';
$_content_tags .= '<h2 class="headline text-warning">404</h2>';
$_content_tags .= '<div class="error-content">';
$_content_tags .= '<h3><i class="fas fa-exclamation-triangle text-warning"></i> ' . __e("Oops! Page not found") . '.</h3>';
$_content_tags .= '<p>';
$_content_tags .= __e("We could not find the page you were looking for Meanwhile, you may <a href=\"./\">return to dashboard</a>")  ;
 $_content_tags .= '</p>';
$_content_tags .= '</div>';
$_content_tags .= '</div>';


define('IHS_LAYOUT_CONTENT', $_content_tags);
define('IHS_LAYOUT_BREADCRUMB', $breadcrumb_tags);
define('IHS_PAGE_NAME', '404');
define('IHS_PAGE_DESC', __e("Page Not Found"));

?>