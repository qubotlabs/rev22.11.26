<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 */

defined('IHS_EXEC') or die('Silent is golden!');

if (!isset($_GET['p']))
{
    $_GET['p'] = 'projects';
}
if (!isset($_GET['a']))
{
    $_GET['a'] = 'list';
}

if (isset($_SESSION['CURRENT_PROJECT_DATA']))
{
    $pagefile = IHS_SYSTEM_DIR . '/pages/404.php';
    switch ($_GET['p'])
    {
        case 'projects':
            $pagefile = IHS_SYSTEM_DIR . '/pages/projects.php';
            break;
        case 'readMe':
            $pagefile = IHS_SYSTEM_DIR . '/pages/readMe.php';
            break;
        case 'imageSizes':
            $pagefile = IHS_SYSTEM_DIR . '/pages/imageSizes.php';
            break;

        case 'customPosts':
            $pagefile = IHS_SYSTEM_DIR . '/pages/customPosts.php';
            break;
        case 'taxonomies':
            $pagefile = IHS_SYSTEM_DIR . '/pages/taxonomies.php';
            break;
        case 'metaBoxes':
            $pagefile = IHS_SYSTEM_DIR . '/pages/metaBoxes.php';
            break;
        case 'roles':
            $pagefile = IHS_SYSTEM_DIR . '/pages/roles.php';
            break;
        case 'widgets':
            $pagefile = IHS_SYSTEM_DIR . '/pages/widgets.php';
            break;
        case 'enqueueScripts':
            $pagefile = IHS_SYSTEM_DIR . '/pages/enqueueScripts.php';
            break;
        case 'enqueueStyles':
            $pagefile = IHS_SYSTEM_DIR . '/pages/enqueueStyles.php';
            break;
        case 'extraFields':
            $pagefile = IHS_SYSTEM_DIR . '/pages/extraFields.php';
            break;
        case 'pluginOptions':
            $pagefile = IHS_SYSTEM_DIR . '/pages/pluginOptions.php';
            break;
        case 'shortCodes':
            $pagefile = IHS_SYSTEM_DIR . '/pages/shortCodes.php';
            break;
        case 'adminBars':
            $pagefile = IHS_SYSTEM_DIR . '/pages/adminBars.php';
            break;
        case 'adminNotices':
            $pagefile = IHS_SYSTEM_DIR . '/pages/adminNotices.php';
            break;
        case 'adminPages':
            $pagefile = IHS_SYSTEM_DIR . '/pages/adminPages.php';
            break;
        case 'restAPI':
            $pagefile = IHS_SYSTEM_DIR . '/pages/restAPI.php';
            break;
        case 'wxrFile':
            $pagefile = IHS_SYSTEM_DIR . '/pages/wxrFile.php';
            break;
        case 'contents':
            $pagefile = IHS_SYSTEM_DIR . '/pages/contents.php';
            break;
        case 'config':
            $pagefile = IHS_SYSTEM_DIR . '/pages/config.php';
            break;

        case 'build':
            $pagefile = IHS_SYSTEM_DIR . '/pages/build.php';
            break;

        case 'ajaxRequests':
            $pagefile = IHS_SYSTEM_DIR . '/pages/ajaxRequests.php';
            break;

        case 'elementorWidgets':
            $pagefile = IHS_SYSTEM_DIR . '/pages/elementorWidgets.php';
            break;

        case 'wpbakeryPageBuilders':
            $pagefile = IHS_SYSTEM_DIR . '/pages/wpbakeryPageBuilders.php';
            break;

        case 'codeBrowser':
            $pagefile = IHS_SYSTEM_DIR . '/pages/codeBrowser.php';
            break;

        case 'codeSnippet':
            $pagefile = IHS_SYSTEM_DIR . '/pages/codeSnippet.php';
            break;
        case 'wooSettings':
            $pagefile = IHS_SYSTEM_DIR . '/pages/wooSettings.php';
            break;
        case 'wooCheckoutFields':
            $pagefile = IHS_SYSTEM_DIR . '/pages/wooCheckoutFields.php';
            break;
        case 'rawPhpCodes':
            $pagefile = IHS_SYSTEM_DIR . '/pages/rawPhpCodes.php';
            break;

        case 'resetOutput':
            $pagefile = IHS_SYSTEM_DIR . '/pages/resetOutput.php';
            break;


    }

    if (file_exists($pagefile))
    {
        require_once $pagefile;
    } else
    {
        require_once IHS_SYSTEM_DIR . '/pages/404.php';
    }

} else
{

    $pagefile = IHS_SYSTEM_DIR . '/pages/404.php';
    switch ($_GET['p'])
    {

        case 'config':
            $pagefile = IHS_SYSTEM_DIR . '/pages/config.php';
            break;
        case 'projects':
            $pagefile = IHS_SYSTEM_DIR . '/pages/projects.php';
            break;
    }
    if (file_exists($pagefile))
    {
        require_once $pagefile;
    } else
    {
        require_once IHS_SYSTEM_DIR . '/pages/404.php';
    }
}


require_once IHS_SYSTEM_DIR . '/alert.php';


if (!defined('IHS_PAGE_NAME'))
{
    define('IHS_PAGE_NAME', 'Not found');
}

if (!isset($_SESSION['TOTAL_TIME']))
{
    $_SESSION['TOTAL_TIME'] = '?';
}

?>