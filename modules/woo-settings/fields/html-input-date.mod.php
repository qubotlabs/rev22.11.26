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

$module['fields'] = null;
$module['fields'] .= "\t\t\t" . '$settings[] = array(' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"name" => __("{{LABEL}}", "{{TEXTDOMAIN}}"),' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"id" => "{{SHORTNAME}}_{{VAR}}",' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"type" => "date",' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"desc" => __("{{INFO}}", "{{TEXTDOMAIN}}"),' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"default" => "{{DEFAULT}}",' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"css" => "",' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '//"desc_tip" => __("{{PLACEHOLDER}}", "{{TEXTDOMAIN}}"),' . "\r\n";
$module['fields'] .= "\t\t\t" . ');' . "\r\n";
?>