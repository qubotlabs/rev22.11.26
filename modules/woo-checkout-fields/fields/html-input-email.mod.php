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

 
$module['checkout_fields'] = null;
$module['checkout_fields'] .= "\t\t" . '$fields[$position]["{{SHORTNAME}}_{{VAR}}"]["type"] = "email";' . "\r\n";
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