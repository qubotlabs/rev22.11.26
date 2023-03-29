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


// TODO: EDIT FIELDS
$module['edit_form_fields'] = null;
$module['edit_form_fields'] .= "\t\t" . '' . "\r\n";
$module['edit_form_fields'] .= "\t\t" . '$current_data = get_term_meta($term->term_id, "{{NAME}}", true );' . "\r\n";
$module['edit_form_fields'] .= "\t\t" . '' . "\r\n";
$module['edit_form_fields'] .= "\t\t" . '?>' . "\r\n";
$module['edit_form_fields'] .= "\t\t" . '<tr class="form-field">' . "\r\n";
$module['edit_form_fields'] .= "\t\t\t" . '<th valign="top" scope="row">' . "\r\n";
$module['edit_form_fields'] .= "\t\t\t\t" . '<label for="{{ID}}"><?php _e("{{LABEL}}", "{{TEXT-DOMAIN}}"); ?></label>' . "\r\n";
$module['edit_form_fields'] .= "\t\t\t" . '</th>' . "\r\n";
$module['edit_form_fields'] .= "\t\t\t" . '<td>' . "\r\n";
$module['edit_form_fields'] .= "\t\t\t\t" . '<input type="color" id="{{ID}}" name="{{NAME}}" placeholder="{{PLACEHOLDER}}" value="<?php echo esc_attr($current_data); ?>"/>' . "\r\n";
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
$module['add_form_fields'] .= "\t\t" . '?>' . "\r\n";
$module['add_form_fields'] .= "\t\t" . '<div class="form-field">' . "\r\n";
$module['add_form_fields'] .= "\t\t\t" . '<label for="{{ID}}"><?php _e("{{LABEL}}", "{{TEXT-DOMAIN}}"); ?></label>' . "\r\n";
$module['add_form_fields'] .= "\t\t\t" . '<input type="color" value="{{DEFAULT}}" size="40" id="{{ID}}" name="{{NAME}}" placeholder="{{PLACEHOLDER}}"/>' . "\r\n";
$module['add_form_fields'] .= "\t\t\t" . '<p class="description"><?php _e("{{INFO}}", "{{TEXT-DOMAIN}}"); ?></p>' . "\r\n";
$module['add_form_fields'] .= "\t\t" . '</div>' . "\r\n";
$module['add_form_fields'] .= "\t\t" . '<?php' . "\r\n";
$module['add_form_fields'] .= "\t\t" . '' . "\r\n";


// TODO: ADD 
$module['add_form'] = null;
$module['add_form'] .= "\t\t" . '' . "\r\n";
$module['add_form'] .= "\t\t" . 'if( isset( $_POST["{{NAME}}"]) && "" !== $_POST["{{NAME}}"] ){' . "\r\n";
$module['add_form'] .= "\t\t\t" . '$data = sanitize_text_field($_POST["{{NAME}}"]);' . "\r\n";
$module['add_form'] .= "\t\t\t" . 'add_term_meta( $term_id, "{{NAME}}", $data, true );' . "\r\n";
$module['add_form'] .= "\t\t" . '}' . "\r\n";



?>