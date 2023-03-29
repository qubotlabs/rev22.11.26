<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

defined("IHS_EXEC") or die("Silent is golden!");

// TODO: INIT
$db = new DB();
$string = new StringConvert();
$db->current();

$project = $db->getProject();
$custom_posts = $db->getCustomPosts();
$taxonomies = $db->getTaxonomies();

$breadcrumb_tags = $content_tags = $pagejs = null;

$breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
$breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
$breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("REST-API") . '</li>';
$breadcrumb_tags .= '</ol>';

$content_tags .= '<div class="card card-outline card-success">';
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
$content_tags .= '<div class="card-body">';
$_content_tags = null;



if ((count($custom_posts) != 0) || (count($taxonomies) != 0))
{

    $_content_tags .= '<table class="table table-striped">';
    $_content_tags .= '<thead>';
    $_content_tags .= '<tr>';
    $_content_tags .= '<th>';
    $_content_tags .= '' . __e("Type") . '';
    $_content_tags .= '</th>';
    $_content_tags .= '<th>';
    $_content_tags .= '' . __e("Name") . '';
    $_content_tags .= '</th>';
    $_content_tags .= '<th>';
    $_content_tags .= '' . __e("REST API") . '';
    $_content_tags .= '</th>';
        $_content_tags .= '<th>';
    $_content_tags .= '' . __e("Endpoint URL") . '';
    $_content_tags .= '</th>';
    $_content_tags .= '</tr>';
    $_content_tags .= '</thead>';
    $_content_tags .= '<tbody>';
    foreach ($custom_posts as $custom_post)
    {
        $_content_tags .= '<tr>';
        $_content_tags .= '<td>';
        $_content_tags .= '' . __e("Custom Posts") . '';
        $_content_tags .= '</td>';
        $_content_tags .= '<td>';
        $_content_tags .= $custom_post['name'];
        $_content_tags .= '</td>';
        $_content_tags .= '<td>';
        if ($custom_post['show_in_rest'] == true)
        {
            $_content_tags .= '<span class="badge badge-primary">' . __e("Enable") . '</span>';
        } else
        {
            $_content_tags .= '<span class="badge badge-danger">' . __e("Disable") . '</span>';
        }
        $_content_tags .= '</td>';
        
                $_content_tags .= '<td>';
        if ($custom_post['show_in_rest'] == true)
        {
            $_content_tags .= '<code>/wp-json/wp/v2/' . $string->toVar( $project['short-name'].'_'. $custom_post['name']) . '</code>';
        } else
        {
            $_content_tags .= '';
        }
        $_content_tags .= '</td>';
        
        
        $_content_tags .= '</tr>';
    }
    foreach ($taxonomies as $taxonomy)
    {
        $_content_tags .= '<tr>';
        $_content_tags .= '<td>';
        $_content_tags .= '' . __e("Taxonomies") . '';
        $_content_tags .= '</td>';
        $_content_tags .= '<td>';
        $_content_tags .= $taxonomy['name'];
        $_content_tags .= '</td>';
        $_content_tags .= '<td>';
        if ($taxonomy['show_in_rest'] == true)
        {
            $_content_tags .= '<span class="badge badge-primary">' . __e("Enable") . '</span>';
        } else
        {
            $_content_tags .= '<span class="badge badge-danger">' . __e("Disable") . '</span>';
        }
        $_content_tags .= '</td>';
        
                $_content_tags .= '<td>';
        if ($taxonomy['show_in_rest'] == true)
        {
            $_content_tags .= '<code>/wp-json/wp/v2/' . $string->toVar( $project['short-name'].'_'. $taxonomy['name']) . '</code>';
        } else
        {
            $_content_tags .= '';
        }
        $_content_tags .= '</td>';
        
        
        $_content_tags .= '</tr>';
    }

    $_content_tags .= '</tbody>';
    $_content_tags .= '</table>';
    $_content_tags .= '<br/>';
}
$content_tags .= $_content_tags;

$content_tags .= '<h4>' . __e("How to enable REST-API?") . '</h4>';
$content_tags .= '<ul>';
$content_tags .= '<li>' . __e("Go to ") . '<code>Custom Posts</code> -&raquo; <code>Edit</code> -&raquo; <code>Show In REST-API</code> ' . __e("Change to") . ' <kbd>ON</kbd></li>';
$content_tags .= '<li>' . __e("Go to ") . '<code>Taxonomies</code> -&raquo; <code>Edit</code> -&raquo; <code>Show In REST-API</code> ' . __e("Change to") . ' <kbd>ON</kbd></li>';

$content_tags .= '</ul>';

$content_tags .= '</div>'; //card-body
$content_tags .= '</div>'; //card


define('IHS_LAYOUT_CONTENT', $content_tags);
define('IHS_LAYOUT_BREADCRUMB', $breadcrumb_tags);
define('IHS_PAGE_NAME', __e("REST-API"));
define('IHS_PAGE_DESC', __e("Review your WordPress REST-API"));

?>