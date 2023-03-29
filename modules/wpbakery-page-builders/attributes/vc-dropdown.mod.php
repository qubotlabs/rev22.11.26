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

$module['name'] = 'vc-dropdown';
$module['label'] = 'VC ~ Dropdown';

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
            $data_opt .= "\t\t\t\t\t\t" . '__("' . ($opt) . '","{{TEXTDOMAIN}}") => "' . $string->toVar($opt) . '",' . "\r\n";
        }
    }
}


$module['param'] = null;
$module['param'] .= "\t\t\t\t" . 'array(' . "\r\n";
$module['param'] .= "\t\t\t\t\t" . '"type" => "dropdown",' . "\r\n";
$module['param'] .= "\t\t\t\t\t" . '"holder" => "div",' . "\r\n";
$module['param'] .= "\t\t\t\t\t" . '"class" => "{{SHORTNAME}}-{{NAME}}",' . "\r\n";
$module['param'] .= "\t\t\t\t\t" . '"heading" => __( "{{LABEL}}", "{{TEXTDOMAIN}}" ),' . "\r\n";
$module['param'] .= "\t\t\t\t\t" . '"param_name" => "{{SHORTNAME}}_{{VAR}}",'. "\r\n";
$module['param'] .= "\t\t\t\t\t" . '"value" => array(' . "\r\n";
$module['param'] .= $data_opt;
$module['param'] .= "\t\t\t\t\t" . '),' . "\r\n";
$module['param'] .= "\t\t\t\t\t" . '"std" => "' . $string->toVar($__field['default']) . '" ,' . "\r\n";
$module['param'] .= "\t\t\t\t\t" . '"description" => __( "{{INFO}}", "{{TEXTDOMAIN}}" )' . "\r\n";
$module['param'] .= "\t\t\t\t" . '),' . "\r\n";

?>