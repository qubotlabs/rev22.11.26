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


$module['name'] = 'wp-dropdown-categories';
$module['label'] = 'WordPress ~ Dropdown Categories';

$module['options']['value'] = '';
$module['options']['placeholder'] = '';
$module['options']['help'] = 'choose categories';

$module['default']['value'] = '';
$module['default']['placeholder'] = '';

$module['info']['value'] = '';
$module['info']['placeholder'] = '';

$current_page = null;
if (isset($__field['options']))
{
    if ($__field['options'] != '')
    {
        $current_page = $__field['options'];
    }
}


$module['settings_field'] = null;
$module['settings_field'] .= "\t\t" . 'add_settings_field(' . "\r\n";
$module['settings_field'] .= "\t\t\t" . '"{{VAR}}", //id' . "\r\n";
$module['settings_field'] .= "\t\t\t" . '__("{{LABEL}}","{{TEXT-DOMAIN}}"), //title' . "\r\n";
$module['settings_field'] .= "\t\t\t" . 'array($this,"{{CALLBACK}}"), //callback' . "\r\n";
$module['settings_field'] .= "\t\t\t" . '"{{PAGE}}", //page' . "\r\n";
$module['settings_field'] .= "\t\t\t" . '"{{SECTION}}" //section' . "\r\n";
$module['settings_field'] .= "\t\t" . ');' . "\r\n";

$module['sanitize'] = null;
$module['sanitize'] .= "\t\t" . 'if(isset($input["{{VAR}}"]))' . "\r\n";
$module['sanitize'] .= "\t\t\t" . '$new_input["{{VAR}}"] = sanitize_text_field($input["{{VAR}}"]);' . "\r\n";
$module['sanitize'] .= "\t\t" . '' . "\r\n";


$module['callback'] = null;
$module['callback'] .= "\t\t" . 'if(isset($this->{{SETTING}}["{{VAR}}"])){' . "\r\n";
$module['callback'] .= "\t\t\t" . '$value = esc_attr($this->{{SETTING}}["{{VAR}}"]);' . "\r\n";
$module['callback'] .= "\t\t" . '}else{' . "\r\n";
$module['callback'] .= "\t\t\t" . '$value = "{{DEFAULT}}";' . "\r\n";
$module['callback'] .= "\t\t" . '}' . "\r\n";

$module['callback'] .= "\t\t" . '$args = array(' . "\r\n";
$module['callback'] .= "\t\t\t" . '"taxonomy" => "' . $current_page . '",' . "\r\n";
$module['callback'] .= "\t\t\t" . '"show_count" => true,' . "\r\n";
$module['callback'] .= "\t\t\t" . '"hide_empty" => false,' . "\r\n";
$module['callback'] .= "\t\t\t" . '"echo" => true,' . "\r\n";
$module['callback'] .= "\t\t\t" . '"id" => "{{ID}}",' . "\r\n";
$module['callback'] .= "\t\t\t" . '"name" => "{{SETTING}}[{{VAR}}]",' . "\r\n";
$module['callback'] .= "\t\t\t" . '"class" => "regular-text {{SHORTNAME}}-form-control",' . "\r\n";
$module['callback'] .= "\t\t\t" . '"selected" => $value,' . "\r\n";
$module['callback'] .= "\t\t" . ');' . "\r\n";
$module['callback'] .= "\t\t" . '?>' . "\r\n";
$module['callback'] .= "\t\t" . '<?php wp_dropdown_categories($args); ?>' . "\r\n";
$module['callback'] .= "\t\t" . '<p class="description"><?php _e("{{INFO}}", "{{TEXT-DOMAIN}}"); ?></p>' . "\r\n";
$module['callback'] .= "\t\t" . '<?php' . "\r\n";

$module['admin_footer'] = null;
$module['admin_enqueue_scripts'] = null;

$module['rest_api_callback'] = null;
$module['rest_api_callback'] .= "" . '' . "\r\n";
$module['rest_api_callback'] .= "\t\t" . 'if(isset($options["{{VAR}}"])){' . "\r\n";
$module['rest_api_callback'] .= "\t\t\t" . '$term = get_term($options["{{VAR}}"]);' . "\r\n";
$module['rest_api_callback'] .= "\t\t\t" . '$data["{{VAR}}"]["term_id"] = $term->term_id;' . "\r\n";
$module['rest_api_callback'] .= "\t\t\t" . '$data["{{VAR}}"]["name"] = esc_html($term->name);' . "\r\n";
$module['rest_api_callback'] .= "\t\t\t" . '$data["{{VAR}}"]["slug"] = esc_html($term->slug);' . "\r\n";
$module['rest_api_callback'] .= "\t\t" . '}else{' . "\r\n";
$module['rest_api_callback'] .= "\t\t\t" . '$data["{{VAR}}"] = null;' . "\r\n";
$module['rest_api_callback'] .= "\t\t" . '}' . "\r\n";

$__taxo = array();
$__taxo[] = array('value' => 'category', 'label' => 'category (WP Core)');
$__taxo[] = array('value' => 'post_tag', 'label' => 'post_tag (WP Core)');
foreach ($db->getTaxonomies() as $tax)
{
    if ($tax['hierarchical'] == false)
    {
        $__taxo[] = array('value' => $string->toVar($project['short-name'] . '_' . $tax['name']), 'label' => $string->toVar($project['short-name'] . '_' . $tax['name']) . ' (Custom Taxonomies)');
    }
}

$module['code']['js'] = null;
$module['code']['js'] .= "\t\t\t\t\t" . '' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '$("#plugin-options-options-" + item_target).addClass("hidden");' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'var options = ' . json_encode($__taxo) . ';' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'var select_custom_pages ="";' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'select_custom_pages += "<select onclick=\"setField(\'#plugin-options-options-" + item_target + "\',this.value)\" id=\"#plugin-options-options-select-option-" + item_target + "\" class=\"form-control\">"; ' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '$.each(options, function(i, item) {' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . 'var selected = "";' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . 'if(option_field_options[item_target] == item.value ){' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . 'selected = "selected";' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . '}' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . 'select_custom_pages += "<option " + selected + " value=\"" + item.value +  "\">" + item.label +  "</option>"; ' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '});' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'select_custom_pages += "</select>"; ' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '$("#plugin-options-options-select-" + item_target).html(select_custom_pages);' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '$("#plugin-options-options-" + item_target).val(option_field_options[item_target]);' . "\r\n";

?>