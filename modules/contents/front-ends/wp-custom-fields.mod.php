<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/


$module['name'] = 'wp-custom-fields';
$module['label'] = 'WP - Custom Fields';
$module['options']['help'] = 'Select the custom field you need';

$db = new DB();
$string = new StringConvert();
$custom_posts = $db->getCustomPosts();
$custom_image_sizes = $db->getImageSizes();
$meta_boxes = $db->getMetaBoxes();

$project = $db->getProject();
$shortname = $project['short-name'];

if (!isset($_SESSION['DUMMY_APPLY_FOR']))
{
    $_SESSION['DUMMY_APPLY_FOR'] = 'post';
}


$customFields = array();
foreach ($meta_boxes as $meta_box)
{
    if (!is_array($meta_box['fields']))
    {
        $meta_box['fields'] = array();
    }
    $screen = implode($meta_box['screen']);
    foreach ($meta_box['fields'] as $field)
    {
        $regex = $_SESSION['DUMMY_APPLY_FOR'];
        if (preg_match("/" . $regex . "/", $screen))
        {
            $customFields[] = array("value" => $field['name'], "label" => 'post: ' . $screen . ' -&raquo; ' . strtolower($shortname) . '_' . $field['name']);
        }

    }
}


$module['singular'] = null;
$module['singular'] .= "\t\t\t" . '' . "\r\n";
$module['singular'] .= "\t\t\t" . '$postID = get_the_ID();' . "\r\n";
$module['singular'] .= "\t\t\t" . '$data_{{VAR}} = get_post_meta($postID,"_{{SHORTNAME}}_{{OPTION}}",true);' . "\r\n";
$module['singular'] .= "\t\t\t" . '$new_content .= "<dl>";' . "\r\n";
$module['singular'] .= "\t\t\t" . '$new_content .= "<dt>{{LABEL}}</dt>";' . "\r\n";
$module['singular'] .= "\t\t\t" . '$new_content .= "<dd>".$data_{{VAR}}."</dd>";' . "\r\n";
$module['singular'] .= "\t\t\t" . '$new_content .= "</dl>";' . "\r\n";
$module['singular'] .= "\t\t\t" . '' . "\r\n";



$module['code']['js'] = null;
$module['code']['js'] .= "\t\t\t\t\t" . '$("#contents-front-end-option-" + item_target).addClass("hidden");' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'var options = ' . json_encode($customFields) . ';' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'var select_custom_pages = "";' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'select_custom_pages += "<select onclick=\"setField(\'#contents-front-end-option-" + item_target + "\',this.value)\" id=\"#contents-front-end-option-select-" + item_target + "\" class=\"form-control\">"; ' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '$.each(options, function(i, item) {' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . 'var selected = "";' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . 'if(front_end_field_option[item_target] == item.value ){' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t\t" . 'selected = "selected";' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . '}' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . 'select_custom_pages += "<option " + selected + " value=\"" + item.value +  "\">" + item.label +  "</option>"; ' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '});' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'select_custom_pages += "</select>"; ' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '$("#contents-front-end-option-select-" + item_target).html(select_custom_pages);' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '$("#contents-front-end-option-" + item_target).val(front_end_field_option[item_target]);' . "\r\n";

?>