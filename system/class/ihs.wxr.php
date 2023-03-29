<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 */

defined("IHS_EXEC") or die("Silence is golden");


class WXR
{
    var $max_sample = 5;
    var $basedir = '';
    var $project = array();
    var $modules = null;
    var $string = null;
    var $textdomain = 'text-domain';

    /**
     * WXR::__construct()
     * 
     * @return void
     */
    function __construct($project)
    {
        $this->DB = new DB();
        $this->lorem = new LoremIpsum();
        $this->modules = new Modules($project);

        $this->string = new StringConvert();
        $this->project = $project;
        $this->basedir = IHS_WORDPRESS_ROOT . '/wp-content/plugins/' . $project['project']['prefix'];
        $this->init();
    }

    function init()
    {
        if (!isset($this->project['taxonomies']))
        {
            $this->project['taxonomies'] = array();
        }
        if (!isset($this->project['extra-fields']))
        {
            $this->project['extra-fields'] = array();
        }
        if (!isset($this->project['custom-posts']))
        {
            $this->project['custom-posts'] = array();
        }

        if (!isset($this->project['meta-boxes']))
        {
            $this->project['meta-boxes'] = array();
        }
        if (!isset($this->project['roles']))
        {
            $this->project['roles'] = array();
        }
    }

    /**
     * WXR::generate()
     * 
     * @return void
     */
    function generate()
    {
        $dummy_xml = null;

        $dummy_xml .= "" . '<rss version="2.0"' . "\r\n";
        $dummy_xml .= "\t" . 'xmlns:excerpt="http://wordpress.org/export/1.2/excerpt/"' . "\r\n";
        $dummy_xml .= "\t" . 'xmlns:content="http://purl.org/rss/1.0/modules/content/"' . "\r\n";
        $dummy_xml .= "\t" . 'xmlns:wfw="http://wellformedweb.org/CommentAPI/"' . "\r\n";
        $dummy_xml .= "\t" . 'xmlns:dc="http://purl.org/dc/elements/1.1/"' . "\r\n";
        $dummy_xml .= "\t" . 'xmlns:wp="http://wordpress.org/export/1.2/"' . "\r\n";
        $dummy_xml .= "\t" . '>' . "\r\n";
        $dummy_xml .= "\t" . '<channel>' . "\r\n";
        $dummy_xml .= "\t\t" . '<wp:wxr_version>1.2</wp:wxr_version>' . "\r\n";


        foreach ($this->project['taxonomies'] as $taxonomies)
        {


        }


        $this->project['custom-posts']['post']['name'] = 'post';
        $this->project['custom-posts']['post']['taxonomies'][] = 'category';
        $this->project['custom-posts']['post']['taxonomies'][] = 'post_tag';

        $this->project['custom-posts']['page']['name'] = 'page';
        $this->project['custom-posts']['page']['taxonomies'] = array();

        foreach ($this->project['custom-posts'] as $custom_post)
        {
            $dummy_xml .= "\t\t" . '<!-- Type: ' . strtoupper($custom_post['name']) . ' -->' . "\r\n";

            if (($custom_post['name'] == 'post') || ($custom_post['name'] == 'page'))
            {
                $post_type = $custom_post['name'];
            } else
            {
                $post_type = '' . $this->string->toVar($this->project['project']['short-name']) . '_' . $this->string->toVar($custom_post['name']) . '';

            }


            for ($i = 0; $i < $this->max_sample; $i++)
            {
                $name = ucwords($this->lorem->words(rand(2, 5)));

                $text = null;
                $text .= $this->lorem->sentences(rand(1, 3), 'p');
                $text .= $this->lorem->sentences(rand(1, 3), 'p');
                $text .= $this->lorem->sentences(1, 'blockquote');
                $text .= $this->lorem->sentences(rand(1, 3), 'p');

                $dummy_xml .= "\t\t" . '<item>' . "\r\n";
                $dummy_xml .= "\t\t\t" . '<title><![CDATA[' . $name . ']]></title>' . "\r\n";
                $dummy_xml .= "\t\t\t" . '<wp:post_type><![CDATA[' . $post_type . ']]></wp:post_type>' . "\r\n";
                $dummy_xml .= "\t\t\t" . '<wp:comment_status><![CDATA[closed]]></wp:comment_status>' . "\r\n";
                $dummy_xml .= "\t\t\t" . '<wp:ping_status><![CDATA[closed]]></wp:ping_status>' . "\r\n";
                $dummy_xml .= "\t\t\t" . '<wp:post_name><![CDATA[' . $this->string->toFileName($name) . ']]></wp:post_name>' . "\r\n";
                $dummy_xml .= "\t\t\t" . '<wp:status><![CDATA[publish]]></wp:status>' . "\r\n";
                $dummy_xml .= "\t\t\t" . '<content:encoded><![CDATA[' . ($text) . ']]></content:encoded>' . "\r\n";
                $dummy_xml .= "\t\t\t" . '<dc:creator><![CDATA[root@localhost]]></dc:creator>' . "\r\n";
                if (!isset($custom_post['taxonomies']))
                {
                    $custom_post['taxonomies'] = array();
                }
                foreach ($custom_post['taxonomies'] as $taxonomies)
                {
                    for ($z = 0; $z < rand(1, 4); $z++)
                    {
                        $taxo = $this->lorem->word(false);
                        $dummy_xml .= "\t\t\t" . '<category domain="' . $taxonomies . '" nicename="' . htmlentities($taxo) . '"><![CDATA[' . $taxo . ']]></category>' . "\r\n";
                    }
                }

                $metaboxs = $this->getMetabox($custom_post['name']);

                foreach ($metaboxs as $metabox)
                {
                    $dummy_xml .= "\t\t\t" . '<!-- ' . $metabox['name'] . ' -->' . "\r\n";
                    foreach ($metabox['fields'] as $field)
                    {
                        $name = $this->string->toVar($this->project['project']['short-name'] . '_' . $field['name']);
                        $example = $this->modules->CustomFields($field, 'dummy');

                        $dummy_xml .= "\t\t\t" . '<wp:postmeta>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_key><![CDATA[_' . $name . ']]></wp:meta_key>' . "\r\n";
                        $dummy_xml .= "\t\t\t\t" . '<wp:meta_value><![CDATA[' . $example . ']]></wp:meta_value>' . "\r\n";
                        $dummy_xml .= "\t\t\t" . '</wp:postmeta>' . "\r\n";
                    }
                }
                $dummy_xml .= "\t\t" . '</item>' . "\r\n";
                $dummy_xml .= "\t\t\t" . '' . "\r\n";
            }
        }

        $dummy_xml .= "\t" . '</channel>' . "\r\n";
        $dummy_xml .= "" . '</rss>' . "\r\n";


        $file_name = $this->basedir . '/dummy.xml';
        $this->put_contents($file_name, $dummy_xml);
    }

    /**
     * WXR::getMetabox()
     * 
     * @param mixed $screen
     * @return void
     */
    private function getMetabox($screen)
    {
        $ret = array();
        $fix_screen = $this->string->toVar($this->project['project']['short-name'] . '_' . $screen);
        foreach ($this->project['meta-boxes'] as $meta_boxes)
        {
            if (in_array($fix_screen, $meta_boxes['screen']))
            {
                $ret[] = $meta_boxes;
            }
        }

        return $ret;
    }


    // TODO: PUT-CONTENTS
    /**
     * WpDev::put_contents()
     * 
     * @return void
     */
    private function put_contents($file, $code, $append = false)
    {
        if (!file_exists(dirname($file)))
        {
            if (!mkdir(dirname($file), 0777, true))
            {
                die("Permission denied, please type this command: <pre>chmod -R 777 " . $file . "/*</pre>");
            }
        }
        chmod(dirname($file), 0777);
        if ($append == false)
        {
            file_put_contents($file, $code);
            chmod($file, 0777);
        } else
        {
            file_put_contents($file, $code, FILE_APPEND);
            chmod($file, 0777);
        }
    }


}


if (isset($_SESSION['CURRENT_PROJECT_DATA']['project']['prefix']))
{
    $wxr = new WXR($_SESSION['CURRENT_PROJECT_DATA']);
    $wxr->generate();
}

?>