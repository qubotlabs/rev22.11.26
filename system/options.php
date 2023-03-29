<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

defined("IHS_EXEC") or die("Silent is golden!");

// TODO: DEFAULT-CAPS
$capabilities = array();
$capabilities[] = array(
    'value' => 'read',
    'label' => 'Read',
    'class' => 'subscriber contributor author editor',
    'desc' => 'Access to Dashboard and Users -&gt; Your Profile');

$capabilities[] = array(
    'value' => 'read_private_posts',
    'label' => 'Read private posts',
    'class' => 'editor',
    'desc' => 'Access to read private posts');

$capabilities[] = array(
    'value' => 'edit_posts',
    'label' => 'Edit posts',
    'class' => 'contributor author editor',
    'desc' => 'Access to Posts, Add New, Comments and moderating comments');

$capabilities[] = array(
    'value' => 'delete_posts',
    'label' => 'Delete posts',
    'class' => 'contributor author editor',
    'desc' => 'Can delete posts');

$capabilities[] = array(
    'value' => 'publish_posts',
    'label' => 'Publish posts',
    'class' => 'author editor',
    'desc' => 'Can publish posts. Otherwise they stay in draft mode');

$capabilities[] = array(
    'value' => 'delete_published_posts',
    'label' => 'Delete published posts',
    'class' => 'author editor',
    'desc' => 'Can delete published posts');

$capabilities[] = array(
    'value' => 'edit_published_posts',
    'label' => 'Edit published posts',
    'class' => 'author editor',
    'desc' => 'Can edit posts');

$capabilities[] = array(
    'value' => 'edit_others_posts',
    'label' => 'Edit other posts',
    'class' => 'editor',
    'desc' => 'Can edit other users posts');

$capabilities[] = array(
    'value' => 'delete_others_posts',
    'label' => 'Delete other posts',
    'class' => 'editor',
    'desc' => 'Can delete other users posts');

$capabilities[] = array(
    'value' => 'delete_private_posts',
    'label' => 'delete private posts',
    'class' => 'editor',
    'desc' => 'Can delete private posts');

$capabilities[] = array(
    'value' => 'edit_private_posts',
    'label' => 'Edit private posts',
    'class' => 'editor',
    'desc' => 'Can edit private posts');


$capabilities[] = array(
    'value' => 'manage_categories',
    'label' => 'Manage Categories',
    'class' => 'editor',
    'desc' => 'Access to managing categories');

$capabilities[] = array(
    'value' => 'moderate_comments',
    'label' => 'Moderate comments',
    'class' => 'editor',
    'desc' => 'Access to moderating comments, edit posts also needs to be set to true');

$capabilities[] = array(
    'value' => 'edit_pages',
    'label' => 'Edit pages',
    'class' => 'editor',
    'desc' => 'Access to Pages and Add New (page)');

$capabilities[] = array(
    'value' => 'publish_pages',
    'label' => 'Publish pages',
    'class' => 'editor',
    'desc' => 'Can publish pages');

$capabilities[] = array(
    'value' => 'edit_others_pages',
    'label' => 'Edit others pages',
    'class' => 'editor',
    'desc' => 'Can edit others users pages');

$capabilities[] = array(
    'value' => 'edit_published_pages',
    'label' => 'Edit published pages',
    'class' => 'editor',
    'desc' => 'Can edit published pages');

$capabilities[] = array(
    'value' => 'delete_pages',
    'label' => 'Delete pages',
    'class' => 'editor',
    'desc' => 'Can delete pages');

$capabilities[] = array(
    'value' => 'delete_others_pages',
    'label' => 'Delete others pages',
    'class' => 'editor',
    'desc' => 'Can delete other users pages');

$capabilities[] = array(
    'value' => 'delete_published_pages',
    'label' => 'Delete published pages',
    'class' => 'editor',
    'desc' => 'Can delete published pages');

$capabilities[] = array(
    'value' => 'delete_private_pages',
    'label' => 'Delete private pages',
    'class' => 'editor',
    'desc' => 'Can delete private pages');

$capabilities[] = array(
    'value' => 'edit_private_pages',
    'label' => 'edit private pages',
    'class' => 'editor',
    'desc' => 'Can edit private pages');


$capabilities[] = array(
    'value' => 'read_private_pages',
    'label' => 'Read private pages',
    'class' => 'editor',
    'desc' => 'Can read private pages');

$capabilities[] = array(
    'value' => 'upload_files',
    'label' => 'Upload files',
    'class' => 'author editor',
    'desc' => 'Access to Media Library');

$capabilities[] = array(
    'value' => 'manage_links',
    'label' => 'Manage links',
    'class' => 'editor',
    'desc' => 'Manage links');

$GLOBALS['DEFAULT_CAPS'] = $capabilities;


// TODO: CUSTOM-POST-CAPS
$custom_caps = array();
$_capabilities[] = array(
    'value' => 'edit_post',
    'label' => 'edit_post',
    'class' => '',
    'desc' => 'edit_post, read_post, delete_post');

$_capabilities[] = array(
    'value' => 'read_post',
    'label' => 'read_post',
    'class' => '',
    'desc' => 'edit_post, read_post, delete_post');

$_capabilities[] = array(
    'value' => 'delete_post',
    'label' => 'delete_post',
    'class' => '',
    'desc' => 'edit_post, read_post, delete_post');

$capabilities[] = array(
    'value' => 'edit',
    'label' => 'edit_posts',
    'class' => 'contributor author editor',
    'desc' => '');

$capabilities[] = array(
    'value' => 'delete',
    'label' => 'delete_posts',
    'class' => 'contributor author editor',
    'desc' => '');

$capabilities[] = array(
    'value' => 'edit_others',
    'label' => 'edit_others_posts',
    'class' => 'editor',
    'desc' => '');

$capabilities[] = array(
    'value' => 'publish',
    'label' => 'publish_posts',
    'class' => 'author editor',
    'desc' => '');

$capabilities[] = array(
    'value' => 'read_private',
    'label' => 'read_private_posts',
    'class' => 'editor',
    'desc' => '');

$capabilities[] = array(
    'value' => 'delete_private',
    'label' => 'delete_private_posts',
    'class' => 'editor',
    'desc' => '');

$capabilities[] = array(
    'value' => 'delete_published',
    'label' => 'delete_published_posts',
    'class' => 'author editor',
    'desc' => '');

$capabilities[] = array(
    'value' => 'delete_others',
    'label' => 'delete_others_posts',
    'class' => 'editor',
    'desc' => '');
$capabilities[] = array(
    'value' => 'edit_private',
    'label' => 'edit_private_posts',
    'class' => 'editor ',
    'desc' => '');
$capabilities[] = array(
    'value' => 'edit_published',
    'label' => 'edit_published_posts',
    'class' => 'author editor',
    'desc' => '');


$GLOBALS['CUSTOM_POST_CAPS'] = $capabilities;


// TODO: TAXONOMIES-CAPS
$capabilities = array();
$capabilities[] = array(
    'value' => 'manage',
    'label' => 'manage_terms',
    'class' => '',
    'desc' => '');

$capabilities[] = array(
    'value' => 'edit',
    'label' => 'edit_terms',
    'class' => '',
    'desc' => '');

$capabilities[] = array(
    'value' => 'delete',
    'label' => 'delete_terms',
    'class' => '',
    'desc' => '');

$capabilities[] = array(
    'value' => 'assign',
    'label' => 'assign_terms',
    'class' => '',
    'desc' => '');

$GLOBALS['TAXONOMIES_CAPS'] = $capabilities;


$js_deps[] = array("label" => "jQuery", "value" => "jquery");
$js_deps[] = array("label" => "Jcrop", "value" => "jcrop");
$js_deps[] = array("label" => "SWFObject", "value" => "swfobject");
$js_deps[] = array("label" => "SWFUpload", "value" => "swfupload");
$js_deps[] = array("label" => "SWFUpload Degrade", "value" => "swfupload-degrade");
$js_deps[] = array("label" => "SWFUpload Queue", "value" => "swfupload-queue");
$js_deps[] = array("label" => "SWFUpload Handlers", "value" => "swfupload-handlers");
$js_deps[] = array("label" => "jQuery Form", "value" => "jquery-form");
$js_deps[] = array("label" => "jQuery Color", "value" => "jquery-color");
$js_deps[] = array("label" => "jQuery Masonry", "value" => "jquery-masonry");
$js_deps[] = array("label" => "Masonry (native Javascript)", "value" => "masonry");
$js_deps[] = array("label" => "jQuery UI Core", "value" => "jquery-ui-core");
$js_deps[] = array("label" => "jQuery UI Widget", "value" => "jquery-ui-widget");
$js_deps[] = array("label" => "jQuery UI Accordion", "value" => "jquery-ui-accordion");
$js_deps[] = array("label" => "jQuery UI Autocomplete", "value" => "jquery-ui-autocomplete");
$js_deps[] = array("label" => "jQuery UI Button", "value" => "jquery-ui-button");
$js_deps[] = array("label" => "jQuery UI Datepicker", "value" => "jquery-ui-datepicker");
$js_deps[] = array("label" => "jQuery UI Dialog", "value" => "jquery-ui-dialog");
$js_deps[] = array("label" => "jQuery UI Draggable", "value" => "jquery-ui-draggable");
$js_deps[] = array("label" => "jQuery UI Droppable", "value" => "jquery-ui-droppable");
$js_deps[] = array("label" => "jQuery UI Menu", "value" => "jquery-ui-menu");
$js_deps[] = array("label" => "jQuery UI Mouse", "value" => "jquery-ui-mouse");
$js_deps[] = array("label" => "jQuery UI Position", "value" => "jquery-ui-position");
$js_deps[] = array("label" => "jQuery UI Progressbar", "value" => "jquery-ui-progressbar");
$js_deps[] = array("label" => "jQuery UI Selectable", "value" => "jquery-ui-selectable");
$js_deps[] = array("label" => "jQuery UI Resizable", "value" => "jquery-ui-resizable");
$js_deps[] = array("label" => "jQuery UI Selectmenu", "value" => "jquery-ui-selectmenu");
$js_deps[] = array("label" => "jQuery UI Sortable", "value" => "jquery-ui-sortable");
$js_deps[] = array("label" => "jQuery UI Slider", "value" => "jquery-ui-slider");
$js_deps[] = array("label" => "jQuery UI Tooltips", "value" => "jquery-ui-tooltip");
$js_deps[] = array("label" => "jQuery UI Tabs", "value" => "jquery-ui-tabs");
$js_deps[] = array("label" => "jQuery UI Effects", "value" => "jquery-effects-core");
$js_deps[] = array("label" => "jQuery UI Effects - Blind", "value" => "jquery-effects-blind");
$js_deps[] = array("label" => "jQuery UI Effects - Bounce", "value" => "jquery-effects-bounce");
$js_deps[] = array("label" => "jQuery UI Effects - Clip", "value" => "jquery-effects-clip");
$js_deps[] = array("label" => "jQuery UI Effects - Drop", "value" => "jquery-effects-drop");
$js_deps[] = array("label" => "jQuery UI Effects - Explode", "value" => "jquery-effects-explode");
$js_deps[] = array("label" => "jQuery UI Effects - Fade", "value" => "jquery-effects-fade");
$js_deps[] = array("label" => "jQuery UI Effects - Fold", "value" => "jquery-effects-fold");
$js_deps[] = array("label" => "jQuery UI Effects - Highlight", "value" => "jquery-effects-highlight");
$js_deps[] = array("label" => "jQuery UI Effects - Pulsate", "value" => "jquery-effects-pulsate");
$js_deps[] = array("label" => "jQuery UI Effects - Scale", "value" => "jquery-effects-scale");
$js_deps[] = array("label" => "jQuery UI Effects - Shake", "value" => "jquery-effects-shake");
$js_deps[] = array("label" => "jQuery UI Effects - Slide", "value" => "jquery-effects-slide");
$js_deps[] = array("label" => "jQuery UI Effects - Transfer", "value" => "jquery-effects-transfer");
$js_deps[] = array("label" => "MediaElement.js (WP 3.6+)", "value" => "wp-mediaelement");
$js_deps[] = array("label" => "jQuery Schedule", "value" => "schedule");
$js_deps[] = array("label" => "jQuery Suggest", "value" => "suggest");
$js_deps[] = array("label" => "ThickBox", "value" => "thickbox");
$js_deps[] = array("label" => "jQuery HoverIntent", "value" => "hoverIntent");
$js_deps[] = array("label" => "jQuery Hotkeys", "value" => "jquery-hotkeys");
$js_deps[] = array("label" => "Simple AJAX Code-Kit", "value" => "sack");
$js_deps[] = array("label" => "QuickTags", "value" => "quicktags");
$js_deps[] = array("label" => "Iris (Colour picker)", "value" => "iris");
$js_deps[] = array("label" => "Farbtastic (deprecated)", "value" => "farbtastic");
$js_deps[] = array("label" => "ColorPicker (deprecated)", "value" => "colorpicker");
$js_deps[] = array("label" => "Tiny MCE", "value" => "tiny_mce");
$js_deps[] = array("label" => "Autosave", "value" => "autosave");
$js_deps[] = array("label" => "WordPress AJAX Response", "value" => "wp-ajax-response");
$js_deps[] = array("label" => "List Manipulation", "value" => "wp-lists");
$js_deps[] = array("label" => "WP Common", "value" => "common");
$js_deps[] = array("label" => "WP Editor", "value" => "editorremov");
$js_deps[] = array("label" => "WP Editor Functions", "value" => "editor-functions");
$js_deps[] = array("label" => "AJAX Cat", "value" => "ajaxcat");
$js_deps[] = array("label" => "Admin Categories", "value" => "admin-categories");
$js_deps[] = array("label" => "Admin Tags", "value" => "admin-tags");
$js_deps[] = array("label" => "Admin custom fields", "value" => "admin-custom-fields");
$js_deps[] = array("label" => "Password Strength Meter", "value" => "password-strength-meter");
$js_deps[] = array("label" => "Admin Comments", "value" => "admin-comments");
$js_deps[] = array("label" => "Admin Users", "value" => "admin-users");
$js_deps[] = array("label" => "Admin Forms", "value" => "admin-forms");
$js_deps[] = array("label" => "XFN", "value" => "xfn");
$js_deps[] = array("label" => "Upload", "value" => "upload");
$js_deps[] = array("label" => "PostBox", "value" => "postbox");
$js_deps[] = array("label" => "Slug", "value" => "slug");
$js_deps[] = array("label" => "Post", "value" => "post");
$js_deps[] = array("label" => "Page", "value" => "page");
$js_deps[] = array("label" => "Link", "value" => "link");
$js_deps[] = array("label" => "Comment", "value" => "comment");
$js_deps[] = array("label" => "Threaded Comments", "value" => "comment-reply");
$js_deps[] = array("label" => "Admin Gallery", "value" => "admin-gallery");
$js_deps[] = array("label" => "Media Upload", "value" => "media-upload");
$js_deps[] = array("label" => "Admin widgets", "value" => "admin-widgets");
$js_deps[] = array("label" => "Word Count", "value" => "word-count");
$js_deps[] = array("label" => "Theme Preview", "value" => "theme-preview");
$js_deps[] = array("label" => "JSON for JS", "value" => "json2");
$js_deps[] = array("label" => "Plupload Core", "value" => "plupload");
$js_deps[] = array("label" => "Plupload All Runtimes", "value" => "plupload-all");
$js_deps[] = array("label" => "Plupload HTML4", "value" => "plupload-html4");
$js_deps[] = array("label" => "Plupload HTML5", "value" => "plupload-html5");
$js_deps[] = array("label" => "Plupload Flash", "value" => "plupload-flash");
$js_deps[] = array("label" => "Plupload Silverlight", "value" => "plupload-silverlight");
$js_deps[] = array("label" => "Underscore js", "value" => "underscore");
$js_deps[] = array("label" => "Backbone js", "value" => "backbone");
$GLOBALS['JS_DEPS'] = $js_deps;


$hook_suffix[] = array("value"=>"about.php","label"=>"about.php");
$hook_suffix[] = array("value"=>"admin-ajax.php","label"=>"admin-ajax.php");
$hook_suffix[] = array("value"=>"admin-footer.php","label"=>"admin-footer.php");
$hook_suffix[] = array("value"=>"admin-functions.php","label"=>"admin-functions.php");
$hook_suffix[] = array("value"=>"admin-header.php","label"=>"admin-header.php");
$hook_suffix[] = array("value"=>"admin-post.php","label"=>"admin-post.php");
$hook_suffix[] = array("value"=>"admin.php","label"=>"admin.php");
$hook_suffix[] = array("value"=>"async-upload.php","label"=>"async-upload.php");
$hook_suffix[] = array("value"=>"comment.php","label"=>"comment.php");
$hook_suffix[] = array("value"=>"credits.php","label"=>"credits.php");
$hook_suffix[] = array("value"=>"custom-background.php","label"=>"custom-background.php");
$hook_suffix[] = array("value"=>"custom-header.php","label"=>"custom-header.php");
$hook_suffix[] = array("value"=>"customize.php","label"=>"customize.php");
$hook_suffix[] = array("value"=>"edit-comments.php","label"=>"edit-comments.php");
$hook_suffix[] = array("value"=>"edit-form-advanced.php","label"=>"edit-form-advanced.php");
$hook_suffix[] = array("value"=>"edit-form-blocks.php","label"=>"edit-form-blocks.php");
$hook_suffix[] = array("value"=>"edit-form-comment.php","label"=>"edit-form-comment.php");
$hook_suffix[] = array("value"=>"edit-link-form.php","label"=>"edit-link-form.php");
$hook_suffix[] = array("value"=>"edit-tag-form.php","label"=>"edit-tag-form.php");
$hook_suffix[] = array("value"=>"edit-tags.php","label"=>"edit-tags.php");
$hook_suffix[] = array("value"=>"edit.php","label"=>"edit.php");
$hook_suffix[] = array("value"=>"erase-personal-data.php","label"=>"erase-personal-data.php");
$hook_suffix[] = array("value"=>"export-personal-data.php","label"=>"export-personal-data.php");
$hook_suffix[] = array("value"=>"export.php","label"=>"export.php");
$hook_suffix[] = array("value"=>"freedoms.php","label"=>"freedoms.php");
$hook_suffix[] = array("value"=>"import.php","label"=>"import.php");
$hook_suffix[] = array("value"=>"index.php","label"=>"index.php");
$hook_suffix[] = array("value"=>"install-helper.php","label"=>"install-helper.php");
$hook_suffix[] = array("value"=>"install.php","label"=>"install.php");
$hook_suffix[] = array("value"=>"link-add.php","label"=>"link-add.php");
$hook_suffix[] = array("value"=>"link-manager.php","label"=>"link-manager.php");
$hook_suffix[] = array("value"=>"link-parse-opml.php","label"=>"link-parse-opml.php");
$hook_suffix[] = array("value"=>"link.php","label"=>"link.php");
$hook_suffix[] = array("value"=>"load-scripts.php","label"=>"load-scripts.php");
$hook_suffix[] = array("value"=>"load-styles.php","label"=>"load-styles.php");
$hook_suffix[] = array("value"=>"media-new.php","label"=>"media-new.php");
$hook_suffix[] = array("value"=>"media-upload.php","label"=>"media-upload.php");
$hook_suffix[] = array("value"=>"media.php","label"=>"media.php");
$hook_suffix[] = array("value"=>"menu-header.php","label"=>"menu-header.php");
$hook_suffix[] = array("value"=>"menu.php","label"=>"menu.php");
$hook_suffix[] = array("value"=>"moderation.php","label"=>"moderation.php");
$hook_suffix[] = array("value"=>"ms-admin.php","label"=>"ms-admin.php");
$hook_suffix[] = array("value"=>"ms-delete-site.php","label"=>"ms-delete-site.php");
$hook_suffix[] = array("value"=>"ms-edit.php","label"=>"ms-edit.php");
$hook_suffix[] = array("value"=>"ms-options.php","label"=>"ms-options.php");
$hook_suffix[] = array("value"=>"ms-sites.php","label"=>"ms-sites.php");
$hook_suffix[] = array("value"=>"ms-themes.php","label"=>"ms-themes.php");
$hook_suffix[] = array("value"=>"ms-upgrade-network.php","label"=>"ms-upgrade-network.php");
$hook_suffix[] = array("value"=>"ms-users.php","label"=>"ms-users.php");
$hook_suffix[] = array("value"=>"my-sites.php","label"=>"my-sites.php");
$hook_suffix[] = array("value"=>"nav-menus.php","label"=>"nav-menus.php");
$hook_suffix[] = array("value"=>"network.php","label"=>"network.php");
$hook_suffix[] = array("value"=>"options-discussion.php","label"=>"options-discussion.php");
$hook_suffix[] = array("value"=>"options-general.php","label"=>"options-general.php");
$hook_suffix[] = array("value"=>"options-head.php","label"=>"options-head.php");
$hook_suffix[] = array("value"=>"options-media.php","label"=>"options-media.php");
$hook_suffix[] = array("value"=>"options-permalink.php","label"=>"options-permalink.php");
$hook_suffix[] = array("value"=>"options-privacy.php","label"=>"options-privacy.php");
$hook_suffix[] = array("value"=>"options-reading.php","label"=>"options-reading.php");
$hook_suffix[] = array("value"=>"options-writing.php","label"=>"options-writing.php");
$hook_suffix[] = array("value"=>"options.php","label"=>"options.php");
$hook_suffix[] = array("value"=>"plugin-editor.php","label"=>"plugin-editor.php");
$hook_suffix[] = array("value"=>"plugin-install.php","label"=>"plugin-install.php");
$hook_suffix[] = array("value"=>"plugins.php","label"=>"plugins.php");
$hook_suffix[] = array("value"=>"post-new.php","label"=>"post-new.php");
$hook_suffix[] = array("value"=>"post.php","label"=>"post.php");
$hook_suffix[] = array("value"=>"press-this.php","label"=>"press-this.php");
$hook_suffix[] = array("value"=>"privacy-policy-guide.php","label"=>"privacy-policy-guide.php");
$hook_suffix[] = array("value"=>"privacy.php","label"=>"privacy.php");
$hook_suffix[] = array("value"=>"profile.php","label"=>"profile.php");
$hook_suffix[] = array("value"=>"revision.php","label"=>"revision.php");
$hook_suffix[] = array("value"=>"setup-config.php","label"=>"setup-config.php");
$hook_suffix[] = array("value"=>"site-health-info.php","label"=>"site-health-info.php");
$hook_suffix[] = array("value"=>"site-health.php","label"=>"site-health.php");
$hook_suffix[] = array("value"=>"term.php","label"=>"term.php");
$hook_suffix[] = array("value"=>"theme-editor.php","label"=>"theme-editor.php");
$hook_suffix[] = array("value"=>"theme-install.php","label"=>"theme-install.php");
$hook_suffix[] = array("value"=>"themes.php","label"=>"themes.php");
$hook_suffix[] = array("value"=>"tools.php","label"=>"tools.php");
$hook_suffix[] = array("value"=>"update-core.php","label"=>"update-core.php");
$hook_suffix[] = array("value"=>"update.php","label"=>"update.php");
$hook_suffix[] = array("value"=>"upgrade-functions.php","label"=>"upgrade-functions.php");
$hook_suffix[] = array("value"=>"upgrade.php","label"=>"upgrade.php");
$hook_suffix[] = array("value"=>"upload.php","label"=>"upload.php");
$hook_suffix[] = array("value"=>"user-edit.php","label"=>"user-edit.php");
$hook_suffix[] = array("value"=>"user-new.php","label"=>"user-new.php");
$hook_suffix[] = array("value"=>"users.php","label"=>"users.php");
$hook_suffix[] = array("value"=>"widgets.php","label"=>"widgets.php");
 

$GLOBALS['HOOK_SUFFIX'] = $hook_suffix;

?>