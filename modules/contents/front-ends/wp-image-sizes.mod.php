<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$db = new DB();
$string = new StringConvert();
$project = $db->getProject();


$module['name'] = 'wp-image-sizes';
$module['label'] = 'WP - Image Sizes';


$module['options']['help'] = 'Select the image size you need';
 




$imagesizes = $db->getImageSizes();

$module['singular'] = null;
$module['singular'] .= "\t\t\t" . '' . "\r\n";
$module['singular'] .= "\t\t\t" . '$postID = get_the_ID();' . "\r\n";
$module['singular'] .= "\t\t\t" . '$attachmentID = get_post_thumbnail_id($postID);' . "\r\n";
$module['singular'] .= "\t\t\t" . '' . "\r\n";
$module['singular'] .= "\t\t\t" . '// image source' . "\r\n";
$module['singular'] .= "\t\t\t" . '$image["large"] = wp_get_attachment_image_src($attachmentID,"large");' . "\r\n";
$module['singular'] .= "\t\t\t" . '$image["medium"] = wp_get_attachment_image_src($attachmentID,"medium");' . "\r\n";
$module['singular'] .= "\t\t\t" . '$image["full"] = wp_get_attachment_image_src($attachmentID,"full");' . "\r\n";
foreach ($imagesizes as $imagesize)
{
    $module['singular'] .= "\t\t\t" . '$image["' . $string->toVar($imagesize['name']) . '"] = wp_get_attachment_image_src($attachmentID,"{{SHORTNAME}}_' . $string->toVar($imagesize['name']) . '");' . "\r\n";
}
$module['singular'] .= "\t\t\t" . '' . "\r\n";
$module['singular'] .= "\t\t\t" . '$new_content .= \'<p><img class="thumbnail" src="\'. $image["{{OPTION}}"][0]  . \'" width="\'. $image["{{OPTION}}"][1]  . \'" height="\'. $image["{{OPTION}}"][2]  . \'" alt="{{LABEL}}" ></p>\' ;' . "\r\n";


$sizes = array();
$sizes[] = array("value" => "large", "label" => "Large");
$sizes[] = array("value" => "medium", "label" => "Medium");
$sizes[] = array("value" => "full", "label" => "Full");


foreach ($imagesizes as $imagesize)
{
    $sizes[] = array("value" => $imagesize['name'], "label" => $imagesize['label'] . ' (' . $imagesize['name'] . ')');
}


$module['code']['js'] = null;
$module['code']['js'] .= "\t\t\t\t\t" . '$("#contents-front-end-option-" + item_target).addClass("hidden");' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'var options = ' . json_encode($sizes) . ';' . "\r\n";
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