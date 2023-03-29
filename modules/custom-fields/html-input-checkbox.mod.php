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


$module['render_content'] = null;
$module['render_content'] .= "\t\t" . '$current_data = get_post_meta($post->ID, "_{{VAR}}", true);' . "\r\n";

$module['render_content'] .= "\t\t" . 'if($current_data == true){' . "\r\n";
$module['render_content'] .= "\t\t\t" . '$current_checked = "checked";' . "\r\n";
$module['render_content'] .= "\t\t" . '}else{' . "\r\n";
$module['render_content'] .= "\t\t\t" . '$current_checked = "";' . "\r\n";
$module['render_content'] .= "\t\t" . '}' . "\r\n";

$module['render_content'] .= "\t\t" . '?>' . "\r\n";
$module['render_content'] .= "\t\t" . '<tr>' . "\r\n";
$module['render_content'] .= "\t\t\t" . '<th scope="row">' . "\r\n";
$module['render_content'] .= "\t\t\t\t" . '<label for="{{ID}}"><?php _e("{{LABEL}}", "{{TEXT-DOMAIN}}"); ?></label>' . "\r\n";
$module['render_content'] .= "\t\t\t" . '</th>' . "\r\n";
$module['render_content'] .= "\t\t\t" . '<td>' . "\r\n";
$module['render_content'] .= "\t\t\t" . '<p><input <?php echo $current_checked ?> class="{{SHORTNAME}}-checkbox" type="checkbox" id="{{ID}}" name="{{NAME}}" /> <?php _e("{{PLACEHOLDER}}", "{{TEXT-DOMAIN}}"); ?></p>' . "\r\n";
$module['render_content'] .= "\t\t\t" . '</td>' . "\r\n";
$module['render_content'] .= "\t\t" . '</tr>' . "\r\n";
$module['render_content'] .= "\t\t" . '<?php' . "\r\n";

$module['save_post'] = null;

$module['save_post'] .= "\t\t" . 'if(isset($_POST["{{NAME}}"])){' . "\r\n";
$module['save_post'] .= "\t\t\t" . 'update_post_meta($post_id, "_{{VAR}}", true);' . "\r\n";
$module['save_post'] .= "\t\t" . '}else{' . "\r\n";
$module['save_post'] .= "\t\t\t" . 'update_post_meta($post_id, "_{{VAR}}", false);' . "\r\n";
$module['save_post'] .= "\t\t" . '}' . "\r\n";


$module['admin_footer'] = null;
$module['admin_enqueue_scripts'] = null;


$lorem = new LoremIpsum();
$text = $lorem->words(rand(1, 3));
$module['dummy'] = $text;

$module['wp_ajax'] = null;
$module['wp_ajax'] .= "\t\t" . '' . "\r\n";
$module['wp_ajax'] .= "\t\t" . '// save text' . "\r\n";
$module['wp_ajax'] .= "\t\t" . '${{VAR}} = "";' . "\r\n";

$module['wp_ajax'] .= "\t\t" . '${{VAR}} = false ;' . "\r\n";
$module['wp_ajax'] .= "\t\t" . 'if(isset($_POST["{{VAR}}"])){' . "\r\n";
$module['wp_ajax'] .= "\t\t\t" . 'if($_POST["{{VAR}}"] == "true"){' . "\r\n";
$module['wp_ajax'] .= "\t\t\t\t" . '${{VAR}} = true ;' . "\r\n";
$module['wp_ajax'] .= "\t\t\t" . '}' . "\r\n";
$module['wp_ajax'] .= "\t\t" . '}' . "\r\n";


$module['wp_ajax'] .= "\t\t" . 'if (!add_post_meta($post_id ,"_{{VAR}}", ${{VAR}}, true))' . "\r\n";
$module['wp_ajax'] .= "\t\t" . '{' . "\r\n";
$module['wp_ajax'] .= "\t\t\t" . 'update_post_meta($post_id, "_{{VAR}}", ${{VAR}});' . "\r\n";
$module['wp_ajax'] .= "\t\t" . '}' . "\r\n";

$module['fontend_content'] = null;
$module['fontend_content'] .= "\t\t" . '' . "\r\n";
$module['fontend_content'] .= "\t\t" . '$content .= \'<div class="{{SHORTNAME}}-form-group">\';' . "\r\n";
$module['fontend_content'] .= "\t\t" . '$content .= \'<label for="{{ID}}">\'. __("{{LABEL}}", "{{TEXT-DOMAIN}}"). \'</label>\';' . "\r\n";
$module['fontend_content'] .= "\t\t" . '$content .= \'<p><input class="{{SHORTNAME}}-checkbox" type="checkbox" id="{{ID}}" name="{{NAME}}" value="true" /> \'. __("{{PLACEHOLDER}}", "{{TEXT-DOMAIN}}"). \'</p>\';' . "\r\n";
$module['fontend_content'] .= "\t\t" . '$content .= \'</div>\';' . "\r\n";


$module['fontend_js'] = null;
$module['fontend_js'] .= "\t\t\t\t" . '"{{VAR}}": $("#{{NAME}}").is(":checked"),' . "\r\n";

$module['field_reset'] = null;
$module['field_reset'] .= "\t\t\t\t\t" . '$("#{{NAME}}").prop("checked", false);' . "\r\n";

?>