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


$module['register_control'] = null;
$module['register_control'] .= "\t\t" . '$this->add_control(' . "\r\n";
$module['register_control'] .= "\t\t\t" . '"{{SHORTNAME}}_{{VAR}}",' . "\r\n";
$module['register_control'] .= "\t\t\t" . '[' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"label" => esc_html__("{{LABEL}}", "{{TEXT-DOMAIN}}"),' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"type" => \Elementor\Controls_Manager::TEXT,' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"placeholder" => esc_html__("{{PLACEHOLDER}}", "{{TEXT-DOMAIN}}"),' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"input_type" => "url",' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"default" => "{{DEFAULT}}",' . "\r\n";
$module['register_control'] .= "\t\t\t" . ']' . "\r\n";
$module['register_control'] .= "\t\t" . ');' . "\r\n";

?>