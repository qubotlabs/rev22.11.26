<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$module['name'] = 'html-input-color';
$module['label'] = 'HTML ~ Input: Color';

$module['options']['type'] = 'color';
$module['options']['value'] = '#000000';
$module['options']['placeholder'] = '#eeeeee';
$module['options']['help'] = '<strong>format</strong>: hex color code, eg: <code>#000000</code>';

$module['default']['type'] = 'color';
$module['default']['value'] = '#000000';
$module['default']['placeholder'] = '#eeeeee';
$module['default']['help'] = '<strong>format</strong>: hex color code, eg: <code>#000000</code>';

$module['info']['value'] = 'Please enter the hex color code';
$module['info']['placeholder'] = 'Please enter the hex color code';


// TODO: UPDATE
$module['update'] = null;
$module['update'] .= "\t\t" . '$instance["{{NAME}}"] = (!empty($new_instance["{{NAME}}"])) ? strip_tags($new_instance["{{NAME}}"]) : "{{DEFAULT}}";' . "\r\n";

// TODO: FORM
$module['form'] = null;
$module['form'] .= "\t\t" . '$current_data = !empty($instance["{{NAME}}"]) ? $instance["{{NAME}}"] : "{{DEFAULT}}";' . "\r\n";
$module['form'] .= "\t\t" . '?>' . "\r\n";
$module['form'] .= "\t\t" . '<div class="">' . "\r\n";
$module['form'] .= "\t\t\t" . '<label for="<?php echo $this->get_field_id("{{ID}}"); ?>"><?php _e("{{LABEL}}:"); ?></label>' . "\r\n";
$module['form'] .= "\t\t\t" . '<input type="color" class="widefat" id="<?php _e($this->get_field_id("{{ID}}")); ?>" placeholder="{{OPTIONS}}" name="<?php _e($this->get_field_name("{{NAME}}")); ?>" value="<?php _e(esc_attr($current_data)); ?>">' . "\r\n";
$module['form'] .= "\t\t\t" . '<p class="description"><?php _e("{{INFO}}", "{{TEXT-DOMAIN}}"); ?></p>' . "\r\n";
$module['form'] .= "\t\t" . '</div>' . "\r\n";
$module['form'] .= "\t\t" . '<?php' . "\r\n";


$module['admin_footer'] = null;
$module['admin_enqueue_scripts'] = null;

?>