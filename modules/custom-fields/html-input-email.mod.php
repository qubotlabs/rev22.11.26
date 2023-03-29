<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$module['name'] = 'html-input-email';
$module['label'] = 'HTML ~ Input: Email';

$module['options']['value'] = 'info@ihsana.com';
$module['options']['placeholder'] = 'info@ihsana.com';
$module['options']['type'] = 'email';
$module['options']['help'] = '<strong>format</strong>: email, eg: <code>info@ihsana.com</code>';

$module['default']['value'] = 'info@ihsana.com';
$module['default']['placeholder'] = 'info@ihsana.com';
$module['default']['type'] = 'email';
$module['default']['help'] = '<strong>format</strong>: email, eg: <code>info@ihsana.com</code>';

$module['info']['value'] = 'Please enter the valid email';
$module['info']['placeholder'] = 'Please enter the valid email';

$module['render_content'] = null;
$module['render_content'] .= "\t\t" . '$current_data = get_post_meta($post->ID, "_{{VAR}}", true);' . "\r\n";
$module['render_content'] .= "\t\t" . 'if($current_data == ""){' . "\r\n";
$module['render_content'] .= "\t\t\t" . '$current_data = "{{DEFAULT}}";' . "\r\n";
$module['render_content'] .= "\t\t" . '}' . "\r\n";
$module['render_content'] .= "\t\t" . '?>' . "\r\n";
$module['render_content'] .= "\t\t" . '<tr>' . "\r\n";
$module['render_content'] .= "\t\t\t" . '<th scope="row">' . "\r\n";
$module['render_content'] .= "\t\t\t\t" . '<label for="{{ID}}"><?php _e("{{LABEL}}", "{{TEXT-DOMAIN}}"); ?></label>' . "\r\n";
$module['render_content'] .= "\t\t\t" . '</th>' . "\r\n";
$module['render_content'] .= "\t\t\t" . '<td>' . "\r\n";
$module['render_content'] .= "\t\t\t" . '<input class="regular-text {{SHORTNAME}}-form-control" type="email" id="{{ID}}" name="{{NAME}}" value="<?php echo esc_attr($current_data); ?>" placeholder="{{OPTIONS}}" />' . "\r\n";
$module['render_content'] .= "\t\t\t" . '<p class="description"><?php _e("{{INFO}}", "{{TEXT-DOMAIN}}"); ?></p>' . "\r\n";
$module['render_content'] .= "\t\t\t" . '</td>' . "\r\n";
$module['render_content'] .= "\t\t" . '</tr>' . "\r\n";
$module['render_content'] .= "\t\t" . '<?php' . "\r\n";

$module['save_post'] = null;
$module['save_post'] .= "\t\t" . '$data = sanitize_text_field($_POST["{{NAME}}"]);' . "\r\n";
$module['save_post'] .= "\t\t" . 'update_post_meta($post_id, "_{{VAR}}", $data);' . "\r\n";


$module['admin_footer'] = null;
$module['admin_enqueue_scripts'] = null;

$module['wp_ajax'] = null;
$module['wp_ajax'] .= "\t\t" . '' . "\r\n";
$module['wp_ajax'] .= "\t\t" . '// save email address' . "\r\n";
$module['wp_ajax'] .= "\t\t" . '${{VAR}} = "";' . "\r\n";
$module['wp_ajax'] .= "\t\t" . 'if(isset($_POST["{{VAR}}"])){' . "\r\n";
$module['wp_ajax'] .= "\t\t\t" . '${{VAR}} = wp_strip_all_tags($_POST["{{VAR}}"]) ;' . "\r\n";
$module['wp_ajax'] .= "\t\t" . '}' . "\r\n";
$module['wp_ajax'] .= "\t\t" . 'if (!add_post_meta($post_id ,"_{{VAR}}", ${{VAR}}, true))' . "\r\n";
$module['wp_ajax'] .= "\t\t" . '{' . "\r\n";
$module['wp_ajax'] .= "\t\t\t" . 'update_post_meta($post_id, "_{{VAR}}", ${{VAR}});' . "\r\n";
$module['wp_ajax'] .= "\t\t" . '}' . "\r\n";

$module['fontend_content'] = null;
$module['fontend_content'] .= "\t\t" . '' . "\r\n";
$module['fontend_content'] .= "\t\t" . '$content .= \'<div class="{{SHORTNAME}}-form-group">\';' . "\r\n";
$module['fontend_content'] .= "\t\t" . '$content .= \'<label for="{{ID}}">\'. __("{{LABEL}}", "{{TEXT-DOMAIN}}"). \'</label>\';' . "\r\n";
$module['fontend_content'] .= "\t\t" . '$content .= \'<input class="{{SHORTNAME}}-form-control" type="email" id="{{ID}}" name="{{NAME}}" placeholder="{{OPTIONS}}" />\';' . "\r\n";
$module['fontend_content'] .= "\t\t" . '$content .= \'<p class="{{SHORTNAME}}-help-block">\'. __("{{INFO}}", "{{TEXT-DOMAIN}}"). \'</p>\';' . "\r\n";
$module['fontend_content'] .= "\t\t" . '$content .= \'</div>\';' . "\r\n";


$module['fontend_js'] = null;
$module['fontend_js'] .= "\t\t\t\t" . '"{{VAR}}": $("#{{NAME}}").val(),' . "\r\n";

$module['field_reset'] = null;
$module['field_reset'] .= "\t\t\t\t\t" . '$("#{{NAME}}").val("{{DEFAULT}}");' . "\r\n";

?>