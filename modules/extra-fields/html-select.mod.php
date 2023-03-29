<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$module = null;
$module['name'] = 'html-select';
$module['label'] = 'HTML ~ Select';

$module['options']['value'] = 'option 1|option 2|option 3';
$module['options']['placeholder'] = 'option 1|option 2|option 3';
$module['options']['help'] = '<strong>format</strong>: separator with: <code>|</code>, eg: opt1|opt2|opt3';

$module['default']['value'] = 'option 1';
$module['default']['placeholder'] = 'option 1';
$module['info']['value'] = '';
$module['info']['placeholder'] = '';


// TODO: EDIT FIELDS
$module['edit_form_fields'] = null;
$module['edit_form_fields'] .= "\t\t" . '' . "\r\n";
$module['edit_form_fields'] .= "\t\t" . '$options = array();' . "\r\n";
if (isset($__field['options']))
{
    if ($__field['options'] != '')
    {
        $options = explode("|", $__field['options']);
        foreach ($options as $opt)
        {
            $module['edit_form_fields'] .= "\t\t" . '$options[] = array( "value"=>"' . strtolower($opt) . '", "label" => __("' . ucwords($opt) . '","{{TEXT-DOMAIN}}") );' . "\r\n";
        }
    }
}
$module['edit_form_fields'] .= "\t\t" . '' . "\r\n";
$module['edit_form_fields'] .= "\t\t" . '$current_data = get_term_meta($term->term_id, "{{NAME}}", true );' . "\r\n";
$module['edit_form_fields'] .= "\t\t" . '' . "\r\n";
$module['edit_form_fields'] .= "\t\t" . '?>' . "\r\n";
$module['edit_form_fields'] .= "\t\t" . '<tr class="form-field">' . "\r\n";
$module['edit_form_fields'] .= "\t\t\t" . '<th valign="top" scope="row">' . "\r\n";
$module['edit_form_fields'] .= "\t\t\t\t" . '<label for="{{ID}}"><?php _e("{{LABEL}}", "{{TEXT-DOMAIN}}"); ?></label>' . "\r\n";
$module['edit_form_fields'] .= "\t\t\t" . '</th>' . "\r\n";
$module['edit_form_fields'] .= "\t\t\t" . '<td>' . "\r\n";
$module['edit_form_fields'] .= "\t\t\t" . '<select id="{{ID}}" name="{{NAME}}">' . "\r\n";
$module['edit_form_fields'] .= "\t\t\t" . '<?php' . "\r\n";
$module['edit_form_fields'] .= "\t\t\t" . 'foreach($options as $option){' . "\r\n";
$module['edit_form_fields'] .= "\t\t\t\t" . 'if($current_data == $option["value"]){' . "\r\n";
$module['edit_form_fields'] .= "\t\t\t\t\t" . 'echo "<option selected value=\"" . $option["value"] . "\">" . $option["label"] . "</option>";' . "\r\n";
$module['edit_form_fields'] .= "\t\t\t\t" . '}else{' . "\r\n";
$module['edit_form_fields'] .= "\t\t\t\t\t" . 'echo "<option value=\"" . $option["value"] . "\">" . $option["label"] . "</option>";' . "\r\n";
$module['edit_form_fields'] .= "\t\t\t\t" . '}' . "\r\n";
$module['edit_form_fields'] .= "\t\t\t" . '}' . "\r\n";
$module['edit_form_fields'] .= "\t\t\t" . '?>' . "\r\n";
$module['edit_form_fields'] .= "\t\t\t" . '</select>' . "\r\n";
$module['edit_form_fields'] .= "\t\t\t\t" . '<p class="description"><?php _e("{{INFO}}", "{{TEXT-DOMAIN}}"); ?></p>' . "\r\n";
$module['edit_form_fields'] .= "\t\t\t" . '</td>' . "\r\n";
$module['edit_form_fields'] .= "\t\t" . '</tr>' . "\r\n";
$module['edit_form_fields'] .= "\t\t" . '<?php' . "\r\n";
$module['edit_form_fields'] .= "\t\t" . '' . "\r\n";

// TODO: EDIT
$module['edit_form'] = null;
$module['edit_form'] .= "\t\t" . '' . "\r\n";
$module['edit_form'] .= "\t\t" . 'if( isset( $_POST["{{NAME}}"]) && "" !== $_POST["{{NAME}}"] ){' . "\r\n";
$module['edit_form'] .= "\t\t\t" . '$data = sanitize_text_field($_POST["{{NAME}}"]);' . "\r\n";
$module['edit_form'] .= "\t\t\t" . 'update_term_meta ( $term_id, "{{NAME}}", $data, "");' . "\r\n";
$module['edit_form'] .= "\t\t" . '}' . "\r\n";


// TODO: ADD FIELDS


$module['add_form_fields'] = null;
$module['add_form_fields'] .= "\t" . '' . "\r\n";
$module['add_form_fields'] .= "\t\t" . '$options = array();' . "\r\n";
if (isset($__field['options']))
{
    if ($__field['options'] != '')
    {
        $options = explode("|", $__field['options']);
        foreach ($options as $opt)
        {
            $module['add_form_fields'] .= "\t\t" . '$options[] = array( "value"=>"' . strtolower($opt) . '", "label" => __("' . ucwords($opt) . '","{{TEXT-DOMAIN}}") );' . "\r\n";
        }
    }
}
$module['add_form_fields'] .= "\t\t" . '' . "\r\n";
$module['add_form_fields'] .= "\t\t" . '$current_data = "{{DEFAULT}}";' . "\r\n";
$module['add_form_fields'] .= "\t\t" . '' . "\r\n";
$module['add_form_fields'] .= "\t\t" . '?>' . "\r\n";
$module['add_form_fields'] .= "\t\t" . '<div class="form-field">' . "\r\n";
$module['add_form_fields'] .= "\t\t\t" . '<label for="{{ID}}"><?php _e("{{LABEL}}", "{{TEXT-DOMAIN}}"); ?></label>' . "\r\n";
$module['add_form_fields'] .= "\t\t\t" . '<select id="{{ID}}" name="{{NAME}}">' . "\r\n";
$module['add_form_fields'] .= "\t\t\t" . '<?php' . "\r\n";
$module['add_form_fields'] .= "\t\t\t" . 'foreach($options as $option){' . "\r\n";
$module['add_form_fields'] .= "\t\t\t\t" . 'if($current_data == $option["value"]){' . "\r\n";
$module['add_form_fields'] .= "\t\t\t\t\t" . 'echo "<option selected value=\"" . $option["value"] . "\">" . $option["label"] . "</option>";' . "\r\n";
$module['add_form_fields'] .= "\t\t\t\t" . '}else{' . "\r\n";
$module['add_form_fields'] .= "\t\t\t\t\t" . 'echo "<option value=\"" . $option["value"] . "\">" . $option["label"] . "</option>";' . "\r\n";
$module['add_form_fields'] .= "\t\t\t\t" . '}' . "\r\n";
$module['add_form_fields'] .= "\t\t\t" . '}' . "\r\n";
$module['add_form_fields'] .= "\t\t\t" . '?>' . "\r\n";
$module['add_form_fields'] .= "\t\t\t" . '</select>' . "\r\n";
$module['add_form_fields'] .= "\t\t\t" . '<p class="description"><?php _e("{{INFO}}", "{{TEXT-DOMAIN}}"); ?></p>' . "\r\n";
$module['add_form_fields'] .= "\t\t" . '</div>' . "\r\n";
$module['add_form_fields'] .= "\t\t" . '<?php' . "\r\n";
$module['add_form_fields'] .= "\t\t" . '' . "\r\n";


$module['add_form'] = null;
$module['add_form'] .= "\t\t" . '' . "\r\n";
$module['add_form'] .= "\t\t" . 'if( isset( $_POST["{{NAME}}"]) && "" !== $_POST["{{NAME}}"] ){' . "\r\n";
$module['add_form'] .= "\t\t\t" . '$data = sanitize_text_field($_POST["{{NAME}}"]);' . "\r\n";
$module['add_form'] .= "\t\t\t" . 'add_term_meta( $term_id, "{{NAME}}", $data, true );' . "\r\n";
$module['add_form'] .= "\t\t" . '}' . "\r\n";

?>