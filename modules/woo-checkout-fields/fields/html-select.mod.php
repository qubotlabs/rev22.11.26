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


$module['checkout_fields'] = null;
$module['checkout_fields'] .= "\t\t" . '' . "\r\n";
$module['checkout_fields'] .= "\t\t" . '$options = array(' . "\r\n";
if (isset($__field['options']))
{
    if ($__field['options'] != '')
    {
        $options = explode("|", $__field['options']);
        foreach ($options as $opt)
        {
            $module['checkout_fields'] .= "\t\t\t" . '"' . strtolower($opt) . '" => __("' . ucwords($opt) . '","{{TEXT-DOMAIN}}"),' . "\r\n";
        }
    }
}
$module['checkout_fields'] .= "\t\t" . ');' . "\r\n";

$module['checkout_fields'] .= "\t\t" . '$fields[$position]["{{SHORTNAME}}_{{VAR}}"]["type"] = "select";' . "\r\n";
$module['checkout_fields'] .= "\t\t" . '$fields[$position]["{{SHORTNAME}}_{{VAR}}"]["label"] = __("{{LABEL}}", "{{TEXTDOMAIN}}");' . "\r\n";
$module['checkout_fields'] .= "\t\t" . '$fields[$position]["{{SHORTNAME}}_{{VAR}}"]["required"] = true;' . "\r\n";
$module['checkout_fields'] .= "\t\t" . '$fields[$position]["{{SHORTNAME}}_{{VAR}}"]["options"] = $options;' . "\r\n";
$module['checkout_fields'] .= "\t\t" . '$fields[$position]["{{SHORTNAME}}_{{VAR}}"]["default"] = "{{DEFAULT}}" ;' . "\r\n";
	
$module['admin_order_data'] = null;
$module['admin_order_data'] .= "\t\t" . 'echo "<p><strong>" . __("{{LABEL}}", "{{TEXTDOMAIN}}"). ":</strong><br>" . get_post_meta( $order->id, "_{{SHORTNAME}}_{{VAR}}", true ) . "</p>";' . "\r\n"; 
	  

$module['update_order_meta'] = null;
$module['update_order_meta'] .= "\t\t" . 'if(!empty($_POST["{{SHORTNAME}}_{{VAR}}"])){' . "\r\n"; 
$module['update_order_meta'] .= "\t\t\t" . 'update_post_meta( $order_id, "_{{SHORTNAME}}_{{VAR}}", sanitize_text_field($_POST["{{SHORTNAME}}_{{VAR}}"]));' . "\r\n"; 
$module['update_order_meta'] .= "\t\t" . '}' . "\r\n"; 



 
?>