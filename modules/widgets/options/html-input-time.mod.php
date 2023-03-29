<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$module['name'] = 'html-input-time';
$module['label'] = 'HTML ~ Input: Time';

$module['options']['type'] = 'time';
$module['options']['value'] = '23:30';
$module['options']['placeholder'] = '23:30';
$module['options']['help'] = '<strong>format</strong>: hh:ii, eg: 23:30';

$module['default']['type'] = 'time';
$module['default']['value'] = '23:30';
$module['default']['placeholder'] = '23:30';
$module['default']['help'] = '<strong>format</strong>: hh:ii, eg: 23:30';

$module['info']['value'] = '';
$module['info']['placeholder'] = '';


// TODO: UPDATE
$module['update'] = null;
$module['update'] .= "\t\t" . '$instance["{{NAME}}"] = (!empty($new_instance["{{NAME}}"])) ? strip_tags($new_instance["{{NAME}}"]) : "{{DEFAULT}}";' . "\r\n";

// TODO: FORM
$module['form'] = null;
$module['form'] .= "\t\t" . '$current_data = !empty($instance["{{NAME}}"]) ? $instance["{{NAME}}"] : "{{DEFAULT}}";' . "\r\n";
$module['form'] .= "\t\t" . '?>' . "\r\n";
$module['form'] .= "\t\t" . '<div class="">' . "\r\n";
$module['form'] .= "\t\t\t" . '<label for="<?php echo $this->get_field_id("{{ID}}"); ?>"><?php _e("{{LABEL}}:"); ?></label>' . "\r\n";
$module['form'] .= "\t\t\t" . '<input type="time" class="widefat" id="<?php _e($this->get_field_id("{{ID}}")); ?>" placeholder="{{OPTIONS}}" name="<?php _e($this->get_field_name("{{NAME}}")); ?>" value="<?php _e(esc_attr($current_data)); ?>">' . "\r\n";
$module['form'] .= "\t\t\t" . '<p class="description"><?php _e("{{INFO}}", "{{TEXT-DOMAIN}}"); ?></p>' . "\r\n";
$module['form'] .= "\t\t" . '</div>' . "\r\n";
$module['form'] .= "\t\t" . '<?php' . "\r\n";


$module['admin_footer'] = null;
$module['admin_enqueue_scripts'] = null;

?>