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

$module['name'] = 'html-input-number';
$module['label'] = 'HTML ~ Input: Number';
$module['options']['help'] = '';


$module['options']['value'] = '0|10';
$module['options']['placeholder'] = '0|10';
$module['options']['help'] = '<strong>format</strong>: min|max, eg: 10|100';

$module['default']['value'] = '20';
$module['default']['placeholder'] = '20';
$module['default']['help'] = '<strong>default</strong>, eg: 10';

$module['info']['value'] = '';
$module['info']['placeholder'] = '';
$module['info']['help'] = '<strong>step</strong>, eg: 10';


$range[0] = 0;
$range[1] = 100;
if (isset($__field['options']))
{
    if ($__field['options'] != '')
    {
        $range = explode("|", $__field['options']);
    }
}
if (!isset($range[0]))
{
    $range[0] = 0;
}
if (!isset($range[1]))
{
    $range[1] = 100;
}


if (!isset($__field['default']))
{
    $__field['default'] = 0;
}
if (!isset($__field['info']))
{
    $__field['info'] = 10;
}


$module['register_control'] = null;
$module['register_control'] .= "\t\t" . '$min = ' . (int)$range[0] . ';' . "\r\n";
$module['register_control'] .= "\t\t" . '$max = ' . (int)$range[1] . ';' . "\r\n";
$module['register_control'] .= "\t\t" . '$default = ' . (int)$__field['default'] . ';' . "\r\n";
$module['register_control'] .= "\t\t" . '$step = ' . (int)$__field['info'] . ';' . "\r\n";

$module['register_control'] .= "\t\t" . '$this->add_control(' . "\r\n";
$module['register_control'] .= "\t\t\t" . '"{{SHORTNAME}}_{{VAR}}",' . "\r\n";
$module['register_control'] .= "\t\t\t" . '[' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"label" => esc_html__("{{LABEL}}", "{{TEXT-DOMAIN}}"),' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"type" => \Elementor\Controls_Manager::NUMBER,' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"default" => $default,' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"min" => $min,' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"max" => $max,' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"step" => $step,' . "\r\n";
$module['register_control'] .= "\t\t\t" . ']' . "\r\n";
$module['register_control'] .= "\t\t" . ');' . "\r\n";

?>