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
    $postData['enqueue-scripts']['name'] = ""; //text
    $postData['enqueue-scripts']['note'] = ""; //text
    $postData['enqueue-scripts']['src'] = ""; //text
    $postData['enqueue-scripts']['ver'] = ""; //text
    $postData['enqueue-scripts']['in_footer'] = false; //boolean
    $postData['enqueue-scripts']['interface'] = "back-end"; //radio
    $postData['enqueue-scripts']['deps'] = array(); //checkbox
    $postData['enqueue-scripts']['hooks'] = array(); //text

    // TODO: ACTION --|-- SUBMIT --|-- POST RESPONSE
    // text
    if (isset($_POST['enqueue-scripts']['name']))
    {
        $postData['enqueue-scripts']['name'] = $_POST['enqueue-scripts']['name'];
    }
    if (isset($_GET['n']))
    {
        $postData['enqueue-scripts']['name'] = $_GET['n'];
    }

    // text
    if (isset($_POST['enqueue-scripts']['src']))
    {
        $postData['enqueue-scripts']['src'] = $_POST['enqueue-scripts']['src'];
    }

    // text
    if (isset($_POST['enqueue-scripts']['note']))
    {
        $postData['enqueue-scripts']['note'] = $_POST['enqueue-scripts']['note'];
    }

    // text
    if (isset($_POST['enqueue-scripts']['ver']))
    {
        $postData['enqueue-scripts']['ver'] = $_POST['enqueue-scripts']['ver'];
    }
    // boolean
    if (isset($_POST['enqueue-scripts']['in_footer']))
    {
        $postData['enqueue-scripts']['in_footer'] = true;
    } else
    {
        $postData['enqueue-scripts']['in_footer'] = false;
    }
    // radio
    if (isset($_POST['enqueue-scripts']['interface']))
    {
        $postData['enqueue-scripts']['interface'] = $_POST['enqueue-scripts']['interface'];
    }
    // checkbox
    if (isset($_POST['enqueue-scripts']['deps']))
    {
        $postData['enqueue-scripts']['deps'] = $_POST['enqueue-scripts']['deps'];
    }
    // text
    if (isset($_POST['enqueue-scripts']['hooks']))
    {
        $postData['enqueue-scripts']['hooks'] = $_POST['enqueue-scripts']['hooks'];
    }


    // TODO: ACTION --|-- SUBMIT --|-- SAVE DATA

    // validate and save postdata
    $db->saveEnqueueScripts($postData['enqueue-scripts']);
    $db->current();
    $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Script saved successfully!");
    if ($_GET["a"] == "edit")
    {
        header("Location: ./?p=enqueueScripts&a=edit&alert=success&n=" . $_GET["n"] . "&" . time());
    } else
    {
        header("Location: ./?p=enqueueScripts&a=list&alert=success&" . time());
    }
}


// TODO: ACTION --|-- REMOVE --|-- ENQUEUE-SCRIPTS
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "trash")
    {
        $_prefix = basename($_GET["n"]);
        $db->removeEnqueueScript($_prefix);
        $db->current();
        $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Script deleted successfully!");
        header("Location: ./?p=enqueueScripts&a=list&alert=warning&" . time());
    }
}


// TODO: LAYOUT --|-- GENERAL
$disabled = "";
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "edit")
    {
        $_prefix = basename($_GET["n"]);
        $currentData["enqueue-scripts"] = $db->getEnqueueScript($_prefix);
        $disabled = "disabled";
    }
}


// TODO: LAYOUT --|-- GENERAL --|-- INIT
//text
if (!isset($currentData['enqueue-scripts']['name']))
{
    $currentData['enqueue-scripts']['name'] = "";
}
//text
if (!isset($currentData['enqueue-scripts']['src']))
{
    $currentData['enqueue-scripts']['src'] = "";
}

//text
if (!isset($currentData['enqueue-scripts']['note']))
{
    $currentData['enqueue-scripts']['note'] = "";
}

//text
if (!isset($currentData['enqueue-scripts']['ver']))
{
    $currentData['enqueue-scripts']['ver'] = "";
}
//boolean
if (!isset($currentData['enqueue-scripts']['in_footer']))
{
    $currentData['enqueue-scripts']['in_footer'] = false;
}
//radio
if (!isset($currentData['enqueue-scripts']['interface']))
{
    $currentData['enqueue-scripts']['interface'] = "back-end";
}
//checkbox
if (!isset($currentData['enqueue-scripts']['deps']))
{
    $currentData['enqueue-scripts']['deps'][0] = 'jquery';
}
//text
if (!isset($currentData['enqueue-scripts']['hooks']))
{
    $currentData['enqueue-scripts']['hooks'] = array();
}

if ($disabled == "disabled")
{

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
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/enqueue-scripts.php</code></p>';
$content_tags .= '<hr/>';

// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="name" class="col-sm-3 col-form-label">' . __e("Name") . '</label>';
$content_tags .= '<div class="col-sm-4">';
$content_tags .= '<input ' . $disabled . ' required type="text" name="enqueue-scripts[name]"  class="form-control" id="field-name" placeholder="my-file-js" value="' . $currentData['enqueue-scripts']['name'] . '">';
$content_tags .= '<p class="help-block">' . __e("Name of the script, should be unique") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- SRC
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="src" class="col-sm-3 col-form-label">' . __e("Source") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<input required type="text" name="enqueue-scripts[src]"  class="form-control" id="field-src" placeholder="assets/js/my-file.js" value="' . $currentData['enqueue-scripts']['src'] . '">';
$content_tags .= '<p class="help-block">' . __e("Full URL of the script, or path of the script relative to the WordPress root directory") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- NOTE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="src" class="col-sm-3 col-form-label">' . __e("Note") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<input type="text" name="enqueue-scripts[note]"  class="form-control" id="field-note" placeholder="Used for widgets" value="' . $currentData['enqueue-scripts']['note'] . '">';
$content_tags .= '<p class="help-block">' . __e("Just for additional information") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- VER
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="ver" class="col-sm-3 col-form-label">' . __e("Version") . '</label>';
$content_tags .= '<div class="col-sm-5">';
$content_tags .= '<input required type="text" name="enqueue-scripts[ver]"  class="form-control" id="field-ver" placeholder="1.1" value="' . $currentData['enqueue-scripts']['ver'] . '">';
$content_tags .= '<p class="help-block">' . __e("String specifying script version number, if it has one, which is added to the URL as a query string for cache busting purposes") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// boolean
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- IN_FOOTER
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="in_footer" class="col-sm-3 col-form-label">' . __e("In Footer") . '</label>';
$content_tags .= '<div class="col-sm-9">';
if ($currentData['enqueue-scripts']['in_footer'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="enqueue-scripts[in_footer]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="enqueue-scripts[in_footer]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("<code>ON</code> = The javascript file will be placed before <code>&lt;/body&gt;</code>") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// radio
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- INTERFACE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="interface" class="col-sm-3 col-form-label">' . __e("Interface") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$options = array();
$options[] = array("value" => "back-end", "label" => "Back-End");
$options[] = array("value" => "front-end", "label" => "Front-End");
foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['enqueue-scripts']['interface'])
    {
        $selected = "checked";
    }
    $content_tags .= '<div class="form-group clearfix">';
    $content_tags .= '<div class="icheck-info">';
    $content_tags .= '<input id="enqueue-scripts-interface-' . $opt["value"] . '" ' . $selected . '  type="radio" name="enqueue-scripts[interface]"  class="form-control" placeholder="" value="' . $opt["value"] . '" />';
    $content_tags .= '<label for="enqueue-scripts-interface-' . $opt["value"] . '">' . $opt["label"] . '</label>';
    $content_tags .= '</div>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>';
$content_tags .= '</div>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=enqueueScripts" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=enqueueScripts" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card
$content_tags .= '<div class="card card-outline card-success">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-cogs"></i>&nbsp;';
$content_tags .= __e("Dependencies");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|--
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/enqueue-scripts.php</code></p>';
$content_tags .= '<hr/>';

// checkbox
// TODO: LAYOUT --|-- DEPEDENCIES --|-- FORM --|-- DEPS

$content_tags .= '<div class="row">';

$z = 0;
foreach ($GLOBALS['JS_DEPS'] as $opt)
{
    $selected = "";
    foreach ($currentData['enqueue-scripts']['deps'] as $item)
    {
        if ($opt["value"] == $item)
        {
            $selected = "checked";
        }
    }
    $content_tags .= '<div class="col-md-4">';
    $content_tags .= '<div class="form-group clearfix">';
    $content_tags .= '<div class="icheck-danger">';
    $content_tags .= '<input id="enqueue-scripts-deps-' . $opt["value"] . '-' . $z . '" ' . $selected . '  type="checkbox" name="enqueue-scripts[deps][' . $z . ']"  class="form-control" placeholder="" value="' . $opt["value"] . '" />';
    $content_tags .= '<label for="enqueue-scripts-deps-' . $opt["value"] . '-' . $z . '">' . $opt["label"] . '</label>';
    $content_tags .= '</div>';
    $content_tags .= '</div>';
    $content_tags .= '</div>';
    $z++;
}
$content_tags .= '</div>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-success btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=enqueueScripts" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=enqueueScripts" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
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
$content_tags .= __e("Hook Suffix");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|--
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/enqueue-scripts.php</code></p>';
$content_tags .= '<hr/>';

$content_tags .= '<div class="callout callout-success">';
$content_tags .= __e("This will be executed by the following admin pages, If <code>left blank</code> it will be executed on <code>all admin pages</code>");
$content_tags .= '</div>';


$content_tags .= '<div class="row">';

$z = 0;
foreach ($GLOBALS['HOOK_SUFFIX'] as $opt)
{
    $selected = "";
    foreach ($currentData['enqueue-scripts']['hooks'] as $item)
    {
        if ($opt["value"] == $item)
        {
            $selected = "checked";
        }
    }
    $content_tags .= '<div class="col-md-4">';
    $content_tags .= '<div class="form-group clearfix">';
    $content_tags .= '<div class="icheck-danger">';
    $content_tags .= '<input id="enqueue-scripts-hooks-' . $opt["value"] . '-' . $z . '" ' . $selected . '  type="checkbox" name="enqueue-scripts[hooks][' . $z . ']"  class="form-control" placeholder="" value="' . $opt["value"] . '" />';
    $content_tags .= '<label for="enqueue-scripts-hooks-' . $opt["value"] . '-' . $z . '">' . $opt["label"] . '</label>';
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
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=enqueueScripts" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=enqueueScripts" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
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
// TODO: LAYOUT --|--
$content_tags .= '<div class="card-body">';

$content_tags .= '<div class="callout callout-success">';
$content_tags .= __e('These instructions are dynamic according to the conditions of the project being worked on');
$content_tags .= '</div>';


$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<h5>' . __e("Code References") . ':</h5>';
$content_tags .= '<ul>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/wp_enqueue_scripts/">wp_enqueue_scripts</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/">admin_enqueue_scripts</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/wp_enqueue_script/">wp_enqueue_script</a>' . '</p></li>';
$content_tags .= '</ul>';
$content_tags .= '</div>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=enqueueScripts" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=enqueueScripts" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card
$content_tags .= '</div>'; //col-md-6
$content_tags .= '</div>'; //row
$content_tags .= '</form>';
// TODO: LAYOUT --|-- GENERAL
switch ($_GET["a"])
{
    case "list":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=enqueueScripts">' . __e("Enqueue Scripts") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("List") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags .= '<div class="card card-outline card-info">';
        $_content_tags .= '<div class="card-body">';

        $_content_tags .= '<div class="welcome">';
        $_content_tags .= '<h2>' . __e('JavaScript and its Libraries') . '</h2>';
        $_content_tags .= '<h1>' . __e('Enqueue Scripts') . '</h1>';
        $_content_tags .= '<p class="lead">' . __e('The best solution for loading JavaScript files into your WordPress') . '</p>';
        $_content_tags .= '</div>';

        // TODO: LIST --|-- TABLE
        $_content_tags .= '<table data-type="datatable" class="table datatable table-bordered">';
        $_content_tags .= '<thead>';
        $_content_tags .= '<tr>';
        $_content_tags .= '<th class="text-left">' . __e("Name") . '</th>';
        $_content_tags .= '<th class="text-left">' . __e("Note") . '</th>';
        $_content_tags .= '<th class="text-left">' . __e("Interface") . '</th>';
        $_content_tags .= '<th class="text-left">' . __e("Hook Suffix") . '</th>';
        $_content_tags .= '<th class="text-left">' . __e("Dependencies") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Action") . '</th>';

        $_content_tags .= '</tr>';
        $_content_tags .= '</thead>';
        $_content_tags .= '<tbody>';
        $enqueue_scripts = $db->getEnqueueScripts();
        foreach ($enqueue_scripts as $enqueue_script)
        {
            $list_dependencies = null;
            $list_hooks = null;
            if ($enqueue_script['interface'] == 'back-end')
            {
                //$list_hooks = '<span class="badge badge-secondary">' . __e("all") . '</span>';
                foreach ($enqueue_script['hooks'] as $hook)
                {
                    $list_hooks .= '<span class="badge badge-secondary">' . $hook . '</span> ';
                }
            }
            foreach ($enqueue_script['deps'] as $dep)
            {
                $list_dependencies .= '<span class="badge badge-primary">' . $dep . '</span> ';
            }
            $color = 'primary';
            if ($enqueue_script['interface'] == 'back-end')
            {
                $color = 'info';
            }
            if ($enqueue_script['interface'] == 'front-end')
            {
                $color = 'success';
            }
            if (!isset($enqueue_script['note']))
            {
                $enqueue_script['note'] = '';
            }

            $_content_tags .= '<tr>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $enqueue_script['name'] . '</code></td>';
            $_content_tags .= '<td>' . htmlentities($enqueue_script['note']) . '</td>';
            $_content_tags .= '<td><span class="badge badge-' . $color . '">' . $enqueue_script['interface'] . '</span></td>';
            $_content_tags .= '<td>' . $list_hooks . '</td>';
            $_content_tags .= '<td>' . $list_dependencies . '</td>';
            $_content_tags .= '<td class="text-center align-middle">';
            $_content_tags .= '<div class="btn-group btn-group-sm">';
            $_content_tags .= '<a href="#' . $enqueue_script['name'] . '" data-toggle="modal" data-target="#modal-trash-enqueue-scripts-' . $enqueue_script['name'] . '" data-href="./?p=enqueueScripts&amp;a=trash&amp;n=' . $enqueue_script['name'] . '" class="btn btn-danger"><i class="fa fa-trash"></i> ' . __e("Trash") . '</a>';
            $_content_tags .= '<a href="./?p=enqueueScripts&amp;a=edit&amp;n=' . $enqueue_script['name'] . '" class="btn btn-success"><i class="fa fa-edit"></i> ' . __e("Edit") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</td>';
            $_content_tags .= '</tr>';
        }
        $_content_tags .= '</tbody>';
        $_content_tags .= '</table>';
        $_content_tags .= '</div>';
        $_content_tags .= '<div class="card-footer">';
        $_content_tags .= '<a href="./?p=enqueueScripts&amp;a=new" class="btn btn-success"><i class="fa fa-plus-circle"></i> ' . __e("Add New Scripts") . '</a>';
        $_content_tags .= '</div>';
        $_content_tags .= '</div>';
        // TODO: LIST --|-- MODAL
        foreach ($enqueue_scripts as $enqueue_script)
        {
            $color = 'primary';
            if ($enqueue_script['interface'] == 'back-end')
            {
                $color = 'info';
            }
            if ($enqueue_script['interface'] == 'front-end')
            {
                $color = 'success';
            }
            $list_dependencies = null;
            foreach ($enqueue_script['deps'] as $dep)
            {
                $list_dependencies .= '<span class="badge badge-primary">' . $dep . '</span> ';
            }
            $_content_tags .= '<div class="modal fade" id="modal-trash-enqueue-scripts-' . $enqueue_script['name'] . '">';
            $_content_tags .= '<div class="modal-dialog">';
            $_content_tags .= '<div class="modal-content bg-default">';
            $_content_tags .= '<div class="modal-header">';
            $_content_tags .= '<h4 class="modal-title">' . __e("Confirm") . '</h4>';
            $_content_tags .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            $_content_tags .= '<span aria-hidden="true">&times;</span></button>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-body">';
            $_content_tags .= '<p>' . __e("Are you sure You want to delete this scripts?") . '</p>';
            $_content_tags .= '<table class="table-grid">';

            $_content_tags .= '<tr>';
            $_content_tags .= '<td rowspan="3" style="text-align: center;"><i class="fab fa-js trash-logo"></i></td>';
            $_content_tags .= '<td>' . __e("Name") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $enqueue_script['name'] . '</code></td>';
            $_content_tags .= '</tr>';

            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Interface") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><span class="badge badge-' . $color . '">' . $enqueue_script['name'] . '</span></td>';
            $_content_tags .= '</tr>';

            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Dependencies") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td>' . $list_dependencies . '</td>';
            $_content_tags .= '</tr>';

            $_content_tags .= '</table>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-footer justify-content-between">';
            $_content_tags .= '<button type="button" class="btn btn-default" data-dismiss="modal">' . __e("Close") . '</button>';
            $_content_tags .= '<a href="./?p=enqueueScripts&amp;a=trash&amp;n=' . $enqueue_script['name'] . '" class="btn btn-danger">' . __e("Yes, I am sure!") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
        }

        break;
    case "new":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=enqueueScripts">' . __e("Enqueue Scripts") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("New") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
    case "edit":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=enqueueScripts">' . __e("Enqueue Scripts") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("Edit") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
}


define('IHS_LAYOUT_CONTENT', $_content_tags);
define('IHS_LAYOUT_BREADCRUMB', $breadcrumb_tags);
define('IHS_PAGE_NAME', __e("Enqueue Scripts"));
define('IHS_PAGE_DESC', __e("Enqueue scripts for the front-end and back-end"));

?> 