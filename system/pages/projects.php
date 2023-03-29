<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2022
 * @package WP-Dev Tools
 * @license Commercial License
 */

defined('IHS_EXEC') or die('Silent is golden!');

$db = new DB();
if (isset($_POST['submit']))
{
    // validate and save postdata
    $db->saveProject($_POST['app']);
    $db->current();
    $new_project_name = __e('New Project');
    if (isset($_SESSION['CURRENT_PROJECT_DATA']['project']['project-name']))
    {
        $new_project_name = $_SESSION['CURRENT_PROJECT_DATA']['project']['project-name'] . ' ' . __e('Project');
    }
    $_SESSION['CURRENT_PROJECT_NOTICE'] = '`' . $new_project_name . '` ' . __e(' has been saved!');
    header('Location: ./?p=projects&a=list&alert=success&' . time());
}
$breadcrumb_tags = $content_tags = $_content_tags = null;
$current_project = $db->getProject();
if ($current_project != null)
{
    $currentData['app'] = $current_project;
}
if ($_GET['a'] == 'new')
{
    $currentData = null;
}
$content_tags .= '<form action="" method="post">';
$content_tags .= '<div class="row">';
// TODO: LAYOUT --|-- GENERAL
if (!isset($currentData['app']['project-name']))
{
    $currentData['app']['project-name'] = "";
}
if (!isset($currentData['app']['short-name']))
{
    $currentData['app']['short-name'] = "";
}
if (!isset($currentData['app']['project-url']))
{
    $currentData['app']['project-url'] = "";
}
if (!isset($currentData['app']['description']))
{
    $currentData['app']['description'] = "";
}
if (!isset($currentData['app']['tags']))
{
    $currentData['app']['tags'] = "";
}
if (!isset($currentData['app']['version']))
{
    $currentData['app']['version'] = "1.0.1";
}

if (!isset($currentData['app']['debugger']))
{
    $currentData['app']['debugger'] = false;
}

if (!isset($currentData['app']['show-file-line']))
{
    $currentData['app']['show-file-line'] = false;
}


$content_tags .= '<div class="col-md-6">';
$content_tags .= '<div class="card card-outline card-info">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-th"></i>&nbsp;';
$content_tags .= 'General';
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>&nbsp;';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- GENERAL --|-- FORM
$content_tags .= '<div class="card-body">';
if ($current_project != null)
{
    $readonly = 'readonly';
} else
{
    $readonly = null;
}
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- PROJECT-NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="project-name" class="col-sm-3 col-form-label">' . __e("Project Name") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input ' . $readonly . ' required type="text" name="app[project-name]" class="form-control" id="project-name" placeholder="My Private Plugin" value="' . $currentData['app']['project-name'] . '">';
$content_tags .= '<p class="help-block">' . __e("A nice name, only allowed: a-z characters and space") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- SHORT-NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="short-name" class="col-sm-3 col-form-label">' . __e("Short Name") . '</label>';
$content_tags .= '<div class="col-sm-5">';
$content_tags .= '<input required type="text" name="app[short-name]"  maxlength="3"  class="form-control" id="short-name" placeholder="MPP" value="' . $currentData['app']['short-name'] . '">';
$content_tags .= '<p class="help-block">' . __e("The name of the plugin is written with 3 characters") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- PROJECT-URL
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="project-url" class="col-sm-3 col-form-label">' . __e("Project URL") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<input required type="url" name="app[project-url]"  class="form-control" id="project-url" placeholder="https://ihsana.com/my-plugin" value="' . $currentData['app']['project-url'] . '">';
$content_tags .= '<p class="help-block">' . __e("Your plugin provider website") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- SHORT DESCRIPTION
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="description" class="col-sm-3 col-form-label">' . __e("Short Description") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<textarea required class="form-control" name="app[description]" maxlength="150">' . htmlentities($currentData['app']['description']) . '</textarea>';
$content_tags .= '<p class="help-block">' . __e("Write a short description of your plugin") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- TAGS
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="tags" class="col-sm-3 col-form-label">' . __e("Tags") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<input required type="text" name="app[tags]" data-type="tags" class="form-control" id="tags" placeholder="analytics, statistics, stats" value="' . $currentData['app']['tags'] . '">';
$content_tags .= '<p class="help-block">' . __e("Each word is separated by a comma") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- VERSION
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="version" class="col-sm-3 col-form-label">' . __e("Version") . '</label>';
$content_tags .= '<div class="col-sm-5">';
$content_tags .= '<input required type="text" name="app[version]"  class="form-control" id="version" placeholder="1.0.1" value="' . $currentData['app']['version'] . '">';
$content_tags .= '<p class="help-block">' . __e("Version of the plugin to be made") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

$content_tags .= '</div>';
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-flat btn-info"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


// TODO: LAYOUT --|-- DEBUGGER --|-- FORM --|--

$content_tags .= '<div class="card card-outline card-primary">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-bug"></i>&nbsp;';
$content_tags .= __e('Debugger');
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>&nbsp;';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- GENERAL --|-- FORM
$content_tags .= '<div class="card-body">';

$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="project-enable" class="col-sm-3 col-form-label">' . __e("Debug Code") . '</label>';
$content_tags .= '<div class="col-sm-9">';
if ($currentData['app']['debugger'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="app[debugger]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="app[debugger]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("Help find files and lines of code on the front page") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="project-enable" class="col-sm-3 col-form-label">' . __e("Displays files and lines of code") . '</label>';
$content_tags .= '<div class="col-sm-9">';
if ($currentData['app']['show-file-line'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="app[show-file-line]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="app[show-file-line]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("Unchecked for distribution") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


$content_tags .= '</div>';
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-flat btn-primary"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


$content_tags .= '</div>'; //col-md-6
// TODO: LAYOUT --|-- GENERAL
// TODO: LAYOUT --|-- AUTHOR
if (!isset($currentData['app']['author-name']))
{
    $currentData['app']['author-name'] = "";
}
if (!isset($currentData['app']['author-url']))
{
    $currentData['app']['author-url'] = "";
}
if (!isset($currentData['app']['license']))
{
    $currentData['app']['license'] = "GNU General Public License v2 or later";
}
if (!isset($currentData['app']['license-url']))
{
    $currentData['app']['license-url'] = "https://www.gnu.org/licenses/gpl-2.0.html";
}
$content_tags .= '<div class="col-md-6">';
$content_tags .= '<div class="card card-outline card-danger">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-user"></i>&nbsp;';
$content_tags .= 'Author';
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- AUTHOR --|-- FORM
$content_tags .= '<div class="card-body">';
// TODO: LAYOUT --|-- AUTHOR --|-- FORM --|-- AUTHOR-NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="author-name" class="col-sm-3 col-form-label">' . __e("Author") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input required type="text" name="app[author-name]"  class="form-control" id="author-name" placeholder="JasmanXcrew" value="' . $currentData['app']['author-name'] . '">';
$content_tags .= '<p class="help-block">' . __e("Write the name of the plugin owner") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- AUTHOR --|-- FORM --|-- AUTHOR-URL
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="author-url" class="col-sm-3 col-form-label">' . __e("Author URL") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<input required type="text" name="app[author-url]" class="form-control" id="author-url" placeholder="https://facebook.com/jasmanxcrew" value="' . $currentData['app']['author-url'] . '">';
$content_tags .= '<p class="help-block">' . __e("Write the author's website") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- AUTHOR --|-- FORM --|-- LICENSE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="license" class="col-sm-3 col-form-label">' . __e("License") . '</label>';
$content_tags .= '<div class="col-sm-7">';
$content_tags .= '<input required type="text" name="app[license]"  class="form-control" id="license" placeholder="GNU General Public License v2 or later" value="' . $currentData['app']['license'] . '">';
$content_tags .= '<p class="help-block">' . __e("Write a plugin license") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- AUTHOR --|-- FORM --|-- LICENSE-URL
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="license-url" class="col-sm-3 col-form-label">' . __e("License URL") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<input required type="url" name="app[license-url]"  class="form-control" id="license-url" placeholder="http://www.gnu.org/licenses/gpl-2.0.html" value="' . $currentData['app']['license-url'] . '">';
$content_tags .= '<p class="help-block">' . __e("Write a plugin license url") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
$content_tags .= '</div>';
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-flat btn-danger"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


// TODO: LAYOUT --|-- OTHERS
if (!isset($currentData['app']['contributors']))
{
    $currentData['app']['contributors'] = "";
}
if (!isset($currentData['app']['donate-link']))
{
    $currentData['app']['donate-link'] = "";
}

$content_tags .= '<div class="card card-outline card-success">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-th"></i>&nbsp;';
$content_tags .= 'Others';
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- OTHER --|-- FORM
$content_tags .= '<div class="card-body">';

// TODO: LAYOUT --|-- OTHER --|-- FORM --|-- CONTRIBUTORS
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="contributors" class="col-sm-3 col-form-label">' . __e("Contributors") . '</label>';
$content_tags .= '<div class="col-sm-7">';
$content_tags .= '<input type="text" name="app[contributors]"  class="form-control" id="contributors" placeholder="" value="' . $currentData['app']['contributors'] . '">';
$content_tags .= '<p class="help-block">' . __e("Comma separated list of WordPress.org usernames") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- OTHER --|-- FORM --|-- DONATE-LINK
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="donate-link" class="col-sm-3 col-form-label">' . __e("Donate Link") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<input type="url" name="app[donate-link]"  class="form-control" id="donate-link" placeholder="" value="' . $currentData['app']['donate-link'] . '">';
$content_tags .= '<p class="help-block">' . __e("The link to your donations page") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


$content_tags .= '</div>';

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-success btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


$content_tags .= '</div>'; //col-md-6

$content_tags .= '</div>'; //row
$content_tags .= '</form>'; //form


switch ($_GET['a'])
{
        // TODO: LAYOUT --|-- LIST
    case 'list':
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=projects">' . __e("Projects") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("List") . '</li>';
        $breadcrumb_tags .= '</ol>';
        $projects = $db->getProjects();
        $_content_tags .= '<div class="card card-outline card-primary">';
        $_content_tags .= '<div class="card-body">';
        $_content_tags .= '<div class="welcome">';
        $_content_tags .= '<h2>' . __e("Welcome to") . '</h2>';
        $_content_tags .= '<h1>' . IHS_APP_NAME . '</h1>';
        $_content_tags .= '<p class="lead">Tools from Ihsana for developing your own WordPress Plugin<br> with/without coding</p>';
        $_content_tags .= '</div>';
        $_content_tags .= '<div class="row">';
        $_content_tags .= '<div class="col-lg-3 col-6">';
        $_content_tags .= '<div class="small-box bg-default">';
        $_content_tags .= '<div class="inner">';
        $_content_tags .= '<h3>' . __e("Add Project") . '</h3>';
        $_content_tags .= '<p>' . __e("create an App") . '</p>';
        $_content_tags .= '</div>';
        $_content_tags .= '<div class="icon">';
        $_content_tags .= '<i class="fas fa-plus-circle"></i>';
        $_content_tags .= '</div>';
        $_content_tags .= '<a href="./?p=projects&amp;a=start" class="small-box-footer">' . __e("Get Started") . ' <i class="fas fa-arrow-circle-right"></i></a>';
        $_content_tags .= '</div>';
        $_content_tags .= '</div>';
        $colors[] = 'maroon';
        $colors[] = 'lightblue';
        $colors[] = 'purple';
        $colors[] = 'success';
        $colors[] = 'fuchsia';
        $colors[] = 'primary';
        $colors[] = 'info';
        $z = 0;
        foreach ($projects as $project)
        {
            $_content_tags .= '<div class="col-lg-3 col-6">';
            $_content_tags .= '<div class="small-box bg-' . $colors[$z] . '">';
            $_content_tags .= '<div class="inner">';
            $_content_tags .= '<h3>' . htmlentities($project['short-name']) . '</h3>';
            $_content_tags .= '<p>' . htmlentities($project['project-name']) . '</p>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="icon">';
            $_content_tags .= '<i class="fab fa-wordpress-simple"></i>';
            $_content_tags .= '</div>';
            if (isset($_SESSION['CURRENT_PROJECT_PREFIX']))
            {
                $current_project = $_SESSION['CURRENT_PROJECT_PREFIX'];
            } else
            {
                $current_project = null;
            }
            if ($current_project == $project['prefix'])
            {
                $_content_tags .= '<div class="small-box-footer">';
                $_content_tags .= '<a href="./?p=projects&amp;a=edit" class="btn btn-xs"><i class="fas fa-pencil-alt"></i> ' . __e("Edit") . ' </a>&nbsp;&nbsp;';
                $_content_tags .= '<a data-toggle="modal" data-target="#modal-trash-project-' . htmlentities($project['prefix']) . '" data-href="./?p=projects&amp;a=trash" class="btn btn-xs"><i class="fas fa-trash"></i> ' . __e("Delete") . ' </a>';
                $_content_tags .= '</div>';
            } else
            {
                $_content_tags .= '<div class="small-box-footer">';
                $_content_tags .= '<a href="./?p=projects&amp;a=active&amp;n=' . htmlentities($project['prefix']) . '" class="btn btn-xs">' . __e("Activate") . ' <i class="fas fa-arrow-circle-right"></i></a>';
                $_content_tags .= '</div>';
            }
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';


            $_content_tags .= '<div class="modal fade" id="modal-trash-project-' . htmlentities($project['prefix']) . '">';
            $_content_tags .= '<div class="modal-dialog">';
            $_content_tags .= '<div class="modal-content bg-danger">';
            $_content_tags .= '<div class="modal-header">';
            $_content_tags .= '<h4 class="modal-title">' . __e("Confirm") . '</h4>';
            $_content_tags .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            $_content_tags .= '<span aria-hidden="true">&times;</span></button>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-body">';
            $_content_tags .= '<p>' . __e("Are you sure You want to delete this project?") . '</p>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-footer justify-content-between">';
            $_content_tags .= '<button type="button" class="btn btn-outline-light" data-dismiss="modal">' . __e("Close") . '</button>';
            $_content_tags .= '<a href="./?p=projects&amp;a=trash" class="btn btn-outline-light">' . __e("Yes, I am sure!") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';


            $z++;
            if (count($colors) == $z)
            {
                $z = 0;
            }
        }
        $_content_tags .= '</div>';
        $_content_tags .= '</div>'; //card-body
        $_content_tags .= '<div class="card-footer">';
        $_content_tags .= '<a href="./?p=projects&a=reset" class="float-right btn btn-flat btn-dark"><i class="fas fa-sync-alt"></i>&nbsp;' . __e("Reset Session") . '</a>';
        $_content_tags .= '</div>'; //card-footer
        $_content_tags .= '</div>'; //card
        break;
        // TODO: LAYOUT --|-- EDIT
    case 'edit':
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=projects">' . __e("Projects") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("Edit") . '</li>';
        $breadcrumb_tags .= '</ol>';
        $_content_tags = $content_tags;

        break;
    case 'new':
        // TODO: LAYOUT --|-- NEW
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=projects">' . __e("Projects") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("New") . '</li>';
        $breadcrumb_tags .= '</ol>';
        $_content_tags = $content_tags;
        break;
    case 'active':
        // TODO: LAYOUT --|-- ACTIVE
        $_SESSION['CURRENT_PROJECT_PREFIX'] = $_GET['n'];
        $db->current();
        $_SESSION['CURRENT_PROJECT_NOTICE'] = '`' . $_SESSION['CURRENT_PROJECT_DATA']['project']['project-name'] . '` ' . __e('project has been activated!');
        header('Location: ./?p=projects&a=list&alert=success&' . time());
        break;
    case 'reset':
        // TODO: LAYOUT --|-- RESET
        if (isset($_SESSION['CURRENT_PROJECT_PREFIX']))
        {
            unset($_SESSION['CURRENT_PROJECT_PREFIX']);
            unset($_SESSION['CURRENT_PROJECT_DATA']);
            session_destroy();
            session_start();
        }

        $_SESSION['CURRENT_PROJECT_NOTICE'] = __e('The session has been successfully reset, please activate one of the projects');
        header('Location: ./?p=projects&a=list&alert=warning&' . time());
        break;
    case 'start':
        // TODO: LAYOUT --|-- START
        if (isset($_SESSION['CURRENT_PROJECT_PREFIX']))
        {
            unset($_SESSION['CURRENT_PROJECT_PREFIX']);
            unset($_SESSION['CURRENT_PROJECT_DATA']);
            session_destroy();
        }
        header('Location: ./?p=projects&a=new&' . time());
        break;
    case 'trash':
        // TODO: LAYOUT --|-- TRASH
        $_SESSION['CURRENT_PROJECT_NOTICE'] = '`' . $_SESSION['CURRENT_PROJECT_DATA']['project']['project-name'] . '` ' . __e('project has been successfully deleted!');
        $db->deleteProject();
        header('Location: ./?p=projects&a=reset&alert=warning&' . time());
        break;
}


define('IHS_LAYOUT_CONTENT', $_content_tags);
define('IHS_LAYOUT_BREADCRUMB', $breadcrumb_tags);
define('IHS_PAGE_NAME', __e("Projects"));
define('IHS_PAGE_DESC', __e("Let's create or edit your project"));
