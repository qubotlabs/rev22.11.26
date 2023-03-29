<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/


$module['name'] = 'html-input-checkbox';
$module['label'] = 'HTML ~ Input: Checkbox';

$module['options']['value'] = '';
$module['options']['placeholder'] = 'Yes, I agree';

$module['default']['value'] = '';
$module['default']['placeholder'] = '';

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
$module['sanitize'] .= "\t\t" . 'if(isset($input["{{VAR}}"])){' . "\r\n";
$module['sanitize'] .= "\t\t\t" . '$new_input["{{VAR}}"] = true;' . "\r\n";
$module['sanitize'] .= "\t\t" . '}else{' . "\r\n";
$module['sanitize'] .= "\t\t\t" . '$new_input["{{VAR}}"] = false;' . "\r\n";
$module['sanitize'] .= "\t\t" . '}' . "\r\n";

$module['callback'] = null;

$module['callback'] .= "\t\t" . 'if(!isset($this->{{SETTING}}["{{VAR}}"])){' . "\r\n";
$module['callback'] .= "\t\t\t" . '$this->{{SETTING}}["{{VAR}}"] = false;' . "\r\n";
$module['callback'] .= "\t\t" . '}' . "\r\n";

$module['callback'] .= "\t\t" . 'if($this->{{SETTING}}["{{VAR}}"] == true){' . "\r\n";
$module['callback'] .= "\t\t\t" . '$checked = "checked";' . "\r\n";
$module['callback'] .= "\t\t" . '}else{' . "\r\n";
$module['callback'] .= "\t\t\t" . '$checked = "";' . "\r\n";
$module['callback'] .= "\t\t" . '}' . "\r\n";
$module['callback'] .= "\t\t" . '?>' . "\r\n";
$module['callback'] .= "\t\t" . '<p><input id="{{ID}}" <?php echo $checked ?> type="checkbox" name="{{SETTING}}[{{VAR}}]" /> <?php _e("{{PLACEHOLDER}}","{{TEXT-DOMAIN}}") ?></p>' . "\r\n";
$module['callback'] .= "\t\t" . '<?php' . "\r\n";


$module['rest_api_callback'] = null;
$module['rest_api_callback'] .= "" . '' . "\r\n";
$module['rest_api_callback'] .= "\t\t" . 'if(isset($options["{{VAR}}"])){' . "\r\n";
$module['rest_api_callback'] .= "\t\t\t" . '$data["{{VAR}}"] = true;' . "\r\n";
$module['rest_api_callback'] .= "\t\t" . '}else{' . "\r\n";
$module['rest_api_callback'] .= "\t\t\t" . '$data["{{VAR}}"] = false;' . "\r\n";
$module['rest_api_callback'] .= "\t\t" . '}' . "\r\n";


?>