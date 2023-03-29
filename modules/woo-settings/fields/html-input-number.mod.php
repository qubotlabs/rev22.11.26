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

$module['fields'] = null;
$module['fields'] .= "\t\t\t" . '$settings[] = array(' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"name" => __("{{LABEL}}", "{{TEXTDOMAIN}}"),' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"id" => "{{SHORTNAME}}_{{VAR}}",' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"type" => "number",' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"desc" => __("{{INFO}}", "{{TEXTDOMAIN}}"),' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"default" => "{{DEFAULT}}",' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"css" => "",' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '//"desc_tip" => __("{{PLACEHOLDER}}", "{{TEXTDOMAIN}}"),' . "\r\n";
$module['fields'] .= "\t\t\t" . ');' . "\r\n";

?>