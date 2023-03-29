<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 */
 
 
//error_reporting(0);
session_start();
define('IHS_EXEC', true);
require '../../system/class/ihs.string.php';
ini_set("highlight.comment", "#008000");
ini_set("highlight.default", "#5967ff");
ini_set("highlight.html", "#808080");
ini_set("highlight.keyword", "#c080ff;");
ini_set("highlight.string", "#ff8000");
$string = new StringConvert();
$theme = 'liquibyte';
require_once '../../config.php';
$html_tags = $content_data = $content_title = null;
if (isset($_SESSION['CURRENT_PROJECT_PREFIX']))
{
    $current_project = $_SESSION['CURRENT_PROJECT_DATA'];
    $prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
    $short_name = $current_project['project']['short-name'];
    $plugin_name = $current_project['project']['project-name'];
    $plugin_dir = IHS_WORDPRESS_ROOT . '/wp-content/plugins/' . $prefix;

    $config_php = null;
    $config_php .= '<?php #configuration' . "\r\n";
    $config_php .= "" . '' . "\r\n";
    $config_php .= "" . '' . "\r\n";
    $config_php .= "" . '/**' . "\r\n";
    $config_php .= "" . ' * Debug' . "\r\n";
    $config_php .= "" . '**/' . "\r\n";
    $config_php .= "" . 'if (!defined("' . strtoupper($short_name) . '_DEBUG")){' . "\r\n";
    $config_php .= "\t" . 'define("' . strtoupper($short_name) . '_DEBUG",false);' . "\r\n";
    $config_php .= "" . '}' . "\r\n";
    $config_php .= "" . '' . "\r\n";
    $config_php .= "" . '' . "\r\n";
    $config_php .= "" . '/**' . "\r\n";
    $config_php .= "" . ' * Theme File' . "\r\n";
    $config_php .= "" . '**/' . "\r\n";
    $config_php .= "" . 'if (!defined("' . strtoupper($short_name) . '_FILE")){' . "\r\n";
    $config_php .= "\t" . 'define("' . strtoupper($short_name) . '_FILE",__FILE__);' . "\r\n";
    $config_php .= "" . '}' . "\r\n";
    $config_php .= "" . '' . "\r\n";
    $config_php .= "" . '/**' . "\r\n";
    $config_php .= "" . ' * Theme Path' . "\r\n";
    $config_php .= "" . '**/' . "\r\n";
    $config_php .= "" . 'if (!defined("' . strtoupper($short_name) . '_PATH")){' . "\r\n";
    $config_php .= "\t" . 'define("' . strtoupper($short_name) . '_PATH",dirname(__FILE__));' . "\r\n";
    $config_php .= "" . '}' . "\r\n";
    $config_php .= "" . '' . "\r\n";
    $config_php .= "" . '/**' . "\r\n";
    $config_php .= "" . ' * Assets URL' . "\r\n";
    $config_php .= "" . '**/' . "\r\n";
    $config_php .= "" . 'if (!defined("' . strtoupper($short_name) . '_URL")){' . "\r\n";
    $config_php .= "\t" . 'define("' . strtoupper($short_name) . '_URL",get_template_directory_uri());' . "\r\n";
    $config_php .= "" . '}' . "\r\n";
    $config_php .= "" . '//EOF' . "\r\n";


    switch ($_GET['f'])
    {
        case 'imageSizes':
            $content_title = 'Additional Image Sizes';
            $html_tags .= '<ol>';
            $html_tags .= '<li>To avoid duplicate functions, you should deactivate the <strong>' . $plugin_name . '</strong> plugin in your WordPress Live Test.</li>';
            $html_tags .= '<li>';
            $html_tags .= '<p>Copy the class code below into <strong>functions.php</strong> file.</p>';
            if (file_exists($plugin_dir . '/incl/image-sizes.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/image-sizes.php');
                $html_tags .= parseCode($content_data, 'die("Silent is golden");', '//EOF');
            }
            $html_tags .= '<p>and create an instance of that class</p>';
            $html_tags .= parseCode('<?php #instance' . "\r\n" . ' $image_size = new ' . $string->toClassName($short_name) . 'ImageSizes(); ?>', '<?php', '?>');
            $html_tags .= '<br/>';
            $html_tags .= '</li>';
            $html_tags .= '<li>Done!</li>';
            $html_tags .= '</ol>';
            break;
        case 'roles':
            $content_title = 'Roles and Capabilities';
            $html_tags .= '<ol>';
            $html_tags .= '<li>To avoid duplicate functions, you should deactivate the <strong>' . $plugin_name . '</strong> plugin in your WordPress Live Test.</li>';
            $html_tags .= '<li>';
            $html_tags .= '<p>Copy the class code below into <strong>functions.php</strong> file.</p>';
            if (file_exists($plugin_dir . '/incl/roles.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/roles.php');
                $content_data = str_replace('register_activation_hook(' . strtoupper($short_name) . '_FILE', 'add_action("after_setup_theme"', $content_data);
                $content_data = str_replace('register_deactivation_hook(' . strtoupper($short_name) . '_FILE', 'add_action("switch_theme"', $content_data);
                $html_tags .= parseCode($content_data, 'die("Silent is golden");', '//EOF');
            }
            $html_tags .= '<p>and create an instance of that class</p>';
            $html_tags .= parseCode('<?php #instance' . "\r\n" . ' $roles = new ' . $string->toClassName($short_name) . 'Roles(); ?>', '<?php', '?>');
            $html_tags .= '<br/>';
            $html_tags .= '</li>';
            $html_tags .= '<li>Done!</li>';
            $html_tags .= '</ol>';
            break;
        case 'taxonomies':
            $content_title = 'Taxonomies';
            $html_tags .= '<ol>';
            $html_tags .= '<li>To avoid duplicate functions, you should deactivate the <strong>' . $plugin_name . '</strong> plugin in your WordPress Live Test.</li>';
            $html_tags .= '<li>';
            $html_tags .= '<p>Copy the class code below into <strong>functions.php</strong> file.</p>';
            if (file_exists($plugin_dir . '/incl/taxonomies.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/taxonomies.php');
                $html_tags .= parseCode($content_data, 'die("Silent is golden");', '//EOF');
            }
            $html_tags .= '<p>and create an instance of that class</p>';
            $html_tags .= parseCode('<?php #instance' . "\r\n" . ' $taxonomies = new ' . $string->toClassName($short_name) . 'Taxonomies(); ?>', '<?php', '?>');
            $html_tags .= '<br/>';
            $html_tags .= '</li>';
            $html_tags .= '<li>Done!</li>';
            $html_tags .= '</ol>';
            break;
        case 'extraFields':
            $content_title = 'Extra Fields';
            $html_tags .= '<ol>';
            $html_tags .= '<li>To avoid duplicate functions, you should deactivate the <strong>' . $plugin_name . '</strong> plugin in your WordPress Live Test.</li>';
            $html_tags .= '<li>';
            $html_tags .= '<p>Copy this configuration code into <strong>functions.php</strong> file.</p>';
            $html_tags .= parseCode($config_php, '<?php ', '//EOF');
            $html_tags .= '<p>also copy the class that will be used</p>';
            if (file_exists($plugin_dir . '/incl/extra-fields.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/extra-fields.php');
                $html_tags .= parseCode($content_data, 'die("Silent is golden");', '//EOF');
            }
            $html_tags .= '<p>and create an instance of that class</p>';
            $html_tags .= parseCode('<?php #instance' . "\r\n" . ' $extra_fields = new ' . $string->toClassName($short_name) . 'ExtraFields(); ?>', '<?php', '?>');
            $html_tags .= '<br/>';
            $html_tags .= '</li>';
            $html_tags .= '<li>Done!</li>';
            $html_tags .= '</ol>';
            break;
        case 'customPosts':
            $content_title = 'Custom Posts';
            $html_tags .= '<ol>';
            $html_tags .= '<li>To avoid duplicate functions, you should deactivate the <strong>' . $plugin_name . '</strong> plugin in your WordPress Live Test.</li>';
            $html_tags .= '<li>';
            $html_tags .= '<p>Copy the class code below into <strong>functions.php</strong> file.</p>';
            if (file_exists($plugin_dir . '/incl/custom-posts.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/custom-posts.php');
                $html_tags .= parseCode($content_data, 'die("Silent is golden");', '//EOF');
            }
            $html_tags .= '<p>and create an instance of that class</p>';
            $html_tags .= parseCode('<?php #instance' . "\r\n" . ' $custom_posts = new ' . $string->toClassName($short_name) . 'CustomPosts(); ?>', '<?php', '?>');
            $html_tags .= '<br/>';
            $html_tags .= '</li>';
            $html_tags .= '<li>Done!</li>';
            $html_tags .= '</ol>';
            break;
        case 'metaBoxes':
            $content_title = 'Meta Boxes and Custom Fields';
            $html_tags .= '<ol>';
            $html_tags .= '<li>To avoid duplicate functions, you should deactivate the <strong>' . $plugin_name . '</strong> plugin in your WordPress Live Test.</li>';
            $html_tags .= '<li>';
            $html_tags .= '<p>Copy this configuration code into <strong>functions.php</strong> file.</p>';
            $html_tags .= parseCode($config_php, '<?php ', '//EOF');
            $html_tags .= '<p>also copy the class that will be used</p>';
            if (file_exists($plugin_dir . '/incl/meta-boxes.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/meta-boxes.php');
                $html_tags .= parseCode($content_data, 'die("Silent is golden");', '//EOF');
            }
            $html_tags .= '<p>and create an instance of that class</p>';
            $html_tags .= parseCode('<?php #instance' . "\r\n" . ' $meta_boxes = new ' . $string->toClassName($short_name) . 'MetaBoxes(); ?>', '<?php', '?>');
            $html_tags .= '<br/>';
            $html_tags .= '</li>';
            $html_tags .= '<li>Done!</li>';
            $html_tags .= '</ol>';
            break;
        case 'shortCodes':
            $content_title = 'Short Codes and TinyMCE plugin';
            $html_tags .= '<ol>';
            $html_tags .= '<li>To avoid duplicate functions, you should deactivate the <strong>' . $plugin_name . '</strong> plugin in your WordPress Live Test.</li>';
            $html_tags .= '<li>';
            $html_tags .= '<p>Copy this configuration code into <strong>functions.php</strong> file.</p>';

            $html_tags .= parseCode($config_php, '<?php ', '//EOF');
            $html_tags .= '<p>also copy the class that will be used</p>';
            if (file_exists($plugin_dir . '/incl/short-codes.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/short-codes.php');
                $html_tags .= parseCode($content_data, 'die("Silent is golden");', '//EOF');
            }
            $html_tags .= '<p>and create an instance of that class</p>';
            $html_tags .= parseCode('<?php #instance' . "\r\n" . ' $short_codes = new ' . $string->toClassName($short_name) . 'ShortCodes(); ?>', '<?php', '?>');
            $html_tags .= '<br/>';
            $html_tags .= '</li>';
            $html_tags .= '<li>';
            $html_tags .= '<p>Create or copy the javascripts code below using the filename:</p>';
            if (isset($current_project['short-codes']))
            {
                if (is_array($current_project['short-codes']))
                {
                    foreach ($current_project['short-codes'] as $short_codes)
                    {
                        $path_js = ($plugin_dir . '/assets/tinymce-plugins/' . $string->toVar($short_name . '-' . $short_codes['name']) . '/' . $string->toVar($short_name . '-' . $short_codes['name']) . '.js');
                        if (file_exists($path_js))
                        {
                            $html_tags .= '<p><strong>/assets/tinymce-plugins/' . $string->toVar($short_name . '-' . $short_codes['name']) . '/' . $string->toVar($short_name . '-' . $short_codes['name']) . '.js</strong></p>';
                            $content_data = file_get_contents($path_js);
                            $html_tags .= '<div style="padding:12px;border: 1px solid #ddd;background:#000000;">';
                            $html_tags .= highlight_string($content_data, true);
                            $html_tags .= '</div>';
                        }
                    }
                }
            }
            $html_tags .= '</li>';
            $html_tags .= '<li>';
            $html_tags .= '<p>Create or copy the styles code below using the filename:</p>';
            if (isset($current_project['short-codes']))
            {
                if (is_array($current_project['short-codes']))
                {
                    foreach ($current_project['short-codes'] as $short_codes)
                    {
                        $path_js = ($plugin_dir . '/assets/tinymce-plugins/' . $string->toVar($short_name . '-' . $short_codes['name']) . '/' . $string->toVar($short_name . '-' . $short_codes['name']) . '.css');
                        if (file_exists($path_js))
                        {
                            $html_tags .= '<p><strong>/assets/tinymce-plugins/' . $string->toVar($short_name . '-' . $short_codes['name']) . '/' . $string->toVar($short_name . '-' . $short_codes['name']) . '.css</strong></p>';
                            $content_data = file_get_contents($path_js);
                            $html_tags .= '<div style="padding:12px;border: 1px solid #ddd;background:#000000;">';
                            $html_tags .= highlight_string($content_data, true);
                            $html_tags .= '</div>';
                        }
                    }
                }
            }
            $html_tags .= '<br/>';
            $html_tags .= '</li>';
            $html_tags .= '<li>Done!</li>';
            $html_tags .= '</ol>';
            break;


        case 'enqueueScripts':
            $content_title = 'Enqueue Scripts';
            $html_tags .= '<ol>';
            $html_tags .= '<li>To avoid duplicate functions, you should deactivate the <strong>' . $plugin_name . '</strong> plugin in your WordPress Live Test.</li>';
            $html_tags .= '<li>';
            $html_tags .= '<p>Copy this configuration code into <strong>functions.php</strong> file.</p>';
            $html_tags .= parseCode($config_php, '<?php ', '//EOF');
            $html_tags .= '<p>also copy the class that will be used</p>';
            if (file_exists($plugin_dir . '/incl/enqueue-scripts.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/enqueue-scripts.php');
                $html_tags .= parseCode($content_data, 'die("Silent is golden");', '//EOF');
            }
            $html_tags .= '<p>and create an instance of that class</p>';
            $html_tags .= parseCode('<?php #instance' . "\r\n" . ' $enqueue_js = new ' . $string->toClassName($short_name) . 'EnqueueScripts(); ?>', '<?php', '?>');
            $html_tags .= '<br/>';
            $html_tags .= '</li>';
            $html_tags .= '<li>Done!</li>';
            $html_tags .= '</ol>';
            break;

        case 'enqueueStyles':
            $content_title = 'Enqueue Styles';
            $html_tags .= '<ol>';
            $html_tags .= '<li>To avoid duplicate functions, you should deactivate the <strong>' . $plugin_name . '</strong> plugin in your WordPress Live Test.</li>';
            $html_tags .= '<li>';
            $html_tags .= '<p>Copy this configuration code into <strong>functions.php</strong> file.</p>';
            $html_tags .= parseCode($config_php, '<?php ', '//EOF');
            $html_tags .= '<p>also copy the class that will be used</p>';
            if (file_exists($plugin_dir . '/incl/enqueue-styles.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/enqueue-styles.php');
                $html_tags .= parseCode($content_data, 'die("Silent is golden");', '//EOF');
            }
            $html_tags .= '<p>and create an instance of that class</p>';
            $html_tags .= parseCode('<?php #instance' . "\r\n" . ' $enqueue_css = new ' . $string->toClassName($short_name) . 'EnqueueStyles(); ?>', '<?php', '?>');
            $html_tags .= '<br/>';
            $html_tags .= '</li>';
            $html_tags .= '<li>Done!</li>';
            $html_tags .= '</ol>';
            break;

        case 'widgets':
            $content_title = 'Legacy Widgets';
            $html_tags .= '<ol>';
            $html_tags .= '<li>To avoid duplicate functions, you should deactivate the <strong>' . $plugin_name . '</strong> plugin in your WordPress Live Test.</li>';
            $html_tags .= '<li>';
            $html_tags .= '<p>Copy this configuration code into <strong>functions.php</strong> file.</p>';
            $html_tags .= parseCode($config_php, '<?php ', '//EOF');
            $html_tags .= '<p>also copy the class that will be used</p>';
            if (isset($current_project['widgets']))
            {
                if (is_array($current_project['widgets']))
                {
                    foreach ($current_project['widgets'] as $widget)
                    {
                        $html_tags .= '<h4>' . $widget['title'] . ' Class</h4>';
                        $widget_file = ($plugin_dir . '/incl/widgets/' . $string->toFileName($widget['name']) . '.php');
                        if (file_exists($widget_file))
                        {
                            $content_data = file_get_contents($widget_file);
                            $html_tags .= parseCode($content_data, 'die("Silent is golden");', '//EOF');
                        }


                    }
                }
            }

            $html_tags .= '<p>then register the widget</p>';
            if (file_exists($plugin_dir . '/incl/widgets.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/widgets.php');
                $html_tags .= parseCode($content_data, 'die("Silent is golden");', '//EOF');
            }
            $html_tags .= '<p>and create an instance of that class</p>';
            $html_tags .= parseCode('<?php #instance' . "\r\n" . ' $widgets = new ' . $string->toClassName($short_name) . 'Widgets(); ?>', '<?php', '?>');
            $html_tags .= '<br/>';
            $html_tags .= '</li>';
            $html_tags .= '<li>Done!</li>';
            $html_tags .= '</ol>';
            break;

        case 'contents':
            $content_title = 'Contents';
            $html_tags .= '<ol>';
            $html_tags .= '<li>To avoid duplicate functions, you should deactivate the <strong>' . $plugin_name . '</strong> plugin in your WordPress Live Test.</li>';
            $html_tags .= '<li>';
            $html_tags .= '<p>Copy this configuration code into <strong>functions.php</strong> file.</p>';
            $html_tags .= parseCode($config_php, '<?php ', '//EOF');
            $html_tags .= '<p>also copy the class that will be used</p>';
            if (isset($current_project['content']))
            {
                if (is_array($current_project['content']))
                {
                    foreach ($current_project['content'] as $content)
                    {
                        $className = $string->toClassName($short_name . ' ' . $content['name']);
                        $html_tags .= '<h4>' . ($content['name']) . ' Class</h4>';
                        $content_file = ($plugin_dir . '/incl/contents/' . $string->toFileName($content['name']) . '.php');
                        if (file_exists($content_file))
                        {
                            $content_data = file_get_contents($content_file);
                            $html_tags .= parseCode($content_data, 'die("Silent is golden");', '//EOF');

                            $html_tags .= '<p>and create an instance of that class</p>';
                            $html_tags .= parseCode('<?php #instance' . "\r\n" . ' $content = new ' . $className . 'TheContent(); ?>', '<?php', '?>');
                            $html_tags .= '<br/><br/><hr>';
                        }
                    }
                }
            }
            $html_tags .= '<br/>';
            $html_tags .= '</li>';
            $html_tags .= '<li>Done!</li>';
            $html_tags .= '</ol>';
            break;

        case 'pluginOptions':
            $content_title = 'Plugin Options';
            $html_tags .= '<ol>';
            $html_tags .= '<li>To avoid duplicate functions, you should deactivate the <strong>' . $plugin_name . '</strong> plugin in your WordPress Live Test.</li>';
            $html_tags .= '<li>';
            $html_tags .= '<p>Copy this configuration code into <strong>functions.php</strong> file.</p>';
            $html_tags .= parseCode($config_php, '<?php ', '//EOF');
            $html_tags .= '<p>also copy the class that will be used</p>';
            if (file_exists($plugin_dir . '/incl/plugin-options.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/plugin-options.php');
                $html_tags .= parseCode($content_data, 'die("Silent is golden");', '//EOF');
            }
            $html_tags .= '<p>and create an instance of that class</p>';
            $html_tags .= parseCode('<?php #instance' . "\r\n" . ' $plugin_options = new ' . $string->toClassName($short_name) . 'PluginOptions(); ?>', '<?php', '?>');
            $html_tags .= '<br/>';
            $html_tags .= '</li>';
            $html_tags .= '<li>Done!</li>';
            $html_tags .= '</ol>';
            break;
        case 'adminBars':
            $content_title = 'Admin Bars';
            $html_tags .= '<ol>';
            $html_tags .= '<li>To avoid duplicate functions, you should deactivate the <strong>' . $plugin_name . '</strong> plugin in your WordPress Live Test.</li>';
            $html_tags .= '<li>';
            $html_tags .= '<p>Copy the class code below into <strong>functions.php</strong> file.</p>';
            if (file_exists($plugin_dir . '/incl/admin-bars.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/admin-bars.php');
                $html_tags .= parseCode($content_data, 'die("Silent is golden");', '//EOF');
            }
            $html_tags .= '<p>and create an instance of that class</p>';
            $html_tags .= parseCode('<?php #instance' . "\r\n" . ' $admin_bars = new ' . $string->toClassName($short_name) . 'AdminBars(); ?>', '<?php', '?>');
            $html_tags .= '<br/>';
            $html_tags .= '</li>';
            $html_tags .= '<li>Done!</li>';
            $html_tags .= '</ol>';
            break;


        case 'adminPages':
            $content_title = 'Admin Pages';
            $html_tags .= '<ol>';
            $html_tags .= '<li>To avoid duplicate functions, you should deactivate the <strong>' . $plugin_name . '</strong> plugin in your WordPress Live Test.</li>';
            $html_tags .= '<li>';
            $html_tags .= '<p>Copy this configuration code into <strong>functions.php</strong> file.</p>';
            $html_tags .= parseCode($config_php, '<?php ', '//EOF');
            $html_tags .= '<p>also copy the class that will be used</p>';
            if (isset($current_project['admin-pages']))
            {
                if (is_array($current_project['admin-pages']))
                {
                    foreach ($current_project['admin-pages'] as $admin_page)
                    {
                        $className = $string->toClassName($short_name . ' ' . $admin_page['name']);
                        $html_tags .= '<h4>' . ($admin_page['name']) . ' Class</h4>';
                        $admin_file = ($plugin_dir . '/incl/admin-pages/' . $string->toFileName($admin_page['name']) . '.php');
                        if (file_exists($admin_file))
                        {
                            $content_data = file_get_contents($admin_file);
                            $html_tags .= parseCode($content_data, 'die("Silent is golden");', '//EOF');

                            $html_tags .= '<p>and create an instance of that class</p>';
                            $html_tags .= parseCode('<?php #instance' . "\r\n" . ' $admin_pages = new ' . $className . 'AdminPage(); ?>', '<?php', '?>');
                            $html_tags .= '<br/><br/><hr>';
                        }
                    }
                }
            }
            $html_tags .= '<br/>';
            $html_tags .= '</li>';
            $html_tags .= '<li>Done!</li>';
            $html_tags .= '</ol>';
            break;

        case 'adminNotices':
            $content_title = 'Admin Notices';
            $html_tags .= '<ol>';
            $html_tags .= '<li>To avoid duplicate functions, you should deactivate the <strong>' . $plugin_name . '</strong> plugin in your WordPress Live Test.</li>';
            $html_tags .= '<li>';
            $html_tags .= '<p>Copy this configuration code into <strong>functions.php</strong> file.</p>';
            $html_tags .= parseCode($config_php, '<?php ', '//EOF');
            $html_tags .= '<p>also copy the class that will be used</p>';
            if (file_exists($plugin_dir . '/incl/admin-notices.php'))
            {
                $content_data = file_get_contents($plugin_dir . '/incl/admin-notices.php');
                $html_tags .= parseCode($content_data, 'die("Silent is golden");', '//EOF');
            }
            $html_tags .= '<p>and create an instance of that class</p>';
            $html_tags .= parseCode('<?php #instance' . "\r\n" . ' $admin_notices = new ' . $string->toClassName($short_name) . 'AdminNotices(); ?>', '<?php', '?>');
            $html_tags .= '<br/>';
            $html_tags .= '</li>';
            $html_tags .= '<li>Done!</li>';
            $html_tags .= '</ol>';
            break;

        case 'ajaxRequests':
            $content_title = 'Ajax Requests';
            $html_tags .= '<ol>';
            $html_tags .= '<li>To avoid duplicate functions, you should deactivate the <strong>' . $plugin_name . '</strong> plugin in your WordPress Live Test.</li>';
            $html_tags .= '<li>';
            $html_tags .= '<p>Copy this configuration code into <strong>functions.php</strong> file.</p>';
            $html_tags .= parseCode($config_php, '<?php ', '//EOF');
            $html_tags .= '<p>also copy the class that will be used</p>';
            if (isset($current_project['ajax-requests']))
            {
                if (is_array($current_project['ajax-requests']))
                {
                    foreach ($current_project['ajax-requests'] as $ajax_request)
                    {
                        $className = $string->toClassName($short_name . ' ' . $ajax_request['name']);
                        $html_tags .= '<h4>' . ($ajax_request['name']) . ' Class</h4>';
                        $admin_file = ($plugin_dir . '/incl/ajax/' . $string->toFileName($ajax_request['name']) . '.php');
                        if (file_exists($admin_file))
                        {
                            $content_data = file_get_contents($admin_file);
                            $html_tags .= parseCode($content_data, 'die("Silent is golden");', '//EOF');

                            $html_tags .= '<p>and create an instance of that class</p>';
                            $html_tags .= parseCode('<?php #instance' . "\r\n" . ' $ajax = new ' . $className . 'Ajax(); ?>', '<?php', '?>');
                            $html_tags .= '<br/><br/><hr>';
                        }
                    }
                }
            }
            $html_tags .= '<br/>';
            $html_tags .= '</li>';


            $html_tags .= '<li>Ajax Request also creates code: Custom Posts, Meta Boxes, Short Codes and Enqueue Scripts , please check that too.</li>';
            $html_tags .= '<li>Done!</li>';
            $html_tags .= '</ol>';
            break;


        case 'wooSettings':
            $content_title = 'WooCommerce Settings';
            $html_tags .= '<ol>';
            $html_tags .= '<li>To avoid duplicate functions, you should deactivate the <strong>' . $plugin_name . '</strong> plugin in your WordPress Live Test.</li>';
            $html_tags .= '<li>';
            $html_tags .= '<p>Copy this configuration code into <strong>functions.php</strong> file.</p>';
            $html_tags .= parseCode($config_php, '<?php ', '//EOF');
            $html_tags .= '<p>also copy the class that will be used</p>';
            if (isset($current_project['woo-settings']))
            {
                if (is_array($current_project['woo-settings']))
                {
                    foreach ($current_project['woo-settings'] as $woo_setting)
                    {
                        $className = $string->toClassName($woo_setting['name']);
                        $html_tags .= '<h4>' . ($woo_setting['name']) . ' Class</h4>';
                        $admin_file = ($plugin_dir . '/incl/woo-settings/' . $string->toFileName($woo_setting['name']) . '.php');
                        if (file_exists($admin_file))
                        {
                            $content_data = file_get_contents($admin_file);
                            $html_tags .= parseCode($content_data, 'die("Silent is golden");', '//EOF');

                            $html_tags .= '<p>and create an instance of that class</p>';
                            $html_tags .= parseCode('<?php #instance' . "\r\n" . ' $woo_setting = new ' . $className . 'WooSetting(); ?>', '<?php', '?>');
                            $html_tags .= '<br/><br/><hr>';
                        }
                    }
                }
            }
            $html_tags .= '<br/>';
            $html_tags .= '</li>';


            $html_tags .= '<li>Done!</li>';
            $html_tags .= '</ol>';
            break;
            
            
        case 'wooCheckoutFields':
            $content_title = 'WooCommerce Checkout Fields';
            $html_tags .= '<ol>';
            $html_tags .= '<li>To avoid duplicate functions, you should deactivate the <strong>' . $plugin_name . '</strong> plugin in your WordPress Live Test.</li>';
            $html_tags .= '<li>';
            $html_tags .= '<p>Copy this configuration code into <strong>functions.php</strong> file.</p>';
            $html_tags .= parseCode($config_php, '<?php ', '//EOF');
            $html_tags .= '<p>also copy the class that will be used</p>';
            if (isset($current_project['woo-checkout-fields']))
            {
                if (is_array($current_project['woo-checkout-fields']))
                {
                    foreach ($current_project['woo-checkout-fields'] as $woo_checkout_field)
                    {
                        $className = $string->toClassName($woo_checkout_field['name']);
                        $html_tags .= '<h4>' . ($woo_checkout_field['name']) . ' Class</h4>';
                        $admin_file = ($plugin_dir . '/incl/woo-checkout-fields/' . $string->toFileName($woo_checkout_field['name']) . '.php');
                        if (file_exists($admin_file))
                        {
                            $content_data = file_get_contents($admin_file);
                            $html_tags .= parseCode($content_data, 'die("Silent is golden");', '//EOF');

                            $html_tags .= '<p>and create an instance of that class</p>';
                            $html_tags .= parseCode('<?php #instance' . "\r\n" . ' $woo_checkouts = new ' . $className . 'WooCheckoutField(); ?>', '<?php', '?>');
                            $html_tags .= '<br/><br/><hr>';
                        }
                    }
                }
            }
            $html_tags .= '<br/>';
            $html_tags .= '</li>';


            $html_tags .= '<li>Done!</li>';
            $html_tags .= '</ol>';
            break;
        case 'wpbakeryPageBuilders':
            $content_title = 'WordPress Bakery Page Builders';
            $html_tags .= '<ol>';
            $html_tags .= '<li>To avoid duplicate functions, you should deactivate the <strong>' . $plugin_name . '</strong> plugin in your WordPress Live Test.</li>';
            $html_tags .= '<li>';
            $html_tags .= '<p>Copy this configuration code into <strong>functions.php</strong> file.</p>';
            $html_tags .= parseCode($config_php, '<?php ', '//EOF');
            $html_tags .= '<p>also copy the class that will be used</p>';
            if (isset($current_project['wpbakery-page-builders']))
            {
                if (is_array($current_project['wpbakery-page-builders']))
                {
                    foreach ($current_project['wpbakery-page-builders'] as $woo_checkout_field)
                    {
                        $className = $string->toClassName($short_name .' Visual Composer ' . $woo_checkout_field['name']);
                        $html_tags .= '<h4>' . ($woo_checkout_field['name']) . ' Class</h4>';
                        $admin_file = ($plugin_dir . '/incl/wpbakery-page-builders/' . $string->toFileName($woo_checkout_field['name']) . '.php');
                        if (file_exists($admin_file))
                        {
                            $content_data = file_get_contents($admin_file);
                            $html_tags .= parseCode($content_data, 'die("Silent is golden");', '//EOF');

                            $html_tags .= '<p>and create an instance of that class</p>';
                            $html_tags .= parseCode('<?php #instance' . "\r\n" . ' $vc_code = new ' . $className . '(); ?>', '<?php', '?>');
                            $html_tags .= '<br/><br/><hr>';
                        }
                    }
                }
            }
            $html_tags .= '<br/>';
            $html_tags .= '</li>';


            $html_tags .= '<li>Done!</li>';
            $html_tags .= '</ol>';
            break;

    }
}
echo '<!DOCTYPE HTML>' . "\r\n";
echo '<html>' . "\r\n";
echo '<head>' . "\r\n";
echo '<meta http-equiv="content-type" content="text/html" />' . "\r\n";
echo '<meta charset="utf-8"/>' . "\r\n";
echo '<title>Theme Functions | ' . $content_title . '</title>' . "\r\n";
echo '<style type="text/css">' . "\r\n";
echo 'body{background: #000;color: #fff;font-family: tahoma;}' . "\r\n";
echo '.container{padding: 30px;margin: 30px; background: #333;}' . "\r\n";
echo '</style>' . "\r\n";
echo '</head>' . "\r\n";
echo '<body>' . "\r\n";
echo '<div class="container">';
echo '<h4>Custom Theme Functions</h4>';
echo '<h1>' . $content_title . '</h1>';
echo $html_tags;
echo '</div>';
echo '</body>' . "\r\n";
echo '</html>' . "\r\n";
function parseCode($code, $start = 'class', $end = '?>')
{
    $fix_code = explode($start, $code);
    if (isset($fix_code[1]))
    {
        $new_code = explode($end, $fix_code[1]);
    } else
    {
        $new_code[0] = '';
    }
    $code = '<div style="padding:12px;border: 1px solid #ddd;background:#000000;">';
    $code .= str_replace("&lt;?php&nbsp;</span><span style=\"color: #008000\">//sof;", '', highlight_string("<?php //sof;" . $new_code[0], true));
    $code .= '</div>';
    return $code;
}

?>