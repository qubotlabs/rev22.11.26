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

$module['name'] = 'vc-attach_images';
$module['label'] = 'VC ~ Attach Images (Multiple images selection)';
$module['options']['help'] = '';

$module['options']['value'] = '';
$module['options']['placeholder'] = '';

$module['default']['value'] = '';
$module['default']['placeholder'] = '';

$module['info']['value'] = '';
$module['info']['placeholder'] = '';


$module['param'] = null;
$module['param'] .= "\t\t\t\t" . 'array('. "\r\n";
$module['param'] .= "\t\t\t\t\t" . '"type" => "attach_images",'. "\r\n";
$module['param'] .= "\t\t\t\t\t" . '"holder" => "div",'. "\r\n";
$module['param'] .= "\t\t\t\t\t" . '"class" => "{{SHORTNAME}}-{{NAME}}",'. "\r\n";
$module['param'] .= "\t\t\t\t\t" . '"heading" => __( "{{LABEL}}", "{{TEXTDOMAIN}}" ),'. "\r\n";
$module['param'] .= "\t\t\t\t\t" . '"param_name" => "{{SHORTNAME}}_{{VAR}}",'. "\r\n";
$module['param'] .= "\t\t\t\t\t" . '"value" => __( "{{DEFAULT}}", "{{TEXTDOMAIN}}" ),'. "\r\n";
$module['param'] .= "\t\t\t\t\t" . '"description" => __( "{{INFO}}", "{{TEXTDOMAIN}}" )'. "\r\n";
$module['param'] .= "\t\t\t\t" . '),'. "\r\n";


?>