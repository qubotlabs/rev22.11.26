<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$module['name'] = 'html-input-color';
$module['label'] = 'HTML ~ Input: Color';

$module['options']['type'] = 'color';
$module['options']['value'] = '#000000';
$module['options']['placeholder'] = '#eeeeee';
$module['options']['help'] = '<strong>format</strong>: hex color code, eg: <code>#000000</code>';

$module['default']['type'] = 'color';
$module['default']['value'] = '#000000';
$module['default']['placeholder'] = '#eeeeee';
$module['default']['help'] = '<strong>format</strong>: hex color code, eg: <code>#000000</code>';

$module['info']['value'] = 'Please enter the hex color code';
$module['info']['placeholder'] = 'Please enter the hex color code';


$module['tinymce'] = null;
$module['tinymce'] = "\t\t\t\t\t\t\t\t\t" . '{type: "colorpicker", name: "{{VAR}}", label: "{{LABEL}}", classes:"{{VAR}}", tooltip: "{{INFO}}"}';

 ?>