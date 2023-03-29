<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$module['name'] = 'html-input-number';
$module['label'] = 'HTML ~ Input: Number';

$module['options']['value'] = '123';
$module['options']['placeholder'] = '123';
$module['options']['type'] = 'number';

$module['default']['value'] = '1234';
$module['default']['placeholder'] = '123';
$module['default']['type'] = 'number';

$module['info']['value'] = '';
$module['info']['placeholder'] = '';

$module['checkout_fields'] = null;
$module['checkout_fields'] .= "\t\t" . '$fields[$position]["{{SHORTNAME}}_{{VAR}}"]["type"] = "number";' . "\r\n";
$module['checkout_fields'] .= "\t\t" . '$fields[$position]["{{SHORTNAME}}_{{VAR}}"]["label"] = __("{{LABEL}}", "{{TEXTDOMAIN}}");' . "\r\n";
$module['checkout_fields'] .= "\t\t" . '$fields[$position]["{{SHORTNAME}}_{{VAR}}"]["placeholder"] = "{{PLACEHOLDER}}";' . "\r\n";
$module['checkout_fields'] .= "\t\t" . '$fields[$position]["{{SHORTNAME}}_{{VAR}}"]["required"] = true;' . "\r\n";
$module['checkout_fields'] .= "\t\t" . '$fields[$position]["{{SHORTNAME}}_{{VAR}}"]["default"] = "{{DEFAULT}}" ;' . "\r\n";
	
$module['admin_order_data'] = null;
$module['admin_order_data'] .= "\t\t" . 'echo "<p><strong>" . __("{{LABEL}}", "{{TEXTDOMAIN}}"). ":</strong><br>" . get_post_meta( $order->id, "_{{SHORTNAME}}_{{VAR}}", true ) . "</p>";' . "\r\n"; 
	  

$module['update_order_meta'] = null;
$module['update_order_meta'] .= "\t\t" . 'if(!empty($_POST["{{SHORTNAME}}_{{VAR}}"])){' . "\r\n"; 
$module['update_order_meta'] .= "\t\t\t" . 'update_post_meta( $order_id, "_{{SHORTNAME}}_{{VAR}}", sanitize_text_field($_POST["{{SHORTNAME}}_{{VAR}}"]));' . "\r\n"; 
$module['update_order_meta'] .= "\t\t" . '}' . "\r\n"; 

  
?>