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
$breadcrumb_tags = $content_tags = $_content_tags = $pagejs = null;

$t = 0;
$rules[$t]['name'] = 'Manual';
$rules[$t]['value'] = 'manual';
$rules[$t]['variable'] = '';
$rules[$t]['isset'] = 'none';

$t++;
$rules[$t]['name'] = 'Elementor';
$rules[$t]['value'] = 'elementor';
$rules[$t]['variable'] = 'ELEMENTOR_VERSION';
$rules[$t]['isset'] = 'not_defined';

$t++;
$rules[$t]['name'] = 'WooCommerce';
$rules[$t]['value'] = 'woocommerce';
$rules[$t]['variable'] = 'woocommerce/woocommerce.php';
$rules[$t]['isset'] = 'apply_filters';

$t++;
$rules[$t]['name'] = 'Visual Composer';
$rules[$t]['value'] = 'vcomposer';
$rules[$t]['variable'] = 'WPB_VC_VERSION';
$rules[$t]['isset'] = 'not_defined';

// TODO: ACTION --|-- SUBMIT --|--

if (isset($_POST['submit']))
{
    $postData['admin-notices']['name'] = ""; //text
    $postData['admin-notices']['note'] = ""; //text
    $postData['admin-notices']['is_set'] = "none"; //select
    $postData['admin-notices']['variable'] = ""; //text
    $postData['admin-notices']['message'] = ""; //textarea
    $postData['admin-notices']['message_type'] = "warning"; //select
    $postData['admin-notices']['type_generator'] = "auto"; //select
    $postData['admin-notices']['copy_to_custom_code'] = true; //boolean

    // edit
    if (isset($_GET["n"]))
    {
        $_POST["admin-notices"]["name"] = $_GET["n"];
    }

    // TODO: ACTION --|-- SUBMIT --|-- POST RESPONSE
    // text
    if (isset($_POST['admin-notices']['name']))
    {
        $postData['admin-notices']['name'] = $_POST['admin-notices']['name'];
    }

    // text
    if (isset($_POST['admin-notices']['determine']))
    {
        $postData['admin-notices']['determine'] = $_POST['admin-notices']['determine'];
    }

    // text
    if (isset($_POST['admin-notices']['custom-code']['notices']))
    {
        $postData['admin-notices']['custom-code']['notices'] = $_POST['admin-notices']['custom-code']['notices'];
    }
    // text
    if (isset($_POST['admin-notices']['custom-code']['construct']))
    {
        $postData['admin-notices']['custom-code']['construct'] = $_POST['admin-notices']['custom-code']['construct'];
    }

    // text
    if (isset($_POST['admin-notices']['note']))
    {
        $postData['admin-notices']['note'] = $_POST['admin-notices']['note'];
    }
    // select
    if (isset($_POST['admin-notices']['is_set']))
    {
        $postData['admin-notices']['is_set'] = $_POST['admin-notices']['is_set'];
    }
    // text
    if (isset($_POST['admin-notices']['variable']))
    {
        $postData['admin-notices']['variable'] = $_POST['admin-notices']['variable'];
    }
    // textarea
    if (isset($_POST['admin-notices']['message']))
    {
        $postData['admin-notices']['message'] = $_POST['admin-notices']['message'];
    }
    // select
    if (isset($_POST['admin-notices']['message_type']))
    {
        $postData['admin-notices']['message_type'] = $_POST['admin-notices']['message_type'];
    }
    // select
    if (isset($_POST['admin-notices']['type_generator']))
    {
        $postData['admin-notices']['type_generator'] = $_POST['admin-notices']['type_generator'];
    }
    // boolean
    if (isset($_POST['admin-notices']['copy_to_custom_code']))
    {
        $postData['admin-notices']['copy_to_custom_code'] = true;
    } else
    {
        $postData['admin-notices']['copy_to_custom_code'] = false;
    }


    // TODO: ACTION --|-- SUBMIT --|-- SAVE DATA

    // validate and save postdata
    $db->saveAdminNotice($postData['admin-notices']);
    $db->current();
    $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Admin-notices saved successfully!");
    if ($_GET["a"] == "edit")
    {
        header("Location: ./?p=adminNotices&a=edit&alert=success&n=" . $_GET["n"] . "&" . time());
    } else
    {
        header("Location: ./?p=adminNotices&a=list&alert=success&" . time());
    }
}


// TODO: ACTION --|-- REMOVE --|-- ADMIN-NOTICES
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "trash")
    {
        $_prefix = basename($_GET["n"]);
        $db->removeAdminNotice($_prefix);
        $db->current();
        $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Admin-notice deleted successfully!");
        header("Location: ./?p=adminNotices&a=list&alert=warning&" . time());
    }
}


// TODO: LAYOUT --|-- ADMIN NOTICES
$disabled = "";
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "edit")
    {
        $_prefix = basename($_GET["n"]);
        $currentData["admin-notices"] = $db->getAdminNotice($_prefix);
        $disabled = "disabled";
    }
}


// TODO: LAYOUT --|-- ADMIN NOTICES --|-- INIT
//text
if (!isset($currentData['admin-notices']['name']))
{
    $currentData['admin-notices']['name'] = "";
}
//text
if (!isset($currentData['admin-notices']['note']))
{
    $currentData['admin-notices']['note'] = "";
}
//select
if (!isset($currentData['admin-notices']['is_set']))
{
    $currentData['admin-notices']['is_set'] = "none";
}
//text
if (!isset($currentData['admin-notices']['variable']))
{
    $currentData['admin-notices']['variable'] = "";
}
//textarea
if (!isset($currentData['admin-notices']['message']))
{
    $currentData['admin-notices']['message'] = "";
}
//select
if (!isset($currentData['admin-notices']['message_type']))
{
    $currentData['admin-notices']['message_type'] = "warning";
}
//select
if (!isset($currentData['admin-notices']['type_generator']))
{
    $currentData['admin-notices']['type_generator'] = "auto";
}
//boolean
if (!isset($currentData['admin-notices']['copy_to_custom_code']))
{
    $currentData['admin-notices']['copy_to_custom_code'] = true;
}

if (!isset($currentData['admin-notices']['determine']))
{
    $currentData['admin-notices']['determine'] = "custom";
}

if (!isset($currentData['admin-notices']['custom-code']['construct']))
{
    $currentData['admin-notices']['custom-code']['construct'] = '';
}

if (!isset($currentData['admin-notices']['custom-code']['notices']))
{
    $currentData['admin-notices']['custom-code']['notices'] = '';
}

$content_tags .= '<form class="form-horizontal" action="" method="post">';
$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-6">';
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
// TODO: LAYOUT --|-- ADMIN NOTICES --|-- FORM
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/admin-notices.php</code></p>';
$content_tags .= '<hr/>';

// text
// TODO: LAYOUT --|-- ADMIN NOTICES --|-- FORM --|-- NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="name" class="col-sm-3 col-form-label">' . __e("Name") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input ' . $disabled . ' required type="text" name="admin-notices[name]"  class="form-control" id="field-name" placeholder="Elementor" value="' . $currentData['admin-notices']['name'] . '">';
$content_tags .= '<p class="help-block">' . __e("Name, must not exceed 20 characters and may only contain a-z, 0-9, and - characters") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- ADMIN NOTICES --|-- FORM --|-- NOTE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="note" class="col-sm-3 col-form-label">' . __e("Note") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<input  type="text" name="admin-notices[note]"  class="form-control" id="field-note" placeholder="This plugin requires elementor plugin to be installed" value="' . $currentData['admin-notices']['note'] . '">';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="variable" class="col-sm-3 col-form-label">' . __e("Rule") . '</label>';
$content_tags .= '<div class="col-sm-9">';

$content_tags .= '<select class="form-control" name="admin-notices[determine]" id="field-determine">';

foreach ($rules as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['admin-notices']['determine'])
    {
        $selected = "selected";
    }
    $content_tags .= '<option ' . $selected . ' value="' . $opt["value"] . '">' . $opt["name"] . '</option>';
}

$content_tags .= '</select>';

$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-6">';

// select
// TODO: LAYOUT --|-- ADMIN NOTICES --|-- FORM --|-- IS_SET
$content_tags .= '<div class="form-group">';
$content_tags .= '<label for="is_set" class="col-form-label">' . __e("Determine") . '</label>';
$content_tags .= '<select name="admin-notices[is_set]" class="form-control" id="field-is_set">';

$options = array();
$options[] = array("value" => "none", "label" => "All");
$options[] = array("value" => "isset", "label" => "Isset Variable?");
$options[] = array("value" => "defined", "label" => "Defined Constant?");
$options[] = array("value" => "not_isset", "label" => "Not Isset Variable?");
$options[] = array("value" => "not_defined", "label" => "Not Defined Constant?");
$options[] = array("value" => "apply_filters", "label" => "apply filters?");


foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['admin-notices']['is_set'])
    {
        $selected = "selected";
    }
    $content_tags .= '<option ' . $selected . ' value="' . $opt["value"] . '">' . $opt["label"] . '</option>';
}
$content_tags .= '</select>';
$content_tags .= '<p class="help-block">' . __e("Detector type: isset variable or defined constant") . '</p>';
$content_tags .= '</div>';


$content_tags .= '</div>';
$content_tags .= '<div class="col-md-6">';

// text
// TODO: LAYOUT --|-- ADMIN NOTICES --|-- FORM --|-- VARIABLE
$content_tags .= '<div class="form-group">';
$content_tags .= '<label for="variable" class="col-form-label">' . __e("Variable/Constant") . '</label>';
$content_tags .= '<input  type="text" name="admin-notices[variable]"  class="form-control" id="field-variable" placeholder="ELEMENTOR_VERSION" value="' . $currentData['admin-notices']['variable'] . '">';
$content_tags .= '<p class="help-block">' . __e("Write the value of the variable/constant") . '</p>';
$content_tags .= '</div>';

$content_tags .= '</div>';
$content_tags .= '</div>';


$content_tags .= '</div>';
$content_tags .= '</div>';


// select
// TODO: LAYOUT --|-- ADMIN NOTICES --|-- FORM --|-- MESSAGE_TYPE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="message_type" class="col-sm-3 col-form-label">' . __e("Message Type") . '</label>';
$content_tags .= '<div class="col-sm-3">';
$content_tags .= '<select name="admin-notices[message_type]" class="form-control" id="field-message_type">';
$options = array();
$options[] = array("value" => "updated", "label" => "Success");
$options[] = array("value" => "error", "label" => "Error");

foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['admin-notices']['message_type'])
    {
        $selected = "selected";
    }
    $content_tags .= '<option ' . $selected . ' value="' . $opt["value"] . '">' . $opt["label"] . '</option>';
}
$content_tags .= '</select>';
$content_tags .= '<p class="help-block">' . __e("Class name on message") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// textarea
// TODO: LAYOUT --|-- ADMIN NOTICES --|-- FORM --|-- MESSAGE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="message" class="col-sm-3 col-form-label">' . __e("Message") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<textarea required class="form-control" name="admin-notices[message]" >' . $currentData['admin-notices']['message'] . '</textarea>';
$content_tags .= '<p class="help-block">' . __e("Write a message to be displayed, eg: ") . '<code> %s requires blabla plugin to be installed and activated on your site. </code></p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

$content_tags .= '<hr>';


// select
// TODO: LAYOUT --|-- ADMIN NOTICES --|-- FORM --|-- TYPE_GENERATOR
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="type_generator" class="col-sm-3 col-form-label">' . __e("Types of Generator") . '</label>';
$content_tags .= '<div class="col-sm-4">';
$content_tags .= '<select name="admin-notices[type_generator]" class="form-control" id="field-type_generator">';
$options = array();
$options[] = array("value" => "auto", "label" => "Auto");
$options[] = array("value" => "custom-code", "label" => "Custom-code");
foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['admin-notices']['type_generator'])
    {
        $selected = "selected";
    }
    $content_tags .= '<option ' . $selected . ' value="' . $opt["value"] . '">' . $opt["label"] . '</option>';
}
$content_tags .= '</select>';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// boolean
// TODO: LAYOUT --|-- ADMIN NOTICES --|-- FORM --|-- COPY_TO_CUSTOM_CODE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="copy_to_custom_code" class="col-sm-3 col-form-label">' . __e("Copy To Custom Code") . '</label>';
$content_tags .= '<div class="col-sm-9">';
if ($currentData['admin-notices']['copy_to_custom_code'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="admin-notices[copy_to_custom_code]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="admin-notices[copy_to_custom_code]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("This will overwrite your custom code, this is useful if you need code samples.") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=adminNotices" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=adminNotices" class="btn btn-default btn-flat pull-right"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


$content_tags .= '</div>'; //col-md-6


$content_tags .= '<div class="col-md-6">';


$content_tags .= '<div class="card card-outline card-danger">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-question-circle"></i>&nbsp;';
$content_tags .= __e("Instructions");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|--
$content_tags .= '<div class="card-body">';

$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<h5>' . __e("Code References") . ':</h5>';
$content_tags .= '<ul>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/hooks/admin_notices/">admin_notices</a>' . '</p></li>';
$content_tags .= '</ul>';
$content_tags .= '</div>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=adminNotices" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=adminNotices" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card

$content_tags .= '</div>'; //col-md-6
$content_tags .= '</div>'; //row


$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-12">';


$content_tags .= '<div class="card card-outline card-success">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fab fa-php"></i>&nbsp;';
$content_tags .= __e("Custom Codes");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|--
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/admin-notices.php</code></p>';
$content_tags .= '<hr/>';

$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<p>' . __e("To use this feature you must change the General Settings: ") . '<strong>Types of Generator = <code>Custom Code</code></strong>' . __e(' and ') . '<strong>Copy To Custom Code = <code>OFF</code></strong></p>';
$content_tags .= '</div>';

$content_tags .= '<h3>';
$content_tags .= __e("Construct");
$content_tags .= '</h3>';
$content_tags .= '<textarea name="admin-notices[custom-code][construct]" class="form-control" data-type="php">' . htmlentities($currentData['admin-notices']['custom-code']['construct']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';


$content_tags .= '<h3>';
$content_tags .= __e("Admin Notices");
$content_tags .= '</h3>';
$content_tags .= '<textarea name="admin-notices[custom-code][notices]" class="form-control" data-type="php">' . htmlentities($currentData['admin-notices']['custom-code']['notices']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-success btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=adminNotices" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=adminNotices" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card

$content_tags .= '</div>'; //col-md-12
$content_tags .= '</div>'; //row


$content_tags .= '</form>';
// TODO: LAYOUT --|-- ADMIN NOTICES
switch ($_GET["a"])
{
    case "list":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=adminNotices">' . __e("Admin Notices") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("List") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags .= '<div class="card card-outline card-info">';
        $_content_tags .= '<div class="card-body">';

        $_content_tags .= '<div class="welcome">';
        $_content_tags .= '<h2>' . __e('Back-end') . '</h2>';
        $_content_tags .= '<h1>' . __e('Admin Notices') . '</h1>';
        $_content_tags .= '<p class="lead">' . __e('Display notice that a plugin/templates is required') . '</p>';
        $_content_tags .= '</div>';

        // TODO: LIST --|-- TABLE
        $_content_tags .= '<table data-type="datatable" class="table datatable table-bordered">';
        $_content_tags .= '<thead>';
        $_content_tags .= '<tr>';
        $_content_tags .= '<th>' . __e("Name") . '</th>';
        $_content_tags .= '<th>' . __e("Note") . '</th>';
        $_content_tags .= '<th>' . __e("Type") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Action") . '</th>';
        $_content_tags .= '</tr>';
        $_content_tags .= '</thead>';
        $_content_tags .= '<tbody>';
        $admin_notices = $db->getAdminNotices();
        foreach ($admin_notices as $admin_notice)
        {
            $_content_tags .= '<tr>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $admin_notice['name'] . '</code></td>';
            $_content_tags .= '<td><em>' . $admin_notice['note'] . '</em></td>';

            switch ($admin_notice['message_type'])
            {
                case 'error':
                    $_content_tags .= '<td><span class="badge badge-danger">' . $admin_notice['message_type'] . '</span></td>';
                    break;
                case 'updated':
                    $_content_tags .= '<td><span class="badge badge-success">' . $admin_notice['message_type'] . '</span></td>';
                    break;
            }

            $_content_tags .= '<td class="text-center align-middle">';
            $_content_tags .= '<div class="btn-group btn-group-sm">';
            $_content_tags .= '<a href="#' . $admin_notice['name'] . '" data-toggle="modal" data-target="#modal-trash-admin-notices-' . $admin_notice['name'] . '" data-href="./?p=adminNotices&amp;a=trash&amp;n=' . $admin_notice['name'] . '" class="btn btn-danger"><i class="fa fa-trash"></i> ' . __e("Trash") . '</a>';
            $_content_tags .= '<a href="./?p=adminNotices&amp;a=edit&amp;n=' . $admin_notice['name'] . '" class="btn btn-success"><i class="fa fa-edit"></i> ' . __e("Edit") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</td>';
            $_content_tags .= '</tr>';
        }
        $_content_tags .= '</tbody>';
        $_content_tags .= '</table>';
        $_content_tags .= '</div>';
        $_content_tags .= '<div class="card-footer">';
        $_content_tags .= '<a href="./?p=adminNotices&amp;a=new" class="btn btn-success"><i class="fa fa-plus-circle"></i> ' . __e("Add New Admin Notices") . '</a>';
        $_content_tags .= '</div>';
        $_content_tags .= '</div>';
        // TODO: LIST --|-- MODAL
        foreach ($admin_notices as $admin_notice)
        {
            $_content_tags .= '<div class="modal fade" id="modal-trash-admin-notices-' . $admin_notice['name'] . '">';
            $_content_tags .= '<div class="modal-dialog">';
            $_content_tags .= '<div class="modal-content bg-default">';
            $_content_tags .= '<div class="modal-header">';
            $_content_tags .= '<h4 class="modal-title">' . __e("Confirm") . '</h4>';
            $_content_tags .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            $_content_tags .= '<span aria-hidden="true">&times;</span></button>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-body">';
            $_content_tags .= '<p>' . __e("Are you sure You want to delete this Admin Notice?") . '</p>';
            $_content_tags .= '<table class="table-grid">';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td rowspan="4" style="text-align: center;"><i class="fas fa-bell trash-logo"></i></td>';
            $_content_tags .= '<td>' . __e("Name") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $admin_notice['name'] . '</code></td>';
            $_content_tags .= '</tr>';

            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Type") . '</td>';
            $_content_tags .= '<td>:</td>';

            switch ($admin_notice['message_type'])
            {
                case 'error':
                    $_content_tags .= '<td><span class="badge badge-danger">' . $admin_notice['message_type'] . '</span></td>';
                    break;
                case 'updated':
                    $_content_tags .= '<td><span class="badge badge-success">' . $admin_notice['message_type'] . '</span></td>';
                    break;
            }
            $_content_tags .= '</tr>';

            $_content_tags .= '</table>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-footer justify-content-between">';
            $_content_tags .= '<button type="button" class="btn btn-default" data-dismiss="modal">' . __e("Close") . '</button>';
            $_content_tags .= '<a href="./?p=adminNotices&amp;a=trash&amp;n=' . $admin_notice['name'] . '" class="btn btn-danger">' . __e("Yes, I am sure!") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
        }

        break;
    case "new":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=adminNotices">' . __e("Admin Notices") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("New") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
    case "edit":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=adminNotices">' . __e("Admin Notices") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("Edit") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
}
$pagejs .= "\t" . '' . "\r\n";

$pagejs .= "\t" . '$("#field-determine").click(function(){' . "\r\n";
$pagejs .= "\t\t" . 'setDetermine(this.value);' . "\r\n";
$pagejs .= "\t" . '});' . "\r\n";
$pagejs .= "\t" . '' . "\r\n";
$pagejs .= "\t" . 'function setDetermine(val){' . "\r\n";
$pagejs .= "\t\t" . 'switch(val){' . "\r\n";
foreach ($rules as $rule)
{
    $pagejs .= "\t\t\t" . 'case "' . $rule['value'] . '":' . "\r\n";
    $pagejs .= "\t\t\t\t" . '$("#field-variable").val("' . $rule['variable'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t" . '$("#field-is_set").val("' . $rule['isset'] . '").change();' . "\r\n";
    $pagejs .= "\t\t\t" . 'break;' . "\r\n";
}
$pagejs .= "\t\t" . '}' . "\r\n";
$pagejs .= "\t" . '}' . "\r\n";

define('IHS_LAYOUT_CONTENT', $_content_tags);
define('IHS_LAYOUT_BREADCRUMB', $breadcrumb_tags);
define('IHS_PAGE_NAME', __e("Admin Notices"));
define('IHS_PAGE_DESC', __e("Admin Screen Notices"));
define('IHS_PAGE_JS', $pagejs);

?>