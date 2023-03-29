<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$module['name'] = 'html-textarea';
$module['label'] = 'HTML ~ Textarea';
 
$module['fields'] = null;
$module['fields'] .= "\t\t\t" . '$settings[] = array(' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"name" => __("{{LABEL}}", "{{TEXTDOMAIN}}"),' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"id" => "{{SHORTNAME}}_{{VAR}}",' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"type" => "textarea",' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"desc" => __("{{INFO}}", "{{TEXTDOMAIN}}"),' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"default" => "{{DEFAULT}}",' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"css" => "",' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '//"desc_tip" => __("{{PLACEHOLDER}}", "{{TEXTDOMAIN}}"),' . "\r\n";
$module['fields'] .= "\t\t\t" . ');' . "\r\n";

?>