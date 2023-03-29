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
    $postData['short-codes']['name'] = ""; //text
    $postData['short-codes']['label'] = ""; //text
    $postData['short-codes']['icon'] = ""; //text
    $postData['short-codes']['attrs'] = array(); //text
    $postData['short-codes']['type_of_code'] = "auto"; //select
    $postData['short-codes']['overwrite_custom_code'] = true; //boolean
    $postData['short-codes']['custom-code']['tinymce'] = '';
    $postData['short-codes']['custom-code']['front-ends'] = '';
    $postData['short-codes']['type_of_code'] = "custom-fields"; //select
    $postData['short-codes']['overwrite_custom_code'] = true; //boolean
    $postData['short-codes']['enqueue_scripts'] = array(); //checkbox

    // edit
    if (isset($_GET["n"]))
    {
        $_POST["short-codes"]["name"] = $_GET["n"];
    }
    // TODO: ACTION --|-- SUBMIT --|-- POST RESPONSE
    // text
    if (isset($_POST['short-codes']['name']))
    {
        $postData['short-codes']['name'] = $string->toFileName($_POST['short-codes']['name']);
    }
    // text
    if (isset($_POST['short-codes']['label']))
    {
        $postData['short-codes']['label'] = $_POST['short-codes']['label'];
    }
    // text
    if (isset($_POST['short-codes']['icon']))
    {
        $postData['short-codes']['icon'] = $_POST['short-codes']['icon'];
    }

    // select
    if (isset($_POST['short-codes']['type_of_code']))
    {
        $postData['short-codes']['type_of_code'] = $_POST['short-codes']['type_of_code'];
    }

    // boolean
    if (isset($_POST['short-codes']['overwrite_custom_code']))
    {
        $postData['short-codes']['overwrite_custom_code'] = true;
    } else
    {
        $postData['short-codes']['overwrite_custom_code'] = false;
    }

    if (isset($_POST['short-codes']['attrs']))
    {
        $y = 0;
        foreach ($_POST['short-codes']['attrs'] as $fields)
        {
            if (trim($fields['name']) != '')
            {
                $postData['short-codes']['attrs'][$y]['type'] = $fields['type'];
                $postData['short-codes']['attrs'][$y]['name'] = $string->toFileName($fields['name']);
                $postData['short-codes']['attrs'][$y]['label'] = trim($fields['label']);
                $postData['short-codes']['attrs'][$y]['options'] = trim($fields['options']);
                $postData['short-codes']['attrs'][$y]['default'] = trim($fields['default']);
                $postData['short-codes']['attrs'][$y]['info'] = trim($fields['info']);
                $y++;
            }
        }
    }

    if (isset($_POST['short-codes']['front-ends']))
    {
        $y = 0;
        foreach ($_POST['short-codes']['front-ends'] as $fields)
        {
            if (trim($fields['name']) != '')
            {
                $postData['short-codes']['front-ends'][$y]['type'] = $fields['type'];
                $postData['short-codes']['front-ends'][$y]['name'] = trim($string->toFileName($fields['name']));
                $postData['short-codes']['front-ends'][$y]['label'] = trim($fields['label']);
                $postData['short-codes']['front-ends'][$y]['option'] = trim($fields['option']);
                $y++;
            }
        }
    }


    // text
    if (isset($_POST['short-codes']['custom-code']['tinymce']))
    {
        $postData['short-codes']['custom-code']['tinymce'] = $_POST['short-codes']['custom-code']['tinymce'];
    }


    // text
    if (isset($_POST['short-codes']['custom-code']['front-ends']))
    {
        $postData['short-codes']['custom-code']['front-ends'] = $_POST['short-codes']['custom-code']['front-ends'];
    }


    // checkbox
    if (isset($_POST['short-codes']['enqueue_scripts']))
    {
        $postData['short-codes']['enqueue_scripts'] = $_POST['short-codes']['enqueue_scripts'];
    }

    // text
    if (isset($_POST['short-codes']['icon_color']))
    {
        $postData['short-codes']['icon_color'] = $_POST['short-codes']['icon_color'];
    }


    // text
    if (isset($_POST['short-codes']['note']))
    {
        $postData['short-codes']['note'] = $_POST['short-codes']['note'];
    }


    // TODO: ACTION --|-- SUBMIT --|-- SAVE DATA

    // validate and save postdata
    $db->saveShortCode($postData['short-codes']);
    $db->current();
    $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Short-codes saved successfully!");
    if ($_GET["a"] == "edit")
    {
        header("Location: ./?p=shortCodes&a=edit&alert=success&n=" . $_GET["n"] . "&" . time());
    } else
    {
        header("Location: ./?p=shortCodes&a=list&alert=success&" . time());
    }
}

// TODO: =========================================================
// TODO: ACTION --|-- REMOVE --|-- SHORT-CODES
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "trash")
    {
        $_prefix = basename($_GET["n"]);
        $db->removeShortCode($_prefix);
        $db->current();
        $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Short-code deleted successfully!");
        header("Location: ./?p=shortCodes&a=list&alert=warning&" . time());
    }
}

// TODO: =========================================================
// TODO: LAYOUT --|-- GENERAL
$disabled = "";
$shortcode_name = 'untitle';
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "edit")
    {
        $_prefix = basename($_GET["n"]);
        $currentData["short-codes"] = $db->getShortCode($_prefix);
        $disabled = "disabled";
        $shortcode_name = $string->toVar($project['short-name'] . ' ' . $currentData['short-codes']['name']);
    }
}
// TODO: LAYOUT --|-- GENERAL --|-- INIT
//text
if (!isset($currentData['short-codes']['name']))
{
    $currentData['short-codes']['name'] = "";
}
//text
if (!isset($currentData['short-codes']['label']))
{
    $currentData['short-codes']['label'] = "";
}
//text
if (!isset($currentData['short-codes']['icon']))
{
    $currentData['short-codes']['icon'] = "dashicons-media-spreadsheet";
}
if (!isset($currentData['short-codes']['custom-code']['tinymce']))
{
    $currentData['short-codes']['custom-code']['tinymce'] = "";
}
if (!isset($currentData['short-codes']['custom-code']['front-ends']))
{
    $currentData['short-codes']['custom-code']['front-ends'] = "";
}


//select
if (!isset($currentData['short-codes']['type_of_code']))
{
    $currentData['short-codes']['type_of_code'] = "auto";
}
//boolean
if (!isset($currentData['short-codes']['overwrite_custom_code']))
{
    $currentData['short-codes']['overwrite_custom_code'] = true;
}
//boolean
if (!isset($currentData['short-codes']['attrs']))
{
    $currentData['short-codes']['attrs'] = array();
}
//checkbox
if (!isset($currentData['short-codes']['enqueue_scripts']))
{
    $currentData['short-codes']['enqueue_scripts'] = array();
}
if (!isset($currentData['short-codes']['front-ends']))
{
    $currentData['short-codes']['front-ends'] = array();
}


if (!isset($currentData['short-codes']['icon_color']))
{
    $currentData['short-codes']['icon_color'] = "#ff0000";
}

//text
if (!isset($currentData['short-codes']['note']))
{
    $currentData['short-codes']['note'] = "";
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
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/short-codes.php</code></p>';
$content_tags .= '<hr/>';
// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="name" class="col-sm-3 col-form-label">' . __e("Name") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input ' . $disabled . ' required type="text" name="short-codes[name]"  class="form-control" id="field-name" placeholder="lorem-ipsum" value="' . $currentData['short-codes']['name'] . '">';
$content_tags .= '<p class="help-block">' . __e("Shortcode tag to be searched in post content. Only contain a-z, 0-9, and - characters") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- LABEL
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label" class="col-sm-3 col-form-label">' . __e("Label") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input required type="text" name="short-codes[label]"  class="form-control" id="field-label" placeholder="Lorem Ipsum" value="' . $currentData['short-codes']['label'] . '">';
$content_tags .= '<p class="help-block">' . __e("The text that will appear on the button") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- NOTE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label" class="col-sm-3 col-form-note">' . __e("Note") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input type="text" name="short-codes[note]"  class="form-control" id="field-note" placeholder="" value="' . $currentData['short-codes']['note'] . '">';
$content_tags .= '<p class="help-block">' . __e("Just a note") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- MENU_ICON
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label" class="col-sm-3 col-form-label">' . __e("Icon") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<div class="input-group">';
$content_tags .= '<input type="text" id="short-codes-menu-icon" name="short-codes[icon]"  class="form-control no-border-top-right-radius" placeholder="dashicons-book" value="' . $currentData['short-codes']['icon'] . '">';
$content_tags .= '<span class="input-group-append" data-type="icon-picker" data-prefix="dashicons" data-target="#short-codes-menu-icon" data-dialog="#dashicons-dialog" data-preview="#short-codes-menu-icon-preview">';
$content_tags .= '<span class="input-group-text"><i id="short-codes-menu-icon-preview" class="dashicons ' . $currentData['short-codes']['icon'] . '"></i></span>';
$content_tags .= '</span>';
$content_tags .= '</div>';
$content_tags .= '<p class="help-block">' . __e("Pass the name of a Dashicons helper class to use a font icon, e.g. 'dashicons-chart-pie'") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- ICON_COLOR
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="icon_color" class="col-sm-3 col-form-label">' . __e("Icon Color") . '</label>';
$content_tags .= '<div class="col-sm-4">';
$content_tags .= '<input required type="color" name="short-codes[icon_color]"  class="form-control" id="field-icon_color" placeholder="icon-color" value="' . $currentData['short-codes']['icon_color'] . '">';
$content_tags .= '<p class="help-block">' . __e("Choose the icon color you want to use!") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- TYPE_OF_CODE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="type_of_code" class="col-sm-3 col-form-label">' . __e("Types of Generator") . '</label>';
$content_tags .= '<div class="col-sm-5">';
$content_tags .= '<select name="short-codes[type_of_code]" class="form-control" id="field-type_of_code">';
$options = array();
$options[] = array("value" => "auto", "label" => "Auto Code (Short Codes and TinyMCE Plugin)");
$options[] = array("value" => "custom-code", "label" => "Custom Code");
foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['short-codes']['type_of_code'])
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
if ($currentData['short-codes']['overwrite_custom_code'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="short-codes[overwrite_custom_code]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="short-codes[overwrite_custom_code]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
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
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=shortCodes" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=shortCodes" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card
$content_tags .= '</div>'; //col-md-6
$content_tags .= '<div class="col-md-6">';


// TODO: LAYOUT --|-- INSTRUCTION
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

$content_tags .= '<div class="card-body">';

$content_tags .= '<div class="callout callout-success">';
$content_tags .= __e('These instructions are dynamic according to the conditions of the project being worked on');
$content_tags .= '</div>';

$content_tags .= '<h4>' . __e("How to get attributes or optional") . '</h4>';


// TODO: LAYOUT --|--
$get_attrs = array();
if (is_array($currentData['short-codes']['attrs']))
{
    foreach ($currentData['short-codes']['attrs'] as $attr)
    {
        $get_attrs[] = '$attribute_' . $string->toVar($attr['name']) . ' = $atts["' . $string->toVar($attr['name']) . '"]; ';
    }
}

$example_code = null;
$example_code .= "" . '<?php' . "\r\n";
$example_code .= implode("\r\n", $get_attrs);

$content_tags .= '<div class="example-code">';
$content_tags .= highlight_string($example_code, true);
$content_tags .= '</div>';


$content_tags .= '<h4>' . __e("Where will the Button appear?") . '</h4>';
$content_tags .= '<p>' . __e("Go to your Editor field, then click <strong>Add Block</strong> -&raquo; <strong>Blocks</strong> -&raquo; <strong>Text</strong> -&raquo; <strong>Classic</strong><br/>or click <strong>Add Block</strong> -&raquo; <strong>Blocks</strong> -&raquo; <strong>Widgets</strong> -&raquo; <strong>Shortcode</strong>") . '</p>';

$content_tags .= '</div>'; //card-body
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=shortCodes" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=shortCodes" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card
$content_tags .= '</div>'; //col-md-6
$content_tags .= '</div>'; //row
$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-12">';
$content_tags .= '<div class="card card-outline card-info">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-filter"></i>&nbsp;';
$content_tags .= __e("Front-end Shortcodes");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|--
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/short-codes.php</code></p>';
$content_tags .= '<hr/>';
$module_path = IHS_MODULE_DIR . '/short-codes/front-ends/*.mod.php';
$__front_ends = array();
foreach (glob($module_path) as $filename)
{
    $module = null;
    include ($filename);
    $__front_ends[] = $module;
}

$ex_name = $currentData['short-codes']['name'];
$content_tags .= '<h4>' . __e("Add the Scripts Files") . ':</h4>';
$content_tags .= '<table class="table table-striped">';
$content_tags .= '<thead>';
$content_tags .= '<tr>';
$content_tags .= '<th>' . __e("Enqueue") . '</th>';
$content_tags .= '<th>' . __e("Source") . '</th>';
$content_tags .= '</tr>';
$content_tags .= '</thead>';
$content_tags .= '<tbody>';
$options = array();
$options[] = array(
    "label" => "Javascript File",
    "value" => "scripts",
    "path" => 'assets/js/' . $ex_name . '-shortcode.js');
$options[] = array(
    "label" => "CSS Style File",
    "value" => "styles",
    "path" => 'assets/css/' . $ex_name . '-shortcode.css');
$z = 0;
foreach ($options as $opt)
{
    $selected = "";
    foreach ($currentData['short-codes']['enqueue_scripts'] as $item)
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
    $content_tags .= '<input id="short-codes-enqueue_scripts-' . $opt["value"] . '-' . $z . '" ' . $selected . '  type="checkbox" name="short-codes[enqueue_scripts][' . $opt["value"] . ']"  class="form-control" placeholder="" value="' . $opt["value"] . '" />';
    $content_tags .= '<label for="short-codes-enqueue_scripts-' . $opt["value"] . '-' . $z . '">' . $opt["label"] . '</label>';
    $content_tags .= '</div>';
    $content_tags .= '</div>';
    $content_tags .= '</td>';

    $content_tags .= '<td>';
    $content_tags .= '<code>' . $opt['path'] . '</code>';
    $content_tags .= '</td>';

    $content_tags .= '</tr>';
    $z++;
}
$content_tags .= '</tbody>';
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
foreach ($currentData['short-codes']['front-ends'] as $field)
{
    if (!isset($field['name']))
    {
        $field['name'] = '';
    }
    $select_option = null;
    $select_option .= '<select name="short-codes[front-ends][' . $c . '][type]" data-target="' . $c . '" class="form-control short-code-front-end-type" >';
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
    $content_tags .= '<td class="vcenter"><input name="short-codes[front-ends][' . $c . '][name]" class="form-control" type="text" value="' . $field['name'] . '"/><p class="helper-block"><strong>format</strong>: a-z, A-Z,0-9, and -<br/>don\'t use the number in the 1st variable</p></td>';
    $content_tags .= '<td class="vcenter"><input name="short-codes[front-ends][' . $c . '][label]" class="form-control" type="text" value="' . $field['label'] . '"/><p class="helper-block"><strong>format</strong>: text<br/>&nbsp;</p></td>';
    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="short-codes-front-end-option-' . $c . '" name="short-codes[front-ends][' . $c . '][option]" class="form-control" type="text" value="' . $field['option'] . '"/><span id="short-codes-front-end-option-select-' . $c . '"></span>';
    $content_tags .= '<p class="helper-block"><span id="short-codes-front-end-option-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';
    $content_tags .= '<td class="text-center vcenter"><a class="btn btn-danger btn-sm remove-item" data-target="#field-no-' . $c . '" href="#!_"><i class="fa fa-trash"></i></a><p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
    $content_tags .= '</tr>';
    $c++;
}
// TODO: LAYOUT --|-- FRONT-END --|-- TABLE --|-- ADD
$c++;
$select_option = null;
$select_option .= '<select class="form-control short-code-front-end-type" name="short-codes[front-ends][' . $c . '][type]" data-target="' . $c . '"   >';
foreach ($__front_ends as $__front_end)
{
    $select_option .= '<option value="' . $__front_end['name'] . '">' . $__front_end['label'] . '</option>';
}
$select_option .= '</select>';
$content_tags .= '<tr id="field-no-' . $c . '">';
$content_tags .= '<td class="text-center vcenter"><a href="#!_"><i class="fa fa-move"></i></a></td>';
$content_tags .= '<td class="text-center vcenter">' . $select_option . '<p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
$content_tags .= '<td class="text-center vcenter"><input name="short-codes[front-ends][' . $c . '][name]" class="form-control" type="text" value=""/><p class="helper-block"><strong>format</strong>: a-z, A-Z,0-9, and -<br/>don\'t use the number in the 1st variable</p></td>';
$content_tags .= '<td class="text-center vcenter"><input name="short-codes[front-ends][' . $c . '][label]" class="form-control" type="text" value=""/><p class="helper-block"><strong>format</strong>: text<br/>&nbsp;</p></td>';
$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="short-codes-front-end-option-' . $c . '" name="short-codes[front-ends][' . $c . '][option]" class="form-control" type="text" value=""/>';
$content_tags .= '<span id="short-codes-front-end-option-select-' . $c . '"></span>';
$content_tags .= '<p class="helper-block"><span id="short-codes-front-end-option-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
$content_tags .= '</td>';
$content_tags .= '<td class="text-center vcenter"><input name="submit" type="submit" class="btn btn-primary" value="' . __e("Add Field") . '" /><p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
$content_tags .= '</tr>';
$content_tags .= '</tbody>';
$content_tags .= '</table>';
$content_tags .= '</div>'; //card-body
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-info btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=shortCodes" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=shortCodes" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card
$content_tags .= '</div>'; //col-md-12
$content_tags .= '</div>'; //row
$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-12">';
$content_tags .= '<div class="card card-outline card-success">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-cogs"></i>&nbsp;';
$content_tags .= __e("Attributes");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|--
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/short-codes.php</code></p>';
$content_tags .= '<hr/>';
$module_path = IHS_MODULE_DIR . '/short-codes/attributes/*.mod.php';
$__options = array();
foreach (glob($module_path) as $filename)
{
    $module = null;
    include ($filename);
    $__options[] = $module;
}
// TODO: LAYOUT --|-- OPTIONS --|-- TABLE
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
// TODO: LAYOUT --|-- OPTIONS --|-- TABLE --|-- FIELDS
$c = 0;
foreach ($currentData['short-codes']['attrs'] as $field)
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
    $select_option .= '<select name="short-codes[attrs][' . $c . '][type]" data-target="' . $c . '" class="form-control short-code-attr-type" >';
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
    $content_tags .= '<td class="vcenter"><input name="short-codes[attrs][' . $c . '][name]" placeholder="field-' . $c . '" class="form-control" type="text" value="' . $field['name'] . '"/><p class="helper-block"><strong>format</strong>: a-z, A-Z,0-9, and -<br/>don\'t use the number in the 1st variable</p></td>';
    $content_tags .= '<td class="vcenter"><input name="short-codes[attrs][' . $c . '][label]" placeholder="Field ' . $c . '"  class="form-control" type="text" value="' . $field['label'] . '"/><p class="helper-block"><strong>format</strong>: text<br/>&nbsp;</p></td>';
    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="short-codes-attrs-' . $c . '" name="short-codes[attrs][' . $c . '][options]" class="form-control" type="text" value="' . $field['options'] . '"/><span id="short-codes-options-select-' . $c . '"></span>';
    $content_tags .= '<p class="helper-block"><span id="short-codes-options-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';
    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="short-codes-default-' . $c . '" name="short-codes[attrs][' . $c . '][default]" class="form-control" type="text" value="' . $field['default'] . '"/>';
    $content_tags .= '<p class="helper-block"><span id="short-codes-default-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';
    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="short-codes-info-' . $c . '" name="short-codes[attrs][' . $c . '][info]" class="form-control" type="text" value="' . $field['info'] . '"/>';
    $content_tags .= '<p class="helper-block"><span id="short-codes-info-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';
    $content_tags .= '<td class="text-center vcenter"><a class="btn btn-danger btn-sm remove-item" data-target="#field-no-' . $c . '" href="#!_"><i class="fa fa-trash"></i></a><p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
    $content_tags .= '</tr>';
    $c++;
}
// TODO: LAYOUT --|-- OPTIONS --|-- TABLE --|-- ADD FIELDS
$c++;
$select_option = null;
$select_option .= '<select class="form-control short-code-attr-type" name="short-codes[attrs][' . $c . '][type]" data-target="' . $c . '"   >';
foreach ($__options as $option)
{
    $select_option .= '<option value="' . $option['name'] . '">' . $option['label'] . '</option>';
}
$select_option .= '</select>';
$content_tags .= '<tr id="field-no-' . $c . '">';
$content_tags .= '<td class="text-center vcenter"><a href="#!_"><i class="fa fa-move"></i></a></td>';
$content_tags .= '<td class="text-center vcenter">' . $select_option . '<p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
$content_tags .= '<td class="text-center vcenter"><input name="short-codes[attrs][' . $c . '][name]" placeholder="field-' . $c . '" class="form-control" type="text" value=""/><p class="helper-block"><strong>format</strong>: a-z, A-Z,0-9, and -<br/>don\'t use the number in the 1st variable</p></td>';
$content_tags .= '<td class="text-center vcenter"><input name="short-codes[attrs][' . $c . '][label]" placeholder="Field ' . $c . '" class="form-control" type="text" value=""/><p class="helper-block"><strong>format</strong>: text<br/>&nbsp;</p></td>';
$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="short-codes-options-' . $c . '" name="short-codes[attrs][' . $c . '][options]" class="form-control" type="text" value=""/>';
$content_tags .= '<span id="short-codes-options-select-' . $c . '"></span>';
$content_tags .= '<p class="helper-block"><span id="short-codes-options-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
$content_tags .= '</td>';
$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="short-codes-default-' . $c . '" name="short-codes[attrs][' . $c . '][default]" class="form-control" type="text" value=""/>';
$content_tags .= '<p class="helper-block"><span id="short-codes-default-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
$content_tags .= '</td>';
$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="short-codes-info-' . $c . '" name="short-codes[attrs][' . $c . '][info]" class="form-control" type="text" value=""/>';
$content_tags .= '<p class="helper-block"><span id="short-codes-info-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
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
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=shortCodes" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=shortCodes" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card
$content_tags .= '</div>'; //col-md-12
$content_tags .= '</div>'; //row
$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-12">';
// TODO: =========================================================
// TODO: LAYOUT --|-- CUSTOM CODE
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
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/assets/tinymce-plugins/' . $shortcode_name . '/' . $shortcode_name . '.js</code></p>';
$content_tags .= '<hr/>';
$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<p>' . __e("To use this feature you must change the General Settings: ") . '<strong>Types of Generator = <code>Custom Code</code></strong>' . __e(' and ') . '<strong>Copy To Custom Code = <code>OFF</code></strong></p>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- CUSTOM CODE --|-- PHP
$content_tags .= '<h3>';
$content_tags .= __e("Content");
$content_tags .= '&nbsp;<i class="fab fa-php"></i>&nbsp;';
$content_tags .= '</h3>';
$content_tags .= '<p>';
$content_tags .= __e("Content that will replace shortcodes, is written in the PHP Syntax");
$content_tags .= '</p>';
$content_tags .= '<textarea name="short-codes[custom-code][front-ends]" class="form-control" data-type="php">' . htmlentities($currentData['short-codes']['custom-code']['front-ends']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';
$content_tags .= '<hr/>';

// TODO: LAYOUT --|-- CUSTOM CODE --|--
$content_tags .= '<h3>';
$content_tags .= __e("TinyMCE Plugin");
$content_tags .= '&nbsp;<i class="fab fa-js"></i>';
$content_tags .= '</h3>';
$content_tags .= '<p>';
$content_tags .= __e("Field configuration based on code: TinyMCE UI code (tinymce.ui)");
$content_tags .= '</p>';
$content_tags .= '<textarea name="short-codes[custom-code][tinymce]" class="form-control" data-type="js">' . htmlentities($currentData['short-codes']['custom-code']['tinymce']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';


$content_tags .= '</div>'; //card-body
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-default btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=shortCodes" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=shortCodes" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card
$content_tags .= '</div>'; //col-md-12
$content_tags .= '</div>'; //row
$content_tags .= '</form>';
$icon = new ShowIcon();
$content_tags .= $icon->Display('dashicons', 'Dashicons');
// TODO: =========================================================
// TODO: LAYOUT --|-- GENERAL
switch ($_GET["a"])
{
    case "list":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=shortCodes">' . __e("Short Codes") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("List") . '</li>';
        $breadcrumb_tags .= '</ol>';
        $_content_tags .= '<div class="card card-outline card-info">';
        $_content_tags .= '<div class="card-body">';
        $_content_tags .= '<div class="welcome">';
        $_content_tags .= '<h2>' . __e('The Content') . '</h2>';
        $_content_tags .= '<h1>' . __e('Short Codes') . '</h1>';
        $_content_tags .= '<p class="lead">' . __e('Short codes that are used to change content formatting or add features to web pages and TinyMCE plugin makes it more user friendly') . '</p>';
        $_content_tags .= '</div>';
        // TODO: LIST --|-- TABLE
        $_content_tags .= '<table data-type="datatable" class="table datatable table-bordered">';
        $_content_tags .= '<thead>';
        $_content_tags .= '<tr>';
        $_content_tags .= '<th>' . __e("Name") . '</th>';
        $_content_tags .= '<th>' . __e("Note") . '</th>';
        $_content_tags .= '<th>' . __e("Label") . '</th>';
        $_content_tags .= '<th>' . __e("Tag") . '</th>';
        $_content_tags .= '<th>' . __e("Example") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Action") . '</th>';
        $_content_tags .= '</tr>';
        $_content_tags .= '</thead>';
        $_content_tags .= '<tbody>';
        $short_codes = $db->getShortCodes();
        foreach ($short_codes as $short_code)
        {
            $example = $string->toVar($project['short-name'] . '-' . $short_code['name']);

            $new_attrs = array();
            $attrib = '';
            if (is_array($short_code['attrs']))
            {
                foreach ($short_code['attrs'] as $attr)
                {
                    $new_attrs[] = ' ' . $string->toVar($attr['name']) . '="' . $attr['default'] . '" ';
                }
            }
            $attrib = implode(' ', $new_attrs);
            if (!isset($short_code['note']))
            {
                $short_code['note'] = '';
            }
            $_content_tags .= '<tr>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name'] . '-' . $short_code['name']) . '</code></td>';
            $_content_tags .= '<td>' . htmlentities($short_code['note']) . '</td>';
            $_content_tags .= '<td>' . htmlentities($short_code['label']) . '</td>';
            $_content_tags .= '<td>' . $example . '</td>';
            $_content_tags .= '<td><kbd>[' . $example . $attrib . '][/' . $example . ']</kbd></td>';
            $_content_tags .= '<td class="text-center align-middle">';
            $_content_tags .= '<div class="btn-group btn-group-sm">';
            $_content_tags .= '<a href="#' . $short_code['name'] . '" data-toggle="modal" data-target="#modal-trash-short-codes-' . $short_code['name'] . '" data-href="./?p=shortCodes&amp;a=trash&amp;n=' . $short_code['name'] . '" class="btn btn-danger"><i class="fa fa-trash"></i> ' . __e("Trash") . '</a>';
            $_content_tags .= '<a href="./?p=shortCodes&amp;a=edit&amp;n=' . $short_code['name'] . '" class="btn btn-success"><i class="fa fa-edit"></i> ' . __e("Edit") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</td>';
            $_content_tags .= '</tr>';

        }
        $_content_tags .= '</tbody>';
        $_content_tags .= '</table>';
        $_content_tags .= '</div>';
        $_content_tags .= '<div class="card-footer">';
        $_content_tags .= '<a href="./?p=shortCodes&amp;a=new" class="btn btn-success"><i class="fa fa-plus-circle"></i> ' . __e("Add New Short Codes") . '</a>';
        $_content_tags .= '</div>';
        $_content_tags .= '</div>';
        // TODO: LIST --|-- MODAL
        foreach ($short_codes as $short_code)
        {
            $label = $string->toVar($project['short-name'] . '-' . $short_code['label']);
            $_content_tags .= '<div class="modal fade" id="modal-trash-short-codes-' . $short_code['name'] . '">';
            $_content_tags .= '<div class="modal-dialog">';
            $_content_tags .= '<div class="modal-content bg-default">';
            $_content_tags .= '<div class="modal-header">';
            $_content_tags .= '<h4 class="modal-title">' . __e("Confirm") . '</h4>';
            $_content_tags .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            $_content_tags .= '<span aria-hidden="true">&times;</span></button>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-body">';
            $_content_tags .= '<p>' . __e("Are you sure You want to delete this shortcodes?") . '</p>';
            $_content_tags .= '<table class="table-grid">';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td rowspan="4" style="text-align: center;"><i class="fa fa-laptop-code trash-logo"></i></td>';
            $_content_tags .= '<td>' . __e("Name") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $short_code['name'] . '</code></td>';
            $_content_tags .= '</tr>';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Tag") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td>' . $label . '</td>';
            $_content_tags .= '</tr>';
            $_content_tags .= '</table>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-footer justify-content-between">';
            $_content_tags .= '<button type="button" class="btn btn-default" data-dismiss="modal">' . __e("Close") . '</button>';
            $_content_tags .= '<a href="./?p=shortCodes&amp;a=trash&amp;n=' . $short_code['name'] . '" class="btn btn-danger">' . __e("Yes, I am sure!") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
        }
        break;
    case "new":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=shortCodes">' . __e("Short Codes") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("New") . '</li>';
        $breadcrumb_tags .= '</ol>';
        $_content_tags = $content_tags;
        break;
    case "edit":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=shortCodes">' . __e("Short Codes") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("Edit") . '</li>';
        $breadcrumb_tags .= '</ol>';
        $_content_tags = $content_tags;
        break;
}
$pagejs = null;
$pagejs .= "\t\t" . '' . "\r\n";
$pagejs .= "\t\t" . '//temporary current value' . "\r\n";
$pagejs .= "\t\t" . 'var attr_field_type = [];' . "\r\n";
$pagejs .= "\t\t" . 'var attr_field_name = [];' . "\r\n";
$pagejs .= "\t\t" . 'var attr_field_label = [];' . "\r\n";
$pagejs .= "\t\t" . 'var attr_field_options = [];' . "\r\n";
$pagejs .= "\t\t" . 'var attr_field_default = [];' . "\r\n";
$pagejs .= "\t\t" . 'var attr_field_info = [];' . "\r\n";
$c = 0;
foreach ($currentData['short-codes']['attrs'] as $field)
{
    $pagejs .= "\t\t" . '//current value' . "\r\n";
    $pagejs .= "\t\t" . 'attr_field_type[' . $c . '] = "' . $field["type"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'attr_field_name[' . $c . '] = "' . $field["name"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'attr_field_label[' . $c . '] = "' . $field["label"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'attr_field_default[' . $c . '] = "' . $field["default"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'attr_field_options[' . $c . '] = "' . $field["options"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'attr_field_info[' . $c . '] = "' . $field["info"] . '" ;' . "\r\n";
    $c++;
}
$pagejs .= "\t\t" . '' . "\r\n";
$pagejs .= "\t\t" . 'function setField(target,value){' . "\r\n";
$pagejs .= "\t\t\t" . 'console.log(target,value);' . "\r\n";
$pagejs .= "\t\t\t" . '$(target).val(value);' . "\r\n";
$pagejs .= "\t\t" . '}' . "\r\n";
$pagejs .= "\t\t" . 'function ShortCodeAttribute(ev){' . "\r\n";
$pagejs .= "\t\t\t" . 'var item_type = $(ev).val();' . "\r\n";
$pagejs .= "\t\t\t" . 'var item_target = $(ev).attr("data-target");' . "\r\n";
$pagejs .= "\t\t\t" . 'console.log("ShortCodeAttribute",item_type,item_target);' . "\r\n";
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
    $pagejs .= "\t\t\t\t\t" . '$("#short-codes-options-select-" + item_target).html("");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#short-codes-options-" + item_target).removeClass("hidden");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#short-codes-default-" + item_target).removeClass("hidden");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#short-codes-info-" + item_target).removeClass("hidden");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#short-codes-options-" + item_target).prop("type","' . $__opt['options']['type'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#short-codes-options-" + item_target).attr("placeholder","' . $__opt['options']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#short-codes-options-help-" + item_target).html("' . $__opt['options']['help'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#short-codes-default-" + item_target).prop("type","' . $__opt['default']['type'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#short-codes-default-" + item_target).attr("placeholder","' . $__opt['default']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#short-codes-default-help-" + item_target).html("' . $__opt['default']['help'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#short-codes-info-" + item_target).attr("placeholder","' . $__opt['info']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#short-codes-info-help-" + item_target).html("' . $__opt['info']['help'] . '");' . "\r\n";
    $pagejs .= $__opt['code']['js'];
    $pagejs .= "\t\t\t\t\t" . 'break;' . "\r\n";
}
$pagejs .= "\t\t\t" . '}' . "\r\n";
$pagejs .= "\t\t" . '}' . "\r\n";
$pagejs .= "\t\t" . '$(".short-code-attr-type").on("click",function(){' . "\r\n";
$pagejs .= "\t\t\t" . 'ShortCodeAttribute(this);' . "\r\n";
$pagejs .= "\t\t" . '});' . "\r\n";
$pagejs .= "\t\t" . 'var itemType = $(".short-code-attr-type");' . "\r\n";
$pagejs .= "\t\t" . '$.each(itemType, function() {' . "\r\n";
$pagejs .= "\t\t\t" . 'ShortCodeAttribute(this);' . "\r\n";
$pagejs .= "\t\t" . '});' . "\r\n";
$pagejs .= "\t\t" . '' . "\r\n";


// TODO: JS --|-- FRONT-END
$pagejs .= "\t\t" . '/** FRONT-END **/' . "\r\n";
$pagejs .= "\t\t" . 'var front_end_field_type = [];' . "\r\n";
$pagejs .= "\t\t" . 'var front_end_field_name = [];' . "\r\n";
$pagejs .= "\t\t" . 'var front_end_field_label = [];' . "\r\n";
$pagejs .= "\t\t" . 'var front_end_field_option = [];' . "\r\n";
$pagejs .= "\t\t" . '' . "\r\n";
$c = 0;
foreach ($currentData['short-codes']['front-ends'] as $front_end)
{
    $pagejs .= "\t\t" . 'front_end_field_type[' . $c . '] = "' . $front_end["type"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'front_end_field_name[' . $c . '] = "' . $front_end["name"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'front_end_field_option[' . $c . '] = "' . $front_end["option"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . '' . "\r\n";
    $c++;
}

$pagejs .= "\t\t" . 'function shortCodeFrontEnd(ev){' . "\r\n";
$pagejs .= "\t\t\t" . 'var item_type = $(ev).val();' . "\r\n";
$pagejs .= "\t\t\t" . 'var item_target = $(ev).attr("data-target");' . "\r\n";
$pagejs .= "\t\t\t" . 'console.log("short-codeFrontEnd",item_type,item_target);' . "\r\n";
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

    $pagejs .= "\t\t\t\t" . 'case "' . $__front_end['name'] . '":' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#short-codes-front-end-option-select-" + item_target).html("");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#short-codes-front-end-option-" + item_target).removeClass("hidden");' . "\r\n";

    $pagejs .= $__front_end['code']['js'];

    $pagejs .= "\t\t\t\t\t" . 'break;' . "\r\n";

}
$pagejs .= "\t\t\t" . '}' . "\r\n";
$pagejs .= "\t\t" . '}' . "\r\n";


$pagejs .= "\t\t" . '$(".short-code-front-end-type").on("click",function(){' . "\r\n";
$pagejs .= "\t\t\t" . 'shortCodeFrontEnd(this);' . "\r\n";
$pagejs .= "\t\t" . '});' . "\r\n";

$pagejs .= "\t\t" . 'var itemType = $(".short-code-front-end-type");' . "\r\n";
$pagejs .= "\t\t" . '$.each(itemType, function() {' . "\r\n";
$pagejs .= "\t\t\t" . 'shortCodeFrontEnd(this);' . "\r\n";
$pagejs .= "\t\t" . '});' . "\r\n";


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
define('IHS_PAGE_NAME', __e("Short Codes"));
define('IHS_PAGE_DESC', __e("Generate code for Shortcodes and TinyMCE plugin"));
define('IHS_PAGE_JS', $pagejs);

?>