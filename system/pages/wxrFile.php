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

$filePath = IHS_WORDPRESS_ROOT . "/wp-content/plugins/" . $project['prefix'] . "/dummy.xml";
if (file_exists($filePath))
{
    $xml_dummy = file_get_contents($filePath);
    if ($_GET['a'] == 'download')
    {
        header('Content-type: application/xml');
        header('Content-Disposition: attachment; filename="dummy.xml"');
        die($xml_dummy);
    }
}
$breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
$breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
$breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("WXR File") . '</li>';
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

$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/dummy.xml</code></p>';
$content_tags .= '<hr/>';


$content_tags .= '<p>' . __e("This is a sample data that you can import into your wordpress, this sample data has been made according to the project you are working on now.") . '</p>';

$content_tags .= '<textarea data-type="xml">' . htmlentities($xml_dummy) . '</textarea>';
$content_tags .= '<hr/>';

$content_tags .= '<h3>' . __e("How to add dummy content on WordPress?") . '</h3>';
$content_tags .= '<p>' . __e("Please follow the below process to import data:") . '</p>';
$content_tags .= '<ul>';
$content_tags .= '<li>' . __e("Log in to your wordpress account, Go to <strong>Tools</strong> -&raquo; <strong>Import</strong>") . '</li>';
$content_tags .= '<li>' . __e("Select <em>WordPress</em> and <strong>Install it</strong>") . '</li>';
$content_tags .= '<li>' . __e("Click on <strong>Activate</strong> and <strong>Run Importer</strong>") . '</li>';
$content_tags .= '<li>' . __e("Upload the <em>dummy.xml</em> file") . '</li>';
$content_tags .= '<li>' . __e("Click on <strong>Upload File and Import</strong>") . '</li>';
$content_tags .= '<li>' . __e("Select the User and checked on <em>Download and import file attachments</em>") . '</li>';
$content_tags .= '<li>' . __e("Click on <strong>Submit</strong> button and wait until all the data imported") . '</li>';
$content_tags .= '</ul>';

$content_tags .= '</div>'; //card-body
$content_tags .= '<div class="card-footer">';
$content_tags .= '<a target="_blank" href="./?p=wxrFile&a=download" class="btn btn-success btn-flat"><i class="fas fa-download"></i>&nbsp;' . __e("Download") . '</a>';
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card

define('IHS_LAYOUT_CONTENT', $content_tags);
define('IHS_LAYOUT_BREADCRUMB', $breadcrumb_tags);
define('IHS_PAGE_NAME', __e("WXR File"));
define('IHS_PAGE_DESC', __e("WordPress Extended RSS"));
define('IHS_PAGE_JS', $pagejs);

?>