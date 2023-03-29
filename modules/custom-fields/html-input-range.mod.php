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

$module['info']['value'] = '';
$module['info']['placeholder'] = '';

// TODO: EDIT FIELDS
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

$module['render_content'] = null;
$module['render_content'] .= "\t\t" . '$min = '.(int)$range[0].';' . "\r\n";
$module['render_content'] .= "\t\t" . '$max = '.(int)$range[1].';' . "\r\n";
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
$module['render_content'] .= "\t\t\t" . '<input max="<?php _e($max); ?>" min="<?php _e($min); ?>" class="regular-text {{SHORTNAME}}-form-control" type="range" id="{{ID}}" name="{{NAME}}" value="<?php echo esc_attr($current_data); ?>" placeholder="{{OPTIONS}}" />' . "\r\n";
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
$module['wp_ajax'] .= "\t\t" . '// save range number' . "\r\n";
$module['wp_ajax'] .= "\t\t" . '${{VAR}} = "";' . "\r\n";
$module['wp_ajax'] .= "\t\t" . 'if(isset($_POST["{{VAR}}"])){' . "\r\n";
$module['wp_ajax'] .= "\t\t\t" . '${{VAR}} = (int)($_POST["{{VAR}}"]) ;' . "\r\n";
$module['wp_ajax'] .= "\t\t" . '}' . "\r\n";
$module['wp_ajax'] .= "\t\t" . 'if (!add_post_meta($post_id ,"_{{VAR}}", ${{VAR}}, true))' . "\r\n";
$module['wp_ajax'] .= "\t\t" . '{' . "\r\n";
$module['wp_ajax'] .= "\t\t\t" . 'update_post_meta($post_id, "_{{VAR}}", ${{VAR}});' . "\r\n";
$module['wp_ajax'] .= "\t\t" . '}' . "\r\n";


$module['fontend_content'] = null;
$module['fontend_content'] .= "\t\t" . '' . "\r\n";
$module['fontend_content'] .= "\t\t" . '$min = '.(int)$range[0].';' . "\r\n";
$module['fontend_content'] .= "\t\t" . '$max = '.(int)$range[1].';' . "\r\n";
$module['fontend_content'] .= "\t\t" . '$content .= \'<div class="{{SHORTNAME}}-form-group">\';' . "\r\n";
$module['fontend_content'] .= "\t\t" . '$content .= \'<label for="{{ID}}">\'. __("{{LABEL}}", "{{TEXT-DOMAIN}}"). \'</label>\';' . "\r\n";
$module['fontend_content'] .= "\t\t" . '$content .= \'<input max="\' . $max . \'" min="\'. $min .\'" class="{{SHORTNAME}}-form-control" type="range" id="{{ID}}" name="{{NAME}}" />\';' . "\r\n";
$module['fontend_content'] .= "\t\t" . '$content .= \'<p class="{{SHORTNAME}}-help-block">\'. __("{{INFO}}", "{{TEXT-DOMAIN}}"). \'</p>\';' . "\r\n";
$module['fontend_content'] .= "\t\t" . '$content .= \'</div>\';' . "\r\n";

$module['fontend_js'] = null;
$module['fontend_js'] .= "\t\t\t\t" . '"{{VAR}}": $("#{{NAME}}").val(),' . "\r\n";

$module['field_reset'] = null;
$module['field_reset'] .= "\t\t\t\t\t" . '$("#{{NAME}}").val("{{DEFAULT}}");' . "\r\n";

?>