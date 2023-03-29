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
$__front_ends = array();
$_prefix = 'unknow';

// TODO: ACTION --|-- SUBMIT --|--

if (isset($_POST['submit']))
{
    $postData['wpbakery-page-builders']['name'] = ""; //text
    $postData['wpbakery-page-builders']['note'] = ""; //text
    $postData['wpbakery-page-builders']['type_generator'] = "auto"; //select
    $postData['wpbakery-page-builders']['copy_to_custom_code'] = true; //boolean

    // TODO: ACTION --|-- SUBMIT --|-- POST RESPONSE
    // edit
    if (isset($_GET["n"]))
    {
        $_POST["wpbakery-page-builders"]["name"] = $_GET["n"];
    }

    // text
    if (isset($_POST['wpbakery-page-builders']['name']))
    {
        $postData['wpbakery-page-builders']['name'] = $_POST['wpbakery-page-builders']['name'];
    }

    // text
    if (isset($_POST['wpbakery-page-builders']['label']))
    {
        $postData['wpbakery-page-builders']['label'] = $_POST['wpbakery-page-builders']['label'];
    }

    // text
    if (isset($_POST['wpbakery-page-builders']['description']))
    {
        $postData['wpbakery-page-builders']['description'] = $_POST['wpbakery-page-builders']['description'];
    }

    // text
    if (isset($_POST['wpbakery-page-builders']['categories']))
    {
        $postData['wpbakery-page-builders']['categories'] = $_POST['wpbakery-page-builders']['categories'];
    }

    // text
    if (isset($_POST['wpbakery-page-builders']['icon']))
    {
        $postData['wpbakery-page-builders']['icon'] = $_POST['wpbakery-page-builders']['icon'];
    }


    // text
    if (isset($_POST['wpbakery-page-builders']['note']))
    {
        $postData['wpbakery-page-builders']['note'] = $_POST['wpbakery-page-builders']['note'];
    }

    // select
    if (isset($_POST['wpbakery-page-builders']['type_generator']))
    {
        $postData['wpbakery-page-builders']['type_generator'] = $_POST['wpbakery-page-builders']['type_generator'];
    }
    // boolean
    if (isset($_POST['wpbakery-page-builders']['copy_to_custom_code']))
    {
        $postData['wpbakery-page-builders']['copy_to_custom_code'] = true;
    } else
    {
        $postData['wpbakery-page-builders']['copy_to_custom_code'] = false;
    }


    if (isset($_POST['wpbakery-page-builders']['fields']))
    {
        $y = 0;
        foreach ($_POST['wpbakery-page-builders']['fields'] as $fields)
        {
            if (trim($fields['name']) != '')
            {
                $postData['wpbakery-page-builders']['fields'][$y]['type'] = $fields['type'];
                $postData['wpbakery-page-builders']['fields'][$y]['name'] = $string->toFileName($fields['name']);
                $postData['wpbakery-page-builders']['fields'][$y]['label'] = trim($fields['label']);
                $postData['wpbakery-page-builders']['fields'][$y]['options'] = trim($fields['options']);
                $postData['wpbakery-page-builders']['fields'][$y]['default'] = trim($fields['default']);
                $postData['wpbakery-page-builders']['fields'][$y]['info'] = trim($fields['info']);
                $y++;
            }
        }
    }


    if (isset($_POST['wpbakery-page-builders']['front-ends']))
    {
        $y = 0;
        foreach ($_POST['wpbakery-page-builders']['front-ends'] as $fields)
        {
            if (trim($fields['name']) != '')
            {
                $postData['wpbakery-page-builders']['front-ends'][$y]['type'] = $fields['type'];
                $postData['wpbakery-page-builders']['front-ends'][$y]['name'] = trim($string->toFileName($fields['name']));
                $postData['wpbakery-page-builders']['front-ends'][$y]['label'] = trim($fields['label']);
                $postData['wpbakery-page-builders']['front-ends'][$y]['option'] = trim($fields['option']);
                $y++;
            }
        }
    }


    if (isset($_POST['wpbakery-page-builders']['enqueue_scripts']))
    {
        $postData['wpbakery-page-builders']['enqueue_scripts'] = $_POST['wpbakery-page-builders']['enqueue_scripts'];
    }

    // text
    if (isset($_POST['wpbakery-page-builders']['custom-code']['param']))
    {
        $postData['wpbakery-page-builders']['custom-code']['param'] = $_POST['wpbakery-page-builders']['custom-code']['param'];
    }
    // text
    if (isset($_POST['wpbakery-page-builders']['custom-code']['shortcode']))
    {
        $postData['wpbakery-page-builders']['custom-code']['shortcode'] = $_POST['wpbakery-page-builders']['custom-code']['shortcode'];
    }

    // TODO: ACTION --|-- SUBMIT --|-- SAVE DATA
    // validate and save postdata
    $db->saveWpbakeryPageBuilder($postData['wpbakery-page-builders']);
    $db->current();
    $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Wpbakery-page-builders saved successfully!");
    if ($_GET["a"] == "edit")
    {
        header("Location: ./?p=wpbakeryPageBuilders&a=edit&alert=success&n=" . $_GET["n"] . "&" . time());
    } else
    {
        header("Location: ./?p=wpbakeryPageBuilders&a=list&alert=success&" . time());
    }
}

// TODO: =================================================================================================
// TODO: ACTION --|-- REMOVE --|-- WPBAKERY-PAGE-BUILDERS
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "trash")
    {
        $_prefix = basename($_GET["n"]);
        $db->removeWpbakeryPageBuilder($_prefix);
        $db->current();
        $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Wpbakery-page-builder deleted successfully!");
        header("Location: ./?p=wpbakeryPageBuilders&a=list&alert=warning&" . time());
    }
}


// TODO: LAYOUT --|-- WPBAKERY PAGE BUILDER
$disabled = "";
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "edit")
    {
        $_prefix = basename($_GET["n"]);
        $currentData["wpbakery-page-builders"] = $db->getWpbakeryPageBuilder($_prefix);
        $disabled = "disabled";
    }
}


// TODO: LAYOUT --|-- WPBAKERY PAGE BUILDER --|-- INIT
//text
if (!isset($currentData['wpbakery-page-builders']['name']))
{
    $currentData['wpbakery-page-builders']['name'] = "";
}
//text
if (!isset($currentData['wpbakery-page-builders']['label']))
{
    $currentData['wpbakery-page-builders']['label'] = "";
}
//text
if (!isset($currentData['wpbakery-page-builders']['description']))
{
    $currentData['wpbakery-page-builders']['description'] = "";
}

//text
if (!isset($currentData['wpbakery-page-builders']['categories']))
{
    $currentData['wpbakery-page-builders']['categories'] = "Content";
}

//text
if (!isset($currentData['wpbakery-page-builders']['icon']))
{
    $currentData['wpbakery-page-builders']['icon'] = "assets/icon.png";
}


//text
if (!isset($currentData['wpbakery-page-builders']['note']))
{
    $currentData['wpbakery-page-builders']['note'] = "";
}
//select
if (!isset($currentData['wpbakery-page-builders']['type_generator']))
{
    $currentData['wpbakery-page-builders']['type_generator'] = "auto";
}
//boolean
if (!isset($currentData['wpbakery-page-builders']['copy_to_custom_code']))
{
    $currentData['wpbakery-page-builders']['copy_to_custom_code'] = true;
}

if (!isset($currentData['wpbakery-page-builders']['front-ends']))
{
    $currentData['wpbakery-page-builders']['front-ends'] = array();
}


if (!isset($currentData['wpbakery-page-builders']['custom-code']['param']))
{
    $currentData['wpbakery-page-builders']['custom-code']['param'] = '';
}

if (!isset($currentData['wpbakery-page-builders']['custom-code']['shortcode']))
{
    $currentData['wpbakery-page-builders']['custom-code']['shortcode'] = '';
}

//checkbox
if (!isset($currentData['wpbakery-page-builders']['enqueue_scripts']))
{
    $currentData['wpbakery-page-builders']['enqueue_scripts'] = array();
}


$content_tags .= '<form class="form-horizontal" action="" method="post">';
$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-6">';

// TODO: =================================================================================================
$content_tags .= '<div class="card card-outline card-primary">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-th"></i>&nbsp;';
$content_tags .= __e("WPBakery Page Builder");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- WPBAKERY PAGE BUILDER --|-- FORM
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/wpbakery-page-builders.php</code></p>';
$content_tags .= '<hr/>';

// text
// TODO: LAYOUT --|-- WPBAKERY PAGE BUILDER --|-- FORM --|-- NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="name" class="col-sm-3 col-form-label">' . __e("Name") . '</label>';
$content_tags .= '<div class="col-sm-5">';
$content_tags .= '<input ' . $disabled . ' required type="text" name="wpbakery-page-builders[name]"  class="form-control" id="field-name" placeholder="my-bar-shortcode" value="' . $currentData['wpbakery-page-builders']['name'] . '">';
$content_tags .= '<p class="help-block">' . __e("Name, must not exceed 20 characters and may only contain a-z, 0-9, and - characters") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- WPBAKERY PAGE BUILDER --|-- FORM --|-- LABEL
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="note" class="col-sm-3 col-form-label">' . __e("Label") . '</label>';
$content_tags .= '<div class="col-sm-5">';
$content_tags .= '<input required type="text" name="wpbakery-page-builders[label]"  class="form-control" id="field-label" placeholder="My Bar Shortcode" value="' . $currentData['wpbakery-page-builders']['label'] . '">';
$content_tags .= '<p class="help-block">' . __e("Name of the shortcode shown in the menu, Usually plural") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- WPBAKERY PAGE BUILDER --|-- FORM --|-- NOTE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="note" class="col-sm-3 col-form-label">' . __e("Note") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input  type="text" name="wpbakery-page-builders[note]"  class="form-control" id="field-note" placeholder="" value="' . $currentData['wpbakery-page-builders']['note'] . '">';
$content_tags .= '<p class="help-block">' . __e("Just an additional information") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- WPBAKERY PAGE BUILDER --|-- FORM --|-- DESCRIPTION
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="note" class="col-sm-3 col-form-label">' . __e("Description") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<input required type="text" name="wpbakery-page-builders[description]"  class="form-control" id="field-description" placeholder="Bar tag description text" value="' . $currentData['wpbakery-page-builders']['description'] . '">';
$content_tags .= '<p class="help-block">' . __e("Short description of your element, it will be visible in “Add element” window") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- WPBAKERY PAGE BUILDER --|-- FORM --|-- ICON
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="note" class="col-sm-3 col-form-label">' . __e("Icon") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input required type="text" name="wpbakery-page-builders[icon]"  class="form-control" id="field-icon" placeholder="assets/icon.png" value="' . $currentData['wpbakery-page-builders']['icon'] . '">';
$content_tags .= '<p class="help-block">' . __e("URL or CSS class with icon image") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


// text
// TODO: LAYOUT --|-- WPBAKERY PAGE BUILDER --|-- FORM --|-- CATEGORIES
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="note" class="col-sm-3 col-form-label">' . __e("Categories") . '</label>';
$content_tags .= '<div class="col-sm-5">';
$content_tags .= '<input required type="text" name="wpbakery-page-builders[categories]"  class="form-control" id="field-categories" placeholder="Content, Social, Structure" value="' . $currentData['wpbakery-page-builders']['categories'] . '">';
$content_tags .= '<p class="help-block">' . __e("Category which best suites to describe the functionality of this shortcode, eg: <code>Content</code>, <code>Social</code>, or <code>Structure</code>") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

$content_tags .= '<hr/>';

// select
// TODO: LAYOUT --|-- WPBAKERY PAGE BUILDER --|-- FORM --|-- TYPE_GENERATOR
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="type_generator" class="col-sm-3 col-form-label">' . __e("Types of Generator") . '</label>';
$content_tags .= '<div class="col-sm-4">';
$content_tags .= '<select name="wpbakery-page-builders[type_generator]" class="form-control" id="field-type_generator">';
$options = array();
$options[] = array("value" => "auto", "label" => "Auto");
$options[] = array("value" => "custom-code", "label" => "Custom-code");
foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['wpbakery-page-builders']['type_generator'])
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
// TODO: LAYOUT --|-- WPBAKERY PAGE BUILDER --|-- FORM --|-- COPY_TO_CUSTOM_CODE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="copy_to_custom_code" class="col-sm-3 col-form-label">' . __e("Copy To Custom Code") . '</label>';
$content_tags .= '<div class="col-sm-9">';
if ($currentData['wpbakery-page-builders']['copy_to_custom_code'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="wpbakery-page-builders[copy_to_custom_code]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="wpbakery-page-builders[copy_to_custom_code]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
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
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=wpbakeryPageBuilders" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=wpbakeryPageBuilders&amp;n=' . $_prefix . '" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
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
// TODO: LAYOUT --|-- INSTRUCTIONS
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/wpbakery-page-builders.php</code></p>';
$content_tags .= '<hr/>';


$content_tags .= '<p>' . __e("You can use the following variable to get the value of the attributes") . ':</p>';

$ex_code = "<?php " . "\r\n";
if (!isset($currentData['wpbakery-page-builders']['fields']))
{
    $currentData['wpbakery-page-builders']['fields'] = array();
}
foreach ($currentData['wpbakery-page-builders']['fields'] as $zfield)
{
    $ex_code .= "" . 'echo $' . $string->toVar($project['short-name'] . '_' . $zfield['name']) . ' ;' . "\r\n";
}
$ex_code .= "\r\n";
$content_tags .= highlight_string($ex_code, true);


$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<h5>' . __e("Code References") . ':</h5>';
$content_tags .= '<ul>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/hooks/init/">Hook init</a>' . '</p></li>';


$content_tags .= '<li><p>' . '<a target="_blank" href="https://bitbucket.org/wpbakery/extend-wpbakery-page-builder-plugin-example/src/master/wpb_extend.php">Extend WPBakery Page Builder Plugin Example</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://kb.wpbakery.com/docs/inner-api/vc_map/">vc_map function</a>' . '</p></li>';
$content_tags .= '</ul>';
$content_tags .= '</div>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=wpbakeryPageBuilders" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=wpbakeryPageBuilders&amp;n=' . $_prefix . '" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card
$content_tags .= '</div>'; //col-md-6
$content_tags .= '</div>'; //row


// TODO: =================================================================================================

$content_tags .= '<div class="card card-outline card-primary">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-cogs"></i>&nbsp;';
$content_tags .= __e("Content/Shortcodes");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|--
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/wpbakery-page-builders.php</code></p>';
$content_tags .= '<hr/>';


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
    "path" => 'assets/js/' . $_prefix . '-wpbakery-page-builder.js');
$options[] = array(
    "label" => "CSS Style File",
    "value" => "styles",
    "path" => 'assets/css/' . $_prefix . '-wpbakery-page-builder.css');
$z = 0;
foreach ($options as $opt)
{
    $selected = "";
    foreach ($currentData['wpbakery-page-builders']['enqueue_scripts'] as $item)
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
    $content_tags .= '<input id="wpbakery-page-builders-enqueue_scripts-' . $opt["value"] . '-' . $z . '" ' . $selected . '  type="checkbox" name="wpbakery-page-builders[enqueue_scripts][' . $opt["value"] . ']"  class="form-control" placeholder="" value="' . $opt["value"] . '" />';
    $content_tags .= '<label for="wpbakery-page-builders-enqueue_scripts-' . $opt["value"] . '-' . $z . '">' . $opt["label"] . '</label>';
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


$module_path = IHS_MODULE_DIR . '/wpbakery-page-builders/front-ends/*.mod.php';
$__front_ends = array();
foreach (glob($module_path) as $filename)
{
    $module = null;
    include ($filename);
    $__front_ends[] = $module;
}


$content_tags .= '<h4>' . __e("Examples of codes:") . '</h4>';

// TODO: LAYOUT --|--  FORM --|-- FRONT-END --|-- TABLE
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

// TODO: LAYOUT --|--  FORM --|-- FRONT-END --|-- TABLE --|-- EDIT

$c = 0;
foreach ($currentData['wpbakery-page-builders']['front-ends'] as $field)
{
    if (!isset($field['name']))
    {
        $field['name'] = '';
    }


    $select_option = null;
    $select_option .= '<select name="wpbakery-page-builders[front-ends][' . $c . '][type]" data-target="' . $c . '" class="form-control wpbakery-page-builder-front-end-type" >';
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
    $content_tags .= '<td class="vcenter"><input name="wpbakery-page-builders[front-ends][' . $c . '][name]" class="form-control" type="text" value="' . $field['name'] . '"/><p class="helper-block"><strong>format</strong>: a-z, A-Z,0-9, and -<br/>don\'t use the number in the 1st variable</p></td>';
    $content_tags .= '<td class="vcenter"><input name="wpbakery-page-builders[front-ends][' . $c . '][label]" class="form-control" type="text" value="' . $field['label'] . '"/><p class="helper-block"><strong>format</strong>: text<br/>&nbsp;</p></td>';

    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="wpbakery-page-builders-front-end-option-' . $c . '" name="wpbakery-page-builders[front-ends][' . $c . '][option]" class="form-control" type="text" value="' . $field['option'] . '"/><span id="wpbakery-page-builders-front-end-option-select-' . $c . '"></span>';
    $content_tags .= '<p class="helper-block"><span id="wpbakery-page-builders-front-end-option-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';


    $content_tags .= '<td class="text-center vcenter"><a class="btn btn-danger btn-sm remove-item" data-target="#field-no-' . $c . '" href="#!_"><i class="fa fa-trash"></i></a><p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
    $content_tags .= '</tr>';
    $c++;
}

// TODO: LAYOUT --|--  FORM --|-- FRONT-END --|-- TABLE --|-- ADD

$c++;
$select_option = null;
$select_option .= '<select class="form-control wpbakery-page-builder-front-end-type" name="wpbakery-page-builders[front-ends][' . $c . '][type]" data-target="' . $c . '"   >';
foreach ($__front_ends as $__front_end)
{
    $select_option .= '<option value="' . $__front_end['name'] . '">' . $__front_end['label'] . '</option>';
}
$select_option .= '</select>';

$content_tags .= '<tr id="field-no-' . $c . '">';
$content_tags .= '<td class="text-center vcenter"><a href="#!_"><i class="fa fa-move"></i></a></td>';
$content_tags .= '<td class="text-center vcenter">' . $select_option . '<p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
$content_tags .= '<td class="text-center vcenter"><input name="wpbakery-page-builders[front-ends][' . $c . '][name]" class="form-control" type="text" value=""/><p class="helper-block"><strong>format</strong>: a-z, A-Z,0-9, and -<br/>don\'t use the number in the 1st variable</p></td>';
$content_tags .= '<td class="text-center vcenter"><input name="wpbakery-page-builders[front-ends][' . $c . '][label]" class="form-control" type="text" value=""/><p class="helper-block"><strong>format</strong>: text<br/>&nbsp;</p></td>';
$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="wpbakery-page-builders-front-end-option-' . $c . '" name="wpbakery-page-builders[front-ends][' . $c . '][option]" class="form-control" type="text" value=""/>';
$content_tags .= '<span id="wpbakery-page-builders-front-end-option-select-' . $c . '"></span>';
$content_tags .= '<p class="helper-block"><span id="wpbakery-page-builders-front-end-option-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
$content_tags .= '</td>';

$content_tags .= '<td class="text-center vcenter"><input name="submit" type="submit" class="btn btn-primary" value="' . __e("Add Field") . '" /><p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
$content_tags .= '</tr>';


$content_tags .= '</tbody>';
$content_tags .= '</table>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=wpbakeryPageBuilders" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=wpbakeryPageBuilders&amp;n=' . $_prefix . '" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


// TODO: =================================================================================================
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
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/wpbakery-page-builders.php</code></p>';
$content_tags .= '<hr/>';


$module_path = IHS_MODULE_DIR . '/wpbakery-page-builders/attributes/*.mod.php';
$__options = array();
foreach (glob($module_path) as $filename)
{
    $module = null;
    include ($filename);
    $__options[] = $module;
}


// TODO: LAYOUT --|--  FORM --|-- ATTRIBUTES --|-- TABLE
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
if (!isset($currentData['wpbakery-page-builders']['fields']))
{
    $currentData['wpbakery-page-builders']['fields'] = array();
}

if (!is_array($currentData['wpbakery-page-builders']['fields']))
{
    $currentData['wpbakery-page-builders']['fields'] = array();
}
// TODO: LAYOUT --|--  FORM --|-- ATTRIBUTES --|-- TABLE --|-- FIELDS
$c = 0;

foreach ($currentData['wpbakery-page-builders']['fields'] as $field)
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
    $select_option .= '<select name="wpbakery-page-builders[fields][' . $c . '][type]" data-target="' . $c . '" class="form-control wpbakery-page-builder-type" >';
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
    $content_tags .= '<td class="vcenter"><input name="wpbakery-page-builders[fields][' . $c . '][name]" placeholder="field-' . $c . '" class="form-control" type="text" value="' . $field['name'] . '"/><p class="helper-block"><strong>format</strong>: a-z, A-Z,0-9, and -<br/>don\'t use the number in the 1st variable</p></td>';
    $content_tags .= '<td class="vcenter"><input name="wpbakery-page-builders[fields][' . $c . '][label]" placeholder="Field ' . $c . '"  class="form-control" type="text" value="' . $field['label'] . '"/><p class="helper-block"><strong>format</strong>: text<br/>&nbsp;</p></td>';

    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="wpbakery-page-builders-options-' . $c . '" name="wpbakery-page-builders[fields][' . $c . '][options]" class="form-control" type="text" value="' . $field['options'] . '"/><span id="wpbakery-page-builders-options-select-' . $c . '"></span>';
    $content_tags .= '<p class="helper-block"><span id="wpbakery-page-builders-options-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';

    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="wpbakery-page-builders-default-' . $c . '" name="wpbakery-page-builders[fields][' . $c . '][default]" class="form-control" type="text" value="' . $field['default'] . '"/>';
    $content_tags .= '<p class="helper-block"><span id="wpbakery-page-builders-default-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';

    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="wpbakery-page-builders-info-' . $c . '" name="wpbakery-page-builders[fields][' . $c . '][info]" class="form-control" type="text" value="' . $field['info'] . '"/>';
    $content_tags .= '<p class="helper-block"><span id="wpbakery-page-builders-info-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';


    $content_tags .= '<td class="text-center vcenter"><a class="btn btn-danger btn-sm remove-item" data-target="#field-no-' . $c . '" href="#!_"><i class="fa fa-trash"></i></a><p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
    $content_tags .= '</tr>';
    $c++;
}

// TODO: LAYOUT --|--  FORM --|-- ATTRIBUTES --|-- TABLE --|-- ADD FIELDS

$c++;
$select_option = null;
$select_option .= '<select class="form-control wpbakery-page-builder-type" name="wpbakery-page-builders[fields][' . $c . '][type]" data-target="' . $c . '"   >';
foreach ($__options as $option)
{
    $select_option .= '<option value="' . $option['name'] . '">' . $option['label'] . '</option>';
}
$select_option .= '</select>';

$content_tags .= '<tr id="field-no-' . $c . '">';
$content_tags .= '<td class="text-center vcenter"><a href="#!_"><i class="fa fa-move"></i></a></td>';
$content_tags .= '<td class="text-center vcenter">' . $select_option . '<p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
$content_tags .= '<td class="text-center vcenter"><input name="wpbakery-page-builders[fields][' . $c . '][name]" placeholder="field-' . $c . '" class="form-control" type="text" value=""/><p class="helper-block"><strong>format</strong>: a-z, A-Z,0-9, and -<br/>don\'t use the number in the 1st variable</p></td>';
$content_tags .= '<td class="text-center vcenter"><input name="wpbakery-page-builders[fields][' . $c . '][label]" placeholder="Field ' . $c . '" class="form-control" type="text" value=""/><p class="helper-block"><strong>format</strong>: text<br/>&nbsp;</p></td>';

$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="wpbakery-page-builders-options-' . $c . '" name="wpbakery-page-builders[fields][' . $c . '][options]" class="form-control" type="text" value=""/>';
$content_tags .= '<span id="wpbakery-page-builders-options-select-' . $c . '"></span>';
$content_tags .= '<p class="helper-block"><span id="wpbakery-page-builders-options-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
$content_tags .= '</td>';

$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="wpbakery-page-builders-default-' . $c . '" name="wpbakery-page-builders[fields][' . $c . '][default]" class="form-control" type="text" value=""/>';
$content_tags .= '<p class="helper-block"><span id="wpbakery-page-builders-default-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
$content_tags .= '</td>';

$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="wpbakery-page-builders-info-' . $c . '" name="wpbakery-page-builders[fields][' . $c . '][info]" class="form-control" type="text" value=""/>';
$content_tags .= '<p class="helper-block"><span id="wpbakery-page-builders-info-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
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
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=wpbakeryPageBuilders" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=wpbakeryPageBuilders&amp;n=' . $_prefix . '" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


// TODO: =================================================================================================

// TODO: LAYOUT --|--  FORM --|-- CUSTOM CODE --|--
$content_tags .= '<div class="card card-outline card-danger">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-code"></i>&nbsp;';
$content_tags .= __e("Custom Code");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|--  FORM --|-- CUSTOM CODE --|--
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $_prefix . '/incl/wpbakery-page-builders/' . $_prefix . '-widget.php</code></p>';
$content_tags .= '<hr/>';


$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<p>' . __e("To use this feature you must change the General Settings: ") . '<strong>Types of Generator = <code>Custom Code</code></strong>' . __e(' and ') . '<strong>Copy To Custom Code = <code>OFF</code></strong></p>';
$content_tags .= '</div>';

$content_tags .= '<h3>';
$content_tags .= __e("Parameter");
$content_tags .= '</h3>';


$content_tags .= '<textarea name="wpbakery-page-builders[custom-code][param]" class="form-control" data-type="php">' . htmlentities($currentData['wpbakery-page-builders']['custom-code']['param']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';


$content_tags .= '<h3>';
$content_tags .= __e("Shortcode");
$content_tags .= '</h3>';
$content_tags .= '<textarea name="wpbakery-page-builders[custom-code][shortcode]" class="form-control" data-type="php">' . htmlentities($currentData['wpbakery-page-builders']['custom-code']['shortcode']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';


$content_tags .= '</div>'; //card-body
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-success btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=wpbakeryPageBuilders&amp;n=' . $_prefix . '" class="btn btn-default btn-flat pull-right"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


// TODO: =================================================================================================

$content_tags .= '</form>';
// TODO: LAYOUT --|--
switch ($_GET["a"])
{
    case "list":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=wpbakeryPageBuilders">' . __e("Wpbakery Page Builders") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("List") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags .= '<div class="card card-outline card-info">';
        $_content_tags .= '<div class="card-body">';

        $_content_tags .= '<div class="welcome">';
        $_content_tags .= '<h2>' . __e('Front-end') . '</h2>';
        $_content_tags .= '<h1>' . __e('WPBakery Page Builders') . '</h1>';
        $_content_tags .= '<p class="lead">' . __e('Extend WPBakery Page Builder with your own set of shortcodes') . '</p>';
        $_content_tags .= '</div>';

        // TODO: LIST --|-- TABLE
        $_content_tags .= '<table data-type="datatable" class="table datatable table-bordered">';
        $_content_tags .= '<thead>';
        $_content_tags .= '<tr>';
        $_content_tags .= '<th>' . __e("Name") . '</th>';
        $_content_tags .= '<th>' . __e("Note") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Action") . '</th>';
        $_content_tags .= '</tr>';
        $_content_tags .= '</thead>';
        $_content_tags .= '<tbody>';
        $wpbakery_page_builders = $db->getWpbakeryPageBuilders();
        foreach ($wpbakery_page_builders as $wpbakery_page_builder)
        {
            $_content_tags .= '<tr>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $wpbakery_page_builder['name'] . '</code></td>';
            $_content_tags .= '<td><em>' . $wpbakery_page_builder['note'] . '</em></td>';
            $_content_tags .= '<td class="text-center align-middle">';
            $_content_tags .= '<div class="btn-group btn-group-sm">';
            $_content_tags .= '<a href="#' . $wpbakery_page_builder['name'] . '" data-toggle="modal" data-target="#modal-trash-wpbakery-page-builders-' . $wpbakery_page_builder['name'] . '" data-href="./?p=wpbakeryPageBuilders&amp;a=trash&amp;n=' . $wpbakery_page_builder['name'] . '" class="btn btn-danger"><i class="fa fa-trash"></i> ' . __e("Trash") . '</a>';
            $_content_tags .= '<a href="./?p=wpbakeryPageBuilders&amp;a=edit&amp;n=' . $wpbakery_page_builder['name'] . '" class="btn btn-success"><i class="fa fa-edit"></i> ' . __e("Edit") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</td>';
            $_content_tags .= '</tr>';
        }
        $_content_tags .= '</tbody>';
        $_content_tags .= '</table>';
        $_content_tags .= '</div>';
        $_content_tags .= '<div class="card-footer">';
        $_content_tags .= '<a href="./?p=wpbakeryPageBuilders&amp;a=new" class="btn btn-success"><i class="fa fa-plus-circle"></i> ' . __e("Add New Page Builder") . '</a>';
        $_content_tags .= '</div>';
        $_content_tags .= '</div>';
        // TODO: LIST --|-- MODAL
        foreach ($wpbakery_page_builders as $wpbakery_page_builder)
        {
            $_content_tags .= '<div class="modal fade" id="modal-trash-wpbakery-page-builders-' . $wpbakery_page_builder['name'] . '">';
            $_content_tags .= '<div class="modal-dialog">';
            $_content_tags .= '<div class="modal-content bg-default">';
            $_content_tags .= '<div class="modal-header">';
            $_content_tags .= '<h4 class="modal-title">' . __e("Confirm") . '</h4>';
            $_content_tags .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            $_content_tags .= '<span aria-hidden="true">&times;</span></button>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-body">';
            $_content_tags .= '<p>' . __e("Are you sure You want to delete this WPBakery Page Builder?") . '</p>';
            $_content_tags .= '<table class="table-grid">';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td rowspan="4" style="text-align: center;"><i class="fa fa-list trash-logo"></i></td>';
            $_content_tags .= '<td>' . __e("Name") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $wpbakery_page_builder['name'] . '</code></td>';
            $_content_tags .= '</tr>';
            $_content_tags .= '</table>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-footer justify-content-between">';
            $_content_tags .= '<button type="button" class="btn btn-default" data-dismiss="modal">' . __e("Close") . '</button>';
            $_content_tags .= '<a href="./?p=wpbakeryPageBuilders&amp;a=trash&amp;n=' . $wpbakery_page_builder['name'] . '" class="btn btn-danger">' . __e("Yes, I am sure!") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
        }

        break;
    case "new":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=wpbakeryPageBuilders">' . __e("WPBakery Page Builders") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("New") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
    case "edit":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=wpbakeryPageBuilders">' . __e("WPBakery Page Builders") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("Edit") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
}
// TODO: JS --|-- ATTRIBUTES
$pagejs = null;
$pagejs .= "\t\t" . '//temporary current value' . "\r\n";
$pagejs .= "\t\t" . 'var option_field_type = [];' . "\r\n";
$pagejs .= "\t\t" . 'var option_field_name = [];' . "\r\n";
$pagejs .= "\t\t" . 'var option_field_label = [];' . "\r\n";
$pagejs .= "\t\t" . 'var option_field_options = [];' . "\r\n";
$pagejs .= "\t\t" . 'var option_field_default = [];' . "\r\n";
$pagejs .= "\t\t" . 'var option_field_info = [];' . "\r\n";

$c = 0;
foreach ($currentData['wpbakery-page-builders']['fields'] as $field)
{
    $pagejs .= "\t\t" . 'option_field_type[' . $c . '] = "' . $field["type"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'option_field_name[' . $c . '] = "' . $field["name"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'option_field_label[' . $c . '] = "' . $field["label"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'option_field_default[' . $c . '] = "' . $field["default"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'option_field_options[' . $c . '] = "' . $field["options"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'option_field_info[' . $c . '] = "' . $field["info"] . '" ;' . "\r\n";
    $c++;
}

$pagejs .= "\t\t" . '' . "\r\n";
$pagejs .= "\t\t" . 'function setField(target,value){' . "\r\n";
$pagejs .= "\t\t\t" . 'console.log(target,value);' . "\r\n";
$pagejs .= "\t\t\t" . '$(target).val(value);' . "\r\n";
$pagejs .= "\t\t" . '}' . "\r\n";
$pagejs .= "\t\t" . 'function PluginOption(ev){' . "\r\n";
$pagejs .= "\t\t\t" . 'var item_type = $(ev).val();' . "\r\n";
$pagejs .= "\t\t\t" . 'var item_target = $(ev).attr("data-target");' . "\r\n";
$pagejs .= "\t\t\t" . 'console.log("PluginOption",item_type,item_target);' . "\r\n";
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

    $pagejs .= "\t\t\t\t\t" . '$("#wpbakery-page-builders-options-select-" + item_target).html("");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#wpbakery-page-builders-options-" + item_target).removeClass("hidden");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#wpbakery-page-builders-default-" + item_target).removeClass("hidden");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#wpbakery-page-builders-info-" + item_target).removeClass("hidden");' . "\r\n";

    $pagejs .= "\t\t\t\t\t" . '$("#wpbakery-page-builders-options-" + item_target).prop("type","' . $__opt['options']['type'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#wpbakery-page-builders-options-" + item_target).attr("placeholder","' . $__opt['options']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#wpbakery-page-builders-options-help-" + item_target).html("' . $__opt['options']['help'] . '");' . "\r\n";

    $pagejs .= "\t\t\t\t\t" . '$("#wpbakery-page-builders-default-" + item_target).prop("type","' . $__opt['default']['type'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#wpbakery-page-builders-default-" + item_target).attr("placeholder","' . $__opt['default']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#wpbakery-page-builders-default-help-" + item_target).html("' . $__opt['default']['help'] . '");' . "\r\n";


    $pagejs .= "\t\t\t\t\t" . '$("#wpbakery-page-builders-info-" + item_target).attr("placeholder","' . $__opt['info']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#wpbakery-page-builders-info-help-" + item_target).html("' . $__opt['info']['help'] . '");' . "\r\n";


    $pagejs .= $__opt['code']['js'];

    $pagejs .= "\t\t\t\t\t" . 'break;' . "\r\n";
}
$pagejs .= "\t\t\t" . '}' . "\r\n";
$pagejs .= "\t\t" . '}' . "\r\n";

$pagejs .= "\t\t" . '$(".wpbakery-page-builder-type").on("click",function(){' . "\r\n";
$pagejs .= "\t\t\t" . 'PluginOption(this);' . "\r\n";
$pagejs .= "\t\t" . '});' . "\r\n";

$pagejs .= "\t\t" . 'var itemType = $(".wpbakery-page-builder-type");' . "\r\n";
$pagejs .= "\t\t" . '$.each(itemType, function() {' . "\r\n";
$pagejs .= "\t\t\t" . 'PluginOption(this);' . "\r\n";
$pagejs .= "\t\t" . '});' . "\r\n";

//========================================================================================
// TODO: JS --|-- FRONT-END
$pagejs .= "\t\t" . '/** FRONT-END **/' . "\r\n";
$pagejs .= "\t\t" . 'var front_end_field_type = [];' . "\r\n";
$pagejs .= "\t\t" . 'var front_end_field_name = [];' . "\r\n";
$pagejs .= "\t\t" . 'var front_end_field_label = [];' . "\r\n";
$pagejs .= "\t\t" . 'var front_end_field_option = [];' . "\r\n";
$pagejs .= "\t\t" . '' . "\r\n";
$c = 0;
foreach ($currentData['wpbakery-page-builders']['front-ends'] as $front_end)
{
    $pagejs .= "\t\t" . 'front_end_field_type[' . $c . '] = "' . $front_end["type"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'front_end_field_name[' . $c . '] = "' . $front_end["name"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'front_end_field_option[' . $c . '] = "' . $front_end["option"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . '' . "\r\n";
    $c++;
}

$pagejs .= "\t\t" . 'function WidgetFrontEnd(ev){' . "\r\n";
$pagejs .= "\t\t\t" . 'var item_type = $(ev).val();' . "\r\n";
$pagejs .= "\t\t\t" . 'var item_target = $(ev).attr("data-target");' . "\r\n";
$pagejs .= "\t\t\t" . 'console.log("WidgetFrontEnd",item_type,item_target);' . "\r\n";
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
    $pagejs .= "\t\t\t\t\t" . '$("#wpbakery-page-builders-front-end-option-select-" + item_target).html("");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#wpbakery-page-builders-front-end-option-" + item_target).removeClass("hidden");' . "\r\n";

    $pagejs .= $__front_end['code']['js'];

    $pagejs .= "\t\t\t\t\t" . 'break;' . "\r\n";

}
$pagejs .= "\t\t\t" . '}' . "\r\n";
$pagejs .= "\t\t" . '}' . "\r\n";


$pagejs .= "\t\t" . '$(".wpbakery-page-builder-front-end-type").on("click",function(){' . "\r\n";
$pagejs .= "\t\t\t" . 'WidgetFrontEnd(this);' . "\r\n";
$pagejs .= "\t\t" . '});' . "\r\n";

$pagejs .= "\t\t" . 'var itemType = $(".wpbakery-page-builder-front-end-type");' . "\r\n";
$pagejs .= "\t\t" . '$.each(itemType, function() {' . "\r\n";
$pagejs .= "\t\t\t" . 'WidgetFrontEnd(this);' . "\r\n";
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
define('IHS_PAGE_NAME', __e("WPBakery Page Builders"));
define('IHS_PAGE_DESC', __e("Extend WPBakery Page Builder"));
define('IHS_PAGE_JS', $pagejs);

?>