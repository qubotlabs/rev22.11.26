<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$db = new DB();
$string = new StringConvert();
$plugin_options = $db->getPluginOptions();
$project = $db->getProject();

$shortname = $project['short-name'];

$module['name'] = 'html-input-date';
$module['label'] = 'HTML ~ Input: Date';
$module['options']['help'] = '';

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

$module['register_control'] = null;
$module['register_control'] .= "\t\t" . '$this->add_control(' . "\r\n";
$module['register_control'] .= "\t\t\t" . '"{{SHORTNAME}}_{{VAR}}",' . "\r\n";
$module['register_control'] .= "\t\t\t" . '[' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"label" => esc_html__("{{LABEL}}", "{{TEXT-DOMAIN}}"),' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"type" => \Elementor\Controls_Manager::TEXT,' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"placeholder" => esc_html__("{{PLACEHOLDER}}", "{{TEXT-DOMAIN}}"),' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"input_type" => "date",' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"default" => "{{DEFAULT}}",' . "\r\n";
$module['register_control'] .= "\t\t\t" . ']' . "\r\n";
$module['register_control'] .= "\t\t" . ');' . "\r\n";

?>