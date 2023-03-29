<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$module['name'] = 'html-select';
$module['label'] = 'HTML ~ Select';

$module['options']['value'] = 'option 1|option 2|option 3';
$module['options']['placeholder'] = 'option 1|option 2|option 3';
$module['options']['help'] = '<strong>format</strong>: separator with: <code>|</code>, eg: opt1|opt2|opt3';

$module['default']['value'] = 'option 1';
$module['default']['placeholder'] = 'option 1';
$module['info']['value'] = '';
$module['info']['placeholder'] = '';

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
if (isset($__field['options']))
{
    if ($__field['options'] != '')
    {
        $options = explode("|", $__field['options']);
        foreach ($options as $opt)
        {
            $module['callback'] .= "\t\t" . '$options[] = array( "value"=>"' . strtolower($opt) . '", "label" => __("' . ucwords($opt) . '","{{TEXT-DOMAIN}}") );' . "\r\n";
        }
    }
}
$module['callback'] .= "\t\t" . 'if(isset($this->{{SETTING}}["{{VAR}}"])){' . "\r\n";
$module['callback'] .= "\t\t\t" . '$value = esc_attr($this->{{SETTING}}["{{VAR}}"]);' . "\r\n";
$module['callback'] .= "\t\t" . '}else{' . "\r\n";
$module['callback'] .= "\t\t\t" . '$value = "{{DEFAULT}}";' . "\r\n";
$module['callback'] .= "\t\t" . '}' . "\r\n";
$module['callback'] .= "\t\t" . '?>' . "\r\n";
$module['callback'] .= "\t\t\t" . '<select class="regular-text" id="{{ID}}" name="{{SETTING}}[{{VAR}}]">' . "\r\n";
$module['callback'] .= "\t\t\t" . '<?php' . "\r\n";
$module['callback'] .= "\t\t\t" . 'foreach($options as $option){' . "\r\n";
$module['callback'] .= "\t\t\t\t" . 'if($value == $option["value"]){' . "\r\n";
$module['callback'] .= "\t\t\t\t\t" . 'echo "<option selected value=\"" . $option["value"] . "\">" . $option["label"] . "</option>";' . "\r\n";
$module['callback'] .= "\t\t\t\t" . '}else{' . "\r\n";
$module['callback'] .= "\t\t\t\t\t" . 'echo "<option value=\"" . $option["value"] . "\">" . $option["label"] . "</option>";' . "\r\n";
$module['callback'] .= "\t\t\t\t" . '}' . "\r\n";
$module['callback'] .= "\t\t\t" . '}' . "\r\n";
$module['callback'] .= "\t\t\t" . '?>' . "\r\n";
$module['callback'] .= "\t\t\t" . '</select>' . "\r\n";
$module['callback'] .= "\t\t" . '<p class="description"><?php _e("{{INFO}}","{{TEXT-DOMAIN}}") ?></p>' . "\r\n";
$module['callback'] .= "\t\t" . '<?php' . "\r\n";


$module['admin_footer'] = null;
$module['admin_enqueue_scripts'] = null;

$module['rest_api_callback'] = null;
$module['rest_api_callback'] .= "" . '' . "\r\n";
$module['rest_api_callback'] .= "\t\t" . 'if(isset($options["{{VAR}}"])){' . "\r\n";
$module['rest_api_callback'] .= "\t\t\t" . '$data["{{VAR}}"] = esc_html($options["{{VAR}}"]);' . "\r\n";
$module['rest_api_callback'] .= "\t\t" . '}else{' . "\r\n";
$module['rest_api_callback'] .= "\t\t\t" . '$data["{{VAR}}"] = null;' . "\r\n";
$module['rest_api_callback'] .= "\t\t" . '}' . "\r\n";


?>