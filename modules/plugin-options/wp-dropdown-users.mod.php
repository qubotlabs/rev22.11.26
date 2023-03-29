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


$module['name'] = 'wp-dropdown-users';
$module['label'] = 'WordPress ~ Dropdown Users';

$module['options']['value'] = 'subcriber';
$module['options']['placeholder'] = 'subcriber';
$module['options']['help'] = 'choose user role';

$module['default']['value'] = 'subcriber';
$module['default']['placeholder'] = 'subcriber';

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
if (isset($__field['options']))
{
    if ($__field['options'] != '')
    {
        if ($__field['options'] != 'none')
        {
            $module['callback'] .= "\t\t\t" . '"role" => array("' . $__field['options'] . '"),' . "\r\n";
        }
    }
}

$module['callback'] .= "\t\t\t" . '"echo" => true,' . "\r\n";
$module['callback'] .= "\t\t\t" . '"id" => "{{ID}}",' . "\r\n";
$module['callback'] .= "\t\t\t" . '"name" => "{{SETTING}}[{{VAR}}]",' . "\r\n";
$module['callback'] .= "\t\t\t" . '"class" => "regular-text {{SHORTNAME}}-form-control",' . "\r\n";
$module['callback'] .= "\t\t\t" . '"selected" => $value,' . "\r\n";
$module['callback'] .= "\t\t" . ');' . "\r\n";
$module['callback'] .= "\t\t" . '?>' . "\r\n";
$module['callback'] .= "\t\t\t" . '<?php wp_dropdown_users($args); ?>' . "\r\n";
$module['callback'] .= "\t\t\t" . '<p class="description"><?php _e("{{INFO}}", "{{TEXT-DOMAIN}}"); ?></p>' . "\r\n";
$module['callback'] .= "\t\t" . '<?php' . "\r\n";

$module['admin_footer'] = null;
$module['admin_enqueue_scripts'] = null;


$module['rest_api_callback'] = null;
$module['rest_api_callback'] .= "" . '' . "\r\n";
$module['rest_api_callback'] .= "\t\t" . 'if(isset($options["{{VAR}}"])){' . "\r\n";
//$module['rest_api_callback'] .= "\t\t\t" . '$data["{{VAR}}"] = esc_html($options["{{VAR}}"]);' . "\r\n";

$module['rest_api_callback'] .= "\t\t\t" . '$user = get_userdata($options["{{VAR}}"]);' . "\r\n";
$module['rest_api_callback'] .= "\t\t\t" . '$data["{{VAR}}"]["ID"] = $user->ID;' . "\r\n";
$module['rest_api_callback'] .= "\t\t\t" . '$data["{{VAR}}"]["display_name"] = esc_html($user->data->display_name);' . "\r\n";
$module['rest_api_callback'] .= "\t\t\t" . '$data["{{VAR}}"]["user_nicename"] = esc_html($user->data->user_nicename);' . "\r\n";
$module['rest_api_callback'] .= "\t\t\t" . '$data["{{VAR}}"]["user_url"] = esc_html($user->data->user_url);' . "\r\n";
$module['rest_api_callback'] .= "\t\t\t" . '$data["{{VAR}}"]["user_url"] = esc_html($user->data->user_url);' . "\r\n";
$module['rest_api_callback'] .= "\t\t" . '}else{' . "\r\n";
$module['rest_api_callback'] .= "\t\t\t" . '$data["{{VAR}}"] = null;' . "\r\n";
$module['rest_api_callback'] .= "\t\t" . '}' . "\r\n";

$__roles = array();
$__roles[] = array('value' => 'none', 'label' => 'None');
$__roles[] = array('value' => 'subcriber', 'label' => 'Subcriber (WP Core)');
$__roles[] = array('value' => 'author', 'label' => 'Author (WP Core)');
$__roles[] = array('value' => 'contributor', 'label' => 'Contributor (WP Core)');
$__roles[] = array('value' => 'editor', 'label' => 'Editor (WP Core)');


foreach ($db->getRoles() as $_role)
{

    $__roles[] = array('value' => $string->toVar($project['short-name'] . '_' . $_role['name']), 'label' => $string->toVar($project['short-name'] . '_' . $_role['name']) . ' (Custom Roles)');
}

$module['code']['js'] = null;
$module['code']['js'] .= "\t\t\t\t\t" . '' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '$("#plugin-options-options-" + item_target).addClass("hidden");' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'var options = ' . json_encode($__roles) . ';' . "\r\n";
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