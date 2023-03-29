<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$module['name'] = 'html-input-time';
$module['label'] = 'HTML ~ Input: Time';

$module['options']['type'] = 'time';
$module['options']['value'] = '23:30';
$module['options']['placeholder'] = '23:30';
$module['options']['help'] = '<strong>format</strong>: hh:ii, eg: 23:30';

$module['default']['type'] = 'time';
$module['default']['value'] = '23:30';
$module['default']['placeholder'] = '23:30';
$module['default']['help'] = '<strong>format</strong>: hh:ii, eg: 23:30';


$module['info']['value'] = '';
$module['info']['placeholder'] = '';

$module['fields'] = null;
$module['fields'] .= "\t\t\t" . '$settings[] = array(' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"name" => __("{{LABEL}}", "{{TEXTDOMAIN}}"),' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"id" => "{{SHORTNAME}}_{{VAR}}",' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"type" => "time",' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"desc" => __("{{INFO}}", "{{TEXTDOMAIN}}"),' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"default" => "{{DEFAULT}}",' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"css" => "",' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '//"desc_tip" => __("{{PLACEHOLDER}}", "{{TEXTDOMAIN}}"),' . "\r\n";
$module['fields'] .= "\t\t\t" . ');' . "\r\n";

?>