<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 */


class Modules
{
    var $textdomain = 'text-domain';
    var $short_name = 'myapp';
    var $project = array();
    var $string = null;


    function __construct($project)
    {
        $this->string = new StringConvert();

        $this->project = $project;
        $this->textdomain = $this->project['project']['prefix'];
        $this->short_name = $this->project['project']['short-name'];
    }


    // TODO: EXTRA-FIELDS --|--

    /**
     * Modules::ExtraFields()
     * 
     * @param mixed $__field
     * @param string $type
     * @return void
     */
    function ExtraFields($taxonomy = '', $__field = array(), $funcType = '')
    {
        $module_path = IHS_MODULE_DIR . '/extra-fields/*.mod.php';
        $options = $modules = $module = array();
        foreach (glob($module_path) as $filename)
        {
            $module = null;
            include ($filename);
            $var = md5($module['name']);
            $modules[$var] = $module;
        }
        $ret = null;

        //periksa nama dan type sama
        $module = null;
        foreach ($modules as $module)
        {
            if ($module['name'] == $__field['type'])
            {
                switch ($funcType)
                {
                    case 'edit_form_fields':
                        $ret .= $this->fixExtraFields($taxonomy, $__field, $module['edit_form_fields']);
                        break;
                    case 'edit_form':
                        $ret .= $this->fixExtraFields($taxonomy, $__field, $module['edit_form']);
                        break;
                    case 'add_form_fields':
                        $ret .= $this->fixExtraFields($taxonomy, $__field, $module['add_form_fields']);
                        break;
                    case 'add_form':
                        $ret .= $this->fixExtraFields($taxonomy, $__field, $module['add_form']);
                        break;
                    case 'admin_footer':
                        if (isset($module['admin_footer']))
                        {
                            $ret .= $this->fixExtraFields($taxonomy, $__field, $module['admin_footer']);
                        }
                        break;
                    case 'admin_enqueue_scripts':
                        if (isset($module['admin_enqueue_scripts']))
                        {
                            $ret .= $this->fixExtraFields($taxonomy, $__field, $module['admin_enqueue_scripts']);
                        }
                        break;
                }
            }
        }
        return $ret;
    }


    // TODO: EXTRA-FIELDS --|-- FIX
    /**
     * Modules::fixExtraFields()
     * 
     * @param mixed $taxonomy
     * @param mixed $field
     * @param mixed $string
     * @return
     */
    private function fixExtraFields($taxonomy, $field, $string)
    {
        $new_string = $string;
        $new_string = str_replace('{{NAME}}', $this->string->toFileName($taxonomy . '-' . $field['name']), $new_string);
        $new_string = str_replace('{{ID}}', $this->string->toFileName($taxonomy . '-' . $field['name']), $new_string);
        $new_string = str_replace('{{LABEL}}', $field['label'], $new_string);
        $new_string = str_replace('{{OPTIONS}}', $field['options'], $new_string);
        $new_string = str_replace('{{INFO}}', $field['info'], $new_string);
        $new_string = str_replace('{{TEXT-DOMAIN}}', $this->textdomain, $new_string);
        $new_string = str_replace('{{TEXTDOMAIN}}', $this->textdomain, $new_string);
        $new_string = str_replace('{{PLACEHOLDER}}', $field['options'], $new_string);
        $new_string = str_replace('{{DEFAULT}}', $field['default'], $new_string);
        $new_string = str_replace('{{SHORT-NAME}}', $this->short_name, $new_string);
        $new_string = str_replace('{{SHORTNAME}}', strtolower($this->short_name), $new_string);

        return $new_string;
    }


    // TODO: SHORT-CODE --|--
    /**
     * Modules::ShortCodes()
     * 
     * @param mixed $__field
     * @param string $type
     * @return void
     */
    function ShortCode($__field = array(), $funcType = '')
    {
        $module_path = IHS_MODULE_DIR . '/short-codes/attributes/*.mod.php';
        $options = $modules = $module = array();
        foreach (glob($module_path) as $filename)
        {
            $module = null;
            include ($filename);
            $var = md5($module['name']);
            $modules[$var] = $module;
        }
        $ret = null;

        //periksa nama dan type sama
        $module = null;
        foreach ($modules as $module)
        {
            if ($module['name'] == $__field['type'])
            {
                switch ($funcType)
                {
                    case 'tinymce':
                        $ret .= $this->fixShortCode($__field, $module['tinymce']);
                        break;
                }
            }
        }
        return $ret;
    }


    // TODO: SHORT-CODE --|-- FIX
    /**
     * Modules::fixShortCode()
     * 
     * @param mixed $field
     * @param mixed $string
     * @return
     */
    private function fixShortCode($field, $string)
    {
        $new_string = $string;
        $new_string = str_replace('{{NAME}}', $this->string->toFileName($this->short_name . '-' . $field['name']), $new_string);
        $new_string = str_replace('{{ID}}', $this->string->toFileName($this->short_name . '-' . $field['name']), $new_string);
        $new_string = str_replace('{{VAR}}', $this->string->toVar($field['name']), $new_string);
        $new_string = str_replace('{{LABEL}}', $field['label'], $new_string);
        $new_string = str_replace('{{OPTIONS}}', $field['options'], $new_string);
        $new_string = str_replace('{{INFO}}', $field['info'], $new_string);
        $new_string = str_replace('{{TEXT-DOMAIN}}', $this->textdomain, $new_string);
        $new_string = str_replace('{{TEXTDOMAIN}}', $this->textdomain, $new_string);
        $new_string = str_replace('{{PLACEHOLDER}}', $field['options'], $new_string);
        $new_string = str_replace('{{DEFAULT}}', $field['default'], $new_string);
        $new_string = str_replace('{{SHORT-NAME}}', $this->short_name, $new_string);
        $new_string = str_replace('{{SHORTNAME}}', strtolower($this->short_name), $new_string);

        return $new_string;
    }

    // TODO: SHORT-CODE-FRONT-END --|--
    /**
     * Modules::ShortCodeFrontEnd()
     * 
     * @param mixed $__field
     * @param string $type
     * @return void
     */
    function ShortCodeFrontEnd($__field = array(), $funcType = '')
    {
        $module_path = IHS_MODULE_DIR . '/short-codes/front-ends/*.mod.php';
        $options = $modules = $module = array();
        foreach (glob($module_path) as $filename)
        {
            $module = null;
            include ($filename);
            $var = md5($module['name']);
            $modules[$var] = $module;
        }
        $ret = null;

        //periksa nama dan type sama
        $module = null;
        foreach ($modules as $module)
        {
            if ($module['name'] == $__field['type'])
            {
                switch ($funcType)
                {
                    case 'shortcode':
                        $ret .= $this->fixShortCodeFrontEnd($__field, $module['shortcode']);
                        break;
                }
            }
        }
        return $ret;
    }


    // TODO: SHORT-CODE-FRONT-END --|-- FIX
    /**
     * Modules::fixShortCodeFrontEnd()
     * 
     * @param mixed $field
     * @param mixed $string
     * @return
     */
    private function fixShortCodeFrontEnd($field, $string)
    {
        $new_string = $string;
        $new_string = str_replace('{{NAME}}', $this->string->toFileName($this->short_name . '-' . $field['name']), $new_string);
        $new_string = str_replace('{{ID}}', $this->string->toFileName($this->short_name . '-' . $field['name']), $new_string);
        $new_string = str_replace('{{VAR}}', $this->string->toVar($field['name']), $new_string);
        $new_string = str_replace('{{LABEL}}', $field['label'], $new_string);
        $new_string = str_replace('{{OPTION}}', $field['option'], $new_string);
        $new_string = str_replace('{{TEXT-DOMAIN}}', $this->textdomain, $new_string);
        $new_string = str_replace('{{TEXTDOMAIN}}', $this->textdomain, $new_string);
        $new_string = str_replace('{{PLACEHOLDER}}', $field['option'], $new_string);
        $new_string = str_replace('{{SHORT-NAME}}', $this->short_name, $new_string);
        $new_string = str_replace('{{SHORTNAME}}', strtolower($this->short_name), $new_string);

        return $new_string;
    }


    // TODO: CUSTOM-FIELDS --|--
    /**
     * Modules::CustomFields()
     * 
     * @param mixed $__field
     * @param string $funcType
     * @return
     */
    function CustomFields($__field = array(), $funcType = '')
    {
        $module_path = IHS_MODULE_DIR . '/custom-fields/*.mod.php';
        $options = $modules = $module = array();
        foreach (glob($module_path) as $filename)
        {
            $module = null;
            include ($filename);
            $var = md5($module['name']);
            $modules[$var] = $module;
        }
        $ret = null;

        //periksa nama dan type sama
        $module = null;
        foreach ($modules as $module)
        {
            if ($module['name'] == $__field['type'])
            {

                switch ($funcType)
                {
                    case 'render_content':
                        $ret .= $this->fixCustomFields($__field, $module['render_content']);
                        break;
                    case 'save_post':
                        $ret .= $this->fixCustomFields($__field, $module['save_post']);
                        break;
                    case 'admin_footer':
                        if (isset($module['admin_footer']))
                        {
                            $ret .= $this->fixCustomFields($__field, $module['admin_footer']);
                        }

                        break;
                    case 'admin_enqueue_scripts':
                        if (isset($module['admin_enqueue_scripts']))
                        {
                            $ret .= $this->fixCustomFields($__field, $module['admin_enqueue_scripts']);
                        }
                        break;
                    case 'dummy':
                        if (isset($module['dummy']))
                        {
                            $ret .= $this->fixCustomFields($__field, $module['dummy']);
                        }
                        break;

                    case 'wp_ajax':
                        if (isset($module['wp_ajax']))
                        {
                            $ret .= $this->fixCustomFields($__field, $module['wp_ajax']);
                        }
                        break;

                    case 'fontend_content':
                        if (isset($module['fontend_content']))
                        {
                            $ret .= $this->fixCustomFields($__field, $module['fontend_content']);
                        }
                        break;

                    case 'fontend_js':
                        if (isset($module['fontend_js']))
                        {
                            $ret .= $this->fixCustomFields($__field, $module['fontend_js']);
                        }
                        break;

                    case 'field_reset':
                        if (isset($module['field_reset']))
                        {
                            $ret .= $this->fixCustomFields($__field, $module['field_reset']);
                        }
                        break;

                }
            }
        }
        return $ret;
    }


    // TODO: CUSTOM-FIELDS --|-- FIX
    /**
     * Modules::fixCustomFields()
     * 
     * @param mixed $field
     * @param mixed $string
     * @return void
     */
    private function fixCustomFields($field, $string)
    {
        $new_string = $string;
        $new_string = str_replace('{{NAME}}', $this->string->toFileName($this->short_name . '-' . $field['name']), $new_string);
        $new_string = str_replace('{{ID}}', $this->string->toFileName($this->short_name . '-' . $field['name']), $new_string);
        $new_string = str_replace('{{VAR}}', $this->string->toVar($this->short_name . '-' . $field['name']), $new_string);
        $new_string = str_replace('{{LABEL}}', $field['label'], $new_string);
        $new_string = str_replace('{{OPTIONS}}', $field['options'], $new_string);
        $new_string = str_replace('{{INFO}}', $field['info'], $new_string);
        $new_string = str_replace('{{TEXT-DOMAIN}}', $this->textdomain, $new_string);
        $new_string = str_replace('{{TEXTDOMAIN}}', $this->textdomain, $new_string);
        $new_string = str_replace('{{PLACEHOLDER}}', $field['options'], $new_string);
        $new_string = str_replace('{{DEFAULT}}', $field['default'], $new_string);
        $new_string = str_replace('{{SHORT-NAME}}', $this->short_name, $new_string);
        $new_string = str_replace('{{SHORTNAME}}', strtolower($this->short_name), $new_string);
        return $new_string;
    }


    // TODO: WIDGET-FRONT-END --|--
    /**
     * Modules::WidgetFrontEnd()
     * 
     * @param mixed $__field
     * @param string $funcType
     * @return
     */
    function WidgetFrontEnd($__field = array(), $funcType = '')
    {
        $ret = null;


        $module_path = IHS_MODULE_DIR . '/widgets/front-ends/*.mod.php';
        $modules = $module = array();
        foreach (glob($module_path) as $filename)
        {
            $module = null;
            include ($filename);
            $var = md5($module['name']);
            $modules[$var] = $module;
        }

        //periksa nama dan type sama
        $module = null;
        foreach ($modules as $module)
        {


            if ($module['name'] == $__field['type'])
            {

                switch ($funcType)
                {
                    case 'widget':
                        if (isset($module['widget']))
                        {

                            $ret .= $this->fixWidgetFrontEnd($__field, $module['widget']);
                        }
                        break;
                }
            }
        }
        return $ret;
    }


    // TODO: WIDGET-FRONT-END --|-- FIX
    /**
     * Modules::fixWidgetFrontEnd()
     * 
     * @param mixed $field
     * @param mixed $string
     * @return void
     */
    private function fixWidgetFrontEnd($field, $string)
    {
        $new_string = $string;
        $new_string = str_replace('{{OPTION}}', $field['option'], $new_string);
        $new_string = str_replace('{{LABEL}}', $field['label'], $new_string);
        $new_string = str_replace('{{SHORT-NAME}}', $this->short_name, $new_string);
        $new_string = str_replace('{{SHORTNAME}}', strtolower($this->short_name), $new_string);
        $new_string = str_replace('{{TEXT-DOMAIN}}', $this->textdomain, $new_string);
        $new_string = str_replace('{{TEXTDOMAIN}}', $this->textdomain, $new_string);
        return $new_string;
    }


    // TODO: WIDGET-OPTION --|--
    /**
     * Modules::WidgetOption()
     * 
     * @param mixed $__field
     * @param string $funcType
     * @return
     */
    function WidgetOption($__field = array(), $funcType = '')
    {
        $module_path = IHS_MODULE_DIR . '/widgets/options/*.mod.php';
        $options = $modules = $module = array();
        foreach (glob($module_path) as $filename)
        {
            $module = null;
            include ($filename);
            $var = md5($module['name']);
            $modules[$var] = $module;
        }
        $ret = null;

        //periksa nama dan type sama
        $module = null;
        foreach ($modules as $module)
        {
            if ($module['name'] == $__field['type'])
            {
                switch ($funcType)
                {
                    case 'form':
                        $ret .= $this->fixWidgetOptions($__field, $module['form']);
                        break;
                    case 'update':
                        $ret .= $this->fixWidgetOptions($__field, $module['update']);
                        break;
                    case 'admin_footer':
                        if (isset($module['admin_footer']))
                        {
                            $ret .= $this->fixWidgetOptions($__field, $module['admin_footer']);
                        }
                        break;
                    case 'admin_enqueue_scripts':
                        if (isset($module['admin_enqueue_scripts']))
                        {
                            $ret .= $this->fixWidgetOptions($__field, $module['admin_enqueue_scripts']);
                        }
                        break;
                }
            }
        }
        return $ret;
    }

    // TODO: WIDGET-OPTION --|-- FIX
    /**
     * Modules::PluginOptions()
     * 
     * @param string $callback
     * @param mixed $__field
     * @param string $type
     * @return void
     */
    function PluginOptions($setting, $page = '', $section = '', $callback = '', $__field = array(), $funcType = '')
    {
        $module_path = IHS_MODULE_DIR . '/plugin-options/*.mod.php';
        $options = $modules = $module = array();
        foreach (glob($module_path) as $filename)
        {
            $module = null;
            include ($filename);
            $var = md5($module['name']);
            $modules[$var] = $module;
        }
        $ret = null;

        //periksa nama dan type sama
        $module = null;
        foreach ($modules as $module)
        {
            if ($module['name'] == $__field['type'])
            {
                switch ($funcType)
                {
                    case 'settings_field':
                        $ret .= $this->fixPluginOptions($setting, $page, $section, $callback, $__field, $module['settings_field']);
                        break;
                    case 'sanitize':
                        $ret .= $this->fixPluginOptions($setting, $page, $section, $callback, $__field, $module['sanitize']);
                        break;
                    case 'callback':
                        $ret .= $this->fixPluginOptions($setting, $page, $section, $callback, $__field, $module['callback']);
                        break;
                    case 'admin_footer':
                        if (isset($module['admin_footer']))
                        {
                            $ret .= $this->fixPluginOptions($setting, $page, $section, $callback, $__field, $module['admin_footer']);
                        }
                        break;
                    case 'admin_enqueue_scripts':
                        if (isset($module['admin_enqueue_scripts']))
                        {
                            $ret .= $this->fixPluginOptions($setting, $page, $section, $callback, $__field, $module['admin_enqueue_scripts']);
                        }
                        break;
                    case 'rest_api_callback':
                        if (isset($module['rest_api_callback']))
                        {
                            $ret .= $this->fixPluginOptions($setting, $page, $section, $callback, $__field, $module['rest_api_callback']);
                        }
                        break;
                }
            }
        }
        return $ret;
    }


    // TODO: PLUGIN-OPTIONS --|--
    /**
     * Modules::fixPluginOptions()
     * 
     * @param string $callback
     * @param string $field
     * @param string $string
     * @return
     */
    private function fixPluginOptions($setting, $page, $section, $callback, $field, $string)
    {
        $new_string = $string;
        $new_string = str_replace('{{NAME}}', $this->string->toFileName($this->short_name . '-' . $field['name']), $new_string);
        $new_string = str_replace('{{ID}}', $this->string->toFileName($this->short_name . '-' . $field['name']), $new_string);
        $new_string = str_replace('{{VAR}}', $this->string->toVar($this->short_name . '-' . $field['name']), $new_string);
        $new_string = str_replace('{{LABEL}}', $field['label'], $new_string);
        $new_string = str_replace('{{OPTIONS}}', $field['options'], $new_string);
        $new_string = str_replace('{{INFO}}', $field['info'], $new_string);
        $new_string = str_replace('{{TEXT-DOMAIN}}', $this->textdomain, $new_string);
        $new_string = str_replace('{{TEXTDOMAIN}}', $this->textdomain, $new_string);
        $new_string = str_replace('{{PLACEHOLDER}}', $field['options'], $new_string);
        $new_string = str_replace('{{DEFAULT}}', $field['default'], $new_string);
        $new_string = str_replace('{{SHORT-NAME}}', $this->short_name, $new_string);
        $new_string = str_replace('{{SHORTNAME}}', strtolower($this->short_name), $new_string);
        $new_string = str_replace('{{CALLBACK}}', $callback, $new_string);
        $new_string = str_replace('{{PAGE}}', $page, $new_string);
        $new_string = str_replace('{{SECTION}}', $section, $new_string);
        $new_string = str_replace('{{SETTING}}', $setting, $new_string);
        return $new_string;
    }

    // TODO: PLUGIN-OPTIONS --|-- FIX
    /**
     * Modules::fixWidgetOptions()
     * 
     * @param mixed $field
     * @param mixed $string
     * @return void
     */
    private function fixWidgetOptions($field, $string)
    {
        $new_string = $string;
        $new_string = str_replace('{{NAME}}', $this->string->toFileName($field['name']), $new_string);
        $new_string = str_replace('{{ID}}', $this->string->toFileName($field['name']), $new_string);
        $new_string = str_replace('{{VAR}}', $this->string->toVar($field['name']), $new_string);
        $new_string = str_replace('{{LABEL}}', $field['label'], $new_string);
        $new_string = str_replace('{{OPTIONS}}', $field['options'], $new_string);
        $new_string = str_replace('{{INFO}}', $field['info'], $new_string);
        $new_string = str_replace('{{TEXT-DOMAIN}}', $this->textdomain, $new_string);
        $new_string = str_replace('{{TEXTDOMAIN}}', $this->textdomain, $new_string);
        $new_string = str_replace('{{PLACEHOLDER}}', $field['options'], $new_string);
        $new_string = str_replace('{{DEFAULT}}', $field['default'], $new_string);
        $new_string = str_replace('{{SHORT-NAME}}', $this->short_name, $new_string);
        $new_string = str_replace('{{SHORTNAME}}', strtolower($this->short_name), $new_string);
        return $new_string;
    }


    // TODO: CONTENT-FRONT-ENDS --|--
    /**
     * Modules::ContentFrontEnd()
     * 
     * @param mixed $__field
     * @param string $funcType
     * @return
     */
    function ContentFrontEnd($__field = array(), $funcType = '')
    {
        $ret = null;


        $module_path = IHS_MODULE_DIR . '/contents/front-ends/*.mod.php';
        $modules = $module = array();
        foreach (glob($module_path) as $filename)
        {
            $module = null;
            include ($filename);
            $var = md5($module['name']);
            $modules[$var] = $module;
        }

        //periksa nama dan type sama
        $module = null;
        foreach ($modules as $module)
        {


            if ($module['name'] == $__field['type'])
            {

                switch ($funcType)
                {
                    case 'singular':
                        if (isset($module['singular']))
                        {

                            $ret .= $this->fixContentFrontEnd($__field, $module['singular']);
                        }
                        break;
                }
            }
        }
        return $ret;
    }


    // TODO: CONTENT-FRONT-ENDS --|-- FIX
    /**
     * Modules::fixContentFrontEnd()
     * 
     * @param mixed $field
     * @param mixed $string
     * @return void
     */
    private function fixContentFrontEnd($field, $string)
    {
        $new_string = $string;
        $new_string = str_replace('{{NAME}}', $this->string->toFileName($field['name']), $new_string);
        $new_string = str_replace('{{ID}}', $this->string->toFileName($field['name']), $new_string);
        $new_string = str_replace('{{VAR}}', $this->string->toVar($field['name']), $new_string);
        $new_string = str_replace('{{OPTION}}', $field['option'], $new_string);
        $new_string = str_replace('{{LABEL}}', $field['label'], $new_string);
        $new_string = str_replace('{{SHORT-NAME}}', $this->short_name, $new_string);
        $new_string = str_replace('{{SHORTNAME}}', strtolower($this->short_name), $new_string);
        $new_string = str_replace('{{TEXT-DOMAIN}}', $this->textdomain, $new_string);
        $new_string = str_replace('{{TEXTDOMAIN}}', $this->textdomain, $new_string);
        return $new_string;
    }


    // TODO: ELEMENTOR-WIDGET-OPTION --|--
    /**
     * Modules::elementorWidget()
     * 
     * @param string $callback
     * @param mixed $__field
     * @param string $type
     * @return void
     */
    function elementorWidgetOption($__field = array(), $funcType = '')
    {
        $module_path = IHS_MODULE_DIR . '/elementor-widgets/options/*.mod.php';
        $options = $modules = $module = array();
        foreach (glob($module_path) as $filename)
        {
            $module = null;
            include ($filename);
            $var = md5($module['name']);
            $modules[$var] = $module;
        }
        $ret = null;

        //periksa nama dan type sama
        $module = null;
        foreach ($modules as $module)
        {
            if ($module['name'] == $__field['type'])
            {
                switch ($funcType)
                {
                    case 'register_control':
                        $ret .= $this->fixElementorWidgetOption($__field, $module['register_control']);
                        break;
                }
            }
        }
        return $ret;
    }


    // TODO: ELEMENTOR-WIDGET-OPTION --|-- FIX
    /**
     * Modules::fixElementorWidget()
     * 
     * @param mixed $field
     * @param mixed $string
     * @return void
     */
    private function fixElementorWidgetOption($field, $string)
    {
        $new_string = $string;
        $new_string = str_replace('{{NAME}}', $this->string->toFileName($field['name']), $new_string);
        $new_string = str_replace('{{ID}}', $this->string->toFileName($field['name']), $new_string);
        $new_string = str_replace('{{VAR}}', $this->string->toVar($field['name']), $new_string);
        $new_string = str_replace('{{OPTION}}', $field['options'], $new_string);
        $new_string = str_replace('{{PLACEHOLDER}}', $field['options'], $new_string);
        $new_string = str_replace('{{LABEL}}', $field['label'], $new_string);
        $new_string = str_replace('{{SHORT-NAME}}', $this->short_name, $new_string);
        $new_string = str_replace('{{SHORTNAME}}', strtolower($this->short_name), $new_string);
        $new_string = str_replace('{{TEXT-DOMAIN}}', $this->textdomain, $new_string);
        $new_string = str_replace('{{TEXTDOMAIN}}', $this->textdomain, $new_string);
        $new_string = str_replace('{{DEFAULT}}', $field['default'], $new_string);
        return $new_string;
    }


    // TODO: ELEMENTOR-WIDGET-FRONT-END --|--
    /**
     * Modules::ElementorWidgetFrontEnd()
     * 
     * @param mixed $__field
     * @param string $funcType
     * @return
     */
    function ElementorWidgetFrontEnd($__field = array(), $funcType = '')
    {
        $ret = null;


        $module_path = IHS_MODULE_DIR . '/elementor-widgets/front-ends/*.mod.php';
        $modules = $module = array();
        foreach (glob($module_path) as $filename)
        {
            $module = null;
            include ($filename);
            $var = md5($module['name']);
            $modules[$var] = $module;
        }

        //periksa nama dan type sama
        $module = null;
        foreach ($modules as $module)
        {


            if ($module['name'] == $__field['type'])
            {

                switch ($funcType)
                {
                    case 'render':
                        if (isset($module['render']))
                        {

                            $ret .= $this->fixElementorWidgetFrontEnd($__field, $module['render']);
                        }
                        break;
                }
            }
        }
        return $ret;
    }


    // TODO: ELEMENTOR-WIDGET-FRONT-END --|-- FIX
    /**
     * Modules::fixElementorWidgetFrontEnd()
     * 
     * @param mixed $field
     * @param mixed $string
     * @return void
     */
    private function fixElementorWidgetFrontEnd($field, $string)
    {
        $new_string = $string;
        $new_string = str_replace('{{OPTION}}', $field['option'], $new_string);
        $new_string = str_replace('{{LABEL}}', $field['label'], $new_string);
        $new_string = str_replace('{{SHORT-NAME}}', $this->short_name, $new_string);
        $new_string = str_replace('{{SHORTNAME}}', strtolower($this->short_name), $new_string);
        $new_string = str_replace('{{TEXT-DOMAIN}}', $this->textdomain, $new_string);
        $new_string = str_replace('{{TEXTDOMAIN}}', $this->textdomain, $new_string);
        return $new_string;
    }


    // TODO: WPBAKERY-PAGE-BUILDER-ATTRIBUTES --|--
    /**
     * Modules::wpbakeryPageBuilderAttributes()
     * 
     * @param string $callback
     * @param mixed $__field
     * @param string $type
     * @return void
     */
    function wpbakeryPageBuilderAttributes($__field = array(), $funcType = '')
    {
        $module_path = IHS_MODULE_DIR . '/wpbakery-page-builders/attributes/*.mod.php';
        $options = $modules = $module = array();
        foreach (glob($module_path) as $filename)
        {
            $module = null;
            include ($filename);
            $var = md5($module['name']);
            $modules[$var] = $module;
        }
        $ret = null;

        //periksa nama dan type sama
        $module = null;
        foreach ($modules as $module)
        {
            if ($module['name'] == $__field['type'])
            {
                switch ($funcType)
                {
                    case 'param':
                        $ret .= $this->fixWpbakeryPageBuilderAttributes($__field, $module['param']);
                        break;
                }
            }
        }
        return $ret;
    }


    // TODO: WPBAKERY-PAGE-BUILDER-ATTRIBUTES --|-- FIX
    /**
     * Modules::fixWpbakeryPageBuilderAttributes()
     * 
     * @param mixed $field
     * @param mixed $string
     * @return void
     */
    private function fixWpbakeryPageBuilderAttributes($field, $string)
    {
        $new_string = $string;
        $new_string = str_replace('{{NAME}}', $this->string->toFileName($field['name']), $new_string);
        $new_string = str_replace('{{ID}}', $this->string->toFileName($field['name']), $new_string);
        $new_string = str_replace('{{VAR}}', $this->string->toVar($field['name']), $new_string);
        $new_string = str_replace('{{OPTION}}', $field['options'], $new_string);
        $new_string = str_replace('{{PLACEHOLDER}}', $field['options'], $new_string);
        $new_string = str_replace('{{LABEL}}', $field['label'], $new_string);
        $new_string = str_replace('{{SHORT-NAME}}', $this->short_name, $new_string);
        $new_string = str_replace('{{SHORTNAME}}', strtolower($this->short_name), $new_string);
        $new_string = str_replace('{{TEXT-DOMAIN}}', $this->textdomain, $new_string);
        $new_string = str_replace('{{TEXTDOMAIN}}', $this->textdomain, $new_string);
        $new_string = str_replace('{{DEFAULT}}', $field['default'], $new_string);
        $new_string = str_replace('{{INFO}}', $field['info'], $new_string);
        return $new_string;
    }


    // TODO: WPBAKERY-PAGE-BUILDER-SHORTCODES --|--
    /**
     * Modules::wpbakeryPageBuilderShortcodes()
     * 
     * @param string $callback
     * @param mixed $__field
     * @param string $type
     * @return void
     */
    function wpbakeryPageBuilderShortcodes($__field = array(), $funcType = '')
    {
        $module_path = IHS_MODULE_DIR . '/wpbakery-page-builders/front-ends/*.mod.php';
        $options = $modules = $module = array();
        foreach (glob($module_path) as $filename)
        {
            $module = null;
            include ($filename);
            $var = md5($module['name']);
            $modules[$var] = $module;
        }
        $ret = null;

        //periksa nama dan type sama
        $module = null;
        foreach ($modules as $module)
        {
            if ($module['name'] == $__field['type'])
            {
                switch ($funcType)
                {
                    case 'shortcode':
                        $ret .= $this->fixWpbakeryPageBuilderShortcodes($__field, $module['shortcode']);
                        break;
                }
            }
        }
        return $ret;
    }


    // TODO: WPBAKERY-PAGE-BUILDER-SHORTCODES --|-- FIX
    /**
     * Modules::fixWpbakeryPageBuilderShortcodes()
     * 
     * @param mixed $field
     * @param mixed $string
     * @return void
     */
    private function fixWpbakeryPageBuilderShortcodes($field, $string)
    {
        $new_string = $string;
        $new_string = str_replace('{{NAME}}', $this->string->toFileName($field['name']), $new_string);
        $new_string = str_replace('{{ID}}', $this->string->toFileName($field['name']), $new_string);
        $new_string = str_replace('{{VAR}}', $this->string->toVar($field['name']), $new_string);
        $new_string = str_replace('{{OPTION}}', $field['option'], $new_string);
        $new_string = str_replace('{{LABEL}}', $field['label'], $new_string);
        $new_string = str_replace('{{SHORT-NAME}}', $this->short_name, $new_string);
        $new_string = str_replace('{{SHORTNAME}}', strtolower($this->short_name), $new_string);
        $new_string = str_replace('{{TEXT-DOMAIN}}', $this->textdomain, $new_string);
        $new_string = str_replace('{{TEXTDOMAIN}}', $this->textdomain, $new_string);
        return $new_string;
    }


    // TODO: WOO-SETTINGS --|--
    /**
     * Modules::wooSetting()
     * 
     * @param string $callback
     * @param mixed $__field
     * @param string $type
     * @return void
     */
    function wooSetting($__field = array(), $funcType = '')
    {
        $module_path = IHS_MODULE_DIR . '/woo-settings/fields/*.mod.php';
        $options = $modules = $module = array();
        foreach (glob($module_path) as $filename)
        {
            $module = null;
            include ($filename);
            $var = md5($module['name']);
            $modules[$var] = $module;
        }
        $ret = null;

        //periksa nama dan type sama
        $module = null;
        foreach ($modules as $module)
        {
            if ($module['name'] == $__field['type'])
            {
                switch ($funcType)
                {
                    case 'fields':
                        $ret .= $this->fixWooSetting($__field, $module['fields']);
                        break;
                }
            }
        }
        return $ret;
    }


    // TODO: WOO-SETTINGS --|-- FIX
    /**
     * Modules::fixWooSetting()
     * 
     * @param mixed $field
     * @param mixed $string
     * @return void
     */
    private function fixWooSetting($field, $string)
    {
        $new_string = $string;
        $new_string = str_replace('{{NAME}}', $this->string->toFileName($field['name']), $new_string);
        $new_string = str_replace('{{ID}}', $this->string->toFileName($field['name']), $new_string);
        $new_string = str_replace('{{VAR}}', $this->string->toVar($field['name']), $new_string);
        $new_string = str_replace('{{OPTIONS}}', $field['options'], $new_string);
        $new_string = str_replace('{{LABEL}}', $field['label'], $new_string);
        $new_string = str_replace('{{SHORT-NAME}}', strtolower($this->short_name), $new_string);
        $new_string = str_replace('{{SHORTNAME}}', strtolower($this->short_name), $new_string);
        $new_string = str_replace('{{TEXT-DOMAIN}}', $this->textdomain, $new_string);
        $new_string = str_replace('{{TEXTDOMAIN}}', $this->textdomain, $new_string);
        $new_string = str_replace('{{INFO}}', $field['info'], $new_string);
        $new_string = str_replace('{{PLACEHOLDER}}', $field['options'], $new_string);
        $new_string = str_replace('{{DEFAULT}}', $field['default'], $new_string);

        return $new_string;
    }


    // TODO: WOO-CHECKOUT-FIELD --|--
    /**
     * Modules::wooCheckoutField()
     * 
     * @param string $callback
     * @param mixed $__field
     * @param string $type
     * @return void
     */
    function wooCheckoutField($__field = array(), $funcType = '')
    {
        $module_path = IHS_MODULE_DIR . '/woo-checkout-fields/fields/*.mod.php';
        $options = $modules = $module = array();
        foreach (glob($module_path) as $filename)
        {
            $module = null;
            include ($filename);
            $var = md5($module['name']);
            $modules[$var] = $module;
        }
        $ret = null;

        //periksa nama dan type sama
        $module = null;
        foreach ($modules as $module)
        {
            if ($module['name'] == $__field['type'])
            {
                switch ($funcType)
                {
                    case 'checkout_fields':
                        $ret .= $this->fixWooCheckoutField($__field, $module['checkout_fields']);
                        break;
                    case 'admin_order_data':
                        $ret .= $this->fixWooCheckoutField($__field, $module['admin_order_data']);
                        break;
                    case 'update_order_meta':
                        $ret .= $this->fixWooCheckoutField($__field, $module['update_order_meta']);
                        break;
                }
            }
        }
        return $ret;
    }


    // TODO: WOO-CHECKOUT-FIELD --|-- FIX
    /**
     * Modules::fixWooCheckoutField()
     * 
     * @param mixed $field
     * @param mixed $string
     * @return void
     */
    private function fixWooCheckoutField($field, $string)
    {
        $new_string = $string;
        $new_string = str_replace('{{NAME}}', $this->string->toFileName($field['name']), $new_string);
        $new_string = str_replace('{{ID}}', $this->string->toFileName($field['name']), $new_string);
        $new_string = str_replace('{{VAR}}', $this->string->toVar($field['name']), $new_string);
        $new_string = str_replace('{{OPTIONS}}', $field['options'], $new_string);
        $new_string = str_replace('{{LABEL}}', $field['label'], $new_string);
        $new_string = str_replace('{{SHORT-NAME}}', strtolower($this->short_name), $new_string);
        $new_string = str_replace('{{SHORTNAME}}', strtolower($this->short_name), $new_string);
        $new_string = str_replace('{{TEXT-DOMAIN}}', $this->textdomain, $new_string);
        $new_string = str_replace('{{TEXTDOMAIN}}', $this->textdomain, $new_string);
        $new_string = str_replace('{{INFO}}', $field['info'], $new_string);
        $new_string = str_replace('{{PLACEHOLDER}}', $field['options'], $new_string);
        $new_string = str_replace('{{DEFAULT}}', $field['default'], $new_string);
        return $new_string;
    }


}

?>