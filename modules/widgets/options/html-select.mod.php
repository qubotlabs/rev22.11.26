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

// TODO: UPDATE
$module['update'] = null;
$module['update'] .= "\t\t" . '$instance["{{NAME}}"] = (!empty($new_instance["{{NAME}}"])) ? strip_tags($new_instance["{{NAME}}"]) : "{{DEFAULT}}";' . "\r\n";

// TODO: FORM
$module['form'] = null;
$module['form'] .= "\t\t" . '$options = array();' . "\r\n";
if (isset($__field['options']))
{
    if ($__field['options'] != '')
    {
        $options = explode("|", $__field['options']);
        foreach ($options as $opt)
        {
            $module['form'] .= "\t\t" . '$options[] = array( "value"=>"' . strtolower($opt) . '", "label" => __("' . ucwords($opt) . '","{{TEXT-DOMAIN}}") );' . "\r\n";
        }
    }
}
$module['form'] .= "\t\t" . '$current_data = !empty($instance["{{NAME}}"]) ? $instance["{{NAME}}"] : "{{DEFAULT}}";' . "\r\n";
$module['form'] .= "\t\t" . 'if($current_data == ""){' . "\r\n";
$module['form'] .= "\t\t\t" . '$current_data = "{{DEFAULT}}";' . "\r\n";
$module['form'] .= "\t\t" . '}' . "\r\n";
$module['form'] .= "\t\t" . '?>' . "\r\n";
$module['form'] .= "\t\t" . '<div class="">' . "\r\n";
$module['form'] .= "\t\t\t" . '<label for="<?php echo $this->get_field_id("{{ID}}"); ?>"><?php _e("{{LABEL}}:"); ?></label>' . "\r\n";
$module['form'] .= "\t\t\t" . '<select class="widefat" id="<?php _e($this->get_field_id("{{ID}}")); ?>" name="<?php _e($this->get_field_name("{{NAME}}")); ?>">' . "\r\n";
$module['form'] .= "\t\t\t" . '<?php' . "\r\n";
$module['form'] .= "\t\t\t" . 'foreach($options as $option){' . "\r\n";
$module['form'] .= "\t\t\t\t" . 'if($current_data == $option["value"]){' . "\r\n";
$module['form'] .= "\t\t\t\t\t" . 'echo "<option selected value=\"" . $option["value"] . "\">" . $option["label"] . "</option>";' . "\r\n";
$module['form'] .= "\t\t\t\t" . '}else{' . "\r\n";
$module['form'] .= "\t\t\t\t\t" . 'echo "<option value=\"" . $option["value"] . "\">" . $option["label"] . "</option>";' . "\r\n";
$module['form'] .= "\t\t\t\t" . '}' . "\r\n";
$module['form'] .= "\t\t\t" . '}' . "\r\n";
$module['form'] .= "\t\t\t" . '?>' . "\r\n";
$module['form'] .= "\t\t\t" . '</select>' . "\r\n";
$module['form'] .= "\t\t\t" . '<p class="description"><?php _e("{{INFO}}", "{{TEXT-DOMAIN}}"); ?></p>' . "\r\n";
$module['form'] .= "\t\t" . '</div>' . "\r\n";
$module['form'] .= "\t\t" . '<?php' . "\r\n";


$module['admin_footer'] = null;
$module['admin_enqueue_scripts'] = null;

?>