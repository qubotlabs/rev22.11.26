<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$db = new DB();
$string = new StringConvert();
$plugin_options = $db->getPluginOptions();
$project = $db->getProject();
$shortname = $project['short-name'];

$module['name'] = 'wp-options';
$module['label'] = 'WP - Options';
$module['options']['help'] = 'Select the option field you need';

if (isset($__field['option']))
{
    $option = explode(":", $__field['option']);
    if (isset($option[1]))
    {
        $module['singular'] = null;
        $module['singular'] .= "\t\t\t" . '// get option' . "\r\n";
        $module['singular'] .= "\t\t\t" . '$option = get_option("{{SHORTNAME}}_' . $option[0] . '_setting");' . "\r\n";
        $module['singular'] .= "\t\t\t" . '$new_content .= "<dl>";' . "\r\n";
        $module['singular'] .= "\t\t\t" . '$new_content .= "<dt>{{LABEL}}</dt>";' . "\r\n";
        $module['singular'] .= "\t\t\t" . '$new_content .= "<dd>".$option["{{SHORTNAME}}_' . $option[1] . '"]."</dd>";' . "\r\n";
        $module['singular'] .= "\t\t\t" . '$new_content .= "</dl>";' . "\r\n";
        $module['singular'] .= "\t\t\t" . '' . "\r\n";
    }
}

$options = array();
foreach ($plugin_options as $option)
{
    foreach ($option['fields'] as $field)
    {
        $options[] = array("value" => $option['name'] . ':' . $field['name'], "label" => 'option: ' . $option['name'] . ' -&raquo; ' . strtolower($shortname) . '_' . $field['name'] . '');
    }
}

$module['code']['js'] = null;
$module['code']['js'] .= "\t\t\t\t\t" . '$("#contents-front-end-option-" + item_target).addClass("hidden");' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'var options = ' . json_encode($options) . ';' . "\r\n";
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