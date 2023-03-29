<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2022
 * @package WP-Dev Tools
 * @license Commercial License
 */

$breadcrumb_tags = $content_tags = $_content_tags = null;
$db = new DB();
$string = new StringConvert();
$db->current();
$project = $db->getProject();

$breadcrumb_tags .= '<ol class="breadcrumb float-sm-right">';
$breadcrumb_tags .= '<li class="breadcrumb-item"><a href="./">' . __e("Home") . '</a></li>';
$breadcrumb_tags .= '<li class="breadcrumb-item active">' . __e("Code Snippet") . '</li>';
$breadcrumb_tags .= '</ol>';

$content_tags .= '<div class="card card-outline card-danger">';
$content_tags .= '<div class="card-header">';
$content_tags .= '<h3 class="card-title">';
$content_tags .= '<i class="fas fa-question-circle"></i>&nbsp;';
$content_tags .= __e("Sample Code and References");
$content_tags .= '</h3>'; //card-title
$content_tags .= '<div class="card-tools">';
$content_tags .= '<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>';
$content_tags .= '</button>';
$content_tags .= '</div>'; //card-tools
$content_tags .= '</div>'; //card-header
// TODO: LAYOUT --|--
$content_tags .= '<div class="card-body">';

$content_tags .= '<div class="callout callout-success">';
$content_tags .= __e('These instructions are dynamic according to the conditions of the project being worked on');
$content_tags .= '</div>';

$custom_posts = $db->getCustomPosts();
$custom_image_sizes = $db->getImageSizes();
$metaboxs = $db->getMetaBoxes();
$taxonomies = $db->getTaxonomies();
$extrafields = $db->getExtraFields();

foreach ($custom_posts as $custom_post)
{
    $post_name = $string->toVar($project['short-name'] . '-' . $custom_post['name']);
    $example_code = null;
    $example_code .= "" . '<?php' . "\r\n";
    $example_code .= "" . '//list ' . $custom_post['name'] . ' posts' . "\r\n";
    $example_code .= "" . '$posts_args = array(' . "\r\n";
    $example_code .= "\t" . '"posts_per_page" => 5,' . "\r\n";
    $example_code .= "\t" . '"post_status" => "publish",' . "\r\n";
    $example_code .= "\t" . '"post_type" => "' . $post_name . '",' . "\r\n";
    $example_code .= "" . ');' . "\r\n";
    $example_code .= "\t" . "\r\n";
    $example_code .= "" . '$posts = get_posts($posts_args);' . "\r\n";
    $example_code .= "" . 'foreach($posts as $post){' . "\r\n";
    $example_code .= "\t" . '/**' . "\r\n";
    $example_code .= "\t" . '* get single post.' . "\r\n";
    $example_code .= "\t" . '**/' . "\r\n";

    $example_code .= "\t" . '$content .= "<pre>" . print_r($post,true) . "</pre>";' . "\r\n";
    $example_code .= "\t" . "\r\n";
    $example_code .= "\t" . '/**' . "\r\n";
    $example_code .= "\t" . '* get terms.' . "\r\n";
    $example_code .= "\t" . '**/' . "\r\n";


    foreach ($custom_post['taxonomies'] as $taxo)
    {

        $example_code .= "\t" . '$terms = wp_get_post_terms($post->ID,"' . $taxo . '");' . "\r\n";
        $example_code .= "\t" . '$content .= "<pre>" . print_r($terms,true) . "</pre>";' . "\r\n";
    }


    $example_code .= "\t" . '/**' . "\r\n";
    $example_code .= "\t" . '* get attachment.' . "\r\n";
    $example_code .= "\t" . '**/' . "\r\n";

    $example_code .= "\t" . '$attachment_id = get_post_thumbnail_id($post->ID);' . "\r\n";
    $example_code .= "\t" . '/** default image sizes **/' . "\r\n";
    $example_code .= "\t" . '$image["normal"] = wp_get_attachment_image_src($attachment_id);' . "\r\n";
    $example_code .= "\t" . '$image["large"] = wp_get_attachment_image_src($attachment_id,"large");' . "\r\n";
    $example_code .= "\t" . '$image["medium"] = wp_get_attachment_image_src($attachment_id,"medium");' . "\r\n";
    $example_code .= "\t" . '$image["full"] = wp_get_attachment_image_src($attachment_id,"full");' . "\r\n";
    $example_code .= "\t" . "\r\n";

    $example_code .= "\t" . '/** custom image sizes **/' . "\r\n";
    foreach ($custom_image_sizes as $image_size)
    {
        $example_code .= "\t" . '$image["' . $string->toVar($image_size['name']) . '"] = wp_get_attachment_image_src($attachment_id,"' . $string->toVar($project['short-name'] . '-' . $image_size['name']) . '");' . "\r\n";
    }

    $example_code .= "\t" . '$content .= "<pre>" . print_r($image,true) . "</pre>";' . "\r\n";
    $example_code .= "\t" . "\r\n";


    $example_code .= "\t" . '/**' . "\r\n";
    $example_code .= "\t" . '* Retrieve full permalink for current post or post ID.' . "\r\n";
    $example_code .= "\t" . '* This function is an alias for get_permalink().' . "\r\n";
    $example_code .= "\t" . '* @since 3.9.0' . "\r\n";
    $example_code .= "\t" . '**/' . "\r\n";
    $example_code .= "\t" . 'if(function_exists("get_the_permalink")){' . "\r\n";
    $example_code .= "\t\t" . '$post_link = get_the_permalink($post->ID);' . "\r\n";
    $example_code .= "\t" . '}else{' . "\r\n";
    $example_code .= "\t\t" . '$post_link = get_permalink($post->ID); ' . "\r\n";
    $example_code .= "\t" . '}' . "\r\n";
    $example_code .= "\t" . '$content .= "<pre>" . print_r($post_link,true) . "</pre>";' . "\r\n";

    $example_code .= "\t" . "\r\n";


    $example_code .= "\t" . '/**' . "\r\n";
    $example_code .= "\t" . '* get post author.' . "\r\n";
    $example_code .= "\t" . '* you can also use $post_post_author = get_userdata($_post->post_author);' . "\r\n";
    $example_code .= "\t" . '**/' . "\r\n";
    $example_code .= "\t" . '$post_post_author["user_nicename"] = get_the_author_meta("user_nicename",$post->post_author);' . "\r\n";
    $example_code .= "\t" . '$post_post_author["user_email"] = get_the_author_meta("user_email",$post->post_author);' . "\r\n";
    $example_code .= "\t" . '$post_post_author["user_url"] = get_the_author_meta("user_url",$post->post_author);' . "\r\n";
    $example_code .= "\t" . '$post_post_author["user_registered"] = get_the_author_meta("user_registered",$post->post_author);' . "\r\n";
    $example_code .= "\t" . '$post_post_author["user_status"] = get_the_author_meta("user_status",$post->post_author);' . "\r\n";
    $example_code .= "\t" . '$post_post_author["display_name"] = get_the_author_meta("display_name",$post->post_author);' . "\r\n";
    $example_code .= "\t" . '$content .= "<pre>" . print_r($post_post_author,true) . "</pre>";' . "\r\n";
    $example_code .= "\t" . "\r\n";
    $example_code .= "\t" . "\r\n";
    $example_code .= "\t" . '/**' . "\r\n";
    $example_code .= "\t" . '* get custom_fields.' . "\r\n";
    $example_code .= "\t" . '**/' . "\r\n";
    foreach ($metaboxs as $customfields)
    {
        if (in_array($post_name, $customfields['screen']))
        {
            foreach ($customfields['fields'] as $customfield)
            {
                $example_code .= "\t" . '$custom_fields["' . $string->toVar($customfield['name']) . '"] = get_post_meta($post->ID, "_' . $string->toVar($project['short-name'] . '-' . $customfield['name']) . '",true);' . "\r\n";
            }
        }
    }
    $example_code .= "\t" . '$content .= "<pre>" . print_r($custom_fields,true) . "</pre>";' . "\r\n";
    $example_code .= "" . '}' . "\r\n";


    $content_tags .= '<h4>:: List ' . $custom_post['label'] . ' Pages ::</h4>';
    $content_tags .= '<div class="example-code">';
    $content_tags .= highlight_string($example_code, true);
    $content_tags .= '</div>';
}


foreach ($taxonomies as $taxonomy)
{
    $taxo_name = $string->toVar($project['short-name'] . '-' . $taxonomy['name']);

    $example_code = null;
    $example_code .= "" . '<?php' . "\r\n";
    $example_code .= "" . '$terms = get_terms("' . $taxo_name . '", array(' . "\r\n";
    $example_code .= "\t" . '"hide_empty" => false,' . "\r\n";
    $example_code .= "" . '));' . "\r\n";

    $example_code .= "" . 'foreach($terms as $term){' . "\r\n";
    $example_code .= "\t" . '$taxonomies["id"] = $term->term_id;' . "\r\n";
    $example_code .= "\t" . '$taxonomies["name"] = $term->name;' . "\r\n";
    $example_code .= "\t" . '$taxonomies["count"] = $term->count;' . "\r\n";
    $example_code .= "\t" . '$content .= "<pre>" . print_r($taxonomies,true) . "</pre>";' . "\r\n";

foreach($extrafields as $extrafield){
    foreach($extrafield['fields'] as $field){
        $example_code .= "\t" . '$extrafields["'.$string->toFileName( $field['name']).'"] = get_term_meta($term->term_id, "'.$string->toFileName($taxo_name.'-'. $field['name']).'", true );' . "\r\n";
    }
    
}
    $example_code .= "\t" . '$content .= "<pre>" . print_r($extrafields,true) . "</pre>";' . "\r\n";

    $example_code .= "" . '}' . "\r\n";


    $content_tags .= '<h4>:: List ' . $taxonomy['label'] . ' Terms ::</h4>';
    $content_tags .= '<div class="example-code">';
    $content_tags .= highlight_string($example_code, true);
    $content_tags .= '</div>';
}


$content_tags .= '</div>'; //card-body
$content_tags .= '</div>'; //card


define('IHS_LAYOUT_CONTENT', $content_tags);
define('IHS_LAYOUT_BREADCRUMB', $breadcrumb_tags);
define('IHS_PAGE_NAME', 'Code Snippet');
define('IHS_PAGE_DESC', __e("Make it easier to enter repeating code"));

?>