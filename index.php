<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 */

session_start();

define('IHS_EXEC', true);


set_time_limit(0);

ini_set('internal_encoding', 'utf-8');
ini_set('memory_limit', '512M');
ini_set('max_execution_time', 0);
ini_set('upload_max_filesize', '5M');
ini_set('post_max_size', '8M');
ini_set('max_input_time', '60');
ini_set('safe_mode', 'off');
ini_set('max_input_vars', '1000');


define('IHS_ROOT_DIR', dirname(__file__));
define('IHS_SYSTEM_DIR', IHS_ROOT_DIR . '/system/');
define('IHS_MODULE_DIR', IHS_ROOT_DIR . '/modules/');
define('IHS_PROJECT_DIR', IHS_ROOT_DIR . '/projects/');
define('IHS_TEMPLATES_DIR', IHS_ROOT_DIR . '/templates/');
define('IHS_APP_NAME', 'iWP-DevToolz (Pro)');
define('IHS_DEMO', false);
define('IHS_COLLAPSE_MENU', false);

define('IHS_PREFIX', 'IHS-WP');

ob_start("ob_gzhandler");

if (IHS_DEMO == true)
{
    if (isset($_POST['submit']))
    {
        echo '<script type="text/javascript">alert("This is a demo version! The Save Changes button has been disabled! Click the Activate button to see the available features.");</script>';
    }

    //remove all get, post, file, and put

    if (isset($_POST))
    {
        unset($_POST);
    }

    if (isset($_FILES))
    {
        unset($_FILES);
    }
    if (isset($_GET['a']))
    {
        if ($_GET['a'] == "delete")
        {
            $_GET['a'] = null;
        }
        if ($_GET['a'] == "del")
        {
            $_GET['a'] = null;
        }
        if ($_GET['a'] == "trash")
        {
            $_GET['a'] = null;
        }
    }
}


if (file_exists(IHS_ROOT_DIR . '/config.php'))
{
    require_once (IHS_ROOT_DIR . '/config.php');
} else
{
    header("Location: ./setup.php");
}

if ($_SERVER["HTTP_HOST"] == 'iwpdev.ihsana.net')
{
    if (preg_match("/\/source\//", $_SERVER['REQUEST_URI']))
    {
        define('IHS_DEBUG', true);
    } else
    {
        define('IHS_DEBUG', false);
    }
} else
{
    define('IHS_DEBUG', false);
}

if (IHS_DEBUG == false)
{
    error_reporting(0);
}

if (file_exists("version.txt"))
{
    $version = file_get_contents("version.txt");
    define('IHS_INTERFACE_VERSION', $version);
} else
{
    define('IHS_INTERFACE_VERSION', '00.00.00');
}

if (file_exists(IHS_SYSTEM_DIR . '/class/ihs.string.php'))
{
    require_once (IHS_SYSTEM_DIR . '/class/ihs.string.php');
} else
{
    die("String file is corrupt!");
}

if (file_exists(IHS_SYSTEM_DIR . '/class/ihs.icon.php'))
{
    require_once (IHS_SYSTEM_DIR . '/class/ihs.icon.php');
} else
{
    die("Icon file is corrupt!");
}

if (file_exists(IHS_SYSTEM_DIR . '/class/ihs.database.php'))
{
    require_once (IHS_SYSTEM_DIR . '/class/ihs.database.php');
} else
{
    die("Database file is corrupt!");
}
if (file_exists(IHS_SYSTEM_DIR . '/class/ihs.modules.php'))
{
    require_once (IHS_SYSTEM_DIR . '/class/ihs.modules.php');
} else
{
    die("Modules file is corrupt!");
}


if (file_exists(IHS_SYSTEM_DIR . '/class/ihs.loremipsum.php'))
{
    require_once (IHS_SYSTEM_DIR . '/class/ihs.loremipsum.php');
} else
{
    die("LoremIpsum file is corrupt!");
}

if (!file_exists(IHS_ROOT_DIR . '/config.php'))
{
    header("Location: ./setup.php");
}

if (file_exists(IHS_SYSTEM_DIR . '/class/ihs.wpdev.php'))
{
    require_once (IHS_SYSTEM_DIR . '/class/ihs.wpdev.php');
} else
{
    die("WPDev file is corrupt!");
}

if (file_exists(IHS_SYSTEM_DIR . '/class/ihs.wxr.php'))
{
    require_once (IHS_SYSTEM_DIR . '/class/ihs.wxr.php');
} else
{
    die("WXR file is corrupt!");
}


if (file_exists(IHS_SYSTEM_DIR . '/system.php'))
{
    require_once (IHS_SYSTEM_DIR . '/system.php');
} else
{
    die("System file is corrupt!");
}

if (!isset($_GET['p']))
{
    $_GET['p'] = null;
}

if ($_GET['p'] != 'config')
{
    if (!file_exists(IHS_WORDPRESS_ROOT . '/wp-config.php'))
    {
        unset($_SESSION['CURRENT_PROJECT_PREFIX']);
        unset($_SESSION['CURRENT_PROJECT_DATA']);
        header("Location: ./?p=config");
    }
}


if (!isset($_GET['lic']))
{
    $_GET['lic'] = null;
}

if ($_GET['lic'] == 'reset')
{
    session_destroy();
    if (IHS_DEBUG != true)
    {
        unlink(IHS_ROOT_DIR . "/config.php");
    }
    if (file_exists(IHS_ROOT_DIR . "/system/class/ihs.wpdev.php"))
    {
        if (IHS_DEBUG != true)
        {
            unlink(IHS_ROOT_DIR . "/system/class/ihs.wpdev.php");
        }
    }
    header("Location: setup.php");
}

if (!defined('IHS_PAGE_JS'))
{
    define('IHS_PAGE_JS', '');
}

if (file_exists(IHS_TEMPLATES_DIR . '/default/default.php'))
{
    require_once (IHS_TEMPLATES_DIR . '/default/default.php');
} else
{
    die("Template file is corrupt!");
}

?>