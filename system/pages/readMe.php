<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 */

defined('IHS_EXEC') or die('Silent is golden!');

$db = new DB();
$current_project = $db->getProject();


if ($current_project != null)
{

}

if (isset($_POST['submit']))
{
    // validate and save postdata
    $db->saveReadMe($_POST['readme']);
    $db->current();
    
    $_SESSION['CURRENT_PROJECT_NOTICE'] = __e('Data saved successfully!');
    header('Location: ./?p=readMe&a=list&alert=success&' . time());
}

$currentData['readme'] = $db->getReadMe();

 

$breadcrumb_tags = $content_tags = $_content_tags = null;
$breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
$breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
$breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("Read Me") . '</li>';
$breadcrumb_tags .= '</ol>';


$content_tags .= '<form action="" method="post">';
$content_tags .= '<div class="row">';

// TODO: LAYOUT --|-- GENERAL
if (!isset($currentData['readme']['long-description']))
{
    $currentData['readme']['long-description'] = $current_project['description'];
}

if (!isset($currentData['readme']['installation']))
{
    $currentData['readme']['installation'] = "";
    $currentData['readme']['installation'] .= "1. Unzip the plugin archive on your computer" . "\r\n";
    $currentData['readme']['installation'] .= "2. Upload `" . $current_project['prefix'] . "` directory to yours `/wp-content/plugins/` directory" . "\r\n";
    $currentData['readme']['installation'] .= "3. Activate the plugin through the 'Plugins' menu in WordPress" . "\r\n";
}

if (!isset($currentData['readme']['faq']))
{
    $currentData['readme']['faq'] = "";
    $currentData['readme']['faq'] .= "**What is " . $current_project['project-name'] . "? **" . "\r\n";
    $currentData['readme']['faq'] .= "" . $current_project['project-name'] . " is a brand-new .... for the WordPress platform" . "\r\n";
}

if (!isset($currentData['readme']['change-log']))
{
    $currentData['readme']['change-log'] = "";
    $currentData['readme']['change-log'] .= "= 1.0.1 =" . "\r\n";
    $currentData['readme']['change-log'] .= "* Initial release." . "\r\n";
}

if (!isset($currentData['readme']['upgrade-notice']))
{
    $currentData['readme']['upgrade-notice'] = "";
}


$content_tags .= '<div class="col-md-6">';
$content_tags .= '<div class="card card-outline card-primary">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-th"></i>&nbsp;';
$content_tags .= 'General';
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- GENERAL --|-- FORM
$content_tags .= '<div class="card-body">';

$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $current_project['prefix'] . '/readme.txt</code></p>';


// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- LONG-DESCRIPTION
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="long-description" class="col-sm-12 col-form-label">' . __e("Long Description") . '</label>';
$content_tags .= '<div class="col-sm-12">';
$content_tags .= '<textarea data-type="markdown" class="form-control" name="readme[long-description]" >' . htmlentities($currentData['readme']['long-description']) . '</textarea>';
$content_tags .= '<p class="help-block">' . __e("Plugin full description, written in <code>markdown</code> format.") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- INSTALLATION
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="installation" class="col-sm-12 col-form-label">' . __e("Installation") . '</label>';
$content_tags .= '<div class="col-sm-12">';
$content_tags .= '<textarea data-type="markdown" class="form-control" name="readme[installation]" >' . htmlentities($currentData['readme']['installation']) . '</textarea>';
$content_tags .= '<p class="help-block">' . __e("Plugin installation instruction, written in <code>markdown</code> format.") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- FAQ
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="faq" class="col-sm-12 col-form-label">' . __e("FAQ") . '</label>';
$content_tags .= '<div class="col-sm-12">';
$content_tags .= '<textarea data-type="markdown" class="form-control" name="readme[faq]" >' . htmlentities($currentData['readme']['faq']) . '</textarea>';
$content_tags .= '<p class="help-block">' . __e("Plugin frequently asked questions, written in <code>markdown</code> format.") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- CHANGE-LOG
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="change-log" class="col-sm-12 col-form-label">' . __e("Change Log") . '</label>';
$content_tags .= '<div class="col-sm-12">';
$content_tags .= '<textarea data-type="markdown" class="form-control" name="readme[change-log]" >' . htmlentities($currentData['readme']['change-log']) . '</textarea>';
$content_tags .= '<p class="help-block">' . __e("List versions from most recent at top to oldest at bottom, written in <code>markdown</code> format.") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- UPGRADE-NOTICE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="upgrade-notice" class="col-sm-12 col-form-label">' . __e("Upgrade Notice") . '</label>';
$content_tags .= '<div class="col-sm-12">';
$content_tags .= '<textarea data-type="markdown" class="form-control" name="readme[upgrade-notice]" maxlength="300">' . htmlentities($currentData['readme']['upgrade-notice']) . '</textarea>';
$content_tags .= '<p class="help-block">' . __e("Upgrade notices describe the reason a user should upgrade, written in <code>markdown</code> format.") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<h5>' . __e("Code References") . ':</h5>';
$content_tags .= '<ul>';
$content_tags .= '<li><p>'. '<a target="_blank" href="https://developer.wordpress.org/plugins/wordpress-org/how-your-readme-txt-works/">Plugin Handbook</a>'.'</p></li>';
$content_tags .= '</ul>';
$content_tags .= '</div>';


$content_tags .= '</div>';

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-primary btn-flat pull-left"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
$content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=readMe" class="btn btn-default btn-flat pull-right"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card

$content_tags .= '</div>'; //col-md-6
// TODO: LAYOUT --|-- GENERAL

// TODO: LAYOUT --|-- REQUIRED
if (!isset($currentData['readme']['requires-at-least']))
{
    $currentData['readme']['requires-at-least'] = "5.0";
}
if (!isset($currentData['readme']['tested-up-to']))
{
    $currentData['readme']['tested-up-to'] = "5.4";
}
if (!isset($currentData['readme']['stable-tag']))
{
    $currentData['readme']['stable-tag'] = "5.4";
}
if (!isset($currentData['readme']['required-php-version']))
{
    $currentData['readme']['required-php-version'] = "5.6";
}


$content_tags .= '<div class="col-md-6">';
$content_tags .= '<div class="card card-outline card-success">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fa fa-archive"></i>&nbsp;';
$content_tags .= 'Required';
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- REQUIRED --|-- FORM
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $current_project['prefix'] . '/readme.txt</code></p>';

// TODO: LAYOUT --|-- REQUIRED --|-- FORM --|-- REQUIRES-AT-LEAST
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="requires-at-least" class="col-sm-3 col-form-label">' . __e("WordPress version") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input type="text" name="readme[requires-at-least]"  class="form-control" id="requires-at-least" placeholder="5.0" value="' . $currentData['readme']['requires-at-least'] . '">';
$content_tags .= '<p class="help-block">' . __e("The lowest WordPress version the plugin will work on") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- REQUIRED --|-- FORM --|-- TESTED-UP-TO
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="tested-up-to" class="col-sm-3 col-form-label">' . __e("Tested up to") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input type="text" name="readme[tested-up-to]"  class="form-control" id="tested-up-to" placeholder="5.4" value="' . $currentData['readme']['tested-up-to'] . '">';
$content_tags .= '<p class="help-block">' . __e("The highest WordPress version the plugin test on") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- REQUIRED --|-- FORM --|-- STABLE-TAG
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="stable-tag" class="col-sm-3 col-form-label">' . __e("Stable tag") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input type="text" name="readme[stable-tag]"  class="form-control" id="stable-tag" placeholder="5.4" value="' . $currentData['readme']['stable-tag'] . '">';
$content_tags .= '<p class="help-block">' . __e("The subversion \"tag\" of the latest stable version in trunk folder") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- REQUIRED --|-- FORM --|-- REQUIRED-PHP-VERSION
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="required-php-version" class="col-sm-3 col-form-label">' . __e("PHP version") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input type="text" name="readme[required-php-version]"  class="form-control" id="required-php-version" placeholder="5.6" value="' . $currentData['readme']['required-php-version'] . '">';
$content_tags .= '<p class="help-block">' . __e("The lowest PHP version required to run the plugin") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<h5>' . __e("Code References") . ':</h5>';
$content_tags .= '<ul>';
$content_tags .= '<li><p>'. '<a target="_blank" href="https://developer.wordpress.org/plugins/wordpress-org/how-your-readme-txt-works/">Plugin Handbook</a>'.'</p></li>';
$content_tags .= '</ul>';
$content_tags .= '</div>';

$content_tags .= '</div>';

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-success btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
$content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=readMe" class="btn btn-default btn-flat pull-right"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card

// TODO: LAYOUT --|-- REQUIRED


// TODO: LAYOUT --|-- SCREENSHOT
if (!isset($currentData['readme']['screenshot-1']))
{
    $currentData['readme']['screenshot-1'] = "";
}
if (!isset($currentData['readme']['screenshot-2']))
{
    $currentData['readme']['screenshot-2'] = "";
}
if (!isset($currentData['readme']['screenshot-3']))
{
    $currentData['readme']['screenshot-3'] = "";
}


$content_tags .= '<div class="card card-outline card-secondary">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fa fa-images"></i>&nbsp;';
$content_tags .= 'Screenshot';
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- SCREENSHOT --|-- FORM
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $current_project['prefix'] . '/readme.txt</code></p>';
// TODO: LAYOUT --|-- SCREENSHOT --|-- FORM --|-- SCREENSHOT-1
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="screenshot-1" class="col-sm-3 col-form-label">' . __e("Screenshot #1") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="readme[screenshot-1]"  class="form-control" id="screenshot-1" placeholder="" value="' . $currentData['readme']['screenshot-1'] . '">';
$content_tags .= '<p class="help-block">' . __e("Screenshot description") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- SCREENSHOT --|-- FORM --|-- SCREENSHOT-2
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="screenshot-2" class="col-sm-3 col-form-label">' . __e("Screenshot #2") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="readme[screenshot-2]"  class="form-control" id="screenshot-2" placeholder="" value="' . $currentData['readme']['screenshot-2'] . '">';
$content_tags .= '<p class="help-block">' . __e("Screenshot description") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- SCREENSHOT --|-- FORM --|-- SCREENSHOT-3
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="screenshot-3" class="col-sm-3 col-form-label">' . __e("Screenshot #3") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="readme[screenshot-3]"  class="form-control" id="screenshot-3" placeholder="" value="' . $currentData['readme']['screenshot-3'] . '">';
$content_tags .= '<p class="help-block">' . __e("Screenshot description") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<h5>' . __e("Code References") . ':</h5>';
$content_tags .= '<ul>';
$content_tags .= '<li><p>'. '<a target="_blank" href="https://developer.wordpress.org/plugins/wordpress-org/how-your-readme-txt-works/">Plugin Handbook</a>'.'</p></li>';
$content_tags .= '</ul>';
$content_tags .= '</div>';

$content_tags .= '</div>';

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-secondary btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
$content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=readMe" class="btn btn-default btn-flat pull-right"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';

$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card

$content_tags .= '</div>'; //col-md-6
// TODO: LAYOUT --|-- SCREENSHOT


$content_tags .= '</div>'; //row
$content_tags .= '</form>'; //row

define('IHS_LAYOUT_CONTENT', $content_tags);
define('IHS_LAYOUT_BREADCRUMB', $breadcrumb_tags);
define('IHS_PAGE_NAME', __e("Read Me"));
define('IHS_PAGE_DESC', __e("Create custom readme.txt file"));

?>