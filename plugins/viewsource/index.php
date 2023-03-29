<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 */

error_reporting(0);

session_start();

define('IHS_EXEC', true);
require_once '../../config.php';


$theme = 'liquibyte';
$content_type = 'markdown';
$content_data = '';
$content_title = '';

if (isset($_SESSION['CURRENT_PROJECT_PREFIX']))
{
    $prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
    $plugin_dir = IHS_WORDPRESS_ROOT . '/wp-content/plugins/' . $prefix;
    switch ($_GET['f'])
    {
        case 'readMe':
            $content_title = 'Code: /' . $prefix . '/readme.txt';
            $content_type = 'markdown';
            if (file_exists($plugin_dir . '/readme.txt'))
            {
                $content_data = file_get_contents($plugin_dir . '/readme.txt');
            }
            break;
        case 'imageSizes':
            $content_title = 'Code: /' . $prefix . '/incl/image-sizes.php';
            $content_type = 'php';
            if (file_exists($plugin_dir . '/incl/image-sizes.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/image-sizes.php');
            }
            break;
        case 'customPosts':
            $content_title = 'Code: /' . $prefix . '/incl/custom-posts.php';
            $content_type = 'php';
            if (file_exists($plugin_dir . '/incl/custom-posts.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/custom-posts.php');
            }
            break;
        case 'customFields':
            $content_title = 'Code: /' . $prefix . '/incl/custom-fields.php';
            $content_type = 'php';
            if (file_exists($plugin_dir . '/incl/custom-fields.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/custom-fields.php');
            }
            break;
        case 'taxonomies':
            $content_title = 'Code: /' . $prefix . '/incl/taxonomies.php';
            $content_type = 'php';
            if (file_exists($plugin_dir . '/incl/taxonomies.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/taxonomies.php');
            }
            break;
        case 'roles':
            $content_title = 'Code: /' . $prefix . '/incl/roles.php';
            $content_type = 'php';
            if (file_exists($plugin_dir . '/incl/roles.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/roles.php');
            }
            break;
        case 'enqueueScripts':
            $content_title = 'Code: /' . $prefix . '/incl/enqueue-scripts.php';
            $content_type = 'php';
            if (file_exists($plugin_dir . '/incl/enqueue-scripts.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/enqueue-scripts.php');
            }
            break;
        case 'enqueueStyles':
            $content_title = 'Code: /' . $prefix . '/incl/enqueue-styles.php';
            $content_type = 'php';
            if (file_exists($plugin_dir . '/incl/enqueue-styles.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/enqueue-styles.php');
            }
            break;
        case 'metaBoxes':
            $content_title = 'Code: /' . $prefix . '/incl/meta-boxes.php';
            $content_type = 'php';
            if (file_exists($plugin_dir . '/incl/meta-boxes.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/meta-boxes.php');
            }
            break;
        case 'widgets':
            $content_title = 'Code: /' . $prefix . '/incl/widgets.php';
            $content_type = 'php';
            if (file_exists($plugin_dir . '/incl/widgets.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/widgets.php');
            }
            break;
        case 'extraFields':
            $content_title = 'Code: /' . $prefix . '/incl/extra-fields.php';
            $content_type = 'php';
            if (file_exists($plugin_dir . '/incl/extra-fields.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/extra-fields.php');
            }
            break;
        case 'pluginOptions':
            $content_title = 'Code: /' . $prefix . '/incl/plugin-options.php';
            $content_type = 'php';
            if (file_exists($plugin_dir . '/incl/plugin-options.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/plugin-options.php');
            }
            break;
        case 'widget':
            if (isset($_GET['n']))
            {
                $name = basename($_GET['n']);
                $content_title = 'Code: /' . $prefix . '/incl/widgets/' . $name . '.php';
                $content_type = 'php';
                if (file_exists($plugin_dir . '/incl/widgets/' . $name . '.php'))
                {
                    $content_data = file_get_contents($plugin_dir . '/incl/widgets/' . $name . '.php');
                }
            }
            break;
        case 'shortCodes':
            $content_title = 'Code: /' . $prefix . '/incl/short-codes.php';
            $content_type = 'php';
            if (file_exists($plugin_dir . '/incl/short-codes.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/short-codes.php');
            }
            break;
        case 'adminNotices':
            $content_title = 'Code: /' . $prefix . '/incl/admin-notices.php';
            $content_type = 'php';
            if (file_exists($plugin_dir . '/incl/admin-notices.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/admin-notices.php');
            }
            break;
        case 'adminBars':
            $content_title = 'Code: /' . $prefix . '/incl/admin-bars.php';
            $content_type = 'php';
            if (file_exists($plugin_dir . '/incl/admin-bars.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/admin-bars.php');
            }
            break;
        case 'tinyMCE':
            $name = basename($_GET['n']);

            $content_title = 'Code: /' . $prefix . '/assets/tinymce-plugins/' . $name . '/' . $name . '.js';
            $content_type = 'js';
            if (file_exists($plugin_dir . '/assets/tinymce-plugins/' . $name . '/' . $name . '.js'))
            {
                $content_data = file_get_contents($plugin_dir . '/assets/tinymce-plugins/' . $name . '/' . $name . '.js');
            }
            break;

        case 'adminPages':
            $name = basename($_GET['n']);
            $content_title = 'Code: /' . $prefix . '/incl/admin-pages/' . $name . '.php';
            $content_type = 'php';
            if (file_exists($plugin_dir . '/incl/admin-pages/' . $name . '.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/admin-pages/' . $name . '.php');
            }
            break;

        case 'contents':
            $name = basename($_GET['n']);
            $content_title = 'Code: /' . $prefix . '/incl/contents/' . $name . '.php';
            $content_type = 'php';
            if (file_exists($plugin_dir . '/incl/contents/' . $name . '.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/contents/' . $name . '.php');
            }
            break;

        case 'ajaxRequests':
            $name = basename($_GET['n']);
            $content_title = 'Code: /' . $prefix . '/incl/ajax/' . $name . '.php';
            $content_type = 'php';
            if (file_exists($plugin_dir . '/incl/ajax/' . $name . '.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/ajax/' . $name . '.php');
            }
            break;
        case 'elementorWidgets':
            $name = basename($_GET['n']);
            $content_title = 'Code: /' . $prefix . '/incl/elementor-widgets/' . $name . '.php';
            $content_type = 'php';
            if (file_exists($plugin_dir . '/incl/elementor-widgets/' . $name . '.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/elementor-widgets/' . $name . '.php');
            }
            break;
        case 'wpbakeryPageBuilders':
            $name = basename($_GET['n']);
            $content_title = 'Code: /' . $prefix . '/incl/wpbakery-page-builders/' . $name . '.php';
            $content_type = 'php';
            if (file_exists($plugin_dir . '/incl/wpbakery-page-builders/' . $name . '.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/wpbakery-page-builders/' . $name . '.php');
            }
            break;
        case 'wooSettings':
            $name = basename($_GET['n']);
            $content_title = 'Code: /' . $prefix . '/incl/woo-settings/' . $name . '.php';
            $content_type = 'php';
            if (file_exists($plugin_dir . '/incl/woo-settings/' . $name . '.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/woo-settings/' . $name . '.php');
            }
            break;
        case 'wooCheckoutFields':
            $name = basename($_GET['n']);
            $content_title = 'Code: /' . $prefix . '/incl/woo-checkout-fields/' . $name . '.php';
            $content_type = 'php';
            if (file_exists($plugin_dir . '/incl/woo-checkout-fields/' . $name . '.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/woo-checkout-fields/' . $name . '.php');
            }
            break;
        case 'source':
            if (!isset($_GET['hash_file']))
            {
                $_GET['hash_file'] = null;
            }
            $hash = $_GET['hash_file'];


            if (isset($_SESSION['OUTPUT_FILE'][$hash]))
            {
                $dec_hash = $_SESSION['OUTPUT_FILE'][$hash];

                $filename = IHS_WORDPRESS_ROOT . '/wp-content/plugins/' . $dec_hash;


                header('Content-type: text/plain');
                if (file_exists($filename))
                {

                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $source_code = file_get_contents($filename);
                    die($source_code);
                } else
                {
                    die('File not found');
                }
            } else
            {
                die('click the file you want to view source code');
            }
            break;

    }


}

echo '<!DOCTYPE HTML>' . "\r\n";
echo '<html>' . "\r\n";
echo '<head>' . "\r\n";
echo '<meta http-equiv="content-type" content="text/html" />' . "\r\n";
echo '<meta charset="utf-8"/>' . "\r\n";
echo '<title>' . $content_title . '</title>' . "\r\n";
echo '<link rel="stylesheet" href="../../templates/default/plugins/codemirror/lib/codemirror.css"/>' . "\r\n";
echo '<link rel="stylesheet" href="../../templates/default/plugins/codemirror/addon/display/fullscreen.css" />' . "\r\n";
echo '<link rel="stylesheet" href="../../templates/default/plugins/codemirror/theme/' . $theme . '.css"/>' . "\r\n";
echo '</head>' . "\r\n";
echo '<body>' . "\r\n";
echo '<textarea id="code" name="code">' . "\r\n";
echo htmlentities($content_data);
echo '</textarea>' . "\r\n";

echo '<script src="../../templates/default/plugins/codemirror/lib/codemirror.js"></script>' . "\r\n";
echo '<script src="../../templates/default/plugins/codemirror/mode/xml/xml.js"></script>' . "\r\n";
echo '<script src="../../templates/default/plugins/codemirror/mode/javascript/javascript.js"></script>' . "\r\n";
echo '<script src="../../templates/default/plugins/codemirror/mode/php/php.js"></script>' . "\r\n";
echo '<script src="../../templates/default/plugins/codemirror/mode/markdown/markdown.js"></script>' . "\r\n";
echo '<script src="../../templates/default/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>' . "\r\n";
echo '<script src="../../templates/default/plugins/codemirror/mode/css/css.js"></script>' . "\r\n";
echo '<script src="../../templates/default/plugins/codemirror/mode/clike/clike.js"></script>' . "\r\n";
echo '<script src="../../templates/default/plugins/codemirror/addon/edit/continuelist.js"></script>' . "\r\n";
echo '<script src="../../templates/default/plugins/codemirror/addon/display/fullscreen.js"></script>' . "\r\n";
echo '<script src="../../templates/default/plugins/codemirror/addon/edit/matchbrackets.js"></script>' . "\r\n";


echo '<script>' . "\r\n";
switch ($content_type)
{
    case 'js':
        echo '
                var editor = CodeMirror.fromTextArea(document.getElementById("code"),{
                    mode:"javascript",
                    lineNumbers: true, 
                    theme:"' . $theme . '",
                    fullScreen: true,
                 });
            ';
        break;
    case 'markdown':
        echo '
                var editor = CodeMirror.fromTextArea(document.getElementById("code"),{
                    mode:"markdown",
                    lineNumbers: true, 
                    theme:"' . $theme . '",
                    fullScreen: true,
                 });
            ';
        break;
    case 'php':
        echo '
            var editor = CodeMirror.fromTextArea(document.getElementById("code"),{
                mode: "application/x-httpd-php",
                lineNumbers: true, 
                matchBrackets: true,
                indentUnit: 4,
                theme:"' . $theme . '",
                indentWithTabs: true,
                fullScreen: true
            });';
        break;
}

echo '</script>' . "\r\n";
echo '</body>' . "\r\n";
echo '</html>' . "\r\n";

?>