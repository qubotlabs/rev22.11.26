<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$module['name'] = 'html-input-text';
$module['label'] = 'HTML ~ Input: Text';

$module['options']['value'] = '';
$module['options']['placeholder'] = 'lorem ipsum do ismet';
$module['default']['value'] = '';
$module['default']['placeholder'] = 'lorem ipsum do ismet';
$module['info']['value'] = '';
$module['info']['placeholder'] = 'lorem ipsum do ismet';


$module['tinymce'] = null;
$module['tinymce'] = "\t\t\t\t\t\t\t\t\t" . '{type: "textbox", name: "{{VAR}}", label: "{{LABEL}}", tooltip: "{{INFO}}" }';



 

?>