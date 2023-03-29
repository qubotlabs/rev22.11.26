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


// TODO: ACTION --|-- SAVE --|-- ROLES

if (isset($_POST['submit']))
{
    $postData['roles']['name'] = "";
    $postData['roles']['display-name'] = "";
    $postData['roles']['capabilities'] = "";


    if (isset($_POST['roles']['name']))
    {
        $postData['roles']['name'] = $_POST['roles']['name'];
    }

    if (isset($_GET['n']))
    {
        $postData['roles']['name'] = $_GET['n'];
    }

    if (isset($_POST['roles']['display-name']))
    {
        $postData['roles']['display-name'] = $_POST['roles']['display-name'];
    }

    if (isset($_POST['roles']['capabilities']))
    {
        $postData['roles']['capabilities'] = $_POST['roles']['capabilities'];
    }

    // validate and save postdata
    $db->saveRoles($postData['roles']);
    $db->current();
    $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Roles saved successfully!");

    if ($_GET["a"] == "edit")
    {
        header("Location: ./?p=roles&a=edit&alert=success&n=" . $_GET["n"] . "&" . time());
    } else
    {
        header("Location: ./?p=roles&a=list&alert=success&" . time());
    }
}


// TODO: ACTION --|-- REMOVE --|-- ROLES
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "trash")
    {
        $_prefix = basename($_GET["n"]);
        $db->removeRole($_prefix);
        $db->current();
        $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Roles deleted successfully!");
        header("Location: ./?p=roles&a=list&alert=warning&" . time());
    }
}


// TODO: LAYOUT --|-- GENERAL
$disabled = "";
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "edit")
    {
        $_prefix = basename($_GET["n"]);
        $currentData["roles"] = $db->getRole($_prefix);
        $disabled = "disabled";
    }
}


// TODO: LAYOUT --|-- GENERAL --|-- INIT
if (!isset($currentData['roles']['name']))
{
    $currentData['roles']['name'] = "my-role";
}
if (!isset($currentData['roles']['display-name']))
{
    $currentData['roles']['display-name'] = "";
}
if (!isset($currentData['roles']['capabilities']))
{
    $currentData['roles']['capabilities'] = "";
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
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/roles.php</code></p>';
$content_tags .= '<div class="callout callout-success"><h5>' . __e("Tips") . '</h5>' . __e("Roles will be added when you <strong>activate</strong> or <strong>deactivate</strong> your plugin") . '</div>';

// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="name" class="col-sm-3 col-form-label">' . __e("Role Name") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input ' . $disabled . ' type="text" name="roles[name]"  class="form-control" id="name" placeholder="custom-subscriber" value="' . $currentData['roles']['name'] . '">';
$content_tags .= '<p class="help-block">' . __e("Role name, only allowed: a-z characters and -") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- DISPLAY-NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="display-name" class="col-sm-3 col-form-label">' . __e("Display Name") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input type="text" name="roles[display-name]"  class="form-control" id="display-name" placeholder="Custom Subscriber" value="' . $currentData['roles']['display-name'] . '">';
$content_tags .= '<p class="help-block">' . __e("Display name for role") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- CAPABILITIES
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="capabilities" class="col-sm-3 col-form-label">' . __e("Capabilities") . '</label>';
$content_tags .= '<div class="col-sm-9">';


$content_tags .= '<div class="row">';

$content_tags .= '<div class="col-md-3">';
$content_tags .= '<a data-type="checked" data-reset=".capabilities" data-target=".subscriber" href="#!_" class="btn btn-xs btn-block btn-outline-primary btn-flat">' . __e("Subscriber Capabilities") . '</a>';
$content_tags .= '</div>';

$content_tags .= '<div class="col-md-3">';
$content_tags .= '<a data-type="checked" data-reset=".capabilities" data-target=".contributor" href="#!_" class="btn btn-xs btn-block btn-outline-primary btn-flat">' . __e("Contributor Capabilities") . '</a>';
$content_tags .= '</div>';

$content_tags .= '<div class="col-md-3">';
$content_tags .= '<a data-type="checked" data-reset=".capabilities" data-target=".author" href="#!_" class="btn btn-xs btn-block btn-outline-primary btn-flat">' . __e("Author Capabilities") . '</a>';
$content_tags .= '</div>';

$content_tags .= '<div class="col-md-3">';
$content_tags .= '<a  data-type="checked" data-reset=".capabilities" data-target=".editor" href="#!_" class="btn btn-xs btn-block btn-outline-primary btn-flat">' . __e("Editor Capabilities") . '</a>';
$content_tags .= '</div>';

$content_tags .= '</div>';

$content_tags .= '<br>';
$content_tags .= '<p>' . __e("Default Capabilities for this role") . ':</p>';
$content_tags .= '<br>';
$content_tags .= '<table class="table table-striped">';

foreach ($GLOBALS['DEFAULT_CAPS'] as $capability)
{
    $content_tags .= '<tr>';
    $content_tags .= '<td>';
    $checked = '';

    if (!isset($currentData['roles']['capabilities']))
    {
        $currentData['roles']['capabilities'] = array();
    }
    if (!is_array($currentData['roles']['capabilities']))
    {
        $currentData['roles']['capabilities'] = array();
    }
    foreach ($currentData['roles']['capabilities'] as $cap)
    {
        if ($cap == $capability['value'])
        {
            $checked = 'checked="checked"';
        }
    }
    if (!isset($capability['class']))
    {
        $capability['class'] = null;
    }
    $content_tags .= '<div class="form-group clearfix">';
    $content_tags .= '<div class="icheck-success d-inline">';
    $content_tags .= '<input class="capabilities ' . $capability['class'] . '" ' . $checked . ' id="capabilities-' . $capability['value'] . '" type="checkbox" name="roles[capabilities][' . $capability['value'] . ']" value="' . $capability['value'] . '"/>';
    $content_tags .= '<label for="capabilities-' . $capability['value'] . '"><code>' . $capability['value'] . '</code></label>';
    $content_tags .= '</div>';
    $content_tags .= '</div>';
    $content_tags .= '</td>';
    $content_tags .= '<td>';
    $content_tags .= '<i>' . $capability['desc'] . '</i>';
    $content_tags .= '</td>';
    $content_tags .= '</tr>';
}

$content_tags .= '</table>';


$content_tags .= '</div>';
$content_tags .= '</div>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != '')
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=roles" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=roles" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
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
$content_tags .= __e("Sample Code and References");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- INSTRUCTIONS
$content_tags .= '<div class="card-body">';

$content_tags .= '<div class="callout callout-success">';
$content_tags .= __e('These instructions are dynamic according to the conditions of the project being worked on');
$content_tags .= '</div>';

$example_code = null;
$example_code .= "" . '<?php' . "\r\n";
$example_code .= "" . '// Get the user object' . "\r\n";
$example_code .= "" . '$user = get_userdata($user_id);' . "\r\n";
$example_code .= "" . '// Get all the user roles as an array' . "\r\n";
$example_code .= "" . '$user_roles = $user->roles;' . "\r\n";
$example_code .= "" . '// // Check if the role is present in the array' . "\r\n";
$example_code .= "" . 'if(in_array("' . $string->toVar($project['short-name'] . '_' . $currentData['roles']['name']) . '",$user_roles,true)){' . "\r\n";
$example_code .= "\t" . '// Do something' . "\r\n";
$example_code .= "" . '}' . "\r\n";
$content_tags .= '<h3>' . __e("Get User Role") . '</h3>';
$content_tags .= '<div class="example-code">';
$content_tags .= highlight_string($example_code, true);
$content_tags .= '</div>';

$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<h5>' . __e("Code References") . ':</h5>';
$content_tags .= '<ul>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/add_role/">add_role</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/get_userdata/">get_userdata</a>' . '</p></li>';
$content_tags .= '</ul>';
$content_tags .= '</div>';

$content_tags .= '</div>'; //card-body
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != '')
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=roles" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=roles" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
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
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=roles">' . __e("Roles") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("List") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags .= '<div class="card card-outline card-info">';
        $_content_tags .= '<div class="card-body">';

        $_content_tags .= '<div class="welcome">';
        $_content_tags .= '<h2>' . __e('User Capabilities') . '</h2>';
        $_content_tags .= '<h1>' . __e('Roles and Capabilities') . '</h1>';
        $_content_tags .= '<p class="lead">' . __e('WordPress uses a concept of Roles, designed to give the site owner the ability to control what users can and cannot do within the site') . '</p>';
        $_content_tags .= '</div>';

        // TODO: LIST --|-- TABLE
        $_content_tags .= '<table data-type="datatable" class="table datatable table-bordered">';
        $_content_tags .= '<thead>';
        $_content_tags .= '<tr>';
        $_content_tags .= '<th>' . __e("Name") . '</th>';
        $_content_tags .= '<th>' . __e("Display Name") . '</th>';
        $_content_tags .= '<th>' . __e("Capabilities") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Action") . '</th>';
        $_content_tags .= '</tr>';
        $_content_tags .= '</thead>';
        $_content_tags .= '<tbody>';
        $roles = $db->getRoles();
        foreach ($roles as $role)
        {
            $new_cap = array();
            if (!isset($role['capabilities']))
            {
                $role['capabilities'] = array();
            }
            if (!is_array($role['capabilities']))
            {
                $role['capabilities'] = array();
            }
            foreach ($role['capabilities'] as $cap)
            {
                $new_cap[] = '<span class="badge badge-success">' . $cap . '</span>';
            }
            $_content_tags .= '<tr>';
            $_content_tags .= '<td><code>' . $string->toVar($project['short-name'] . '_' . $role['name']) . '</code></td>';
            $_content_tags .= '<td>' . $role['display-name'] . '</td>';
            $_content_tags .= '<td>' . implode(' ', $new_cap) . '</td>';
            $_content_tags .= '<td class="text-center align-middle">';
            $_content_tags .= '<div class="btn-group btn-group-sm">';
            $_content_tags .= '<a href="#' . $role['name'] . '" data-toggle="modal" data-target="#modal-trash-roles-' . $role['name'] . '" data-href="./?p=roles&amp;a=trash&amp;n=' . $role['name'] . '" class="btn btn-danger"><i class="fa fa-trash"></i> ' . __e("Trash") . '</a>';
            $_content_tags .= '<a href="./?p=roles&amp;a=edit&amp;n=' . $role['name'] . '" class="btn btn-success"><i class="fa fa-edit"></i> ' . __e("Edit") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</td>';
            $_content_tags .= '</tr>';
        }
        $_content_tags .= '</tbody>';
        $_content_tags .= '</table>';
        $_content_tags .= '</div>';
        $_content_tags .= '<div class="card-footer">';
        $_content_tags .= '<a href="./?p=roles&amp;a=new" class="btn btn-success"><i class="fa fa-plus-circle"></i> ' . __e("Add New Roles") . '</a>';
        $_content_tags .= '</div>';
        $_content_tags .= '</div>';
        // TODO: LIST --|-- MODAL
        foreach ($roles as $role)
        {
            $new_cap = array();
            if (!isset($role['capabilities']))
            {
                $role['capabilities'] = array();
            }
            if (!is_array($role['capabilities']))
            {
                $role['capabilities'] = array();
            }
            foreach ($role['capabilities'] as $cap)
            {
                $new_cap[] = '<span class="badge badge-success">' . $cap . '</span>';
            }

            $_content_tags .= '<div class="modal fade" id="modal-trash-roles-' . $role['name'] . '">';
            $_content_tags .= '<div class="modal-dialog">';
            $_content_tags .= '<div class="modal-content bg-default">';
            $_content_tags .= '<div class="modal-header">';
            $_content_tags .= '<h4 class="modal-title">' . __e("Confirm") . '</h4>';
            $_content_tags .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            $_content_tags .= '<span aria-hidden="true">&times;</span></button>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-body">';
            $_content_tags .= '<p>' . __e("Are you sure You want to delete this Roles?") . '</p>';
            $_content_tags .= '<table class="table-grid">';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td rowspan="3" style="text-align: center;"><i class="far fa-user trash-logo"></i></td>';
            $_content_tags .= '<td>' . __e("Name") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><code>' . $string->toVar($project['short-name'] . '_' . $role['name']) . '</code></td>';
            $_content_tags .= '</tr>';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Display Name") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td>' . $role['display-name'] . '</td>';
            $_content_tags .= '</tr>';

            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Capabilities") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td>' . implode(' ', $new_cap) . '</td>';
            $_content_tags .= '</tr>';

            $_content_tags .= '</table>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-footer justify-content-between">';
            $_content_tags .= '<button type="button" class="btn btn-default" data-dismiss="modal">' . __e("Close") . '</button>';
            $_content_tags .= '<a href="./?p=roles&amp;a=trash&amp;n=' . $role['name'] . '" class="btn btn-danger">' . __e("Yes, I am sure!") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
        }

        break;
    case "new":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=roles">' . __e("Roles") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("New") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
    case "edit":
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=roles">' . __e("Roles") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("Edit") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
}

define('IHS_LAYOUT_CONTENT', $_content_tags);
define('IHS_LAYOUT_BREADCRUMB', $breadcrumb_tags);
define('IHS_PAGE_NAME', '' . __e("Roles") . '');
define('IHS_PAGE_DESC', __e("Create a new user role"));

?>