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

 
$module['fields'] = null;
$module['fields'] .= "\t\t\t" . '$settings[] = array(' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"name" => __("{{LABEL}}", "{{TEXTDOMAIN}}"),' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"id" => "{{SHORTNAME}}_{{VAR}}",' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"type" => "email",' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"desc" => __("{{INFO}}", "{{TEXTDOMAIN}}"),' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"default" => "{{DEFAULT}}",' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"css" => "",' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '//"desc_tip" => __("{{PLACEHOLDER}}", "{{TEXTDOMAIN}}"),' . "\r\n";
$module['fields'] .= "\t\t\t" . ');' . "\r\n";
?>