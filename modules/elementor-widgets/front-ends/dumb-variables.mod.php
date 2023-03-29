<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/


$module['name'] = 'dumb-variables';
$module['label'] = 'Dumb Variables';


$db = new DB();
$string = new StringConvert();
$project = $db->getProject();
$shortname = $project['short-name'];
$module['render'] = null;

if (isset($_GET["n"]))
{
    if ($_GET["a"] == "edit")
    {
        $_prefix = basename($_GET["n"]);
        $elementor_fields = $db->getElementorWidget($_prefix);
        if (!isset($elementor_fields['fields']))
        {
            $elementor_fields['fields'] = array();
        }

        if (!is_array($elementor_fields['fields']))
        {
            $elementor_fields['fields'] = array();
        }
        $module['render'] .= 'echo "<table>' . "\r\n";
        foreach ($elementor_fields['fields'] as $elementor_field)
        {
            if ($elementor_field['type'] != 'end-section')
            {

                if ($elementor_field['type'] != 'start-section')
                {
                    $module['render'] .= "\t" . '<tr><td style=\'padding:2px;margin:0\'><pre style=\'padding:0;margin:0\'>{\\${{SHORTNAME}}_' . $string->toVar($elementor_field['name']) . '}</pre></td><td style=\'padding:2px;margin:0\'>:</td><td style=\'padding:2px;margin:0\'><pre style=\'padding:0;margin:0\'>" . print_r(${{SHORTNAME}}_' . $string->toVar($elementor_field['name']) . ',true)  ."</pre></td></tr>' . "\r\n";
                }
            }
        }
        $module['render'] .= '</table>";' . "\r\n";
    }
}

?>