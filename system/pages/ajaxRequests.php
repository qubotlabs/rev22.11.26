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
    $postData['ajax-requests']['name'] = ""; //text
    $postData['ajax-requests']['singular_name'] = ""; //text
    $postData['ajax-requests']['plural_name'] = ""; //text
    $postData['ajax-requests']['response_type'] = "json"; //select

    // edit
    if (isset($_GET["n"]))
    {
        $_POST["ajax-requests"]["name"] = $_GET["n"];
    }

    // TODO: ACTION --|-- SUBMIT --|-- POST RESPONSE
    // text
    if (isset($_POST['ajax-requests']['name']))
    {
        $postData['ajax-requests']['name'] = $_POST['ajax-requests']['name'];
    }


    // text
    if (isset($_POST['ajax-requests']['singular_name']))
    {
        $postData['ajax-requests']['singular_name'] = $_POST['ajax-requests']['singular_name'];
    }
    // text
    if (isset($_POST['ajax-requests']['plural_name']))
    {
        $postData['ajax-requests']['plural_name'] = $_POST['ajax-requests']['plural_name'];
    }

    // boolean
    if (isset($_POST['ajax-requests']['show_on_public']))
    {
        $postData['ajax-requests']['show_on_public'] = true;
    } else
    {
        $postData['ajax-requests']['show_on_public'] = false;
    }


    // select
    if (isset($_POST['ajax-requests']['response_type']))
    {
        $postData['ajax-requests']['response_type'] = $_POST['ajax-requests']['response_type'];
    }

    // boolean
    if (isset($_POST['ajax-requests']['logged_in_users']))
    {
        $postData['ajax-requests']['logged_in_users'] = true;
    } else
    {
        $postData['ajax-requests']['logged_in_users'] = false;
    }

    if (isset($_POST['ajax-requests']['fields']))
    {
        $postData['ajax-requests']['fields'] = array();
        $y = 0;
        foreach ($_POST['ajax-requests']['fields'] as $fields)
        {
            if (trim($fields['name']) != '')
            {
                $postData['ajax-requests']['fields'][$y]['type'] = $fields['type'];
                $postData['ajax-requests']['fields'][$y]['name'] = $string->toFileName($fields['name']);
                $postData['ajax-requests']['fields'][$y]['label'] = trim($fields['label']);
                $postData['ajax-requests']['fields'][$y]['options'] = trim($fields['options']);
                $postData['ajax-requests']['fields'][$y]['default'] = trim($fields['default']);
                $postData['ajax-requests']['fields'][$y]['info'] = trim($fields['info']);
                $y++;
            }
        }
    } else
    {
        $postData['ajax-requests']['fields'] = array();
    }


    // select
    if (isset($_POST['ajax-requests']['form_method']))
    {
        $postData['ajax-requests']['form_method'] = $_POST['ajax-requests']['form_method'];
    }
    // boolean
    if (isset($_POST['ajax-requests']['form_builder']))
    {
        $postData['ajax-requests']['form_builder'] = true;
    } else
    {
        $postData['ajax-requests']['form_builder'] = false;
    }
    // text
    if (isset($_POST['ajax-requests']['successful_message']))
    {
        $postData['ajax-requests']['successful_message'] = $_POST['ajax-requests']['successful_message'];
    }
    // text
    if (isset($_POST['ajax-requests']['fail_message']))
    {
        $postData['ajax-requests']['fail_message'] = $_POST['ajax-requests']['fail_message'];
    }

    // text
    if (isset($_POST['ajax-requests']['note']))
    {
        $postData['ajax-requests']['note'] = $_POST['ajax-requests']['note'];
    }
    // select
    if (isset($_POST['ajax-requests']['title_field']))
    {
        $postData['ajax-requests']['title_field'] = $_POST['ajax-requests']['title_field'];
    }
    // select
    if (isset($_POST['ajax-requests']['type_generator']))
    {
        $postData['ajax-requests']['type_generator'] = $_POST['ajax-requests']['type_generator'];
    }

    // TODO: ACTION --|-- SUBMIT --|-- SAVE DATA

    // validate and save postdata
    $db->saveAjaxRequest($postData['ajax-requests']);

    // TODO: ACTION --|-- SUBMIT --|-- GENERATE CUSTOM POST


    $db->current();
    $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Ajax-requests saved successfully!");
    if ($_GET["a"] == "edit")
    {
        header("Location: ./?p=ajaxRequests&a=edit&alert=success&n=" . $_GET["n"] . "&" . time());
    } else
    {
        header("Location: ./?p=ajaxRequests&a=list&alert=success&" . time());
    }
}


// TODO: ACTION --|-- REMOVE --|-- AJAX-REQUESTS
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "trash")
    {
        $_prefix = basename($_GET["n"]);
        $db->removeAjaxRequest($_prefix);
        $db->current();
        $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Ajax-request deleted successfully!");
        header("Location: ./?p=ajaxRequests&a=list&alert=warning&" . time());
    }
}

// TODO: ==============================================================
// TODO: LAYOUT --|-- AJAX REQUESTS
$disabled = "";
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "edit")
    {
        $_prefix = basename($_GET["n"]);
        $currentData["ajax-requests"] = $db->getAjaxRequest($_prefix);
        $disabled = "disabled";
    }
}


// TODO: LAYOUT --|-- AJAX REQUESTS --|-- INIT
//text
if (!isset($currentData['ajax-requests']['name']))
{
    $currentData['ajax-requests']['name'] = "ajax" . time();
}
//text
if (!isset($currentData['ajax-requests']['singular_name']))
{
    $currentData['ajax-requests']['singular_name'] = "";
}

//text
if (!isset($currentData['ajax-requests']['plural_name']))
{
    $currentData['ajax-requests']['plural_name'] = "";
}

//select
if (!isset($currentData['ajax-requests']['show_on_public']))
{
    $currentData['ajax-requests']['show_on_public'] = false;
}

//select
if (!isset($currentData['ajax-requests']['response_type']))
{
    $currentData['ajax-requests']['response_type'] = "json";
}

//boolean
if (!isset($currentData['ajax-requests']['logged_in_users']))
{
    $currentData['ajax-requests']['logged_in_users'] = false;
}

if (!isset($currentData['ajax-requests']['fields']))
{
    $currentData['ajax-requests']['fields'] = array();
}

//select
if (!isset($currentData['ajax-requests']['form_method']))
{
    $currentData['ajax-requests']['form_method'] = "POST";
}
//boolean
if (!isset($currentData['ajax-requests']['form_builder']))
{
    $currentData['ajax-requests']['form_builder'] = false;
}

//text
if (!isset($currentData['ajax-requests']['successful_message']))
{
    $currentData['ajax-requests']['successful_message'] = "Data saved successfully!";
}
//text
if (!isset($currentData['ajax-requests']['fail_message']))
{
    $currentData['ajax-requests']['fail_message'] = "Data failed to save!";
}

//text
if (!isset($currentData['ajax-requests']['note']))
{
    $currentData['ajax-requests']['note'] = "";
}
//select
if (!isset($currentData['ajax-requests']['title_field']))
{
    $currentData['ajax-requests']['title_field'] = "none";
}
//select
if (!isset($currentData['ajax-requests']['type_generator']))
{
    $currentData['ajax-requests']['type_generator'] = "auto";
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
// TODO: LAYOUT --|-- AJAX REQUESTS --|-- FORM
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/ajax/' . $currentData['ajax-requests']['name'] . '.php</code></p>';
$content_tags .= '<hr/>';

$content_tags .= '<div class="callout callout-warning">';

$content_tags .= '<h5>' . __e("Attention!") . '</h5>' . __e("This feature will generate code:");


if ($disabled == 'disabled')
{

    $content_tags .= '<table class="table table-xs table-striped">';

    $content_tags .= '<thead>';
    $content_tags .= '<th>' . __e("Type") . '</th>';
    $content_tags .= '<th>' . __e("Name") . '</th>';
    $content_tags .= '<th>' . __e("Generator") . '</th>';
    $content_tags .= '<th>' . __e("#") . '</th>';
    $content_tags .= '</thead>';


    $cp_info = $db->getCustomPost($currentData['ajax-requests']['name']);
    $mb_info = $db->getMetaBox($currentData['ajax-requests']['name']);
    $sc_info = $db->getShortCode($currentData['ajax-requests']['name']);
    $esc_info = $db->getEnqueueScript($currentData['ajax-requests']['name'] . '-shortcode');


    $content_tags .= '<tr>';
    $content_tags .= '<td>Custom Posts</td>';
    $content_tags .= '<td><code>' . $string->toFileName($project['short-name'] . '_' . $cp_info['name']) . '</code></td>';
    $content_tags .= '<td>-</td>';
    $content_tags .= '<td><a target="blank" class="btn btn-xs btn-primary" href="./?p=customPosts&a=edit&n=' . $cp_info['name'] . '">' . __e("Go") . '</a></td>';
    $content_tags .= '</tr>';

    $content_tags .= '<tr>';
    $content_tags .= '<td>Meta Boxes</td>';
    $content_tags .= '<td><code>' . $string->toFileName($project['short-name'] . '-' . $mb_info['name']) . '</code></td>';
    $content_tags .= '<td>' . $mb_info['type_of_code'] . '</td>';
    $content_tags .= '<td><a target="blank" class="btn btn-xs btn-primary" href="./?p=metaBoxes&a=edit&n=' . $mb_info['name'] . '">' . __e("Go") . '</a></td>';
    $content_tags .= '</tr>';
    if (isset($sc_info['name']))
    {
        $content_tags .= '<tr>';
        $content_tags .= '<td>Short Codes</td>';
        $content_tags .= '<td><code>' . $string->toFileName($project['short-name'] . '-' . $sc_info['name']) . '</code></td>';
        $content_tags .= '<td>' . $sc_info['type_of_code'] . '</td>';
        $content_tags .= '<td><a target="blank" class="btn btn-xs btn-primary" href="./?p=shortCodes&a=edit&n=' . $sc_info['name'] . '">' . __e("Go") . '</a></td>';
        $content_tags .= '</tr>';
    }
    if (isset($esc_info['name']))
    {
        $content_tags .= '<tr>';
        $content_tags .= '<td>Enqueue Scripts</td>';
        $content_tags .= '<td><code>' . $string->toFileName($project['short-name'] . '-' . $esc_info['name']) . '</code></td>';
        $content_tags .= '<td>-</td>';
        $content_tags .= '<td><a target="blank" class="btn btn-xs btn-primary" href="./?p=enqueueScripts&a=edit&n=' . $esc_info['name'] . '">' . __e("Go") . '</a></td>';
        $content_tags .= '</tr>';
    }

    $content_tags .= '</table>';

} else
{
    $content_tags .= ' Custom Posts, Custom Fields, Short-Codes and Enqueue Scripts. ';
}

$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- AJAX REQUESTS --|-- FORM --|-- NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="name" class="col-sm-3 col-form-label">' . __e("Name") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input ' . $disabled . ' required type="text" name="ajax-requests[name]"  class="form-control" id="field-name" placeholder="contacts" value="' . $currentData['ajax-requests']['name'] . '">';
$content_tags .= '<p class="help-block">' . __e("Name must not exceed 20 characters and may only contain a-z, 0-9, and - characters") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- AJAX REQUESTS --|-- FORM --|-- SINGULAR_NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="singular_name" class="col-sm-3 col-form-label">' . __e("Singular Name") . '</label>';
$content_tags .= '<div class="col-sm-7">';
$content_tags .= '<input required type="text" name="ajax-requests[singular_name]"  class="form-control" id="field-singular_name" placeholder="Contact" value="' . $currentData['ajax-requests']['singular_name'] . '">';
$content_tags .= '<p class="help-block">' . __e("Singular name for custom posts (storage media)") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- AJAX REQUESTS --|-- FORM --|-- PLURAL_NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="plural_name" class="col-sm-3 col-form-label">' . __e("Plural Name") . '</label>';
$content_tags .= '<div class="col-sm-7">';
$content_tags .= '<input required type="text" name="ajax-requests[plural_name]"  class="form-control" id="field-plural_name" placeholder="Contacts" value="' . $currentData['ajax-requests']['plural_name'] . '">';
$content_tags .= '<p class="help-block">' . __e("Plural name for custom posts (storage media)") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- AJAX REQUESTS --|-- FORM --|-- SHOW_ON_PUBLIC
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="show_on_public" class="col-sm-3 col-form-label">' . __e("Show on Public") . '</label>';
$content_tags .= '<div class="col-sm-9">';
if ($currentData['ajax-requests']['show_on_public'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="ajax-requests[show_on_public]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="ajax-requests[show_on_public]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("Showing custom post to public") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


// TODO: LAYOUT --|-- AJAX REQUESTS --|-- FORM --|-- NOTE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="note" class="col-sm-3 col-form-label">' . __e("Note") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<input  type="text" name="ajax-requests[note]"  class="form-control" id="field-note" placeholder="" value="' . $currentData['ajax-requests']['note'] . '">';
$content_tags .= '<p class="help-block">' . __e("Just a note") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

$content_tags .= '<hr>';

// TODO: LAYOUT --|-- AJAX REQUESTS --|-- FORM --|-- LOGGED_IN_USERS
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="logged_in_users" class="col-sm-3 col-form-label">' . __e("Only Logged-in Users") . '</label>';
$content_tags .= '<div class="col-sm-9">';
if ($currentData['ajax-requests']['logged_in_users'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="ajax-requests[logged_in_users]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="ajax-requests[logged_in_users]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("If the option is off then the user is logged in and not logged in will be able to send data.") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


// TODO: LAYOUT --|-- AJAX REQUESTS --|-- FORM --|-- TITLE_FIELD
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="title_field" class="col-sm-3 col-form-label">' . __e("Title Field") . '</label>';
$content_tags .= '<div class="col-sm-4">';
$content_tags .= '<select name="ajax-requests[title_field]" class="form-control" id="field-title_field">';
$options = array();
$options[] = array("value" => "None", "label" => "None");
$options[] = array("value" => "Date", "label" => "Date");
foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['ajax-requests']['title_field'])
    {
        $selected = "selected";
    }
    $content_tags .= '<option ' . $selected . ' value="' . $opt["value"] . '">' . $opt["label"] . '</option>';
}
$content_tags .= '</select>';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

$content_tags .= '<hr>';


// boolean
// TODO: LAYOUT --|-- AJAX REQUESTS --|-- FORM --|-- FORM_BUILDER
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="form_builder" class="col-sm-3 col-form-label">' . __e("Form Builder") . '</label>';
$content_tags .= '<div class="col-sm-9">';
if ($currentData['ajax-requests']['form_builder'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="ajax-requests[form_builder]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="ajax-requests[form_builder]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("This action will generate the fond-end code, eg: <code>short-codes</code> and <code>enqueue-scripts</code>") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


// select
// TODO: LAYOUT --|-- AJAX REQUESTS --|-- FORM --|-- TYPE_GENERATOR
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="type_generator" class="col-sm-3 col-form-label">' . __e("Types of Generator") . '</label>';
$content_tags .= '<div class="col-sm-5">';
$content_tags .= '<select name="ajax-requests[type_generator]" class="form-control" id="field-type_generator">';
$options = array();
$options[] = array("value" => "auto", "label" => "Auto Code");
$options[] = array("value" => "custom-code", "label" => "Custom Code");
foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['ajax-requests']['type_generator'])
    {
        $selected = "selected";
    }
    $content_tags .= '<option ' . $selected . ' value="' . $opt["value"] . '">' . $opt["label"] . '</option>';
}
$content_tags .= '</select>';
$content_tags .= '<p class="help-block">' . __e("If you want to edit <code>short-codes</code> and <code>enqueue-scripts</code> code please use Custom Code") . '</p>';

if ($currentData["ajax-requests"]["type_generator"] == 'auto')
{
    $content_tags .= '<a class="btn btn-success btn-xs disabled" target="_blank" href="">' . __e("Edit Short Codes") . '</a>';
} else
{
    $content_tags .= '<a class="btn btn-success btn-xs" target="_blank" href="./?p=shortCodes&amp;a=edit&n=' . $currentData["ajax-requests"]["name"] . '">' . __e("Edit Short Codes") . '</a>';
}

$content_tags .= '</div>';
$content_tags .= '</div>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=ajaxRequests" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=ajaxRequests&n=' . $currentData["ajax-requests"]["name"] . '" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


$content_tags .= '</div>'; //col-md-6


$content_tags .= '<div class="col-md-6">';

$content_tags .= '<div class="card card-outline card-danger">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-cubes"></i>&nbsp;';
$content_tags .= __e("Advanced");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- AJAX REQUESTS --|-- FORM
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/ajax/' . $currentData['ajax-requests']['name'] . '.php</code></p>';
$content_tags .= '<hr/>';


$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-6">';

// select
// TODO: LAYOUT --|-- AJAX REQUESTS --|-- FORM --|-- FORM_METHOD
$content_tags .= '<div class="form-group">';
$content_tags .= '<label for="form_method">' . __e("Form Method") . '</label>';
$content_tags .= '<select name="ajax-requests[form_method]" class="form-control" id="field-form_method">';
$options = array();
$options[] = array("value" => "POST", "label" => "POST");
$options[] = array("value" => "GET", "label" => "GET");
foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['ajax-requests']['form_method'])
    {
        $selected = "selected";
    }
    $content_tags .= '<option ' . $selected . ' value="' . $opt["value"] . '">' . $opt["label"] . '</option>';
}
$content_tags .= '</select>';
$content_tags .= '<p class="help-block">' . __e("Which method to use?") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>'; //col-md-6
$content_tags .= '<div class="col-md-6">';

// select
// TODO: LAYOUT --|-- AJAX REQUESTS --|-- FORM --|-- RESPONSE_TYPE
$content_tags .= '<div class="form-group">';
$content_tags .= '<label for="response_type">' . __e("Response Type") . '</label>';
$content_tags .= '<select name="ajax-requests[response_type]" class="form-control" id="field-response_type">';
$options = array();
//$options[] = array("value" => "text", "label" => "TEXT");
$options[] = array("value" => "json", "label" => "JSON/JSONP");

foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['ajax-requests']['response_type'])
    {
        $selected = "selected";
    }
    $content_tags .= '<option ' . $selected . ' value="' . $opt["value"] . '">' . $opt["label"] . '</option>';
}
$content_tags .= '</select>';
$content_tags .= '<p class="help-block">' . __e("This is useful so that it is easy for you to parse it") . '</p>';
$content_tags .= '</div>';

$content_tags .= '</div>'; //col-md-6
$content_tags .= '</div>'; //row


$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-6">';
// text
// TODO: LAYOUT --|-- AJAX REQUESTS --|-- FORM --|-- SUCCESSFUL_MESSAGE
$content_tags .= '<div class="form-group">';
$content_tags .= '<label for="successful_message">' . __e("Successful Message") . '</label>';
$content_tags .= '<input required type="text" name="ajax-requests[successful_message]"  class="form-control" id="field-successful_message" placeholder="Data saved successfully!" value="' . $currentData['ajax-requests']['successful_message'] . '">';
$content_tags .= '<p class="help-block">' . __e("The text that will appear if the data has been successfully saved") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>'; //col-md-6
$content_tags .= '<div class="col-md-6">';
// text
// TODO: LAYOUT --|-- AJAX REQUESTS --|-- FORM --|-- FAIL_MESSAGE
$content_tags .= '<div class="form-group">';
$content_tags .= '<label for="fail_message">' . __e("Fail Message") . '</label>';
$content_tags .= '<input required type="text" name="ajax-requests[fail_message]"  class="form-control" id="field-fail_message" placeholder="Data failed to save!" value="' . $currentData['ajax-requests']['fail_message'] . '">';
$content_tags .= '<p class="help-block">' . __e("The text that will appear if the data has failed to save") . '</p>';
$content_tags .= '</div>';

$content_tags .= '</div>'; //col-md-6
$content_tags .= '</div>'; //row


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=ajaxRequests" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=ajaxRequests&n=' . $currentData["ajax-requests"]["name"] . '" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card

// TODO: ==============================================================
// TODO: LAYOUT --|-- SAMPLE
$content_tags .= '<div class="card card-outline card-info">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-filter"></i>&nbsp;';
$content_tags .= __e("Sample Code and References");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- SAMPLE
$content_tags .= '<div class="card-body">';

$content_tags .= '<p>';
$content_tags .= __e("You can create a request form using the code below:");
$content_tags .= '</p>';
$content_tags .= '<h4>' . __e("URL Action") . '</h4>' . "\r\n";
$content_tags .= '<pre>' . get_url() . 'wp-test/wp-admin/admin-ajax.php</pre>';

$content_tags .= '<h4>' . __e("Parameter Queries") . '</h4>' . "\r\n";
$content_tags .= '<div class="table table-responsive" style="height: 200px;">';
$content_tags .= '<table class="table table-striped" >';
$content_tags .= '<thead>';
$content_tags .= '<tr>';
$content_tags .= '<th>' . __e("Parameter") . '</th>' . "\r\n";
$content_tags .= '<th>' . __e("Example") . '</th>' . "\r\n";
$content_tags .= '</tr>';
$content_tags .= '</thead>';
$content_tags .= '<tbody>';
$content_tags .= '<tr>';
$content_tags .= '<td style="padding-top: 0px !important;padding-bottom: 3px !important;">action</td>' . "\r\n";
$content_tags .= '<td style="padding-top: 0px !important;padding-bottom: 3px !important;"><span class="text-danger">' . $string->toVar($project['short-name']) . '_' . $currentData['ajax-requests']['name'] . '</span></td>' . "\r\n";
$content_tags .= '</tr>';
foreach ($currentData['ajax-requests']['fields'] as $field)
{
    $content_tags .= '<tr>';
    $content_tags .= '<td style="padding-top: 0px !important;padding-bottom: 3px !important;">' . $string->toVar($project['short-name']) . '_' . $field['name'] . '</td>' . "\r\n";
    $content_tags .= '<td style="padding-top: 0px !important;padding-bottom: 3px !important;">' . $field['default'] . '</td>' . "\r\n";
    $content_tags .= '</tr>';
}
$content_tags .= '</tbody>';
$content_tags .= '</table>';
$content_tags .= '</div>';

$content_tags .= '<h4>' . __e("Example") . '</h4>' . "\r\n";
$content_tags .= '<ul class="nav nav-tabs" id="example-tab" role="tablist">';
$content_tags .= '<li class="nav-item">';
$content_tags .= '<a class="nav-link active" id="json-tab" data-toggle="pill" href="#json-content" role="tab" aria-controls="json-content" aria-selected="true">JSON</a>';
$content_tags .= '</li>';
$content_tags .= '<li class="nav-item">';
$content_tags .= '<a class="nav-link" id="jsonp-tab" data-toggle="pill" href="#jsonp-content" role="tab" aria-controls="jsonp-content" aria-selected="true">JSONP</a>';
$content_tags .= '</li>';
$content_tags .= '<li class="nav-item">';
$content_tags .= '<a class="nav-link" id="curl-tab" data-toggle="pill" href="#curl-content" role="tab" aria-controls="curl-content" aria-selected="true">CURL</a>';
$content_tags .= '</li>';
$content_tags .= '</ul>';
$content_tags .= '<br>';
$content_tags .= '<div class="tab-content" id="custom-content-above-tabContent">';
$content_tags .= '<div class="tab-pane fade show active" id="json-content" role="tabpanel" aria-labelledby="json-content-tab">';
$content_tags .= '<p>' . __e("Here is an example code using jquery library") . '</p>' . "\r\n";
$content_tags .= '<pre style="overflow-y: scroll;height: 200px;">';
switch ($currentData['ajax-requests']['form_method'])
{
    case "POST":
        $content_tags .= 'jQuery.post(' . "\r\n";
        $content_tags .= "\t" . 'kds_ajaxurl,' . "\r\n";
        $content_tags .= "\t" . '{' . "\r\n";
        $content_tags .= "\t" . "\t" . '"action": "' . $string->toVar($project['short-name'] . '_' . $currentData['ajax-requests']['name']) . '", //required for wp ajax callback' . "\r\n";
        foreach ($currentData['ajax-requests']['fields'] as $field)
        {
            $content_tags .= "\t" . "\t" . '"' . $string->toVar($project['short-name']) . '_' . $field['name'] . '": "' . $field['default'] . '",' . "\r\n";
        }
        $content_tags .= "\t" . '},' . "\r\n";
        $content_tags .= "\t" . 'function(response){' . "\r\n";
        $content_tags .= "\t" . "\t" . 'console.log(response);' . "\r\n";
        $content_tags .= "\t" . '}' . "\r\n";
        $content_tags .= ');' . "\r\n";
        break;
    case "GET":
        $content_tags .= 'jQuery.get(' . "\r\n";
        $content_tags .= "\t" . 'kds_ajaxurl,' . "\r\n";
        $content_tags .= "\t" . '{' . "\r\n";
        $content_tags .= "\t" . "\t" . '"action": "' . $string->toVar($project['short-name'] . '_' . $currentData['ajax-requests']['name']) . '", //required for wp ajax callback' . "\r\n";
        foreach ($currentData['ajax-requests']['fields'] as $field)
        {
            $content_tags .= "\t" . "\t" . '"' . $string->toVar($project['short-name']) . '_' . $field['name'] . '": "' . $field['default'] . '",' . "\r\n";
        }
        $content_tags .= "\t" . '},' . "\r\n";
        $content_tags .= "\t" . 'function(response){' . "\r\n";
        $content_tags .= "\t" . "\t" . 'console.log(response);' . "\r\n";
        $content_tags .= "\t" . '}' . "\r\n";
        $content_tags .= ');' . "\r\n";
        break;
}


$content_tags .= '</pre>';
$content_tags .= '</div>';

$content_tags .= '<div class="tab-pane fade show" id="jsonp-content" role="tabpanel" aria-labelledby="jsonp-content-tab">';
$content_tags .= '<p>' . __e("Here is an example code using jquery library") . '</p>' . "\r\n";
$content_tags .= '<pre style="overflow-y: scroll;height: 200px;">';
switch ($currentData['ajax-requests']['form_method'])
{
    case "POST":
        $content_tags .= 'jQuery.ajax({' . "\r\n";
        $content_tags .= "\t" . 'url: kds_ajaxurl,' . "\r\n";
        $content_tags .= "\t" . 'jsonp: "callback",' . "\r\n";
        $content_tags .= "\t" . 'dataType: "jsonp",' . "\r\n";
        $content_tags .= "\t" . 'method: "POST",' . "\r\n";
        $content_tags .= "\t" . 'data: {' . "\r\n";
        $content_tags .= "\t" . "\t" . 'action: "' . $string->toVar($project['short-name'] . '_' . $currentData['ajax-requests']['name']) . '", //required for wp ajax callback' . "\r\n";
        foreach ($currentData['ajax-requests']['fields'] as $field)
        {
            $content_tags .= "\t" . "\t" . '"' . $string->toVar($project['short-name']) . '_' . $field['name'] . '": "' . $field['default'] . '",' . "\r\n";
        }
        $content_tags .= "\t" . '},' . "\r\n";
        $content_tags .= "\t" . 'success: function(response) {' . "\r\n";
        $content_tags .= "\t" . "\t" . 'console.log(response);' . "\r\n";
        $content_tags .= "\t" . '}' . "\r\n";
        $content_tags .= '});' . "\r\n";
        break;
    case "GET":
        $content_tags .= 'jQuery.ajax({' . "\r\n";
        $content_tags .= "\t" . 'url: kds_ajaxurl,' . "\r\n";
        $content_tags .= "\t" . 'jsonp: "callback",' . "\r\n";
        $content_tags .= "\t" . 'dataType: "jsonp",' . "\r\n";
        $content_tags .= "\t" . 'method: "GET",' . "\r\n";
        $content_tags .= "\t" . 'data: {' . "\r\n";
        $content_tags .= "\t" . "\t" . 'action: "' . $string->toVar($project['short-name'] . '_' . $currentData['ajax-requests']['name']) . '", //required for wp ajax callback' . "\r\n";
        foreach ($currentData['ajax-requests']['fields'] as $field)
        {
            $content_tags .= "\t" . "\t" . '"' . $string->toVar($project['short-name']) . '_' . $field['name'] . '": "' . $field['default'] . '",' . "\r\n";
        }
        $content_tags .= "\t" . '},' . "\r\n";
        $content_tags .= "\t" . 'success: function(response) {' . "\r\n";
        $content_tags .= "\t" . "\t" . 'console.log(response);' . "\r\n";
        $content_tags .= "\t" . '}' . "\r\n";
        $content_tags .= '});' . "\r\n";
        break;
}


$content_tags .= '</pre>';
$content_tags .= '</div>';

$content_tags .= '<div class="tab-pane fade show" id="curl-content" role="tabpanel" aria-labelledby="curl-content-tab">';
$content_tags .= '<p>' . __e("You can use the curl command like this:") . '</p>' . "\r\n";
$content_tags .= '<pre>';
switch ($currentData['ajax-requests']['form_method'])
{
    case "POST":
        $param = array();
        $param["action"] = '' . $string->toVar($project['short-name'] . '_' . $currentData['ajax-requests']['name']) . '';
        foreach ($currentData['ajax-requests']['fields'] as $field)
        {
            $var = $string->toVar($project['short-name'] . '_' . $field['name']);
            $param[$var] = $field['default'];
        }

        $content_tags .= 'curl -X POST -d "' . http_build_query($param) . '" "' . get_url() . 'wp-test/wp-admin/admin-ajax.php"' . "\r\n";
        break;
    case "GET":
        $param = array();
        $param["action"] = '' . $string->toVar($project['short-name'] . '_' . $currentData['ajax-requests']['name']) . '';
        foreach ($currentData['ajax-requests']['fields'] as $field)
        {
            $var = $string->toVar($project['short-name'] . '_' . $field['name']);
            $param[$var] = $field['default'];
        }

        $content_tags .= 'curl "' . get_url() . 'wp-test/wp-admin/admin-ajax.php?' . http_build_query($param) . '"' . "\r\n";


        break;
}


$content_tags .= '</pre>';

$content_tags .= '</div>';
$content_tags .= '</div>';

$content_tags .= '</div>'; //card-body
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-info btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=ajaxRequests" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=ajaxRequests&n=' . $currentData["ajax-requests"]["name"] . '" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


$content_tags .= '</div>'; //col-md-6
$content_tags .= '</div>'; //row

// TODO: ==============================================================

$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-12">';


$content_tags .= '<div class="card card-outline card-success">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fa fa-list"></i>&nbsp;';
$content_tags .= __e("Custom Fields");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|--
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/ajax/' . $currentData['ajax-requests']['name'] . '.php</code></p>';
$content_tags .= '<hr/>';


// TODO: LAYOUT --|-- CUSTOM-FIELDS --|-- FIELDS

// TODO: LAYOUT --|-- CUSTOM-FIELDS --|-- FIELDS

$module_path = IHS_MODULE_DIR . '/custom-fields/*.mod.php';
$__options = array();
foreach (glob($module_path) as $filename)
{
    $module = null;
    include ($filename);
    $__options[] = $module;
}

$content_tags .= '<table class="table table-striped table-bordered">';
$content_tags .= '<thead>';
$content_tags .= '<tr>';
$content_tags .= '<th class="text-center vcenter">#</th>';
$content_tags .= '<th class="text-center vcenter">' . __e("Type") . '</th>';
$content_tags .= '<th class="text-center vcenter">' . __e("Name/<br/>Variable") . '</th>';
$content_tags .= '<th class="text-center vcenter">' . __e("Label") . '</th>';
$content_tags .= '<th class="text-center vcenter">' . __e("Placeholder/<br/>Options") . '</th>';
$content_tags .= '<th class="text-center vcenter">' . __e("Default/<br/>Value") . '</th>';
$content_tags .= '<th class="text-center vcenter">' . __e("Info/<br/>Help") . '</th>';
$content_tags .= '<th class="text-center vcenter"></th>';
$content_tags .= '</tr>';
$content_tags .= '</thead>';
$content_tags .= '<tbody class="item-list">';

// TODO: LAYOUT --|-- CUSTOM-FIELDS --|-- TABLE --|-- FIELDS
$c = 0;
foreach ($currentData['ajax-requests']['fields'] as $field)
{
    if (!isset($field['name']))
    {
        $field['name'] = '';
    }
    if (!isset($field['label']))
    {
        $field['label'] = '';
    }
    if (!isset($field['options']))
    {
        $field['options'] = '';
    }
    if (!isset($field['info']))
    {
        $field['info'] = '';
    }
    if (!isset($field['default']))
    {
        $field['default'] = '';
    }

    $select_option = null;
    $select_option .= '<select name="ajax-requests[fields][' . $c . '][type]" data-target="' . $c . '" class="form-control ajax-requests-type" >';
    foreach ($__options as $option)
    {
        if (isset($option['wp_ajax']))
        {
            $selected = '';
            if ($option['name'] == $field['type'])
            {
                $selected = 'selected';
            }
            $select_option .= '<option ' . $selected . ' value="' . $option['name'] . '">' . $option['label'] . '</option>';
        }
    }
    $select_option .= '</select>';


    $content_tags .= '<tr id="field-no-' . $c . '"  class="item">';
    $content_tags .= '<td class="handle text-center vcenter"><i class="fas fa-arrows-alt"></i><p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
    $content_tags .= '<td class="vcenter">' . $select_option . '<p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
    $content_tags .= '<td class="vcenter"><input name="ajax-requests[fields][' . $c . '][name]" placeholder="field-' . $c . '" class="form-control" type="text" value="' . $field['name'] . '"/><p class="helper-block"><strong>format</strong>: a-z, A-Z,0-9, and -<br/>don\'t use the number in the 1st variable</p></td>';
    $content_tags .= '<td class="vcenter"><input name="ajax-requests[fields][' . $c . '][label]" placeholder="Field ' . $c . '"  class="form-control" type="text" value="' . $field['label'] . '"/><p class="helper-block"><strong>format</strong>: text<br/>&nbsp;</p></td>';

    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="ajax-request-options-' . $c . '" name="ajax-requests[fields][' . $c . '][options]" class="form-control" type="text" value="' . $field['options'] . '"/>';
    $content_tags .= '<span id="ajax-request-options-select-' . $c . '"></span>';
    $content_tags .= '<p class="helper-block"><span id="ajax-request-options-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';

    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="ajax-request-default-' . $c . '" name="ajax-requests[fields][' . $c . '][default]" class="form-control" type="text" value="' . $field['default'] . '"/>';
    $content_tags .= '<p class="helper-block"><span id="ajax-request-default-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';

    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="ajax-request-info-' . $c . '" name="ajax-requests[fields][' . $c . '][info]" class="form-control" type="text" value="' . $field['info'] . '"/>';
    $content_tags .= '<p class="helper-block"><span id="ajax-request-info-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';

    $content_tags .= '<td class="text-center vcenter"><a class="btn btn-danger btn-sm remove-item" data-target="#field-no-' . $c . '" href="#!_"><i class="fa fa-trash"></i></a><p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
    $content_tags .= '</tr>';
    $c++;
}

// TODO: LAYOUT --|-- CUSTOM-FIELDS --|-- TABLE --|-- ADD FIELDS

$c++;
$select_option = null;
$select_option .= '<select name="ajax-requests[fields][' . $c . '][type]" data-target="' . $c . '"  class="form-control ajax-requests-type" >';
foreach ($__options as $option)
{
    $select_option .= '<option value="' . $option['name'] . '">' . $option['label'] . '</option>';
}
$select_option .= '</select>';

$content_tags .= '<tr id="field-no-' . $c . '">';
$content_tags .= '<td class="text-center vcenter"><a href="#!_"><i class="fa fa-move"></i></a></td>';
$content_tags .= '<td class="text-center vcenter">' . $select_option . '<p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
$content_tags .= '<td class="text-center vcenter"><input name="ajax-requests[fields][' . $c . '][name]" placeholder="field-' . $c . '" class="form-control" type="text" value=""/><p class="helper-block"><strong>format</strong>: a-z, A-Z,0-9, and -<br/>don\'t use the number in the 1st variable</p></td>';
$content_tags .= '<td class="text-center vcenter"><input name="ajax-requests[fields][' . $c . '][label]" placeholder="Field ' . $c . '" class="form-control" type="text" value=""/><p class="helper-block"><strong>format</strong>: text<br/>&nbsp;</p></td>';

$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="ajax-request-options-' . $c . '" name="ajax-requests[fields][' . $c . '][options]" class="form-control" type="text" value=""/><span id="ajax-request-options-select-' . $c . '"></span>';
$content_tags .= '<p class="helper-block"><span id="ajax-request-options-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
$content_tags .= '</td>';

$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="ajax-request-default-' . $c . '" name="ajax-requests[fields][' . $c . '][default]" class="form-control" type="text" value=""/>';
$content_tags .= '<p class="helper-block"><span id="ajax-request-default-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
$content_tags .= '</td>';

$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="ajax-request-info-' . $c . '" name="ajax-requests[fields][' . $c . '][info]" class="form-control" type="text" value=""/>';
$content_tags .= '<p class="helper-block"><span id="ajax-request-info-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
$content_tags .= '</td>';

$content_tags .= '<td class="text-center vcenter"><input name="submit" type="submit" class="btn btn-primary" value="' . __e("Add Field") . '" /><p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
$content_tags .= '</tr>';
$content_tags .= '</tbody>';
$content_tags .= '</table>';


$content_tags .= '</div>'; //card-body
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-success btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=ajaxRequests" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=ajaxRequests&n=' . $currentData["ajax-requests"]["name"] . '" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


$content_tags .= '</div>'; //col-md-12
$content_tags .= '</div>'; //row


$content_tags .= '</form>';


switch ($_GET["a"])
{
        // TODO: LAYOUT --|-- LIST --|-- BREADCRUMB --|--
    case "list":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=ajaxRequests">' . __e("Ajax Requests") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("List") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags .= '<div class="card card-outline card-info">';
        $_content_tags .= '<div class="card-body">';

        $_content_tags .= '<div class="welcome">';
        $_content_tags .= '<h2>' . __e('Front-end') . '</h2>';
        $_content_tags .= '<h1>' . __e('Ajax Requests') . '</h1>';
        $_content_tags .= '<p class="lead">' . __e('Fires Ajax actions for users') . '</p>';
        $_content_tags .= '</div>';

        // TODO: LAYOUT --|-- LIST --|-- TABLE
        $_content_tags .= '<table data-type="datatable" class="table datatable table-bordered">';
        $_content_tags .= '<thead>';
        $_content_tags .= '<tr>';
        $_content_tags .= '<th>' . __e("Name") . '</th>';
        $_content_tags .= '<th>' . __e("Custom Posts") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Action") . '</th>';
        $_content_tags .= '</tr>';
        $_content_tags .= '</thead>';
        $_content_tags .= '<tbody>';
        $ajax_requests = $db->getAjaxRequests();
        foreach ($ajax_requests as $ajax_request)
        {
            $_content_tags .= '<tr>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name'] . '-' . $ajax_request['name']) . '</code></td>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name'] . '-' . $ajax_request['name']) . '</code></td>';
            $_content_tags .= '<td class="text-center align-middle">';
            $_content_tags .= '<div class="btn-group btn-group-sm">';
            $_content_tags .= '<a href="#' . $ajax_request['name'] . '" data-toggle="modal" data-target="#modal-trash-ajax-requests-' . $ajax_request['name'] . '" data-href="./?p=ajaxRequests&amp;a=trash&amp;n=' . $ajax_request['name'] . '" class="btn btn-danger"><i class="fa fa-trash"></i> ' . __e("Trash") . '</a>';
            $_content_tags .= '<a href="./?p=ajaxRequests&amp;a=edit&amp;n=' . $ajax_request['name'] . '" class="btn btn-success"><i class="fa fa-edit"></i> ' . __e("Edit") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</td>';
            $_content_tags .= '</tr>';
        }
        $_content_tags .= '</tbody>';
        $_content_tags .= '</table>';
        $_content_tags .= '</div>';
        $_content_tags .= '<div class="card-footer">';
        $_content_tags .= '<a href="./?p=ajaxRequests&amp;a=new" class="btn btn-success"><i class="fa fa-plus-circle"></i> ' . __e("Add New Ajax Requests") . '</a>';
        $_content_tags .= '</div>';
        $_content_tags .= '</div>';
        // TODO: LAYOUT --|-- LIST --|-- MODAL
        foreach ($ajax_requests as $ajax_request)
        {
            $_content_tags .= '<div class="modal fade" id="modal-trash-ajax-requests-' . $ajax_request['name'] . '">';
            $_content_tags .= '<div class="modal-dialog">';
            $_content_tags .= '<div class="modal-content bg-default">';
            $_content_tags .= '<div class="modal-header">';
            $_content_tags .= '<h4 class="modal-title">' . __e("Confirm") . '</h4>';
            $_content_tags .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            $_content_tags .= '<span aria-hidden="true">&times;</span></button>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-body">';
            $_content_tags .= '<p>' . __e("Are you sure You want to delete this Ajax-requests?") . '</p>';
            $_content_tags .= '<table class="table-grid">';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td rowspan="4" style="text-align: center;"><i class="far fa-image trash-logo"></i></td>';
            $_content_tags .= '<td>' . __e("Name") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name'] . '-' . $ajax_request['name']) . '</code></td>';
            $_content_tags .= '</tr>';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Custom Posts") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name'] . '-' . $ajax_request['name']) . '</code></td>';
            $_content_tags .= '</tr>';
            $_content_tags .= '</table>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-footer justify-content-between">';
            $_content_tags .= '<button type="button" class="btn btn-default" data-dismiss="modal">' . __e("Close") . '</button>';
            $_content_tags .= '<a href="./?p=ajaxRequests&amp;a=trash&amp;n=' . $ajax_request['name'] . '" class="btn btn-danger">' . __e("Yes, I am sure!") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
        }

        break;
        // TODO: LAYOUT --|-- NEW --|-- BREADCRUMB --|--
    case "new":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=ajaxRequests">' . __e("Ajax Requests") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("New") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
        // TODO: LAYOUT --|-- EDIT --|-- BREADCRUMB --|--
    case "edit":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=ajaxRequests">' . __e("Ajax Requests") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("Edit") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
}

// TODO: LAYOUT --|-- JS
$pagejs = null;
$pagejs .= "\t\t" . '' . "\r\n";
$c = 0;
$pagejs .= "\t\t" . 'var ajax_request_type = [];' . "\r\n";
$pagejs .= "\t\t" . 'var ajax_request_name = [];' . "\r\n";
$pagejs .= "\t\t" . 'var ajax_request_label = [];' . "\r\n";
$pagejs .= "\t\t" . 'var ajax_request_options = [];' . "\r\n";

foreach ($currentData['ajax-requests']['fields'] as $field)
{
    $pagejs .= "\t\t" . 'ajax_request_type[' . $c . '] = "' . $field["type"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'ajax_request_name[' . $c . '] = "' . $field["name"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'ajax_request_label[' . $c . '] = "' . $field["label"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'ajax_request_options[' . $c . '] = "' . $field["options"] . '" ;' . "\r\n";
    $c++;
}
$pagejs .= "\t\t" . '' . "\r\n";
$pagejs .= "\t\t" . 'function setField(target,value){' . "\r\n";
$pagejs .= "\t\t\t" . 'console.log(target,value);' . "\r\n";
$pagejs .= "\t\t\t" . '$(target).val(value);' . "\r\n";
$pagejs .= "\t\t" . '}' . "\r\n";
$pagejs .= "\t\t" . 'function customFields(eve){' . "\r\n";
$pagejs .= "\t\t\t" . 'var item_type = $(eve).val();' . "\r\n";
$pagejs .= "\t\t\t" . 'var item_target = $(eve).attr("data-target");' . "\r\n";
$pagejs .= "\t\t\t" . '' . "\r\n";
$pagejs .= "\t\t\t" . 'switch(item_type){' . "\r\n";
foreach ($__options as $__opt)
{

    /** options **/
    if (!isset($__opt['options']['type']))
    {
        $__opt['options']['type'] = 'text';
    }
    if (!isset($__opt['options']['value']))
    {
        $__opt['options']['value'] = '';
    }
    if (!isset($__opt['options']['placeholder']))
    {
        $__opt['options']['placeholder'] = '';
    }
    if (!isset($__opt['options']['help']))
    {
        $__opt['options']['help'] = '<strong>format</strong>: text';
    }

    /** default **/
    if (!isset($__opt['default']['type']))
    {
        $__opt['default']['type'] = 'text';
    }
    if (!isset($__opt['default']['value']))
    {
        $__opt['default']['value'] = '';
    }
    if (!isset($__opt['default']['placeholder']))
    {
        $__opt['default']['placeholder'] = '';
    }
    if (!isset($__opt['default']['help']))
    {
        $__opt['default']['help'] = '<strong>format</strong>: text';
    }

    /** info **/
    if (!isset($__opt['info']['value']))
    {
        $__opt['info']['value'] = '';
    }
    if (!isset($__opt['info']['placeholder']))
    {
        $__opt['info']['placeholder'] = '';
    }
    if (!isset($__opt['info']['help']))
    {
        $__opt['info']['help'] = '<strong>format</strong>: text';
    }


    /** other **/
    if (!isset($__opt['code']['js']))
    {
        $__opt['code']['js'] = '';
    }
    $pagejs .= "\t\t\t\t" . 'case "' . $__opt['name'] . '":' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '//reset' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#ajax-request-options-select-" + item_target).html("");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#ajax-request-options-" + item_target).removeClass("hidden");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#ajax-request-default-" + item_target).removeClass("hidden");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#ajax-request-info-" + item_target).removeClass("hidden");' . "\r\n";

    $pagejs .= "\t\t\t\t\t" . '$("#ajax-request-options-" + item_target).prop("type","' . $__opt['options']['type'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#ajax-request-options-" + item_target).attr("placeholder","' . $__opt['options']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#ajax-request-options-help-" + item_target).html("' . $__opt['options']['help'] . '");' . "\r\n";

    $pagejs .= "\t\t\t\t\t" . '$("#ajax-request-default-" + item_target).prop("type","' . $__opt['default']['type'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#ajax-request-default-" + item_target).attr("placeholder","' . $__opt['default']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#ajax-request-default-help-" + item_target).html("' . $__opt['default']['help'] . '");' . "\r\n";

    $pagejs .= "\t\t\t\t\t" . '$("#ajax-request-info-" + item_target).attr("placeholder","' . $__opt['info']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#ajax-request-info-help-" + item_target).html("' . $__opt['info']['help'] . '");' . "\r\n";

    //$pagejs .= "\t\t\t\t\t" . '$("#ajax-request-options-" + item_target).val("' . $__opt['options']['value'] . '");' . "\r\n";
    //$pagejs .= "\t\t\t\t\t" . '$("#ajax-request-default-" + item_target).val("' . $__opt['default']['value'] . '");' . "\r\n";
    //$pagejs .= "\t\t\t\t\t" . '$("#ajax-request-info-" + item_target).val("' . $__opt['info']['value'] . '");' . "\r\n";


    $pagejs .= $__opt['code']['js'];

    $pagejs .= "\t\t\t\t\t" . 'break;' . "\r\n";
}
$pagejs .= "\t\t\t" . '}' . "\r\n";
$pagejs .= "\t\t" . '}' . "\r\n";


$pagejs .= "\t\t" . '$(".ajax-requests-type").on("click",function(){' . "\r\n";
$pagejs .= "\t\t\t" . 'customFields(this);' . "\r\n";
$pagejs .= "\t\t" . '});' . "\r\n";

$pagejs .= "\t\t" . 'var itemType = $(".ajax-requests-type");' . "\r\n";
$pagejs .= "\t\t" . '$.each(itemType, function() {' . "\r\n";
$pagejs .= "\t\t\t" . 'customFields(this);' . "\r\n";
$pagejs .= "\t\t" . '});' . "\r\n";


$pagejs .= "\t\t" . '' . "\r\n";
$pagejs .= "\t\t" . '$(".item-list").sortable({' . "\r\n";
$pagejs .= "\t\t\t" . 'opacity: 0.5,' . "\r\n";
$pagejs .= "\t\t\t" . 'items: ".item",' . "\r\n";
$pagejs .= "\t\t\t" . 'placeholder: "sort-highlight",' . "\r\n";
$pagejs .= "\t\t\t" . 'handle: ".handle",' . "\r\n";
$pagejs .= "\t\t\t" . 'forcePlaceholderSize: false,' . "\r\n";
$pagejs .= "\t\t\t" . 'zIndex: 999999' . "\r\n";
$pagejs .= "\t\t" . '});' . "\r\n";

define('IHS_PAGE_JS', $pagejs);
define('IHS_LAYOUT_CONTENT', $_content_tags);
define('IHS_LAYOUT_BREADCRUMB', $breadcrumb_tags);
define('IHS_PAGE_NAME', __e("Ajax Requests"));
define('IHS_PAGE_DESC', __e("Fires Ajax actions for users"));

?>