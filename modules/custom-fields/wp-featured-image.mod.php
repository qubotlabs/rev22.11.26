<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$string = new StringConvert();

$module['name'] = 'wp-featured-image';
$module['label'] = 'WordPress ~ Featured image';

$module['options']['value'] = 'Set Featured Image';
$module['options']['placeholder'] = 'Set Featured Image';

$module['default']['value'] = '';
$module['default']['placeholder'] = '';

$module['info']['value'] = '';
$module['info']['placeholder'] = '';

if (!isset($__field['name']))
{
    $__field['name'] = '';
}

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
$module['render_content'] .= "\t\t\t" . '<input type="hidden" id="{{ID}}" name="{{NAME}}" value="<?php echo esc_attr($current_data); ?>" />' . "\r\n";
$module['render_content'] .= "\t\t\t\t" . '<div>' . "\r\n";
$module['render_content'] .= "\t\t\t\t\t" . '<div id="{{ID}}-container">' . "\r\n";
$module['render_content'] .= "\t\t\t\t\t\t" . '<button type="button" class="" id="{{ID}}-toggle">' . "\r\n";
$module['render_content'] .= "\t\t\t\t\t\t" . '<?php if($current_data == ""){ ?>' . "\r\n";
$module['render_content'] .= "\t\t\t\t\t\t\t" . '<span id="{{ID}}-label" style="display:block"><?php _e("{{OPTIONS}}", "{{TEXT-DOMAIN}}"); ?></span>' . "\r\n";
$module['render_content'] .= "\t\t\t\t\t\t\t" . '<img id="{{ID}}-image" style="display:none" src="<?php echo $current_data; ?>" />' . "\r\n";
$module['render_content'] .= "\t\t\t\t\t\t" . '<?php }else{ ?>' . "\r\n";
$module['render_content'] .= "\t\t\t\t\t\t\t" . '<span id="{{ID}}-label" style="display:none"><?php _e("{{OPTIONS}}", "{{TEXT-DOMAIN}}"); ?></span>' . "\r\n";
$module['render_content'] .= "\t\t\t\t\t\t\t" . '<img id="{{ID}}-image" style="display:block" src="<?php echo $current_data; ?>" />' . "\r\n";
$module['render_content'] .= "\t\t\t\t\t\t" . '<?php } ?>' . "\r\n";
$module['render_content'] .= "\t\t\t\t\t\t" . '</button>' . "\r\n";
$module['render_content'] .= "\t\t\t\t\t\t" . '<?php if($current_data == ""){ ?>' . "\r\n";
$module['render_content'] .= "\t\t\t\t\t\t\t" . '<a href="#!_" id="{{ID}}-reset" style="display:none"><?php _e("Remove this image", "{{TEXT-DOMAIN}}"); ?></a>' . "\r\n";
$module['render_content'] .= "\t\t\t\t\t\t" . '<?php }else{ ?>' . "\r\n";
$module['render_content'] .= "\t\t\t\t\t\t\t" . '<a href="#!_" id="{{ID}}-reset" style="display:block"><?php _e("Remove this image", "{{TEXT-DOMAIN}}"); ?></a>' . "\r\n";
$module['render_content'] .= "\t\t\t\t\t\t" . '<?php } ?>' . "\r\n";
$module['render_content'] .= "\t\t\t\t\t" . '</div>' . "\r\n";
$module['render_content'] .= "\t\t\t\t" . '</div>' . "\r\n";
$module['render_content'] .= "\t\t\t" . '</td>' . "\r\n";
$module['render_content'] .= "\t\t" . '</tr>' . "\r\n";
$module['render_content'] .= "\t\t" . '<?php' . "\r\n";


$module['save_post'] = null;
$module['save_post'] .= "\t\t" . '$data = sanitize_text_field($_POST["{{NAME}}"]);' . "\r\n";
$module['save_post'] .= "\t\t" . 'update_post_meta($post_id, "_{{VAR}}", $data);' . "\r\n";


$module['admin_footer'] = null;
$module['admin_footer'] .= "\t\t" . '?>' . "\r\n";
$module['admin_footer'] .= "\t\t" . '<script type="text/javascript">' . "\r\n";
$module['admin_footer'] .= "\t\t" . '// customfield {{NAME}}' . "\r\n";
$module['admin_footer'] .= "\t\t" . '(function($){' . "\r\n";
$module['admin_footer'] .= "\t\t\t" . '$(function(){' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t" . 'var ' . $string->toClassName($__field['name']) . 'Upload;' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t" . '$("body").find("#{{ID}}-reset").on("click", function(e){' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '$("#{{ID}}").val("");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '$("#{{ID}}-image").attr("src","");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '$("#{{ID}}-label").css("display","block");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '$("#{{ID}}-image").css("display","none");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '$("#{{ID}}-reset").css("display","none");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t" . '});' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t" . '$("body").find("#{{ID}}-toggle").on("click", function(e){' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t" . 'e.preventDefault();' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t" . 'if (' . $string->toClassName($__field['name']) . 'Upload){' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '' . $string->toClassName($__field['name']) . 'Upload.open();' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'return;' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t" . '}' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t" . '' . $string->toClassName($__field['name']) . 'Upload = wp.media({' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'title' . "\t" . ': "<?php _e("Select or Upload Image", "{{TEXT-DOMAIN}}"); ?>",' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'button' . "\t" . ': {' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t\t" . 'text' . "\t" . ': "<?php _e("Use this image", "{{TEXT-DOMAIN}}"); ?>" ' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '},' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'multiple' . "\t" . ': false,' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'library' . "\t" . ': {' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t\t" . 'type' . "\t" . ': ["image"]' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '}' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t" . '});' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t" . '' . $string->toClassName($__field['name']) . 'Upload.on("select",function(){' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'var attachment = ' . $string->toClassName($__field['name']) . 'Upload.state().get("selection").first().toJSON();' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '$("#{{ID}}").val(attachment.url);' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '$("#{{ID}}").trigger("change");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '$("#{{ID}}-image").attr("src",attachment.url);' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '$("#{{ID}}-label").css("display","none");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '$("#{{ID}}-image").css("display","block");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '$("#{{ID}}-reset").css("display","block");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t" . '});' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t" . '' . $string->toClassName($__field['name']) . 'Upload.open();' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t" . '});' . "\r\n";
$module['admin_footer'] .= "\t\t\t" . '});' . "\r\n";
$module['admin_footer'] .= "\t\t" . '})(jQuery);' . "\r\n";
$module['admin_footer'] .= "\t\t" . '</script>' . "\r\n";
$module['admin_footer'] .= "\t\t" . '<?php' . "\r\n";
$module['admin_footer'] .= "\t\t" . '' . "\r\n";


$module['admin_enqueue_scripts'] = null;
$module['admin_enqueue_scripts'] .= "\t\t" . 'wp_enqueue_media();' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t" . '?>' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t" . '<style type="text/css">' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t" . '#{{ID}}-container{' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t" . '}' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t" . '#{{ID}}-toggle{' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'width: 50%;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'max-width: 50%;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'border-radius: 2px;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'min-height: 90px;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'line-height: 20px;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'padding: 8px !important;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'text-align: center;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'background: #f0f0f0;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'color: #1e1e1e;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'text-decoration: none;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'font-size: 13px;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'margin: 0;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'border: 0;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'cursor: pointer;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . '-webkit-appearance: none;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t" . '}' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t" . '#{{ID}}-toggle:hover{' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'background: #ddd;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'color: #1e1e1e;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t" . '}' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t" . '#{{ID}}-image{' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'max-width: 100%;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'width: 100%;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t" . '}' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t" . '#postbox-container-1 #{{ID}}-toggle{' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'width: 100%;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'max-width: 100%;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t" . '}' . "\r\n";

$module['admin_enqueue_scripts'] .= "\t\t" . '</style>' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t" . '<?php' . "\r\n";

?>