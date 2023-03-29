<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2022
 * @package WP-Dev Tools
 * @license Commercial License
 */


error_reporting(0); //remove this code for debug

session_start();

define('IHS_EXEC', true);
header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$servers[] = array('value' => 'https://ihsana.com', 'label' => 'ihsana.com');

if (file_exists("version.txt"))
{
    $version = file_get_contents("version.txt");
    define('JSM_VERSION', $version);
} else
{
    define('JSM_VERSION', '00.00.00');
}

unset($_SESSION['CURRENT_PROJECT_PREFIX']);
unset($_SESSION['CURRENT_PROJECT_DATA']);
if (!isset($_GET['step']))
{
    $_GET['step'] = '1';
    header("Location: ./setup.php?step=1");
}
if (!isset($_SESSION['IHS_WORDPRESS_ROOT']))
{
    $_SESSION['IHS_WORDPRESS_ROOT'] = __dir__ . '/wp-test/';
}
if (!isset($_SESSION['IHS_CODEMIRROR_THEME']))
{
    $_SESSION['IHS_CODEMIRROR_THEME'] = 'darcula';
}
if (!isset($_SESSION['IHS_PURCHASE_CODE']))
{
    $_SESSION['IHS_PURCHASE_CODE'] = '';
}
if (!isset($_SESSION['IHS_EMAIL_ADDRESS']))
{
    $_SESSION['IHS_EMAIL_ADDRESS'] = '';
}
if (!isset($_SESSION['IHS_ACTIVATION_CODE']))
{
    $_SESSION['IHS_ACTIVATION_CODE'] = '';
}
$content_tags = null;
// TODO: STEP 1
switch ($_GET['step'])
{
    case '1':
        session_destroy();
        if (!file_exists('wp-test'))
        {
            mkdir('wp-test', 0777, true);
        }

        $title = 'Step 1 ~ <small>System Requirements</small>';
        $persen = 33;
        $is_disabled = false;
        $content_tags .= '<form class="form-horizontal" action="?step=1" method="post">';
        $content_tags .= '<div class="row">';
        $content_tags .= '<div class="col-md-12">';
        $content_tags .= '<div class="card card-outline card-primary">';
        $content_tags .= '<div class="card-header">';
        $content_tags .= '<h3 class="card-title">';
        $content_tags .= '<i class="fas fa-database"></i>&nbsp;';
        $content_tags .= '' . __e("Checking Your Server") . '';
        $content_tags .= '</h3>'; //card-title
        $content_tags .= '<div class="card-tools">';
        $content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
        $content_tags .= '</button>';
        $content_tags .= '</div>'; //card-tools
        $content_tags .= '</div>'; //card-header
        $content_tags .= '<div class="card-body">';
        $content_tags .= '<p>' . __e("Please check the following system requirements:") . '</p>';
        $content_tags .= '<table class="table table-bordered table-striped">';
        $content_tags .= '<thead>';
        $content_tags .= '<tr>';
        $content_tags .= '<th>' . __e("Used For") . '</th>';
        $content_tags .= '<th>' . __e("Function") . '</th>';
        $content_tags .= '<th>' . __e("Status") . '</th>';
        $content_tags .= '</tr>';
        $content_tags .= '</thead>';
        $content_tags .= '<tbody>';


        $content_tags .= '<tr>';
        $content_tags .= '<td>PHP-GD extensions</td>';
        $content_tags .= '<td><code>Edit the image size</code><pre>gd_info, getimagesize, etc</pre></td>';
        if (function_exists('gd_info'))
        {
            $content_tags .= '<td><span class="badge badge-success">OK</span></td>' . "\r\n";
        } else
        {
            $content_tags .= '<td><span class="badge badge-danger">failed</span></td>';
        }
        $content_tags .= '</tr>';


        $content_tags .= '<tr>';
        $content_tags .= '<td>Write a file to <strong>root</strong> directory</td>';
        $content_tags .= '<td><code>WRITE: root/test.file</code><pre>Filesystem: fwrite, file_get_contents, etc</pre></td>';
        file_put_contents('test.file', 'test');
        if (file_exists('test.file'))
        {
            $content_tags .= '<td><span class="badge badge-success">OK</span></td>' . "\r\n";
        } else
        {
            $content_tags .= '<td><span class="badge badge-danger">failed</span></td>';
            $is_disabled = true;
        }
        $content_tags .= '</tr>';


        $content_tags .= '<tr>';
        $content_tags .= '<td>Write a file to <strong>class</strong> directory</td>';
        $content_tags .= '<td><code>WRITE: root/system/class/test.file</code><pre>Filesystem: fwrite, file_get_contents, etc</pre></td>';
        file_put_contents('system/class/test.file', 'test');
        if (file_exists('system/class/test.file'))
        {
            $content_tags .= '<td><span class="badge badge-success">OK</span></td>' . "\r\n";
        } else
        {
            $content_tags .= '<td><span class="badge badge-danger">failed</span></td>';
            $is_disabled = true;
        }
        $content_tags .= '</tr>';
        $content_tags .= '<tr>';
        $content_tags .= '<td>Make <strong>projects</strong> directory</td>';
        $content_tags .= '<td><code>MD: root/projects/test/folder/</code><pre>Filesystem: mkdir</pre></td>';

        mkdir('projects/test/folder/', 0777, true);

        if (file_exists('projects/test/folder/'))
        {
            if (is_dir('projects/test/folder/'))
            {
                $content_tags .= '<td><span class="badge badge-success">OK</span></td>';
            } else
            {
                $content_tags .= '<td><span class="badge badge-danger">failed</span></td>';
            }
        } else
        {
            $content_tags .= '<td><span class="badge badge-danger">failed</span></td>';
            $is_disabled = true;
        }
        $content_tags .= '</tr>';

        $content_tags .= '<tr>';
        $content_tags .= '<tr>';
        $content_tags .= '<td>Write a file to <strong>projects</strong> directory</td>';
        $content_tags .= '<td><code>WRITE: root/projects/test/folder/test.file</code><pre>Filesystem: fwrite, file_get_contents, etc</pre></td>';
        file_put_contents('projects/test/folder/test.file', 'test');
        if (file_exists('projects/test/folder/test.file'))
        {
            $content_tags .= '<td><span class="badge badge-success">OK</span></td>' . "\r\n";
        } else
        {
            $content_tags .= '<td><span class="badge badge-danger">Failed</span></td>';
            $is_disabled = true;
        }
        $content_tags .= '</tr>';

        $content_tags .= '<tr>';
        $content_tags .= '<td>Create <strong>Zip</strong> file</td>';
        $content_tags .= '<td><code>ZIP: root/projects/test/folder/test.zip</code><pre>Zip: ZipArchive</pre></td>';
        
        //raw zip file for test zip features
        $file_zip = 'UEsDBBQAAAAAAJ14D0tGlR1CAwAAAAMAAAAMAAAAemlwL3Rlc3QudHh0emlwUEsBAhQAFAAAAAAAnXgPS0aVHUIDAAAAAwAAAAwAAAAAAAAAAQAgAAAAAAAAAHppcC90ZXN0LnR4dFBLBQYAAAAAAQABADoAAAAtAAAAAAA';
        file_put_contents('projects/test/folder/test.zip', base64_decode($file_zip));
        $zip = new ZipArchive;
        if ($zip->open('projects/test/folder/test.zip') === true)
        {
            $zip->extractTo('projects/test/');
            $zip->close();
            $content_tags .= '<td><span class="badge badge-success">OK</span></td>' . "\r\n";
        } else
        {
            $content_tags .= '<td><span class="badge badge-danger">failed</span></td>';
            //$is_disabled = true;
        }
        $content_tags .= '</tr>';
        $content_tags .= '<tr>';
        $content_tags .= '<td>Unzip a file to <strong>Zip</strong> folder</td>';
        $content_tags .= '<td><code>UNZIP: root/outputs/test/zip/test.txt</code><pre>Filesystem: fwrite, file_get_contents, etc</pre></td>';
        if (file_exists('projects/test/zip/test.txt'))
        {
            if (is_file('projects/test/zip/test.txt'))
            {
                $content_tags .= '<td><span class="badge badge-success">OK</span></td>' . "\r\n";
            } else
            {
                $content_tags .= '<td><span class="badge badge-danger">failed</span></td>';
            }
        } else
        {
            $content_tags .= '<td><span class="badge badge-danger">failed</span></td>';
            //$is_disabled = true;
        }
        $content_tags .= '</tr>';
        $content_tags .= '</tbody>';
        $content_tags .= '</table>';
        if ($is_disabled == true)
        {
            $disabled = 'disabled';
        } else
        {
            $disabled = '';
        }
        $content_tags .= '<br/>';
        $content_tags .= '<h3>Changing Permission Files/Folder</h3>';
        $content_tags .= '<h5><strong>Linux/OSX</strong></h5>';
        $content_tags .= '<p class="small">Permissions are used 777 by including folder and subfolders (<strong>option -R / recursive</strong>). Run your terminal or ssh, type this command:</p>';
        $content_tags .= '<pre>$ sudo su' . "\r\n" . '$ cd ' . realpath(__dir__ . '/../') . "\r\n" . '$ chmod -R 777 *</pre>';
        $content_tags .= '<h5><strong>Windows</strong></h5>';
        $content_tags .= '<p class="small">Run Window Explorer, go to <code>' . __dir__ . '</code> folder.';
        $content_tags .= 'Right-click the folder then selecting <strong>Properties</strong> from the appearing context menu.';
        $content_tags .= ' In Tab <strong>General</strong>, unchecked <strong>read-only</strong> then click <strong>OK</strong>';
        $content_tags .= '</p>';

        $content_tags .= '<h3>Enabling PHP-GD Extensions</h3>';
        $content_tags .= '<p>Check if in your <code>php.ini</code> file has the following line:</p>';
        $content_tags .= '<pre>;extension=php_gd.dll</pre>';

        $content_tags .= '<p>if exists, change it to:</p>';
        $content_tags .= '<pre>extension=php_gd.dll</pre>';
        $content_tags .= 'and restart apache';

        $content_tags .= '</div>'; //card-body
        $content_tags .= '<div class="card-footer">';
        //$content_tags .= '<button type="submit" style="width: 150px;" name="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
        $content_tags .= '<a href="?step=2"  style="width: 150px;" class="btn btn-success btn-flat pull-right ' . $disabled . '">' . __e("Next") . '</a>';
        $content_tags .= '</div>'; //card-footer
        $content_tags .= '</div>'; //card
        $content_tags .= '</div>'; //col-md-6
        $content_tags .= '</div>'; //row
        $content_tags .= '</form>'; //form
        unlink('test.file');
        unlink('system/class/test.file');
        unlink('projects/test/folder/test.file');
        unlink('projects/test/folder/test.zip');
        unlink('projects/test/zip/test.txt');
        rmdir('projects/test/zip');
        rmdir('projects/test/folder');
        rmdir('projects/test');
        break;
        // TODO: STEP 2
    case '2':
        $title = 'Step 2 ~ <small>Setup Configuration</small>';
        $persen = 66;
        $disabled = "";
        if (isset($_POST['submit']))
        {
            $currentData['config']['code_mirror'] = 'darcula';
            $currentData['config']['live_test'] = __dir__ . '/wp-test/';
            // text
            if (isset($_POST['config']['live_test']))
            {
                $postData['config']['live_test'] = $_POST['config']['live_test'];
                $_SESSION['IHS_WORDPRESS_ROOT'] = $postData['config']['live_test'];
            }
            // select
            if (isset($_POST['config']['code_mirror']))
            {
                $postData['config']['code_mirror'] = $_POST['config']['code_mirror'];
                $_SESSION['IHS_CODEMIRROR_THEME'] = $postData['config']['code_mirror'];
            }
            // text
            if (isset($_POST['config']['purchase_code']))
            {
                $postData['config']['purchase_code'] = $_POST['config']['purchase_code'];
                $_SESSION['IHS_PURCHASE_CODE'] = $postData['config']['purchase_code'];
            }
            // text
            if (isset($_POST['config']['email_address']))
            {
                $postData['config']['email_address'] = $_POST['config']['email_address'];
                $_SESSION['IHS_EMAIL_ADDRESS'] = $postData['config']['email_address'];
            }
            $config_php = null;
            $config_php .= "" . '<?php' . "\r\n";
            $config_php .= "" . '' . "\r\n";
            $config_php .= "" . '/**' . "\r\n";
            $config_php .= "" . ' * @author Jasman' . "\r\n";
            $config_php .= "" . ' * @copyright Ihsana IT Solution 2020' . "\r\n";
            $config_php .= "" . ' * @package iWP-Dev Toolz' . "\r\n";
            $config_php .= "" . ' * @license Commercial License' . "\r\n";
            $config_php .= "" . ' */' . "\r\n";
            $config_php .= "" . '' . "\r\n";
            $config_php .= "" . '' . "\r\n";
            $config_php .= "" . 'defined("IHS_EXEC") or die("Silent is golden!");' . "\r\n";
            $config_php .= "" . '' . "\r\n";
            $config_php .= "" . 'define("IHS_PURCHASE_CODE","' . $postData['config']['purchase_code'] . '");' . "\r\n";
            $config_php .= "" . 'define("IHS_EMAIL_ADDRESS","' . $postData['config']['email_address'] . '");' . "\r\n";
            $config_php .= "" . '' . "\r\n";
            $config_php .= "" . 'define("IHS_SITE_URL", "./");' . "\r\n";
            $config_php .= "" . 'define("IHS_WORDPRESS_ROOT", "' . str_replace("\\", "/", $postData['config']['live_test']) . '");' . "\r\n";
            $config_php .= "" . 'define("IHS_CODEMIRROR_THEME","' . $postData['config']['code_mirror'] . '");' . "\r\n";
            $config_php .= "" . '' . "\r\n";
            $config_php .= "" . '' . "\r\n";
            $config_php .= "" . '?>';
            file_put_contents('config.php', $config_php);
            header("Location: ./setup.php?step=2&" . time());
        }
        $currentData['config']['live_test'] = $_SESSION['IHS_WORDPRESS_ROOT'];
        $currentData['config']['code_mirror'] = $_SESSION['IHS_CODEMIRROR_THEME'];
        $currentData['config']['purchase_code'] = $_SESSION['IHS_PURCHASE_CODE'];
        $currentData['config']['email_address'] = $_SESSION['IHS_EMAIL_ADDRESS'];
        $content_tags .= '<form class="form-horizontal" action="?step=2" method="post">';
        $content_tags .= '<div class="row">';
        $content_tags .= '<div class="col-md-12">';
        $content_tags .= '<div class="card card-outline card-primary">';
        $content_tags .= '<div class="card-header">';
        $content_tags .= '<h3 class="card-title">';
        $content_tags .= '<i class="fas fa-list"></i>&nbsp;';
        $content_tags .= '' . __e("Enter Your Data") . '';
        $content_tags .= '</h3>'; //card-title
        $content_tags .= '<div class="card-tools">';
        $content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
        $content_tags .= '</button>';
        $content_tags .= '</div>'; //card-tools
        $content_tags .= '</div>'; //card-header
        $content_tags .= '<div class="card-body">';
        $invalid = '';
        $note_invalid = '';
        if (!file_exists($currentData['config']['live_test'] . '/wp-config.php'))
        {
            $invalid = 'is-invalid';
            $disabled = "disabled";
            $note_invalid = '<p class="alert alert-danger">No WordPress site found in the path above, please install or fix the WordPress Test Path</p>';
        }
        $content_tags .= '<div class="form-group row">';
        $content_tags .= '<label for="live_test" class="col-sm-3 col-form-label">' . __e("Item Purchase Code") . '</label>';
        $content_tags .= '<div class="col-sm-9">';
        $content_tags .= '<input required type="text" maxlength="36" minlength="36" name="config[purchase_code]"  class="form-control" id="purchase_code" placeholder="758b0a8b-c595-4b2a-8129-0be1bc5b073c" value="' . $currentData['config']['purchase_code'] . '">';
        $content_tags .= '<p class="help-block">' . __e('Please enter the correct purchase code, get it <a target="_blank" href="https://codecanyon.net/downloads/">here</a>') . '</p>';
        $content_tags .= '</div>';
        $content_tags .= '</div>';
        $content_tags .= '<div class="form-group row">';
        $content_tags .= '<label for="live_test" class="col-sm-3 col-form-label">' . __e("Your Email Address") . '</label>';
        $content_tags .= '<div class="col-sm-9">';
        $content_tags .= '<input required type="email" name="config[email_address]"  class="form-control" id="email_address" placeholder="no@spam.com" value="' . $currentData['config']['email_address'] . '">';
        $content_tags .= '<p class="help-block">' . __e('Your email will be used to contact us and wrong email are the same as losing our support (excludes: Extended License)') . '</p>';
        $content_tags .= '</div>';
        $content_tags .= '</div>';
        $content_tags .= '<div class="form-group row">';
        $content_tags .= '<label for="live_test" class="col-sm-3 col-form-label">' . __e("WP Test Path") . '</label>';
        $content_tags .= '<div class="col-sm-9">';
        $content_tags .= '<input required type="text" name="config[live_test]"  class="' . $invalid . ' form-control" id="live_test" placeholder="F:/xampp/htdocs/wp-test/" value="' . $currentData['config']['live_test'] . '">';
        $content_tags .= '<p class="help-block">' . __e("Fill with root <strong>WordPress Folder</strong>, if you do not want to lose your other job, please install a new WordPress.") . '</p>';
        $content_tags .= $note_invalid;
        $content_tags .= '</div>';
        $content_tags .= '</div>';
        $content_tags .= '<div class="form-group row">';
        $content_tags .= '<label for="code_mirror" class="col-sm-3 col-form-label">' . __e("Code Mirror Themes") . '</label>';
        $content_tags .= '<div class="col-sm-6">';
        $content_tags .= '<select name="config[code_mirror]" class="form-control" id="field-code_mirror">';
        $options = array();
        $options[] = array("value" => "3024-day", "label" => "3024-day");
        $options[] = array("value" => "3024-night", "label" => "3024-night");
        $options[] = array("value" => "abcdef", "label" => "Abcdef");
        $options[] = array("value" => "ambiance-mobile", "label" => "Ambiance-mobile");
        $options[] = array("value" => "ambiance", "label" => "Ambiance");
        $options[] = array("value" => "ayu-dark", "label" => "Ayu-dark");
        $options[] = array("value" => "ayu-mirage", "label" => "Ayu-mirage");
        $options[] = array("value" => "base16-dark", "label" => "Base16-dark");
        $options[] = array("value" => "base16-light", "label" => "Base16-light");
        $options[] = array("value" => "bespin", "label" => "Bespin");
        $options[] = array("value" => "blackboard", "label" => "Blackboard");
        $options[] = array("value" => "cobalt", "label" => "Cobalt");
        $options[] = array("value" => "colorforth", "label" => "Colorforth");
        $options[] = array("value" => "darcula", "label" => "Darcula");
        $options[] = array("value" => "dracula", "label" => "Dracula");
        $options[] = array("value" => "duotone-dark", "label" => "Duotone-dark");
        $options[] = array("value" => "duotone-light", "label" => "Duotone-light");
        $options[] = array("value" => "eclipse", "label" => "Eclipse");
        $options[] = array("value" => "elegant", "label" => "Elegant");
        $options[] = array("value" => "erlang-dark", "label" => "Erlang-dark");
        $options[] = array("value" => "gruvbox-dark", "label" => "Gruvbox-dark");
        $options[] = array("value" => "hopscotch", "label" => "Hopscotch");
        $options[] = array("value" => "icecoder", "label" => "Icecoder");
        $options[] = array("value" => "idea", "label" => "Idea");
        $options[] = array("value" => "isotope", "label" => "Isotope");
        $options[] = array("value" => "lesser-dark", "label" => "Lesser-dark");
        $options[] = array("value" => "liquibyte", "label" => "Liquibyte");
        $options[] = array("value" => "lucario", "label" => "Lucario");
        $options[] = array("value" => "material-darker", "label" => "Material-darker");
        $options[] = array("value" => "material-ocean", "label" => "Material-ocean");
        $options[] = array("value" => "material-palenight", "label" => "Material-palenight");
        $options[] = array("value" => "material", "label" => "Material");
        $options[] = array("value" => "mbo", "label" => "Mbo");
        $options[] = array("value" => "mdn-like", "label" => "Mdn-like");
        $options[] = array("value" => "midnight", "label" => "Midnight");
        $options[] = array("value" => "monokai", "label" => "Monokai");
        $options[] = array("value" => "moxer", "label" => "Moxer");
        $options[] = array("value" => "neat", "label" => "Neat");
        $options[] = array("value" => "neo", "label" => "Neo");
        $options[] = array("value" => "night", "label" => "Night");
        $options[] = array("value" => "nord", "label" => "Nord");
        $options[] = array("value" => "oceanic-next", "label" => "Oceanic-next");
        $options[] = array("value" => "panda-syntax", "label" => "Panda-syntax");
        $options[] = array("value" => "paraiso-dark", "label" => "Paraiso-dark");
        $options[] = array("value" => "paraiso-light", "label" => "Paraiso-light");
        $options[] = array("value" => "pastel-on-dark", "label" => "Pastel-on-dark");
        $options[] = array("value" => "railscasts", "label" => "Railscasts");
        $options[] = array("value" => "rubyblue", "label" => "Rubyblue");
        $options[] = array("value" => "seti", "label" => "Seti");
        $options[] = array("value" => "shadowfox", "label" => "Shadowfox");
        $options[] = array("value" => "solarized", "label" => "Solarized");
        $options[] = array("value" => "ssms", "label" => "Ssms");
        $options[] = array("value" => "the-matrix", "label" => "The-matrix");
        $options[] = array("value" => "tomorrow-night-bright", "label" => "Tomorrow-night-bright");
        $options[] = array("value" => "tomorrow-night-eighties", "label" => "Tomorrow-night-eighties");
        $options[] = array("value" => "ttcn", "label" => "Ttcn");
        $options[] = array("value" => "twilight", "label" => "Twilight");
        $options[] = array("value" => "vibrant-ink", "label" => "Vibrant-ink");
        $options[] = array("value" => "xq-dark", "label" => "Xq-dark");
        $options[] = array("value" => "xq-light", "label" => "Xq-light");
        $options[] = array("value" => "yeti", "label" => "Yeti");
        $options[] = array("value" => "yonce", "label" => "Yonce");
        $options[] = array("value" => "zenburn", "label" => "Zenburn");
        foreach ($options as $opt)
        {
            $selected = "";
            if ($opt["value"] == $currentData['config']['code_mirror'])
            {
                $selected = "selected";
            }
            $content_tags .= '<option ' . $selected . ' value="' . $opt["value"] . '">' . $opt["label"] . '</option>';
        }
        $content_tags .= '</select>';
        $content_tags .= '<p class="help-block">' . __e("Code Editor Theme in the code custom field") . '</p>';
        $content_tags .= '</div>';
        $content_tags .= '</div>';
        $content_tags .= '</div>'; //card-body
        $content_tags .= '<div class="card-footer">';
        $content_tags .= '<button type="submit" style="width: 150px;" name="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
        $content_tags .= '<div class="pull-right">';
        $content_tags .= '<a href="?step=3"  style="width: 150px;" class="btn btn-success btn-flat pull-right ' . $disabled . '">' . __e("Next") . '</a>';
        $content_tags .= '<a href="?step=1" class="btn btn-default btn-flat">' . __e("Back") . '</a>&nbsp;';
        $content_tags .= '</div>';
        $content_tags .= '</div>'; //card-footer
        $content_tags .= '</div>'; //card
        $content_tags .= '</div>'; //col-md-6
        $content_tags .= '</div>'; //row
        $content_tags .= '</form>'; //form
        break;
        // TODO: STEP 3
    case '3':
        $persen = 100;
        $title = 'Step 3 ~ <small>Software Activation</small>';
        if (!file_exists($_SESSION['IHS_WORDPRESS_ROOT'] . '/wp-config.php'))
        {
            header("Location: ./setup.php?step=2");
        }
        $disabled = "";
        if (isset($_POST['submit']))
        {
            $code = $_POST['config']['activation_code'];
            $_SESSION['IHS_ACTIVATION_CODE'] = $code;
            $class_code = base64_decode(strrev(str_rot13($code)));
            if (strlen($class_code) > 300000)
            {
                file_put_contents('system/class/ihs.wpdev.php', $class_code);
                header("Location: ./setup.php?step=3");
            } else
            {
                $_SESSION['IHS_ACTIVATION_CODE'] = "";
            }
        }

        if (!file_exists('system/class/ihs.wpdev.php'))
        {
            $disabled = "disabled";
        }

        $currentData['config']['live_test'] = $_SESSION['IHS_WORDPRESS_ROOT'];
        $currentData['config']['code_mirror'] = $_SESSION['IHS_CODEMIRROR_THEME'];
        $currentData['config']['purchase_code'] = $_SESSION['IHS_PURCHASE_CODE'];
        $currentData['config']['email_address'] = $_SESSION['IHS_EMAIL_ADDRESS'];
        $currentData['config']['activation_code'] = $_SESSION['IHS_ACTIVATION_CODE'];
        $content_tags .= '<form class="form-horizontal" action="?step=3" method="post">';
        $content_tags .= '<div class="row">';
        $content_tags .= '<div class="col-md-12">';
        $content_tags .= '<div class="card card-outline card-primary">';
        $content_tags .= '<div class="card-header">';
        $content_tags .= '<h3 class="card-title">';
        $content_tags .= '<i class="fas fa-th"></i>&nbsp;';
        $content_tags .= '' . __e("Activate Your Product") . '';
        $content_tags .= '</h3>'; //card-title
        $content_tags .= '<div class="card-tools">';
        $content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
        $content_tags .= '</button>';
        $content_tags .= '</div>'; //card-tools
        $content_tags .= '</div>'; //card-header
        $content_tags .= '<div class="card-body">';
        $content_tags .= '<div class="form-group row">';
        $content_tags .= '<label for="server_used" class="col-sm-3 col-form-label">Server Activation Used?</label>';
        $content_tags .= '<div class="col-sm-9">';
        $content_tags .= '<select class="form-control" id="server_used" name="server_used">';
        foreach ($servers as $server)
        {
            $content_tags .= '<option value="' . $server['value'] . '">' . $server['label'] . '</option>';
        }
        $content_tags .= '</select>';
        $content_tags .= '</div>';
        $content_tags .= '</div>';
        $content_tags .= '<div class="form-group row">';
        $content_tags .= '<label for="purchase_code" class="col-sm-3 col-form-label">' . __e("Envato Purchase Code") . '</label>';
        $content_tags .= '<div class="col-sm-9">';
        $content_tags .= '<input required type="text" id="purchase_code" readonly name="config[purchase_code]"  class="form-control" placeholder="758b0a8b-c595-4b2a-8129-0be1bc5b073c" value="' . $currentData['config']['purchase_code'] . '">';
        $content_tags .= '<p class="help-block">' . __e('Purchase Code obtained from <a href="https://codecanyon.net/downloads/" target="_blank">https://codecanyon.net/downloads/</a>') . '</p>';
        $content_tags .= '</div>';
        $content_tags .= '</div>';
        $content_tags .= '<div class="form-group row">';
        $content_tags .= '<label for="live_test" class="col-sm-3 col-form-label">' . __e("Your Email Address") . '</label>';
        $content_tags .= '<div class="col-sm-9">';
        $content_tags .= '<input required type="email" id="email_address" readonly name="config[email_address]"  class="form-control" placeholder="no@spam.com" value="' . $currentData['config']['email_address'] . '">';
        $content_tags .= '<p class="help-block">' . __e('Your email will be used to contact us and wrong email are the same as losing our support (excludes: Extended License)') . '</p>';
        $content_tags .= '</div>';
        $content_tags .= '</div>';
        $content_tags .= '<div class="form-group row">';
        $content_tags .= '<label for="" class="col-sm-3 col-form-label">' . __e("Activation Code") . '</label>';
        $content_tags .= '<div class="col-sm-9">';
        $content_tags .= '<div class="overlay-wrapper">';
        $content_tags .= '<div class="overlay" style="display:none;text-align: center;padding: 12px;" id="fx-loading"><i class="fas fa-3x fas fa-spinner fa-pulse"></i></div>';
        $content_tags .= '</div>';
        $content_tags .= '<textarea class="form-control" id="activation_code" name="config[activation_code]">' . htmlentities($currentData['config']['activation_code']) . '</textarea>';
        $content_tags .= '<p style="margin-top: 3px;margin-left: 0px;"><a id="btn-activation" href="#!_" class="btn btn-sm btn-danger">Get Activation</a></p>';
        $content_tags .= '</div>';
        $content_tags .= '</div>';
        $content_tags .= '</div>'; //card-body
        $content_tags .= '<div class="card-footer">';
        $content_tags .= '<button type="submit" style="width: 150px;" name="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
        $content_tags .= '<div class="pull-right">';
        $content_tags .= '<a href="?step=2" class="btn btn-default btn-flat">' . __e("Back") . '</a>&nbsp;';
        $content_tags .= '<a href="?step=4" class="btn btn-success btn-flat ' . $disabled . '" style="width: 150px;" >' . __e("Next") . '</a>&nbsp;';
        $content_tags .= '</div>';
        $content_tags .= '</div>'; //card-footer
        $content_tags .= '</div>'; //card
        $content_tags .= '</div>'; //col-md-6
        $content_tags .= '</div>'; //row
        $content_tags .= '</form>'; //form
        break;
    case '4':
        $persen = 100;
        $title = 'Step 4 ~ <small>Done!</small>';
        $content_tags .= '<div class="card card-outline card-primary">';
        $content_tags .= '<div class="card-header">';
        $content_tags .= '<h3 class="card-title">';
        $content_tags .= '<i class="fas fa-th"></i>&nbsp;';
        $content_tags .= '' . __e("Done!") . '';
        $content_tags .= '</h3>'; //card-title
        $content_tags .= '<div class="card-tools">';
        $content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
        $content_tags .= '</button>';
        $content_tags .= '</div>'; //card-tools
        $content_tags .= '</div>'; //card-header
        $content_tags .= '<div class="card-body">';
        $content_tags .= '<blockquote class="alert alert-danger">For security reasons, delete the <strong>setup.php</strong> file.</blockquote>';
        $content_tags .= '</div>'; //card-body
        $content_tags .= '<div class="card-footer">';
        $content_tags .= '<div class="pull-right">';
        $content_tags .= '<a href="?step=3" class="btn btn-default btn-flat">' . __e("Back") . '</a>&nbsp;';
        $content_tags .= '<a href="./" class="btn btn-success btn-flat" style="width: 150px;" >' . __e("Next") . '</a>&nbsp;';
        $content_tags .= '</div>';
        $content_tags .= '</div>'; //card-footer
        break;
}
function __e($str)
{
    return $str;
}
echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '<head>';
echo '<meta charset="utf-8"/>';
echo '<meta http-equiv="X-UA-Compatible" content="IE=edge"/>';
echo '<meta name="viewport" content="width=device-width, initial-scale=1"/>';
echo '<title>iWP-DevToolz (Pro) Setup</title>';
echo '<link rel="shortcut icon" href="./templates/default/assets/img/logo.png"/>';
echo '<link rel="stylesheet" href="./templates/default/assets/css/fonts.css"/>';
echo '<link rel="stylesheet" href="./templates/default/plugins/fontawesome-free/css/all.min.css"/>';
echo '<link rel="stylesheet" href="./templates/default/assets/css/adminlte.min.css"/>';
echo '<style type="text/css">';
echo 'input:invalid {border: 1px solid red;}';
echo '.content-header {padding: 15px 0 15px 0}';
echo '.pull-right {float: right;}';
echo 'pre {background:#fff;border:1px solid #ddd}';
echo 'h1 {font-weight:600;font-size: 48px;text-shadow: 2px 2px 1px #ddd;padding: 0;margin: 0;font-family: FjallaOne;}';
echo 'h2 {font-weight:300;font-size: 32px;text-shadow: 2px 2px 1px #ddd;padding: 0;margin: 0;}';
echo '</style>';
echo '</head>';
echo '<body class="hold-transition layout-top-nav">';
echo '<div class="wrapper">';
echo '<nav class="main-header navbar navbar-expand navbar-dark navbar-cyan">';
echo '<div class="container">';
echo '<a href="./?" class="navbar-brand">';
echo '<img src="templates/default/assets/img/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">';
echo '<span class="brand-text font-weight-light">iWP-DevToolz (Pro)</span>';
echo '</a>';
echo '</div>';
echo '</nav>';
echo '<div class="content-wrapper">';
echo '<div class="container">';
echo '<div class="content-header">';
echo '<div class="container">';
echo '<div class="row">';
echo '<div class="col-sm-6">';
echo '<h1 class="text-dark"> ' . $title . '</h1>';
echo '</div><!-- /.col -->';
echo ' <div class="col-sm-6">';
echo '<ol class="breadcrumb float-sm-right">';
echo '<li class="breadcrumb-item"><a href="./">Home</a></li>';
echo '<li class="breadcrumb-item active">Setup</li>';
echo '</ol>';
echo '</div><!-- /.col -->';
echo '</div><!-- /.row -->';
echo '</div><!-- /.container-fluid -->';
echo '</div>';
echo '<div class="content">';
echo '<div class="progress progress-sm active" style="margin: 12px 0 12px 0;">';
echo '<div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="' . $persen . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $persen . '%">';
echo '<span class="sr-only">20% Complete</span>';
echo '</div>';
echo '</div>';
echo $content_tags;
echo '</div>';
echo '</div>';
echo '</div>';
echo '<div class="container">';
echo '<footer class="main-footer" style="margin-left: 0 !important;">';
echo '<div class="float-right d-none d-sm-block"><b>Version</b> ' . JSM_VERSION . '</div>';
echo '<strong>Copyright &copy; ' . date('Y') . ' <a href="https://ihsana.com/">Ihsana IT Solution</a>.</strong> All rights reserved.';
echo '</footer>';
echo '</div>';
echo '</div>';
echo '<script src="./templates/default/plugins/jquery/jquery.min.js"></script>';
echo '<script src="./templates/default/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>';
echo '<script src="./templates/default/assets/js/adminlte.js"></script>';
echo '<script type="text/javascript">';
echo '$(document).ready(function(){';
echo '$("#fx-loading").css("display","none");';
echo '$("#btn-activation").on("click",function(){';
echo 'var server_used = $("#server_used").val();';
echo 'var purchase_code = $("#purchase_code").val().trim();';
echo 'var email_address = $("#email_address").val().trim();';
echo '$("#activation_code").val("");';
echo 'var param = { purchase_code:purchase_code, email_address:email_address, php_os:"' . PHP_OS . '",php_version:"' . PHP_VERSION . '"};';
echo 'console.log(param);';
echo 'if((purchase_code.length == 36) && (email_address.length !== 0)){';
echo '$("#fx-loading").css("display","block");';
echo 'var jqxhr = $.get( "" + server_used + "/iwpdev/activation/' . JSM_VERSION . '.php",param).done(function(data){';
echo '$("#activation_code").val(data);';
echo '$("#fx-loading").css("display","none");';
echo '}).fail(function(e) {';
echo 'alert(e.statusText);';
echo '$("#fx-loading").css("display","none");';
echo '})';
echo '.always(function() {';
echo 'console.log("finished");';
echo '});';
echo '}else{';
echo 'alert("Please enter your email and purchase code correctly!");';
echo '}';
echo '});';
echo '});';
echo '</script>';
echo '</body>';
echo '</html>';

?>