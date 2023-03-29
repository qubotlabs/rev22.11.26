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
$_prefix = 'undefined';

// TODO: ACTION --|-- SUBMIT --|--

if (isset($_POST['submit']))
{
    $postData['raw-php-codes']['name'] = ""; //text
    $postData['raw-php-codes']['note'] = ""; //text
    $postData['raw-php-codes']['function'] = "include"; //select

    // edit
    if (isset($_GET["n"]))
    {
        $_POST["raw-php-codes"]["name"] = $_GET["n"];
    }

    // TODO: ACTION --|-- SUBMIT --|-- POST RESPONSE
    // text
    if (isset($_POST['raw-php-codes']['name']))
    {
        $postData['raw-php-codes']['name'] = $_POST['raw-php-codes']['name'];
    }
    // text
    if (isset($_POST['raw-php-codes']['note']))
    {
        $postData['raw-php-codes']['note'] = $_POST['raw-php-codes']['note'];
    }
    // select
    if (isset($_POST['raw-php-codes']['function']))
    {
        $postData['raw-php-codes']['function'] = $_POST['raw-php-codes']['function'];
    }


    // TODO: ACTION --|-- SUBMIT --|-- SAVE DATA
    
    // validate and save postdata
    $db->saveRawPhpCode($postData['raw-php-codes']);
    $db->current();
    $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Raw-php-codes saved successfully!");
    if ($_GET["a"] == "edit")
    {
        header("Location: ./?p=rawPhpCodes&a=edit&alert=success&n=" . $_GET["n"] . "&" . time());
    } else
    {
        header("Location: ./?p=rawPhpCodes&a=list&alert=success&" . time());
    }
}


// TODO: ACTION --|-- REMOVE --|-- RAW-PHP-CODES
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "trash")
    {
        $_prefix = basename($_GET["n"]);
        $db->removeRawPhpCode($_prefix);
        $db->current();
        $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Raw-php-code deleted successfully!");
        header("Location: ./?p=rawPhpCodes&a=list&alert=warning&" . time());
    }
}


// TODO: LAYOUT --|-- RAW PHP CODES
$disabled = "";
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "edit")
    {
        $_prefix = basename($_GET["n"]);
        $currentData["raw-php-codes"] = $db->getRawPhpCode($_prefix);
        $disabled = "disabled";
    }
}


// TODO: LAYOUT --|-- RAW PHP CODES --|-- INIT
//text
if (!isset($currentData['raw-php-codes']['name']))
{
    $currentData['raw-php-codes']['name'] = "";
}
//text
if (!isset($currentData['raw-php-codes']['note']))
{
    $currentData['raw-php-codes']['note'] = "";
}
//select
if (!isset($currentData['raw-php-codes']['function']))
{
    $currentData['raw-php-codes']['function'] = "include";
}


$content_tags .= '<form class="form-horizontal" action="" method="post">';
$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-6">';
$content_tags .= '<div class="card card-outline card-primary">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-th"></i>&nbsp;';
$content_tags .= __e("RAW PHP Codes");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- RAW PHP CODES --|-- FORM
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/php-codes/'.$_prefix.'.php</code></p>';
$content_tags .= '<hr/>';

// text
// TODO: LAYOUT --|-- RAW PHP CODES --|-- FORM --|-- NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="name" class="col-sm-3 col-form-label">' . __e("name") . '</label>';
$content_tags .= '<div class="col-sm-5">';
$content_tags .= '<input ' . $disabled . ' required type="text" name="raw-php-codes[name]"  class="form-control" id="field-name" placeholder="name" value="' . $currentData['raw-php-codes']['name'] . '">';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- RAW PHP CODES --|-- FORM --|-- NOTE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="note" class="col-sm-3 col-form-label">' . __e("Note") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<input  type="text" name="raw-php-codes[note]"  class="form-control" id="field-note" placeholder="" value="' . $currentData['raw-php-codes']['note'] . '">';
$content_tags .= '<p class="help-block">' . __e("Just additional note") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// select
// TODO: LAYOUT --|-- RAW PHP CODES --|-- FORM --|-- FUNCTION
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="function" class="col-sm-3 col-form-label">' . __e("Function") . '</label>';
$content_tags .= '<div class="col-sm-4">';
$content_tags .= '<select name="raw-php-codes[function]" class="form-control" id="field-function">';
$options = array();
$options[] = array("value" => "include", "label" => "include");
$options[] = array("value" => "include_once", "label" => "include_once");
$options[] = array("value" => "require", "label" => "require");
$options[] = array("value" => "require_once", "label" => "require_once");
foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['raw-php-codes']['function'])
    {
        $selected = "selected";
    }
    $content_tags .= '<option ' . $selected . ' value="' . $opt["value"] . '">' . $opt["label"] . '</option>';
}
$content_tags .= '</select>';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=rawPhpCodes" class="btn btn-default btn-flat pull-right"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
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
$content_tags .= '<div class="callout callout-success">All files in the <strong>wp-content/plugins/' . $project['prefix'] . '/incl/php-codes/</strong> folder will not be overwrite. So you can edit it using VS Code or using any other editor.</div>';
$content_tags .= '<p>The following files are included in your plugin:<br/><code>wp-content/plugins/' . $project['prefix'] . '/incl/php-codes/'.$_prefix.'.php</code></p>';
$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=rawPhpCodes" class="btn btn-default btn-flat pull-right"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card
$content_tags .= '</div>'; //col-md-6
$content_tags .= '</div>'; //row
$content_tags .= '</form>';
// TODO: LAYOUT --|-- RAW PHP CODES
switch ($_GET["a"])
{
    case "list":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=rawPhpCodes">' . __e("RAW PHP Codes") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("List") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags .= '<div class="card card-outline card-info">';
        $_content_tags .= '<div class="card-body">';

        $_content_tags .= '<div class="welcome">';
        $_content_tags .= '<h2>' . __e('Custom Code') . '</h2>';
        $_content_tags .= '<h1>' . __e('RAW PHP Codes') . '</h1>';
        $_content_tags .= '<p class="lead">' . __e('Include your PHP Files') . '</p>';
        $_content_tags .= '</div>';

        // TODO: LIST --|-- TABLE
        $_content_tags .= '<table data-type="datatable" class="table datatable table-bordered">';
        $_content_tags .= '<thead>';
        $_content_tags .= '<tr>';
        $_content_tags .= '<th>' . __e("Name") . '</th>';
        $_content_tags .= '<th>' . __e("Note") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Function") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Action") . '</th>';
        $_content_tags .= '</tr>';
        $_content_tags .= '</thead>';
        $_content_tags .= '<tbody>';
        $raw_php_codes = $db->getRawPhpCodes();
        foreach ($raw_php_codes as $raw_php_code)
        {
            $_content_tags .= '<tr>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $raw_php_code['name'] . '</code></td>';
            $_content_tags .= '<td><em>' . $raw_php_code['note'] . '</em></td>';

            $_content_tags .= '<td class="text-center">';
            switch ($raw_php_code['function'])
            {
                case 'include':
                    $_content_tags .= '<span class="badge badge-primary">' . $raw_php_code['function'] . '</span>';
                    break;
                case 'require':
                    $_content_tags .= '<span class="badge badge-danger">' . $raw_php_code['function'] . '</span>';
                    break;
                case 'include_once':
                    $_content_tags .= '<span class="badge badge-primary">' . $raw_php_code['function'] . '</span>';
                    break;
                case 'require_once':
                    $_content_tags .= '<span class="badge badge-danger">' . $raw_php_code['function'] . '</span>';
                    break;

            }
            $_content_tags .= '</td>';


            $_content_tags .= '<td class="text-center align-middle">';
            $_content_tags .= '<div class="btn-group btn-group-sm">';
            $_content_tags .= '<a href="#' . $raw_php_code['name'] . '" data-toggle="modal" data-target="#modal-trash-raw-php-codes-' . $raw_php_code['name'] . '" data-href="./?p=rawPhpCodes&amp;a=trash&amp;n=' . $raw_php_code['name'] . '" class="btn btn-danger"><i class="fa fa-trash"></i> ' . __e("Trash") . '</a>';
            $_content_tags .= '<a href="./?p=rawPhpCodes&amp;a=edit&amp;n=' . $raw_php_code['name'] . '" class="btn btn-success"><i class="fa fa-edit"></i> ' . __e("Edit") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</td>';
            $_content_tags .= '</tr>';
        }
        $_content_tags .= '</tbody>';
        $_content_tags .= '</table>';
        $_content_tags .= '</div>';
        $_content_tags .= '<div class="card-footer">';
        $_content_tags .= '<a href="./?p=rawPhpCodes&amp;a=new" class="btn btn-success"><i class="fa fa-plus-circle"></i> ' . __e("Add New RAW PHP Codes") . '</a>';
        $_content_tags .= '</div>';
        $_content_tags .= '</div>';
        // TODO: LIST --|-- MODAL
        foreach ($raw_php_codes as $raw_php_code)
        {
            $_content_tags .= '<div class="modal fade" id="modal-trash-raw-php-codes-' . $raw_php_code['name'] . '">';
            $_content_tags .= '<div class="modal-dialog">';
            $_content_tags .= '<div class="modal-content bg-default">';
            $_content_tags .= '<div class="modal-header">';
            $_content_tags .= '<h4 class="modal-title">' . __e("Confirm") . '</h4>';
            $_content_tags .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            $_content_tags .= '<span aria-hidden="true">&times;</span></button>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-body">';
            $_content_tags .= '<p>' . __e("Are you sure You want to delete this PHP Codes?") . '</p>';
            $_content_tags .= '<table class="table-grid">';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td rowspan="4" style="text-align: center;"><i class="fab fa-php trash-logo"></i></td>';
            $_content_tags .= '<td>' . __e("Name") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $raw_php_code['name'] . '</code></td>';
            $_content_tags .= '</tr>';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Function") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td>';
            switch ($raw_php_code['function'])
            {
                case 'include':
                    $_content_tags .= '<span class="badge badge-primary">' . $raw_php_code['function'] . '</span>';
                    break;
                case 'require':
                    $_content_tags .= '<span class="badge badge-danger">' . $raw_php_code['function'] . '</span>';
                    break;
                case 'include_once':
                    $_content_tags .= '<span class="badge badge-primary">' . $raw_php_code['function'] . '</span>';
                    break;
                case 'require_once':
                    $_content_tags .= '<span class="badge badge-danger">' . $raw_php_code['function'] . '</span>';
                    break;

            }
            $_content_tags .= '</td>';
            $_content_tags .= '</tr>';


            $_content_tags .= '</table>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-footer justify-content-between">';
            $_content_tags .= '<button type="button" class="btn btn-default" data-dismiss="modal">' . __e("Close") . '</button>';
            $_content_tags .= '<a href="./?p=rawPhpCodes&amp;a=trash&amp;n=' . $raw_php_code['name'] . '" class="btn btn-danger">' . __e("Yes, I am sure!") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
        }

        break;
    case "new":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=rawPhpCodes">' . __e("RAW PHP Codes") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("New") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
    case "edit":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=rawPhpCodes">' . __e("RAW PHP Codes") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("Edit") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
}


define('IHS_LAYOUT_CONTENT', $_content_tags);
define('IHS_LAYOUT_BREADCRUMB', $breadcrumb_tags);
define('IHS_PAGE_NAME', __e("RAW PHP Codes"));
define('IHS_PAGE_DESC', __e("Include your PHP Files"));

?>