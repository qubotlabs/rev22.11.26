<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$module['name'] = 'html-select';
$module['label'] = 'HTML ~ Select';

$module['options']['value'] = 'option 1|option 2|option 3';
$module['options']['placeholder'] = 'option 1|option 2|option 3';
$module['options']['help'] = '<strong>format</strong>: separator with: <code>|</code>, eg: opt1|opt2|opt3';

$module['default']['value'] = 'option 1';
$module['default']['placeholder'] = 'option 1';
$module['info']['value'] = '';
$module['info']['placeholder'] = '';

$my_options = array();
if (isset($__field['options']))
{
    if ($__field['options'] != '')
    {
        $options = explode("|", $__field['options']);
        foreach ($options as $opt)
        {
            $my_options[] = ($opt);
        }
    }
}

$module['tinymce'] = null;
$module['tinymce'] = "\t\t\t\t\t\t\t\t\t" . '{type: "selectbox", name: "{{VAR}}", label: "{{LABEL}}", tooltip: "{{INFO}}", options:' . json_encode($my_options) . ' }';

?>