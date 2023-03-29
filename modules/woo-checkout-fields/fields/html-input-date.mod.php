<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$module['name'] = 'html-input-date';
$module['label'] = 'HTML ~ Input: Date';

$module['options']['value'] = '2020-10-14';
$module['options']['placeholder'] = '2020-10-14';
$module['options']['help'] = '<strong>format</strong>: date, eg: <code>yyyy-mm-dd</code>';
$module['options']['type'] = 'date';

$module['default']['value'] = '2020-10-14';
$module['default']['placeholder'] = '2020-10-14';
$module['default']['help'] = '<strong>format</strong>: date, eg: <code>yyyy-mm-dd</code>';
$module['default']['type'] = 'date';

$module['info']['value'] = '';
$module['info']['placeholder'] = '';

$module['checkout_fields'] = null;
$module['checkout_fields'] .= "\t\t" . '$fields[$position]["{{SHORTNAME}}_{{VAR}}"]["type"] = "date";' . "\r\n";
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