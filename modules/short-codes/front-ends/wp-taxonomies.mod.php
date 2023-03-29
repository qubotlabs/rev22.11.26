<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/


$module['name'] = 'wp-taxonomies';
$module['label'] = 'WP - Taxonomies';


$db = new DB();
$string = new StringConvert();
$getTaxonomies = $db->getTaxonomies();
$getExtraFields = $db->getExtraFields();
$project = $db->getProject();
$shortname = $project['short-name'];

$module['shortcode'] = null;
$module['shortcode'] .= "\t\t" . '$args = array(' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '"hide_empty" => "true",' . "\r\n";
$module['shortcode'] .= "\t\t" . ');' . "\r\n";
$module['shortcode'] .= "\t\t" . '' . "\r\n";
$module['shortcode'] .= "\t\t" . '$terms = get_terms("{{OPTION}}",$args);' . "\r\n";

$module['shortcode'] .= "\t\t" . 'foreach($terms as $term){' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '//use this variable for get taxonomies data;' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '$term_id = $term->term_id;' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '$name = $term->name;' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '$description = $term->description;' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '$count = $term->count;' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '$href = get_tag_link($term_id);' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '//use this variable for get extra-field;' . "\r\n";

foreach ($getExtraFields as $extraField)
{
    if (!isset($__field['option']))
    {
        $__field['option'] = '';
    }
    
    if(!isset($extraField['taxonomies'])){
        $extraField['taxonomies'] = array();  
    }
    
    if(!is_array($extraField['taxonomies'])){
        $extraField['taxonomies'] = array();  
    }
    
    if (in_array($__field['option'], $extraField['taxonomies']))
    {
        foreach ($extraField['fields'] as $_field)
        {
            $nameId = $string->toFileName($__field['option'] . '-' . $_field['name']);
            $nameVar = $string->toVar($_field['name']);
            $module['shortcode'] .= "\t\t\t" . '$extra_data_' . $nameVar . ' = get_term_meta($term_id, "' . $nameId . '", true );' . "\r\n";
        }
    }
}
$module['shortcode'] .= "\t\t\t" . '' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '// show to html' . "\r\n";
$module['shortcode'] .= "\t\t\t" . '$content .= \'<a class="{{SHORTNAME}}-widget-{{NAME}}-badge" href="\'.$href.\'">\'.$name.\' (\'.$count.\')</a>\';' . "\r\n";
$module['shortcode'] .= "\t\t" . '}' . "\r\n";

$module['shortcode'] .= "\t\t" . '$content .= \'<style type="text/css">\';' . "\r\n";
$module['shortcode'] .= "\t\t" . '$content .= \'.{{SHORTNAME}}-widget-{{NAME}}-badge{background: #000;color: #fff;padding: 6px;margin-right: 6px;margin-bottom: 6px;border: 0;border-radius: 6px;display: inline-block;}\';' . "\r\n";
$module['shortcode'] .= "\t\t" . '$content .= \'</style>\';' . "\r\n";



$list_taxonomies = array();
$list_taxonomies[] = array("value" => "category", "label" => "Categories (WP Core)");
$list_taxonomies[] = array("value" => "post_tag", "label" => "Tags (WP Core)");
foreach ($getTaxonomies as $_taxonomy)
{
    $list_taxonomies[] = array("value" => $string->toVar($shortname . '_' . $_taxonomy['name']), "label" => $_taxonomy['label'] . ' (Custom Taxonomy)');
}


$module['code']['js'] = null;
$module['code']['js'] .= "\t\t\t\t\t" . '$("#short-codes-front-end-option-" + item_target).addClass("hidden");' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'var options = ' . json_encode($list_taxonomies) . ';' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'var select_custom_pages ="";' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'select_custom_pages += "<select onclick=\"setField(\'#short-codes-front-end-option-" + item_target + "\',this.value)\" id=\"#short-codes-front-end-option-select-" + item_target + "\" class=\"form-control\">"; ' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '$.each(options, function(i, item) {' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . 'var selected = "";' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . 'if(front_end_field_option[item_target] == item.value ){' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t\t" . 'selected = "selected";' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . '}' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . 'select_custom_pages += "<option " + selected + " value=\"" + item.value +  "\">" + item.label +  "</option>"; ' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '});' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'select_custom_pages += "</select>"; ' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '$("#short-codes-front-end-option-select-" + item_target).html(select_custom_pages);' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '$("#short-codes-front-end-option-" + item_target).val(front_end_field_option[item_target]);' . "\r\n";

?>