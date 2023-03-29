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
$breadcrumb_tags = $content_tags = $_content_tags = null;


// TODO: ACTION --|-- SUBMIT --|--

if (isset($_POST['submit']))
{
    $postData['admin-bars']['name'] = ""; //text
    $postData['admin-bars']['title'] = ""; //text
    $postData['admin-bars']['url'] = "#"; //text
    $postData['admin-bars']['parent'] = "root"; //select
    $postData['admin-bars']['url_type'] = "external-url"; //select

    // TODO: ACTION --|-- SUBMIT --|-- POST RESPONSE

    // edit
    if (isset($_GET["n"]))
    {
        $_POST["admin-bars"]["name"] = $_GET["n"];
    }

    // text
    if (isset($_POST['admin-bars']['name']))
    {
        $postData['admin-bars']['name'] = $_POST['admin-bars']['name'];
    }


    // text
    if (isset($_POST['admin-bars']['title']))
    {
        $postData['admin-bars']['title'] = $_POST['admin-bars']['title'];
    }
    // text
    if (isset($_POST['admin-bars']['url']))
    {
        $postData['admin-bars']['url'] = $_POST['admin-bars']['url'];
    }
    // select
    if (isset($_POST['admin-bars']['parent']))
    {
        $postData['admin-bars']['parent'] = $_POST['admin-bars']['parent'];
    }
    // select
    if (isset($_POST['admin-bars']['url_type']))
    {
        $postData['admin-bars']['url_type'] = $_POST['admin-bars']['url_type'];
    }

    // TODO: ACTION --|-- SUBMIT --|-- SAVE DATA

    // validate and save postdata
    $db->saveAdminBar($postData['admin-bars']);
    $db->current();
    $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Admin-bars saved successfully!");
    if ($_GET["a"] == "edit")
    {
        header("Location: ./?p=adminBars&a=edit&alert=success&n=" . $_GET["n"] . "&" . time());
    } else
    {
        header("Location: ./?p=adminBars&a=list&alert=success&" . time());
    }
}


// TODO: ACTION --|-- REMOVE --|-- ADMIN-BARS
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "trash")
    {
        $_prefix = basename($_GET["n"]);
        $db->removeAdminBar($_prefix);
        $db->current();
        $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Admin-bar deleted successfully!");
        header("Location: ./?p=adminBars&a=list&alert=warning&" . time());
    }
}


// TODO: LAYOUT --|-- GENERAL
$disabled = "";
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "edit")
    {
        $_prefix = basename($_GET["n"]);
        $currentData["admin-bars"] = $db->getAdminBar($_prefix);
        $disabled = "disabled";
    }
}


// TODO: LAYOUT --|-- GENERAL --|-- INIT
//text
if (!isset($currentData['admin-bars']['name']))
{
    $currentData['admin-bars']['name'] = "";
}
//text
if (!isset($currentData['admin-bars']['title']))
{
    $currentData['admin-bars']['title'] = "";
}
//text
if (!isset($currentData['admin-bars']['url']))
{
    $currentData['admin-bars']['url'] = "#";
}
//select
if (!isset($currentData['admin-bars']['parent']))
{
    $currentData['admin-bars']['parent'] = "root";
}

//select
if (!isset($currentData['admin-bars']['url_type']))
{
    $currentData['admin-bars']['url_type'] = "external-url";
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
// TODO: LAYOUT --|-- GENERAL --|-- FORM
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/admin-bars.php</code></p>';
$content_tags .= '<hr/>';

// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="name" class="col-sm-3 col-form-label">' . __e("Name") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input ' . $disabled . ' required type="text" name="admin-bars[name]"  class="form-control" id="field-name" placeholder="donate" value="' . $currentData['admin-bars']['name'] . '">';
$content_tags .= '<p class="help-block">' . __e("Only contain a-z, 0-9, and - characters") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- TITLE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="title" class="col-sm-3 col-form-label">' . __e("Title") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input required type="text" name="admin-bars[title]"  class="form-control" id="field-title" placeholder="Donate" value="' . $currentData['admin-bars']['title'] . '">';
$content_tags .= '<p class="help-block">' . __e("The text that will be visible in the Toolbar. Including html tags is allowed") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// select
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- URL_TYPE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="url_type" class="col-sm-3 col-form-label">' . __e("URL Type") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<select name="admin-bars[url_type]" class="form-control" id="field-url_type">';
$options = array();
$options[] = array("value" => "none", "label" => "None");
$options[] = array("value" => "wordpress-url", "label" => "WordPress URL");
$options[] = array("value" => "external-url", "label" => "External URL");
$options[] = array("value" => "plugin-url", "label" => "Plugin URL");
$options[] = array("value" => "admin-url", "label" => "Admin URL");


foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['admin-bars']['url_type'])
    {
        $selected = "selected";
    }
    $content_tags .= '<option ' . $selected . ' value="' . $opt["value"] . '">' . $opt["label"] . '</option>';
}
$content_tags .= '</select>';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- URL
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="url" class="col-sm-3 col-form-label">' . __e("URL") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<input required type="text" name="admin-bars[url]"  class="form-control" id="field-url" placeholder="admin.php?page=custom-page" value="' . $currentData['admin-bars']['url'] . '">';
$content_tags .= '<p class="help-block">' . __e("The href attribute for the link") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// select
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- PARENT
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="parent" class="col-sm-3 col-form-label">' . __e("Parent") . '</label>';
$content_tags .= '<div class="col-sm-7">';
$content_tags .= '<select name="admin-bars[parent]" class="form-control" id="field-parent">';


$options = array();
$options[] = array("value" => "root", "label" => "- root");
$admin_bars = $db->getAdminBars();
foreach ($admin_bars as $admin_bar)
{
    if ($admin_bar['name'] != $currentData['admin-bars']['name'])
    {
        $options[] = array("value" => $admin_bar['name'], "label" => '-- ' . $admin_bar['name'] . ' [' . $admin_bar['title'] . ']');
    }
}
foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['admin-bars']['parent'])
    {
        $selected = "selected";
    }
    $content_tags .= '<option ' . $selected . ' value="' . $opt["value"] . '">' . ($opt["label"]) . '</option>';
}
$content_tags .= '</select>';
$content_tags .= '<p class="help-block">' . __e("The ID of the parent node") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=adminBars" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=adminBars" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
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
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/admin-bars.php</code></p>';
$content_tags .= '<hr/>';

$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<h5>' . __e("Code References") . ':</h5>';
$content_tags .= '<ul>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/hooks/admin_bar_menu/">admin_bar_menu</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/classes/wp_admin_bar/add_menu/">add_menu</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/plugins_url/">plugins_url</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/admin_url/">admin_url</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/site_url/">site_url</a>' . '</p></li>';
$content_tags .= '</ul>';
$content_tags .= '</div>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=adminBars" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=adminBars" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card
$content_tags .= '</div>'; //col-md-6
$content_tags .= '</div>'; //row
$content_tags .= '</form>';
// TODO: LAYOUT --|-- GENERAL
switch ($_GET["a"])
{
    case "list":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=adminBars">' . __e("Admin Bars") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("List") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags .= '<div class="card card-outline card-info">';
        $_content_tags .= '<div class="card-body">';

        $_content_tags .= '<div class="welcome">';
        $_content_tags .= '<h2>' . __e('Navigation') . '</h2>';
        $_content_tags .= '<h1>' . __e('Admin Bars') . '</h1>';
        $_content_tags .= '<p class="lead">' . __e('Used to add, remove, or manipulate admin bar items') . '</p>';
        $_content_tags .= '</div>';

        // TODO: LIST --|-- TABLE
        $_content_tags .= '<table data-type="datatable" class="table datatable table-bordered">';
        $_content_tags .= '<thead>';
        $_content_tags .= '<tr>';
        $_content_tags .= '<th>' . __e("Name") . '</th>';
        $_content_tags .= '<th>' . __e("Title") . '</th>';
        $_content_tags .= '<th>' . __e("URL") . '</th>';
        $_content_tags .= '<th>' . __e("Parent") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Action") . '</th>';
        $_content_tags .= '</tr>';
        $_content_tags .= '</thead>';
        $_content_tags .= '<tbody>';
        $admin_bars = $db->getAdminBars();
        foreach ($admin_bars as $admin_bar)
        {
            $_content_tags .= '<tr>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $admin_bar['name'] . '</code></td>';
            $_content_tags .= '<td><strong>' . $admin_bar['title'] . '</strong></td>';
            $_content_tags .= '<td>' . $admin_bar['url'] . '</td>';
            $_content_tags .= '<td>' . $admin_bar['parent'] . '</td>';
            $_content_tags .= '<td class="text-center align-middle">';
            $_content_tags .= '<div class="btn-group btn-group-sm">';
            $_content_tags .= '<a href="#' . $admin_bar['name'] . '" data-toggle="modal" data-target="#modal-trash-admin-bars-' . $admin_bar['name'] . '" data-href="./?p=adminBars&amp;a=trash&amp;n=' . $admin_bar['name'] . '" class="btn btn-danger"><i class="fa fa-trash"></i> ' . __e("Trash") . '</a>';
            $_content_tags .= '<a href="./?p=adminBars&amp;a=edit&amp;n=' . $admin_bar['name'] . '" class="btn btn-success"><i class="fa fa-edit"></i> ' . __e("Edit") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</td>';
            $_content_tags .= '</tr>';
        }
        $_content_tags .= '</tbody>';
        $_content_tags .= '</table>';
        $_content_tags .= '</div>';
        $_content_tags .= '<div class="card-footer">';
        $_content_tags .= '<a href="./?p=adminBars&amp;a=new" class="btn btn-success"><i class="fa fa-plus-circle"></i> ' . __e("Add New Admin Bars") . '</a>';
        $_content_tags .= '</div>';
        $_content_tags .= '</div>';
        // TODO: LIST --|-- MODAL
        foreach ($admin_bars as $admin_bar)
        {
            $_content_tags .= '<div class="modal fade" id="modal-trash-admin-bars-' . $admin_bar['name'] . '">';
            $_content_tags .= '<div class="modal-dialog">';
            $_content_tags .= '<div class="modal-content bg-default">';
            $_content_tags .= '<div class="modal-header">';
            $_content_tags .= '<h4 class="modal-title">' . __e("Confirm") . '</h4>';
            $_content_tags .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            $_content_tags .= '<span aria-hidden="true">&times;</span></button>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-body">';
            $_content_tags .= '<p>' . __e("Are you sure You want to delete this admin-bar item?") . '</p>';
            $_content_tags .= '<table class="table-grid">';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td rowspan="4" style="text-align: center;"><i class="fas fa-link trash-logo"></i></td>';
            $_content_tags .= '<td>' . __e("Name") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $admin_bar['name'] . '</code></td>';
            $_content_tags .= '</tr>';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("URL") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td>' . $admin_bar['url'] . '</td>';
            $_content_tags .= '</tr>';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Parent") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td>' . $admin_bar['parent'] . '</td>';
            $_content_tags .= '</tr>';
            $_content_tags .= '</table>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-footer justify-content-between">';
            $_content_tags .= '<button type="button" class="btn btn-default" data-dismiss="modal">' . __e("Close") . '</button>';
            $_content_tags .= '<a href="./?p=adminBars&amp;a=trash&amp;n=' . $admin_bar['name'] . '" class="btn btn-danger">' . __e("Yes, I am sure!") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
        }

        break;
    case "new":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=adminBars">' . __e("Admin Bars") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("New") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
    case "edit":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=adminBars">' . __e("Admin Bars") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("Edit") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
}


define('IHS_LAYOUT_CONTENT', $_content_tags);
define('IHS_LAYOUT_BREADCRUMB', $breadcrumb_tags);
define('IHS_PAGE_NAME', __e("Admin Bars"));
define('IHS_PAGE_DESC', __e("Used to add, remove, or manipulate admin bar items"));

?>