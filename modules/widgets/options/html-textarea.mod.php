<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$module['name'] = 'html-textarea';
$module['label'] = 'HTML ~ Textarea';

// TODO: UPDATE
$module['update'] = null;
$module['update'] .= "\t\t" . '$instance["{{NAME}}"] = (!empty($new_instance["{{NAME}}"])) ? strip_tags($new_instance["{{NAME}}"]) : "{{DEFAULT}}";' . "\r\n";

$module['form'] = null;
$module['form'] .= "\t\t" . '$current_data = !empty($instance["{{NAME}}"]) ? $instance["{{NAME}}"] : "{{DEFAULT}}";' . "\r\n";
$module['form'] .= "\t\t" . '?>' . "\r\n";
$module['form'] .= "\t\t" . '<div>' . "\r\n";
$module['form'] .= "\t\t\t" . '<label for="<?php echo $this->get_field_id("{{NAME}}"); ?>"><?php _e("{{LABEL}}:"); ?></label>' . "\r\n";
$module['form'] .= "\t\t\t" . '<textarea class="widefat" id="<?php _e($this->get_field_id("{{NAME}}")); ?>" name="<?php _e($this->get_field_name("{{NAME}}")); ?>"><?php _e(esc_attr($current_data)); ?></textarea>' . "\r\n";
$module['form'] .= "\t\t\t" . '<p class="description"><?php _e("{{INFO}}", "{{TEXT-DOMAIN}}"); ?></p>' . "\r\n";
$module['form'] .= "\t\t" . '</div>' . "\r\n";
$module['form'] .= "\t\t" . '<?php' . "\r\n";

?>