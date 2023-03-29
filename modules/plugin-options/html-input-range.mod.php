<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$module['name'] = 'html-input-range';
$module['label'] = 'HTML ~ Input: Range';

$module['options']['value'] = '0|10';
$module['options']['placeholder'] = '0|10';
$module['options']['help'] = '<strong>format</strong>: min|max, eg: 1|10';

$module['default']['value'] = '5';
$module['default']['placeholder'] = '5';

$module['info']['value'] = '';
$module['info']['placeholder'] = '';

// TODO: EDIT FIELDS
$range[0] = 0;
$range[1] = 100;
if (isset($__field['options']))
{
    if ($__field['options'] != '')
    {
        $range = explode("|", $__field['options']);
    }
}
if (!isset($range[0]))
{
    $range[0] = 0;
}
if (!isset($range[1]))
{
    $range[1] = 100;
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
$module['callback'] .= "\t\t" . '$min = ' . (int)$range[0] . ';' . "\r\n";
$module['callback'] .= "\t\t" . '$max = ' . (int)$range[1] . ';' . "\r\n";
$module['callback'] .= "\t\t" . '?>' . "\r\n";
$module['callback'] .= "\t\t" . '<input class="regular-text" max="<?php _e($max); ?>" min="<?php _e($min); ?>" id="{{ID}}" type="range" name="{{SETTING}}[{{VAR}}]" value="<?php echo $value; ?>" />' . "\r\n";
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