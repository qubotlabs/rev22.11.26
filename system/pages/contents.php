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
$shortname = strtolower($project['short-name']);

// TODO: ACTION --|-- SUBMIT --|--

if (isset($_POST['submit']))
{
    $postData['contents']['name'] = ""; //text
    $postData['contents']['post_type'] = "posts"; //select
    $postData['contents']['type_of_code'] = "auto"; //select
    $postData['contents']['overwrite_custom_code'] = true; //boolean
    $postData['contents']['enqueue_scripts'] = array(); //checkbox

    // TODO: ACTION --|-- SUBMIT --|-- POST RESPONSE
    // text
    if (isset($_POST['contents']['name']))
    {
        $postData['contents']['name'] = $_POST['contents']['name'];
    }
    // select
    if (isset($_POST['contents']['post_type']))
    {
        $postData['contents']['post_type'] = $_POST['contents']['post_type'];
    }
    // edit
    if (isset($_GET["n"]))
    {
        $_POST["contents"]["name"] = $_GET["n"];
    }

    // text
    if (isset($_POST['contents']['custom-code']['singular']))
    {
        $postData['contents']['custom-code']['singular'] = $_POST['contents']['custom-code']['singular'];
    }

    // boolean
    if (isset($_POST['contents']['overwrite_custom_code']))
    {
        $postData['contents']['overwrite_custom_code'] = true;
    } else
    {
        $postData['contents']['overwrite_custom_code'] = false;
    }

    // select
    if (isset($_POST['contents']['type_of_code']))
    {
        $postData['contents']['type_of_code'] = $_POST['contents']['type_of_code'];
    }

    // checkbox
    if (isset($_POST['contents']['enqueue_scripts']))
    {
        $postData['contents']['enqueue_scripts'] = $_POST['contents']['enqueue_scripts'];
    }


    if (isset($_POST['contents']['front-ends']))
    {
        $y = 0;
        foreach ($_POST['contents']['front-ends'] as $fields)
        {
            if (trim($fields['name']) != '')
            {
                $postData['contents']['front-ends'][$y]['type'] = $fields['type'];
                $postData['contents']['front-ends'][$y]['name'] = trim($string->toFileName($fields['name']));
                $postData['contents']['front-ends'][$y]['label'] = trim($fields['label']);
                $postData['contents']['front-ends'][$y]['option'] = trim($fields['option']);
                $y++;
            }
        }
    }


    // TODO: ACTION --|-- SUBMIT --|-- SAVE DATA

    // validate and save postdata
    $db->saveContent($postData['contents']);
    $db->current();
    $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Contents saved successfully!");
    if ($_GET["a"] == "edit")
    {
        header("Location: ./?p=contents&a=edit&alert=success&n=" . $_GET["n"] . "&" . time());
    } else
    {
        header("Location: ./?p=contents&a=list&alert=success&" . time());
    }
}


// TODO: ACTION --|-- REMOVE --|-- CONTENTS
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "trash")
    {
        $_prefix = basename($_GET["n"]);
        $db->removeContent($_prefix);
        $db->current();
        $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Content deleted successfully!");
        header("Location: ./?p=contents&a=list&alert=warning&" . time());
    }
}


// TODO: LAYOUT --|-- GENERAL
$disabled = "";
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "edit")
    {
        $_prefix = basename($_GET["n"]);
        $currentData["contents"] = $db->getContent($_prefix);
        $disabled = "disabled";
    }
}


// TODO: LAYOUT --|-- GENERAL --|-- INIT
//text
if (!isset($currentData['contents']['name']))
{
    $currentData['contents']['name'] = "";
}
//select
if (!isset($currentData['contents']['post_type']))
{
    $currentData['contents']['post_type'] = "posts";
}

//select
if (!isset($currentData['contents']['type_of_code']))
{
    $currentData['contents']['type_of_code'] = "auto";
}

//boolean
if (!isset($currentData['contents']['overwrite_custom_code']))
{
    $currentData['contents']['overwrite_custom_code'] = true;
}

//text
if (!isset($currentData['contents']['custom-code']['singular']))
{
    $currentData['contents']['custom-code']['singular'] = "";
}

//checkbox
if (!isset($currentData['contents']['enqueue_scripts']))
{
    $currentData['contents']['enqueue_scripts'] = array();
}

if (!isset($currentData['contents']['front-ends']))
{
    $currentData['contents']['front-ends'] = array();
}

$ex_name = 'unknow';
if ($currentData['contents']['name'] != '')
{
    $ex_name = $currentData['contents']['name'];
}

$_SESSION['DUMMY_APPLY_FOR'] = $currentData['contents']['post_type'];

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
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/contents/' . $ex_name . '.php</code></p>';
$content_tags .= '<hr/>';

// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="name" class="col-sm-3 col-form-label">' . __e("Name") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<input required type="text" name="contents[name]"  class="form-control" id="field-name" placeholder="my-post" value="' . $currentData['contents']['name'] . '">';
$content_tags .= '<p class="help-block">' . __e("Name must not exceed 20 characters and may only contain a-z, 0-9, and - characters") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// select
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- POST_TYPE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="post_type" class="col-sm-3 col-form-label">' . __e("Apply to?") . '</label>';
$content_tags .= '<div class="col-sm-5">';
$content_tags .= '<select class="form-control" id="field-post_type-select">';


$options = array();
$options[] = array("value" => "", "label" => "Choose or Write");
$options[] = array("value" => "post", "label" => "Post (WordPress Core)");
$options[] = array("value" => "page", "label" => "Page (WordPress Core)");
$options[] = array("value" => "product", "label" => "Product (WooCommerce Core)");

$post_types = $db->getCustomPosts();
foreach ($post_types as $post_type)
{
    $post_type_name = $string->toVar($project['short-name'] . '_' . $post_type['name']);
    $post_type_label = $post_type['label'];
    $options[] = array("value" => $post_type_name, "label" => $post_type_label . ' (' . $post_type_name . ')');
}


foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['contents']['post_type'])
    {
        $selected = "selected";
    }
    $content_tags .= '<option ' . $selected . ' value="' . $opt["value"] . '">' . $opt["label"] . '</option>';
}
$content_tags .= '</select>';

$content_tags .= '</div>';
$content_tags .= '</div>';


// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- POST_TYPE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="name" class="col-sm-3 col-form-label"></label>';
$content_tags .= '<div class="col-sm-5">';
$content_tags .= '<input required type="text" name="contents[post_type]"  class="form-control" id="field-post_type" placeholder="my-post" value="' . $currentData['contents']['post_type'] . '">';
$content_tags .= '<p class="help-block">' . __e("Write OR Select the name of the post to be modified") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


$content_tags .= '<hr/>';

// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- TYPE_OF_CODE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="type_of_code" class="col-sm-3 col-form-label">' . __e("Types of Generator") . '</label>';
$content_tags .= '<div class="col-sm-5">';
$content_tags .= '<select name="contents[type_of_code]" class="form-control" id="field-type_of_code">';
$options = array();
$options[] = array("value" => "auto", "label" => "Auto Code");
$options[] = array("value" => "custom-code", "label" => "Custom Code");
foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['contents']['type_of_code'])
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
if ($currentData['contents']['overwrite_custom_code'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="contents[overwrite_custom_code]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="contents[overwrite_custom_code]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
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
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=contents" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=contents&amp;n=' . $string->toFileName($currentData['contents']['name']) . '&amp;n=' . $string->toFileName($currentData['contents']['name']) . '" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card

$content_tags .= '</div>'; //col-md-6

$content_tags .= '<div class="col-md-6">';

// TODO: LAYOUT --|-- INSTRUCTIONS
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
// TODO: LAYOUT --|-- INSTRUCTIONS --|-- CODE
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/contents/' . $ex_name . '.php</code></p>';
$content_tags .= '<hr/>';


$content_tags .= '<h3>' . __e("Image Sizes") . '</h3>';
$example_code = null;
$example_code .= "" . '<?php' . "\r\n";
$example_code .= "" . '$postID = get_the_ID();' . "\r\n";
$example_code .= "" . '$attachmentID = get_post_thumbnail_id($postID);' . "\r\n";
$imageSizes = $db->getImageSizes();
foreach ($imageSizes as $imageSize)
{
    $example_code .= "" . '$image["' . $imageSize['name'] . '"] = wp_get_attachment_image_src($attachmentID,"' . $shortname . '_' . $imageSize['name'] . '");' . "\r\n";
}
$example_code .= "" . '$new_content .= "<img src=\"".$image["large"][0]."\" width=\"".$image["large"][1]."\" height=\"".$image["large"][2]."\"  />";' . "\r\n";

$content_tags .= '<div class="example-code">';
$content_tags .= highlight_string($example_code, true);
$content_tags .= '</div>';


$content_tags .= '<h3>' . __e("Plugin Option") . '</h3>';
$example_code = null;
$example_code .= "" . '<?php' . "\r\n";
$pluginOptions = $db->getPluginOptions();
foreach ($pluginOptions as $pluginOption)
{
    $example_code .= "" . '$option = get_option("' . $shortname . '_' . $string->toVar($pluginOption['name']) . '_setting");' . "\r\n";
    foreach ($pluginOption['fields'] as $field)
    {
        $example_code .= "" . '$new_content .= $option["' . $shortname . '_' . $field['name'] . '"] ;' . "\r\n";
    }
}

$content_tags .= '<div class="example-code">';
$content_tags .= highlight_string($example_code, true);
$content_tags .= '</div>';

$content_tags .= '<h3>' . __e("Custom Fields") . '</h3>';
$example_code = null;
$example_code .= "" . '<?php' . "\r\n";
$meta_boxes = $db->getMetaBoxes();
foreach ($meta_boxes as $meta_box)
{
    if (!is_array($meta_box['fields']))
    {
        $meta_box['fields'] = array();
    }
    $screen = implode($meta_box['screen']);
    foreach ($meta_box['fields'] as $field)
    {
        $regex = $currentData['contents']['post_type'];
        if (preg_match("/" . $regex . "/", $screen))
        {
            $example_code .= "" . '$new_content .= get_post_meta($postID,"_' . $shortname . '_' . $string->toVar($field['name']) . '",true) ;' . "\r\n";
        }

    }
}


$content_tags .= '<div class="example-code">';
$content_tags .= highlight_string($example_code, true);
$content_tags .= '</div>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=contents" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=contents&amp;n=' . $string->toFileName($currentData['contents']['name']) . '" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card
$content_tags .= '</div>'; //col-md-6
$content_tags .= '</div>'; //row


$content_tags .= '<div class="card card-outline card-success">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-filter"></i>&nbsp;';
$content_tags .= __e("Front-end Content");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- FRONT-END
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/contents/' . $ex_name . '.php</code></p>';
$content_tags .= '<hr/>';


$module_path = IHS_MODULE_DIR . '/contents/front-ends/*.mod.php';
$__front_ends = array();
foreach (glob($module_path) as $filename)
{
    $module = null;
    include ($filename);
    $__front_ends[] = $module;
}


$content_tags .= '<h4>' . __e("Add the Scripts Files") . ':</h4>';

$content_tags .= '<table class="table table-striped">';
$content_tags .= '<thead>';
$content_tags .= '<tr>';
$content_tags .= '<th>' . __e("Enqueue") . '</th>';
$content_tags .= '<th>' . __e("Source") . '</th>';
$content_tags .= '</tr>';
$content_tags .= '</thead>';

$options = array();
$options[] = array(
    "label" => "Javascript File",
    "value" => "scripts",
    "path" => 'assets/js/' . $ex_name . '-content.js');
$options[] = array(
    "label" => "CSS Style File",
    "value" => "styles",
    "path" => 'assets/css/' . $ex_name . '-content.css');
$z = 0;
foreach ($options as $opt)
{
    $selected = "";
    foreach ($currentData['contents']['enqueue_scripts'] as $item)
    {
        if ($opt["value"] == $item)
        {
            $selected = "checked";
        }
    }
    $content_tags .= '<tr>';

    $content_tags .= '<td style="padding-bottom: 0;padding-top: 0;">';
    $content_tags .= '<div class="form-group" style="margin-bottom: 0 !important;">';
    $content_tags .= '<div class="icheck-danger">';
    $content_tags .= '<input id="contents-enqueue_scripts-' . $opt["value"] . '-' . $z . '" ' . $selected . '  type="checkbox" name="contents[enqueue_scripts][' . $opt["value"] . ']"  class="form-control" placeholder="" value="' . $opt["value"] . '" />';
    $content_tags .= '<label for="contents-enqueue_scripts-' . $opt["value"] . '-' . $z . '">' . $opt["label"] . '</label>';
    $content_tags .= '</div>';
    $content_tags .= '</div>';
    $content_tags .= '</td>';


    $content_tags .= '<td>';
    $content_tags .= '<code>' . $opt['path'] . '</code>';
    $content_tags .= '</td>';
    $content_tags .= '</tr>';
    $z++;
}

$content_tags .= '</table>';

$content_tags .= '<br/>';


$content_tags .= '<h4>' . __e("Examples of codes:") . '</h4>';

// TODO: LAYOUT --|-- FRONT-END --|-- TABLE
$content_tags .= '<table class="table table-striped table-bordered">';
$content_tags .= '<thead>';
$content_tags .= '<tr>';
$content_tags .= '<th class="text-center vcenter">#</th>';
$content_tags .= '<th class="text-center vcenter">' . __e("Type") . '</th>';
$content_tags .= '<th class="text-center vcenter">' . __e("Name") . '</th>';
$content_tags .= '<th class="text-center vcenter">' . __e("Label") . '</th>';
$content_tags .= '<th class="text-center vcenter">' . __e("Option") . '</th>';
$content_tags .= '<th class="text-center vcenter"></th>';
$content_tags .= '</tr>';
$content_tags .= '</thead>';
$content_tags .= '<tbody class="item-list">';

// TODO: LAYOUT --|-- FRONT-END --|-- TABLE --|-- EDIT

$c = 0;
foreach ($currentData['contents']['front-ends'] as $field)
{
    if (!isset($field['name']))
    {
        $field['name'] = '';
    }


    $select_option = null;
    $select_option .= '<select name="contents[front-ends][' . $c . '][type]" data-target="' . $c . '" class="form-control contents-front-end-type" >';
    foreach ($__front_ends as $__front_end)
    {
        $selected = '';
        if ($__front_end['name'] == $field['type'])
        {
            $selected = 'selected';
        }
        $select_option .= '<option ' . $selected . ' value="' . $__front_end['name'] . '">' . $__front_end['label'] . '</option>';
    }
    $select_option .= '</select>';


    $content_tags .= '<tr id="field-no-' . $c . '"  class="item">';
    $content_tags .= '<td class="handle text-center vcenter"><i class="fas fa-arrows-alt"></i><p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
    $content_tags .= '<td class="vcenter">' . $select_option . '<p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
    $content_tags .= '<td class="vcenter"><input name="contents[front-ends][' . $c . '][name]" class="form-control" type="text" value="' . $field['name'] . '"/><p class="helper-block"><strong>format</strong>: a-z, A-Z,0-9, and -<br/>don\'t use the number in the 1st variable</p></td>';
    $content_tags .= '<td class="vcenter"><input name="contents[front-ends][' . $c . '][label]" class="form-control" type="text" value="' . $field['label'] . '"/><p class="helper-block"><strong>format</strong>: text<br/>&nbsp;</p></td>';

    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="contents-front-end-option-' . $c . '" name="contents[front-ends][' . $c . '][option]" class="form-control" type="text" value="' . $field['option'] . '"/><span id="contents-front-end-option-select-' . $c . '"></span>';
    $content_tags .= '<p class="helper-block"><span id="contents-front-end-option-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';


    $content_tags .= '<td class="text-center vcenter"><a class="btn btn-danger btn-sm remove-item" data-target="#field-no-' . $c . '" href="#!_"><i class="fa fa-trash"></i></a><p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
    $content_tags .= '</tr>';
    $c++;
}

// TODO: LAYOUT --|-- FRONT-END --|-- TABLE --|-- ADD

$c++;
$select_option = null;
$select_option .= '<select class="form-control contents-front-end-type" name="contents[front-ends][' . $c . '][type]" data-target="' . $c . '"   >';
foreach ($__front_ends as $__front_end)
{
    $select_option .= '<option value="' . $__front_end['name'] . '">' . $__front_end['label'] . '</option>';
}
$select_option .= '</select>';

$content_tags .= '<tr id="field-no-' . $c . '">';
$content_tags .= '<td class="text-center vcenter"><a href="#!_"><i class="fa fa-move"></i></a></td>';
$content_tags .= '<td class="text-center vcenter">' . $select_option . '<p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
$content_tags .= '<td class="text-center vcenter"><input name="contents[front-ends][' . $c . '][name]" class="form-control" type="text" value=""/><p class="helper-block"><strong>format</strong>: a-z, A-Z,0-9, and -<br/>don\'t use the number in the 1st variable</p></td>';
$content_tags .= '<td class="text-center vcenter"><input name="contents[front-ends][' . $c . '][label]" class="form-control" type="text" value=""/><p class="helper-block"><strong>format</strong>: text<br/>&nbsp;</p></td>';
$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="contents-front-end-option-' . $c . '" name="contents[front-ends][' . $c . '][option]" class="form-control" type="text" value=""/>';
$content_tags .= '<span id="contents-front-end-option-select-' . $c . '"></span>';
$content_tags .= '<p class="helper-block"><span id="contents-front-end-option-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
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
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=contents" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=contents&amp;n=' . $string->toFileName($currentData['contents']['name']) . '" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


$content_tags .= '<div class="card card-outline card-default">';
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
// TODO: LAYOUT --|--
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/contents/' . $ex_name . '.php</code></p>';
$content_tags .= '<hr/>';

$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<p>' . __e("To use this feature you must change the General Settings: ") . '<strong>Types of Generator = <code>Custom Code</code></strong>' . __e(' and ') . '<strong>Copy To Custom Code = <code>OFF</code></strong></p>';
$content_tags .= '</div>';

$content_tags .= '<p>';
$content_tags .= __e("Use the <code>\$new_content</code> variable to return and <code>\$content</code> to get the original content");
$content_tags .= '</p>';

$content_tags .= '<pre>';
$content_tags .= '$new_content = $content ;' . "\r\n";
$content_tags .= '$new_content .= "&lt;h1&gt;Hello Word&lt;/h1&gt;" ;' . "\r\n";
$content_tags .= '</pre>';


$content_tags .= '<h3>';
$content_tags .= __e("Content");
$content_tags .= '</h3>';
$content_tags .= '<textarea name="contents[custom-code][singular]" class="form-control" data-type="php">' . htmlentities($currentData['contents']['custom-code']['singular']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-default btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=contents&amp;n=' . $string->toFileName($currentData['contents']['name']) . '" class="btn btn-default btn-flat pull-right"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


$content_tags .= '</form>';
// TODO: LAYOUT --|-- GENERAL
switch ($_GET["a"])
{
    case "list":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=contents">' . __e("Contents") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("List") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags .= '<div class="card card-outline card-info">';
        $_content_tags .= '<div class="card-body">';

        $_content_tags .= '<div class="welcome">';
        $_content_tags .= '<h2>' . __e('Front-end') . '</h2>';
        $_content_tags .= '<h1>' . __e('Contents') . '</h1>';
        $_content_tags .= '<p class="lead">' . __e('Display or modify the post content') . '</p>';
        $_content_tags .= '</div>';

        // TODO: LIST --|-- TABLE
        $_content_tags .= '<table data-type="datatable" class="table datatable table-bordered">';
        $_content_tags .= '<thead>';
        $_content_tags .= '<tr>';
        $_content_tags .= '<th>' . __e("Name") . '</th>';
        $_content_tags .= '<th>' . __e("Post Type") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Action") . '</th>';
        $_content_tags .= '</tr>';
        $_content_tags .= '</thead>';
        $_content_tags .= '<tbody>';
        $contents = $db->getContents();
        foreach ($contents as $content)
        {
            $_content_tags .= '<tr>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $content['name'] . '</code></td>';
            $_content_tags .= '<td><span class="badge badge-primary">' . $content['post_type'] . '</span></td>';
            $_content_tags .= '<td class="text-center align-middle">';
            $_content_tags .= '<div class="btn-group btn-group-sm">';
            $_content_tags .= '<a href="#' . $content['name'] . '" data-toggle="modal" data-target="#modal-trash-contents-' . $content['name'] . '" data-href="./?p=contents&amp;a=trash&amp;n=' . $content['name'] . '" class="btn btn-danger"><i class="fa fa-trash"></i> ' . __e("Trash") . '</a>';
            $_content_tags .= '<a href="./?p=contents&amp;a=edit&amp;n=' . $content['name'] . '" class="btn btn-success"><i class="fa fa-edit"></i> ' . __e("Edit") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</td>';
            $_content_tags .= '</tr>';
        }
        $_content_tags .= '</tbody>';
        $_content_tags .= '</table>';
        $_content_tags .= '</div>';
        $_content_tags .= '<div class="card-footer">';
        $_content_tags .= '<a href="./?p=contents&amp;a=new" class="btn btn-success"><i class="fa fa-plus-circle"></i> ' . __e("Add New Contents") . '</a>';
        $_content_tags .= '</div>';
        $_content_tags .= '</div>';
        // TODO: LIST --|-- MODAL
        foreach ($contents as $content)
        {
            $_content_tags .= '<div class="modal fade" id="modal-trash-contents-' . $content['name'] . '">';
            $_content_tags .= '<div class="modal-dialog">';
            $_content_tags .= '<div class="modal-content bg-default">';
            $_content_tags .= '<div class="modal-header">';
            $_content_tags .= '<h4 class="modal-title">' . __e("Confirm") . '</h4>';
            $_content_tags .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            $_content_tags .= '<span aria-hidden="true">&times;</span></button>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-body">';
            $_content_tags .= '<p>' . __e("Are you sure You want to delete this Contents?") . '</p>';
            $_content_tags .= '<table class="table-grid">';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td rowspan="4" style="text-align: center;"><i class="far fa-image trash-logo"></i></td>';
            $_content_tags .= '<td>' . __e("Name") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $content['name'] . '</code></td>';
            $_content_tags .= '</tr>';

            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Post Type") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td>' . $content['post_type'] . '</td>';
            $_content_tags .= '</tr>';

            $_content_tags .= '</table>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-footer justify-content-between">';
            $_content_tags .= '<button type="button" class="btn btn-default" data-dismiss="modal">' . __e("Close") . '</button>';
            $_content_tags .= '<a href="./?p=contents&amp;a=trash&amp;n=' . $content['name'] . '" class="btn btn-danger">' . __e("Yes, I am sure!") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
        }

        break;
    case "new":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=contents">' . __e("Contents") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("New") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
    case "edit":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=contents">' . __e("Contents") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("Edit") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
}

$pagejs = null;

// TODO: JS --|-- FRONT-END
$pagejs .= "\t\t" . '' . "\r\n";
$pagejs .= "\t\t" . '/** FRONT-END **/' . "\r\n";
$pagejs .= "\t\t" . 'var front_end_field_type = [];' . "\r\n";
$pagejs .= "\t\t" . 'var front_end_field_name = [];' . "\r\n";
$pagejs .= "\t\t" . 'var front_end_field_label = [];' . "\r\n";
$pagejs .= "\t\t" . 'var front_end_field_option = [];' . "\r\n";

$pagejs .= "\t\t" . '' . "\r\n";
$c = 0;
foreach ($currentData['contents']['front-ends'] as $front_end)
{
    $pagejs .= "\t\t" . 'front_end_field_type[' . $c . '] = "' . $front_end["type"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'front_end_field_name[' . $c . '] = "' . $front_end["name"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'front_end_field_option[' . $c . '] = "' . $front_end["option"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . '' . "\r\n";
    $c++;
}
$pagejs .= "\t\t" . '' . "\r\n";
$pagejs .= "\t\t" . 'function setField(target,value){' . "\r\n";
$pagejs .= "\t\t\t" . 'console.log(target,value);' . "\r\n";
$pagejs .= "\t\t\t" . '$(target).val(value);' . "\r\n";
$pagejs .= "\t\t" . '}' . "\r\n";
$pagejs .= "\t\t" . 'function frontEnd(ev){' . "\r\n";
$pagejs .= "\t\t\t" . 'var item_type = $(ev).val();' . "\r\n";
$pagejs .= "\t\t\t" . 'var item_target = $(ev).attr("data-target");' . "\r\n";
$pagejs .= "\t\t\t" . 'console.log("frontEnd",item_type,item_target);' . "\r\n";
$pagejs .= "\t\t\t" . '' . "\r\n";
$pagejs .= "\t\t\t" . 'switch(item_type){' . "\r\n";
foreach ($__front_ends as $__front_end)
{
    if (!isset($__front_end['name']))
    {
        $__front_end['name'] = '';
    }
    if (!isset($__front_end['type']))
    {
        $__front_end['type'] = '';
    }
    if (!isset($__front_end['option']))
    {
        $__front_end['option'] = '';
    }

    if (!isset($__front_end['code']['js']))
    {
        $__front_end['code']['js'] = '';
    }

    /** options **/
    if (!isset($__front_end['options']['type']))
    {
        $__front_end['options']['type'] = 'text';
    }
    if (!isset($__front_end['options']['value']))
    {
        $__front_end['options']['value'] = '';
    }
    if (!isset($__front_end['options']['placeholder']))
    {
        $__front_end['options']['placeholder'] = '';
    }
    if (!isset($__front_end['options']['help']))
    {
        $__front_end['options']['help'] = '<strong>format</strong>: text';
    }

    $pagejs .= "\t\t\t\t" . 'case "' . $__front_end['name'] . '":' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#contents-front-end-option-select-" + item_target).html("");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#contents-front-end-option-" + item_target).removeClass("hidden");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#contents-front-end-option-" + item_target).prop("type","' . $__front_end['options']['type'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#contents-front-end-option-" + item_target).attr("placeholder","' . $__front_end['options']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#contents-front-end-option-help-" + item_target).html("' . $__front_end['options']['help'] . '");' . "\r\n";


    $pagejs .= $__front_end['code']['js'];

    $pagejs .= "\t\t\t\t\t" . 'break;' . "\r\n";

}
$pagejs .= "\t\t\t" . '}' . "\r\n";
$pagejs .= "\t\t" . '}' . "\r\n";


$pagejs .= "\t\t" . '$(".contents-front-end-type").on("click",function(){' . "\r\n";
$pagejs .= "\t\t\t" . 'frontEnd(this);' . "\r\n";
$pagejs .= "\t\t" . '});' . "\r\n";

$pagejs .= "\t\t" . 'var itemType = $(".contents-front-end-type");' . "\r\n";
$pagejs .= "\t\t" . '$.each(itemType, function() {' . "\r\n";
$pagejs .= "\t\t\t" . 'frontEnd(this);' . "\r\n";
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


$pagejs .= "" . '$(document).ready(function(){' . "\r\n";
$pagejs .= "\t" . '$("#field-post_type-select").on("click",function(){' . "\r\n";
$pagejs .= "\t\t" . '$("#field-post_type").val($(this).val());' . "\r\n";
$pagejs .= "\t" . '});' . "\r\n";
$pagejs .= "" . '});' . "\r\n";


define('IHS_LAYOUT_CONTENT', $_content_tags);
define('IHS_LAYOUT_BREADCRUMB', $breadcrumb_tags);
define('IHS_PAGE_NAME', __e("Contents"));
define('IHS_PAGE_DESC', __e("Display or modify the post content"));
define('IHS_PAGE_JS', $pagejs);

?>