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

$module['render_content'] = null;
$module['render_content'] .= "\t\t" . '' . "\r\n";
$module['render_content'] .= "\t\t" . '$options = array();' . "\r\n";
if (isset($__field['options']))
{
    if ($__field['options'] != '')
    {
        $options = explode("|", $__field['options']);
        foreach ($options as $opt)
        {
            $module['render_content'] .= "\t\t" . '$options[] = array( "value"=>"' . strtolower($opt) . '", "label" => __("' . ucwords($opt) . '","{{TEXT-DOMAIN}}") );' . "\r\n";
        }
    }
}
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
$module['render_content'] .= "\t\t\t" . '<select id="{{ID}}" name="{{NAME}}">' . "\r\n";
$module['render_content'] .= "\t\t\t" . '<?php' . "\r\n";
$module['render_content'] .= "\t\t\t" . 'foreach($options as $option){' . "\r\n";
$module['render_content'] .= "\t\t\t\t" . 'if($current_data == $option["value"]){' . "\r\n";
$module['render_content'] .= "\t\t\t\t\t" . 'echo "<option selected value=\"" . $option["value"] . "\">" . $option["label"] . "</option>";' . "\r\n";
$module['render_content'] .= "\t\t\t\t" . '}else{' . "\r\n";
$module['render_content'] .= "\t\t\t\t\t" . 'echo "<option value=\"" . $option["value"] . "\">" . $option["label"] . "</option>";' . "\r\n";
$module['render_content'] .= "\t\t\t\t" . '}' . "\r\n";
$module['render_content'] .= "\t\t\t" . '}' . "\r\n";
$module['render_content'] .= "\t\t\t" . '?>' . "\r\n";
$module['render_content'] .= "\t\t\t" . '</select>' . "\r\n";
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
$module['wp_ajax'] .= "\t\t" . '// save option select' . "\r\n";
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
$module['fontend_content'] = null;
$module['fontend_content'] .= "\t\t" . '' . "\r\n";
$module['fontend_content'] .= "\t\t" . '$options = array();' . "\r\n";
if (isset($__field['options']))
{
    if ($__field['options'] != '')
    {
        $options = explode("|", $__field['options']);
        foreach ($options as $opt)
        {
            $module['fontend_content'] .= "\t\t" . '$options[] = array( "value"=>"' . strtolower($opt) . '", "label" => __("' . ucwords($opt) . '","{{TEXT-DOMAIN}}") );' . "\r\n";
        }
    }
}

$module['fontend_content'] .= "\t\t" . '$content .= \'<div class="{{SHORTNAME}}-form-group">\';' . "\r\n";
$module['fontend_content'] .= "\t\t" . '$content .= \'<label for="{{ID}}">\'. __("{{LABEL}}", "{{TEXT-DOMAIN}}"). \'</label>\';' . "\r\n";
$module['fontend_content'] .= "\t\t" . '$content .= \'<select id="{{ID}}" name="{{NAME}}" class="{{SHORTNAME}}-form-control">\';' . "\r\n";
$module['fontend_content'] .= "\t\t" . 'foreach($options as $option){' . "\r\n";
$module['fontend_content'] .= "\t\t\t" . '$content .= "<option value=\"" . $option["value"] . "\">" . $option["label"] . "</option>";' . "\r\n";
$module['fontend_content'] .= "\t\t" . '}' . "\r\n";
$module['fontend_content'] .= "\t\t" . '$content .= \'</select>\';' . "\r\n";

$module['fontend_content'] .= "\t\t" . '$content .= \'<p class="{{SHORTNAME}}-help-block">\'. __("{{INFO}}", "{{TEXT-DOMAIN}}"). \'</p>\';' . "\r\n";
$module['fontend_content'] .= "\t\t" . '$content .= \'</div>\';' . "\r\n";

$module['fontend_js'] = null;
$module['fontend_js'] .= "\t\t\t\t" . '"{{VAR}}": $("#{{NAME}}").val(),' . "\r\n";

$module['field_reset'] = null;
$module['field_reset'] .= "\t\t\t\t\t" . '$("#{{NAME}}").val("{{DEFAULT}}");' . "\r\n";

?>