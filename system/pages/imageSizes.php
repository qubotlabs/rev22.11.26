<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2022
 * @package WP-Dev Tools
 * @license Commercial License
 */

defined('IHS_EXEC') or die('Silent is golden!');
$db = new DB();
$string = new StringConvert();

$db->current();
$project = $db->getProject();

if (isset($_POST['submit']))
{
    if (isset($_GET['n']))
    {
        $_POST['image-sizes']['name'] = $_GET['n'];
    }
    // validate and save postdata
    $db->saveImageSize($_POST['image-sizes']);
    $db->current();
    $_SESSION['CURRENT_PROJECT_NOTICE'] = __e('Image size saved successfully!');
    if ($_GET['a'] == 'edit')
    {
        header('Location: ./?p=imageSizes&a=edit&alert=success&n=' . $_GET['n'] . '&' . time());
    } else
    {
        header('Location: ./?p=imageSizes&a=list&alert=success&' . time());
    }

}
$breadcrumb_tags = $content_tags = $_content_tags = null;

$disabled = '';
if (isset($_GET['n']))
{
    if ($_GET['a'] == 'edit')
    {
        $imagesize_prefix = basename($_GET['n']);
        $currentData['image-sizes'] = $db->getImageSize($imagesize_prefix);
        $disabled = 'disabled';
    }
}


// TODO: LAYOUT --|-- GENERATOR
if (!isset($currentData['image-sizes']['name']))
{
    $currentData['image-sizes']['name'] = "example-thumbnail";
}

if (!isset($currentData['image-sizes']['label']))
{
    $currentData['image-sizes']['label'] = "";
}

if (!isset($currentData['image-sizes']['note']))
{
    $currentData['image-sizes']['note'] = "";
}
if (!isset($currentData['image-sizes']['width']))
{
    $currentData['image-sizes']['width'] = 0;
}
if (!isset($currentData['image-sizes']['height']))
{
    $currentData['image-sizes']['height'] = 0;
}
if (!isset($currentData['image-sizes']['crop']))
{
    $currentData['image-sizes']['crop'] = false;
}


$content_tags .= '<form class="form-horizontal" action="" method="post">';
$content_tags .= '<div class="row">';
$content_tags .= '<div class="col-md-6">';
$content_tags .= '<div class="card card-outline card-primary">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-image"></i>&nbsp;';
$content_tags .= __e('General');
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- GENERATOR --|-- FORM
$content_tags .= '<div class="card-body">';


$content_tags .= '<p class="output-file">' . __e("Generated file") . ' : <code>wp-content/plugins/' . $project['prefix'] . '/incl/image-sizes.php</code></p>';
$content_tags .= '<div class="callout callout-success"><h5>' . __e("Tips") . '</h5>';
$content_tags .= '<p>' . __e("Image size is added to new images on upload, old images will not be processed") . '</p>';
$content_tags .= '</div>';


if (function_exists('gd_info'))
{
    //$content_tags .= '<div class="callout callout-danger"><h5>' . __e("Ops, errors!") . '</h5>';
    //$content_tags .= "<p><code>Imagick</code> or <code>PHP-GD extensions</code> support is available</p>";
    //$content_tags .='</div>';
} else
{
    $content_tags .= '<div class="callout callout-danger"><h5>' . __e("Ops, errors!") . '</h5>';
    $content_tags .= '<p>' . __e("<code>Imagick</code> or <code>PHP-GD extensions</code> support is NOT available") . '</p>';
    $content_tags .= '</div>';
}


// TODO: LAYOUT --|-- GENERATOR --|-- FORM --|-- NAME
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="name" class="col-sm-3 col-form-label">' . __e("Name") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input ' . $disabled . ' type="text" name="image-sizes[name]"  class="form-control" id="name" placeholder="my-thumbnail" value="' . $currentData['image-sizes']['name'] . '">';
$content_tags .= '<p class="help-block">' . __e("Image size identifier, only allowed: a-z and - characters") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- GENERATOR --|-- FORM --|-- LABEL
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="name" class="col-sm-3 col-form-label">' . __e("Label") . '</label>';
$content_tags .= '<div class="col-sm-6">';
$content_tags .= '<input type="text" name="image-sizes[label]"  class="form-control" id="name" placeholder="My Thumbnail" value="' . $currentData['image-sizes']['label'] . '">';
$content_tags .= '<p class="help-block">' . __e("Label name, only allowed: a-z, A-Z and space characters") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


// TODO: LAYOUT --|-- GENERATOR --|-- FORM --|-- NOTE
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="note" class="col-sm-3 col-form-label">' . __e("Note") . '</label>';
$content_tags .= '<div class="col-sm-8">';
$content_tags .= '<input type="text" name="image-sizes[note]"  class="form-control" id="note" placeholder="" value="' . $currentData['image-sizes']['note'] . '">';
$content_tags .= '<p class="help-block">' . __e("Just an additional note about this image size") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- GENERATOR --|-- FORM --|-- WIDTH
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="width" class="col-sm-3 col-form-label">' . __e("Width") . '</label>';
$content_tags .= '<div class="col-sm-4">';
$content_tags .= '<input type="number" name="image-sizes[width]"  class="form-control" id="width" placeholder="80" value="' . $currentData['image-sizes']['width'] . '">';
$content_tags .= '<p class="help-block">' . __e("Image width in pixels, default: 0") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- GENERATOR --|-- FORM --|-- HEIGHT
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="height" class="col-sm-3 col-form-label">' . __e("Height") . '</label>';
$content_tags .= '<div class="col-sm-4">';
$content_tags .= '<input type="number" name="image-sizes[height]"  class="form-control" id="height" placeholder="80" value="' . $currentData['image-sizes']['height'] . '">';
$content_tags .= '<p class="help-block">' . __e("Image height in pixels, default: 0") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';

// TODO: LAYOUT --|-- GENERATOR --|-- FORM --|-- CROP
$content_tags .= '<div class="form-group row">';
$content_tags .= '<label for="crop" class="col-sm-3 col-form-label">' . __e("Crop") . '</label>';
$content_tags .= '<div class="col-sm-8">';
if ($currentData['image-sizes']['crop'] == true)
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" checked="checked" name="image-sizes[crop]" data-type="switch" data-on-color="success"/></div>';
} else
{
    $content_tags .= '<div class="checkbox"><input type="checkbox" name="image-sizes[crop]" data-type="switch" data-on-color="success"/></div>';
}
$content_tags .= '<p class="help-block">' . __e("The image will be cropped to the specified dimensions using center position") . '</p>';
$content_tags .= '</div>';
$content_tags .= '</div>';


$content_tags .= '</div>';
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != '')
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=imageSizes" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=imageSizes" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card

$content_tags .= '</div>'; //col-md-6


$content_tags .= '<div class="col-md-6">';

$content_tags .= '<div class="card card-outline card-danger">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-question-circle"></i>&nbsp;';
$content_tags .= __e('Sample Code and References');
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|-- GENERATOR --|-- FORM
$content_tags .= '<div class="card-body">';
$content_tags .= '<div class="callout callout-success">';
$content_tags .= __e('These instructions are dynamic according to the conditions of the project being worked on');
$content_tags .= '</div>';

$imageSizeName = $string->toVar($project['short-name']) . '_' . $string->toVar($currentData['image-sizes']['name']);

$content_tags .= '<h3>' . __e("Using the New Image Sizes") . '</h3>';
$content_tags .= '<p>' . __e("From your post editor, click on Add Media Library to upload new image, Image sizes is on the Block tab") . '</p>';
$content_tags .= '<p><img class="img-thumbnail" src="./templates/default/assets/img/image-sizes.jpg"></p>';

$content_tags .= '<p>' . __e("If the Image Sizes is not showing, make sure to do this:") . '</p>';
$content_tags .= '<ul>';
$content_tags .= '<li>' . __e("<code>Imagick</code> or <code>GD PHP extensions</code> are installed on your server") . '</li>';
$content_tags .= '<li>' . __e("Uploaded image was <code>higher resolution</code> than any of the custom sizes") . '</li>';
$content_tags .= '</ul>';

$content_tags .= '<h3>' . __e("Using the New Image Sizes") . '</h3>';
$content_tags .= '<p>' . __e("Display the post thumbnail") . ':</p>';


$example_code = null;
$example_code .= "" . '<?php' . "\r\n";
$example_code .= "" . 'if(has_post_thumbnail()){' . "\r\n";
$example_code .= "\t" . 'the_post_thumbnail("' . $imageSizeName . '");' . "\r\n";
$example_code .= "" . '}' . "\r\n";
$content_tags .= '<div class="example-code">';
$content_tags .= highlight_string($example_code, true);
$content_tags .= '</div>';

$content_tags .= '<p>' . __e("or using class and attributes") . ':</p>';
$example_code = null;
$example_code .= "" . '<?php' . "\r\n";
$example_code .= "" . 'if(has_post_thumbnail()){ ' . "\r\n";
$example_code .= "\t" . 'the_post_thumbnail("' . $imageSizeName . '",["class" => "' . $imageSizeName . '", "title" => "Feature image"]);' . "\r\n";
$example_code .= "" . '}' . "\r\n";
$content_tags .= '<div class="example-code">';
$content_tags .= highlight_string($example_code, true);
$content_tags .= '</div>';


$content_tags .= '<h3>' . __e("For General Media") . '</h3>';
$example_code = null;
$example_code .= "" . '<?php' . "\r\n";
$example_code .= "" . '$attachment_id = get_post_thumbnail_id($postID);' . "\r\n";
$example_code .= "" . 'echo wp_get_attachment_image($attachment_id,"' . $imageSizeName . '");' . "\r\n";
$content_tags .= '<div class="example-code">';
$content_tags .= highlight_string($example_code, true);
$content_tags .= '</div>';

$content_tags .= '<div class="callout callout-info">';
$content_tags .= '<h5>' . __e("Code References") . ':</h5>';
$content_tags .= '<ul>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/add_image_size/">add_image_size</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/the_post_thumbnail/">the_post_thumbnail</a>' . '</p></li>';
$content_tags .= '<li><p>' . '<a target="_blank" href="https://developer.wordpress.org/reference/functions/wp_get_attachment_image/">wp_get_attachment_image</a>' . '</p></li>';
$content_tags .= '</ul>';
$content_tags .= '</div>';


$content_tags .= '</div>';
$content_tags .= '<div class="card-footer">';
$content_tags .= '<button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fas fa-save"></i>&nbsp;' . __e("Save Changes") . '</button>';
if ($disabled != '')
{
    $content_tags .= '<div class="pull-right">';
    $content_tags .= '<a target="_blank" href="./plugins/functions/?f=imageSizes" class=""><i class="fas fas fa-question-circle"></i>&nbsp;' . __e("Theme Functions") . '</a>&nbsp;or&nbsp;';
    $content_tags .= '<a target="_blank" href="./plugins/viewsource/?f=imageSizes" class="btn btn-default btn-flat"><i class="fas fa-code"></i>&nbsp;' . __e("See the results") . '</a>';
    $content_tags .= '</div>';
}
$content_tags .= '</div>'; //card-footer
$content_tags .= '</div>'; //card


$content_tags .= '</div>'; //col-md-6


$content_tags .= '</div>'; //row
$content_tags .= '</form>';
// TODO: LAYOUT --|-- GENERATOR

// TODO: LIST
switch ($_GET['a'])
{
    case 'list':
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=imageSizes">' . __e("Image Sizes") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("List") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags .= '<div class="card card-outline card-info">';
        $_content_tags .= '<div class="card-body">';

        $_content_tags .= '<div class="welcome">';
        $_content_tags .= '<h2>Media Library</h2>';
        $_content_tags .= '<h1>Image Sizes</h1>';
        $_content_tags .= '<p class="lead">Register a new custom image sizes and crop images</p>';
        $_content_tags .= '</div>';

        // TODO: LIST --|-- TABLE
        $_content_tags .= '<table data-type="datatable" class="table datatable table-bordered">';
        $_content_tags .= '<thead>';
        $_content_tags .= '<tr>';
        $_content_tags .= '<th>' . __e("Name") . '</th>';
        $_content_tags .= '<th>' . __e("Label") . '</th>';
        $_content_tags .= '<th>' . __e("Note") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Width") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Height") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Crop") . '</th>';
        $_content_tags .= '<th class="text-center">' . __e("Action") . '</th>';
        $_content_tags .= '</tr>';
        $_content_tags .= '</thead>';

        $_content_tags .= '<tbody>';

        $image_sizes = $db->getImageSizes();
        foreach ($image_sizes as $image_size)
        {
            $_content_tags .= '<tr>';
            $_content_tags .= '<td><code>' . $string->toVar($project['short-name'] . '_' . $image_size['name']) . '</code></td>';
            $_content_tags .= '<td>' . $image_size['label'] . '</td>';
            $_content_tags .= '<td><em>' . $image_size['note'] . '</em></td>';
            $_content_tags .= '<td class="text-center"><code>' . $image_size['width'] . '</code></td>';
            $_content_tags .= '<td class="text-center"><code>' . $image_size['height'] . '</code></td>';

            if ($image_size['crop'] == true)
            {
                $_content_tags .= '<td class="text-center"><span class="badge badge-success">' . __e("Yes") . '</span></td>';
            } else
            {
                $_content_tags .= '<td class="text-center"><span class="badge badge-info">' . __e("No") . '</span></td>';
            }
            $_content_tags .= '<td class="text-center align-middle">';
            $_content_tags .= '<div class="btn-group btn-group-sm">';
            $_content_tags .= '<a href="#' . $image_size['name'] . '" data-toggle="modal" data-target="#modal-trash-image-sizes-' . $image_size['name'] . '" data-href="./?p=imageSizes&amp;a=trash&amp;n=' . $image_size['name'] . '" class="btn btn-danger"><i class="fa fa-trash"></i> ' . __e("Trash") . '</a>';
            $_content_tags .= '<a href="./?p=imageSizes&amp;a=edit&amp;n=' . $image_size['name'] . '" class="btn btn-success"><i class="fa fa-edit"></i> ' . __e("Edit") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</td>';
            $_content_tags .= '</tr>';
        }
        $_content_tags .= '</tbody>';

        $_content_tags .= '</table>';
        $_content_tags .= '</div>';

        $_content_tags .= '<div class="card-footer">';
        $_content_tags .= '<a href="./?p=imageSizes&amp;a=new" class="btn btn-success"><i class="fa fa-plus-circle"></i> ' . __e("Add New Image Size") . '</a>';
        $_content_tags .= '</div>';
        $_content_tags .= '</div>';

        // TODO: LIST --|-- MODAL
        foreach ($image_sizes as $image_size)
        {
            $_content_tags .= '<div class="modal fade" id="modal-trash-image-sizes-' . $image_size['name'] . '">';
            $_content_tags .= '<div class="modal-dialog">';
            $_content_tags .= '<div class="modal-content bg-default">';
            $_content_tags .= '<div class="modal-header">';
            $_content_tags .= '<h4 class="modal-title">' . __e("Confirm") . '</h4>';
            $_content_tags .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            $_content_tags .= '<span aria-hidden="true">&times;</span></button>';
            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-body">';
            $_content_tags .= '<p>' . __e("Are you sure You want to delete this image size?") . '</p>';

            $_content_tags .= '<table class="table-grid">';

            $_content_tags .= '<tr>';
            $_content_tags .= '<td rowspan="4" style="text-align: center;"><i class="far fa-image trash-logo"></i></td>';
            $_content_tags .= '<td>' . __e("Name") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td><code>' . $string->toVar($project['short-name'] . '_' . $image_size['name']) . '</code></td>';
            $_content_tags .= '</tr>';

            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Label") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td>' . $image_size['label'] . '</td>';
            $_content_tags .= '</tr>';

            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Width") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td>' . $image_size['width'] . '</td>';
            $_content_tags .= '</tr>';

            $_content_tags .= '<tr>';
            $_content_tags .= '<td>' . __e("Height") . '</td>';
            $_content_tags .= '<td>:</td>';
            $_content_tags .= '<td>' . $image_size['height'] . '</td>';
            $_content_tags .= '</tr>';

            $_content_tags .= '</table>';

            $_content_tags .= '</div>';
            $_content_tags .= '<div class="modal-footer justify-content-between">';
            $_content_tags .= '<button type="button" class="btn btn-default" data-dismiss="modal">' . __e("Close") . '</button>';
            $_content_tags .= '<a href="./?p=imageSizes&amp;a=trash&amp;n=' . $image_size['name'] . '" class="btn btn-danger">' . __e("Yes, I am sure!") . '</a>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
            $_content_tags .= '</div>';
        }


        break;

    case 'new':
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=imageSizes">' . __e("Image Sizes") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("New") . '</li>';
        $breadcrumb_tags .= '</ol>';

        $_content_tags = $content_tags;

        break;
    case 'edit':
        $breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./?p=imageSizes">' . __e("Image Sizes") . '</a></li>';
        $breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("New") . '</li>';
        $breadcrumb_tags .= '</ol>';
        $_content_tags = $content_tags;
        break;

    case 'trash':
        $name = $_GET['n'];
        $_SESSION['CURRENT_PROJECT_NOTICE'] = '' . __e("The ") . '`' . $name . '` ' . __e('image size has been deleted successfully!');
        $db->removeImageSize($name);
        $db->current();
        header("Location: ./?p=imageSizes&alert=warning&" . time());
        break;

}

define('IHS_LAYOUT_CONTENT', $_content_tags);
define('IHS_LAYOUT_BREADCRUMB', $breadcrumb_tags);
define('IHS_PAGE_NAME', '' . __e("Image Sizes") . '');
define('IHS_PAGE_DESC', __e("Add custom image sizes"));

?>