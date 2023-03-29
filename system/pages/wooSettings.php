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


// TODO: ACTION --|-- SUBMIT --|--

if (isset($_POST['submit']))
{
    $postData['woo-settings']['name'] = ""; //text
    $postData['woo-settings']['note'] = ""; //text
    $postData['woo-settings']['label'] = ""; //text
    $postData['woo-settings']['type_generator'] = "auto"; //select
    $postData['woo-settings']['copy_to_custom_code'] = true; //boolean

    // TODO: ACTION --|-- SUBMIT --|-- POST RESPONSE


    // edit
    if (isset($_GET["n"]))
    {
        $_POST["woo-settings"]["name"] = $_GET["n"];
    }

    // text
    if (isset($_POST['woo-settings']['name']))
    {
        $postData['woo-settings']['name'] = $_POST['woo-settings']['name'];
    }
    // text
    if (isset($_POST['woo-settings']['desc']))
    {
        $postData['woo-settings']['desc'] = $_POST['woo-settings']['desc'];
    }

    // text
    if (isset($_POST['woo-settings']['custom-code']['options']))
    {
        $postData['woo-settings']['custom-code']['options'] = $_POST['woo-settings']['custom-code']['options'];
    }

    // select
    if (isset($_POST['woo-settings']['settings_tab']))
    {
        $postData['woo-settings']['settings_tab'] = $_POST['woo-settings']['settings_tab'];
    }


    // text
    if (isset($_POST['woo-settings']['label']))
    {
        $postData['woo-settings']['label'] = $_POST['woo-settings']['label'];
    }
    // select
    if (isset($_POST['woo-settings']['type_generator']))
    {
        $postData['woo-settings']['type_generator'] = $_POST['woo-settings']['type_generator'];
    }
    // boolean
    if (isset($_POST['woo-settings']['copy_to_custom_code']))
    {
        $postData['woo-settings']['copy_to_custom_code'] = true;
    } else
    {
        $postData['woo-settings']['copy_to_custom_code'] = false;
    }

    if (isset($_POST['woo-settings']['fields']))
    {
        $y = 0;
        foreach ($_POST['woo-settings']['fields'] as $fields)
        {
            if (trim($fields['name']) != '')
            {
                $postData['woo-settings']['fields'][$y]['type'] = $fields['type'];
                $postData['woo-settings']['fields'][$y]['name'] = $string->toFileName($fields['name']);
                $postData['woo-settings']['fields'][$y]['label'] = trim($fields['label']);
                $postData['woo-settings']['fields'][$y]['options'] = trim($fields['options']);
                $postData['woo-settings']['fields'][$y]['default'] = trim($fields['default']);
                $postData['woo-settings']['fields'][$y]['info'] = trim($fields['info']);
                $y++;
            }
        }
    }

    // TODO: ACTION --|-- SUBMIT --|-- SAVE DATA

    // validate and save postdata
    $db->saveWooSetting($postData['woo-settings']);
    $db->current();
    $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Woo-settings saved successfully!");
    if ($_GET["a"] == "edit")
    {
        header("Location: ./?p=wooSettings&a=edit&alert=success&n=" . $_GET["n"] . "&" . time());
    } else
    {
        header("Location: ./?p=wooSettings&a=list&alert=success&" . time());
    }
}


// TODO: ACTION --|-- REMOVE --|-- WOO-SETTINGS
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "trash")
    {
        $_prefix = basename($_GET["n"]);
        $db->removeWooSetting($_prefix);
        $db->current();
        $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Woo-setting deleted successfully!");
        header("Location: ./?p=wooSettings&a=list&alert=warning&" . time());
    }
}


// TODO: LAYOUT --|-- WOOCOMMERCE SETTINGS
$disabled = $_prefix = "";
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "edit")
    {
        $_prefix = basename($_GET["n"]);
        $currentData["woo-settings"] = $db->getWooSetting($_prefix);
        $disabled = "disabled";
    }
}


// TODO: LAYOUT --|-- WOOCOMMERCE SETTINGS --|-- INIT
//text
if (!isset($currentData['woo-settings']['name']))
{
    $currentData['woo-settings']['name'] = "";
}
//text
if (!isset($currentData['woo-settings']['desc']))
{
    $currentData['woo-settings']['desc'] = "";
}
//text
if (!isset($currentData['woo-settings']['label']))
{
    $currentData['woo-settings']['label'] = "";
}
//select
if (!isset($currentData['woo-settings']['type_generator']))
{
    $currentData['woo-settings']['type_generator'] = "auto";
}
//boolean
if (!isset($currentData['woo-settings']['copy_to_custom_code']))
{
    $currentData['woo-settings']['copy_to_custom_code'] = true;
}
//select
if (!isset($currentData['woo-settings']['settings_tab']))
{
    $currentData['woo-settings']['settings_tab'] = "general";
}

if (!isset($currentData['woo-settings']['custom-code']['options']))
{
    $currentData['woo-settings']['custom-code']['options'] = '';
}

if (!isset($currentData['woo-settings']['fields']))
{
    $currentData['woo-settings']['fields'] = array();
}

$content_tags .= '<form class="form-horizontal" action="" method="post">';
$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-6">';
$content_tags .= '<div class="card card-outline card-primary">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-th"></i>&nbsp;';
$content_tags .= __e("WooCommerce Settings");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- WOOCOMMERCE SETTINGS --|-- FORM
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/woo-settings/' . $_prefix . '.php</code></p>';
$content_tags .= '<hr/>';

// text
// TODO: LAYOUT --|-- WOOCOMMERCE SETTINGS --|-- FORM --|-- NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="name" class="col-sm-3 col-form-label">' . __e("Name") . '</label>';
$content_tags .= '<div class="col-sm-5">';
$content_tags .= '<input ' . $disabled . ' required type="text" name="woo-settings[name]"  class="form-control" id="field-name" placeholder="my-settings" value="' . $currentData['woo-settings']['name'] . '">';
$content_tags .= '<p class="help-block">' . __e("Name, must not exceed 20 characters and may only contain a-z, 0-9, and - characters") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


// text
// TODO: LAYOUT --|-- WOOCOMMERCE SETTINGS --|-- FORM --|-- LABEL
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label" class="col-sm-3 col-form-label">' . __e("Section Label") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input required type="text" name="woo-settings[label]"  class="form-control" id="field-label" placeholder="My Settings" value="' . $currentData['woo-settings']['label'] . '">';
$content_tags .= '<p class="help-block">' . __e("Write the section label/name") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- WOOCOMMERCE SETTINGS --|-- FORM --|-- DESC
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="desc" class="col-sm-3 col-form-label">' . __e("Description") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<input  type="text" name="woo-settings[desc]"  class="form-control" id="field-desc" placeholder="" value="' . $currentData['woo-settings']['desc'] . '">';
$content_tags .= '<p class="help-block">' . __e("Description of your settings") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// select
// TODO: LAYOUT --|-- WOOCOMMERCE SETTINGS --|-- FORM --|-- SETTINGS_TAB
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="settings_tab" class="col-sm-3 col-form-label">' . __e("Settings Tab") . '</label>';
$content_tags .= '<div class="col-sm-7">';
$content_tags .= '<select name="woo-settings[settings_tab]" class="form-control" id="field-settings_tab">';

$options = array();
$options[] = array("value" => "general", "label" => "WooCommerce &gt; Settings &gt; General");
$options[] = array("value" => "products", "label" => "WooCommerce &gt; Settings &gt; Products");
$options[] = array("value" => "shipping", "label" => "WooCommerce &gt; Settings &gt; Shipping");
$options[] = array("value" => "checkout", "label" => "WooCommerce &gt; Settings &gt; Payments");
$options[] = array("value" => "account", "label" => "WooCommerce &gt; Settings &gt; Accounts &amp; Privacy");
$options[] = array("value" => "email", "label" => "WooCommerce &gt; Settings &gt; Email");
$options[] = array("value" => "advanced", "label" => "WooCommerce &gt; Settings &gt; Advanced");

foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['woo-settings']['settings_tab'])
    {
        $selected = "selected";
    }
    $content_tags .= '<option ' . $selected . ' value="' . $opt["value"] . '">' . $opt["label"] . '</option>';
}
$content_tags .= '</select>';
$content_tags .= '<p class="help-block">' . __e("Will it be applied to tabs?") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


$content_tags .= '<hr>';


// select
// TODO: LAYOUT --|-- WOOCOMMERCE SETTINGS --|-- FORM --|-- TYPE_GENERATOR
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="type_generator" class="col-sm-3 col-form-label">' . __e("Types of Generator") . '</label>';
$content_tags .= '<div class="col-sm-4">';
$content_tags .= '<select name="woo-settings[type_generator]" class="form-control" id="field-type_generator">';
$options = array();
$options[] = array("value" => "auto", "label" => "Auto");
$options[] = array("value" => "custom-code", "label" => "Custom-code");
foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['woo-settings']['type_generator'])
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
// TODO: LAYOUT --|-- WOOCOMMERCE SETTINGS --|-- FORM --|-- COPY_TO_CUSTOM_CODE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="copy_to_custom_code" class="col-sm-3 col-form-label">' . __e("Copy To Custom Code") . '</label>';
$content_tags .= '<div class="col-sm-9">';
if ($currentData['woo-settings']['copy_to_custom_code'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="woo-settings[copy_to_custom_code]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="woo-settings[copy_to_custom_code]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
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
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=wooSettings" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=wooSettings&amp;n=' . $_prefix . '" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
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

$content_tags .= '<h3>' . __e("Using the New Settings") . '</h3>';
$content_tags .= '<p>' . __e("You can use the code below to get the settings that have been made previously.") . '</p>';

$example_code = null;
$example_code .= "" . '<?php' . "\r\n";

foreach ($currentData['woo-settings']['fields'] as $field)
{
    $var = $string->toVar($field['name']);
    $var_option = $string->toVar($project['short-name'] . '-' . $field['name']);
    $example_code .= '$' . $var . ' = get_option("' . $var_option . '");' . "\r\n";

}


$content_tags .= '<div class="example-code">';
$content_tags .= highlight_string($example_code, true);
$content_tags .= '</div>';


$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<h5>' . __e("Code References") . ':</h5>';
$content_tags .= '<ul>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/get_option/">get_option</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://woocommerce.com/document/adding-a-section-to-a-settings-tab/">Adding a Section to a Settings Tab</a>' . '</p></li>';
$content_tags .= '</ul>';
$content_tags .= '</div>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=wooSettings" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=wooSettings&amp;n=' . $_prefix . '" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
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
$content_tags .= '<i class="fas fa-cogs"></i>&nbsp;';
$content_tags .= __e("Options");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|--
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/woo-settings/' . $_prefix . '.php</code></p>';
$content_tags .= '<hr/>';


$module_path = IHS_MODULE_DIR . '/woo-settings/fields/*.mod.php';
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
if (!isset($currentData['woo-settings']['fields']))
{
    $currentData['woo-settings']['fields'] = array();
}

if (!is_array($currentData['woo-settings']['fields']))
{
    $currentData['woo-settings']['fields'] = array();
}
// TODO: LAYOUT --|--  FORM --|-- ATTRIBUTES --|-- TABLE --|-- FIELDS
$c = 0;

foreach ($currentData['woo-settings']['fields'] as $field)
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
    $select_option .= '<select name="woo-settings[fields][' . $c . '][type]" data-target="' . $c . '" class="form-control woo-setting-type" >';
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
    $content_tags .= '<td class="vcenter"><input name="woo-settings[fields][' . $c . '][name]" placeholder="field-' . $c . '" class="form-control" type="text" value="' . $field['name'] . '"/><p class="helper-block"><strong>format</strong>: a-z, A-Z,0-9, and -<br/>don\'t use the number in the 1st variable</p></td>';
    $content_tags .= '<td class="vcenter"><input name="woo-settings[fields][' . $c . '][label]" placeholder="Field ' . $c . '"  class="form-control" type="text" value="' . $field['label'] . '"/><p class="helper-block"><strong>format</strong>: text<br/>&nbsp;</p></td>';

    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="woo-settings-options-' . $c . '" name="woo-settings[fields][' . $c . '][options]" class="form-control" type="text" value="' . $field['options'] . '"/><span id="woo-settings-options-select-' . $c . '"></span>';
    $content_tags .= '<p class="helper-block"><span id="woo-settings-options-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';

    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="woo-settings-default-' . $c . '" name="woo-settings[fields][' . $c . '][default]" class="form-control" type="text" value="' . $field['default'] . '"/>';
    $content_tags .= '<p class="helper-block"><span id="woo-settings-default-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';

    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="woo-settings-info-' . $c . '" name="woo-settings[fields][' . $c . '][info]" class="form-control" type="text" value="' . $field['info'] . '"/>';
    $content_tags .= '<p class="helper-block"><span id="woo-settings-info-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';


    $content_tags .= '<td class="text-center vcenter"><a class="btn btn-danger btn-sm remove-item" data-target="#field-no-' . $c . '" href="#!_"><i class="fa fa-trash"></i></a><p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
    $content_tags .= '</tr>';
    $c++;
}

// TODO: LAYOUT --|--  FORM --|-- ATTRIBUTES --|-- TABLE --|-- ADD FIELDS

$c++;
$select_option = null;
$select_option .= '<select class="form-control woo-setting-type" name="woo-settings[fields][' . $c . '][type]" data-target="' . $c . '"   >';
foreach ($__options as $option)
{
    $select_option .= '<option value="' . $option['name'] . '">' . $option['label'] . '</option>';
}
$select_option .= '</select>';

$content_tags .= '<tr id="field-no-' . $c . '">';
$content_tags .= '<td class="text-center vcenter"><a href="#!_"><i class="fa fa-move"></i></a></td>';
$content_tags .= '<td class="text-center vcenter">' . $select_option . '<p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
$content_tags .= '<td class="text-center vcenter"><input name="woo-settings[fields][' . $c . '][name]" placeholder="field-' . $c . '" class="form-control" type="text" value=""/><p class="helper-block"><strong>format</strong>: a-z, A-Z,0-9, and -<br/>don\'t use the number in the 1st variable</p></td>';
$content_tags .= '<td class="text-center vcenter"><input name="woo-settings[fields][' . $c . '][label]" placeholder="Field ' . $c . '" class="form-control" type="text" value=""/><p class="helper-block"><strong>format</strong>: text<br/>&nbsp;</p></td>';

$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="woo-settings-options-' . $c . '" name="woo-settings[fields][' . $c . '][options]" class="form-control" type="text" value=""/>';
$content_tags .= '<span id="woo-settings-options-select-' . $c . '"></span>';
$content_tags .= '<p class="helper-block"><span id="woo-settings-options-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
$content_tags .= '</td>';

$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="woo-settings-default-' . $c . '" name="woo-settings[fields][' . $c . '][default]" class="form-control" type="text" value=""/>';
$content_tags .= '<p class="helper-block"><span id="woo-settings-default-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
$content_tags .= '</td>';

$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="woo-settings-info-' . $c . '" name="woo-settings[fields][' . $c . '][info]" class="form-control" type="text" value=""/>';
$content_tags .= '<p class="helper-block"><span id="woo-settings-info-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
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
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=wooSettings" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=wooSettings&amp;n=' . $_prefix . '" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


$content_tags .= '<div class="card card-outline card-info">';
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
// TODO: LAYOUT --|--
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/woo-settings.php</code></p>';
$content_tags .= '<hr/>';


$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<p>' . __e("To use this feature you must change the General Settings: ") . '<strong>Types of Generator = <code>Custom Code</code></strong>' . __e(' and ') . '<strong>Copy To Custom Code = <code>OFF</code></strong></p>';
$content_tags .= '</div>';

$content_tags .= '<textarea name="woo-settings[custom-code][options]" class="form-control" data-type="php">' . htmlentities($currentData['woo-settings']['custom-code']['options']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-info btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=wooSettings" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=wooSettings&amp;n=' . $_prefix . '" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card

$content_tags .= '</div>'; //col-md-12
$content_tags .= '</div>'; //row


$content_tags .= '</form>';
// TODO: LAYOUT --|-- WOOCOMMERCE SETTINGS
switch ($_GET["a"])
{
    case "list":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=wooSettings">' . __e("WooCommerce Settings") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("List") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags .= '<div class="card card-outline card-info">';
        $_content_tags .= '<div class="card-body">';

        $_content_tags .= '<div class="welcome">';
        $_content_tags .= '<h2>' . __e('WooCommerce') . '</h2>';
        $_content_tags .= '<h1>' . __e('Settings Tab') . '</h1>';
        $_content_tags .= '<p class="lead">' . __e('Adding a Section to a Settings Tab') . '</p>';
        $_content_tags .= '</div>';

        // TODO: LIST --|-- TABLE
        $_content_tags .= '<table data-type="datatable" class="table datatable table-bordered">';
        $_content_tags .= '<thead>';
        $_content_tags .= '<tr>';
        $_content_tags .= '<th>' . __e("Name") . '</th>';
        $_content_tags .= '<th>' . __e("Label") . '</th>';
        $_content_tags .= '<th>' . __e("Description") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Action") . '</th>';
        $_content_tags .= '</tr>';
        $_content_tags .= '</thead>';
        $_content_tags .= '<tbody>';
        $woo_settings = $db->getWooSettings();
        foreach ($woo_settings as $woo_setting)
        {
            $_content_tags .= '<tr>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $woo_setting['name'] . '</code></td>';
            $_content_tags .= '<td>' . $woo_setting['label'] . '</td>';
            $_content_tags .= '<td><em>' . $woo_setting['desc'] . '</em></td>';
            $_content_tags .= '<td class="text-center align-middle">';
            $_content_tags .= '<div class="btn-group btn-group-sm">';
            $_content_tags .= '<a href="#' . $woo_setting['name'] . '" data-toggle="modal" data-target="#modal-trash-woo-settings-' . $woo_setting['name'] . '" data-href="./?p=wooSettings&amp;a=trash&amp;n=' . $woo_setting['name'] . '" class="btn btn-danger"><i class="fa fa-trash"></i> ' . __e("Trash") . '</a>';
            $_content_tags .= '<a href="./?p=wooSettings&amp;a=edit&amp;n=' . $woo_setting['name'] . '" class="btn btn-success"><i class="fa fa-edit"></i> ' . __e("Edit") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</td>';
            $_content_tags .= '</tr>';
        }
        $_content_tags .= '</tbody>';
        $_content_tags .= '</table>';
        $_content_tags .= '</div>';
        $_content_tags .= '<div class="card-footer">';
        $_content_tags .= '<a href="./?p=wooSettings&amp;a=new" class="btn btn-success"><i class="fa fa-plus-circle"></i> ' . __e("Add New WooCommerce Settings") . '</a>';
        $_content_tags .= '</div>';
        $_content_tags .= '</div>';
        // TODO: LIST --|-- MODAL
        foreach ($woo_settings as $woo_setting)
        {
            $_content_tags .= '<div class="modal fade" id="modal-trash-woo-settings-' . $woo_setting['name'] . '">';
            $_content_tags .= '<div class="modal-dialog">';
            $_content_tags .= '<div class="modal-content bg-default">';
            $_content_tags .= '<div class="modal-header">';
            $_content_tags .= '<h4 class="modal-title">' . __e("Confirm") . '</h4>';
            $_content_tags .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            $_content_tags .= '<span aria-hidden="true">&times;</span></button>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-body">';
            $_content_tags .= '<p>' . __e("Are you sure You want to delete this Woo-settings?") . '</p>';
            $_content_tags .= '<table class="table-grid">';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td rowspan="4" style="text-align: center;"><i class="fas fa-cog trash-logo"></i></td>';
            $_content_tags .= '<td>' . __e("Name") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $woo_setting['name'] . '</code></td>';
            $_content_tags .= '</tr>';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Label") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td>' . $woo_setting['label'] . '</td>';
            $_content_tags .= '</tr>';

            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Description") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><em>' . $woo_setting['desc'] . '</em></td>';
            $_content_tags .= '</tr>';
            $_content_tags .= '</table>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-footer justify-content-between">';
            $_content_tags .= '<button type="button" class="btn btn-default" data-dismiss="modal">' . __e("Close") . '</button>';
            $_content_tags .= '<a href="./?p=wooSettings&amp;a=trash&amp;n=' . $woo_setting['name'] . '" class="btn btn-danger">' . __e("Yes, I am sure!") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
        }

        break;
    case "new":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=wooSettings">' . __e("WooCommerce Settings") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("New") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
    case "edit":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=wooSettings">' . __e("WooCommerce Settings") . '</a></li>';
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
foreach ($currentData['woo-settings']['fields'] as $field)
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

    $pagejs .= "\t\t\t\t\t" . '$("#woo-settings-options-select-" + item_target).html("");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#woo-settings-options-" + item_target).removeClass("hidden");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#woo-settings-default-" + item_target).removeClass("hidden");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#woo-settings-info-" + item_target).removeClass("hidden");' . "\r\n";

    $pagejs .= "\t\t\t\t\t" . '$("#woo-settings-options-" + item_target).prop("type","' . $__opt['options']['type'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#woo-settings-options-" + item_target).attr("placeholder","' . $__opt['options']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#woo-settings-options-help-" + item_target).html("' . $__opt['options']['help'] . '");' . "\r\n";

    $pagejs .= "\t\t\t\t\t" . '$("#woo-settings-default-" + item_target).prop("type","' . $__opt['default']['type'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#woo-settings-default-" + item_target).attr("placeholder","' . $__opt['default']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#woo-settings-default-help-" + item_target).html("' . $__opt['default']['help'] . '");' . "\r\n";


    $pagejs .= "\t\t\t\t\t" . '$("#woo-settings-info-" + item_target).attr("placeholder","' . $__opt['info']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#woo-settings-info-help-" + item_target).html("' . $__opt['info']['help'] . '");' . "\r\n";


    $pagejs .= $__opt['code']['js'];

    $pagejs .= "\t\t\t\t\t" . 'break;' . "\r\n";
}
$pagejs .= "\t\t\t" . '}' . "\r\n";
$pagejs .= "\t\t" . '}' . "\r\n";

$pagejs .= "\t\t" . '$(".woo-setting-type").on("click",function(){' . "\r\n";
$pagejs .= "\t\t\t" . 'PluginOption(this);' . "\r\n";
$pagejs .= "\t\t" . '});' . "\r\n";

$pagejs .= "\t\t" . 'var itemType = $(".woo-setting-type");' . "\r\n";
$pagejs .= "\t\t" . '$.each(itemType, function() {' . "\r\n";
$pagejs .= "\t\t\t" . 'PluginOption(this);' . "\r\n";
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
define('IHS_PAGE_NAME', __e("WooCommerce Settings"));
define('IHS_PAGE_DESC', __e("Adding a Section to a Settings Tab"));
define('IHS_PAGE_JS', $pagejs);

?>