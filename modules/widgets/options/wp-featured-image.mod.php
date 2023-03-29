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

// TODO: UPDATE
$module['update'] = null;
$module['update'] .= "\t\t" . '$instance["{{NAME}}"] = (!empty($new_instance["{{NAME}}"])) ? strip_tags($new_instance["{{NAME}}"]) : "{{DEFAULT}}";' . "\r\n";

// TODO: FORM
$module['form'] = null;
$module['form'] .= "\t\t" . 'wp_enqueue_media();' . "\r\n";
$module['form'] .= "\t\t" . '$current_data = !empty($instance["{{NAME}}"]) ? $instance["{{NAME}}"] : "{{DEFAULT}}";' . "\r\n";
$module['form'] .= "\t\t" . '?>' . "\r\n";
$module['form'] .= "\t\t" . '<div class="">' . "\r\n";
$module['form'] .= "\t\t\t" . '<label for="<?php echo $this->get_field_id("{{ID}}"); ?>"><?php _e("{{LABEL}}:"); ?></label>' . "\r\n";
$module['form'] .= "\t\t\t" . '<input type="hidden" class="widefat" id="<?php _e($this->get_field_id("{{ID}}")); ?>" placeholder="{{OPTIONS}}" name="<?php _e($this->get_field_name("{{NAME}}")); ?>" value="<?php _e(esc_attr($current_data)); ?>">' . "\r\n";
$module['form'] .= "\t\t\t\t" . '<div>' . "\r\n";
$module['form'] .= "\t\t\t\t\t" . '<div class="{{ID}}-container">' . "\r\n";
$module['form'] .= "\t\t\t\t\t\t" . '<button type="button" class="{{ID}}-toggle" data-target="#<?php _e($this->get_field_id("{{ID}}")); ?>">' . "\r\n";
$module['form'] .= "\t\t\t\t\t\t" . '<?php if($current_data == ""){ ?>' . "\r\n";
$module['form'] .= "\t\t\t\t\t\t\t" . '<span id="<?php _e($this->get_field_id("{{ID}}")); ?>-label" class="{{ID}}-label" style="display:block"><?php _e("{{OPTIONS}}", "{{TEXT-DOMAIN}}"); ?></span>' . "\r\n";
$module['form'] .= "\t\t\t\t\t\t\t" . '<img id="<?php _e($this->get_field_id("{{ID}}")); ?>-image" class="{{ID}}-image" style="display:none" src="<?php echo $current_data; ?>" />' . "\r\n";
$module['form'] .= "\t\t\t\t\t\t" . '<?php }else{ ?>' . "\r\n";
$module['form'] .= "\t\t\t\t\t\t\t" . '<span id="<?php _e($this->get_field_id("{{ID}}")); ?>-label" class="{{ID}}-label" style="display:none"><?php _e("{{OPTIONS}}", "{{TEXT-DOMAIN}}"); ?></span>' . "\r\n";
$module['form'] .= "\t\t\t\t\t\t\t" . '<img id="<?php _e($this->get_field_id("{{ID}}")); ?>-image" class="{{ID}}-image" style="display:block" src="<?php echo $current_data; ?>" />' . "\r\n";
$module['form'] .= "\t\t\t\t\t\t" . '<?php } ?>' . "\r\n";
$module['form'] .= "\t\t\t\t\t\t" . '</button>' . "\r\n";
$module['form'] .= "\t\t\t\t\t\t" . '<?php if($current_data == ""){ ?>' . "\r\n";
$module['form'] .= "\t\t\t\t\t\t\t" . '<a href="#!_" id="<?php _e($this->get_field_id("{{ID}}")); ?>-reset" class="{{ID}}-reset" data-target="#<?php _e($this->get_field_id("{{ID}}")); ?>" style="display:none"><?php _e("Remove this image", "{{TEXT-DOMAIN}}"); ?></a>' . "\r\n";
$module['form'] .= "\t\t\t\t\t\t" . '<?php }else{ ?>' . "\r\n";
$module['form'] .= "\t\t\t\t\t\t\t" . '<a href="#!_" id="<?php _e($this->get_field_id("{{ID}}")); ?>-reset" class="{{ID}}-reset" data-target="#<?php _e($this->get_field_id("{{ID}}")); ?>" style="display:block"><?php _e("Remove this image", "{{TEXT-DOMAIN}}"); ?></a>' . "\r\n";
$module['form'] .= "\t\t\t\t\t\t" . '<?php } ?>' . "\r\n";
$module['form'] .= "\t\t\t\t\t" . '</div>' . "\r\n";
$module['form'] .= "\t\t\t\t" . '</div>' . "\r\n";
$module['form'] .= "\t\t\t" . '<p class="description"><?php _e("{{INFO}}", "{{TEXT-DOMAIN}}"); ?></p>' . "\r\n";
$module['form'] .= "\t\t" . '</div>' . "\r\n";
$module['form'] .= "\t\t" . '<?php' . "\r\n";


$module['admin_footer'] = null;
$module['admin_footer'] .= "\t\t\t" . '?>' . "\r\n";
$module['admin_footer'] .= "\t\t\t" . '<script type="text/javascript">' . "\r\n";
$module['admin_footer'] .= "\t\t\t" . '(function($){' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t" . '$(function(){' . "\r\n";


$module['admin_footer'] .= "\t\t\t\t\t" . '$("body").on("click",".{{ID}}-reset",function(e){' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'var selectTarget = $(this).attr("data-target");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'var inputTarget = $(selectTarget);' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'var imageTarget = $(selectTarget + "-image");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'var labelTarget = $(selectTarget + "-label");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'var resetTarget = $(selectTarget + "-reset");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '$(inputTarget).val("");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '$(inputTarget).trigger("change");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '$(imageTarget).attr("src","");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '$(labelTarget).css("display","block");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '$(imageTarget).css("display","none");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '$(resetTarget).css("display","none");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t" . '});' . "\r\n";

$module['admin_footer'] .= "\t\t\t\t\t" . '$("body").on("click",".{{ID}}-toggle", function(e){' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'e.preventDefault();' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'var ' . $string->toClassName($__field['name']) . 'Upload;' . "\r\n";

$module['admin_footer'] .= "\t\t\t\t\t\t" . 'var selectTarget = $(this).attr("data-target");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'var inputTarget = $(selectTarget);' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'var imageTarget = $(selectTarget + "-image");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'var labelTarget = $(selectTarget + "-label");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'var resetTarget = $(selectTarget + "-reset");' . "\r\n";


$module['admin_footer'] .= "\t\t\t\t\t\t" . 'console.log("data-target",selectTarget);' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'if (' . $string->toClassName($__field['name']) . 'Upload){' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t\t" . '' . $string->toClassName($__field['name']) . 'Upload.open();' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t\t" . 'return;' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '}' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '' . $string->toClassName($__field['name']) . 'Upload = wp.media({' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t\t" . 'title' . "\t" . ': "<?php _e("Select or Upload Image", "{{TEXT-DOMAIN}}"); ?>",' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t\t" . 'button' . "\t" . ': {' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t\t\t" . 'text' . "\t" . ': "<?php _e("Use this image", "{{TEXT-DOMAIN}}"); ?>" ' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t\t" . '},' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t\t" . 'multiple' . "\t" . ': false,' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t\t" . 'library' . "\t" . ': {' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t\t\t" . 'type' . "\t" . ': ["image"]' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t\t" . '}' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '});' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '' . $string->toClassName($__field['name']) . 'Upload.on("select",function(){' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t\t" . 'var attachment = ' . $string->toClassName($__field['name']) . 'Upload.state().get("selection").first().toJSON();' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t\t" . '$(inputTarget).val(attachment.url);' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t\t" . '$(inputTarget).trigger("change");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t\t" . '$(imageTarget).attr("src",attachment.url);' . "\r\n";

$module['admin_footer'] .= "\t\t\t\t\t\t\t" . '$(labelTarget).css("display","none");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t\t" . '$(imageTarget).css("display","block");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t\t" . '$(resetTarget).css("display","block");' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '});' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '' . $string->toClassName($__field['name']) . 'Upload.open();' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t" . '});' . "\r\n";

$module['admin_footer'] .= "\t\t\t\t\t" . '$(document).ajaxComplete(function(){' . "\r\n";
 
$module['admin_footer'] .= "\t\t\t\t\t" . '});' . "\r\n";

$module['admin_footer'] .= "\t\t\t\t" . '});' . "\r\n";
$module['admin_footer'] .= "\t\t\t" . '})(jQuery);' . "\r\n";



$module['admin_footer'] .= "\t\t\t" . '</script>' . "\r\n";
$module['admin_footer'] .= "\t\t\t" . '<?php' . "\r\n";
$module['admin_footer'] .= "\t\t\t" . '' . "\r\n";


$module['admin_enqueue_scripts'] = null;
$module['admin_enqueue_scripts'] .= "\t\t\t" . '?>' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t" . '<style type="text/css">' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . '.{{ID}}-container{' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . '}' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . '.{{ID}}-toggle{' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t\t" . 'width: 100%;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t\t" . 'max-width: 100%;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t\t" . 'border-radius: 2px;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t\t" . 'min-height: 90px;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t\t" . 'line-height: 20px;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t\t" . 'padding: 8px !important;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t\t" . 'text-align: center;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t\t" . 'background: #eee;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t\t" . 'color: #1e1e1e;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t\t" . 'text-decoration: none;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t\t" . 'font-size: 13px;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t\t" . 'margin: 0;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t\t" . 'border: 0;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t\t" . 'cursor: pointer;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t\t" . '-webkit-appearance: none;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . '}' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . '.{{ID}}-toggle:hover{' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t\t" . 'background: #ddd;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t\t" . 'color: #1e1e1e;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . '}' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . '.{{ID}}-image{' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t\t" . 'max-width: 100%;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t\t" . 'width: 100%;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . '}' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . '</style>' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t" . '<?php' . "\r\n";

?>