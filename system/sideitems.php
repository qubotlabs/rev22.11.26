<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 */


$z = 0;

$sideItems[$z]['name'] = 'projects';
$sideItems[$z]['label'] = 'Projects';
$sideItems[$z]['icon'] = 'fas text-info fa-cube';

if (isset($_SESSION['CURRENT_PROJECT_DATA']))
{

    $db = new DB();


    //badge readme
    $badgeReadMe = '<span class="badge badge-danger right">???</span>';
    $countReadMe = count($db->getReadMe());
    if ($countReadMe != 0)
    {
        $badgeReadMe = '<span class="badge badge-success right">OK</span>';
    }


    //badge image size
    $badgeImageSizes = '';
    $countImageSize = count($db->getImageSizes());
    if ($countImageSize != 0)
    {
        $badgeImageSizes = '<span class="badge badge-success right">' . $countImageSize . '</span>';
    }

    //badge roles
    $badgeRoles = '';
    $countRoles = count($db->getRoles());
    if ($countRoles != 0)
    {
        $badgeRoles = '<span class="badge badge-success right">' . $countRoles . '</span>';
    }

    //badge taxonomies
    $badgeTaxonomies = '';
    $countTaxonomies = count($db->getTaxonomies());
    if ($countTaxonomies != 0)
    {
        $badgeTaxonomies = '<span class="badge badge-success right">' . $countTaxonomies . '</span>';
    }

    //badge custom-posts
    $badgeCustomPosts = '';
    $countCustomPosts = count($db->getCustomPosts());
    if ($countCustomPosts != 0)
    {
        $badgeCustomPosts = '<span class="badge badge-success right">' . $countCustomPosts . '</span>';
    }


    //badge enqueue-scripts
    $badgeEnqueueScripts = '';
    $countEnqueueScripts = count($db->getEnqueueScripts());
    if ($countEnqueueScripts != 0)
    {
        $badgeEnqueueScripts = '<span class="badge badge-success right">' . $countEnqueueScripts . '</span>';
    }

    //badge enqueue-styles
    $badgeEnqueueStyles = '';
    $countEnqueueStyles = count($db->getEnqueueStyles());
    if ($countEnqueueStyles != 0)
    {
        $badgeEnqueueStyles = '<span class="badge badge-success right">' . $countEnqueueStyles . '</span>';
    }

    $badgeMetaBoxes = '';
    $countMetaBoxes = count($db->getMetaBoxes());
    if ($countMetaBoxes != 0)
    {
        $badgeMetaBoxes = '<span class="badge badge-success right">' . $countMetaBoxes . '</span>';
    }

    //badge extra-fields
    $badgeExtraFields = '';
    $countExtraFields = count($db->getExtraFields());
    if ($countExtraFields != 0)
    {
        $badgeExtraFields = '<span class="badge badge-success right">' . $countExtraFields . '</span>';
    }

    //badge widgets
    $badgeWidgets = '';
    $countWidgets = count($db->getWidgets());
    if ($countWidgets != 0)
    {
        $badgeWidgets = '<span class="badge badge-success right">' . $countWidgets . '</span>';
    }

    //badge widgets
    $badgePluginOptions = '';
    $countPluginOptions = count($db->getPluginOptions());
    if ($countPluginOptions != 0)
    {
        $badgePluginOptions = '<span class="badge badge-success right">' . $countPluginOptions . '</span>';
    }

    //badge Content
    $badgeContent = '';
    $countContent = count($db->getContents());
    if ($countContent != 0)
    {
        $badgeContent = '<span class="badge badge-success right">' . $countContent . '</span>';
    }


    //badge shortcodes
    $badgeShortCodes = '';
    $countShortCodes = count($db->getShortCodes());
    if ($countShortCodes != 0)
    {
        $badgeShortCodes = '<span class="badge badge-success right">' . $countShortCodes . '</span>';
    }

    //badge adminbar
    $badgeAdminBars = '';
    $countAdminBars = count($db->getAdminBars());
    if ($countAdminBars != 0)
    {
        $badgeAdminBars = '<span class="badge badge-success right">' . $countAdminBars . '</span>';
    }

    //badge admin notices
    $badgeAdminNotices = '';
    $countAdminNotices = count($db->getAdminNotices());
    if ($countAdminNotices != 0)
    {
        $badgeAdminNotices = '<span class="badge badge-success right">' . $countAdminNotices . '</span>';
    }

    $badgeAdminPages = '';
    $countAdminPages = count($db->getAdminPages());
    if ($countAdminPages != 0)
    {
        $badgeAdminPages = '<span class="badge badge-success right">' . $countAdminPages . '</span>';
    }

    //badge ajax request
    $badgeAjaxRequests = '';
    $countAjaxRequests = count($db->getAjaxRequests());
    if ($countAjaxRequests != 0)
    {
        $badgeAjaxRequests = '<span class="badge badge-success right">' . $countAjaxRequests . '</span>';
    }

    $badgeElementorWidgets = '';
    $countElementorWidgets = count($db->getElementorWidgets());
    if ($countElementorWidgets != 0)
    {
        $badgeElementorWidgets = '<span class="badge badge-success right">' . $countElementorWidgets . '</span>';
    }


    $badgeWpBakery = '';
    $countWpBakery = count($db->getWpbakeryPageBuilders());
    if ($countWpBakery != 0)
    {
        $badgeWpBakery = '<span class="badge badge-success right">' . $countWpBakery . '</span>';
    }

    $badgeWooSettings = '';
    $countWooSettings = count($db->getWooSettings());
    if ($countWooSettings != 0)
    {
        $badgeWooSettings = '<span class="badge badge-success right">' . $countWooSettings . '</span>';
    }

    $badgeWooCheckoutFields = '';
    $countWooCheckoutFields = count($db->getWooCheckoutFields());
    if ($countWooCheckoutFields != 0)
    {
        $badgeWooCheckoutFields = '<span class="badge badge-success right">' . $countWooCheckoutFields . '</span>';
    }


    $badgeRawPhpCodes = '';
    $countRawPhpCodes = count($db->getRawPhpCodes());
    if ($countRawPhpCodes != 0)
    {
        $badgeRawPhpCodes = '<span class="badge badge-success right">' . $countRawPhpCodes . '</span>';
    }


    $z++;
    $sideItems[$z]['name'] = 'readMe';
    $sideItems[$z]['label'] = 'Read Me';
    $sideItems[$z]['icon'] = 'text-info fas fa-file';
    $sideItems[$z]['badge'] = $badgeReadMe;

    $z++;
    $sideItems[$z]['name'] = 'imageSizes';
    $sideItems[$z]['label'] = 'Image Sizes';
    $sideItems[$z]['icon'] = 'text-info far fa-image';
    $sideItems[$z]['badge'] = $badgeImageSizes;


    $z++;
    $sideItems[$z]['name'] = 'roles';
    $sideItems[$z]['label'] = 'Roles';
    $sideItems[$z]['icon'] = 'text-info fa fa-user';
    $sideItems[$z]['badge'] = $badgeRoles;


    //--------------------------------------
    $z++;
    $sideItems[$z]['name'] = 'taxonomies';
    $sideItems[$z]['label'] = 'Taxonomies';
    $sideItems[$z]['icon'] = 'text-info fas fa-tag';
    $sideItems[$z]['have-child'] = true;

    $x = 0;
    $sideItems[$z]['childs'][$x]['name'] = 'taxonomies';
    $sideItems[$z]['childs'][$x]['label'] = 'Custom Taxonomies';
    $sideItems[$z]['childs'][$x]['icon'] = 'text-success fas fa-caret-right nav-icon';
    $sideItems[$z]['childs'][$x]['badge'] = $badgeTaxonomies;

    $x++;
    $sideItems[$z]['childs'][$x]['name'] = 'extraFields';
    $sideItems[$z]['childs'][$x]['label'] = 'Extra Fields';
    $sideItems[$z]['childs'][$x]['icon'] = 'text-success fas fa-caret-right nav-icon';
    $sideItems[$z]['childs'][$x]['badge'] = $badgeExtraFields;

    //--------------------------------------

    $z++;
    $sideItems[$z]['name'] = 'posts';
    $sideItems[$z]['label'] = 'Posts';
    $sideItems[$z]['icon'] = 'text-info fas fa-edit';
    $sideItems[$z]['badge'] = $badgeCustomPosts;
    $sideItems[$z]['have-child'] = true;

    $x = 0;
    $sideItems[$z]['childs'][$x]['name'] = 'customPosts';
    $sideItems[$z]['childs'][$x]['label'] = 'Custom Posts';
    $sideItems[$z]['childs'][$x]['icon'] = 'text-success fas fa-caret-right nav-icon';
    $sideItems[$z]['childs'][$x]['badge'] = $badgeCustomPosts;

    $x = 1;
    $sideItems[$z]['childs'][$x]['name'] = 'metaBoxes';
    $sideItems[$z]['childs'][$x]['label'] = 'Meta Boxes';
    $sideItems[$z]['childs'][$x]['icon'] = 'text-success fas fa-caret-right nav-icon';
    $sideItems[$z]['childs'][$x]['badge'] = $badgeMetaBoxes;


    $x = 2;
    $sideItems[$z]['childs'][$x]['name'] = 'shortCodes';
    $sideItems[$z]['childs'][$x]['label'] = 'Short Codes';
    $sideItems[$z]['childs'][$x]['icon'] = 'text-success fas fa-caret-right nav-icon';
    $sideItems[$z]['childs'][$x]['badge'] = $badgeShortCodes;


    //--------------------------------------
    $z++;
    $sideItems[$z]['name'] = 'enqueue';
    $sideItems[$z]['label'] = 'Enqueue';
    $sideItems[$z]['icon'] = 'text-info fab fa-js';
    $sideItems[$z]['have-child'] = true;

    $x = 0;
    $sideItems[$z]['childs'][$x]['name'] = 'enqueueScripts';
    $sideItems[$z]['childs'][$x]['label'] = 'Scripts';
    $sideItems[$z]['childs'][$x]['icon'] = 'text-success fas fa-caret-right nav-icon';
    $sideItems[$z]['childs'][$x]['badge'] = $badgeEnqueueScripts;

    $x = 1;
    $sideItems[$z]['childs'][$x]['name'] = 'enqueueStyles';
    $sideItems[$z]['childs'][$x]['label'] = 'Styles';
    $sideItems[$z]['childs'][$x]['icon'] = 'text-success fas fa-caret-right nav-icon';
    $sideItems[$z]['childs'][$x]['badge'] = $badgeEnqueueStyles;
    //--------------------------------------


    $z++;
    $sideItems[$z]['name'] = 'appearance';
    $sideItems[$z]['label'] = 'Appearance';
    $sideItems[$z]['icon'] = 'text-info fa fa-clipboard-list';
    $sideItems[$z]['have-child'] = true;

    $x = 0;
    $sideItems[$z]['childs'][$x]['name'] = 'widgets';
    $sideItems[$z]['childs'][$x]['label'] = 'Legacy Widgets';
    $sideItems[$z]['childs'][$x]['icon'] = 'text-success fas fa-caret-right nav-icon';
    $sideItems[$z]['childs'][$x]['badge'] = $badgeWidgets;

    $x = 1;
    $sideItems[$z]['childs'][$x]['name'] = 'contents';
    $sideItems[$z]['childs'][$x]['label'] = 'Contents';
    $sideItems[$z]['childs'][$x]['icon'] = 'text-success fas fa-caret-right nav-icon';
    $sideItems[$z]['childs'][$x]['badge'] = $badgeContent;


    $z++;
    $sideItems[$z]['name'] = 'pluginOptions';
    $sideItems[$z]['label'] = 'Plugin Options';
    $sideItems[$z]['icon'] = 'text-info fas fa-cog';
    $sideItems[$z]['badge'] = $badgePluginOptions;

    $z++;
    $sideItems[$z]['name'] = 'adminBars';
    $sideItems[$z]['label'] = 'Admin Bars';
    $sideItems[$z]['icon'] = 'text-info fas fa-link';
    $sideItems[$z]['badge'] = $badgeAdminBars;

    $z++;
    $sideItems[$z]['name'] = 'adminPages';
    $sideItems[$z]['label'] = 'Admin Pages';
    $sideItems[$z]['icon'] = 'text-info fas fa-file';
    $sideItems[$z]['badge'] = $badgeAdminPages;

    $z++;
    $sideItems[$z]['name'] = 'adminNotices';
    $sideItems[$z]['label'] = 'Admin Notices';
    $sideItems[$z]['icon'] = 'text-info fas fa-bell';
    $sideItems[$z]['badge'] = $badgeAdminNotices;

    $z++;
    $sideItems[$z]['name'] = 'ajaxRequests';
    $sideItems[$z]['label'] = 'AJAX Requests';
    $sideItems[$z]['icon'] = 'text-info fab fa-js-square';
    $sideItems[$z]['badge'] = $badgeAjaxRequests;


    $z++;
    $sideItems[$z]['name'] = 'restAPI';
    $sideItems[$z]['label'] = 'REST-API';
    $sideItems[$z]['icon'] = 'text-info fab fa-js-square';

    $z++;
    $sideItems[$z]['name'] = 'wxrFile';
    $sideItems[$z]['label'] = 'WXR File (Dummy Data)';
    $sideItems[$z]['icon'] = 'text-info fas fa-code';


    $z++;
    $sideItems[$z]['name'] = 'Third Party';
    $sideItems[$z]['label'] = 'Third Party APIs';
    $sideItems[$z]['icon'] = 'text-info fa fa-list';
    $sideItems[$z]['have-child'] = true;

    $x = 0;
    $sideItems[$z]['childs'][$x]['name'] = 'elementorWidgets';
    $sideItems[$z]['childs'][$x]['label'] = 'Elementor Widgets';
    $sideItems[$z]['childs'][$x]['icon'] = 'text-success fas fa-caret-right nav-icon';
    $sideItems[$z]['childs'][$x]['badge'] = $badgeElementorWidgets;

    $x++;
    $sideItems[$z]['childs'][$x]['name'] = 'wpbakeryPageBuilders';
    $sideItems[$z]['childs'][$x]['label'] = 'WPBakery PageBuilders';
    $sideItems[$z]['childs'][$x]['icon'] = 'text-success fas fa-caret-right nav-icon';
    $sideItems[$z]['childs'][$x]['badge'] = $badgeWpBakery;

    $x++;
    $sideItems[$z]['childs'][$x]['name'] = 'wooSettings';
    $sideItems[$z]['childs'][$x]['label'] = 'Woo Settings';
    $sideItems[$z]['childs'][$x]['icon'] = 'text-success fas fa-caret-right nav-icon';
    $sideItems[$z]['childs'][$x]['badge'] = $badgeWooSettings;

    $x++;
    $sideItems[$z]['childs'][$x]['name'] = 'wooCheckoutFields';
    $sideItems[$z]['childs'][$x]['label'] = 'Woo Checkout Fields';
    $sideItems[$z]['childs'][$x]['icon'] = 'text-success fas fa-caret-right nav-icon';
    $sideItems[$z]['childs'][$x]['badge'] = $badgeWooCheckoutFields;

    $z++;
    $sideItems[$z]['name'] = 'rawPhpCodes';
    $sideItems[$z]['label'] = 'RAW PHP Codes';
    $sideItems[$z]['icon'] = 'text-info fab fa-php';
    $sideItems[$z]['badge'] = $badgeRawPhpCodes;

    $z++;
    $sideItems[$z]['name'] = 'codeBrowser';
    $sideItems[$z]['label'] = 'Code Browser';
    $sideItems[$z]['icon'] = 'text-danger fa fa-folder-open';

    $z++;
    $sideItems[$z]['name'] = 'build';
    $sideItems[$z]['label'] = 'Download';
    $sideItems[$z]['icon'] = 'text-danger fas fa-download';

    $z++;
    $sideItems[$z]['name'] = 'resetOutput';
    $sideItems[$z]['label'] = 'Reset Output';
    $sideItems[$z]['icon'] = 'text-danger fa fa-sync';
    
}

?>