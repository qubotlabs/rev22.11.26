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
    $postData['enqueue-styles']['name'] = ""; //text
    $postData['enqueue-styles']['note'] = ""; //text
    $postData['enqueue-styles']['src'] = ""; //text
    $postData['enqueue-styles']['ver'] = ""; //text
    $postData['enqueue-styles']['interface'] = "back-end"; //radio
    $postData['enqueue-styles']['media'] = "All"; //select
    $postData['enqueue-styles']['deps'] = array(); //checkbox
    $postData['enqueue-styles']['hooks'] = array(); //text

    // TODO: ACTION --|-- SUBMIT --|-- POST RESPONSE
    // text
    if (isset($_POST['enqueue-styles']['name']))
    {
        $postData['enqueue-styles']['name'] = $_POST['enqueue-styles']['name'];
    }

    if (isset($_GET['n']))
    {
        $postData['enqueue-styles']['name'] = $_GET['n'];
    }

    // text
    if (isset($_POST['enqueue-styles']['src']))
    {
        $postData['enqueue-styles']['src'] = $_POST['enqueue-styles']['src'];
    }

    // text
    if (isset($_POST['enqueue-styles']['note']))
    {
        $postData['enqueue-styles']['note'] = $_POST['enqueue-styles']['note'];
    }

    // text
    if (isset($_POST['enqueue-styles']['ver']))
    {
        $postData['enqueue-styles']['ver'] = $_POST['enqueue-styles']['ver'];
    }
    // radio
    if (isset($_POST['enqueue-styles']['interface']))
    {
        $postData['enqueue-styles']['interface'] = $_POST['enqueue-styles']['interface'];
    }
    // select
    if (isset($_POST['enqueue-styles']['media']))
    {
        $postData['enqueue-styles']['media'] = $_POST['enqueue-styles']['media'];
    }
    // checkbox
    if (isset($_POST['enqueue-styles']['deps']))
    {
        $postData['enqueue-styles']['deps'] = $_POST['enqueue-styles']['deps'];
    }
    // text
    if (isset($_POST['enqueue-styles']['hooks']))
    {
        $postData['enqueue-styles']['hooks'] = $_POST['enqueue-styles']['hooks'];
    }


    // TODO: ACTION --|-- SUBMIT --|-- SAVE DATA

    // validate and save postdata
    $db->saveEnqueueStyle($postData['enqueue-styles']);

    $db->current();
    $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Style saved successfully!");
    if ($_GET["a"] == "edit")
    {
        header("Location: ./?p=enqueueStyles&a=edit&alert=success&n=" . $_GET["n"] . "&" . time());
    } else
    {
        header("Location: ./?p=enqueueStyles&a=list&alert=success&" . time());
    }
}


// TODO: ACTION --|-- REMOVE --|-- ENQUEUE-STYLES
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "trash")
    {
        $_prefix = basename($_GET["n"]);
        $db->removeEnqueueStyle($_prefix);
        $db->current();
        $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Style deleted successfully!");
        header("Location: ./?p=enqueueStyles&a=list&alert=warning&" . time());
    }
}


// TODO: LAYOUT --|-- GENERAL
$disabled = "";
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "edit")
    {
        $_prefix = basename($_GET["n"]);
        $currentData["enqueue-styles"] = $db->getEnqueueStyle($_prefix);
        $disabled = "disabled";
    }
}


// TODO: LAYOUT --|-- GENERAL --|-- INIT
//text
if (!isset($currentData['enqueue-styles']['name']))
{
    $currentData['enqueue-styles']['name'] = "";
}
//text
if (!isset($currentData['enqueue-styles']['src']))
{
    $currentData['enqueue-styles']['src'] = "";
}
//text
if (!isset($currentData['enqueue-styles']['note']))
{
    $currentData['enqueue-styles']['note'] = "";
}

//text
if (!isset($currentData['enqueue-styles']['ver']))
{
    $currentData['enqueue-styles']['ver'] = "";
}
//radio
if (!isset($currentData['enqueue-styles']['interface']))
{
    $currentData['enqueue-styles']['interface'] = "back-end";
}
//select
if (!isset($currentData['enqueue-styles']['media']))
{
    $currentData['enqueue-styles']['media'] = "All";
}
//checkbox
if (!isset($currentData['enqueue-styles']['deps']))
{
    $currentData['enqueue-styles']['deps'] = array();
}
//text
if (!isset($currentData['enqueue-styles']['hooks']))
{
    $currentData['enqueue-styles']['hooks'] = array();
}
if (!is_array($currentData['enqueue-styles']['hooks']))
{
    $currentData['enqueue-styles']['hooks'] = array();
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
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/enqueue-styles.php</code></p>';
$content_tags .= '<hr/>';

// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="name" class="col-sm-3 col-form-label">' . __e("Name") . '</label>';
$content_tags .= '<div class="col-sm-4">';
$content_tags .= '<input ' . $disabled . ' required type="text" name="enqueue-styles[name]"  class="form-control" id="field-name" placeholder="my-file-css" value="' . $currentData['enqueue-styles']['name'] . '">';
$content_tags .= '<p class="help-block">' . __e("Name of the stylesheet, should be unique") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- NOTE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="src" class="col-sm-3 col-form-label">' . __e("Note") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<input type="text" name="enqueue-styles[note]"  class="form-control" id="field-note" placeholder="Used for widgets" value="' . $currentData['enqueue-styles']['note'] . '">';
$content_tags .= '<p class="help-block">' . __e("Just for additional information") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- SRC
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="src" class="col-sm-3 col-form-label">' . __e("Source") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<input required type="text" name="enqueue-styles[src]"  class="form-control" id="field-src" placeholder="assets/css/my-file.css" value="' . $currentData['enqueue-styles']['src'] . '">';
$content_tags .= '<p class="help-block">' . __e("Full URL of the stylesheet, or path of the stylesheet relative to the WordPress root directory") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- VER
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="ver" class="col-sm-3 col-form-label">' . __e("Version") . '</label>';
$content_tags .= '<div class="col-sm-5">';
$content_tags .= '<input required type="text" name="enqueue-styles[ver]"  class="form-control" id="field-ver" placeholder="1.1" value="' . $currentData['enqueue-styles']['ver'] . '">';
$content_tags .= '<p class="help-block">' . __e("String specifying stylesheet version number") . '</p>';
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
    if ($opt["value"] == $currentData['enqueue-styles']['interface'])
    {
        $selected = "checked";
    }
    $content_tags .= '<div class="form-group clearfix">';
    $content_tags .= '<div class="icheck-info">';
    $content_tags .= '<input id="enqueue-styles-interface-' . $opt["value"] . '" ' . $selected . '  type="radio" name="enqueue-styles[interface]"  class="form-control" id="field-interface" placeholder="" value="' . $opt["value"] . '" />';
    $content_tags .= '<label for="enqueue-styles-interface-' . $opt["value"] . '">' . $opt["label"] . '</label>';
    $content_tags .= '</div>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>';
$content_tags .= '</div>';

// select
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- MEDIA
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="media" class="col-sm-3 col-form-label">' . __e("Media") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<select name="enqueue-styles[media]" class="form-control" id="field-media">';
$options = array();
$options[] = array("value" => "all", "label" => "All");
$options[] = array("value" => "print", "label" => "Print");
$options[] = array("value" => "screen", "label" => "Screen");
foreach ($options as $opt)
{
    $selected = "";
    if ($opt["value"] == $currentData['enqueue-styles']['media'])
    {
        $selected = "selected";
    }
    $content_tags .= '<option ' . $selected . ' value="' . $opt["value"] . '">' . $opt["label"] . '</option>';
}
$content_tags .= '</select>';
$content_tags .= '<p class="help-block">' . __e("The media for which this stylesheet has been defined") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=enqueueStyles" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=enqueueStyles" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
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
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/enqueue-styles.php</code></p>';
$content_tags .= '<hr/>';
$css_deps = array();
$enqueue_styles = $db->getEnqueueStyles();
foreach ($enqueue_styles as $enqueue_style)
{
    $dep_name = $string->toVar($project['short-name'] . '_' . $enqueue_style['name']);
    $dep_prefix = $string->toVar($enqueue_style['name']);
    if ($currentData['enqueue-styles']['name'] != $dep_prefix)
    {
        $css_deps[] = array('label' => $dep_prefix, 'value' => $dep_name);
    }
}

$content_tags .= '<div class="row">';
$z = 0;
foreach ($css_deps as $opt)
{
    $selected = "";
    foreach ($currentData['enqueue-styles']['deps'] as $item)
    {
        if ($opt["value"] == $item)
        {
            $selected = "checked";
        }
    }
    $content_tags .= '<div class="col-md-4">';
    $content_tags .= '<div class="form-group clearfix">';
    $content_tags .= '<div class="icheck-danger">';
    $content_tags .= '<input id="enqueue-styles-deps-' . $opt["value"] . '-' . $z . '" ' . $selected . '  type="checkbox" name="enqueue-styles[deps][' . $z . ']"  class="form-control" placeholder="" value="' . $opt["value"] . '" />';
    $content_tags .= '<label for="enqueue-styles-deps-' . $opt["value"] . '-' . $z . '">' . $opt["label"] . '</label>';
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
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=enqueueStyles" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=enqueueStyles" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card
$content_tags .= '</div>'; //col-md-6


$content_tags .= '<div class="col-md-6">';
// TODO: LAYOUT --|-- HOOK SUFFIX
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
// TODO: LAYOUT --|-- HOOK SUFFIX --|-- INFO
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/enqueue-styles.php</code></p>';
$content_tags .= '<hr/>';

$content_tags .= '<div class="callout callout-success">';
$content_tags .= __e("This will be executed by the following admin pages, If <code>left blank</code> it will be executed on <code>all admin pages</code>");
$content_tags .= '</div>';


$content_tags .= '<div class="row">';

// TODO: LAYOUT --|-- HOOK SUFFIX --|-- SUFFIX
$z = 0;
foreach ($GLOBALS['HOOK_SUFFIX'] as $opt)
{
    $selected = "";

    foreach ($currentData['enqueue-styles']['hooks'] as $item)
    {
        if ($opt["value"] == $item)
        {
            $selected = "checked";
        }
    }
    $content_tags .= '<div class="col-md-4">';
    $content_tags .= '<div class="form-group clearfix">';
    $content_tags .= '<div class="icheck-danger">';
    $content_tags .= '<input id="enqueue-styles-hooks-' . $opt["value"] . '-' . $z . '" ' . $selected . '  type="checkbox" name="enqueue-styles[hooks][' . $z . ']"  class="form-control" id="field-deps" placeholder="" value="' . $opt["value"] . '" />';
    $content_tags .= '<label for="enqueue-styles-hooks-' . $opt["value"] . '-' . $z . '">' . $opt["label"] . '</label>';
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
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=enqueueStyles" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=enqueueStyles" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
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


$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<h5>' . __e("Code References") . ':</h5>';
$content_tags .= '<ul>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/wp_enqueue_scripts/">wp_enqueue_scripts</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/">admin_enqueue_scripts</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/wp_enqueue_style/">wp_enqueue_style</a>' . '</p></li>';
$content_tags .= '</ul>';
$content_tags .= '</div>';

$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=enqueueStyles" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=enqueueStyles" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
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
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=enqueueStyles">' . __e("Enqueue Styles") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("List") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags .= '<div class="card card-outline card-info">';
        $_content_tags .= '<div class="card-body">';

        $_content_tags .= '<div class="welcome">';
        $_content_tags .= '<h2>' . __e('Styles and its Libraries') . '</h2>';
        $_content_tags .= '<h1>' . __e('Enqueue Styles') . '</h1>';
        $_content_tags .= '<p class="lead">' . __e('The best solution for loading Style files into your WordPress') . '</p>';
        $_content_tags .= '</div>';

        // TODO: LIST --|-- TABLE
        $_content_tags .= '<table data-type="datatable" class="table datatable table-bordered">';
        $_content_tags .= '<thead>';
        $_content_tags .= '<tr>';
        $_content_tags .= '<th>' . __e("Name") . '</th>';
        $_content_tags .= '<th>' . __e("Note") . '</th>';
        $_content_tags .= '<th>' . __e("Interface") . '</th>';
        $_content_tags .= '<th class="text-left">' . __e("Hook Suffix") . '</th>';
        $_content_tags .= '<th class="text-left">' . __e("Dependencies") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Action") . '</th>';
        $_content_tags .= '</tr>';
        $_content_tags .= '</thead>';
        $_content_tags .= '<tbody>';
        $enqueue_styles = $db->getEnqueueStyles();
        foreach ($enqueue_styles as $enqueue_style)
        {
            $color = 'primary';
            if ($enqueue_style['interface'] == 'back-end')
            {
                $color = 'info';
            }
            if ($enqueue_style['interface'] == 'front-end')
            {
                $color = 'success';
            }

            $list_dependencies = '';
            foreach ($enqueue_style['deps'] as $dep)
            {
                $list_dependencies .= '<span class="badge badge-primary">' . $dep . '</span> ';
            }

            $list_hooks = '';
            if ($enqueue_style['interface'] == 'back-end')
            {
                foreach ($enqueue_style['hooks'] as $hook)
                {
                    $list_hooks .= '<span class="badge badge-secondary">' . $hook . '</span> ';
                }
            }
            if (!isset($enqueue_style['note']))
            {
                $enqueue_style['note'] = '';
            }
            $_content_tags .= '<tr>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $enqueue_style['name'] . '</code></td>';
            $_content_tags .= '<td>' . htmlentities($enqueue_style['note']) . '</td>';
            $_content_tags .= '<td><span class="badge badge-' . $color . '">' . $enqueue_style['interface'] . '</span></td>';
            $_content_tags .= '<td>' . $list_hooks . '</td>';
            $_content_tags .= '<td>' . $list_dependencies . '</td>';
            $_content_tags .= '<td class="text-center align-middle">';
            $_content_tags .= '<div class="btn-group btn-group-sm">';
            $_content_tags .= '<a href="#' . $enqueue_style['name'] . '" data-toggle="modal" data-target="#modal-trash-enqueue-styles-' . $enqueue_style['name'] . '" data-href="./?p=enqueueStyles&amp;a=trash&amp;n=' . $enqueue_style['name'] . '" class="btn btn-danger"><i class="fa fa-trash"></i> ' . __e("Trash") . '</a>';
            $_content_tags .= '<a href="./?p=enqueueStyles&amp;a=edit&amp;n=' . $enqueue_style['name'] . '" class="btn btn-success"><i class="fa fa-edit"></i> ' . __e("Edit") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</td>';
            $_content_tags .= '</tr>';
        }
        $_content_tags .= '</tbody>';
        $_content_tags .= '</table>';
        $_content_tags .= '</div>';
        $_content_tags .= '<div class="card-footer">';
        $_content_tags .= '<a href="./?p=enqueueStyles&amp;a=new" class="btn btn-success"><i class="fa fa-plus-circle"></i> ' . __e("Add New Enqueue Styles") . '</a>';
        $_content_tags .= '</div>';
        $_content_tags .= '</div>';
        // TODO: LIST --|-- MODAL
        foreach ($enqueue_styles as $enqueue_style)
        {
            $list_dependencies = null;
            foreach ($enqueue_style['deps'] as $dep)
            {
                $list_dependencies .= '<span class="badge badge-primary">' . $dep . '</span> ';
            }

            $_content_tags .= '<div class="modal fade" id="modal-trash-enqueue-styles-' . $enqueue_style['name'] . '">';
            $_content_tags .= '<div class="modal-dialog">';
            $_content_tags .= '<div class="modal-content bg-default">';
            $_content_tags .= '<div class="modal-header">';
            $_content_tags .= '<h4 class="modal-title">' . __e("Confirm") . '</h4>';
            $_content_tags .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            $_content_tags .= '<span aria-hidden="true">&times;</span></button>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-body">';
            $_content_tags .= '<p>' . __e("Are you sure You want to delete this styles?") . '</p>';
            $_content_tags .= '<table class="table-grid">';

            $_content_tags .= '<tr>';
            $_content_tags .= '<td rowspan="4" style="text-align: center;"><i class="fab fa-css3-alt trash-logo"></i></td>';
            $_content_tags .= '<td>' . __e("Name") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><code>' . $string->toFileName($project['short-name']) . '-' . $enqueue_style['name'] . '</code></td>';
            $_content_tags .= '</tr>';

            $color = 'primary';
            if ($enqueue_style['interface'] == 'back-end')
            {
                $color = 'info';
            }
            if ($enqueue_style['interface'] == 'front-end')
            {
                $color = 'success';
            }

            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Interface") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><span class="badge badge-' . $color . '">' . $enqueue_style['name'] . '</span></td>';
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
            $_content_tags .= '<a href="./?p=enqueueStyles&amp;a=trash&amp;n=' . $enqueue_style['name'] . '" class="btn btn-danger">' . __e("Yes, I am sure!") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
        }

        break;
    case "new":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=enqueueStyles">' . __e("Enqueue Styles") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("New") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
    case "edit":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=enqueueStyles">' . __e("Enqueue Styles") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("Edit") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
}


define('IHS_LAYOUT_CONTENT', $_content_tags);
define('IHS_LAYOUT_BREADCRUMB', $breadcrumb_tags);
define('IHS_PAGE_NAME', __e("Enqueue Styles"));
define('IHS_PAGE_DESC', __e("Enqueue styles for the front-end and back-end"));

?>