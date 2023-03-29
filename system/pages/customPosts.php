<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 */


defined('IHS_EXEC') or die('Silent is golden!');
$breadcrumb_tags = $content_tags = $_content_tags = null;
$db = new DB();
$string = new StringConvert();
$db->current();
$project = $db->getProject();
// TODO: RESP-POST --|-- GENERAL
if (isset($_POST['submit']))
{
    $postData['custom-posts']['name'] = "";
    $postData['custom-posts']['desc'] = "";
    $postData['custom-posts']['public'] = false;
    $postData['custom-posts']['publicly_queryable'] = false;
    $postData['custom-posts']['query_var'] = false;
    $postData['custom-posts']['show_ui'] = false;
    $postData['custom-posts']['show_in_menu'] = false;
    $postData['custom-posts']['show_in_nav_menus'] = false;
    $postData['custom-posts']['show_in_admin_bar'] = false;
    $postData['custom-posts']['show_in_rest'] = false;
    $postData['custom-posts']['hierarchical'] = false;

    if (isset($_POST['custom-posts']['name']))
    {
        $postData['custom-posts']['name'] = $_POST['custom-posts']['name'];
    }
    if (isset($_POST['custom-posts']['capabilities']))
    {
        $postData['custom-posts']['capabilities'] = $_POST['custom-posts']['capabilities'];
    }
    if (isset($_POST['custom-posts']['label']))
    {
        $postData['custom-posts']['label'] = $_POST['custom-posts']['label'];
    }
    if (isset($_POST['custom-posts']['menu_icon']))
    {
        $postData['custom-posts']['menu_icon'] = $_POST['custom-posts']['menu_icon'];
    }
    if (isset($_GET['n']))
    {
        $postData['custom-posts']['name'] = $_GET['n'];
    }
    if (isset($_POST['custom-posts']['desc']))
    {
        $postData['custom-posts']['desc'] = $_POST['custom-posts']['desc'];
    }
    if (isset($_POST['custom-posts']['custom_capabilities']))
    {
        $postData['custom-posts']['custom_capabilities'] = true;
    } else
    {
        $postData['custom-posts']['custom_capabilities'] = false;
    }
    if (isset($_POST['custom-posts']['public']))
    {
        $postData['custom-posts']['public'] = true;
    } else
    {
        $postData['custom-posts']['public'] = false;
    }
    if (isset($_POST['custom-posts']['publicly_queryable']))
    {
        $postData['custom-posts']['publicly_queryable'] = true;
    } else
    {
        $postData['custom-posts']['publicly_queryable'] = false;
    }
    if (isset($_POST['custom-posts']['query_var']))
    {
        $postData['custom-posts']['query_var'] = true;
    } else
    {
        $postData['custom-posts']['query_var'] = false;
    }
    if (isset($_POST['custom-posts']['show_ui']))
    {
        $postData['custom-posts']['show_ui'] = true;
    } else
    {
        $postData['custom-posts']['show_ui'] = false;
    }
    if (isset($_POST['custom-posts']['show_in_menu']))
    {
        $postData['custom-posts']['show_in_menu'] = true;
    } else
    {
        $postData['custom-posts']['show_in_menu'] = false;
    }
    if (isset($_POST['custom-posts']['show_in_nav_menus']))
    {
        $postData['custom-posts']['show_in_nav_menus'] = true;
    } else
    {
        $postData['custom-posts']['show_in_nav_menus'] = false;
    }
    if (isset($_POST['custom-posts']['show_in_admin_bar']))
    {
        $postData['custom-posts']['show_in_admin_bar'] = true;
    } else
    {
        $postData['custom-posts']['show_in_admin_bar'] = false;
    }
    if (isset($_POST['custom-posts']['show_in_rest']))
    {
        $postData['custom-posts']['show_in_rest'] = true;
    } else
    {
        $postData['custom-posts']['show_in_rest'] = false;
    }
    if (isset($_POST['custom-posts']['has_archive']))
    {
        $postData['custom-posts']['has_archive'] = true;
    } else
    {
        $postData['custom-posts']['has_archive'] = false;
    }
    if (isset($_POST['custom-posts']['hierarchical']))
    {
        $postData['custom-posts']['hierarchical'] = true;
    } else
    {
        $postData['custom-posts']['hierarchical'] = false;
    }
    $postData['custom-posts']['label_for_singular_name'] = "";
    $postData['custom-posts']['label_for_add_new'] = "";
    $postData['custom-posts']['label_for_add_new_item'] = "";
    $postData['custom-posts']['label_for_new_item'] = "";
    $postData['custom-posts']['label_for_edit_item'] = "";
    $postData['custom-posts']['label_for_view_item'] = "";
    $postData['custom-posts']['label_for_all_items'] = "";
    $postData['custom-posts']['label_for_search_items'] = "";
    $postData['custom-posts']['label_for_parent_item_colon'] = "";
    $postData['custom-posts']['label_for_not_found'] = "";
    $postData['custom-posts']['label_for_not_found_in_trash'] = "";
    if (isset($_POST['custom-posts']['label_for_singular_name']))
    {
        $postData['custom-posts']['label_for_singular_name'] = $_POST['custom-posts']['label_for_singular_name'];
    }
    if (isset($_POST['custom-posts']['label_for_add_new']))
    {
        $postData['custom-posts']['label_for_add_new'] = $_POST['custom-posts']['label_for_add_new'];
    }
    if (isset($_POST['custom-posts']['label_for_add_new_item']))
    {
        $postData['custom-posts']['label_for_add_new_item'] = $_POST['custom-posts']['label_for_add_new_item'];
    }
    if (isset($_POST['custom-posts']['label_for_new_item']))
    {
        $postData['custom-posts']['label_for_new_item'] = $_POST['custom-posts']['label_for_new_item'];
    }
    if (isset($_POST['custom-posts']['label_for_edit_item']))
    {
        $postData['custom-posts']['label_for_edit_item'] = $_POST['custom-posts']['label_for_edit_item'];
    }
    if (isset($_POST['custom-posts']['label_for_view_item']))
    {
        $postData['custom-posts']['label_for_view_item'] = $_POST['custom-posts']['label_for_view_item'];
    }
    if (isset($_POST['custom-posts']['label_for_all_items']))
    {
        $postData['custom-posts']['label_for_all_items'] = $_POST['custom-posts']['label_for_all_items'];
    }
    if (isset($_POST['custom-posts']['label_for_search_items']))
    {
        $postData['custom-posts']['label_for_search_items'] = $_POST['custom-posts']['label_for_search_items'];
    }
    if (isset($_POST['custom-posts']['label_for_parent_item_colon']))
    {
        $postData['custom-posts']['label_for_parent_item_colon'] = $_POST['custom-posts']['label_for_parent_item_colon'];
    }
    if (isset($_POST['custom-posts']['label_for_not_found']))
    {
        $postData['custom-posts']['label_for_not_found'] = $_POST['custom-posts']['label_for_not_found'];
    }
    if (isset($_POST['custom-posts']['label_for_not_found_in_trash']))
    {
        $postData['custom-posts']['label_for_not_found_in_trash'] = $_POST['custom-posts']['label_for_not_found_in_trash'];
    }
    $postData['custom-posts']['support-title'] = false;
    $postData['custom-posts']['support-editor'] = false;
    $postData['custom-posts']['support-author'] = false;
    $postData['custom-posts']['support-custom-fields'] = false;
    $postData['custom-posts']['support-trackbacks'] = false;
    $postData['custom-posts']['support-thumbnail'] = false;
    $postData['custom-posts']['support-excerpt'] = false;
    $postData['custom-posts']['support-comments'] = false;
    $postData['custom-posts']['support-revisions'] = false;
    $postData['custom-posts']['support-post-formats'] = false;
    $postData['custom-posts']['support-page-attributes'] = false;
    if (isset($_POST['custom-posts']['support-title']))
    {
        $postData['custom-posts']['support-title'] = true;
    } else
    {
        $postData['custom-posts']['support-title'] = false;
    }
    if (isset($_POST['custom-posts']['support-editor']))
    {
        $postData['custom-posts']['support-editor'] = true;
    } else
    {
        $postData['custom-posts']['support-editor'] = false;
    }
    if (isset($_POST['custom-posts']['support-author']))
    {
        $postData['custom-posts']['support-author'] = true;
    } else
    {
        $postData['custom-posts']['support-author'] = false;
    }
    if (isset($_POST['custom-posts']['support-custom-fields']))
    {
        $postData['custom-posts']['support-custom-fields'] = true;
    } else
    {
        $postData['custom-posts']['support-custom-fields'] = false;
    }
    if (isset($_POST['custom-posts']['support-trackbacks']))
    {
        $postData['custom-posts']['support-trackbacks'] = true;
    } else
    {
        $postData['custom-posts']['support-trackbacks'] = false;
    }
    if (isset($_POST['custom-posts']['support-thumbnail']))
    {
        $postData['custom-posts']['support-thumbnail'] = true;
    } else
    {
        $postData['custom-posts']['support-thumbnail'] = false;
    }
    if (isset($_POST['custom-posts']['support-excerpt']))
    {
        $postData['custom-posts']['support-excerpt'] = true;
    } else
    {
        $postData['custom-posts']['support-excerpt'] = false;
    }
    if (isset($_POST['custom-posts']['support-comments']))
    {
        $postData['custom-posts']['support-comments'] = true;
    } else
    {
        $postData['custom-posts']['support-comments'] = false;
    }
    if (isset($_POST['custom-posts']['support-revisions']))
    {
        $postData['custom-posts']['support-revisions'] = true;
    } else
    {
        $postData['custom-posts']['support-revisions'] = false;
    }
    if (isset($_POST['custom-posts']['support-post-formats']))
    {
        $postData['custom-posts']['support-post-formats'] = true;
    } else
    {
        $postData['custom-posts']['support-post-formats'] = false;
    }
    if (isset($_POST['custom-posts']['support-page-attributes']))
    {
        $postData['custom-posts']['support-page-attributes'] = true;
    } else
    {
        $postData['custom-posts']['support-page-attributes'] = false;
    }
    if (isset($_POST['custom-posts']['taxonomies']))
    {
        foreach ($_POST['custom-posts']['taxonomies'] as $taxonomies)
        {
            $postData['custom-posts']['taxonomies'][] = $taxonomies;
        }
    }

    // text
    if (isset($_POST['custom-posts']['note']))
    {
        $postData['custom-posts']['note'] = $_POST['custom-posts']['note'];
    }

    // validate and save postdata
    $db->saveCustomPost($postData['custom-posts']);
    
    $db->current();
    $_SESSION['CURRENT_PROJECT_NOTICE'] = __e('Custom Posts has been successfully saved!');
    if ($_GET['a'] == 'edit')
    {
        header('Location: ./?p=customPosts&a=edit&alert=success&n=' . $_GET['n'] . '&' . time());
    } else
    {
        header('Location: ./?p=customPosts&a=list&alert=success&' . time());
    }
}
$disabled = '';
if (isset($_GET['n']))
{
    if ($_GET['a'] == 'edit')
    {
        $_prefix = basename($_GET['n']);
        $currentData['custom-posts'] = $db->getCustomPost($_prefix);
        $disabled = 'disabled';
    }
}

// TODO: LAYOUT --|-- INIT
if (!isset($currentData['custom-posts']['name']))
{
    $currentData['custom-posts']['name'] = "item";
}
if (!isset($currentData['custom-posts']['desc']))
{
    $currentData['custom-posts']['desc'] = "";
}
if (!isset($currentData['custom-posts']['public']))
{
    $currentData['custom-posts']['public'] = false;
}
if (!isset($currentData['custom-posts']['publicly_queryable']))
{
    $currentData['custom-posts']['publicly_queryable'] = false;
}
if (!isset($currentData['custom-posts']['query_var']))
{
    $currentData['custom-posts']['query_var'] = false;
}
if (!isset($currentData['custom-posts']['show_ui']))
{
    $currentData['custom-posts']['show_ui'] = true;
}
if (!isset($currentData['custom-posts']['show_in_menu']))
{
    $currentData['custom-posts']['show_in_menu'] = true;
}
if (!isset($currentData['custom-posts']['show_in_nav_menus']))
{
    $currentData['custom-posts']['show_in_nav_menus'] = false;
}
if (!isset($currentData['custom-posts']['show_in_admin_bar']))
{
    $currentData['custom-posts']['show_in_admin_bar'] = false;
}
if (!isset($currentData['custom-posts']['show_in_rest']))
{
    $currentData['custom-posts']['show_in_rest'] = false;
}
if (!isset($currentData['custom-posts']['has_archive']))
{
    $currentData['custom-posts']['has_archive'] = false;
}
if (!isset($currentData['custom-posts']['label']))
{
    $currentData['custom-posts']['label'] = 'Item';
}
if (!isset($currentData['custom-posts']['menu_icon']))
{
    $currentData['custom-posts']['menu_icon'] = 'dashicons-book';
}
if (!isset($currentData['custom-posts']['label_for_singular_name']))
{
    $currentData['custom-posts']['label_for_singular_name'] = "Item";
}
if (!isset($currentData['custom-posts']['label_for_add_new']))
{
    $currentData['custom-posts']['label_for_add_new'] = "Add New";
}
if (!isset($currentData['custom-posts']['label_for_add_new_item']))
{
    $currentData['custom-posts']['label_for_add_new_item'] = "Add New Item";
}
if (!isset($currentData['custom-posts']['label_for_new_item']))
{
    $currentData['custom-posts']['label_for_new_item'] = "New Item";
}
if (!isset($currentData['custom-posts']['label_for_edit_item']))
{
    $currentData['custom-posts']['label_for_edit_item'] = "Edit Item";
}
if (!isset($currentData['custom-posts']['label_for_view_item']))
{
    $currentData['custom-posts']['label_for_view_item'] = "View Item";
}
if (!isset($currentData['custom-posts']['label_for_all_items']))
{
    $currentData['custom-posts']['label_for_all_items'] = "All Items";
}
if (!isset($currentData['custom-posts']['label_for_search_items']))
{
    $currentData['custom-posts']['label_for_search_items'] = "Search Items";
}
if (!isset($currentData['custom-posts']['label_for_parent_item_colon']))
{
    $currentData['custom-posts']['label_for_parent_item_colon'] = "Parent Items:";
}
if (!isset($currentData['custom-posts']['label_for_not_found']))
{
    $currentData['custom-posts']['label_for_not_found'] = "Not found";
}
if (!isset($currentData['custom-posts']['label_for_not_found_in_trash']))
{
    $currentData['custom-posts']['label_for_not_found_in_trash'] = "Not found in trash";
}
if (!isset($currentData['custom-posts']['support-title']))
{
    $currentData['custom-posts']['support-title'] = true;
}
if (!isset($currentData['custom-posts']['support-editor']))
{
    $currentData['custom-posts']['support-editor'] = false;
}
if (!isset($currentData['custom-posts']['support-author']))
{
    $currentData['custom-posts']['support-author'] = false;
}
if (!isset($currentData['custom-posts']['support-custom-fields']))
{
    $currentData['custom-posts']['support-custom-fields'] = false;
}
if (!isset($currentData['custom-posts']['support-trackbacks']))
{
    $currentData['custom-posts']['support-trackbacks'] = false;
}
if (!isset($currentData['custom-posts']['support-thumbnail']))
{
    $currentData['custom-posts']['support-thumbnail'] = false;
}
if (!isset($currentData['custom-posts']['support-excerpt']))
{
    $currentData['custom-posts']['support-excerpt'] = false;
}
if (!isset($currentData['custom-posts']['support-comments']))
{
    $currentData['custom-posts']['support-comments'] = false;
}
if (!isset($currentData['custom-posts']['support-revisions']))
{
    $currentData['custom-posts']['support-revisions'] = false;
}
if (!isset($currentData['custom-posts']['support-post-formats']))
{
    $currentData['custom-posts']['support-post-formats'] = false;
}
if (!isset($currentData['custom-posts']['support-page-attributes']))
{
    $currentData['custom-posts']['support-page-attributes'] = false;
}
if (!isset($currentData['custom-posts']['custom_capabilities']))
{
    $currentData['custom-posts']['custom_capabilities'] = false;
}
if (!isset($currentData['custom-posts']['hierarchical']))
{
    $currentData['custom-posts']['hierarchical'] = false;
}

if (!isset($currentData['custom-posts']['note']))
{
    $currentData['custom-posts']['note'] = "";
}

// TODO: =====================================================================
$content_tags .= '<form class="form-horizontal" action="" method="post">';
$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-6">';
$content_tags .= '<div class="card card-outline card-success">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="nav-icon fas fa-edit"></i>&nbsp;';
$content_tags .= __e('General');
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- GENERAL --|-- FORM
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/custom-posts.php</code></p>';
$content_tags .= '<div class="callout callout-success"><h5>' . __e("Tips") . '</h5>' . __e("For avoid page not found after create custom posts please go <strong>Settings</strong> Menu -&raquo; <strong>permalinks</strong> and click <strong>Save Changes</strong> again") . '</div>';
$content_tags .= '<hr/>';
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="name" class="col-sm-3 col-form-label">' . __e("Name") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input ' . $disabled . ' type="text" name="custom-posts[name]"  class="form-control" id="name" placeholder="books" value="' . $currentData['custom-posts']['name'] . '">';
$content_tags .= '<p class="help-block">' . __e("Post type key, must not exceed 20 characters and may only contain a-z, 0-9, and - characters") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- LABEL
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label" class="col-sm-3 col-form-label">' . __e("Label") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input type="text" name="custom-posts[label]"  class="form-control" id="label" placeholder="Books" value="' . $currentData['custom-posts']['label'] . '">';
$content_tags .= '<p class="help-block">' . __e("Name of the post type shown in the menu, Usually plural") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- MENU_ICON
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label" class="col-sm-3 col-form-label">' . __e("Menu Icon") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<div class="input-group">';
$content_tags .= '<input type="text" id="custom-posts-menu-icon" name="custom-posts[menu_icon]"  class="form-control no-border-top-right-radius" placeholder="dashicons-book" value="' . $currentData['custom-posts']['menu_icon'] . '">';
$content_tags .= '<span class="input-group-append" data-type="icon-picker" data-prefix="dashicons" data-target="#custom-posts-menu-icon" data-dialog="#dashicons-dialog" data-preview="#custom-posts-menu-icon-preview">';
$content_tags .= '<span class="input-group-text"><i id="custom-posts-menu-icon-preview" class="dashicons ' . $currentData['custom-posts']['menu_icon'] . '"></i></span>';
$content_tags .= '</span>';
$content_tags .= '</div>';
$content_tags .= '<p class="help-block">' . __e("Pass the name of a Dashicons helper class to use a font icon, e.g. 'dashicons-chart-pie'") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


// text
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- NOTE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="note" class="col-sm-3 col-form-label">' . __e("Note") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<input  type="text" name="custom-posts[note]"  class="form-control" id="field-note" placeholder="" value="' . $currentData['custom-posts']['note'] . '">';
$content_tags .= '<p class="help-block">' . __e("Just a note") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- DESC
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="desc" class="col-sm-3 col-form-label">' . __e("Description") . '</label>';
$content_tags .= '<div class="col-sm-9">';
$content_tags .= '<textarea class="form-control" name="custom-posts[desc]" >' . $currentData['custom-posts']['desc'] . '</textarea>';
$content_tags .= '<p class="help-block">' . __e("Just an additional note about this custom post") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
$content_tags .= '<hr/>';
$taxonomies[] = array('label' => 'Post Tag', 'value' => 'post_tag');
$taxonomies[] = array('label' => 'Category', 'value' => 'category');
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- TAXONOMIES
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="desc" class="col-sm-3 col-form-label">' . __e("Taxonomies") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-6">';
$content_tags .= '<p>' . __e("WP Core") . '</p>';
if (!isset($currentData['custom-posts']['taxonomies']))
{
    $currentData['custom-posts']['taxonomies'] = array();
}
foreach ($taxonomies as $taxonomy)
{
    $checked = '';
    foreach ($currentData['custom-posts']['taxonomies'] as $taxon)
    {
        if ($taxon == $taxonomy['value'])
        {
            $checked = 'checked="checked"';
        }
    }
    $content_tags .= '<div class="form-group clearfix">';
    $content_tags .= '<div class="icheck-primary d-inline">';
    $content_tags .= '<input ' . $checked . ' id="taxonomies-' . $taxonomy['value'] . '" type="checkbox" name="custom-posts[taxonomies][' . $taxonomy['value'] . ']" value="' . $taxonomy['value'] . '"/>';
    $content_tags .= '<label for="taxonomies-' . $taxonomy['value'] . '">' . $taxonomy['label'] . '</label>';
    $content_tags .= '</div>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>';
$content_tags .= '<div class="col-md-6">';
$content_tags .= '<p>' . __e("Custom Taxonomies") . '</p>';
$taxonomies = $db->getTaxonomies();
foreach ($taxonomies as $taxonomy)
{
    $checked = '';
    foreach ($currentData['custom-posts']['taxonomies'] as $taxon)
    {
        if ($taxon == $string->toVar($project['short-name'] . '_' . $taxonomy['name']))
        {
            $checked = 'checked="checked"';
        }
    }
    $content_tags .= '<div class="form-group clearfix">';
    $content_tags .= '<div class="icheck-danger d-inline">';
    $content_tags .= '<input ' . $checked . ' id="taxonomies-' . $taxonomy['name'] . '" type="checkbox" name="custom-posts[taxonomies][' . $taxonomy['name'] . ']" value="' . $string->toVar($project['short-name'] . '_' . $taxonomy['name']) . '"/>';
    $content_tags .= '<label for="taxonomies-' . $taxonomy['name'] . '">' . $taxonomy['label'] . '</label>';
    $content_tags .= '</div>';
    $content_tags .= '</div>';
}
$content_tags .= '<p><a class="btn btn-sm btn-outline-danger" href="./?p=taxonomies&a=new">' . __e("Add New Taxonomies") . '</a></p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- SUPPORT
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="desc" class="col-sm-3 col-form-label">' . __e("Support") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<p>' . __e("An array of taxonomy identifiers that will be registered for the post type") . '</p>';
$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-4">';
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- SUPPORT-TITLE
$content_tags .= '<div class="form-group clearfix">';
$content_tags .= '<div class="icheck-info d-inline">';
if ($currentData['custom-posts']['support-title'] == true)
{
    $content_tags .= '<input id="custom-posts-support-title" type="checkbox" checked="checked" name="custom-posts[support-title]" />';
} else
{
    $content_tags .= '<input id="custom-posts-support-title" type="checkbox" name="custom-posts[support-title]" />';
}
$content_tags .= '<label for="custom-posts-support-title">' . __e("Title") . '</label>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- SUPPORT-EDITOR
$content_tags .= '<div class="form-group clearfix">';
$content_tags .= '<div class="icheck-info d-inline">';
if ($currentData['custom-posts']['support-editor'] == true)
{
    $content_tags .= '<input id="custom-posts-support-editor" type="checkbox" checked="checked" name="custom-posts[support-editor]" />';
} else
{
    $content_tags .= '<input id="custom-posts-support-editor" type="checkbox" name="custom-posts[support-editor]" />';
}
$content_tags .= '<label for="custom-posts-support-editor">' . __e("Editor") . '</label>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- SUPPORT-AUTHOR
$content_tags .= '<div class="form-group clearfix">';
$content_tags .= '<div class="icheck-info d-inline">';
if ($currentData['custom-posts']['support-author'] == true)
{
    $content_tags .= '<input id="custom-posts-support-author" type="checkbox" checked="checked" name="custom-posts[support-author]" />';
} else
{
    $content_tags .= '<input id="custom-posts-support-author" type="checkbox" name="custom-posts[support-author]" />';
}
$content_tags .= '<label for="custom-posts-support-author">' . __e("Author") . '</label>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- SUPPORT-CUSTOM-FIELDS
$content_tags .= '<div class="form-group clearfix">';
$content_tags .= '<div class="icheck-info d-inline">';
if ($currentData['custom-posts']['support-custom-fields'] == true)
{
    $content_tags .= '<input id="custom-posts-support-custom-fields" type="checkbox" checked="checked" name="custom-posts[support-custom-fields]" />';
} else
{
    $content_tags .= '<input id="custom-posts-support-custom-fields" type="checkbox" name="custom-posts[support-custom-fields]" />';
}
$content_tags .= '<label for="custom-posts-support-custom-fields">' . __e("Custom Fields") . '</label>';
$content_tags .= '</div>';
$content_tags .= '</div>';
$content_tags .= '</div>'; //col-md-4
$content_tags .= '<div class="col-md-4">';
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- SUPPORT-TRACKBACKS
$content_tags .= '<div class="form-group clearfix">';
$content_tags .= '<div class="icheck-info d-inline">';
if ($currentData['custom-posts']['support-trackbacks'] == true)
{
    $content_tags .= '<input id="custom-posts-support-trackbacks" type="checkbox" checked="checked" name="custom-posts[support-trackbacks]" />';
} else
{
    $content_tags .= '<input id="custom-posts-support-trackbacks" type="checkbox" name="custom-posts[support-trackbacks]" />';
}
$content_tags .= '<label for="custom-posts-support-trackbacks">' . __e("Trackbacks") . '</label>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- SUPPORT-THUMBNAIL
$content_tags .= '<div class="form-group clearfix">';
$content_tags .= '<div class="icheck-info d-inline">';
if ($currentData['custom-posts']['support-thumbnail'] == true)
{
    $content_tags .= '<input id="custom-posts-support-thumbnail" type="checkbox" checked="checked" name="custom-posts[support-thumbnail]" />';
} else
{
    $content_tags .= '<input id="custom-posts-support-thumbnail" type="checkbox" name="custom-posts[support-thumbnail]" />';
}
$content_tags .= '<label for="custom-posts-support-thumbnail">' . __e("Thumbnail") . '</label>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- SUPPORT-EXCERPT
$content_tags .= '<div class="form-group clearfix">';
$content_tags .= '<div class="icheck-info d-inline">';
if ($currentData['custom-posts']['support-excerpt'] == true)
{
    $content_tags .= '<input id="custom-posts-support-excerpt" type="checkbox" checked="checked" name="custom-posts[support-excerpt]" />';
} else
{
    $content_tags .= '<input id="custom-posts-support-excerpt" type="checkbox" name="custom-posts[support-excerpt]" />';
}
$content_tags .= '<label for="custom-posts-support-excerpt">' . __e("Excerpt") . '</label>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- SUPPORT-COMMENTS
$content_tags .= '<div class="form-group clearfix">';
$content_tags .= '<div class="icheck-info d-inline">';
if ($currentData['custom-posts']['support-comments'] == true)
{
    $content_tags .= '<input id="custom-posts-support-comments" type="checkbox" checked="checked" name="custom-posts[support-comments]" />';
} else
{
    $content_tags .= '<input id="custom-posts-support-comments" type="checkbox" name="custom-posts[support-comments]" />';
}
$content_tags .= '<label for="custom-posts-support-comments">' . __e("Comments") . '</label>';
$content_tags .= '</div>';
$content_tags .= '</div>';
$content_tags .= '</div>'; //col-md-4
$content_tags .= '<div class="col-md-4">';
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- SUPPORT-REVISIONS
$content_tags .= '<div class="form-group clearfix">';
$content_tags .= '<div class="icheck-info d-inline">';
if ($currentData['custom-posts']['support-revisions'] == true)
{
    $content_tags .= '<input id="custom-posts-support-revisions" type="checkbox" checked="checked" name="custom-posts[support-revisions]" />';
} else
{
    $content_tags .= '<input id="custom-posts-support-revisions" type="checkbox" name="custom-posts[support-revisions]" />';
}
$content_tags .= '<label for="custom-posts-support-revisions">' . __e("Revisions") . '</label>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- SUPPORT-POST-FORMATS
$content_tags .= '<div class="form-group clearfix">';
$content_tags .= '<div class="icheck-info d-inline">';
if ($currentData['custom-posts']['support-post-formats'] == true)
{
    $content_tags .= '<input id="custom-posts-support-post-formats" type="checkbox" checked="checked" name="custom-posts[support-post-formats]" />';
} else
{
    $content_tags .= '<input id="custom-posts-support-post-formats" type="checkbox" name="custom-posts[support-post-formats]" />';
}
$content_tags .= '<label for="custom-posts-support-post-formats">' . __e("Post Formats") . '</label>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- GENERAL --|-- FORM --|-- SUPPORT-PAGE-ATTRIBUTES
$content_tags .= '<div class="form-group clearfix">';
$content_tags .= '<div class="icheck-info d-inline">';
if ($currentData['custom-posts']['support-page-attributes'] == true)
{
    $content_tags .= '<input id="custom-posts-support-page-attributes" type="checkbox" checked="checked" name="custom-posts[support-page-attributes]" />';
} else
{
    $content_tags .= '<input id="custom-posts-support-page-attributes" type="checkbox" name="custom-posts[support-page-attributes]" />';
}
$content_tags .= '<label for="custom-posts-support-page-attributes">' . __e("Page Attributes") . '</label>';
$content_tags .= '</div>';
$content_tags .= '</div>';
$content_tags .= '</div>'; //col-md-4
$content_tags .= '</div>'; //row
$content_tags .= '</div>';
$content_tags .= '</div>';
$content_tags .= '</div>';
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-success btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=customPosts" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=customPosts" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}

$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card
// TODO: =====================================================================
$content_tags .= '<div class="card card-outline card-primary">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-cogs"></i>&nbsp;';
$content_tags .= __e('Options');
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- OPTIONS --|-- FORM
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/custom-posts.php</code></p>';
$content_tags .= '<hr/>';
// TODO: LAYOUT --|-- OPTIONS --|-- FORM --|-- PUBLIC
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="public" class="col-sm-3 col-form-label">' . __e("Public") . '</label>';
$content_tags .= '<div class="col-sm-8">';
if ($currentData['custom-posts']['public'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="custom-posts[public]" data-type="switch" data-on-color="primary"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="custom-posts[public]" data-type="switch" data-on-color="primary"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("Whether a post type is intended for use publicly either via the admin interface or by front-end users") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- OPTIONS --|-- FORM --|-- PUBLICLY_QUERYABLE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="publicly_queryable" class="col-sm-3 col-form-label">' . __e("Publicly Queryable") . '</label>';
$content_tags .= '<div class="col-sm-8">';
if ($currentData['custom-posts']['publicly_queryable'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="custom-posts[publicly_queryable]" data-type="switch" data-on-color="primary"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="custom-posts[publicly_queryable]" data-type="switch" data-on-color="primary"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("Whether queries can be performed on the front end for the post type as part of parse request") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- OPTIONS --|-- FORM --|-- QUERY_VAR
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="query_var" class="col-sm-3 col-form-label">' . __e("Query Variable") . '</label>';
$content_tags .= '<div class="col-sm-8">';
if ($currentData['custom-posts']['query_var'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="custom-posts[query_var]" data-type="switch" data-on-color="primary"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="custom-posts[query_var]" data-type="switch" data-on-color="primary"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("Sets the query_var key for this post type. If false, a post type cannot be loaded at ?{query_var}={post_slug}") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
$content_tags .= '<hr>';
// TODO: LAYOUT --|-- OPTIONS --|-- FORM --|-- SHOW_UI
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="show_ui" class="col-sm-3 col-form-label">' . __e("Show UI") . '</label>';
$content_tags .= '<div class="col-sm-8">';
if ($currentData['custom-posts']['show_ui'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="custom-posts[show_ui]" data-type="switch" data-on-color="info"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="custom-posts[show_ui]" data-type="switch" data-on-color="info"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("Whether queries can be performed on the front end for the post type as part of parse request") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
$content_tags .= '<hr>';
// TODO: LAYOUT --|-- OPTIONS --|-- FORM --|-- SHOW_IN_MENU
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="show_in_menu" class="col-sm-3 col-form-label">' . __e("Show In Menu") . '</label>';
$content_tags .= '<div class="col-sm-8">';
if ($currentData['custom-posts']['show_in_menu'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="custom-posts[show_in_menu]" data-type="switch" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="custom-posts[show_in_menu]" data-type="switch" data-on-color="success"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("Where to show the post type in the admin menu (<strong>left sidebar</strong>)") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- OPTIONS --|-- FORM --|-- SHOW_IN_NAV_MENUS
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="show_in_nav_menus" class="col-sm-3 col-form-label">' . __e("Show In Navigation Menus") . '</label>';
$content_tags .= '<div class="col-sm-8">';
if ($currentData['custom-posts']['show_in_nav_menus'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="custom-posts[show_in_nav_menus]" data-type="switch" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="custom-posts[show_in_nav_menus]" data-type="switch" data-on-color="success"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("Makes this post type available for selection in navigation menus, Sometimes the boxes are hidden by default. Goto <strong>Appearance</strong> -&raquo; <strong>Menus</strong>, then click you try clicking on <strong>screen options</strong> in the top / right") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- OPTIONS --|-- FORM --|-- SHOW_IN_ADMIN_BAR
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="show_in_admin_bar" class="col-sm-3 col-form-label">' . __e("Show In Admin Bar") . '</label>';
$content_tags .= '<div class="col-sm-8">';
if ($currentData['custom-posts']['show_in_admin_bar'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="custom-posts[show_in_admin_bar]" data-type="switch" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="custom-posts[show_in_admin_bar]" data-type="switch" data-on-color="success"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("Makes this post type available via the admin bar (<strong>top sidebar</strong>)") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
$content_tags .= '<hr>';
// TODO: LAYOUT --|-- OPTIONS --|-- FORM --|-- SHOW_IN_REST
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="show_in_rest" class="col-sm-3 col-form-label">' . __e("Show In REST-API") . '</label>';
$content_tags .= '<div class="col-sm-8">';
if ($currentData['custom-posts']['show_in_rest'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="custom-posts[show_in_rest]" data-type="switch" data-on-color="danger"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="custom-posts[show_in_rest]" data-type="switch" data-on-color="danger"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("Whether to include the post type in the REST API") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- OPTIONS --|-- FORM --|-- HAS_ARCHIVE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="has_archive" class="col-sm-3 col-form-label">' . __e("Has Archive") . '</label>';
$content_tags .= '<div class="col-sm-8">';
if ($currentData['custom-posts']['has_archive'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="custom-posts[has_archive]" data-type="switch" data-on-color="danger"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="custom-posts[has_archive]" data-type="switch" data-on-color="danger"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("Whether there should be post type archives") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- OPTIONS --|-- FORM --|-- HIERARCHICAL
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="hierarchical" class="col-sm-3 col-form-label">' . __e("Hierarchical") . '</label>';
$content_tags .= '<div class="col-sm-9">';
if ($currentData['custom-posts']['hierarchical'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="custom-posts[hierarchical]" data-type="switch" data-on-color="danger"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="custom-posts[hierarchical]" data-type="switch" data-on-color="danger"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("Whether the post type is hierarchical, eg: <code>page</code>") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
$content_tags .= '</div>';
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=customPosts" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=customPosts" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}

$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card
$content_tags .= '</div>'; //col-md-6
// TODO: =====================================================================
// TODO: LAYOUT --|-- CUSTOM CAPABILITIES --|--
$content_tags .= '<div class="col-md-6">';
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
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/custom-posts.php</code></p>';
$content_tags .= '<hr/>';
$content_tags .= '<div class="form-group clearfix">';
$content_tags .= '<div class="icheck-info d-inline">';
if ($currentData['custom-posts']['custom_capabilities'] == true)
{
    $content_tags .= '<input id="custom-posts-custom-capabilities" type="checkbox" checked="checked" name="custom-posts[custom_capabilities]" />';
} else
{
    $content_tags .= '<input id="custom-posts-custom-capabilities" type="checkbox" name="custom-posts[custom_capabilities]" />';
}
$content_tags .= '<label for="custom-posts-custom-capabilities">' . __e("Enable Custom Capabilities") . ' (' . __e("default") . ': <strong>post</strong>)</label>';
$content_tags .= '</div>';
$content_tags .= '</div>';
$roles = $db->getRoles();
foreach ($roles as $role)
{
    $content_tags .= '<h5>' . $role['display-name'] . ' ' . __e("Role") . ' (<code>' . $string->toVar($project['short-name']) . '_' . $role['name'] . '</code>)</h5>';
    $content_tags .= '<div class="row">';
    $content_tags .= '<div class="col-md-3">';
    $content_tags .= '<a data-type="checked" data-reset=".' . $role['name'] . '-capabilities" data-target=".' . $role['name'] . '-subscriber" href="#!_" class="btn btn-xs btn-block btn-outline-primary btn-flat">' . __e("Subscriber Capabilities") . '</a>';
    $content_tags .= '</div>';
    $content_tags .= '<div class="col-md-3">';
    $content_tags .= '<a data-type="checked" data-reset=".' . $role['name'] . '-capabilities" data-target=".' . $role['name'] . '-contributor" href="#!_" class="btn btn-xs btn-block btn-outline-primary btn-flat">' . __e("Contributor Capabilities") . '</a>';
    $content_tags .= '</div>';
    $content_tags .= '<div class="col-md-3">';
    $content_tags .= '<a data-type="checked" data-reset=".' . $role['name'] . '-capabilities" data-target=".' . $role['name'] . '-author" href="#!_" class="btn btn-xs btn-block btn-outline-primary btn-flat">' . __e("Author Capabilities") . '</a>';
    $content_tags .= '</div>';
    $content_tags .= '<div class="col-md-3">';
    $content_tags .= '<a  data-type="checked" data-reset=".' . $role['name'] . '-capabilities" data-target=".' . $role['name'] . '-editor" href="#!_" class="btn btn-xs btn-block btn-outline-primary btn-flat">' . __e("Editor Capabilities") . '</a>';
    $content_tags .= '</div>';
    $content_tags .= '</div>';
    $content_tags .= '<br>';
    $content_tags .= '<div class="row">';
    foreach ($GLOBALS['CUSTOM_POST_CAPS'] as $custom_cap)
    {
        $content_tags .= '<div class="col-md-4">';
        $content_tags .= '<div class="form-group clearfix">';
        $content_tags .= '<div class="icheck-info d-inline">';
        if (!isset($currentData['custom-posts']['capabilities'][$role['name']][$custom_cap['value']]))
        {
            $currentData['custom-posts']['capabilities'][$role['name']][$custom_cap['value']] = false;
        }
        $attr_classes = explode(" ", $custom_cap['class']);
        $new_attr_classes = array();
        foreach ($attr_classes as $attr_classe)
        {
            $new_attr_classes[] = $role['name'] . '-' . $attr_classe;
        }
        if ($currentData['custom-posts']['capabilities'][$role['name']][$custom_cap['value']] == true)
        {
            $content_tags .= '<input class="' . $role['name'] . '-capabilities ' . implode(' ', $new_attr_classes) . '" id="custom-posts-capabilities-' . $role['name'] . '-' . $custom_cap['value'] . '" type="checkbox" checked="checked" name="custom-posts[capabilities][' . $role['name'] . '][' . $custom_cap['value'] . ']" value="true" />';
        } else
        {
            $content_tags .= '<input class="' . $role['name'] . '-capabilities ' . implode(' ', $new_attr_classes) . '" id="custom-posts-capabilities-' . $role['name'] . '-' . $custom_cap['value'] . '" type="checkbox" name="custom-posts[capabilities][' . $role['name'] . '][' . $custom_cap['value'] . ']" value="false" />';
        }
        $content_tags .= '<label for="custom-posts-capabilities-' . $role['name'] . '-' . $custom_cap['value'] . '"><code>' . $custom_cap['value'] . '</code></label>';
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
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=customPosts" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=customPosts" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}

$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card
// TODO: =====================================================================
$content_tags .= '<div class="card card-outline card-danger">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-th"></i>&nbsp;';
$content_tags .= __e('Labels');
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- LABELS --|-- FORM
$content_tags .= '<div class="card-body">';
$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/custom-posts.php</code></p>';
$content_tags .= '<hr/>';
$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-6">';
// TODO: LAYOUT --|-- LABELS --|-- FORM --|-- LABEL_FOR_SINGULAR_NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label_for_singular_name" class="col-sm-4 col-form-label">' . __e("Singular Name") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="custom-posts[label_for_singular_name]"  class="form-control" id="label_for_singular_name" placeholder="Book" value="' . $currentData['custom-posts']['label_for_singular_name'] . '">';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- LABELS --|-- FORM --|-- LABEL_FOR_ADD_NEW
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label_for_add_new" class="col-sm-4 col-form-label">' . __e("Add New") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="custom-posts[label_for_add_new]"  class="form-control" id="label_for_add_new" placeholder="Add New" value="' . $currentData['custom-posts']['label_for_add_new'] . '">';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- LABELS --|-- FORM --|-- LABEL_FOR_ADD_NEW_ITEM
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label_for_add_new_item" class="col-sm-4 col-form-label">' . __e("Add New Item") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="custom-posts[label_for_add_new_item]"  class="form-control" id="label_for_add_new_item" placeholder="Add New Book" value="' . $currentData['custom-posts']['label_for_add_new_item'] . '">';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- LABELS --|-- FORM --|-- LABEL_FOR_NEW_ITEM
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label_for_new_item" class="col-sm-4 col-form-label">' . __e("Add Item") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="custom-posts[label_for_new_item]"  class="form-control" id="label_for_new_item" placeholder="Add Book" value="' . $currentData['custom-posts']['label_for_new_item'] . '">';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- LABELS --|-- FORM --|-- LABEL_FOR_EDIT_ITEM
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label_for_edit_item" class="col-sm-4 col-form-label">' . __e("Edit Item") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="custom-posts[label_for_edit_item]"  class="form-control" id="label_for_edit_item" placeholder="Edit Book" value="' . $currentData['custom-posts']['label_for_edit_item'] . '">';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- LABELS --|-- FORM --|-- LABEL_FOR_VIEW_ITEM
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label_for_view_item" class="col-sm-4 col-form-label">' . __e("View Item") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="custom-posts[label_for_view_item]"  class="form-control" id="label_for_view_item" placeholder="View Book" value="' . $currentData['custom-posts']['label_for_view_item'] . '">';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
$content_tags .= '</div>'; //col-md-6
$content_tags .= '<div class="col-md-6">';
// TODO: LAYOUT --|-- LABELS --|-- FORM --|-- LABEL_FOR_ALL_ITEMS
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label_for_all_items" class="col-sm-4 col-form-label">' . __e("All Items") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="custom-posts[label_for_all_items]"  class="form-control" id="label_for_all_items" placeholder="All Books" value="' . $currentData['custom-posts']['label_for_all_items'] . '">';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- LABELS --|-- FORM --|-- LABEL_FOR_SEARCH_ITEMS
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label_for_search_items" class="col-sm-4 col-form-label">' . __e("Search Items") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="custom-posts[label_for_search_items]"  class="form-control" id="label_for_search_items" placeholder="Search Books" value="' . $currentData['custom-posts']['label_for_search_items'] . '">';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- LABELS --|-- FORM --|-- LABEL_FOR_PARENT_ITEM_COLON
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label_for_parent_item_colon" class="col-sm-4 col-form-label">' . __e("Parent Items:") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="custom-posts[label_for_parent_item_colon]"  class="form-control" id="label_for_parent_item_colon" placeholder="Parent Books:" value="' . $currentData['custom-posts']['label_for_parent_item_colon'] . '">';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- LABELS --|-- FORM --|-- LABEL_FOR_NOT_FOUND
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label_for_not_found" class="col-sm-4 col-form-label">' . __e("Not found") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="custom-posts[label_for_not_found]"  class="form-control" id="label_for_not_found" placeholder="Not found" value="' . $currentData['custom-posts']['label_for_not_found'] . '">';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
// TODO: LAYOUT --|-- LABELS --|-- FORM --|-- LABEL_FOR_NOT_FOUND_IN_TRASH
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="label_for_not_found_in_trash" class="col-sm-4 col-form-label">' . __e("No found in trash") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="custom-posts[label_for_not_found_in_trash]"  class="form-control" id="label_for_not_found_in_trash" placeholder="No found in trash" value="' . $currentData['custom-posts']['label_for_not_found_in_trash'] . '">';
$content_tags .= '<p class="help-block">' . __e("") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';
$content_tags .= '</div>'; //col-md-6
$content_tags .= '</div>'; //row
$content_tags .= '</div>'; //card
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=customPosts" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=customPosts" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}

$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card
// TODO: =====================================================================
$content_tags .= '<div class="card card-outline card-info">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-question-circle"></i>&nbsp;';
$content_tags .= __e('Sample Code and References');
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- SUPPORTS --|-- FORM
$content_tags .= '<div class="card-body">';
$content_tags .= '<div class="callout callout-success">';
$content_tags .= __e('These instructions are dynamic according to the conditions of the project being worked on');
$content_tags .= '</div>';
$example_code = null;
$example_code .= "" . '<?php' . "\r\n";
$example_code .= "" . '$args = array("post_type" => "' . $string->toVar($project['short-name'] . '_' . $currentData['custom-posts']['name']) . '");' . "\r\n";
$example_code .= "" . '$custom_posts = get_posts($args);' . "\r\n";
$example_code .= "" . 'foreach($custom_posts as $custom_post){' . "\r\n";
$example_code .= "\t" . '/** get post **/' . "\r\n";
$example_code .= "\t" . 'var_dump($custom_post);' . "\r\n";
$example_code .= "\t" . '/** get thumbnail **/' . "\r\n";
$example_code .= "\t" . '$attachment_id = get_post_thumbnail_id($custom_post->ID);' . "\r\n";
$example_code .= "\t" . '$thumbnail = wp_get_attachment_image_src($attachment_id);   ' . "\r\n";
$example_code .= "" . '}' . "\r\n";
$content_tags .= '<h3>' . __e("Get Custom Posts") . '</h3>';
$content_tags .= '<div class="example-code">';
$content_tags .= highlight_string($example_code, true);
$content_tags .= '</div>';
$example_code = null;
$example_code .= "" . '<?php' . "\r\n";
$example_code .= "" . '// get post id' . "\r\n";
$example_code .= "" . '$postID = get_the_ID();' . "\r\n";
$example_code .= "" . '// get current post' . "\r\n";
$example_code .= "" . '$post = get_post();' . "\r\n";
$example_code .= "" . 'var_dump($post);' . "\r\n";
$content_tags .= '<h3>' . __e("Get Single Post") . '</h3>';
$content_tags .= '<div class="example-code">';
$content_tags .= highlight_string($example_code, true);
$content_tags .= '</div>';
$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<h5>' . __e("Code References") . ':</h5>';
$content_tags .= '<ul>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/register_post_type/">register_post_type</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/get_post/">get_post</a>' . '</p></li>';
$content_tags .= '</ul>';
$content_tags .= '</div>';
$content_tags .= '</div>';
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-info btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != "")
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=customPosts" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=customPosts" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}

$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card
$content_tags .= '</div>'; //col-md-6
$content_tags .= '</div>'; //row
$content_tags .= '</form>';
$icon = new ShowIcon();
$content_tags .= $icon->Display('dashicons', 'Dashicons');
// TODO: =====================================================================
// TODO: LIST
switch ($_GET['a'])
{
    case 'list':
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=customPosts">' . __e("Custom Posts") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("List") . '</li>';
        $breadcrumb_tags .= '</ol>';
        $_content_tags .= '<div class="card card-outline card-info">';
        $_content_tags .= '<div class="card-body">';
        $_content_tags .= '<div class="welcome">';
        $_content_tags .= '<h2>Post Type</h2>';
        $_content_tags .= '<h1>Custom Posts</h1>';
        $_content_tags .= '<p class="lead">Post types can support any number of built-in core features such as meta boxes, custom fields, post thumbnails, post statuses, comments, and more</p>';
        $_content_tags .= '</div>';
        $_content_tags .= '<table data-type="datatable" class="table datatable table-bordered">';
        $_content_tags .= '<thead>';
        $_content_tags .= '<tr>';
        $_content_tags .= '<th>' . __e("Name") . '</th>';
        $_content_tags .= '<th>' . __e("Label") . '</th>';
        $_content_tags .= '<th>' . __e("Note") . '</th>';
        $_content_tags .= '<th>' . __e("Description") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Taxonomies used") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Public") . '</th>';
        //$_content_tags .= '<th class="text-center">' . __e("Publicly Queryable") . '</th>';
        //$_content_tags .= '<th class="text-center">' . __e("Query Variable") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("RESTful API") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Action") . '</th>';
        $_content_tags .= '</tr>';
        $_content_tags .= '</thead>';
        $_content_tags .= '<tbody>';
        $post_types = $db->getCustomPosts();
        foreach ($post_types as $post_type)
        {
            if (!isset($post_type['public']))
            {
                $post_type['public'] = false;
            }
            if (!isset($post_type['publicly_queryable']))
            {
                $post_type['publicly_queryable'] = false;
            }
            if (!isset($post_type['query_var']))
            {
                $post_type['query_var'] = false;
            }
            $_content_tags .= '<tr>';
            $_content_tags .= '<td><code>' . $string->toVar($project['short-name'] . '_' . $post_type['name']) . '</code></td>';
            $_content_tags .= '<td>' . htmlentities($post_type['label']) . '</td>';
            $_content_tags .= '<td>' . htmlentities($post_type['note']) . '</td>';
            $_content_tags .= '<td><em>' . $post_type['desc'] . '</em></td>';
            $new_taxonomies = array();
            if (isset($post_type['taxonomies']))
            {
                foreach ($post_type['taxonomies'] as $taxo)
                {
                    $new_taxonomies[] = $taxo;
                }
            }
            if (isset($post_type['taxonomies']))
            {
                $_content_tags .= '<td><span class="badge badge-danger">' . implode('</span> <span class="badge badge-danger">', $new_taxonomies) . '</span></td>';
            } else
            {
                $_content_tags .= '<td></td>';
            }
            if ($post_type['public'] == true)
            {
                $_content_tags .= '<td class="text-center"><span class="badge badge-success">' . __e("Yes") . '</span></td>';
            } else
            {
                $_content_tags .= '<td class="text-center"><span class="badge badge-info">' . __e("No") . '</span></td>';
            }
            if ($post_type['publicly_queryable'] == true)
            {
                //$_content_tags .= '<td class="text-center"><span class="badge badge-success">' . __e("Yes") . '</span></td>';
            } else
            {
                //$_content_tags .= '<td class="text-center"><span class="badge badge-info">' . __e("No") . '</span></td>';
            }
            if ($post_type['query_var'] == true)
            {
                //$_content_tags .= '<td class="text-center"><span class="badge badge-success">' . __e("Yes") . '</span></td>';
            } else
            {
                //$_content_tags .= '<td class="text-center"><span class="badge badge-info">' . __e("No") . '</span></td>';
            }
            if ($post_type['show_in_rest'] == true)
            {
                $_content_tags .= '<td class="text-center"><span class="badge badge-success">' . __e("Yes") . '</span></td>';
            } else
            {
                $_content_tags .= '<td class="text-center"><span class="badge badge-info">' . __e("No") . '</span></td>';
            }
            $_content_tags .= '<td class="text-center align-middle">';
            $_content_tags .= '<div class="btn-group btn-group-sm">';
            $_content_tags .= '<a href="#' . $post_type['name'] . '" data-toggle="modal" data-target="#modal-trash-custom-posts-' . $post_type['name'] . '" data-href="./?p=customPosts&amp;a=trash&amp;n=' . $post_type['name'] . '" class="btn btn-danger"><i class="fa fa-trash"></i> ' . __e("Trash") . '</a>';
            $_content_tags .= '<a href="./?p=customPosts&amp;a=edit&amp;n=' . $post_type['name'] . '" class="btn btn-success"><i class="fa fa-edit"></i> ' . __e("Edit") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</td>';
            $_content_tags .= '</tr>';
        }
        $_content_tags .= '</tbody>';
        $_content_tags .= '</table>';
        $_content_tags .= '</div>';
        $_content_tags .= '<div class="card-footer">';
        $_content_tags .= '<a href="./?p=customPosts&amp;a=new" class="btn btn-success"><i class="fa fa-plus-circle"></i> ' . __e("Add New Custom Post") . '</a>';
        $_content_tags .= '</div>';
        $_content_tags .= '</div>';
        foreach ($post_types as $post_type)
        {
            if (!isset($post_type['public']))
            {
                $post_type['public'] = true;
            }
            $_content_tags .= '<div class="modal fade" id="modal-trash-custom-posts-' . $post_type['name'] . '">';
            $_content_tags .= '<div class="modal-dialog">';
            $_content_tags .= '<div class="modal-content bg-default">';
            $_content_tags .= '<div class="modal-header">';
            $_content_tags .= '<h4 class="modal-title">' . __e("Confirm") . '</h4>';
            $_content_tags .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            $_content_tags .= '<span aria-hidden="true">&times;</span></button>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-body">';
            $_content_tags .= '<p>' . __e("Are you sure You want to delete this Custom Post?") . '</p>';
            $_content_tags .= '<table class="table-grid">';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td rowspan="3" style="text-align: center;"><i class="trash-logo dashicons ' . htmlentities($post_type['menu_icon']) . '"></i></td>';
            $_content_tags .= '<td>' . __e("Name") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><code>' . $string->toVar($project['short-name'] . '_' . $post_type['name']) . '</code></td>';
            $_content_tags .= '</tr>';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Label") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><strong>' . $post_type['label'] . '</strong></td>';
            $_content_tags .= '</tr>';
            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Public") . '</td>';
            $_content_tags .= '<td>:</td>';
            if ($post_type['public'] == true)
            {
                $_content_tags .= '<td><span class="badge badge-success">' . __e("Yes") . '</span></td>';
            } else
            {
                $_content_tags .= '<td><span class="badge badge-primary">' . __e("No") . '</span></td>';
            }
            $_content_tags .= '</tr>';
            $_content_tags .= '</table>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-footer justify-content-between">';
            $_content_tags .= '<button type="button" class="btn btn-default" data-dismiss="modal">' . __e("Close") . '</button>';
            $_content_tags .= '<a href="./?p=customPosts&amp;a=trash&amp;n=' . $post_type['name'] . '&amp;c=ok" class="btn btn-danger">' . __e("Yes, I am sure!") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
        }
        break;
        // TODO: NEW
    case 'new':
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=customPosts">' . __e("Custom Posts") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("New") . '</li>';
        $breadcrumb_tags .= '</ol>';
        $_content_tags = $content_tags;
        break;
    case 'edit':
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=customPosts">' . __e("Custom Posts") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("Edit") . '</li>';
        $breadcrumb_tags .= '</ol>';
        $_content_tags = $content_tags;
        break;
    case 'trash':
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=customPosts">' . __e("Custom Posts") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("Trash") . '</li>';
        $breadcrumb_tags .= '</ol>';
        if ($_GET['c'] == 'ok')
        {
            $name = $_GET['n'];
            $_SESSION['CURRENT_PROJECT_NOTICE'] = __e('Custom Posts has been deleted successfully!');
            $db->removeCustomPosts($name);
            header("Location: ./?p=customPosts&" . time());
        }
        break;
}
define('IHS_LAYOUT_CONTENT', $_content_tags);
define('IHS_LAYOUT_BREADCRUMB', $breadcrumb_tags);
define('IHS_PAGE_NAME', '' . __e("Custom Posts") . '');
define('IHS_PAGE_DESC', __e("Registers a post type"));

?>