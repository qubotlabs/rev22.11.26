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
$breadcrumb_tags = $content_tags = $pagejs = null;

$breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
$breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
$breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("Build the Project") . '</li>';
$breadcrumb_tags .= '</ol>';

$content_tags .= '<div class="card card-outline card-success">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-code"></i>&nbsp;';
$content_tags .= __e("General");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
$content_tags .= '<div class="card-body">';

// TODO: EXPORT PLUGIN
$rootWP = realpath(IHS_WORDPRESS_ROOT);
$dirTarget = str_replace('\\', '/', $rootWP) . '/wp-content/plugins/' . $project['prefix'];


$content_tags .= '<p>' . __e("Trying to create plugin zip file:") . '</p>';


$plugin_files = array();
$plugin_path[] = $dirTarget . '/*';
while (count($plugin_path) != 0)
{
    $v = array_shift($plugin_path);
    foreach (glob($v) as $item)
    {
        if (is_dir($item))
            $plugin_path[] = $item . '/*';
        elseif (is_file($item))
        {
            $plugin_files[] = $item;
        }
    }
}

$content_tags .= '<pre>';
$plugin_destination = IHS_PROJECT_DIR . '/' . $project['prefix'] . '.zip';
unlink($plugin_destination);

$zip = new ZipArchive();
if ($zip->open($plugin_destination, ZIPARCHIVE::CREATE))
{
    foreach ($plugin_files as $file)
    {
        $dir_zip = explode('/plugins/' . $project['prefix'] . '/', $file);
        $zip->addFile($file, $dir_zip[1]);
        $content_tags .= '~ Add File to Zip: ' . $file . '=>' . $dir_zip[1] . "\r\n";
    }
}
$content_tags .= '~ The zip archive contains ' . $zip->numFiles . ' files with a status of: ' . $zip->status . "\r\n";
$zip->close();

$content_tags .= '</pre>';

$content_tags .= '<p>' . __e("Trying to create iWP Project file:") . '</p>';
// TODO: EXPORT PROJECT
$content_tags .= '<pre>';
$project_files = array();
$project_path[] = IHS_PROJECT_DIR . '/' . $project['prefix'] . '/*';
while (count($project_path) != 0)
{
    $v = array_shift($project_path);
    foreach (glob($v) as $item)
    {
        if (is_dir($item))
            $project_path[] = $item . '/*';
        elseif (is_file($item))
        {
            $project_files[] = $item;
        }
    }
}
$project_destination = IHS_PROJECT_DIR . '/' . $project['prefix'] . '.iwp';
unlink($project_destination);
$zip = new ZipArchive();
if ($zip->open($project_destination, ZIPARCHIVE::CREATE))
{
    foreach ($project_files as $file)
    {

        $zip->addFile($file, basename($file));
        $content_tags .= '~ Add File to Zip: ' . $file . '=>' . basename($file) . "\r\n";
    }
}
$content_tags .= '~ The zip archive contains ' . $zip->numFiles . ' files with a status of: ' . $zip->status . "\r\n";
$zip->close();
$content_tags .= '</pre>';

$content_tags .= '</div>'; //card-body
$content_tags .= '<div class="card-footer">';
$content_tags .= '<a href="projects/' . $project['prefix'] . '.zip?' . time() . '" class="btn btn-success btn-flat"><i class="fas fa-download"></i>&nbsp;' . __e("Download The Plugin") . '</a>';
$content_tags .= '<a href="projects/' . $project['prefix'] . '.iwp?' . time() . '" class="btn btn-default btn-flat pull-right"><i class="fas fa-download"></i>&nbsp;' . __e("Download iWP Project") . '</a>';

$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card

define('IHS_LAYOUT_CONTENT', $content_tags);
define('IHS_LAYOUT_BREADCRUMB', $breadcrumb_tags);
define('IHS_PAGE_NAME', __e("Build the Project"));
define('IHS_PAGE_DESC', __e("Download the project that you have created "));
define('IHS_PAGE_JS', $pagejs);

?>