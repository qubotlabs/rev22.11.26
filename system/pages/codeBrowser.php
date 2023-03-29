<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

defined("IHS_EXEC") or die("Silent is golden!");

// TODO: INIT
$db = new DB();
$string = new StringConvert();
$db->current();
$project = $db->getProject();
$breadcrumb_tags = $content_tags = $pagejs = null;


$breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
$breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
$breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("Code Browser") . '</li>';
$breadcrumb_tags .= '</ol>';

$content_tags .= '<div class="card card-outline card-primary">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-th"></i>&nbsp;';
$content_tags .= __e("General");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- AJAX REQUESTS --|-- FORM
$content_tags .= '<div class="card-body" style="background: #ECE9D8;">';


$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-4">';
$content_tags .= '<h5>' . __e("File Explorer") . '</h5>';
$content_tags .= '<div id="treefiles" style="background: #fff;">';


$rootWP = realpath(IHS_WORDPRESS_ROOT);
$dirTarget = str_replace('\\', '/', $rootWP) . '/wp-content/plugins/' . $project['prefix'];
$plugin_files = array();
$plugin_path[] = $dirTarget . '/*';
while (count($plugin_path) != 0)
{
    $v = array_shift($plugin_path);
    foreach (glob($v) as $item)
    {
        if (is_dir($item))
            $plugin_path[] = $item . '/*';
        elseif (is_file($item))
        {
            $plugin_files[] = $item;
        }
    }
}

$_SESSION['OUTPUT_FILE'] = array();

$new_files = array();
foreach ($plugin_files as $plugin_files)
{
    $path = explode('/plugins/', $plugin_files);
    $fixpath = $path[1];

    $hash = sha1(md5($fixpath));

    $new_files[$fixpath] = $fixpath;

    $_SESSION['OUTPUT_FILE'][$hash] = $fixpath;
}

function explodeTree($array, $delimiter = '_', $baseval = false)
{
    if (!is_array($array))
        return false;
    $splitRE = '/' . preg_quote($delimiter, '/') . '/';
    $returnArr = array();
    foreach ($array as $key => $val)
    {
        // Get parent parts and the current leaf
        $parts = preg_split($splitRE, $key, -1, PREG_SPLIT_NO_EMPTY);
        $leafPart = array_pop($parts);

        // Build parent structure
        // Might be slow for really deep and large structures
        $parentArr = &$returnArr;
        foreach ($parts as $part)
        {
            if (!isset($parentArr[$part]))
            {
                $parentArr[$part] = array();
            } elseif (!is_array($parentArr[$part]))
            {
                if ($baseval)
                {
                    $parentArr[$part] = array('__base_val' => $parentArr[$part]);
                } else
                {
                    $parentArr[$part] = array();
                }
            }
            $parentArr = &$parentArr[$part];
        }

        // Add the final part to the structure
        if (empty($parentArr[$leafPart]))
        {
            $parentArr[$leafPart] = $val;
        } elseif ($baseval && is_array($parentArr[$leafPart]))
        {
            $parentArr[$leafPart]['__base_val'] = $val;
        }
    }
    return $returnArr;
}

$tree = explodeTree($new_files, "/", true);


function plotTree($arr, $indent = 0, $mother_run = true)
{
    global $content_tags;
    if ($mother_run)
    {
        // the beginning of plotTree. We're at rootlevel
        $content_tags .= "<ul>\n";
    }

    foreach ($arr as $k => $v)
    {
        // skip the baseval thingy. Not a real node.
        if ($k == "__base_val")
            continue;
        // determine the real value of this node.
        $show_val = null;

        if (is_array($v))
        {
            if (isset($v["__base_val"]))
            {
                $show_val = $v["__base_val"];
            }
        } else
        {
            $show_val = $v;
        }

        // show the indents
        $content_tags .= str_repeat("  ", $indent);

        $ext = pathinfo($show_val, PATHINFO_EXTENSION);
        $hash = sha1(md5($show_val));

        if ($indent == 0)
        {
            // this is a root node. no parents
            $content_tags .= "<li data-file='" . $hash . "' data-ext='" . $ext . "' data-jstree='{\"icon\":\"file file-" . $ext . "\"}'>";
        } elseif (is_array($v))
        {
            // this is a normal node. parents and children
            $content_tags .= "<li data-jstree='{\"icon\":\"folder\"}' data-jstree='{\"opened\":true}' >";
        } else
        {
            // this is a leaf node. no children
            $content_tags .= "<li data-file='" . $hash . "' data-ext='" . $ext . "' data-jstree='{\"icon\":\"file file-" . $ext . "\"}'>";
        }

        // show the actual node
        $content_tags .= $k; // <!--(" . $show_val . ")-->
        if (is_array($v))
        {
            // this is what makes it recursive, rerun for childs
            $content_tags .= "<ul>\n";
            plotTree($v, ($indent + 1), false);
            $content_tags .= "</ul>\n";
        }
        $content_tags .= '</li>';
    }

    if ($mother_run)
    {
        $content_tags .= "</ul>\n";
    }
}


plotTree($tree);

$content_tags .= '</div>';
$content_tags .= '</div>';

$content_tags .= '<div class="col-md-8">';
$content_tags .= '<h5>' . __e("Source Code") . '</h5>';
$content_tags .= '<textarea id="code-edit" style="width: 100%;height:600px;"></textarea>';
$content_tags .= '</div>';

$content_tags .= '</div>';

$content_tags .= '</div>';
$content_tags .= '</div>';

define('IHS_LAYOUT_CONTENT', $content_tags);
define('IHS_LAYOUT_BREADCRUMB', $breadcrumb_tags);
define('IHS_PAGE_NAME', 'Code Browser');
define('IHS_PAGE_DESC', __e("Explore your code"));

?>