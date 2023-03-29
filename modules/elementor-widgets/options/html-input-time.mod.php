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

$module['register_control'] = null;
$module['register_control'] .= "\t\t" . '$this->add_control(' . "\r\n";
$module['register_control'] .= "\t\t\t" . '"{{SHORTNAME}}_{{VAR}}",' . "\r\n";
$module['register_control'] .= "\t\t\t" . '[' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"label" => esc_html__("{{LABEL}}", "{{TEXT-DOMAIN}}"),' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"type" => \Elementor\Controls_Manager::TEXT,' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"placeholder" => esc_html__("{{PLACEHOLDER}}", "{{TEXT-DOMAIN}}"),' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"input_type" => "time",' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"default" => "{{DEFAULT}}",' . "\r\n";
$module['register_control'] .= "\t\t\t" . ']' . "\r\n";
$module['register_control'] .= "\t\t" . ');' . "\r\n";
 
?>