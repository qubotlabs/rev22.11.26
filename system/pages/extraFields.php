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
    $postData['extra-fields']['name'] = ""; //text
    $postData['extra-fields']['fields'] = array(); //text
    $postData['extra-fields']['type_of_code'] = "extra-fields"; //select
    $postData['extra-fields']['overwrite_custom_code'] = true; //boolean
    $postData['extra-fields']['custom-code']['functions'] = ""; //text
    $postData['extra-fields']['custom-code']['construct'] = ""; //text

    // TODO: ACTION --|-- SUBMIT --|-- POST RESPONSE
    // text
    if (isset($_POST['extra-fields']['name']))
    {
        $postData['extra-fields']['name'] = $_POST['extra-fields']['name'];
    }
    if (isset($_GET['n']))
    {
        $postData['extra-fields']['name'] = $_GET['n'];
    }


    if (isset($_POST['extra-fields']['fields']))
    {
        $y = 0;
        foreach ($_POST['extra-fields']['fields'] as $fields)
        {
            if (trim($fields['name']) != '')
            {
                $postData['extra-fields']['fields'][$y]['type'] = $fields['type'];
                $postData['extra-fields']['fields'][$y]['name'] = $string->toFileName($fields['name']);
                $postData['extra-fields']['fields'][$y]['label'] = trim($fields['label']);
                $postData['extra-fields']['fields'][$y]['options'] = trim($fields['options']);
                $postData['extra-fields']['fields'][$y]['default'] = trim($fields['default']);
                $postData['extra-fields']['fields'][$y]['info'] = trim($fields['info']);
                $y++;
            }
        }
    }

    if (isset($_POST['extra-fields']['taxonomies']))
    {
        foreach ($_POST['extra-fields']['taxonomies'] as $taxonomies)
        {
            $postData['extra-fields']['taxonomies'][] = $taxonomies;
        }
    }


    // select
    if (isset($_POST['extra-fields']['type_of_code']))
    {
        $postData['extra-fields']['type_of_code'] = $_POST['extra-fields']['type_of_code'];
    }


    // boolean
    if (isset($_POST['extra-fields']['overwrite_custom_code']))
    {
        $postData['extra-fields']['overwrite_custom_code'] = true;
    } else
    {
        $postData['extra-fields']['overwrite_custom_code'] = false;
    }

    if (isset($_POST['extra-fields']['custom-code']['construct']))
    {
        $postData['extra-fields']['custom-code']['construct'] = $_POST['extra-fields']['custom-code']['construct'];
    }
    if (isset($_POST['extra-fields']['custom-code']['functions']))
    {
        $postData['extra-fields']['custom-code']['functions'] = $_POST['extra-fields']['custom-code']['functions'];
    }


    // TODO: ACTION --|-- SUBMIT --|-- SAVE DATA
    // validate and save postdata
    $db->saveExtraFields($postData['extra-fields']);
    $db->current();
    $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Extra-fields saved successfully!");
    if ($_GET["a"] == "edit")
    {
        header("Location: ./?p=extraFields&a=edit&alert=success&n=" . $_GET["n"] . "&" . time());
    } else
    {
        header("Location: ./?p=extraFields&a=list&alert=success&" . time());
    }
}


// TODO: ACTION --|-- REMOVE --|-- EXTRA-FIELDS
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "trash")
    {
        $_prefix = basename($_GET["n"]);
        $db->removeExtraField($_prefix);
        $db->current();
        $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Taxonomy deleted successfully!");
        header("Location: ./?p=extraFields&a=list&alert=warning&" . time());
    }
}


// TODO: LAYOUT --|-- GENERAL
$disabled = "";
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "edit")
    {
        $_prefix = basename($_GET["n"]);
        $currentData["extra-fields"] = $db->getExtraField($_prefix);
        $disabled = "disabled";
    }
}


// TODO: LAYOUT --|-- GENERAL --|-- INIT
//text
if (!isset($currentData['extra-fields']['name']))
{
    $currentData['extra-fields']['name'] = "";
}
if (!isset($currentData['extra-fields']['fields']))
{
    $currentData['extra-fields']['fields'] = array();
}
if (!isset($currentData['extra-fields']['taxonomies']))
{
    $currentData['extra-fields']['taxonomies'] = array();
}


//select
if (!isset($currentData['extra-fields']['type_of_code']))
{
    $currentData['extra-fields']['type_of_code'] = "extra-fields";
}

//boolean
if (!isset($currentData['extra-fields']['overwrite_custom_code']))
{
    $currentData['extra-fields']['overwrite_custom_code'] = true;
}

if (!isset($currentData['extra-fields']['custom-code']['construct']))
{
    $currentData['extra-fields']['custom-code']['construct'] = "";
}
if (!isset($currentData['extra-fields']['custom-code']['functions']))
{
    $currentData['extra-fields']['custom-code']['functions'] = "";
}

if ($currentData['extra-fields']['type_of_code'] == "extra-fields")
{
    $collapsed_extrafields = '';
    $collapsed_customcode = 'collapsed-card';
} else
{
    $collapsed_extrafields = 'collapsed-card';
    $collapsed_customcode = '';
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
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/extra-fields.php</code></p>';
$content_tags .= '<hr/>';


// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="name" class="col-sm-3 col-form-label">' . __e("Name") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input ' . $disabled . ' required type="text" name="extra-fields[name]"  class="form-control" id="field-name" placeholder="" value="' . $currentData['extra-fields']['name'] . '">';
$content_tags .= '<p class="help-block">' . __e("Write the name for the extra fields group") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

$content_tags .= '<hr/>';

$taxonomies[] = array('label' => 'WordPress Post Tag', 'value' => 'post_tag');
$taxonomies[] = array('label' => 'WordPress Category', 'value' => 'category');

$taxonomies[] = array('label' => 'WooCommerce Product Category', 'value' => 'product_cat');
$taxonomies[] = array('label' => 'WooCommerce Product Tag', 'value' => 'product_tag');


// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- TAXONOMIES
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="desc" class="col-sm-3 col-form-label">' . __e("Add to Taxonomies?") . '</label>';
$content_tags .= '<div class="col-sm-8">';

$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-7">';
//$content_tags .= '<p>' . __e("Core") . '</p>';
if (!isset($currentData['extra-fields']['taxonomies']))
{
    $currentData['extra-fields']['taxonomies'] = array();
}
foreach ($taxonomies as $taxonomy)
{
    $checked = '';
    foreach ($currentData['extra-fields']['taxonomies'] as $taxon)
    {
        if ($taxon == $taxonomy['value'])
        {
            $checked = 'checked="checked"';
        }
    }
    $content_tags .= '<div class="form-group clearfix">';
    $content_tags .= '<div class="icheck-primary d-inline">';
    $content_tags .= '<input ' . $checked . ' id="taxonomies-' . $taxonomy['value'] . '" type="checkbox" name="extra-fields[taxonomies][' . $taxonomy['value'] . ']" value="' . $taxonomy['value'] . '"/>';
    $content_tags .= '<label for="taxonomies-' . $taxonomy['value'] . '">' . $taxonomy['label'] . '</label>';
    $content_tags .= '</div>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>';


$content_tags .= '<div class="col-md-5">';
$content_tags .= '<p>' . __e("Custom Taxonomies") . '</p>';
$taxonomies = $db->getTaxonomies();
foreach ($taxonomies as $taxonomy)
{
    $checked = '';
    foreach ($currentData['extra-fields']['taxonomies'] as $taxon)
    {
        if ($taxon == $string->toVar($project['short-name'] . '_' . $taxonomy['name']))
        {
            $checked = 'checked="checked"';
        }
    }
    $content_tags .= '<div class="form-group clearfix">';
    $content_tags .= '<div class="icheck-danger d-inline">';
    $content_tags .= '<input ' . $checked . ' id="taxonomies-' . $taxonomy['name'] . '" type="checkbox" name="extra-fields[taxonomies][' . $taxonomy['name'] . ']" value="' . $string->toVar($project['short-name'] . '_' . $taxonomy['name']) . '"/>';
    $content_tags .= '<label for="taxonomies-' . $taxonomy['name'] . '">' . $taxonomy['label'] . '</label>';
    $content_tags .= '</div>';
    $content_tags .= '</div>';
}
$content_tags .= '<p><a class="btn btn-sm btn-outline-danger" href="./?p=taxonomies&a=new">' . __e("Add New Taxonomies") . '</a></p>';
$content_tags .= '</div>';

$content_tags .= '</div>';


$content_tags .= '</div>';
$content_tags .= '</div>';

$content_tags .= '<hr/>';
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- TYPE_OF_CODE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="type_of_code" class="col-sm-3 col-form-label">' . __e("Types of Generator") . '</label>';
$content_tags .= '<div class="col-sm-5">';
$content_tags .= '<select name="extra-fields[type_of_code]" class="form-control" id="field-type_of_code">';
$options = array();
$options[] = array("value" => "extra-fields", "label" => "Auto Code (Extra Fields)");
$options[] = array("value" => "custom-code", "label" => "Custom Code");
foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['extra-fields']['type_of_code'])
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
if ($currentData['extra-fields']['overwrite_custom_code'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="extra-fields[overwrite_custom_code]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="extra-fields[overwrite_custom_code]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
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
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=extraFields" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=extraFields" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
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


$example_code = null;
$example_code .= "" . '<?php' . "\r\n";


if (isset($currentData['extra-fields']))
{
    foreach ($currentData['extra-fields']['taxonomies'] as $tax)
    {
        $example_code .= "/** " . $tax . ' **/' . "\r\n";
        foreach ($currentData['extra-fields']['fields'] as $extrafield)
        {
            $example_code .= "" . '$term_meta_' . $string->toVar($extrafield['name']) . ' = get_term_meta($term_id, "' . $string->toFileName($tax . '-' . $extrafield['name']) . '", true );' . "\r\n";
        }
    }
}

$content_tags .= '<h3>' . __e("Retrieves metadata for a term") . '</h3>';
$content_tags .= '<div class="example-code">';
$content_tags .= highlight_string($example_code, true);
$content_tags .= '</div>';


$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<h5>' . __e("Code References") . ':</h5>';
$content_tags .= '<ul>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/get_terms/">get_terms</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/get_term_meta/">get_term_meta</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/hooks/taxonomy_edit_form_fields/">taxonomy_edit_form_fields</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/hooks/taxonomy_edit_form/">taxonomy_edit_form</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/hooks/taxonomy_add_form_fields/">taxonomy_add_form_fields</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/hooks/taxonomy_add_form/">taxonomy_add_form</a>' . '</p></li>';
$content_tags .= '</ul>';
$content_tags .= '</div>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=extraFields" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=extraFields" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card
$content_tags .= '</div>'; //col-md-6
$content_tags .= '</div>'; //row

$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-12">';
// TODO: LAYOUT --|-- EXTRA-FIELDS
$content_tags .= '<div class="card ' . $collapsed_extrafields . ' card-outline card-success">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-flag"></i>&nbsp;';
$content_tags .= __e("Extra Fields");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
if ($collapsed_extrafields == '')
{
    $content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
} else
{
    $content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>';
}

$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header

$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/extra-fields.php</code></p>';
$content_tags .= '<hr/>';

$module_path = IHS_MODULE_DIR . '/extra-fields/*.mod.php';
$__options = array();
foreach (glob($module_path) as $filename)
{
    $module = null;
    include ($filename);
    $__options[] = $module;
}

// TODO: LAYOUT --|-- EXTRA-FIELDS --|-- TABLE
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

// TODO: LAYOUT --|-- EXTRA-FIELDS --|-- TABLE --|-- FIELDS
$c = 0;
foreach ($currentData['extra-fields']['fields'] as $field)
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
    $select_option .= '<select name="extra-fields[fields][' . $c . '][type]" data-target="' . $c . '" class="form-control extra-fields-type" >';
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
    $content_tags .= '<td class="vcenter"><input name="extra-fields[fields][' . $c . '][name]" placeholder="field-' . $c . '" class="form-control" type="text" value="' . $field['name'] . '"/><p class="helper-block"><strong>format</strong>: a-z, A-Z,0-9, and -<br/>don\'t use the number in the 1st variable</p></td>';
    $content_tags .= '<td class="vcenter"><input name="extra-fields[fields][' . $c . '][label]" placeholder="Field ' . $c . '"  class="form-control" type="text" value="' . $field['label'] . '"/><p class="helper-block"><strong>format</strong>: text<br/>&nbsp;</p></td>';

    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="extra-field-options-' . $c . '" name="extra-fields[fields][' . $c . '][options]" class="form-control" type="text" value="' . $field['options'] . '"/>';
    $content_tags .= '<p class="helper-block"><span id="extra-field-options-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';

    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="extra-field-default-' . $c . '" name="extra-fields[fields][' . $c . '][default]" class="form-control" type="text" value="' . $field['default'] . '"/>';
    $content_tags .= '<p class="helper-block"><span id="extra-field-default-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';

    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="extra-field-info-' . $c . '" name="extra-fields[fields][' . $c . '][info]" class="form-control" type="text" value="' . $field['info'] . '"/>';
    $content_tags .= '<p class="helper-block"><span id="extra-field-info-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';

    $content_tags .= '<td class="text-center vcenter"><a class="btn btn-danger btn-sm remove-item" data-target="#field-no-' . $c . '" href="#!_"><i class="fa fa-trash"></i></a><p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
    $content_tags .= '</tr>';
    $c++;
}

// TODO: LAYOUT --|-- EXTRA-FIELDS --|-- TABLE --|-- ADD FIELDS

$c++;
$select_option = null;
$select_option .= '<select name="extra-fields[fields][' . $c . '][type]" data-target="' . $c . '"  class="form-control extra-fields-type" >';
foreach ($__options as $option)
{
    $select_option .= '<option value="' . $option['name'] . '">' . $option['label'] . '</option>';
}
$select_option .= '</select>';

$content_tags .= '<tr id="field-no-' . $c . '">';
$content_tags .= '<td class="text-center vcenter"><a href="#!_"><i class="fa fa-move"></i></a></td>';
$content_tags .= '<td class="text-center vcenter">' . $select_option . '<p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
$content_tags .= '<td class="text-center vcenter"><input name="extra-fields[fields][' . $c . '][name]" placeholder="field-' . $c . '" class="form-control" type="text" value=""/><p class="helper-block"><strong>format</strong>: a-z, A-Z,0-9, and -<br/>don\'t use the number in the 1st variable</p></td>';
$content_tags .= '<td class="text-center vcenter"><input name="extra-fields[fields][' . $c . '][label]" placeholder="Field ' . $c . '" class="form-control" type="text" value=""/><p class="helper-block"><strong>format</strong>: text<br/>&nbsp;</p></td>';

$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="extra-field-options-' . $c . '" name="extra-fields[fields][' . $c . '][options]" class="form-control" type="text" value=""/>';
$content_tags .= '<p class="helper-block"><span id="extra-field-options-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
$content_tags .= '</td>';

$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="extra-field-default-' . $c . '" name="extra-fields[fields][' . $c . '][default]" class="form-control" type="text" value=""/>';
$content_tags .= '<p class="helper-block"><span id="extra-field-default-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
$content_tags .= '</td>';

$content_tags .= '<td class="text-center vcenter"><input id="extra-field-info-' . $c . '" name="extra-fields[fields][' . $c . '][info]" class="form-control" type="text" value=""/>';
$content_tags .= '<p class="helper-block"><span id="extra-field-info-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
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
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=extraFields" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=extraFields" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


// TODO: LAYOUT --|-- CUSTOM-CODE
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

$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/extra-fields.php</code></p>';
$content_tags .= '<hr/>';

$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<p>' . __e("To use this feature you must change the General Settings: ") . '<strong>Types of Generator = <code>Custom Code</code></strong>' . __e(' and ') . '<strong>Copy To Custom Code = <code>OFF</code></strong></p>';
$content_tags .= '</div>';

$content_tags .= '<h3>';
$content_tags .= __e("__construct");
$content_tags .= '</h3>';
$content_tags .= '<textarea name="extra-fields[custom-code][construct]" class="form-control" data-type="php">' . htmlentities($currentData['extra-fields']['custom-code']['construct']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';


$content_tags .= '<h3>';
$content_tags .= __e("functions");
$content_tags .= '</h3>';
$content_tags .= '<textarea name="extra-fields[custom-code][functions]" class="form-control" data-type="php">' . htmlentities($currentData['extra-fields']['custom-code']['functions']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';


$content_tags .= '</div>'; //card-body
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-default btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=extraFields" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=extraFields" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


$content_tags .= '</div>'; //col-md-12
$content_tags .= '</div>'; //row


$content_tags .= '</form>';
// TODO: LAYOUT --|-- GENERAL
switch ($_GET["a"])
{
    case "list":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=extraFields">' . __e("Extra Fields") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("List") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags .= '<div class="card card-outline card-info">';
        $_content_tags .= '<div class="card-body">';

        $_content_tags .= '<div class="welcome">';
        $_content_tags .= '<h2>' . __e('Taxonomy') . '</h2>';
        $_content_tags .= '<h1>' . __e('Extra Fields') . '</h1>';
        $_content_tags .= '<p class="lead">' . __e('Adding Fields to the Category, Tag and Custom Taxonomy') . '</p>';
        $_content_tags .= '</div>';

        // TODO: LIST --|-- TABLE
        $_content_tags .= '<table data-type="datatable" class="table datatable table-bordered">';
        $_content_tags .= '<thead>';
        $_content_tags .= '<tr>';
        $_content_tags .= '<th>' . __e("Name") . '</th>';
        $_content_tags .= '<th style="width: 50% !important;">' . __e("Exta Fields") . '</th>';
        $_content_tags .= '<th>' . __e("Added to Taxonomies") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Action") . '</th>';
        $_content_tags .= '</tr>';
        $_content_tags .= '</thead>';
        $_content_tags .= '<tbody>';
        $extra_fields = $db->getExtraFields();
        foreach ($extra_fields as $extra_field)
        {
            $extra_field_taxonomies = '';
            $new_taxonomies = array();
            if (isset($extra_field['taxonomies']))
            {
                foreach ($extra_field['taxonomies'] as $taxo)
                {
                    $new_taxonomies[] = $taxo;
                }
                if (count($extra_field['taxonomies']) != 0)
                {
                    $extra_field_taxonomies = '<span class="badge badge-info">' . implode('</span> <span class="badge badge-info">', $new_taxonomies) . '</span>';
                }
            }

            $extra_field_fields = '';
            $new_fields = array();
            if (isset($extra_field['fields']))
            {
                foreach ($extra_field['fields'] as $field)
                {
                    $new_fields[] = $string->toVar($project['short-name'] . '_' . $field['name']);
                }
                if (count($extra_field['fields']) != 0)
                {
                    $extra_field_fields = '<span class="badge badge-success">' . implode('</span> <span class="badge badge-success">', $new_fields) . '</span>';
                }
            }


            $_content_tags .= '<tr>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $extra_field['name'] . '</code></td>';
            $_content_tags .= '<td>' . $extra_field_fields . '</td>';
            $_content_tags .= '<td>' . $extra_field_taxonomies . '</td>';

            $_content_tags .= '<td class="text-center align-middle">';
            $_content_tags .= '<div class="btn-group btn-group-sm">';
            $_content_tags .= '<a href="#' . $extra_field['name'] . '" data-toggle="modal" data-target="#modal-trash-extra-fields-' . $extra_field['name'] . '" data-href="./?p=extraFields&amp;a=trash&amp;n=' . $extra_field['name'] . '" class="btn btn-danger"><i class="fa fa-trash"></i> ' . __e("Trash") . '</a>';
            $_content_tags .= '<a href="./?p=extraFields&amp;a=edit&amp;n=' . $extra_field['name'] . '" class="btn btn-success"><i class="fa fa-edit"></i> ' . __e("Edit") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</td>';
            $_content_tags .= '</tr>';
        }
        $_content_tags .= '</tbody>';
        $_content_tags .= '</table>';
        $_content_tags .= '</div>';
        $_content_tags .= '<div class="card-footer">';
        $_content_tags .= '<a href="./?p=extraFields&amp;a=new" class="btn btn-success"><i class="fa fa-plus-circle"></i> ' . __e("Add New Extra Fields") . '</a>';
        $_content_tags .= '</div>';
        $_content_tags .= '</div>';
        // TODO: LIST --|-- MODAL
        foreach ($extra_fields as $extra_field)
        {

            $extra_field_taxonomies = '';
            $new_taxonomies = array();
            if (isset($extra_field['taxonomies']))
            {
                foreach ($extra_field['taxonomies'] as $taxo)
                {
                    $new_taxonomies[] = $taxo;
                }
                if (count($extra_field['taxonomies']) != 0)
                {
                    $extra_field_taxonomies = '<span class="badge badge-info">' . implode('</span> <span class="badge badge-info">', $new_taxonomies) . '</span>';
                }
            }

            $extra_field_fields = '';
            $new_fields = array();
            if (isset($extra_field['fields']))
            {
                foreach ($extra_field['fields'] as $field)
                {
                    $new_fields[] = $string->toVar($project['short-name'] . '_' . $field['name']);
                }
                if (count($extra_field['fields']) != 0)
                {
                    $extra_field_fields = '<span class="badge badge-success">' . implode('</span> <span class="badge badge-success">', $new_fields) . '</span>';
                }
            }


            $_content_tags .= '<div class="modal fade" id="modal-trash-extra-fields-' . $extra_field['name'] . '">';
            $_content_tags .= '<div class="modal-dialog">';
            $_content_tags .= '<div class="modal-content bg-default">';
            $_content_tags .= '<div class="modal-header">';
            $_content_tags .= '<h4 class="modal-title">' . __e("Confirm") . '</h4>';
            $_content_tags .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            $_content_tags .= '<span aria-hidden="true">&times;</span></button>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-body">';
            $_content_tags .= '<p>' . __e("Are you sure You want to delete this Extra-fields?") . '</p>';
            $_content_tags .= '<table class="table-grid">';

            $_content_tags .= '<tr>';
            $_content_tags .= '<td rowspan="4" style="text-align: center;"><i class="fa fa-tag trash-logo"></i></td>';
            $_content_tags .= '<td>' . __e("Name") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $extra_field['name'] . '</code></td>';
            $_content_tags .= '</tr>';

            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Fields") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td>' . $extra_field_fields . '</td>';
            $_content_tags .= '</tr>';

            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Added to Taxonomies") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td>' . $extra_field_taxonomies . '</td>';
            $_content_tags .= '</tr>';


            $_content_tags .= '</table>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-footer justify-content-between">';
            $_content_tags .= '<button type="button" class="btn btn-default" data-dismiss="modal">' . __e("Close") . '</button>';
            $_content_tags .= '<a href="./?p=extraFields&amp;a=trash&amp;n=' . $extra_field['name'] . '" class="btn btn-danger">' . __e("Yes, I am sure!") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
        }

        break;
    case "new":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=extraFields">' . __e("Extra Fields") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("New") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
    case "edit":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=extraFields">' . __e("Extra Fields") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("Edit") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
}

$pagejs = null;

$pagejs .= "\t\t" . '' . "\r\n";
$c = 0;
$pagejs .= "\t\t" . 'var extra_field_type = [];' . "\r\n";
$pagejs .= "\t\t" . 'var extra_field_name = [];' . "\r\n";
$pagejs .= "\t\t" . 'var extra_field_label = [];' . "\r\n";
$pagejs .= "\t\t" . 'var extra_field_options = [];' . "\r\n";

foreach ($currentData['extra-fields']['fields'] as $field)
{
    $pagejs .= "\t\t" . '// ' . $field["type"] . '' . "\r\n";
    $pagejs .= "\t\t" . 'extra_field_type[' . $c . '] = "' . $field["type"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'extra_field_name[' . $c . '] = "' . $field["name"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'extra_field_label[' . $c . '] = "' . $field["label"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . 'extra_field_options[' . $c . '] = "' . $field["options"] . '" ;' . "\r\n";
    $pagejs .= "\t\t" . '' . "\r\n";
    $c++;
}
$pagejs .= "\t\t" . '' . "\r\n";
$pagejs .= "\t\t" . 'function setField(target,value){' . "\r\n";
$pagejs .= "\t\t\t" . 'console.log(target,value);' . "\r\n";
$pagejs .= "\t\t\t" . '$(target).val(value);' . "\r\n";
$pagejs .= "\t\t" . '}' . "\r\n";
$pagejs .= "\t\t" . '' . "\r\n";
$pagejs .= "\t\t" . 'function extraFields(eve){' . "\r\n";
$pagejs .= "\t\t\t" . 'var item_type = $(eve).val();' . "\r\n";
$pagejs .= "\t\t\t" . 'var item_target = $(eve).attr("data-target");' . "\r\n";
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

    $pagejs .= "\t\t\t\t\t" . '$("#extra-field-options-select-" + item_target).html("");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#extra-field-options-" + item_target).removeClass("hidden");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#extra-field-default-" + item_target).removeClass("hidden");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#extra-field-info-" + item_target).removeClass("hidden");' . "\r\n";

    $pagejs .= "\t\t\t\t\t" . '$("#extra-field-options-" + item_target).prop("type","' . $__opt['default']['type'] . '");' . "\r\n";

    $pagejs .= "\t\t\t\t\t" . '$("#extra-field-options-" + item_target).attr("placeholder","' . $__opt['options']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#extra-field-options-help-" + item_target).html("' . $__opt['options']['help'] . '");' . "\r\n";

    $pagejs .= "\t\t\t\t\t" . '$("#extra-field-default-" + item_target).prop("type","' . $__opt['default']['type'] . '");' . "\r\n";

    $pagejs .= "\t\t\t\t\t" . '$("#extra-field-default-" + item_target).attr("placeholder","' . $__opt['default']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#extra-field-default-help-" + item_target).html("' . $__opt['default']['help'] . '");' . "\r\n";

    $pagejs .= "\t\t\t\t\t" . '$("#extra-field-info-" + item_target).attr("placeholder","' . $__opt['info']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#extra-field-help-" + item_target).html("' . $__opt['info']['help'] . '");' . "\r\n";

    //$pagejs .= "\t\t\t\t\t" . '$("#extra-field-options-" + item_target).val("' . $__opt['options']['value'] . '");' . "\r\n";
    //$pagejs .= "\t\t\t\t\t" . '$("#extra-field-default-" + item_target).val("' . $__opt['default']['value'] . '");' . "\r\n";
    //$pagejs .= "\t\t\t\t\t" . '$("#extra-field-info-" + item_target).val("' . $__opt['info']['value'] . '");' . "\r\n";


    $pagejs .= $__opt['code']['js'];
    $pagejs .= "\t\t\t\t\t" . 'break;' . "\r\n";
}
$pagejs .= "\t\t\t" . '}' . "\r\n";
$pagejs .= "\t\t" . '}' . "\r\n";
$pagejs .= "\t\t" . '' . "\r\n";
$pagejs .= "\t\t" . '' . "\r\n";

$pagejs .= "\t\t" . '$(".extra-fields-type").on("click",function(){' . "\r\n";
$pagejs .= "\t\t\t" . 'extraFields(this);' . "\r\n";
$pagejs .= "\t\t" . '});' . "\r\n";
$pagejs .= "\t\t" . '' . "\r\n";


$pagejs .= "\t\t" . 'var itemType = $(".extra-fields-type");' . "\r\n";
$pagejs .= "\t\t" . '$.each(itemType, function() {' . "\r\n";
$pagejs .= "\t\t\t" . 'extraFields(this);' . "\r\n";
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
define('IHS_PAGE_NAME', __e("Extra Fields"));
define('IHS_PAGE_DESC', __e("Adding Fields to the Taxonomies"));
define('IHS_PAGE_JS', $pagejs);

?>