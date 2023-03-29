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


$module['name'] = 'elementor-media';
$module['label'] = 'Elementor - Media Control';
$module['options']['help'] = '';

$module['info']['value'] = '';
$module['info']['placeholder'] = '';

$module['register_control'] = null;
$module['register_control'] .= "\t\t" . '$this->add_control(' . "\r\n";
$module['register_control'] .= "\t\t\t" . '"{{SHORTNAME}}_{{VAR}}",' . "\r\n";
$module['register_control'] .= "\t\t\t" . '[' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"label" => esc_html__("{{LABEL}}", "{{TEXT-DOMAIN}}"),' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"type" => \Elementor\Controls_Manager::MEDIA,' . "\r\n";

$module['register_control'] .= "\t\t\t\t" . '"default" => [' . "\r\n";
$module['register_control'] .= "\t\t\t\t\t" . '"url" => \Elementor\Utils::get_placeholder_image_src(),' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '],' . "\r\n";

$module['register_control'] .= "\t\t\t" . ']' . "\r\n";
$module['register_control'] .= "\t\t" . ');' . "\r\n";

?>