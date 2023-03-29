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
$module['default']['type'] = 'number';

$module['info']['value'] = '';
$module['info']['placeholder'] = '';

$range[0] = 0;
$range[1] = 100;
if (isset($__field['options']))
{
    if ($__field['options'] != '')
    {
        $range = explode("|", $__field['options']);
    }
}
if(!isset($range[0])){
    $range[0] = 0;
}
if(!isset($range[1])){
    $range[1] = 100;
}

// TODO: UPDATE
$module['update'] = null;
$module['update'] .= "\t\t" . '$instance["{{NAME}}"] = (!empty($new_instance["{{NAME}}"])) ? strip_tags($new_instance["{{NAME}}"]) : "{{DEFAULT}}";' . "\r\n";

// TODO: FORM
$module['form'] = null;
$module['form'] .= "\t\t" . '$current_data = !empty($instance["{{NAME}}"]) ? $instance["{{NAME}}"] : "{{DEFAULT}}";' . "\r\n";
$module['form'] .= "\t\t" . '$min = '.(int)$range[0].';' . "\r\n";
$module['form'] .= "\t\t" . '$max = '.(int)$range[1].';' . "\r\n";
$module['form'] .= "\t\t" . '?>' . "\r\n";
$module['form'] .= "\t\t" . '<div class="">' . "\r\n";
$module['form'] .= "\t\t\t" . '<label for="<?php echo $this->get_field_id("{{ID}}"); ?>"><?php _e("{{LABEL}}:"); ?></label>' . "\r\n";
$module['form'] .= "\t\t\t" . '<input type="range" max="<?php _e($max); ?>" min="<?php _e($min); ?>" class="widefat" id="<?php _e($this->get_field_id("{{ID}}")); ?>" placeholder="{{OPTIONS}}" name="<?php _e($this->get_field_name("{{NAME}}")); ?>" value="<?php _e(esc_attr($current_data)); ?>">' . "\r\n";
$module['form'] .= "\t\t\t" . '<p class="description"><?php _e("{{INFO}}", "{{TEXT-DOMAIN}}"); ?></p>' . "\r\n";
$module['form'] .= "\t\t" . '</div>' . "\r\n";
$module['form'] .= "\t\t" . '<?php' . "\r\n";


$module['admin_footer'] = null;
$module['admin_enqueue_scripts'] = null;

?>