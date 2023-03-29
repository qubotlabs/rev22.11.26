<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$module['name'] = 'html-input-url';
$module['label'] = 'HTML ~ Input: URL';

$module['options']['type'] = 'url';
$module['options']['value'] = 'https://ihsana.com/';
$module['options']['placeholder'] = 'https://ihsana.com/';
$module['options']['help'] = '<strong>format</strong>: url';

$module['default']['type'] = 'url';
$module['default']['value'] = '';
$module['default']['placeholder'] = 'https://ihsana.com/';
$module['default']['help'] = '<strong>format</strong>: url';

$module['info']['value'] = 'Please enter the correct url';
$module['info']['placeholder'] = 'Please enter the correct url';


$module['checkout_fields'] = null;
$module['checkout_fields'] .= "\t\t" . '$fields[$position]["{{SHORTNAME}}_{{VAR}}"]["type"] = "url";' . "\r\n";
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