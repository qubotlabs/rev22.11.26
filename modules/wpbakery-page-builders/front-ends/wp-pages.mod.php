<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$module['name'] = 'wp-pages';
$module['label'] = 'WP - Pages';


$db = new DB();
$string = new StringConvert();
$custom_posts = $db->getCustomPosts();
$custom_image_sizes = $db->getImageSizes();
$meta_boxes = $db->getMetaBoxes();

$project = $db->getProject();
$shortname = $project['short-name'];

$module['shortcode'] = null;
$module['shortcode'] .= "\t\t" . '$args = array(' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '"post_status" => "publish",' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '"post_type" => "{{OPTION}}",' . "\r\n";
$module['shortcode'] .= "\t\t" . ');' . "\r\n";
$module['shortcode'] .= "\t\t" . '' . "\r\n";
$module['shortcode'] .= "\t\t" . '$posts = get_posts($args);' . "\r\n";
$module['shortcode'] .= "\t\t" . '$output .= \'<h4>\' . __("{{LABEL}}","{{TEXTDOMAIN}}"). \'</h4>\';' . "\r\n";
$module['shortcode'] .= "\t\t" . '$output .= \'<table style="border: 0;">\';' . "\r\n";
$module['shortcode'] .= "\t\t" . 'foreach($posts as $post){' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '// get featured image id' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '$attachment_id = get_post_thumbnail_id($post->ID); //get attachment id' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '$href = get_permalink($post->ID); //get link' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '// use the variables below to display the image' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '$image_size_thumbnail = wp_get_attachment_image_src($attachment_id);' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '$image_size_large = wp_get_attachment_image_src($attachment_id,"large");' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '$image_size_medium = wp_get_attachment_image_src($attachment_id,"medium");' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '$image_size_full = wp_get_attachment_image_src($attachment_id,"full");' . "\r\n";
foreach ($custom_image_sizes as $image_size)
{
    $name = $string->toVar($shortname . '_' . $image_size['name']);
    $module['shortcode'] .= "\t\t\t" . '$image_' . $name . ' = wp_get_attachment_image_src($attachment_id,"' . $name . '"); //custom image sizes' . "\r\n";
}
$module['shortcode'] .= "\t\t\t" . '' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '// use the variables below to display the custom-fields' . "\r\n";
foreach ($meta_boxes as $meta_box)
{
    if (!isset($__field['option']))
    {
        $__field['option'] = '';
    }
    if (!isset($meta_box['screen']))
    {
        $meta_box['screen'] = array();
    }
    if (in_array($__field['option'], $meta_box['screen']))
    {
        foreach ($meta_box['fields'] as $_field)
        {
            $name = $string->toVar($shortname . '_' . $_field['name']);
            $var_name = $string->toVar($_field['name']);
            $module['shortcode'] .= "\t\t\t" . '$metadata_' . $var_name . ' = get_post_meta($post->ID, "_' . $name . '", true); ' . "\r\n";
        }
    }
}
$module['shortcode'] .= "\t\t\t" . '' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '$output .= \'<tr style="border: 0;">\';' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '$output .= \'<td style="border: 0;width: 50px;">\';' . "\r\n";
$module['shortcode'] .= "\t\t\t" . 'if(isset($image_size_thumbnail[0])){' . "\r\n";
$module['shortcode'] .= "\t\t\t\t" . '$output .= \'<img style="width: 40px;height: 40px;" src="\' . $image_size_thumbnail[0] . \'" />\';' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '}else{' . "\r\n";
$module['shortcode'] .= "\t\t\t\t" . '$output .= \'<img style="width: 40px;height: 40px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAMAAAC5zwKfAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAAZQTFRF39/foqKiTYjD0wAAAH1JREFUeNrslksKgDAMBV/vf2ndiNgGBfNaA85sA9OW/CoBAAD8nfbI98JcfI3w7rmVhFGGMsIw52mhfEK5hW2O8PB4yua8n8x1qMsZRYVyCmUWyirsJm9SOI7ybB16hdG2yfdyZ3y7U/ZeC2NllpRZWP3nAAAAAAAz2AQYAIFzAlrZWtsiAAAAAElFTkSuQmCC" />\';' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '}' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '$output .= \'</td>\';' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '$output .= \'<td style="border: 0;">\';' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '$output .= \'<a href="\'.$href.\'">\' . $post->post_title . \'</a>\';' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '$output .= \'</td>\';' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '$output .= \'</tr>\';' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '' . "\r\n";
$module['shortcode'] .= "\t\t" . '}' . "\r\n";
$module['shortcode'] .= "\t\t" . '$output .= \'</table>\';' . "\r\n";

$postType = array();
$postType[] = array("value" => "page", "label" => "Page (WP Core)");
$postType[] = array("value" => "post", "label" => "Post (WP Core)");
foreach ($custom_posts as $custom_post)
{
    $postType[] = array("value" => $string->toVar($shortname . '_' . $custom_post['name']), "label" => $custom_post['label'] . ' (Custom Post)');
}

$module['code']['js'] = null;
$module['code']['js'] .= "\t\t\t\t\t" . '$("#wpbakery-page-builders-front-end-option-" + item_target).addClass("hidden");' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'var options = ' . json_encode($postType) . ';' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'var select_custom_pages ="";' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'select_custom_pages += "<select onclick=\"setField(\'#wpbakery-page-builders-front-end-option-" + item_target + "\',this.value)\" id=\"#widgets-front-end-option-select-" + item_target + "\" class=\"form-control\">"; ' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '$.each(options, function(i, item) {' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . 'var selected = "";' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . 'if(front_end_field_option[item_target] == item.value ){' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t\t" . 'selected = "selected";' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . '}' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . 'select_custom_pages += "<option " + selected + " value=\"" + item.value +  "\">" + item.label +  "</option>"; ' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '});' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'select_custom_pages += "</select>"; ' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '$("#wpbakery-page-builders-front-end-option-select-" + item_target).html(select_custom_pages);' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '$("#wpbakery-page-builders-front-end-option-" + item_target).val(front_end_field_option[item_target]);' . "\r\n";

?>