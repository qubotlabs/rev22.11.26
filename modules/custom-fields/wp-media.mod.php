<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$string = new StringConvert();

$module['name'] = 'wp-media-upload';
$module['label'] = 'WordPress ~ Media Upload';

$module['options']['value'] = 'Browse...';
$module['options']['placeholder'] = 'Browse...';

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
$module['render_content'] .= "\t\t\t\t" . '<input class="regular-text {{SHORTNAME}}-form-control" type="text" id="{{ID}}" name="{{NAME}}" value="<?php echo esc_attr($current_data); ?>" />' . "\r\n";
$module['render_content'] .= "\t\t\t\t" . '<button type="button" class="button button-primary button-large" id="{{ID}}-toggle"><?php _e("{{OPTIONS}}", "{{TEXT-DOMAIN}}"); ?></button>' . "\r\n";
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
$module['admin_footer'] .= "\t\t\t\t" . '$("body").find("#{{ID}}-toggle").on("click", function(e){' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t" . 'e.preventDefault();' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t" . 'if (' . $string->toClassName($__field['name']) . 'Upload){' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '' . $string->toClassName($__field['name']) . 'Upload.open();' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'return;' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t" . '}' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t" . '' . $string->toClassName($__field['name']) . 'Upload = wp.media({' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'title' . "\t" . ': "<?php _e("Select or Upload File", "{{TEXT-DOMAIN}}"); ?>",' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'button' . "\t" . ': {' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t\t" . 'text' . "\t" . ': "<?php _e("Use this file", "{{TEXT-DOMAIN}}"); ?>" ' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '},' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'multiple' . "\t" . ': false,' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t" . '});' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t" . '' . $string->toClassName($__field['name']) . 'Upload.on("select",function(){' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'var attachment = ' . $string->toClassName($__field['name']) . 'Upload.state().get("selection").first().toJSON();' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '$("#{{ID}}").val(attachment.url);' . "\r\n";
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

$module['admin_enqueue_scripts'] .= "\t\t\t" . '}' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t" . '#{{ID}}-toggle:hover{' . "\r\n";

$module['admin_enqueue_scripts'] .= "\t\t\t" . '}' . "\r\n";

$module['admin_enqueue_scripts'] .= "\t\t\t" . '#postbox-container-1 #{{ID}}-toggle{' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'width: 100%;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'max-width: 100%;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t" . '}' . "\r\n";

$module['admin_enqueue_scripts'] .= "\t\t" . '</style>' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t" . '<?php' . "\r\n";

?>