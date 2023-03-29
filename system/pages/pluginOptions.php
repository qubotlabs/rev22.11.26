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
    $postData['plugin-options']['name'] = ""; //text
    $postData['plugin-options']['page_title'] = ""; //text
    $postData['plugin-options']['menu_title'] = ""; //text
    $postData['plugin-options']['section_title'] = "General Settings"; //text
    $postData['plugin-options']['section_information'] = "Enter your settings below:"; //text
    $postData['plugin-options']['fields'] = array();
    $postData['plugin-options']['type_of_code'] = "auto"; //select
    $postData['plugin-options']['overwrite_custom_code'] = true; //boolean
    $postData['plugin-options']['appears'] = "settings"; //select
    $postData['plugin-options']['custom-code']['settings-field'] = "";
    $postData['plugin-options']['custom-code']['sanitize'] = "";
    $postData['plugin-options']['custom-code']['admin-footer'] = "";
    $postData['plugin-options']['custom-code']['admin-enqueue-scripts'] = "";
    $postData['plugin-options']['custom-code']['callback'] = "";

    // edit
    if (isset($_GET["n"]))
    {
        $_POST["plugin-options"]["name"] = $_GET["n"];
    }

    // TODO: ACTION --|-- SUBMIT --|-- POST RESPONSE
    // text
    if (isset($_POST['plugin-options']['name']))
    {
        $postData['plugin-options']['name'] = $_POST['plugin-options']['name'];
    }
    // text
    if (isset($_POST['plugin-options']['page_title']))
    {
        $postData['plugin-options']['page_title'] = $_POST['plugin-options']['page_title'];
    }
    // text
    if (isset($_POST['plugin-options']['menu_title']))
    {
        $postData['plugin-options']['menu_title'] = $_POST['plugin-options']['menu_title'];
    }

    // text
    if (isset($_POST['plugin-options']['sub_menu']))
    {
        $postData['plugin-options']['sub_menu'] = $_POST['plugin-options']['sub_menu'];
    }

    // text
    if (isset($_POST['plugin-options']['sub_menu_option']))
    {
        $postData['plugin-options']['sub_menu_option'] = $_POST['plugin-options']['sub_menu_option'];
    }

    // text
    if (isset($_POST['plugin-options']['section_title']))
    {
        $postData['plugin-options']['section_title'] = $_POST['plugin-options']['section_title'];
    }

    // text
    if (isset($_POST['plugin-options']['section_information']))
    {
        $postData['plugin-options']['section_information'] = $_POST['plugin-options']['section_information'];
    }


    if (isset($_POST['plugin-options']['fields']))
    {
        $y = 0;
        foreach ($_POST['plugin-options']['fields'] as $fields)
        {
            if (trim($fields['name']) != '')
            {
                $postData['plugin-options']['fields'][$y]['type'] = $fields['type'];
                $postData['plugin-options']['fields'][$y]['name'] = $string->toFileName($fields['name']);
                $postData['plugin-options']['fields'][$y]['label'] = trim($fields['label']);
                $postData['plugin-options']['fields'][$y]['options'] = trim($fields['options']);
                $postData['plugin-options']['fields'][$y]['default'] = trim($fields['default']);
                $postData['plugin-options']['fields'][$y]['info'] = trim($fields['info']);
                $y++;
            }
        }
    }

    // select
    if (isset($_POST['plugin-options']['appears']))
    {
        $postData['plugin-options']['appears'] = $_POST['plugin-options']['appears'];
    }

    // select
    if (isset($_POST['plugin-options']['type_of_code']))
    {
        $postData['plugin-options']['type_of_code'] = $_POST['plugin-options']['type_of_code'];
    }


    // boolean
    if (isset($_POST['plugin-options']['overwrite_custom_code']))
    {
        $postData['plugin-options']['overwrite_custom_code'] = true;
    } else
    {
        $postData['plugin-options']['overwrite_custom_code'] = false;
    }

    // boolean
    if (isset($_POST['plugin-options']['enable-rest-api']))
    {
        $postData['plugin-options']['enable_rest_api'] = true;
    } else
    {
        $postData['plugin-options']['enable_rest_api'] = false;
    }


    if (isset($_POST['plugin-options']['custom-code']['settings-field']))
    {
        $postData['plugin-options']['custom-code']['settings-field'] = $_POST['plugin-options']['custom-code']['settings-field'];
    }
    if (isset($_POST['plugin-options']['custom-code']['sanitize']))
    {
        $postData['plugin-options']['custom-code']['sanitize'] = $_POST['plugin-options']['custom-code']['sanitize'];
    }
    if (isset($_POST['plugin-options']['custom-code']['admin-footer']))
    {
        $postData['plugin-options']['custom-code']['admin-footer'] = $_POST['plugin-options']['custom-code']['admin-footer'];
    }

    if (isset($_POST['plugin-options']['custom-code']['callback']))
    {
        $postData['plugin-options']['custom-code']['callback'] = $_POST['plugin-options']['custom-code']['callback'];
    }

    if (isset($_POST['plugin-options']['custom-code']['admin-enqueue-scripts']))
    {
        $postData['plugin-options']['custom-code']['admin-enqueue-scripts'] = $_POST['plugin-options']['custom-code']['admin-enqueue-scripts'];
    }


    // TODO: ACTION --|-- SUBMIT --|-- SAVE DATA

    // validate and save postdata
    $db->savePluginOption($postData['plugin-options']);

    $db->current();
    $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Plugin-options saved successfully!");
    if ($_GET["a"] == "edit")
    {
        header("Location: ./?p=pluginOptions&a=edit&alert=success&n=" . $_GET["n"] . "&" . time());
    } else
    {
        header("Location: ./?p=pluginOptions&a=list&alert=success&" . time());
    }
}


// TODO: ACTION --|-- REMOVE --|-- PLUGIN-OPTIONS
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "trash")
    {
        $_prefix = basename($_GET["n"]);
        $db->removePluginOption($_prefix);
        $db->current();
        $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Plugin-option deleted successfully!");
        header("Location: ./?p=pluginOptions&a=list&alert=warning&" . time());
    }
}


// TODO: LAYOUT --|-- GENERAL
$disabled = "";
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "edit")
    {
        $_prefix = basename($_GET["n"]);
        $currentData["plugin-options"] = $db->getPluginOption($_prefix);
        $disabled = "disabled";
    }
}


// TODO: LAYOUT --|-- GENERAL --|-- INIT
//text
if (!isset($currentData['plugin-options']['name']))
{
    $currentData['plugin-options']['name'] = "";
}
//text
if (!isset($currentData['plugin-options']['page_title']))
{
    $currentData['plugin-options']['page_title'] = "";
}
//text
if (!isset($currentData['plugin-options']['menu_title']))
{
    $currentData['plugin-options']['menu_title'] = "";
}


//text
if (!isset($currentData['plugin-options']['section_title']))
{
    $currentData['plugin-options']['section_title'] = "General Settings";
}
//text
if (!isset($currentData['plugin-options']['section_information']))
{
    $currentData['plugin-options']['section_information'] = "Enter your settings below:";
}


if (!isset($currentData['plugin-options']['fields']))
{
    $currentData['plugin-options']['fields'] = array();
}

//select
if (!isset($currentData['plugin-options']['appears']))
{
    $currentData['plugin-options']['appears'] = "settings";
}

if (!isset($currentData['plugin-options']['sub_menu']))
{
    $currentData['plugin-options']['sub_menu'] = "";
}
if (!isset($currentData['plugin-options']['sub_menu_option']))
{
    $currentData['plugin-options']['sub_menu_option'] = "";
}


//select
if (!isset($currentData['plugin-options']['type_of_code']))
{
    $currentData['plugin-options']['type_of_code'] = "plugin-options";
}

//boolean
if (!isset($currentData['plugin-options']['overwrite_custom_code']))
{
    $currentData['plugin-options']['overwrite_custom_code'] = true;
}

//boolean
if (!isset($currentData['plugin-options']['enable_rest_api']))
{
    $currentData['plugin-options']['enable_rest_api'] = false;
}


//text
if (!isset($currentData['plugin-options']['custom-code']['settings-field']))
{
    $currentData['plugin-options']['custom-code']['settings-field'] = "";
}

//text
if (!isset($currentData['plugin-options']['custom-code']['sanitize']))
{
    $currentData['plugin-options']['custom-code']['sanitize'] = "";
}

//text
if (!isset($currentData['plugin-options']['custom-code']['callback']))
{
    $currentData['plugin-options']['custom-code']['callback'] = "";
}

//text
if (!isset($currentData['plugin-options']['custom-code']['admin-footer']))
{
    $currentData['plugin-options']['custom-code']['admin-footer'] = "";
}

//text
if (!isset($currentData['plugin-options']['custom-code']['admin-enqueue-scripts']))
{
    $currentData['plugin-options']['custom-code']['admin-enqueue-scripts'] = "";
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
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/plugin-options.php</code></p>';
$content_tags .= '<hr/>';

// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="name" class="col-sm-3 col-form-label">' . __e("Name") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input ' . $disabled . ' required type="text" name="plugin-options[name]"  class="form-control" id="field-name" placeholder="my-plugin-option" value="' . $currentData['plugin-options']['name'] . '">';
$content_tags .= '<p class="help-block">' . __e("Only contain a-z, 0-9, and - characters") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- PAGE_TITLE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="page_title" class="col-sm-3 col-form-label">' . __e("Page Title") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input required type="text" name="plugin-options[page_title]"  class="form-control" id="field-page_title" placeholder="My Plugin Option" value="' . $currentData['plugin-options']['page_title'] . '">';
$content_tags .= '<p class="help-block">' . __e("The text to be displayed in the title tags of the page when the menu is selected") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

$content_tags .= '<hr/>';

// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- MENU_TITLE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="menu_title" class="col-sm-3 col-form-label">' . __e("Menu Title") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input required type="text" name="plugin-options[menu_title]"  class="form-control" id="field-menu_title" placeholder="My Plugin Option" value="' . $currentData['plugin-options']['menu_title'] . '">';
$content_tags .= '<p class="help-block">' . __e("The text to be used for the menu") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

$content_tags .= '<hr/>';

// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- APPEARS
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="appears" class="col-sm-3 col-form-label">' . __e("Appears on") . '</label>';
$content_tags .= '<div class="col-sm-5">';
$content_tags .= '<select name="plugin-options[appears]" class="form-control" id="field-appears">';
$options = array();
$options[] = array("value" => "settings", "label" => "The Settings Menu");
$options[] = array("value" => "top-level", "label" => "The Top Level Menu");
$options[] = array("value" => "sub-menu", "label" => "Sub Menu");

foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['plugin-options']['appears'])
    {
        $selected = "selected";
    }
    $content_tags .= '<option ' . $selected . ' value="' . $opt["value"] . '">' . $opt["label"] . '</option>';
}
$content_tags .= '</select>';
$content_tags .= '<p class="help-block">' . __e("The menu is displayed on the bar? ") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


// select
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- SUB_MENU_OPTION
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="sub_menu" class="col-sm-3 col-form-label">' . __e("Sub Menu?") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-6">';

$content_tags .= '<select name="plugin-options[sub_menu]" class="form-control" id="field-sub_menu_option">';
$options = array();
$options[] = array("value" => "index.php", "label" => "Dashboard");
$options[] = array("value" => "edit.php", "label" => "Posts");
$options[] = array("value" => "upload.php", "label" => "Media");
$options[] = array("value" => "edit.php?post_type=page", "label" => "Pages");
$options[] = array("value" => "edit-comments.php", "label" => "Comments");
$options[] = array("value" => "plugins.php", "label" => "Plugins");
$options[] = array("value" => "users.php", "label" => "Users");
$options[] = array("value" => "tools.php", "label" => "Tools");
$options[] = array("value" => "options-general.php", "label" => "Settings");
$options[] = array("value" => "settings.php", "label" => "Network Settings");

$post_types = $db->getCustomPosts();
foreach ($post_types as $post_type)
{
    $custom_post = $string->toVar($project['short-name'] . '_' . $post_type['name']);
    $options[] = array("value" => "edit.php?post_type=" . $custom_post, "label" => "Custom Post: " . $post_type['label']);
}

foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['plugin-options']['sub_menu'])
    {
        $selected = "selected";
    }
    $content_tags .= '<option ' . $selected . ' value="' . $opt["value"] . '">' . $opt["label"] . '</option>';
}
$content_tags .= '</select>';


$content_tags .= '</div>';
$content_tags .= '<div class="col-md-6">';
$content_tags .= '<input  type="text" name="plugin-options[sub_menu]"  class="form-control" id="field-sub_menu" placeholder="edit.php?post_type=your_post_type" value="' . $currentData['plugin-options']['sub_menu'] . '">';
$content_tags .= '<p class="help-block">' . __e("The slug name for the parent menu, keep it <strong>blank</strong> for the <strong>top level menu</strong>") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

$content_tags .= '</div>';
$content_tags .= '</div>';


$content_tags .= '<hr/>';

// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- SECTION_TITLE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="section_title" class="col-sm-3 col-form-label">' . __e("Section Title") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input required type="text" name="plugin-options[section_title]"  class="form-control" id="field-section_title" placeholder="General" value="' . $currentData['plugin-options']['section_title'] . '">';
$content_tags .= '<p class="help-block">' . __e("Shown as the heading for the section") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- SECTION_INFORMATION
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="section_information" class="col-sm-3 col-form-label">' . __e("Section Information") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<input required type="text" name="plugin-options[section_information]"  class="form-control" id="field-section_information" placeholder="Enter your settings below:" value="' . $currentData['plugin-options']['section_information'] . '">';
$content_tags .= '<p class="help-block">' . __e("Just additional information!") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

$content_tags .= '<hr/>';

// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- TYPE_OF_CODE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="type_of_code" class="col-sm-3 col-form-label">' . __e("Types of Generator") . '</label>';
$content_tags .= '<div class="col-sm-5">';
$content_tags .= '<select name="plugin-options[type_of_code]" class="form-control" id="field-type_of_code">';
$options = array();
$options[] = array("value" => "auto", "label" => "Auto Code");
$options[] = array("value" => "custom-code", "label" => "Custom Code");
foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['plugin-options']['type_of_code'])
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
if ($currentData['plugin-options']['overwrite_custom_code'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="plugin-options[overwrite_custom_code]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="plugin-options[overwrite_custom_code]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
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
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=pluginOptions" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=pluginOptions" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card

$content_tags .= '</div>'; //col-md-6


$content_tags .= '<div class="col-md-6">';

$content_tags .= '<div class="card card-outline card-success">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-question-circle"></i>&nbsp;';
$content_tags .= __e("Others");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|--
$content_tags .= '<div class="card-body">';


// boolean
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- REST-API
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="enable-rest-api" class="col-sm-3 col-form-label">' . __e("Enable REST-API") . '</label>';
$content_tags .= '<div class="col-sm-9">';
if ($currentData['plugin-options']['enable_rest_api'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="plugin-options[enable-rest-api]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="plugin-options[enable-rest-api]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("Expose plugin options to public via REST-API") . '</p>';




$content_tags .= '</div>';
$content_tags .= '</div>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-success btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=pluginOptions" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=pluginOptions" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


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

$content_tags .= '<h3>' . __e("Retrieving data from the Option Values") . ':</h3>';
$example_code = null;
$example_code .= "" . '<?php' . "\r\n";
if (count($currentData['plugin-options']['fields']) != 0)
{
    $name = $string->toVar($project['short-name'] . '_' . $currentData['plugin-options']['name'] . '_setting');
    $example_code .= '$options = get_option("' . $name . '");' . "\r\n";

    foreach ($currentData['plugin-options']['fields'] as $field)
    {
        $varName = $string->toVar($project['short-name'] . '_' . $field['name']);
        $example_code .= '//' . $field['name'] . "\r\n";
        $example_code .= 'echo $options["' . $varName . '"];' . "\r\n";
    }
} else
{
    $example_code .= '$options = get_option("setting_name");' . "\r\n";
}
$content_tags .= '<div class="example-code">';
$content_tags .= highlight_string($example_code, true);
$content_tags .= '</div>';
$content_tags .= '<hr>';
$content_tags .= '<h3>' . __e("Retrieving data from the REST API") . ':</h3>';
if ($currentData['plugin-options']['enable_rest_api'] == true)
{
    $url_api = '/wp-json/'.$string->toVar($project['project-name']).'/v2/'.$string->toVar($currentData['plugin-options']['name']).'/';
    $content_tags .= '<h5>' . __e("End Point") . '</h5>';
    $content_tags .= '<code><a target="_blank" href="./wp-test/'.$url_api.'">'.$url_api.'</a></code>';
}

$content_tags .= '<hr>';

$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<h5>' . __e("Code References") . ':</h5>';
$content_tags .= '<ul>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/get_option/">get_option</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/add_options_page/">add_options_page</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/register_setting/">register_setting</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/add_settings_section/">add_settings_section</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/add_settings_field/">add_settings_field</a>' . '</p></li>';
$content_tags .= '</ul>';
$content_tags .= '</div>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=pluginOptions" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=pluginOptions" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
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
$content_tags .= __e("Field Options");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- OPTIONS
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/plugin-options.php</code></p>';
$content_tags .= '<hr/>';


$module_path = IHS_MODULE_DIR . '/plugin-options/*.mod.php';
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
foreach ($currentData['plugin-options']['fields'] as $field)
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
    $select_option .= '<select name="plugin-options[fields][' . $c . '][type]" data-target="' . $c . '" class="form-control plugin-option-type" >';
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
    $content_tags .= '<td class="vcenter"><input name="plugin-options[fields][' . $c . '][name]" placeholder="field-' . $c . '" class="form-control" type="text" value="' . $field['name'] . '"/><p class="helper-block"><strong>format</strong>: a-z, A-Z,0-9, and -<br/>don\'t use the number in the 1st variable</p></td>';
    $content_tags .= '<td class="vcenter"><input name="plugin-options[fields][' . $c . '][label]" placeholder="Field ' . $c . '"  class="form-control" type="text" value="' . $field['label'] . '"/><p class="helper-block"><strong>format</strong>: text<br/>&nbsp;</p></td>';

    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="plugin-options-options-' . $c . '" name="plugin-options[fields][' . $c . '][options]" class="form-control" type="text" value="' . $field['options'] . '"/><span id="plugin-options-options-select-' . $c . '"></span>';
    $content_tags .= '<p class="helper-block"><span id="plugin-options-options-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';

    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="plugin-options-default-' . $c . '" name="plugin-options[fields][' . $c . '][default]" class="form-control" type="text" value="' . $field['default'] . '"/>';
    $content_tags .= '<p class="helper-block"><span id="plugin-options-default-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';

    $content_tags .= '<td class="vcenter">';
    $content_tags .= '<input id="plugin-options-info-' . $c . '" name="plugin-options[fields][' . $c . '][info]" class="form-control" type="text" value="' . $field['info'] . '"/>';
    $content_tags .= '<p class="helper-block"><span id="plugin-options-info-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
    $content_tags .= '</td>';


    $content_tags .= '<td class="text-center vcenter"><a class="btn btn-danger btn-sm remove-item" data-target="#field-no-' . $c . '" href="#!_"><i class="fa fa-trash"></i></a><p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
    $content_tags .= '</tr>';
    $c++;
}

// TODO: LAYOUT --|-- OPTIONS --|-- TABLE --|-- ADD FIELDS

$c++;
$select_option = null;
$select_option .= '<select class="form-control plugin-option-type" name="plugin-options[fields][' . $c . '][type]" data-target="' . $c . '"   >';
foreach ($__options as $option)
{
    $select_option .= '<option value="' . $option['name'] . '">' . $option['label'] . '</option>';
}
$select_option .= '</select>';

$content_tags .= '<tr id="field-no-' . $c . '">';
$content_tags .= '<td class="text-center vcenter"><a href="#!_"><i class="fa fa-move"></i></a></td>';
$content_tags .= '<td class="text-center vcenter">' . $select_option . '<p class="helper-block">&nbsp;<br/>&nbsp;</p></td>';
$content_tags .= '<td class="text-center vcenter"><input name="plugin-options[fields][' . $c . '][name]" placeholder="field-' . $c . '" class="form-control" type="text" value=""/><p class="helper-block"><strong>format</strong>: a-z, A-Z,0-9, and -<br/>don\'t use the number in the 1st variable</p></td>';
$content_tags .= '<td class="text-center vcenter"><input name="plugin-options[fields][' . $c . '][label]" placeholder="Field ' . $c . '" class="form-control" type="text" value=""/><p class="helper-block"><strong>format</strong>: text<br/>&nbsp;</p></td>';

$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="plugin-options-options-' . $c . '" name="plugin-options[fields][' . $c . '][options]" class="form-control" type="text" value=""/>';
$content_tags .= '<span id="plugin-options-options-select-' . $c . '"></span>';
$content_tags .= '<p class="helper-block"><span id="plugin-options-options-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
$content_tags .= '</td>';

$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="plugin-options-default-' . $c . '" name="plugin-options[fields][' . $c . '][default]" class="form-control" type="text" value=""/>';
$content_tags .= '<p class="helper-block"><span id="plugin-options-default-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
$content_tags .= '</td>';

$content_tags .= '<td class="text-center vcenter">';
$content_tags .= '<input id="plugin-options-info-' . $c . '" name="plugin-options[fields][' . $c . '][info]" class="form-control" type="text" value=""/>';
$content_tags .= '<p class="helper-block"><span id="plugin-options-info-help-' . $c . '"><strong>format</strong>: text</span><br/>&nbsp;</p>';
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
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=pluginOptions" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=pluginOptions" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
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
$content_tags .= '<div class="card card-outline card-danger">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fab fa-php"></i>&nbsp;';
$content_tags .= __e("Custom Codes");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- OPTIONS
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/plugin-options.php</code></p>';
$content_tags .= '<hr/>';

$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<p>' . __e("To use this feature you must change the General Settings: ") . '<strong>Types of Generator = <code>Custom Code</code></strong>' . __e(' and ') . '<strong>Copy To Custom Code = <code>OFF</code></strong></p>';
$content_tags .= '</div>';

$content_tags .= '<h3>';
$content_tags .= __e("Setting Field");
$content_tags .= '</h3>';
$content_tags .= '<textarea name="plugin-options[custom-code][settings-field]" class="form-control" data-type="php">' . htmlentities($currentData['plugin-options']['custom-code']['settings-field']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';


$content_tags .= '<h3>';
$content_tags .= __e("Sanitize Option");
$content_tags .= '</h3>';
$content_tags .= '<textarea name="plugin-options[custom-code][sanitize]" class="form-control" data-type="php">' . htmlentities($currentData['plugin-options']['custom-code']['sanitize']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';

$content_tags .= '<h3>';
$content_tags .= __e("Callback");
$content_tags .= '</h3>';
$content_tags .= '<textarea name="plugin-options[custom-code][callback]" class="form-control" data-type="php">' . htmlentities($currentData['plugin-options']['custom-code']['callback']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';

$content_tags .= '<h3>';
$content_tags .= __e("Admin Footer");
$content_tags .= '</h3>';
$content_tags .= '<textarea name="plugin-options[custom-code][admin-footer]" class="form-control" data-type="php">' . htmlentities($currentData['plugin-options']['custom-code']['admin-footer']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';


$content_tags .= '<h3>';
$content_tags .= __e("Admin Enqueue Scripts");
$content_tags .= '</h3>';
$content_tags .= '<textarea name="plugin-options[custom-code][admin-enqueue-scripts]" class="form-control" data-type="php">' . htmlentities($currentData['plugin-options']['custom-code']['admin-enqueue-scripts']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';


$content_tags .= '</div>'; //card-body
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=pluginOptions" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=pluginOptions" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card
$content_tags .= '</div>'; //col-md-12
$content_tags .= '</div>'; //row


$content_tags .= '</form>';

$icon = new ShowIcon();
$content_tags .= $icon->Display('dashicons', 'Dashicons');
// TODO: LAYOUT --|-- GENERAL
switch ($_GET["a"])
{
    case "list":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=pluginOptions">' . __e("Plugin Options") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("List") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags .= '<div class="card card-outline card-info">';
        $_content_tags .= '<div class="card-body">';

        $_content_tags .= '<div class="welcome">';
        $_content_tags .= '<h2>' . __e('Settings') . '</h2>';
        $_content_tags .= '<h1>' . __e('Plugin Options') . '</h1>';
        $_content_tags .= '<p class="lead">' . __e('Generate code for your plugin options') . '</p>';
        $_content_tags .= '</div>';

        // TODO: LIST --|-- TABLE
        $_content_tags .= '<table data-type="datatable" class="table datatable table-bordered">';
        $_content_tags .= '<thead>';
        $_content_tags .= '<tr>';
        $_content_tags .= '<th>' . __e("Name") . '</th>';
        $_content_tags .= '<th class="text-left">' . __e("Page Title") . '</th>';
        $_content_tags .= '<th class="text-left">' . __e("Section") . '</th>';
        $_content_tags .= '<th class="text-left">' . __e("Fields") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Action") . '</th>';
        $_content_tags .= '</tr>';
        $_content_tags .= '</thead>';
        $_content_tags .= '<tbody>';
        $plugin_options = $db->getPluginOptions();
        foreach ($plugin_options as $plugin_option)
        {
            $option_fields = '';
            $new_fields = array();
            if (isset($plugin_option['fields']))
            {
                foreach ($plugin_option['fields'] as $field)
                {
                    $new_fields[] = $string->toVar($project['short-name'] . '_' . $field['name']);
                }
                if (count($plugin_option['fields']) != 0)
                {
                    $option_fields = '<span class="badge badge-success">' . implode('</span> <span class="badge badge-success">', $new_fields) . '</span>';
                }
            }

            $_content_tags .= '<tr>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name'] . '_' . $plugin_option['name']) . '</code></td>';
            $_content_tags .= '<td><strong>' . ($plugin_option['page_title']) . '</strong></td>';
            $_content_tags .= '<td><small>' . ($plugin_option['section_title']) . '</small></td>';
            $_content_tags .= '<td>' . $option_fields . '</td>';

            $_content_tags .= '<td class="text-center align-middle">';
            $_content_tags .= '<div class="btn-group btn-group-sm">';
            $_content_tags .= '<a href="#' . $plugin_option['name'] . '" data-toggle="modal" data-target="#modal-trash-plugin-options-' . $plugin_option['name'] . '" data-href="./?p=pluginOptions&amp;a=trash&amp;n=' . $plugin_option['name'] . '" class="btn btn-danger"><i class="fa fa-trash"></i> ' . __e("Trash") . '</a>';
            $_content_tags .= '<a href="./?p=pluginOptions&amp;a=edit&amp;n=' . $plugin_option['name'] . '" class="btn btn-success"><i class="fa fa-edit"></i> ' . __e("Edit") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</td>';
            $_content_tags .= '</tr>';
        }
        $_content_tags .= '</tbody>';
        $_content_tags .= '</table>';
        $_content_tags .= '</div>';
        $_content_tags .= '<div class="card-footer">';
        $_content_tags .= '<a href="./?p=pluginOptions&amp;a=new" class="btn btn-success"><i class="fa fa-plus-circle"></i> ' . __e("Add New Plugin Options") . '</a>';
        $_content_tags .= '</div>';
        $_content_tags .= '</div>';
        // TODO: LIST --|-- MODAL
        foreach ($plugin_options as $plugin_option)
        {
            $_content_tags .= '<div class="modal fade" id="modal-trash-plugin-options-' . $plugin_option['name'] . '">';
            $_content_tags .= '<div class="modal-dialog">';
            $_content_tags .= '<div class="modal-content bg-default">';
            $_content_tags .= '<div class="modal-header">';
            $_content_tags .= '<h4 class="modal-title">' . __e("Confirm") . '</h4>';
            $_content_tags .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            $_content_tags .= '<span aria-hidden="true">&times;</span></button>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-body">';
            $_content_tags .= '<p>' . __e("Are you sure You want to delete this plugin options?") . '</p>';
            $_content_tags .= '<table class="table-grid">';

            $_content_tags .= '<tr>';
            $_content_tags .= '<td rowspan="4" style="text-align: center;"><i class="fas fa-cog trash-logo"></i></td>';
            $_content_tags .= '<td>' . __e("Name") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $plugin_option['name'] . '</code></td>';
            $_content_tags .= '</tr>';

            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Page Title") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td>' . $plugin_option['page_title'] . '</td>';
            $_content_tags .= '</tr>';


            $_content_tags .= '</table>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-footer justify-content-between">';
            $_content_tags .= '<button type="button" class="btn btn-default" data-dismiss="modal">' . __e("Close") . '</button>';
            $_content_tags .= '<a href="./?p=pluginOptions&amp;a=trash&amp;n=' . $plugin_option['name'] . '" class="btn btn-danger">' . __e("Yes, I am sure!") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
        }

        break;
    case "new":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=pluginOptions">' . __e("Plugin Options") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("New") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
    case "edit":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=pluginOptions">' . __e("Plugin Options") . '</a></li>';
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
foreach ($currentData['plugin-options']['fields'] as $field)
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

    $pagejs .= "\t\t\t\t\t" . '$("#plugin-options-options-select-" + item_target).html("");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#plugin-options-options-" + item_target).removeClass("hidden");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#plugin-options-default-" + item_target).removeClass("hidden");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#plugin-options-info-" + item_target).removeClass("hidden");' . "\r\n";

    $pagejs .= "\t\t\t\t\t" . '$("#plugin-options-options-" + item_target).prop("type","' . $__opt['options']['type'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#plugin-options-options-" + item_target).attr("placeholder","' . $__opt['options']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#plugin-options-options-help-" + item_target).html("' . $__opt['options']['help'] . '");' . "\r\n";

    $pagejs .= "\t\t\t\t\t" . '$("#plugin-options-default-" + item_target).prop("type","' . $__opt['default']['type'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#plugin-options-default-" + item_target).attr("placeholder","' . $__opt['default']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#plugin-options-default-help-" + item_target).html("' . $__opt['default']['help'] . '");' . "\r\n";


    $pagejs .= "\t\t\t\t\t" . '$("#plugin-options-info-" + item_target).attr("placeholder","' . $__opt['info']['placeholder'] . '");' . "\r\n";
    $pagejs .= "\t\t\t\t\t" . '$("#plugin-options-info-help-" + item_target).html("' . $__opt['info']['help'] . '");' . "\r\n";


    $pagejs .= $__opt['code']['js'];

    $pagejs .= "\t\t\t\t\t" . 'break;' . "\r\n";
}
$pagejs .= "\t\t\t" . '}' . "\r\n";
$pagejs .= "\t\t" . '}' . "\r\n";

$pagejs .= "\t\t" . '$(".plugin-option-type").on("click",function(){' . "\r\n";
$pagejs .= "\t\t\t" . 'PluginOption(this);' . "\r\n";
$pagejs .= "\t\t" . '});' . "\r\n";

$pagejs .= "\t\t" . 'var itemType = $(".plugin-option-type");' . "\r\n";
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


$pagejs .= "" . '$(document).ready(function(){' . "\r\n";
$pagejs .= "\t" . '$("#field-sub_menu_option").on("click",function(){' . "\r\n";
$pagejs .= "\t\t" . '$("#field-sub_menu").val($(this).val());' . "\r\n";
$pagejs .= "\t" . '});' . "\r\n";
$pagejs .= "" . '});' . "\r\n";

define('IHS_LAYOUT_CONTENT', $_content_tags);
define('IHS_LAYOUT_BREADCRUMB', $breadcrumb_tags);
define('IHS_PAGE_NAME', __e("Plugin Options"));
define('IHS_PAGE_DESC', __e("Generate code for your plugin options"));
define('IHS_PAGE_JS', $pagejs);

?>