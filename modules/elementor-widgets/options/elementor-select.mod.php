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

$module['name'] = 'elementor-select';
$module['label'] = 'Elementor - Select Control';
$module['options']['help'] = '';


$module['options']['value'] = 'option 1|option 2|option 3';
$module['options']['placeholder'] = 'option 1|option 2|option 3';
$module['options']['help'] = '<strong>format</strong>: separator with: <code>|</code>, eg: opt1|opt2|opt3';

$module['default']['value'] = 'option 1';
$module['default']['placeholder'] = 'option 1';
$module['info']['value'] = '';
$module['info']['placeholder'] = '';

if (!isset($__field['default']))
{
    $__field['default'] = '';
}

$data_opt = null;
if (isset($__field['options']))
{
    if ($__field['options'] != '')
    {
        $options = explode("|", $__field['options']);

        foreach ($options as $opt)
        {
            $data_opt .= "\t\t\t\t\t" . '"' . $string->toVar($opt) . '" => "' . ($opt) . '",' . "\r\n";
        }
    }
}


$module['register_control'] = null;
$module['register_control'] .= "\t\t" . '$this->add_control(' . "\r\n";
$module['register_control'] .= "\t\t\t" . '"{{SHORTNAME}}_{{VAR}}",' . "\r\n";
$module['register_control'] .= "\t\t\t" . '[' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"label" => esc_html__("{{LABEL}}", "{{TEXT-DOMAIN}}"),' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"type" => \Elementor\Controls_Manager::SELECT,' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"options" => [' . "\r\n";
$module['register_control'] .= $data_opt;
$module['register_control'] .= "\t\t\t\t" . '],' . "\r\n";
$module['register_control'] .= "\t\t\t\t" . '"default" => "' . $string->toVar($__field['default']) . '",' . "\r\n";
$module['register_control'] .= "\t\t\t" . ']' . "\r\n";
$module['register_control'] .= "\t\t" . ');' . "\r\n";

?>