<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$module['name'] = 'html-input-tel';
$module['label'] = 'HTML ~ Input: Telp';

$module['options']['value'] = '+628123456789';
$module['options']['placeholder'] = '+628123456789';

$module['default']['value'] = '';
$module['default']['placeholder'] = '+628123456789';

$module['info']['value'] = 'Please enter the phone number';
$module['info']['placeholder'] = 'Please enter the phone number';

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
$module['callback'] .= "\t\t" . '?>' . "\r\n";
$module['callback'] .= "\t\t" . '<input class="regular-text" id="{{ID}}" type="tel" name="{{SETTING}}[{{VAR}}]" placeholder="{{PLACEHOLDER}}" value="<?php echo $value; ?>" />' . "\r\n";
$module['callback'] .= "\t\t" . '<p class="description"><?php _e("{{INFO}}","{{TEXT-DOMAIN}}") ?></p>' . "\r\n";
$module['callback'] .= "\t\t" . '<?php' . "\r\n";

$module['rest_api_callback'] = null;
$module['rest_api_callback'] .= "" . '' . "\r\n";
$module['rest_api_callback'] .= "\t\t" . 'if(isset($options["{{VAR}}"])){' . "\r\n";
$module['rest_api_callback'] .= "\t\t\t" . '$data["{{VAR}}"] = esc_html($options["{{VAR}}"]);' . "\r\n";
$module['rest_api_callback'] .= "\t\t" . '}else{' . "\r\n";
$module['rest_api_callback'] .= "\t\t\t" . '$data["{{VAR}}"] = null;' . "\r\n";
$module['rest_api_callback'] .= "\t\t" . '}' . "\r\n";

?>