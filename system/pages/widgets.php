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
    $postData['widgets']['name'] = ""; //text
    $postData['widgets']['title'] = ""; //text
    $postData['widgets']['description'] = ""; //text
    $postData['widgets']['options'] = array();
    $postData['widgets']['type_of_code'] = "custom-fields"; //select
    $postData['widgets']['overwrite_custom_code'] = true; //boolean
    $postData['widgets']['enqueue_scripts'] = array(); //checkbox


    // TODO: ACTION --|-- SUBMIT --|-- POST RESPONSE
    // text
    // edit
    if (isset($_GET["n"]))
    {
        $_POST["widgets"]["name"] = $_GET["n"];
    }
    if (isset($_POST['widgets']['name']))
    {
        $postData['widgets']['name'] = $_POST['widgets']['name'];
    }
    // text
    if (isset($_POST['widgets']['title']))
    {
        $postData['widgets']['title'] = $_POST['widgets']['title'];
    }
    // text
    if (isset($_POST['widgets']['description']))
    {
        $postData['widgets']['description'] = $_POST['widgets']['description'];
    }

    // text
    if (isset($_POST['widgets']['custom-code']['update']))
    {
        $postData['widgets']['custom-code']['update'] = $_POST['widgets']['custom-code']['update'];
    }
    // text
    if (isset($_POST['widgets']['custom-code']['form']))
    {
        $postData['widgets']['custom-code']['form'] = $_POST['widgets']['custom-code']['form'];
    }

    // text
    if (isset($_POST['widgets']['custom-code']['admin-footer']))
    {
        $postData['widgets']['custom-code']['admin-footer'] = $_POST['widgets']['custom-code']['admin-footer'];
    }

    // text
    if (isset($_POST['widgets']['custom-code']['admin-enqueue-scripts']))
    {
        $postData['widgets']['custom-code']['admin-enqueue-scripts'] = $_POST['widgets']['custom-code']['admin-enqueue-scripts'];
    }

    // text
    if (isset($_POST['widgets']['custom-code']['widget']))
    {
        $postData['widgets']['custom-code']['widget'] = $_POST['widgets']['custom-code']['widget'];
    }

    // select
    if (isset($_POST['widgets']['type_of_code']))
    {
        $postData['widgets']['type_of_code'] = $_POST['widgets']['type_of_code'];
    }


    // boolean
    if (isset($_POST['widgets']['overwrite_custom_code']))
    {
        $postData['widgets']['overwrite_custom_code'] = true;
    } else
    {
        $postData['widgets']['overwrite_custom_code'] = false;
    }

    if (isset($_POST['widgets']['options']))
    {
        $y = 0;
        foreach ($_POST['widgets']['options'] as $fields)
        {
            if (trim($fields['name']) != '')
            {
                $postData['widgets']['options'][$y]['type'] = $fields['type'];
                $postData['widgets']['options'][$y]['name'] = $string->toFileName($fields['name']);
                $postData['widgets']['options'][$y]['label'] = trim($fields['label']);
                $postData['widgets']['options'][$y]['options'] = trim($fields['options']);
                $postData['widgets']['options'][$y]['default'] = trim($fields['default']);
                $postData['widgets']['options'][$y]['info'] = trim($fields['info']);
                $y++;
            }
        }
    }

    if (isset($_POST['widgets']['front-ends']))
    {
        $y = 0;
        foreach ($_POST['widgets']['front-ends'] as $fields)
        {
            if (trim($fields['name']) != '')
            {
                $postData['widgets']['front-ends'][$y]['type'] = $fields['type'];
                $postData['widgets']['front-ends'][$y]['name'] = trim($string->toFileName($fields['name']));
                $postData['widgets']['front-ends'][$y]['label'] = trim($fields['label']);
                $postData['widgets']['front-ends'][$y]['option'] = trim($fields['option']);
                $y++;
            }
        }
    }

    // checkbox
    if (isset($_POST['widgets']['enqueue_scripts']))
    {
        $postData['widgets']['enqueue_scripts'] = $_POST['widgets']['enqueue_scripts'];
    }


    // TODO: ACTION --|-- SUBMIT --|-- SAVE DATA

    // validate and save postdata
    $db->saveWidget($postData['widgets']);
    $db->current();
    $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Widgets saved successfully!");
    if ($_GET["a"] == "edit")
    {
        header("Location: ./?p=widgets&a=edit&alert=success&n=" . $_GET["n"] . "&" . time());
    } else
    {
        header("Location: ./?p=widgets&a=list&alert=success&" . time());
    }
}


// TODO: ACTION --|-- REMOVE --|-- WIDGETS
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "trash")
    {
        $_prefix = basename($_GET["n"]);
        $db->removeWidget($_prefix);
        $db->current();
        $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Widget deleted successfully!");
        header("Location: ./?p=widgets&a=list&alert=warning&" . time());
    }
}


// TODO: LAYOUT --|-- GENERAL
$disabled = "";
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "edit")
    {
        $_prefix = basename($_GET["n"]);
        $currentData["widgets"] = $db->getWidget($_prefix);
        $disabled = "disabled";
    }
}


// TODO: LAYOUT --|-- GENERAL --|-- INIT
//text
if (!isset($currentData['widgets']['name']))
{
    $currentData['widgets']['name'] = "";
}
//text
if (!isset($currentData['widgets']['title']))
{
    $currentData['widgets']['title'] = "";
}
//text
if (!isset($currentData['widgets']['description']))
{
    $currentData['widgets']['description'] = "";
}

//text
if (!isset($currentData['widgets']['custom-code']['form']))
{
    $currentData['widgets']['custom-code']['form'] = "";
}

//text
if (!isset($currentData['widgets']['custom-code']['update']))
{
    $currentData['widgets']['custom-code']['update'] = "";
}

//text
if (!isset($currentData['widgets']['custom-code']['admin-footer']))
{
    $currentData['widgets']['custom-code']['admin-footer'] = "";
}

//text
if (!isset($currentData['widgets']['custom-code']['admin-enqueue-scripts']))
{
    $currentData['widgets']['custom-code']['admin-enqueue-scripts'] = "";
}

//text
if (!isset($currentData['widgets']['custom-code']['widget']))
{
    $currentData['widgets']['custom-code']['widget'] = "";
}

if (!isset($currentData['widgets']['options']))
{
    $currentData['widgets']['options'] = array();
}

if (!isset($currentData['widgets']['front-ends']))
{
    $currentData['widgets']['front-ends'] = array();
}


//select
if (!isset($currentData['widgets']['type_of_code']))
{
    $currentData['widgets']['type_of_code'] = "auto";
}

//boolean
if (!isset($currentData['widgets']['overwrite_custom_code']))
{
    $currentData['widgets']['overwrite_custom_code'] = true;
}


//checkbox
if (!isset($currentData['widgets']['enqueue_scripts']))
{
    $currentData['widgets']['enqueue_scripts'] = array();
}


$ex_name = 'unknow';
if ($currentData['widgets']['name'] != '')
{
    $ex_name = $currentData['widgets']['name'];
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
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/widgets/' . $ex_name . '.php</code></p>';
$content_tags .= '<hr/>';

// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="name" class="col-sm-3 col-form-label">' . __e("Name") . '</label>';
$content_tags .= '<div class="col-sm-4">';
$content_tags .= '<input ' . $disabled . ' required type="text" name="widgets[name]"  class="form-control" id="field-name" placeholder="my-widget" value="' . $currentData['widgets']['name'] . '">';
$content_tags .= '<p class="help-block">' . __e("Only contain a-z, 0-9, and - characters") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- TITLE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="title" class="col-sm-3 col-form-label">' . __e("Title") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input  type="text" name="widgets[title]"  class="form-control" id="field-title" placeholder="My Widget" value="' . $currentData['widgets']['title'] . '">';
$content_tags .= '<p class="help-block">' . __e("The widget title will appear on the dashboard") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- DESCRIPTION
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="description" class="col-sm-3 col-form-label">' . __e("Description") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<input  type="text" name="widgets[description]"  class="form-control" id="field-description" placeholder="" value="' . $currentData['widgets']['description'] . '">';
$content_tags .= '<p class="help-block">' . __e("The widget description will appear on the dashboard") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


$content_tags .= '<hr/>';

// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- TYPE_OF_CODE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="type_of_code" class="col-sm-3 col-form-label">' . __e("Types of Generator") . '</label>';
$content_tags .= '<div class="col-sm-5">';
$content_tags .= '<select name="widgets[type_of_code]" class="form-control" id="field-type_of_code">';
$options = array();
$options[] = array("value" => "auto", "label" => "Auto Code (Options and Front-end)");
$options[] = array("value" => "custom-code", "label" => "Custom Code");
foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['widgets']['type_of_code'])
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
if ($currentData['widgets']['overwrite_custom_code'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="widgets[overwrite_custom_code]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="widgets[overwrite_custom_code]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
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
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=widgets" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=widgets" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
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

$content_tags .= '<div class="card-body">';

$content_tags .= '<h4>';
$content_tags .= __e("Widget Options");
$content_tags .= '</h4>';
$content_tags .= '<p>';
$content_tags .= __e("To retrieve values from the widget options you can use the following variables:");
$content_tags .= '</p>';
$example_code = null;
$example_code .= "" . '<?php' . "\r\n";
foreach ($currentData['widgets']['options'] as $field)
{
    $example_code .= "" . 'echo $instance["' . $string->toFileName($field['name']) . '"] ;' . "\r\n";
}
$content_tags .= '<div class="example-code">';
$content_tags .= highlight_string($example_code, true);
$content_tags .= '</div>';
$content_tags .= '<p>';
$content_tags .= __e("This variable only applies to widget and form functions");
$content_tags .= '</p>';

$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<h5>' . __e("Code References") . ':</h5>';
$content_tags .= '<ul>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/hooks/widgets_init/">widgets_init</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/register_widget/">register_widget</a>' . '</p></li>';
$content_tags .= '</ul>';
$content_tags .= '</div>';


$content_tags .= '</div>'; //card-body
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=widgets" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=widgets" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


$content_tags .= '</div>'; //col-md-6
$content_tags .= '</div>'; //row


// TODO: =========================================================

$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-12">';


$content_tags .= '<div class="card card-outline card-danger">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-filter"></i>&nbsp;';
$content_tags .= __e("Front-end Widget");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- FRONT-END
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/widgets/' . $ex_name . '.php</code></p>';
$content_tags .= '<hr/>';

$module_path = IHS_MODULE_DIR . '/widgets/front-ends/*.mod.php';
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
    "path" => 'assets/js/' . $ex_name . '-widget.js');
$options[] = array(
    "label" => "CSS Style File",
    "value" => "styles",
    "path" => 'assets/css/' . $ex_name . '-widget.css');
$z = 0;
foreach ($options as $opt)
{
    $selected = "";
    foreach ($currentData['widgets']['enqueue_scripts'] as $item)
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
    $content_tags .= '<input id="widgets-enqueue_scripts-' . $opt["value"] . '-' . $z . '" ' . $selected . '  type="checkbox" name="widgets[enqueue_scripts][' . $opt["value"] . ']"  class="form-control" placeholder="" value="' . $opt["value"] . '" />';
    $content_tags .= '<label for="widgets-enqueue_scripts-' . $opt["value"] . '-' . $z . '">' . $opt["label"] . '</label>';
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
foreach ($currentData['widgets']['front-ends'] as $field)
{
    if (!isset($field['name']))
    {
        $field['name'] = '';
    }


    $select_option = null;
    $select_option .= '<select name="widgets[front-ends][' . $c . '][type]" data-target="' . $c . '" class="form-control widget-front-end-type" >';
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
    $content_tags .= '<td class="vcenter"><input name="widgets[front-ends][' . $c . '][name]" class="form-control" type="text" value="' . $field['name'] . '"/><p class="helper-block"><strong>format</strong>: a-z, A-Z,0-9, and -<br/>don\'t use the number in the 1st variable</p></td>';
    $content_tags .= '<td class="vcenter"><input name="widgets[front-ends][' . $c . '][label]" class="form-control" type="text" value="' . $field['label'] . '"/><p class="helper-block"><strong>format</strong>: text<br/>&nbsp;</p></td>';

    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="widgets-front-end-option-' . $c . '" name="widgets[front-ends][' . $c . '][option]" class="form-control" type="text" value="' . $field['option'] . '"/><span id="widgets-front-end-option-select-' . $c . '"></span>';
    $content_tags .= '<p class="helper-block"><span id="widgets-front-end-option-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';


    $content_tags .= '<td class="text-center vcenter"><a class="btn btn-danger btn-sm remove-item" data-target="#field-no-' . $c . '" href="#!_"><i class="fa fa-trash"></i></a><p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
    $content_tags .= '</tr>';
    $c++;
}

// TODO: LAYOUT --|-- FRONT-END --|-- TABLE --|-- ADD

$c++;
$select_option = null;
$select_option .= '<select class="form-control widget-front-end-type" name="widgets[front-ends][' . $c . '][type]" data-target="' . $c . '"   >';
foreach ($__front_ends as $__front_end)
{
    $select_option .= '<option value="' . $__front_end['name'] . '">' . $__front_end['label'] . '</option>';
}
$select_option .= '</select>';

$content_tags .= '<tr id="field-no-' . $c . '">';
$content_tags .= '<td class="text-center vcenter"><a href="#!_"><i class="fa fa-move"></i></a></td>';
$content_tags .= '<td class="text-center vcenter">' . $select_option . '<p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
$content_tags .= '<td class="text-center vcenter"><input name="widgets[front-ends][' . $c . '][name]" class="form-control" type="text" value=""/><p class="helper-block"><strong>format</strong>: a-z, A-Z,0-9, and -<br/>don\'t use the number in the 1st variable</p></td>';
$content_tags .= '<td class="text-center vcenter"><input name="widgets[front-ends][' . $c . '][label]" class="form-control" type="text" value=""/><p class="helper-block"><strong>format</strong>: text<br/>&nbsp;</p></td>';
$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="widgets-front-end-option-' . $c . '" name="widgets[front-ends][' . $c . '][option]" class="form-control" type="text" value=""/>';
$content_tags .= '<span id="widgets-front-end-option-select-' . $c . '"></span>';
$content_tags .= '<p class="helper-block"><span id="widgets-front-end-option-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
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
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=widgets" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=widget&amp;n=' . $ex_name . '" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


// TODO: LAYOUT --|-- OPTIONS --|--
$content_tags .= '<div class="card card-outline card-success">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-cogs"></i>&nbsp;';
$content_tags .= __e("Widget Options");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header

$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/widgets/' . $ex_name . '.php</code></p>';
$content_tags .= '<hr/>';

$module_path = IHS_MODULE_DIR . '/widgets/options/*.mod.php';
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
foreach ($currentData['widgets']['options'] as $field)
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
    $select_option .= '<select name="widgets[options][' . $c . '][type]" data-target="' . $c . '" class="form-control widget-option-type" >';
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
    $content_tags .= '<td class="vcenter"><input name="widgets[options][' . $c . '][name]" placeholder="field-' . $c . '" class="form-control" type="text" value="' . $field['name'] . '"/><p class="helper-block"><strong>format</strong>: a-z, A-Z,0-9, and -<br/>don\'t use the number in the 1st variable</p></td>';
    $content_tags .= '<td class="vcenter"><input name="widgets[options][' . $c . '][label]" placeholder="Field ' . $c . '"  class="form-control" type="text" value="' . $field['label'] . '"/><p class="helper-block"><strong>format</strong>: text<br/>&nbsp;</p></td>';

    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="widgets-options-' . $c . '" name="widgets[options][' . $c . '][options]" class="form-control" type="text" value="' . $field['options'] . '"/><span id="widgets-options-select-' . $c . '"></span>';
    $content_tags .= '<p class="helper-block"><span id="widgets-options-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';

    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="widgets-default-' . $c . '" name="widgets[options][' . $c . '][default]" class="form-control" type="text" value="' . $field['default'] . '"/>';
    $content_tags .= '<p class="helper-block"><span id="widgets-default-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';

    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="widgets-info-' . $c . '" name="widgets[options][' . $c . '][info]" class="form-control" type="text" value="' . $field['info'] . '"/>';
    $content_tags .= '<p class="helper-block"><span id="widgets-info-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';


    $content_tags .= '<td class="text-center vcenter"><a class="btn btn-danger btn-sm remove-item" data-target="#field-no-' . $c . '" href="#!_"><i class="fa fa-trash"></i></a><p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
    $content_tags .= '</tr>';
    $c++;
}

// TODO: LAYOUT --|-- OPTIONS --|-- TABLE --|-- ADD FIELDS

$c++;
$select_option = null;
$select_option .= '<select class="form-control widget-option-type" name="widgets[options][' . $c . '][type]" data-target="' . $c . '"   >';
foreach ($__options as $option)
{
    $select_option .= '<option value="' . $option['name'] . '">' . $option['label'] . '</option>';
}
$select_option .= '</select>';

$content_tags .= '<tr id="field-no-' . $c . '">';
$content_tags .= '<td class="text-center vcenter"><a href="#!_"><i class="fa fa-move"></i></a></td>';
$content_tags .= '<td class="text-center vcenter">' . $select_option . '<p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
$content_tags .= '<td class="text-center vcenter"><input name="widgets[options][' . $c . '][name]" placeholder="field-' . $c . '" class="form-control" type="text" value=""/><p class="helper-block"><strong>format</strong>: a-z, A-Z,0-9, and -<br/>don\'t use the number in the 1st variable</p></td>';
$content_tags .= '<td class="text-center vcenter"><input name="widgets[options][' . $c . '][label]" placeholder="Field ' . $c . '" class="form-control" type="text" value=""/><p class="helper-block"><strong>format</strong>: text<br/>&nbsp;</p></td>';

$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="widgets-options-' . $c . '" name="widgets[options][' . $c . '][options]" class="form-control" type="text" value=""/>';
$content_tags .= '<span id="widgets-options-select-' . $c . '"></span>';
$content_tags .= '<p class="helper-block"><span id="widgets-options-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
$content_tags .= '</td>';

$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="widgets-default-' . $c . '" name="widgets[options][' . $c . '][default]" class="form-control" type="text" value=""/>';
$content_tags .= '<p class="helper-block"><span id="widgets-default-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
$content_tags .= '</td>';

$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="widgets-info-' . $c . '" name="widgets[options][' . $c . '][info]" class="form-control" type="text" value=""/>';
$content_tags .= '<p class="helper-block"><span id="widgets-info-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
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
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=widgets" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=widget&amp;n=' . $ex_name . '" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card

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
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/widgets.php</code></p>';
$content_tags .= '<hr/>';

// TODO: LAYOUT --|-- CUSTOM CODE --|--

$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<p>' . __e("To use this feature you must change the General Settings: ") . '<strong>Types of Generator = <code>Custom Code</code></strong>' . __e(' and ') . '<strong>Copy To Custom Code = <code>OFF</code></strong></p>';
$content_tags .= '</div>';

$content_tags .= '<h3>';
$content_tags .= __e("Form");
$content_tags .= '</h3>';
$content_tags .= '<textarea name="widgets[custom-code][form]" class="form-control" data-type="php">' . htmlentities($currentData['widgets']['custom-code']['form']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';


$content_tags .= '<h3>';
$content_tags .= __e("Update");
$content_tags .= '</h3>';
$content_tags .= '<textarea name="widgets[custom-code][update]" class="form-control" data-type="php">' . htmlentities($currentData['widgets']['custom-code']['update']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';


$content_tags .= '<h3>';
$content_tags .= __e("Admin Footer");
$content_tags .= '</h3>';
$content_tags .= '<textarea name="widgets[custom-code][admin-footer]" class="form-control" data-type="php">' . htmlentities($currentData['widgets']['custom-code']['admin-footer']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';

$content_tags .= '<h3>';
$content_tags .= __e("Admin Enqueue Scripts");
$content_tags .= '</h3>';
$content_tags .= '<textarea name="widgets[custom-code][admin-enqueue-scripts]" class="form-control" data-type="php">' . htmlentities($currentData['widgets']['custom-code']['admin-enqueue-scripts']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';

$content_tags .= '<h3>';
$content_tags .= __e("Widget Code (Front-end)");
$content_tags .= '</h3>';
$content_tags .= '<textarea name="widgets[custom-code][widget]" class="form-control" data-type="php">' . htmlentities($currentData['widgets']['custom-code']['widget']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';


$content_tags .= '</div>'; //card-body
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-default btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=widgets" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=widget&amp;n=' . $ex_name . '" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


$content_tags .= '</div>'; //col-md-12
$content_tags .= '</div>'; //row


$content_tags .= '</form>';
// TODO: =========================================================
switch ($_GET["a"])
{
    case "list":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=widgets">' . __e("Legacy Widgets") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("List") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags .= '<div class="card card-outline card-info">';
        $_content_tags .= '<div class="card-body">';

        $_content_tags .= '<div class="welcome">';
        $_content_tags .= '<h2>' . __e('Front-end') . '</h2>';
        $_content_tags .= '<h1>' . __e('Legacy Widgets') . '</h1>';
        $_content_tags .= '<p class="lead">' . __e('Create a legacy widget with options') . '</p>';
        $_content_tags .= '</div>';

        // TODO: LIST --|-- TABLE
        $_content_tags .= '<table data-type="datatable" class="table datatable table-bordered">';
        $_content_tags .= '<thead>';
        $_content_tags .= '<tr>';
        $_content_tags .= '<th>' . __e("Name") . '</th>';
        $_content_tags .= '<th>' . __e("Title") . '</th>';
        $_content_tags .= '<th style="width: 50% !important;">' . __e("Options") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Action") . '</th>';
        $_content_tags .= '</tr>';
        $_content_tags .= '</thead>';
        $_content_tags .= '<tbody>';
        $widgets = $db->getWidgets();
        foreach ($widgets as $widget)
        {
            $widget_options = '';
            $new_options = array();
            if (isset($widget['options']))
            {
                foreach ($widget['options'] as $field)
                {
                    $new_options[] = $string->toVar($project['short-name'] . '_' . $field['name']);
                }
                if (count($widget['options']) != 0)
                {
                    $widget_options = '<span class="badge badge-success">' . implode('</span> <span class="badge badge-success">', $new_options) . '</span>';
                }
            }

            $_content_tags .= '<tr>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $widget['name'] . '</code></td>';
            $_content_tags .= '<td>' . ($widget['title']) . '</td>';
            $_content_tags .= '<td>' . $widget_options . '</td>';
            $_content_tags .= '<td class="text-center align-middle">';
            $_content_tags .= '<div class="btn-group btn-group-sm">';
            $_content_tags .= '<a href="#' . $widget['name'] . '" data-toggle="modal" data-target="#modal-trash-widgets-' . $widget['name'] . '" data-href="./?p=widgets&amp;a=trash&amp;n=' . $widget['name'] . '" class="btn btn-danger"><i class="fa fa-trash"></i> ' . __e("Trash") . '</a>';
            $_content_tags .= '<a href="./?p=widgets&amp;a=edit&amp;n=' . $widget['name'] . '" class="btn btn-success"><i class="fa fa-edit"></i> ' . __e("Edit") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</td>';
            $_content_tags .= '</tr>';
        }
        $_content_tags .= '</tbody>';
        $_content_tags .= '</table>';
        $_content_tags .= '</div>';
        $_content_tags .= '<div class="card-footer">';
        $_content_tags .= '<a href="./?p=widgets&amp;a=new" class="btn btn-success"><i class="fa fa-plus-circle"></i> ' . __e("Add New Widgets") . '</a>';
        $_content_tags .= '</div>';
        $_content_tags .= '</div>';
        // TODO: LIST --|-- MODAL
        foreach ($widgets as $widget)
        {
            $_content_tags .= '<div class="modal fade" id="modal-trash-widgets-' . $widget['name'] . '">';
            $_content_tags .= '<div class="modal-dialog">';
            $_content_tags .= '<div class="modal-content bg-default">';
            $_content_tags .= '<div class="modal-header">';
            $_content_tags .= '<h4 class="modal-title">' . __e("Confirm") . '</h4>';
            $_content_tags .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            $_content_tags .= '<span aria-hidden="true">&times;</span></button>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-body">';
            $_content_tags .= '<p>' . __e("Are you sure You want to delete this widgets?") . '</p>';
            $_content_tags .= '<table class="table-grid">';

            $_content_tags .= '<tr>';
            $_content_tags .= '<td rowspan="4" style="text-align: center;"><i class="fa fa-clipboard-list trash-logo"></i></td>';
            $_content_tags .= '<td>' . __e("Name") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $widget['name'] . '</code></td>';
            $_content_tags .= '</tr>';

            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Title") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td>' . $widget['title'] . '</td>';
            $_content_tags .= '</tr>';

            //$_content_tags .= '<tr>';
            //$_content_tags .= '<td>' . __e("name") . '</td>';
            //$_content_tags .= '<td>:</td>';
            //$_content_tags .= '<td>' . $widget['name'] . '</td>';
            //$_content_tags .= '</tr>';

            //$_content_tags .= '<tr>';
            //$_content_tags .= '<td>' . __e("name") . '</td>';
            //$_content_tags .= '<td>:</td>';
            //$_content_tags .= '<td>' . $widget['name'] . '</td>';
            //$_content_tags .= '</tr>';

            $_content_tags .= '</table>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-footer justify-content-between">';
            $_content_tags .= '<button type="button" class="btn btn-default" data-dismiss="modal">' . __e("Close") . '</button>';
            $_content_tags .= '<a href="./?p=widgets&amp;a=trash&amp;n=' . $widget['name'] . '" class="btn btn-danger">' . __e("Yes, I am sure!") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
        }

        break;
    case "new":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=widgets">' . __e("Legacy Widgets") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("New") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
    case "edit":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=widgets">' . __e("Legacy Widgets") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("Edit") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
}

$pagejs = null;
$pagejs .= "\t\t" . '//temporary current value' . "\r\n";

$pagejs .= "\t\t" . 'var option_field_type = [];' . "\r\n";
$pagejs .= "\t\t" . 'var option_field_name = [];' . "\r\n";
$pagejs .= "\t\t" . 'var option_field_label = [];' . "\r\n";
$pagejs .= "\t\t" . 'var option_field_options = [];' . "\r\n";
$pagejs .= "\t\t" . 'var option_field_default = [];' . "\r\n";
$pagejs .= "\t\t" . 'var option_field_info = [];' . "\r\n";

$c = 0;
foreach ($currentData['widgets']['options'] as $field)
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
$pagejs .= "\t\t" . 'function WidgetOption(ev){' . "\r\n";

$pagejs .= "\t\t\t" . 'var item_type = $(ev).val();' . "\r\n";
$pagejs .= "\t\t\t" . 'var item_target = $(ev).attr("data-target");' . "\r\n";
$pagejs .= "\t\t\t" . 'console.log("WidgetOption",item_type,item_target);' . "\r\n";
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

    $pagejs .= "\t\t\t\t\t" . '$("#widgets-options-select-" + item_target).html("");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#widgets-options-" + item_target).removeClass("hidden");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#widgets-default-" + item_target).removeClass("hidden");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#widgets-info-" + item_target).removeClass("hidden");' . "\r\n";

    $pagejs .= "\t\t\t\t\t" . '$("#widgets-options-" + item_target).prop("type","' . $__opt['options']['type'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#widgets-options-" + item_target).attr("placeholder","' . $__opt['options']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#widgets-options-help-" + item_target).html("' . $__opt['options']['help'] . '");' . "\r\n";

    $pagejs .= "\t\t\t\t\t" . '$("#widgets-default-" + item_target).prop("type","' . $__opt['default']['type'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#widgets-default-" + item_target).attr("placeholder","' . $__opt['default']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#widgets-default-help-" + item_target).html("' . $__opt['default']['help'] . '");' . "\r\n";


    $pagejs .= "\t\t\t\t\t" . '$("#widgets-info-" + item_target).attr("placeholder","' . $__opt['info']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#widgets-info-help-" + item_target).html("' . $__opt['info']['help'] . '");' . "\r\n";


    $pagejs .= $__opt['code']['js'];

    $pagejs .= "\t\t\t\t\t" . 'break;' . "\r\n";
}
$pagejs .= "\t\t\t" . '}' . "\r\n";
$pagejs .= "\t\t" . '}' . "\r\n";

$pagejs .= "\t\t" . '$(".widget-option-type").on("click",function(){' . "\r\n";
$pagejs .= "\t\t\t" . 'WidgetOption(this);' . "\r\n";
$pagejs .= "\t\t" . '});' . "\r\n";

$pagejs .= "\t\t" . 'var itemType = $(".widget-option-type");' . "\r\n";
$pagejs .= "\t\t" . '$.each(itemType, function() {' . "\r\n";
$pagejs .= "\t\t\t" . 'WidgetOption(this);' . "\r\n";
$pagejs .= "\t\t" . '});' . "\r\n";

// TODO: JS --|-- FRONT-END
$pagejs .= "\t\t" . '/** FRONT-END **/' . "\r\n";
$pagejs .= "\t\t" . 'var front_end_field_type = [];' . "\r\n";
$pagejs .= "\t\t" . 'var front_end_field_name = [];' . "\r\n";
$pagejs .= "\t\t" . 'var front_end_field_label = [];' . "\r\n";
$pagejs .= "\t\t" . 'var front_end_field_option = [];' . "\r\n";
$pagejs .= "\t\t" . '' . "\r\n";
$c = 0;
foreach ($currentData['widgets']['front-ends'] as $front_end)
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
    $pagejs .= "\t\t\t\t\t" . '$("#widgets-front-end-option-select-" + item_target).html("");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#widgets-front-end-option-" + item_target).removeClass("hidden");' . "\r\n";

    $pagejs .= $__front_end['code']['js'];

    $pagejs .= "\t\t\t\t\t" . 'break;' . "\r\n";

}
$pagejs .= "\t\t\t" . '}' . "\r\n";
$pagejs .= "\t\t" . '}' . "\r\n";


$pagejs .= "\t\t" . '$(".widget-front-end-type").on("click",function(){' . "\r\n";
$pagejs .= "\t\t\t" . 'WidgetFrontEnd(this);' . "\r\n";
$pagejs .= "\t\t" . '});' . "\r\n";

$pagejs .= "\t\t" . 'var itemType = $(".widget-front-end-type");' . "\r\n";
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
define('IHS_PAGE_NAME', __e("Legacy Widget"));
define('IHS_PAGE_DESC', __e("Register a Legacy Widget"));
define('IHS_PAGE_JS', $pagejs);

?>