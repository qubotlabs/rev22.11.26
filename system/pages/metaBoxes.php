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
    $postData['meta-boxes']['name'] = ""; //text
    $postData['meta-boxes']['title'] = ""; //text
    $postData['meta-boxes']['screen'] = array(); //checkbox
    $postData['meta-boxes']['context'] = "advanced"; //select
    $postData['meta-boxes']['priority'] = "default"; //select
    $postData['meta-boxes']['type_of_code'] = "custom-fields"; //select
    $postData['meta-boxes']['overwrite_custom_code'] = true; //boolean

    $postData['meta-boxes']['custom-code']['render-content'] = ""; //select
    $postData['meta-boxes']['custom-code']['save-post'] = ""; //select
    $postData['meta-boxes']['custom-code']['admin-footer'] = ""; //select
    $postData['meta-boxes']['custom-code']['admin-enqueue-scripts'] = ""; //select

    $postData['meta-boxes']['fields'] = array();


    // TODO: ACTION --|-- SUBMIT --|-- POST RESPONSE
    // text
    if (isset($_POST['meta-boxes']['name']))
    {
        $postData['meta-boxes']['name'] = $_POST['meta-boxes']['name'];
    }
    if (isset($_GET['n']))
    {
        $postData['meta-boxes']['name'] = $_GET['n'];
    }

    // text
    if (isset($_POST['meta-boxes']['custom-code']['render-content']))
    {
        $postData['meta-boxes']['custom-code']['render-content'] = $_POST['meta-boxes']['custom-code']['render-content'];
    }


    // text
    if (isset($_POST['meta-boxes']['custom-code']['save-post']))
    {
        $postData['meta-boxes']['custom-code']['save-post'] = $_POST['meta-boxes']['custom-code']['save-post'];
    }

    // text
    if (isset($_POST['meta-boxes']['custom-code']['admin-enqueue-scripts']))
    {
        $postData['meta-boxes']['custom-code']['admin-enqueue-scripts'] = $_POST['meta-boxes']['custom-code']['admin-enqueue-scripts'];
    }

    // text
    if (isset($_POST['meta-boxes']['custom-code']['admin-footer']))
    {
        $postData['meta-boxes']['custom-code']['admin-footer'] = $_POST['meta-boxes']['custom-code']['admin-footer'];
    }


    // text
    if (isset($_POST['meta-boxes']['title']))
    {
        $postData['meta-boxes']['title'] = $_POST['meta-boxes']['title'];
    }
    // checkbox
    if (isset($_POST['meta-boxes']['screen']))
    {
        $postData['meta-boxes']['screen'] = $_POST['meta-boxes']['screen'];
    }
    // select
    if (isset($_POST['meta-boxes']['context']))
    {
        $postData['meta-boxes']['context'] = $_POST['meta-boxes']['context'];
    }
    // select
    if (isset($_POST['meta-boxes']['priority']))
    {
        $postData['meta-boxes']['priority'] = $_POST['meta-boxes']['priority'];
    }


    // select
    if (isset($_POST['meta-boxes']['type_of_code']))
    {
        $postData['meta-boxes']['type_of_code'] = $_POST['meta-boxes']['type_of_code'];
    }


    // boolean
    if (isset($_POST['meta-boxes']['overwrite_custom_code']))
    {
        $postData['meta-boxes']['overwrite_custom_code'] = true;
    } else
    {
        $postData['meta-boxes']['overwrite_custom_code'] = false;
    }


    if (isset($_POST['meta-boxes']['fields']))
    {
        $y = 0;
        foreach ($_POST['meta-boxes']['fields'] as $fields)
        {
            if (trim($fields['name']) != '')
            {
                $postData['meta-boxes']['fields'][$y]['type'] = $fields['type'];
                $postData['meta-boxes']['fields'][$y]['name'] = $string->toFileName($fields['name']);
                $postData['meta-boxes']['fields'][$y]['label'] = trim($fields['label']);
                $postData['meta-boxes']['fields'][$y]['options'] = trim($fields['options']);
                $postData['meta-boxes']['fields'][$y]['default'] = trim($fields['default']);
                $postData['meta-boxes']['fields'][$y]['info'] = trim($fields['info']);
                $y++;
            }
        }
    }

    // text
    if (isset($_POST['meta-boxes']['note']))
    {
        $postData['meta-boxes']['note'] = $_POST['meta-boxes']['note'];
    }


    // TODO: ACTION --|-- SUBMIT --|-- SAVE DATA

    // validate and save postdata
    $db->saveMetaBoxes($postData['meta-boxes']);
    $db->current();
    $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Meta box saved successfully!");
    if ($_GET["a"] == "edit")
    {
        header("Location: ./?p=metaBoxes&a=edit&alert=success&n=" . $_GET["n"] . "&" . time());
    } else
    {
        header("Location: ./?p=metaBoxes&a=list&alert=success&" . time());
    }
}


// TODO: ACTION --|-- REMOVE --|-- META-BOXES
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "trash")
    {
        $_prefix = basename($_GET["n"]);
        $db->removeMetaBox($_prefix);
        $db->current();
        $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Meta box deleted successfully!");
        header("Location: ./?p=metaBoxes&a=list&alert=warning&" . time());
    }
}

// TODO: ========================================================

// TODO: LAYOUT --|--
$disabled = "";
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "edit")
    {
        $_prefix = basename($_GET["n"]);
        $currentData["meta-boxes"] = $db->getMetaBox($_prefix);
        $disabled = "disabled";
    }
}


// TODO: LAYOUT --|-- INIT
//text
if (!isset($currentData['meta-boxes']['name']))
{
    $currentData['meta-boxes']['name'] = "";
}
//text
if (!isset($currentData['meta-boxes']['title']))
{
    $currentData['meta-boxes']['title'] = "";
}

if (!isset($currentData['meta-boxes']['fields']))
{
    $currentData['meta-boxes']['fields'] = array();
}


//checkbox
if (!isset($currentData['meta-boxes']['screen']))
{
    $currentData['meta-boxes']['screen'] = array();
}
//select
if (!isset($currentData['meta-boxes']['context']))
{
    $currentData['meta-boxes']['context'] = "advanced";
}
//select
if (!isset($currentData['meta-boxes']['priority']))
{
    $currentData['meta-boxes']['priority'] = "default";
}


//select
if (!isset($currentData['meta-boxes']['type_of_code']))
{
    $currentData['meta-boxes']['type_of_code'] = "custom-fields";
}

//boolean
if (!isset($currentData['meta-boxes']['overwrite_custom_code']))
{
    $currentData['meta-boxes']['overwrite_custom_code'] = true;
}


//select
if (!isset($currentData['meta-boxes']['custom-code']['admin-footer']))
{
    $currentData['meta-boxes']['custom-code']['admin-footer'] = "";
}

//select
if (!isset($currentData['meta-boxes']['custom-code']['save-post']))
{
    $currentData['meta-boxes']['custom-code']['save-post'] = "";
}

if (!isset($currentData['meta-boxes']['custom-code']['render-content']))
{
    $currentData['meta-boxes']['custom-code']['render-content'] = "";
}

if (!isset($currentData['meta-boxes']['custom-code']['admin-enqueue-scripts']))
{
    $currentData['meta-boxes']['custom-code']['admin-enqueue-scripts'] = "";
}

//text
if (!isset($currentData['meta-boxes']['note']))
{
    $currentData['meta-boxes']['note'] = "";
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
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/meta-boxes.php</code></p>';
$content_tags .= '<hr/>';

// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="name" class="col-sm-3 col-form-label">' . __e("Name") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input ' . $disabled . ' required type="text" name="meta-boxes[name]"  class="form-control" id="field-name" placeholder="my-metabox" value="' . $currentData['meta-boxes']['name'] . '">';
$content_tags .= '<p class="help-block">' . __e("Meta box ID (used in the <code>id</code> attribute for the meta box)") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- TITLE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="title" class="col-sm-3 col-form-label">' . __e("Title") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input required type="text" name="meta-boxes[title]"  class="form-control" id="field-title" placeholder="My Metabox" value="' . $currentData['meta-boxes']['title'] . '">';
$content_tags .= '<p class="help-block">' . __e("Title of the meta box") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


// text
// TODO: LAYOUT --|-- CUSTOMPOSTS --|-- FORM --|-- NOTE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="note" class="col-sm-3 col-form-label">' . __e("Note") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<input  type="text" name="meta-boxes[note]"  class="form-control" id="field-note" placeholder="" value="' . $currentData['meta-boxes']['note'] . '">';
$content_tags .= '<p class="help-block">' . __e("Just a note") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// select
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- CONTEXT
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="context" class="col-sm-3 col-form-label">' . __e("Context") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<select name="meta-boxes[context]" class="form-control" id="field-context">';
$options = array();
$options[] = array("value" => "advanced", "label" => "Advanced");
$options[] = array("value" => "normal", "label" => "Normal");
$options[] = array("value" => "side", "label" => "Side");
foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['meta-boxes']['context'])
    {
        $selected = "selected";
    }
    $content_tags .= '<option ' . $selected . ' value="' . $opt["value"] . '">' . $opt["label"] . '</option>';
}
$content_tags .= '</select>';
$content_tags .= '<p class="help-block">' . __e("The context within the screen where the boxes should display") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// select
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- PRIORITY
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="priority" class="col-sm-3 col-form-label">' . __e("Priority") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<select name="meta-boxes[priority]" class="form-control" id="field-priority">';
$options = array();
$options[] = array("value" => "default", "label" => "Default");
$options[] = array("value" => "high", "label" => "High");
$options[] = array("value" => "low", "label" => "Low");
foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['meta-boxes']['priority'])
    {
        $selected = "selected";
    }
    $content_tags .= '<option ' . $selected . ' value="' . $opt["value"] . '">' . $opt["label"] . '</option>';
}
$content_tags .= '</select>';
$content_tags .= '<p class="help-block">' . __e("The priority within the context where the boxes should show") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

$content_tags .= '<hr/>';

// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- TYPE_OF_CODE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="type_of_code" class="col-sm-3 col-form-label">' . __e("Types of Generator") . '</label>';
$content_tags .= '<div class="col-sm-5">';
$content_tags .= '<select name="meta-boxes[type_of_code]" class="form-control" id="field-type_of_code">';
$options = array();
$options[] = array("value" => "custom-fields", "label" => "Auto Code (Custom Fields)");
$options[] = array("value" => "custom-code", "label" => "Custom Code");
foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['meta-boxes']['type_of_code'])
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
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- OVERWRITE_CUSTOM_CODE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="overwrite_custom_code" class="col-sm-3 col-form-label">' . __e("Copy To Custom Code") . '</label>';
$content_tags .= '<div class="col-sm-9">';
if ($currentData['meta-boxes']['overwrite_custom_code'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="meta-boxes[overwrite_custom_code]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="meta-boxes[overwrite_custom_code]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
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
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=metaBoxes" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=metaBoxes" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


$content_tags .= '</div>'; //col-md-6

// TODO: ========================================================
// TODO: LAYOUT --|-- SCREEN --|--

$content_tags .= '<div class="col-md-6">';
$content_tags .= '<div class="card card-outline card-info">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-cube"></i>&nbsp;';
$content_tags .= __e("Screen");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header

$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/meta-boxes.php</code></p>';
$content_tags .= '<hr/>';
// checkbox

$content_tags .= '<p>' . __e("Screens on which to show the box:") . '</p>';
$content_tags .= '<div class="row">';
$options = array();

$post_types = $db->getCustomPosts();
foreach ($post_types as $post_type)
{
    $post_type_name = $string->toVar($project['short-name'] . '_' . $post_type['name']);
    $post_type_label = $post_type['label'];
    $options[] = array("value" => $post_type_name, "label" => $post_type_label . ' (<code>' . $post_type_name . '</code>)');
}

$options[] = array("value" => "post", "label" => "WordPress Post (<code>post</code>)");
$options[] = array("value" => "page", "label" => "WordPress Page (<code>page</code>)");
$options[] = array("value" => "link", "label" => "WordPress Link (<code>link</code>)");
$options[] = array("value" => "comment", "label" => "WordPress Comment (<code>comment</code>)");

$options[] = array("value" => "product", "label" => "WooCommerce Product (<code>product</code>)");

$z = 0;
foreach ($options as $opt)
{
    $selected = "";
    foreach ($currentData['meta-boxes']['screen'] as $item)
    {
        if ($opt["value"] == $item)
        {
            $selected = "checked";
        }
    }
    $content_tags .= '<div class="col-md-4">';
    $content_tags .= '<div class="form-group clearfix">';
    $content_tags .= '<div class="icheck-danger">';
    $content_tags .= '<input id="meta-boxes-screen-' . $opt["value"] . '-' . $z . '" ' . $selected . '  type="checkbox" name="meta-boxes[screen][' . $z . ']"  class="form-control" placeholder="" value="' . $opt["value"] . '" />';
    $content_tags .= '<label for="meta-boxes-screen-' . $opt["value"] . '-' . $z . '">' . $opt["label"] . '</label>';
    $content_tags .= '</div>';
    $content_tags .= '</div>';
    $content_tags .= '</div>';
    $z++;
}
$content_tags .= '</div>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-info btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=metaBoxes" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=metaBoxes" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


$content_tags .= '<div class="card card-outline card-danger">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-question-circle"></i>&nbsp;';
$content_tags .= __e("Sample Code and References");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: ========================================================
$content_tags .= '<div class="card-body">';

$content_tags .= '<div class="callout callout-success">';
$content_tags .= __e('These instructions are dynamic according to the conditions of the project being worked on');
$content_tags .= '</div>';

$content_tags .= '<h3>' . __e("Retrieves metadata") . '</h3>';
$example_code = null;
$example_code .= "" . '<?php' . "\r\n";
if (count($currentData['meta-boxes']['fields']) != 0)
{
    foreach ($currentData['meta-boxes']['fields'] as $field)
    {
        $meta_prefix = $string->toVar($project['short-name'] . '_' . $field['name']);
        $example_code .= '$metadata = get_post_meta($post->ID, "_' . $meta_prefix . '", true);' . "\r\n";
    }
} else
{
    $example_code .= '$metadata = get_post_meta($post->ID, "_example_metadata", true);' . "\r\n";
}
$content_tags .= '<div class="example-code">';
$content_tags .= highlight_string($example_code, true);
$content_tags .= '</div>';

$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<h5>' . __e("Code References") . ':</h5>';
$content_tags .= '<ul>';

$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/add_meta_box/">add_meta_box</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/update_post_meta/">update_post_meta</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/get_post_meta/">get_post_meta</a>' . '</p></li>';

$content_tags .= '</ul>';
$content_tags .= '</div>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=metaBoxes" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=metaBoxes" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


$content_tags .= '</div>'; //col-md-6
$content_tags .= '</div>'; //row

// TODO: LAYOUT --|-- CUSTOM-FIELDS --|--
$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-12">';
$content_tags .= '<div class="card card-outline card-danger">';
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
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/meta-boxes.php</code></p>';
$content_tags .= '<hr/>';

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
foreach ($currentData['meta-boxes']['fields'] as $field)
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
    $select_option .= '<select name="meta-boxes[fields][' . $c . '][type]" data-target="' . $c . '" class="form-control meta-boxes-type" >';
    foreach ($__options as $option)
    {
        $selected = '';
        if ($option['name'] == $field['type'])
        {
            $selected = 'selected';
        }
        $select_option .= '<option ' . $selected . ' value="' . $option['name'] . '">' . $option['label'] . '</option>';
    }
    $select_option .= '</select>';


    $content_tags .= '<tr id="field-no-' . $c . '"  class="item">';
    $content_tags .= '<td class="handle text-center vcenter"><i class="fas fa-arrows-alt"></i><p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
    $content_tags .= '<td class="vcenter">' . $select_option . '<p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
    $content_tags .= '<td class="vcenter"><input name="meta-boxes[fields][' . $c . '][name]" placeholder="field-' . $c . '" class="form-control" type="text" value="' . $field['name'] . '"/><p class="helper-block"><strong>format</strong>: a-z, A-Z,0-9, and -<br/>don\'t use the number in the 1st variable</p></td>';
    $content_tags .= '<td class="vcenter"><input name="meta-boxes[fields][' . $c . '][label]" placeholder="Field ' . $c . '"  class="form-control" type="text" value="' . $field['label'] . '"/><p class="helper-block"><strong>format</strong>: text<br/>&nbsp;</p></td>';

    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="meta-box-options-' . $c . '" name="meta-boxes[fields][' . $c . '][options]" class="form-control" type="text" value="' . $field['options'] . '"/>';
    $content_tags .= '<span id="meta-box-options-select-' . $c . '"></span>';
    $content_tags .= '<p class="helper-block"><span id="meta-box-options-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';

    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="meta-box-default-' . $c . '" name="meta-boxes[fields][' . $c . '][default]" class="form-control" type="text" value="' . $field['default'] . '"/>';
    $content_tags .= '<p class="helper-block"><span id="meta-box-default-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';

    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="meta-box-info-' . $c . '" name="meta-boxes[fields][' . $c . '][info]" class="form-control" type="text" value="' . $field['info'] . '"/>';
    $content_tags .= '<p class="helper-block"><span id="meta-box-info-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';

    $content_tags .= '<td class="text-center vcenter"><a class="btn btn-danger btn-sm remove-item" data-target="#field-no-' . $c . '" href="#!_"><i class="fa fa-trash"></i></a><p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
    $content_tags .= '</tr>';
    $c++;
}

// TODO: LAYOUT --|-- CUSTOM-FIELDS --|-- TABLE --|-- ADD FIELDS

$c++;
$select_option = null;
$select_option .= '<select name="meta-boxes[fields][' . $c . '][type]" data-target="' . $c . '"  class="form-control meta-boxes-type" >';
foreach ($__options as $option)
{
    $select_option .= '<option value="' . $option['name'] . '">' . $option['label'] . '</option>';
}
$select_option .= '</select>';

$content_tags .= '<tr id="field-no-' . $c . '">';
$content_tags .= '<td class="text-center vcenter"><a href="#!_"><i class="fa fa-move"></i></a></td>';
$content_tags .= '<td class="text-center vcenter">' . $select_option . '<p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
$content_tags .= '<td class="text-center vcenter"><input name="meta-boxes[fields][' . $c . '][name]" placeholder="field-' . $c . '" class="form-control" type="text" value=""/><p class="helper-block"><strong>format</strong>: a-z, A-Z,0-9, and -<br/>don\'t use the number in the 1st variable</p></td>';
$content_tags .= '<td class="text-center vcenter"><input name="meta-boxes[fields][' . $c . '][label]" placeholder="Field ' . $c . '" class="form-control" type="text" value=""/><p class="helper-block"><strong>format</strong>: text<br/>&nbsp;</p></td>';

$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="meta-box-options-' . $c . '" name="meta-boxes[fields][' . $c . '][options]" class="form-control" type="text" value=""/><span id="meta-box-options-select-' . $c . '"></span>';
$content_tags .= '<p class="helper-block"><span id="meta-box-options-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
$content_tags .= '</td>';

$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="meta-box-default-' . $c . '" name="meta-boxes[fields][' . $c . '][default]" class="form-control" type="text" value=""/>';
$content_tags .= '<p class="helper-block"><span id="meta-box-default-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
$content_tags .= '</td>';

$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="meta-box-info-' . $c . '" name="meta-boxes[fields][' . $c . '][info]" class="form-control" type="text" value=""/>';
$content_tags .= '<p class="helper-block"><span id="meta-box-info-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
$content_tags .= '</td>';

$content_tags .= '<td class="text-center vcenter"><input name="submit" type="submit" class="btn btn-primary" value="' . __e("Add Field") . '" /><p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
$content_tags .= '</tr>';
$content_tags .= '</tbody>';
$content_tags .= '</table>';


$content_tags .= '</div>'; //card-body
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=metaBoxes" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=metaBoxes" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card
$content_tags .= '</div>'; //col-md-12
$content_tags .= '</div>'; //row

// TODO: ========================================================
// TODO: LAYOUT --|-- CUSTOM-CODE --|--
$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-12">';

$content_tags .= '<div class="card card-outline card-info">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fab fa-php"></i>&nbsp;';
$content_tags .= __e("Custom Code");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
$content_tags .= '<div class="card-body">';

$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/meta-boxes.php</code></p>';
$content_tags .= '<hr/>';
$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<p>' . __e("To use this feature you must change the General Settings: ") . '<strong>Types of Generator = <code>Custom Code</code></strong>' . __e(' and ') . '<strong>Copy To Custom Code = <code>OFF</code></strong></p>';
$content_tags .= '</div>';
$content_tags .= '<h3>';
$content_tags .= __e("Render Content");
$content_tags .= '</h3>';
$content_tags .= '<textarea name="meta-boxes[custom-code][render-content]" class="form-control" data-type="php">' . htmlentities($currentData['meta-boxes']['custom-code']['render-content']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';

$content_tags .= '<h3>';
$content_tags .= __e("Save Post");
$content_tags .= '</h3>';
$content_tags .= '<textarea name="meta-boxes[custom-code][save-post]" class="form-control" data-type="php">' . htmlentities($currentData['meta-boxes']['custom-code']['save-post']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';


$content_tags .= '<h3>';
$content_tags .= __e("Admin Footer");
$content_tags .= '</h3>';
$content_tags .= '<textarea name="meta-boxes[custom-code][admin-footer]" class="form-control" data-type="php">' . htmlentities($currentData['meta-boxes']['custom-code']['admin-footer']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';

$content_tags .= '<h3>';
$content_tags .= __e("Admin Enqueue Scripts");
$content_tags .= '</h3>';
$content_tags .= '<textarea name="meta-boxes[custom-code][admin-enqueue-scripts]" class="form-control" data-type="php">' . htmlentities($currentData['meta-boxes']['custom-code']['admin-enqueue-scripts']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';


$content_tags .= '</div>'; //card-body
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-info btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=metaBoxes" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=metaBoxes" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


$content_tags .= '</div>'; //col-md-12
$content_tags .= '</div>'; //row

$content_tags .= '</form>';

// TODO: ========================================================
switch ($_GET["a"])
{
    case "list":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=metaBoxes">' . __e("Meta Boxes") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("List") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags .= '<div class="card card-outline card-info">';
        $_content_tags .= '<div class="card-body">';

        $_content_tags .= '<div class="welcome">';
        $_content_tags .= '<h2>' . __e('Posts') . '</h2>';
        $_content_tags .= '<h1>' . __e('Meta Boxes ') . '</h1>';
        $_content_tags .= '<p class="lead">' . __e('Additional information added to your posts as metadata (custom fields)') . '</p>';
        $_content_tags .= '</div>';

        // TODO: LIST --|-- TABLE
        $_content_tags .= '<table data-type="datatable" class="table datatable table-bordered">';
        $_content_tags .= '<thead>';
        $_content_tags .= '<tr>';
        $_content_tags .= '<th>' . __e("Name") . '</th>';
        $_content_tags .= '<th>' . __e("Title") . '</th>';
        $_content_tags .= '<th>' . __e("Note") . '</th>';
        $_content_tags .= '<th style="width: 50% !important;">' . __e("Custom Fields") . '</th>';
        $_content_tags .= '<th>' . __e("Screen") . '</th>';
        //$_content_tags .= '<th class="text-center">' . __e("Context") . '</th>';
        //$_content_tags .= '<th class="text-center">' . __e("Priorities") . '</th>';

        $_content_tags .= '<th class="text-center">' . __e("Action") . '</th>';
        $_content_tags .= '</tr>';
        $_content_tags .= '</thead>';
        $_content_tags .= '<tbody>';
        $meta_boxes = $db->getMetaBoxes();
        foreach ($meta_boxes as $meta_box)
        {
            $context_color = 'secondary';
            switch ($meta_box['context'])
            {
                case 'normal':
                    $context_color = 'primary';
                    break;
                case 'side':
                    $context_color = 'success';
                    break;
                case 'advanced':
                    $context_color = 'info';
                    break;
            }


            $priority_color = 'secondary';
            switch ($meta_box['priority'])
            {
                case 'default':
                    $priority_color = 'success';
                    break;
                case 'low':
                    $priority_color = 'primary';
                    break;
                case 'high':
                    $priority_color = 'danger';
                    break;
            }

            if (!isset($meta_box['screen']))
            {
                $meta_box['screen'] = array();
            }
            if (!is_array($meta_box['screen']))
            {
                $meta_box['screen'] = array();
            }
            $new_screen = array();
            foreach ($meta_box['screen'] as $screen)
            {
                $new_screen[] = '<span class="badge badge-info">' . $screen . '</span>';
            }


            $custom_field_fields = '';
            $new_fields = array();
            if (isset($meta_box['fields']))
            {
                foreach ($meta_box['fields'] as $field)
                {
                    $new_fields[] = $string->toVar($project['short-name'] . '_' . $field['name']);
                }
                if (count($meta_box['fields']) != 0)
                {
                    $custom_field_fields = '<span class="badge badge-success">' . implode('</span> <span class="badge badge-success">', $new_fields) . '</span>';
                }
            }

            $_content_tags .= '<tr>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $meta_box['name'] . '</code></td>';
            $_content_tags .= '<td>' . $meta_box['title'] . '</td>';
            $_content_tags .= '<td>' . $meta_box['note'] . '</td>';
            $_content_tags .= '<td>' . $custom_field_fields . '</td>';
            $_content_tags .= '<td>' . implode(' ', $new_screen) . '</td>';

            //$_content_tags .= '<td class="text-center align-middle"><span class="badge badge-' . $context_color . '">' . $meta_box['context'] . '</span></td>';
            //$_content_tags .= '<td class="text-center align-middle"><span class="badge badge-' . $priority_color . '">' . $meta_box['priority'] . '</span></td>';

            $_content_tags .= '<td class="text-center align-middle">';
            $_content_tags .= '<div class="btn-group btn-group-sm">';
            $_content_tags .= '<a href="#' . $meta_box['name'] . '" data-toggle="modal" data-target="#modal-trash-meta-boxes-' . $meta_box['name'] . '" data-href="./?p=metaBoxes&amp;a=trash&amp;n=' . $meta_box['name'] . '" class="btn btn-danger"><i class="fa fa-trash"></i> ' . __e("Trash") . '</a>';
            $_content_tags .= '<a href="./?p=metaBoxes&amp;a=edit&amp;n=' . $meta_box['name'] . '" class="btn btn-success"><i class="fa fa-edit"></i> ' . __e("Edit") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</td>';
            $_content_tags .= '</tr>';
        }
        $_content_tags .= '</tbody>';
        $_content_tags .= '</table>';
        $_content_tags .= '</div>';
        $_content_tags .= '<div class="card-footer">';
        $_content_tags .= '<a href="./?p=metaBoxes&amp;a=new" class="btn btn-success"><i class="fa fa-plus-circle"></i> ' . __e("Add New Meta Boxes") . '</a>';
        $_content_tags .= '</div>';
        $_content_tags .= '</div>';
        // TODO: LIST --|-- MODAL
        foreach ($meta_boxes as $meta_box)
        {
            $context_color = 'secondary';
            switch ($meta_box['context'])
            {
                case 'normal':
                    $context_color = 'primary';
                    break;
                case 'side':
                    $context_color = 'success';
                    break;
                case 'advanced':
                    $context_color = 'info';
                    break;
            }


            $priority_color = 'secondary';
            switch ($meta_box['priority'])
            {
                case 'default':
                    $priority_color = 'success';
                    break;
                case 'low':
                    $priority_color = 'primary';
                    break;
                case 'high':
                    $priority_color = 'danger';
                    break;
            }

            $_content_tags .= '<div class="modal fade" id="modal-trash-meta-boxes-' . $meta_box['name'] . '">';
            $_content_tags .= '<div class="modal-dialog">';
            $_content_tags .= '<div class="modal-content bg-default">';
            $_content_tags .= '<div class="modal-header">';
            $_content_tags .= '<h4 class="modal-title">' . __e("Confirm") . '</h4>';
            $_content_tags .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            $_content_tags .= '<span aria-hidden="true">&times;</span></button>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-body">';
            $_content_tags .= '<p>' . __e("Are you sure You want to delete this meta-box?") . '</p>';
            $_content_tags .= '<table class="table-grid">';

            $_content_tags .= '<tr>';
            $_content_tags .= '<td rowspan="4" style="text-align: center;"><i class="fa fa-edit trash-logo"></i></td>';
            $_content_tags .= '<td>' . __e("Name") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $meta_box['name'] . '</code></td>';
            $_content_tags .= '</tr>';

            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Title") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td>' . $meta_box['title'] . '</td>';
            $_content_tags .= '</tr>';

            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Context") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><span class="badge badge-' . $context_color . '">' . $meta_box['context'] . '</span></td>';
            $_content_tags .= '</tr>';

            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Priority") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><span class="badge badge-' . $priority_color . '">' . $meta_box['priority'] . '</span></td>';
            $_content_tags .= '</tr>';


            $_content_tags .= '</table>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-footer justify-content-between">';
            $_content_tags .= '<button type="button" class="btn btn-default" data-dismiss="modal">' . __e("Close") . '</button>';
            $_content_tags .= '<a href="./?p=metaBoxes&amp;a=trash&amp;n=' . $meta_box['name'] . '" class="btn btn-danger">' . __e("Yes, I am sure!") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
        }

        break;
    case "new":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=metaBoxes">' . __e("Meta Boxes") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("New") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
    case "edit":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=metaBoxes">' . __e("Meta Boxes") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("Edit") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
}

$pagejs = null;
$pagejs .= "\t\t" . '' . "\r\n";
$c = 0;
$pagejs .= "\t\t" . 'var meta_box_type = [];' . "\r\n";
$pagejs .= "\t\t" . 'var meta_box_name = [];' . "\r\n";
$pagejs .= "\t\t" . 'var meta_box_label = [];' . "\r\n";
$pagejs .= "\t\t" . 'var meta_box_options = [];' . "\r\n";

foreach ($currentData['meta-boxes']['fields'] as $field)
{
    $pagejs .= "\t\t" . 'meta_box_type[' . $c . '] = "' . $field["type"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'meta_box_name[' . $c . '] = "' . $field["name"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'meta_box_label[' . $c . '] = "' . $field["label"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'meta_box_options[' . $c . '] = "' . $field["options"] . '" ;' . "\r\n";
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
    $pagejs .= "\t\t\t\t\t" . '$("#meta-box-options-select-" + item_target).html("");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#meta-box-options-" + item_target).removeClass("hidden");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#meta-box-default-" + item_target).removeClass("hidden");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#meta-box-info-" + item_target).removeClass("hidden");' . "\r\n";

    $pagejs .= "\t\t\t\t\t" . '$("#meta-box-options-" + item_target).prop("type","' . $__opt['options']['type'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#meta-box-options-" + item_target).attr("placeholder","' . $__opt['options']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#meta-box-options-help-" + item_target).html("' . $__opt['options']['help'] . '");' . "\r\n";

    $pagejs .= "\t\t\t\t\t" . '$("#meta-box-default-" + item_target).prop("type","' . $__opt['default']['type'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#meta-box-default-" + item_target).attr("placeholder","' . $__opt['default']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#meta-box-default-help-" + item_target).html("' . $__opt['default']['help'] . '");' . "\r\n";

    $pagejs .= "\t\t\t\t\t" . '$("#meta-box-info-" + item_target).attr("placeholder","' . $__opt['info']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#meta-box-info-help-" + item_target).html("' . $__opt['info']['help'] . '");' . "\r\n";

    //$pagejs .= "\t\t\t\t\t" . '$("#meta-box-options-" + item_target).val("' . $__opt['options']['value'] . '");' . "\r\n";
    //$pagejs .= "\t\t\t\t\t" . '$("#meta-box-default-" + item_target).val("' . $__opt['default']['value'] . '");' . "\r\n";
    //$pagejs .= "\t\t\t\t\t" . '$("#meta-box-info-" + item_target).val("' . $__opt['info']['value'] . '");' . "\r\n";


    $pagejs .= $__opt['code']['js'];

    $pagejs .= "\t\t\t\t\t" . 'break;' . "\r\n";
}
$pagejs .= "\t\t\t" . '}' . "\r\n";
$pagejs .= "\t\t" . '}' . "\r\n";


$pagejs .= "\t\t" . '$(".meta-boxes-type").on("click",function(){' . "\r\n";
$pagejs .= "\t\t\t" . 'customFields(this);' . "\r\n";
$pagejs .= "\t\t" . '});' . "\r\n";

$pagejs .= "\t\t" . 'var itemType = $(".meta-boxes-type");' . "\r\n";
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


define('IHS_LAYOUT_CONTENT', $_content_tags);
define('IHS_LAYOUT_BREADCRUMB', $breadcrumb_tags);
define('IHS_PAGE_NAME', __e("Meta Boxes"));
define('IHS_PAGE_DESC', __e("Additional information added to your posts as metadata"));
define('IHS_PAGE_JS', $pagejs);
