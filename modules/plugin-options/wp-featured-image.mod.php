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



$module['settings_field'] = null;
$module['settings_field'] .= "\t\t" . 'add_settings_field(' . "\r\n";
$module['settings_field'] .= "\t\t\t" . '"{{VAR}}", //id' . "\r\n";
$module['settings_field'] .= "\t\t\t" . '__("{{LABEL}}","{{TEXT-DOMAIN}}"), //title' . "\r\n";
$module['settings_field'] .= "\t\t\t" . 'array($this,"{{CALLBACK}}"), //callback' . "\r\n";
$module['settings_field'] .= "\t\t\t" . '"{{PAGE}}", //page' . "\r\n";
$module['settings_field'] .= "\t\t\t" . '"{{SECTION}}" //section' . "\r\n";
$module['settings_field'] .= "\t\t" . ');' . "\r\n";

$module['sanitize'] = null;
$module['sanitize'] .= "\t\t" . 'if(isset($input["{{VAR}}"]))' . "\r\n";
$module['sanitize'] .= "\t\t\t" . '$new_input["{{VAR}}"] = sanitize_text_field($input["{{VAR}}"]);' . "\r\n";
$module['sanitize'] .= "\t\t" . '' . "\r\n";


$module['callback'] = null;
$module['callback'] .= "\t\t" . 'if(isset($this->{{SETTING}}["{{VAR}}"])){' . "\r\n";
$module['callback'] .= "\t\t\t" . '$value = esc_attr($this->{{SETTING}}["{{VAR}}"]);' . "\r\n";
$module['callback'] .= "\t\t" . '}else{' . "\r\n";
$module['callback'] .= "\t\t\t" . '$value = "{{DEFAULT}}";' . "\r\n";
$module['callback'] .= "\t\t" . '}' . "\r\n";
$module['callback'] .= "\t\t" . '?>' . "\r\n";


 
$module['callback'] .= "\t\t" . '<input type="hidden" id="{{ID}}" name="{{SETTING}}[{{VAR}}]" value="<?php echo esc_attr($value); ?>" />' . "\r\n";
$module['callback'] .= "\t\t" . '<div>' . "\r\n";
$module['callback'] .= "\t\t\t" . '<div id="{{ID}}-container">' . "\r\n";
$module['callback'] .= "\t\t\t\t" . '<button type="button" class="" id="{{ID}}-toggle">' . "\r\n";
$module['callback'] .= "\t\t\t\t" . '<?php if($value == ""){ ?>' . "\r\n";
$module['callback'] .= "\t\t\t\t\t" . '<span id="{{ID}}-label" style="display:block"><?php _e("{{OPTIONS}}", "{{TEXT-DOMAIN}}"); ?></span>' . "\r\n";
$module['callback'] .= "\t\t\t\t\t" . '<img id="{{ID}}-image" style="display:none" src="<?php echo $value; ?>" />' . "\r\n";
$module['callback'] .= "\t\t\t\t" . '<?php }else{ ?>' . "\r\n";
$module['callback'] .= "\t\t\t\t\t" . '<span id="{{ID}}-label" style="display:none"><?php _e("{{OPTIONS}}", "{{TEXT-DOMAIN}}"); ?></span>' . "\r\n";
$module['callback'] .= "\t\t\t\t\t" . '<img id="{{ID}}-image" style="display:block" src="<?php echo $value; ?>" />' . "\r\n";
$module['callback'] .= "\t\t\t\t" . '<?php } ?>' . "\r\n";
$module['callback'] .= "\t\t\t\t" . '</button>' . "\r\n";
$module['callback'] .= "\t\t\t\t" . '<?php if($value == ""){ ?>' . "\r\n";
$module['callback'] .= "\t\t\t\t\t" . '<a href="#!_" id="{{ID}}-reset" style="display:none"><?php _e("Remove this image", "{{TEXT-DOMAIN}}"); ?></a>' . "\r\n";
$module['callback'] .= "\t\t\t\t" . '<?php }else{ ?>' . "\r\n";
$module['callback'] .= "\t\t\t\t\t" . '<a href="#!_" id="{{ID}}-reset" style="display:block"><?php _e("Remove this image", "{{TEXT-DOMAIN}}"); ?></a>' . "\r\n";
$module['callback'] .= "\t\t\t\t" . '<?php } ?>' . "\r\n";
$module['callback'] .= "\t\t\t" . '</div>' . "\r\n";
$module['callback'] .= "\t\t" . '</div>' . "\r\n";


$module['callback'] .= "\t\t" . '<?php' . "\r\n";


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
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'background: #F7F7F7;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'color: #1e1e1e;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'text-decoration: none;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'font-size: 13px;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'margin: 0;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'border: 1px solid #7e8993;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'cursor: pointer;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . '-webkit-appearance: none;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t" . '}' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t" . '#{{ID}}-toggle:hover{' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . 'background: #eee;' . "\r\n";
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


$module['rest_api_callback'] = null;
$module['rest_api_callback'] .= "" . '' . "\r\n";
$module['rest_api_callback'] .= "\t\t" . 'if(isset($options["{{VAR}}"])){' . "\r\n";
$module['rest_api_callback'] .= "\t\t\t" . '$data["{{VAR}}"] = esc_html($options["{{VAR}}"]);' . "\r\n";
$module['rest_api_callback'] .= "\t\t" . '}else{' . "\r\n";
$module['rest_api_callback'] .= "\t\t\t" . '$data["{{VAR}}"] = null;' . "\r\n";
$module['rest_api_callback'] .= "\t\t" . '}' . "\r\n";

?>