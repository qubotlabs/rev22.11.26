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
$module['shortcode'] = null;

if (isset($_GET["n"]))
{
    if ($_GET["a"] == "edit")
    {
        $_prefix = basename($_GET["n"]);
        $bakery_current = $db->getWpbakeryPageBuilder($_prefix);
        if (!isset($bakery_current['fields']))
        {
            $bakery_current['fields'] = array();
        }
        $module['shortcode'] .= '$output = "<table>' . "\r\n";
        foreach ($bakery_current['fields'] as $bakeryfield)
        {
            $module['shortcode'] .= "\t" . '<tr><td style=\'padding:2px;margin:0\'><pre style=\'padding:0;margin:0\'>{\\${{SHORTNAME}}_' . $string->toVar($bakeryfield['name']) . '}</pre></td><td style=\'padding:2px;margin:0\'>:</td><td style=\'padding:2px;margin:0\'><pre style=\'padding:0;margin:0\'>{${{SHORTNAME}}_' . $string->toVar($bakeryfield['name']) . '}</pre></td></tr>' . "\r\n";
        }
        $module['shortcode'] .= '</table>";' . "\r\n";
    }
}

?>