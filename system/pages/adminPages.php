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
$_prefix = '';

// TODO: ACTION --|-- SUBMIT --|--

if (isset($_POST['submit']))
{
    $postData['admin-pages']['name'] = ""; //text
    $postData['admin-pages']['note'] = ""; //text
    $postData['admin-pages']['label'] = ""; //text
    $postData['admin-pages']['icon'] = ""; //text
    $postData['admin-pages']['type_generator'] = "auto"; //select
    $postData['admin-pages']['copy_to_custom_code'] = true; //boolean

    // edit
    if (isset($_GET["n"]))
    {
        $_POST["admin-pages"]["name"] = $_GET["n"];
    }

    // TODO: ACTION --|-- SUBMIT --|-- POST RESPONSE
    // text
    if (isset($_POST['admin-pages']['name']))
    {
        $postData['admin-pages']['name'] = $_POST['admin-pages']['name'];
    }


    // text
    if (isset($_POST['admin-pages']['page-title']))
    {
        $postData['admin-pages']['page_title'] = $_POST['admin-pages']['page-title'];
    }

    // text
    if (isset($_POST['admin-pages']['menu-title']))
    {
        $postData['admin-pages']['menu_title'] = $_POST['admin-pages']['menu-title'];
    }

    // text
    if (isset($_POST['admin-pages']['menu-icon']))
    {
        $postData['admin-pages']['menu_icon'] = $_POST['admin-pages']['menu-icon'];
    }

    // select
    if (isset($_POST['admin-pages']['appears']))
    {
        $postData['admin-pages']['appears'] = $_POST['admin-pages']['appears'];
    }

    // text
    if (isset($_POST['admin-pages']['position']))
    {
        $postData['admin-pages']['position'] = $_POST['admin-pages']['position'];
    }


    if (isset($_POST['admin-pages']['sub_menu']))
    {
        $postData['admin-pages']['sub_menu'] = $_POST['admin-pages']['sub_menu'];
    }

    // select
    if (isset($_POST['admin-pages']['sub_menu_option']))
    {
        $postData['admin-pages']['sub_menu_option'] = $_POST['admin-pages']['sub_menu_option'];
    }


    // text
    if (isset($_POST['admin-pages']['custom-code']['markup']))
    {
        $postData['admin-pages']['custom-code']['markup'] = $_POST['admin-pages']['custom-code']['markup'];
    }

    if (isset($_POST['admin-pages']['enqueue_scripts']))
    {
        $postData['admin-pages']['enqueue_scripts'] = $_POST['admin-pages']['enqueue_scripts'];
    }


    // select
    if (isset($_POST['admin-pages']['type_generator']))
    {
        $postData['admin-pages']['type_generator'] = $_POST['admin-pages']['type_generator'];
    }

    // boolean
    if (isset($_POST['admin-pages']['copy_to_custom_code']))
    {
        $postData['admin-pages']['copy_to_custom_code'] = true;
    } else
    {
        $postData['admin-pages']['copy_to_custom_code'] = false;
    }


    // TODO: ACTION --|-- SUBMIT --|-- SAVE DATA

    // validate and save postdata
    $db->saveAdminPage($postData['admin-pages']);
    $db->current();
    $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Admin-pages saved successfully!");
    if ($_GET["a"] == "edit")
    {
        header("Location: ./?p=adminPages&a=edit&alert=success&n=" . $_GET["n"] . "&" . time());
    } else
    {
        header("Location: ./?p=adminPages&a=list&alert=success&" . time());
    }
}


// TODO: ACTION --|-- REMOVE --|-- ADMIN-PAGES
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "trash")
    {
        $_prefix = basename($_GET["n"]);
        $db->removeAdminPage($_prefix);
        $db->current();
        $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Admin-page deleted successfully!");
        header("Location: ./?p=adminPages&a=list&alert=warning&" . time());
    }
}


// TODO: LAYOUT --|-- ADMIN PAGES
$disabled = "";
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "edit")
    {
        $_prefix = basename($_GET["n"]);
        $currentData["admin-pages"] = $db->getAdminPage($_prefix);
        $disabled = "disabled";
    }
}


// TODO: LAYOUT --|-- ADMIN PAGES --|-- INIT
//text
if (!isset($currentData['admin-pages']['name']))
{
    $currentData['admin-pages']['name'] = "";
}

//text
if (!isset($currentData['admin-pages']['page_title']))
{
    $currentData['admin-pages']['page_title'] = "";
}
//text
if (!isset($currentData['admin-pages']['menu_title']))
{
    $currentData['admin-pages']['menu_title'] = "";
}


//text
if (!isset($currentData['admin-pages']['menu_icon']))
{
    $currentData['admin-pages']['menu_icon'] = "dashicons-chart-pie";
}

if (!isset($currentData['admin-pages']['appears']))
{
    $currentData['admin-pages']['appears'] = "top-level";
}

//text
if (!isset($currentData['admin-pages']['position']))
{
    $currentData['admin-pages']['position'] = 45;
}

if (!isset($currentData['admin-pages']['sub_menu']))
{
    $currentData['admin-pages']['sub_menu'] = "";
}


if (!isset($currentData['admin-pages']['sub_menu_option']))
{
    $currentData['admin-pages']['sub_menu_option'] = "";
}

//select
if (!isset($currentData['admin-pages']['type_generator']))
{
    $currentData['admin-pages']['type_generator'] = "auto";
}
//boolean
if (!isset($currentData['admin-pages']['copy_to_custom_code']))
{
    $currentData['admin-pages']['copy_to_custom_code'] = true;
}

if (!isset($currentData['admin-pages']['custom-code']['markup']))
{
    $currentData['admin-pages']['custom-code']['markup'] = null;
    $currentData['admin-pages']['custom-code']['markup'] .= '?>' . "\r\n";
    $currentData['admin-pages']['custom-code']['markup'] .= '<h1>Hello</h1>' . "\r\n";
    $currentData['admin-pages']['custom-code']['markup'] .= '<?php' . "\r\n";
}

//checkbox
if (!isset($currentData['admin-pages']['enqueue_scripts']))
{
    $currentData['admin-pages']['enqueue_scripts'] = array();
}

$content_tags .= '<form class="form-horizontal" action="" method="post">';

$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-6">';
$content_tags .= '<div class="card card-outline card-primary">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-th"></i>&nbsp;';
$content_tags .= __e("Admin Pages");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- ADMIN PAGES --|-- FORM
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/admin-pages/' . $_prefix . '.php</code></p>';
$content_tags .= '<hr/>';

// text
// TODO: LAYOUT --|-- ADMIN PAGES --|-- FORM --|-- NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="name" class="col-sm-3 col-form-label">' . __e("Name") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input ' . $disabled . ' required type="text" name="admin-pages[name]"  class="form-control" id="field-name" placeholder="my-docs" value="' . $currentData['admin-pages']['name'] . '">';
$content_tags .= '<p class="help-block">' . __e("Name, must not exceed 20 characters and may only contain a-z, 0-9, and - characters") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- ADMIN PAGES --|-- FORM --|-- PAGE-TITLE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label" class="col-sm-3 col-form-page-title">' . __e("Page Title") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input required type="text" name="admin-pages[page-title]"  class="form-control" id="field-label" placeholder="My Docs" value="' . $currentData['admin-pages']['page_title'] . '">';
$content_tags .= '<p class="help-block">' . __e("The text to be displayed in the title tags of the page when the menu is selected") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

$content_tags .= '<hr>';

// text
// TODO: LAYOUT --|-- ADMIN PAGES --|-- FORM --|-- MENU-TITLE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label" class="col-sm-3 col-form-menu-title">' . __e("Menu Title") . '</label>';
$content_tags .= '<div class="col-sm-7">';
$content_tags .= '<input required type="text" name="admin-pages[menu-title]"  class="form-control" id="field-label" placeholder="My Docs" value="' . $currentData['admin-pages']['menu_title'] . '">';
$content_tags .= '<p class="help-block">' . __e("The text to be used for the menu") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- ADMIN PAGES --|-- FORM --|-- MENU_ICON
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label" class="col-sm-3 col-form-label">' . __e("Menu Icon") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<div class="input-group">';
$content_tags .= '<input type="text" id="admin-pages-menu-icon" name="admin-pages[menu-icon]"  class="form-control no-border-top-right-radius" placeholder="dashicons-book" value="' . $currentData['admin-pages']['menu_icon'] . '">';
$content_tags .= '<span class="input-group-append" data-type="icon-picker" data-prefix="dashicons" data-target="#admin-pages-menu-icon" data-dialog="#dashicons-dialog" data-preview="#admin-pages-menu-icon-preview">';
$content_tags .= '<span class="input-group-text"><i id="admin-pages-menu-icon-preview" class="dashicons ' . $currentData['admin-pages']['menu_icon'] . '"></i></span>';
$content_tags .= '</span>';
$content_tags .= '</div>';
$content_tags .= '<p class="help-block">' . __e("Pass the name of a Dashicons helper class to use a font icon, e.g. 'dashicons-chart-pie'") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


$content_tags .= '<hr>';

// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- APPEARS
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="appears" class="col-sm-3 col-form-label">' . __e("Appears on") . '</label>';
$content_tags .= '<div class="col-sm-5">';
$content_tags .= '<select name="admin-pages[appears]" class="form-control" id="field-appears">';
$options = array();
$options[] = array("value" => "top-level", "label" => "The Top Level Menu");
$options[] = array("value" => "sub-menu", "label" => "Sub Menu");

foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['admin-pages']['appears'])
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
// TODO: LAYOUT --|-- ADMIN PAGES --|-- FORM --|-- SUB_MENU_OPTION
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="sub_menu" class="col-sm-3 col-form-label">' . __e("Sub Menu?") . '</label>';
$content_tags .= '<div class="col-sm-9">';

$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-sm-6">';

$content_tags .= '<select name="admin-pages[sub_menu]" class="form-control" id="field-sub_menu_option">';
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
    if ($opt["value"] == $currentData['admin-pages']['sub_menu'])
    {
        $selected = "selected";
    }
    $content_tags .= '<option ' . $selected . ' value="' . $opt["value"] . '">' . $opt["label"] . '</option>';
}
$content_tags .= '</select>';

$content_tags .= '</div>';
$content_tags .= '<div class="col-sm-6">';

$content_tags .= '<input  type="text" name="admin-pages[sub_menu]"  class="form-control" id="field-sub_menu" placeholder="edit.php?post_type=your_post_type" value="' . $currentData['admin-pages']['sub_menu'] . '">';
$content_tags .= '<p class="help-block">' . __e("The slug name for the parent menu, keep it <strong>blank</strong> for the <strong>top level menu</strong>") . '</p>';

$content_tags .= '</div>';
$content_tags .= '</div>';

$content_tags .= '</div>';
$content_tags .= '</div>';


// select
// TODO: LAYOUT --|-- ADMIN PAGES --|-- FORM --|-- POSITION
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="position" class="col-sm-3 col-form-label">' . __e("Position") . '</label>';
$content_tags .= '<div class="col-sm-4">';
$content_tags .= '<select name="admin-pages[position]" class="form-control" id="field-position">';
$options = array();
$options[] = array("value" => "2", "label" => "2 - Dashboard");
$options[] = array("value" => "4", "label" => "4 - Separator");
$options[] = array("value" => "5", "label" => "5 - Posts");
$options[] = array("value" => "10", "label" => "10 - Media");
$options[] = array("value" => "15", "label" => "15 - Links");
$options[] = array("value" => "20", "label" => "20 - Pages");
$options[] = array("value" => "25", "label" => "25 - Comments");
$options[] = array("value" => "59", "label" => "59 - Separator");
$options[] = array("value" => "60", "label" => "60 - Appearance");
$options[] = array("value" => "65", "label" => "65 - Plugins");
$options[] = array("value" => "70", "label" => "70 - Users");
$options[] = array("value" => "75", "label" => "75 - Tools");
$options[] = array("value" => "80", "label" => "80 - Settings");
$options[] = array("value" => "99", "label" => "99 - Separator");


foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['admin-pages']['position'])
    {
        $selected = "selected";
    }
    $content_tags .= '<option ' . $selected . ' value="' . $opt["value"] . '">' . $opt["label"] . '</option>';
}
$content_tags .= '</select>';
$content_tags .= '<p class="help-block">' . __e("The position in the menu order this item should appear") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=adminPages" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=adminPages&amp;a=edit&amp;n=' . $_prefix . '" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


$content_tags .= '</div>'; //col-md-6


$content_tags .= '<div class="col-md-6">';
$content_tags .= '<div class="card card-outline card-info">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-filter"></i>&nbsp;';
$content_tags .= __e("Enqueue Scripts");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|--
$content_tags .= '<div class="card-body">';

$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/admin-pages/' . $_prefix . '.php</code></p>';
$content_tags .= '<hr/>';


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
    "path" => 'assets/js/' . $_prefix . '-admin-page.js');
$options[] = array(
    "label" => "CSS Style File",
    "value" => "styles",
    "path" => 'assets/css/' . $_prefix . '-admin-page.css');
$z = 0;
foreach ($options as $opt)
{
    $selected = "";
    foreach ($currentData['admin-pages']['enqueue_scripts'] as $item)
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
    $content_tags .= '<input id="admin-pages-enqueue_scripts-' . $opt["value"] . '-' . $z . '" ' . $selected . '  type="checkbox" name="admin-pages[enqueue_scripts][' . $opt["value"] . ']"  class="form-control" placeholder="" value="' . $opt["value"] . '" />';
    $content_tags .= '<label for="admin-pages-enqueue_scripts-' . $opt["value"] . '-' . $z . '">' . $opt["label"] . '</label>';
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


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-info btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=adminPages" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=adminPages&amp;a=edit&amp;n=' . $_prefix . '" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
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

$content_tags .= '<p>' . __e("Write markup in php code form") . '</p>';

$content_tags .= '</div>'; //card-body
$content_tags .= '</div>'; //card
$content_tags .= '</div>'; //col-md-6
$content_tags .= '</div>'; //row


$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-12">';

$content_tags .= '<div class="card card-outline card-success">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fab fa-php"></i>&nbsp;';
$content_tags .= __e("Markup");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|--
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/admin-pages/' . $_prefix . '.php</code></p>';
$content_tags .= '<hr/>';

$content_tags .= '<h3>';
$content_tags .= __e("PHP Code");
$content_tags .= '</h3>';
$content_tags .= '<textarea name="admin-pages[custom-code][markup]" class="form-control" data-type="php">' . htmlentities($currentData['admin-pages']['custom-code']['markup']) . '</textarea>';
$content_tags .= '<p class="codemirror-note codemirror-note-default">' . __e("Press") . ' <kbd>CTRL + Space</kbd> ' . __e("for") . ' <code>Auto-Completion</code> ' . __e("and") . ' <kbd>F11</kbd> ' . __e("for") . ' <code>Full Screen mode</code></p>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-success btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=adminPages" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=adminPages&amp;a=edit&amp;n=' . $_prefix . '" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card

$content_tags .= '</div>'; //col-md-12
$content_tags .= '</div>'; //row


$content_tags .= '</form>';

$icon = new ShowIcon();
$content_tags .= $icon->Display('dashicons', 'Dashicons');


// TODO: LAYOUT --|-- ADMIN PAGES
switch ($_GET["a"])
{
    case "list":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=adminPages">' . __e("Admin Pages") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("List") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags .= '<div class="card card-outline card-info">';
        $_content_tags .= '<div class="card-body">';

        $_content_tags .= '<div class="welcome">';
        $_content_tags .= '<h2>' . __e('Back-end') . '</h2>';
        $_content_tags .= '<h1>' . __e('Admin Pages') . '</h1>';
        $_content_tags .= '<p class="lead">' . __e('Create admin menu and admin page') . '</p>';
        $_content_tags .= '</div>';

        // TODO: LIST --|-- TABLE
        $_content_tags .= '<table data-type="datatable" class="table datatable table-bordered">';
        $_content_tags .= '<thead>';
        $_content_tags .= '<tr>';
        $_content_tags .= '<th>' . __e("Name") . '</th>';
        $_content_tags .= '<th>' . __e("Page Title") . '</th>';
        $_content_tags .= '<th>' . __e("Menu Title") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Action") . '</th>';
        $_content_tags .= '</tr>';
        $_content_tags .= '</thead>';
        $_content_tags .= '<tbody>';
        $admin_pages = $db->getAdminPages();
        foreach ($admin_pages as $admin_page)
        {
            $_content_tags .= '<tr>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $admin_page['name'] . '</code></td>';
            $_content_tags .= '<td>' . $admin_page['page_title'] . '</td>';
            $_content_tags .= '<td><em>' . $admin_page['menu_title'] . '</em></td>';

            $_content_tags .= '<td class="text-center align-middle">';
            $_content_tags .= '<div class="btn-group btn-group-sm">';
            $_content_tags .= '<a href="#' . $admin_page['name'] . '" data-toggle="modal" data-target="#modal-trash-admin-pages-' . $admin_page['name'] . '" data-href="./?p=adminPages&amp;a=trash&amp;n=' . $admin_page['name'] . '" class="btn btn-danger"><i class="fa fa-trash"></i> ' . __e("Trash") . '</a>';
            $_content_tags .= '<a href="./?p=adminPages&amp;a=edit&amp;n=' . $admin_page['name'] . '" class="btn btn-success"><i class="fa fa-edit"></i> ' . __e("Edit") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</td>';
            $_content_tags .= '</tr>';
        }
        $_content_tags .= '</tbody>';
        $_content_tags .= '</table>';
        $_content_tags .= '</div>';
        $_content_tags .= '<div class="card-footer">';
        $_content_tags .= '<a href="./?p=adminPages&amp;a=new" class="btn btn-success"><i class="fa fa-plus-circle"></i> ' . __e("Add New Admin Pages") . '</a>';
        $_content_tags .= '</div>';
        $_content_tags .= '</div>';
        // TODO: LIST --|-- MODAL
        foreach ($admin_pages as $admin_page)
        {
            $_content_tags .= '<div class="modal fade" id="modal-trash-admin-pages-' . $admin_page['name'] . '">';
            $_content_tags .= '<div class="modal-dialog">';
            $_content_tags .= '<div class="modal-content bg-default">';
            $_content_tags .= '<div class="modal-header">';
            $_content_tags .= '<h4 class="modal-title">' . __e("Confirm") . '</h4>';
            $_content_tags .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            $_content_tags .= '<span aria-hidden="true">&times;</span></button>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-body">';
            $_content_tags .= '<p>' . __e("Are you sure You want to delete this Admin Page?") . '</p>';
            $_content_tags .= '<table class="table-grid">';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td rowspan="4" style="text-align: center;"><i class="fas fa-file trash-logo"></i></td>';
            $_content_tags .= '<td>' . __e("Name") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $admin_page['name'] . '</code></td>';
            $_content_tags .= '</tr>';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Page Title") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td>' . $admin_page['page_title'] . '</td>';
            $_content_tags .= '</tr>';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Menu Title") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td>' . $admin_page['menu_title'] . '</td>';
            $_content_tags .= '</tr>';
            $_content_tags .= '</table>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-footer justify-content-between">';
            $_content_tags .= '<button type="button" class="btn btn-default" data-dismiss="modal">' . __e("Close") . '</button>';
            $_content_tags .= '<a href="./?p=adminPages&amp;a=trash&amp;n=' . $admin_page['name'] . '" class="btn btn-danger">' . __e("Yes, I am sure!") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
        }

        break;
    case "new":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=adminPages">' . __e("Admin Pages") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("New") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
    case "edit":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=adminPages">' . __e("Admin Pages") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("Edit") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
}
$pagejs = null;
$pagejs .= "" . '$(document).ready(function(){' . "\r\n";
$pagejs .= "\t" . '$("#field-sub_menu_option").on("click",function(){' . "\r\n";
$pagejs .= "\t\t" . '$("#field-sub_menu").val($(this).val());' . "\r\n";
$pagejs .= "\t" . '});' . "\r\n";
$pagejs .= "" . '});' . "\r\n";

define('IHS_LAYOUT_CONTENT', $_content_tags);
define('IHS_LAYOUT_BREADCRUMB', $breadcrumb_tags);
define('IHS_PAGE_NAME', __e("Admin Pages"));
define('IHS_PAGE_DESC', __e("Create admin menu and admin page"));
define('IHS_PAGE_JS', $pagejs);

?>