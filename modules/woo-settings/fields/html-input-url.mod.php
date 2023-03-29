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


$module['fields'] = null;
$module['fields'] .= "\t\t\t" . '$settings[] = array(' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"name" => __("{{LABEL}}", "{{TEXTDOMAIN}}"),' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"id" => "{{SHORTNAME}}_{{VAR}}",' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"type" => "url",' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"desc" => __("{{INFO}}", "{{TEXTDOMAIN}}"),' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"default" => "{{DEFAULT}}",' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '"css" => "",' . "\r\n";
$module['fields'] .= "\t\t\t\t" . '//"desc_tip" => __("{{PLACEHOLDER}}", "{{TEXTDOMAIN}}"),' . "\r\n";
$module['fields'] .= "\t\t\t" . ');' . "\r\n";

?>