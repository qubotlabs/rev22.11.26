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

// TODO: ======================================================
// TODO: ACTION --|-- SAVE --|-- TAXONOMIES

if (isset($_POST['submit']))
{
    $postData['taxonomies']['name'] = "";
    $postData['taxonomies']['label'] = "";
    $postData['taxonomies']['note'] = "";

    if (isset($_POST['taxonomies']['name']))
    {
        $postData['taxonomies']['name'] = $_POST['taxonomies']['name'];
    }
    if (isset($_GET['n']))
    {
        $postData['taxonomies']['name'] = $_GET['n'];
    }
    if (isset($_POST['taxonomies']['label']))
    {
        $postData['taxonomies']['label'] = $_POST['taxonomies']['label'];
    }
    if (isset($_POST['taxonomies']['desc']))
    {
        $postData['taxonomies']['desc'] = $_POST['taxonomies']['desc'];
    }
    if (isset($_POST['taxonomies']['capabilities']))
    {
        $postData['taxonomies']['capabilities'] = $_POST['taxonomies']['capabilities'];
    }
    if (isset($_POST['taxonomies']['custom_capabilities']))
    {
        $postData['taxonomies']['custom_capabilities'] = true;
    } else
    {
        $postData['taxonomies']['custom_capabilities'] = false;
    }
    $postData['taxonomies']['label_for_singular_name'] = "Item";
    $postData['taxonomies']['label_for_search_items'] = "Search Items";
    $postData['taxonomies']['label_for_all_items'] = "All Items";
    $postData['taxonomies']['label_for_parent_item'] = "Parent item";
    $postData['taxonomies']['label_for_parent_item_colon'] = "Parent Item:";
    $postData['taxonomies']['label_for_edit_item'] = "Edit Item";
    $postData['taxonomies']['label_for_update_item'] = "Update Item";
    $postData['taxonomies']['label_for_add_new_item'] = "Add new Item";
    $postData['taxonomies']['label_for_new_item_name'] = "New Item Name";
    $postData['taxonomies']['label_for_menu_name'] = "Item";

    if (isset($_POST['taxonomies']['label_for_singular_name']))
    {
        $postData['taxonomies']['label_for_singular_name'] = $_POST['taxonomies']['label_for_singular_name'];
    }
    if (isset($_POST['taxonomies']['label_for_search_items']))
    {
        $postData['taxonomies']['label_for_search_items'] = $_POST['taxonomies']['label_for_search_items'];
    }
    if (isset($_POST['taxonomies']['label_for_all_items']))
    {
        $postData['taxonomies']['label_for_all_items'] = $_POST['taxonomies']['label_for_all_items'];
    }
    if (isset($_POST['taxonomies']['label_for_parent_item']))
    {
        $postData['taxonomies']['label_for_parent_item'] = $_POST['taxonomies']['label_for_parent_item'];
    }
    if (isset($_POST['taxonomies']['label_for_parent_item_colon']))
    {
        $postData['taxonomies']['label_for_parent_item_colon'] = $_POST['taxonomies']['label_for_parent_item_colon'];
    }
    if (isset($_POST['taxonomies']['label_for_edit_item']))
    {
        $postData['taxonomies']['label_for_edit_item'] = $_POST['taxonomies']['label_for_edit_item'];
    }
    if (isset($_POST['taxonomies']['label_for_update_item']))
    {
        $postData['taxonomies']['label_for_update_item'] = $_POST['taxonomies']['label_for_update_item'];
    }
    if (isset($_POST['taxonomies']['label_for_add_new_item']))
    {
        $postData['taxonomies']['label_for_add_new_item'] = $_POST['taxonomies']['label_for_add_new_item'];
    }
    if (isset($_POST['taxonomies']['label_for_new_item_name']))
    {
        $postData['taxonomies']['label_for_new_item_name'] = $_POST['taxonomies']['label_for_new_item_name'];
    }
    if (isset($_POST['taxonomies']['label_for_menu_name']))
    {
        $postData['taxonomies']['label_for_menu_name'] = $_POST['taxonomies']['label_for_menu_name'];
    }

    $postData['taxonomies']['default_term_name'] = "Unknow";
    $postData['taxonomies']['default_term_slug'] = "unknow";
    $postData['taxonomies']['default_term_description'] = "";

    if (isset($_POST['taxonomies']['default_term_name']))
    {
        $postData['taxonomies']['default_term_name'] = $_POST['taxonomies']['default_term_name'];
    }
    if (isset($_POST['taxonomies']['default_term_slug']))
    {
        $postData['taxonomies']['default_term_slug'] = $_POST['taxonomies']['default_term_slug'];
    }
    if (isset($_POST['taxonomies']['default_term_description']))
    {
        $postData['taxonomies']['default_term_description'] = $_POST['taxonomies']['default_term_description'];
    }

    $postData['taxonomies']['public'] = true;
    $postData['taxonomies']['publicly_queryable'] = true;
    $postData['taxonomies']['hierarchical'] = false;
    $postData['taxonomies']['show_ui'] = true;
    $postData['taxonomies']['show_in_menu'] = true;
    $postData['taxonomies']['show_in_nav_menus'] = true;
    $postData['taxonomies']['show_in_rest'] = true;
    $postData['taxonomies']['show_tagcloud'] = true;
    $postData['taxonomies']['show_in_quick_edit'] = true;
    $postData['taxonomies']['show_admin_column'] = false;

    if (isset($_POST['taxonomies']['public']))
    {
        $postData['taxonomies']['public'] = true;
    } else
    {
        $postData['taxonomies']['public'] = false;
    }
    if (isset($_POST['taxonomies']['publicly_queryable']))
    {
        $postData['taxonomies']['publicly_queryable'] = true;
    } else
    {
        $postData['taxonomies']['publicly_queryable'] = false;
    }
    if (isset($_POST['taxonomies']['hierarchical']))
    {
        $postData['taxonomies']['hierarchical'] = true;
    } else
    {
        $postData['taxonomies']['hierarchical'] = false;
    }
    if (isset($_POST['taxonomies']['show_ui']))
    {
        $postData['taxonomies']['show_ui'] = true;
    } else
    {
        $postData['taxonomies']['show_ui'] = false;
    }
    if (isset($_POST['taxonomies']['show_in_menu']))
    {
        $postData['taxonomies']['show_in_menu'] = true;
    } else
    {
        $postData['taxonomies']['show_in_menu'] = false;
    }
    if (isset($_POST['taxonomies']['show_in_nav_menus']))
    {
        $postData['taxonomies']['show_in_nav_menus'] = true;
    } else
    {
        $postData['taxonomies']['show_in_nav_menus'] = false;
    }
    if (isset($_POST['taxonomies']['show_in_rest']))
    {
        $postData['taxonomies']['show_in_rest'] = true;
    } else
    {
        $postData['taxonomies']['show_in_rest'] = false;
    }
    if (isset($_POST['taxonomies']['show_tagcloud']))
    {
        $postData['taxonomies']['show_tagcloud'] = true;
    } else
    {
        $postData['taxonomies']['show_tagcloud'] = false;
    }
    if (isset($_POST['taxonomies']['show_in_quick_edit']))
    {
        $postData['taxonomies']['show_in_quick_edit'] = true;
    } else
    {
        $postData['taxonomies']['show_in_quick_edit'] = false;
    }
    if (isset($_POST['taxonomies']['show_admin_column']))
    {
        $postData['taxonomies']['show_admin_column'] = true;
    } else
    {
        $postData['taxonomies']['show_admin_column'] = false;
    }

    if (isset($_POST['taxonomies']['add-to']))
    {
        $z = 0;
        foreach ($_POST['taxonomies']['add-to'] as $postdata)
        {
            $postData['taxonomies']['add_to'][$z] = $postdata;
            $z++;
        }
    } else
    {
        $postData['taxonomies']['add_to'] = array();
    }

    // validate and save postdata
    $db->saveTaxonomies($postData['taxonomies']);
    $db->current();
    $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Taxonomies saved successfully!");
    if ($_GET["a"] == "edit")
    {
        header("Location: ./?p=taxonomies&a=edit&alert=success&n=" . $_GET["n"] . "&" . time());
    } else
    {
        header("Location: ./?p=taxonomies&a=list&alert=success&" . time());
    }
}

// TODO: ======================================================
// TODO: ACTION --|-- REMOVE --|-- TAXONOMIES
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "trash")
    {
        $_prefix = basename($_GET["n"]);
        $db->removeTaxonomy($_prefix);
        $db->current();
        $_SESSION["CURRENT_PROJECT_NOTICE"] = __e("Taxonomy deleted successfully!");
        header("Location: ./?p=taxonomies&a=list&alert=warning&" . time());
    }
}


// TODO: LAYOUT --|-- GENERAL
$disabled = "";
if (isset($_GET["n"]))
{
    if ($_GET["a"] == "edit")
    {
        $_prefix = basename($_GET["n"]);
        $currentData["taxonomies"] = $db->getTaxonomy($_prefix);
        $disabled = "disabled";
    }
}


// TODO: LAYOUT --|-- GENERAL --|-- INIT
if (!isset($currentData['taxonomies']['name']))
{
    $currentData['taxonomies']['name'] = "";
}
if (!isset($currentData['taxonomies']['label']))
{
    $currentData['taxonomies']['label'] = "";
}
if (!isset($currentData['taxonomies']['desc']))
{
    $currentData['taxonomies']['desc'] = "";
}
// TODO: LAYOUT --|-- LABELS --|-- INIT
if (!isset($currentData['taxonomies']['label_for_singular_name']))
{
    $currentData['taxonomies']['label_for_singular_name'] = "Item";
}
if (!isset($currentData['taxonomies']['label_for_search_items']))
{
    $currentData['taxonomies']['label_for_search_items'] = "Search Items";
}
if (!isset($currentData['taxonomies']['label_for_all_items']))
{
    $currentData['taxonomies']['label_for_all_items'] = "All Items";
}
if (!isset($currentData['taxonomies']['label_for_parent_item']))
{
    $currentData['taxonomies']['label_for_parent_item'] = "Parent item";
}
if (!isset($currentData['taxonomies']['label_for_parent_item_colon']))
{
    $currentData['taxonomies']['label_for_parent_item_colon'] = "Parent Item:";
}
if (!isset($currentData['taxonomies']['label_for_edit_item']))
{
    $currentData['taxonomies']['label_for_edit_item'] = "Edit Item";
}
if (!isset($currentData['taxonomies']['label_for_update_item']))
{
    $currentData['taxonomies']['label_for_update_item'] = "Update Item";
}
if (!isset($currentData['taxonomies']['label_for_add_new_item']))
{
    $currentData['taxonomies']['label_for_add_new_item'] = "Add new Item";
}
if (!isset($currentData['taxonomies']['label_for_new_item_name']))
{
    $currentData['taxonomies']['label_for_new_item_name'] = "New Item Name";
}
if (!isset($currentData['taxonomies']['label_for_menu_name']))
{
    $currentData['taxonomies']['label_for_menu_name'] = "Item";
}


// TODO: LAYOUT --|-- DEFAULT TERM --|-- INIT
if (!isset($currentData['taxonomies']['default_term_name']))
{
    $currentData['taxonomies']['default_term_name'] = "Unknow";
}
if (!isset($currentData['taxonomies']['default_term_slug']))
{
    $currentData['taxonomies']['default_term_slug'] = "unknow";
}
if (!isset($currentData['taxonomies']['default_term_description']))
{
    $currentData['taxonomies']['default_term_description'] = "";
}


// TODO: LAYOUT --|-- OPTIONS --|-- INIT
if (!isset($currentData['taxonomies']['public']))
{
    $currentData['taxonomies']['public'] = true;
}
if (!isset($currentData['taxonomies']['publicly_queryable']))
{
    $currentData['taxonomies']['publicly_queryable'] = true;
}
if (!isset($currentData['taxonomies']['hierarchical']))
{
    $currentData['taxonomies']['hierarchical'] = false;
}
if (!isset($currentData['taxonomies']['show_ui']))
{
    $currentData['taxonomies']['show_ui'] = true;
}
if (!isset($currentData['taxonomies']['show_in_menu']))
{
    $currentData['taxonomies']['show_in_menu'] = true;
}
if (!isset($currentData['taxonomies']['show_in_nav_menus']))
{
    $currentData['taxonomies']['show_in_nav_menus'] = true;
}
if (!isset($currentData['taxonomies']['show_in_rest']))
{
    $currentData['taxonomies']['show_in_rest'] = true;
}
if (!isset($currentData['taxonomies']['show_tagcloud']))
{
    $currentData['taxonomies']['show_tagcloud'] = true;
}
if (!isset($currentData['taxonomies']['show_in_quick_edit']))
{
    $currentData['taxonomies']['show_in_quick_edit'] = true;
}
if (!isset($currentData['taxonomies']['show_admin_column']))
{
    $currentData['taxonomies']['show_admin_column'] = false;
}
if (!isset($currentData['taxonomies']['custom_capabilities']))
{
    $currentData['taxonomies']['custom_capabilities'] = false;
}

if (!isset($currentData['taxonomies']['add_to']))
{
    $currentData['taxonomies']['add_to'] = array();
}

// TODO: ======================================================
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
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/taxonomies.php</code></p>';
$content_tags .= '<hr/>';
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="name" class="col-sm-3 col-form-label">' . __e("Taxonomy Name") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input ' . $disabled . ' type="text" name="taxonomies[name]"  class="form-control" id="name" placeholder="tags" value="' . $currentData['taxonomies']['name'] . '">';
$content_tags .= '<p class="help-block">' . __e("Taxonomy Name is used as key, must not exceed 20 characters and may only contain a-z, 0-9, and - characters") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- LABEL
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label" class="col-sm-3 col-form-label">' . __e("Label") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input type="text" name="taxonomies[label]"  class="form-control" id="label" placeholder="Tags" value="' . $currentData['taxonomies']['label'] . '">';
$content_tags .= '<p class="help-block">' . __e("Name of the Taxonomies shown in the menu, Usually plural") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- DESC
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="desc" class="col-sm-3 col-form-label">' . __e("Description") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<textarea class="form-control" name="taxonomies[desc]" >' . $currentData['taxonomies']['desc'] . '</textarea>';
$content_tags .= '<p class="help-block">' . __e("A short descriptive summary of what the taxonomy is for") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


$post_defaults[] = array('name' => 'post', 'label' => 'Post');
$post_defaults[] = array('name' => 'page', 'label' => 'Page');
$post_defaults[] = array('name' => 'attachment', 'label' => 'Attachment');
$post_defaults[] = array('name' => 'revision', 'label' => 'Revision');
$post_defaults[] = array('name' => 'nav_menu_item', 'label' => 'Nav Menu Item');

// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- ADD-TO
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="desc" class="col-sm-3 col-form-label">' . __e("Add to Post Types?") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<p>' . __e("Adding Custom Taxonomy to WordPress default Post type") . '</p>';
$content_tags .= '<table class="table table-striped">';

foreach ($post_defaults as $post_default)
{
    $checked = '';
    foreach ($currentData['taxonomies']['add_to'] as $addTo)
    {
        if ($addTo == $post_default['name'])
        {
            $checked = 'checked="checked"';
        }
    }

    $content_tags .= '<tr>';
    $content_tags .= '<td>';
    $content_tags .= '<div class="form-group clearfix">';
    $content_tags .= '<div class="icheck-success d-inline">';

    $content_tags .= '<input ' . $checked . '  id="add-to-' . $post_default['name'] . '" type="checkbox" name="taxonomies[add-to][]" value="' . $post_default['name'] . '"/>';

    $content_tags .= '<label for="add-to-' . $post_default['name'] . '"><code>' . $post_default['label'] . '</code></label>';
    $content_tags .= '</div>';
    $content_tags .= '</div>';
    $content_tags .= '</td>';
    $content_tags .= '</tr>';
}


$content_tags .= '</table>';
$content_tags .= '<p>' . __e("You can add taxonomies to custom posts on the <a href='./'>Custom Posts</a> Page") . '</p>';

$content_tags .= '</div>';
$content_tags .= '</div>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != '')
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=taxonomies" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=taxonomies" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card

// TODO: ======================================================
$content_tags .= '<div class="card card-outline card-secondary">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-th"></i>&nbsp;';
$content_tags .= __e("Options");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- OPTIONS --|-- FORM
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/taxonomies.php</code></p>';
$content_tags .= '<hr/>';
// TODO: LAYOUT --|-- OPTIONS --|-- FORM --|-- PUBLIC
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="public" class="col-sm-3 col-form-label">' . __e("Public") . '</label>';
$content_tags .= '<div class="col-sm-9">';
if ($currentData['taxonomies']['public'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="taxonomies[public]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="taxonomies[public]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("Whether a taxonomy is intended for use publicly either via the admin interface or by front-end users") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- OPTIONS --|-- FORM --|-- PUBLICLY_QUERYABLE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="publicly_queryable" class="col-sm-3 col-form-label">' . __e("Publicly Queryable") . '</label>';
$content_tags .= '<div class="col-sm-9">';
if ($currentData['taxonomies']['publicly_queryable'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="taxonomies[publicly_queryable]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="taxonomies[publicly_queryable]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("Whether the taxonomy is publicly queryable") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- OPTIONS --|-- FORM --|-- HIERARCHICAL
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="hierarchical" class="col-sm-3 col-form-label">' . __e("Hierarchical") . '</label>';
$content_tags .= '<div class="col-sm-9">';
if ($currentData['taxonomies']['hierarchical'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="taxonomies[hierarchical]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="taxonomies[hierarchical]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("Whether the taxonomy is hierarchical, eg: <code>parent</code> or <code>children</code>") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- OPTIONS --|-- FORM --|-- SHOW_UI
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="show_ui" class="col-sm-3 col-form-label">' . __e("Show UI") . '</label>';
$content_tags .= '<div class="col-sm-9">';
if ($currentData['taxonomies']['show_ui'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="taxonomies[show_ui]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="taxonomies[show_ui]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("Whether to generate and allow a UI for managing terms in this taxonomy in the admin") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- OPTIONS --|-- FORM --|-- SHOW_IN_MENU
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="show_in_menu" class="col-sm-3 col-form-label">' . __e("Show In Menu") . '</label>';
$content_tags .= '<div class="col-sm-9">';
if ($currentData['taxonomies']['show_in_menu'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="taxonomies[show_in_menu]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="taxonomies[show_in_menu]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("Whether to show the taxonomy in the admin menu") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- OPTIONS --|-- FORM --|-- SHOW_IN_NAV_MENUS
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="show_in_nav_menus" class="col-sm-3 col-form-label">' . __e("Show In Nav Menus") . '</label>';
$content_tags .= '<div class="col-sm-9">';
if ($currentData['taxonomies']['show_in_nav_menus'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="taxonomies[show_in_nav_menus]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="taxonomies[show_in_nav_menus]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("Makes this taxonomy available for selection in navigation menus") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- OPTIONS --|-- FORM --|-- SHOW_IN_REST
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="show_in_rest" class="col-sm-3 col-form-label">' . __e("Show In REST-API") . '</label>';
$content_tags .= '<div class="col-sm-9">';
if ($currentData['taxonomies']['show_in_rest'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="taxonomies[show_in_rest]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="taxonomies[show_in_rest]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("Whether to include the taxonomy in the REST API") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- OPTIONS --|-- FORM --|-- SHOW_TAGCLOUD
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="show_tagcloud" class="col-sm-3 col-form-label">' . __e("Show Tagcloud") . '</label>';
$content_tags .= '<div class="col-sm-9">';
if ($currentData['taxonomies']['show_tagcloud'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="taxonomies[show_tagcloud]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="taxonomies[show_tagcloud]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("Whether to list the taxonomy in the Tag Cloud Widget controls") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- OPTIONS --|-- FORM --|-- SHOW_IN_QUICK_EDIT
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="show_in_quick_edit" class="col-sm-3 col-form-label">' . __e("Show In Quick Edit") . '</label>';
$content_tags .= '<div class="col-sm-9">';
if ($currentData['taxonomies']['show_in_quick_edit'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="taxonomies[show_in_quick_edit]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="taxonomies[show_in_quick_edit]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("Whether to show the taxonomy in the quick/bulk edit panel") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- OPTIONS --|-- FORM --|-- SHOW_ADMIN_COLUMN
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="show_admin_column" class="col-sm-3 col-form-label">' . __e("Show Admin Column") . '</label>';
$content_tags .= '<div class="col-sm-9">';
if ($currentData['taxonomies']['show_admin_column'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="taxonomies[show_admin_column]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="taxonomies[show_admin_column]" data-type="switch" data-off-color="danger" data-on-color="success"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("Whether to display a column for the taxonomy on its post type listing screens") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


$content_tags .= '</div>'; //card-body

$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-secondary btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != '')
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=taxonomies" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=taxonomies" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card

// TODO: ======================================================
// TODO: LAYOUT --|-- DEFAULT TERM --|--
$content_tags .= '<div class="card card-outline card-info">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-th"></i>&nbsp;';
$content_tags .= __e("Default Term");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- DEFAULT TERM --|-- FORM
$content_tags .= '<div class="card-body">';

$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/taxonomies.php</code></p>';
$content_tags .= '<hr/>';
// TODO: LAYOUT --|-- DEFAULT TERM --|-- FORM --|-- DEFAULT_TERM_NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="default_term_name" class="col-sm-3 col-form-label">' . __e("Name") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input type="text" name="taxonomies[default_term_name]"  class="form-control" id="default_term_name" placeholder="Unknow" value="' . $currentData['taxonomies']['default_term_name'] . '">';
$content_tags .= '<p class="help-block">' . __e("Default term name to be used for the taxonomy") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- DEFAULT TERM --|-- FORM --|-- DEFAULT_TERM_SLUG
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="default_term_slug" class="col-sm-3 col-form-label">' . __e("Slug") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input type="text" name="taxonomies[default_term_slug]"  class="form-control" id="default_term_slug" placeholder="unknow" value="' . $currentData['taxonomies']['default_term_slug'] . '">';
$content_tags .= '<p class="help-block">' . __e("Default term slug to be used for the taxonomy") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- DEFAULT TERM --|-- FORM --|-- DEFAULT_TERM_DESCRIPTION
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="default_term_description" class="col-sm-3 col-form-label">' . __e("Description") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<textarea class="form-control" name="taxonomies[default_term_description]" >' . $currentData['taxonomies']['default_term_description'] . '</textarea>';
$content_tags .= '<p class="help-block">' . __e("Default term description to be used for the taxonomy") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


$content_tags .= '</div>'; //card-body
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-info btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != '')
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=taxonomies" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=taxonomies" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


$content_tags .= '</div>'; //col-md-6


$content_tags .= '<div class="col-md-6">';
// TODO: ======================================================

$content_tags .= '<div class="card card-outline card-secondary">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-th"></i>&nbsp;';
$content_tags .= __e('Custom Capabilities');
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- CUSTOM CAPABILITIES --|-- FORM --|--
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/taxonomies.php</code></p>';
$content_tags .= '<hr/>';
$content_tags .= '<div class="form-group clearfix">';
$content_tags .= '<div class="icheck-info d-inline">';
if ($currentData['taxonomies']['custom_capabilities'] == true)
{
    $content_tags .= '<input id="taxonomies-custom-capabilities" type="checkbox" checked="checked" name="taxonomies[custom_capabilities]" />';
} else
{
    $content_tags .= '<input id="taxonomies-custom-capabilities" type="checkbox" name="taxonomies[custom_capabilities]" />';
}
$content_tags .= '<label for="taxonomies-custom-capabilities">' . __e("Enable Custom Capabilities") . '</label>';
$content_tags .= '</div>';
$content_tags .= '</div>';


$roles = $db->getRoles();
foreach ($roles as $role)
{
    $content_tags .= '<h5>' . $role['display-name'] . ' ' . __e("Role") . ' (<code>' . $string->toVar($project['short-name']) . '_' . $role['name'] . '</code>)</h5>';
    $content_tags .= '<div class="row">';
    foreach ($GLOBALS['TAXONOMIES_CAPS'] as $custom_cap)
    {
        $content_tags .= '<div class="col-md-3">';
        $content_tags .= '<div class="form-group clearfix">';
        $content_tags .= '<div class="icheck-info d-inline">';
        if (!isset($currentData['taxonomies']['capabilities'][$role['name']][$custom_cap['value']]))
        {
            $currentData['taxonomies']['capabilities'][$role['name']][$custom_cap['value']] = false;
        }
        $attr_classes = explode(" ", $custom_cap['class']);
        $new_attr_classes = array();
        foreach ($attr_classes as $attr_classe)
        {
            $new_attr_classes[] = $role['name'] . '-' . $attr_classe;
        }
        if ($currentData['taxonomies']['capabilities'][$role['name']][$custom_cap['value']] == true)
        {
            $content_tags .= '<input class="' . $role['name'] . '-capabilities ' . implode(' ', $new_attr_classes) . '" id="taxonomies-capabilities-' . $role['name'] . '-' . $custom_cap['value'] . '" type="checkbox" checked="checked" name="taxonomies[capabilities][' . $role['name'] . '][' . $custom_cap['value'] . ']" value="true" />';
        } else
        {
            $content_tags .= '<input class="' . $role['name'] . '-capabilities ' . implode(' ', $new_attr_classes) . '" id="taxonomies-capabilities-' . $role['name'] . '-' . $custom_cap['value'] . '" type="checkbox" name="taxonomies[capabilities][' . $role['name'] . '][' . $custom_cap['value'] . ']" value="false" />';
        }
        $content_tags .= '<label for="taxonomies-capabilities-' . $role['name'] . '-' . $custom_cap['value'] . '"><code>' . $custom_cap['value'] . '</code></label>';
        $content_tags .= '</div>';
        $content_tags .= '</div>';
        $content_tags .= '</div>';
    }
    $content_tags .= '</div>';
    $content_tags .= '<br/>';
}


$content_tags .= '</div>';
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-secondary btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != '')
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=taxonomies" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=taxonomies" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


// TODO: ======================================================
$content_tags .= '<div class="card card-outline card-danger">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-list"></i>&nbsp;';
$content_tags .= __e("Labels");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header

// TODO: LAYOUT --|-- LABELS
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/taxonomies.php</code></p>';
$content_tags .= '<hr/>';

$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-6">';
// TODO: LAYOUT --|-- LABELS --|-- FORM --|-- LABEL_FOR_SINGULAR_NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label_for_singular_name" class="col-sm-4 col-form-label">' . __e("Singular Name") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="taxonomies[label_for_singular_name]"  class="form-control" id="label_for_singular_name" placeholder="Genre" value="' . $currentData['taxonomies']['label_for_singular_name'] . '">';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- LABELS --|-- FORM --|-- LABEL_FOR_SEARCH_ITEMS
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label_for_search_items" class="col-sm-4 col-form-label">' . __e("Search Items") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="taxonomies[label_for_search_items]"  class="form-control" id="label_for_search_items" placeholder="Search Genres" value="' . $currentData['taxonomies']['label_for_search_items'] . '">';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- LABELS --|-- FORM --|-- LABEL_FOR_ALL_ITEMS
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label_for_all_items" class="col-sm-4 col-form-label">' . __e("All Items") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="taxonomies[label_for_all_items]"  class="form-control" id="label_for_all_items" placeholder="All Genres" value="' . $currentData['taxonomies']['label_for_all_items'] . '">';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- LABELS --|-- FORM --|-- LABEL_FOR_PARENT_ITEM
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label_for_parent_item" class="col-sm-4 col-form-label">' . __e("Parent item") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="taxonomies[label_for_parent_item]"  class="form-control" id="label_for_parent_item" placeholder="Parent Genre" value="' . $currentData['taxonomies']['label_for_parent_item'] . '">';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- LABELS --|-- FORM --|-- LABEL_FOR_PARENT_ITEM_COLON
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label_for_parent_item_colon" class="col-sm-4 col-form-label">' . __e("Parent Item Colon") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="taxonomies[label_for_parent_item_colon]"  class="form-control" id="label_for_parent_item_colon" placeholder="Parent Genre:" value="' . $currentData['taxonomies']['label_for_parent_item_colon'] . '">';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

$content_tags .= '</div>'; //col-md-6
$content_tags .= '<div class="col-md-6">';

// TODO: LAYOUT --|-- LABELS --|-- FORM --|-- LABEL_FOR_EDIT_ITEM
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label_for_edit_item" class="col-sm-4 col-form-label">' . __e("Edit Item") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="taxonomies[label_for_edit_item]"  class="form-control" id="label_for_edit_item" placeholder="Edit Genre" value="' . $currentData['taxonomies']['label_for_edit_item'] . '">';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- LABELS --|-- FORM --|-- LABEL_FOR_UPDATE_ITEM
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label_for_update_item" class="col-sm-4 col-form-label">' . __e("Update Item") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="taxonomies[label_for_update_item]"  class="form-control" id="label_for_update_item" placeholder="Update Genre" value="' . $currentData['taxonomies']['label_for_update_item'] . '">';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- LABELS --|-- FORM --|-- LABEL_FOR_ADD_NEW_ITEM
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label_for_add_new_item" class="col-sm-4 col-form-label">' . __e("Add new Item") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="taxonomies[label_for_add_new_item]"  class="form-control" id="label_for_add_new_item" placeholder="Add New Genre" value="' . $currentData['taxonomies']['label_for_add_new_item'] . '">';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- LABELS --|-- FORM --|-- LABEL_FOR_NEW_ITEM_NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label_for_new_item_name" class="col-sm-4 col-form-label">' . __e("New Item Name") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="taxonomies[label_for_new_item_name]"  class="form-control" id="label_for_new_item_name" placeholder="New Genre Name" value="' . $currentData['taxonomies']['label_for_new_item_name'] . '">';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- LABELS --|-- FORM --|-- LABEL_FOR_MENU_NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label_for_menu_name" class="col-sm-4 col-form-label">' . __e("Menu Name") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="taxonomies[label_for_menu_name]"  class="form-control" id="label_for_menu_name" placeholder="Genre" value="' . $currentData['taxonomies']['label_for_menu_name'] . '">';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

$content_tags .= '</div>'; //col-md-6
$content_tags .= '</div>'; //row


$content_tags .= '</div>'; //card-body
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != '')
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=taxonomies" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=taxonomies" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card

// TODO: ======================================================
$content_tags .= '<div class="card card-outline card-success">';
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

if ($currentData['taxonomies']['name'] != '')
{
    $example_name = $string->toVar($project['short-name'] . '_' . $currentData['taxonomies']['name']);
} else
{
    $example_name = $string->toVar($project['short-name'] . "_your_taxonomies");
}

$example_code = null;
$example_code .= "" . '<?php' . "\r\n";
$example_code .= "" . '' . "\r\n";
$example_code .= "" . '$terms = get_terms("' . $example_name . '", array(' . "\r\n";
$example_code .= "\t" . '"hide_empty" => false,' . "\r\n";
$example_code .= "" . '));' . "\r\n";
$example_code .= "" . '' . "\r\n";
$content_tags .= '<h3>' . __e("Retrieve the terms") . '</h3>';

$content_tags .= '<div class="example-code">';
$content_tags .= highlight_string($example_code, true);
$content_tags .= '</div>';

$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<h5>' . __e("Code References") . ':</h5>';
$content_tags .= '<ul>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/get_terms/">get_terms</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/get_term_meta/">get_term_meta</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/register_taxonomy/">register_taxonomy</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/get_role/">get_role</a>' . '</p></li>';
$content_tags .= '</ul>';
$content_tags .= '</div>';

$content_tags .= '</div>'; //card-body
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-success btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != '')
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=taxonomies" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=taxonomies" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


$content_tags .= '</div>'; //col-md-6
$content_tags .= '</div>'; //row
$content_tags .= '</form>';
// TODO: LAYOUT --|-- GENERAL


// TODO: LIST
switch ($_GET['a'])
{
    case 'list':
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=taxonomies">' . __e("Taxonomies") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("List") . '</li>';
        $breadcrumb_tags .= '</ol>';
        $_content_tags .= '<div class="card card-outline card-info">';
        $_content_tags .= '<div class="card-body">';
        $_content_tags .= '<div class="welcome">';
        $_content_tags .= '<h2>Grouping Posts</h2>';
        $_content_tags .= '<h1>Taxonomies</h1>';
        $_content_tags .= '<p class="lead">' . __e('A way of grouping posts together based on a select number of relationships') . '</p>';
        $_content_tags .= '</div>';
        // TODO: LIST --|-- TABLE
        $_content_tags .= '<table data-type="datatable" class="table datatable table-bordered">';
        $_content_tags .= '<thead>';
        $_content_tags .= '<tr>';
        $_content_tags .= '<th>' . __e("Name") . '</th>';
        $_content_tags .= '<th>' . __e("Label") . '</th>';
        $_content_tags .= '<th>' . __e("Description") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Public") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("RESTful API") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Action") . '</th>';
        $_content_tags .= '</tr>';
        $_content_tags .= '</thead>';
        $_content_tags .= '<tbody>';

        $taxonomies = $db->getTaxonomies();
        foreach ($taxonomies as $taxonomy)
        {
            $_content_tags .= '<tr>';
            $_content_tags .= '<td><code>' . $string->toVar($project['short-name'] . '_' . $taxonomy['name']) . '</code></td>';
            $_content_tags .= '<td>' . $taxonomy['label'] . '</td>';
            $_content_tags .= '<td><em>' . $taxonomy['desc'] . '</em></td>';
            if ($taxonomy['public'] == true)
            {
                $_content_tags .= '<td class="text-center"><span class="badge badge-success">' . __e("Yes") . '</span></td>';
            } else
            {
                $_content_tags .= '<td class="text-center"><span class="badge badge-info">' . __e("No") . '</span></td>';
            }

            if ($taxonomy['show_in_rest'] == true)
            {
                $_content_tags .= '<td class="text-center"><span class="badge badge-success">' . __e("Yes") . '</span></td>';
            } else
            {
                $_content_tags .= '<td class="text-center"><span class="badge badge-info">' . __e("No") . '</span></td>';
            }

            $_content_tags .= '<td class="text-center align-middle">';
            $_content_tags .= '<div class="btn-group btn-group-sm">';
            $_content_tags .= '<a href="#' . $taxonomy['name'] . '" data-toggle="modal" data-target="#modal-trash-taxonomies-' . $taxonomy['name'] . '" data-href="./?p=taxonomies&amp;a=trash&amp;n=' . $taxonomy['name'] . '" class="btn btn-danger"><i class="fa fa-trash"></i> ' . __e("Trash") . '</a>';
            $_content_tags .= '<a href="./?p=taxonomies&amp;a=edit&amp;n=' . $taxonomy['name'] . '" class="btn btn-success"><i class="fa fa-edit"></i> ' . __e("Edit") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</td>';
            $_content_tags .= '</tr>';
        }
        $_content_tags .= '</tbody>';
        $_content_tags .= '</table>';
        $_content_tags .= '</div>';
        $_content_tags .= '<div class="card-footer">';
        $_content_tags .= '<a href="./?p=taxonomies&amp;a=new" class="btn btn-success"><i class="fa fa-plus-circle"></i> ' . __e("Add New Taxonomies") . '</a>';
        $_content_tags .= '</div>';
        $_content_tags .= '</div>';
        // TODO: LIST --|-- MODAL
        foreach ($taxonomies as $taxonomy)
        {


            $_content_tags .= '<div class="modal fade" id="modal-trash-taxonomies-' . $taxonomy['name'] . '">';
            $_content_tags .= '<div class="modal-dialog">';
            $_content_tags .= '<div class="modal-content bg-default">';
            $_content_tags .= '<div class="modal-header">';
            $_content_tags .= '<h4 class="modal-title">' . __e("Confirm") . '</h4>';
            $_content_tags .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            $_content_tags .= '<span aria-hidden="true">&times;</span></button>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-body">';
            $_content_tags .= '<p>' . __e("Are you sure You want to delete this taxonomies?") . '</p>';
            $_content_tags .= '<table class="table-grid">';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td rowspan="4" style="text-align: center;"><i class="fa fa-tag trash-logo"></i></td>';
            $_content_tags .= '<td>' . __e("Name") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><code>' . $string->toVar($project['short-name'] . '_' . $taxonomy['name']) . '</code></td>';
            $_content_tags .= '</tr>';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Label") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td>' . $taxonomy['label'] . '</td>';
            $_content_tags .= '</tr>';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Description") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td>' . $taxonomy['desc'] . '</td>';
            $_content_tags .= '</tr>';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Public") . '</td>';
            $_content_tags .= '<td>:</td>';
            if ($taxonomy['public'] == true)
            {
                $_content_tags .= '<td><span class="badge badge-success">' . __e("Yes") . '</span></td>';
            } else
            {
                $_content_tags .= '<td><span class="badge badge-info">' . __e("No") . '</span></td>';
            }
            $_content_tags .= '</tr>';
            $_content_tags .= '</table>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-footer justify-content-between">';
            $_content_tags .= '<button type="button" class="btn btn-default" data-dismiss="modal">' . __e("Close") . '</button>';
            $_content_tags .= '<a href="./?p=taxonomies&amp;a=trash&amp;n=' . $taxonomy['name'] . '" class="btn btn-danger">' . __e("Yes, I am sure!") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
        }
        break;
    case 'new':
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=taxonomies">' . __e("Taxonomies") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("New") . '</li>';
        $breadcrumb_tags .= '</ol>';
        $_content_tags = $content_tags;
        break;
    case 'edit':
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=taxonomies">' . __e("Taxonomies") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("New") . '</li>';
        $breadcrumb_tags .= '</ol>';
        $_content_tags = $content_tags;
        break;
}
define('IHS_LAYOUT_CONTENT', $_content_tags);
define('IHS_LAYOUT_BREADCRUMB', $breadcrumb_tags);
define('IHS_PAGE_NAME', '' . __e("Taxonomies") . '');
define('IHS_PAGE_DESC', __e("Register new taxonomies"));

?>