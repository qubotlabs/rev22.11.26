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

$module['name'] = 'end-section';
$module['label'] = 'End Section';
$module['options']['help'] = '';



$module['register_control'] = null;
$module['register_control'] .= "\t\t" . '$this->end_controls_section();' . "\r\n";



?>