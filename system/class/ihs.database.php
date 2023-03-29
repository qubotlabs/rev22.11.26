<?php

/**
 * @author Jasman
 * @copyright Ihsana Global Solusindo 2022
 * @package iWpDev
 * @license Commercial License
 */

defined("IHS_EXEC") or die("Silence is golden");

class DB
{

    // TODO: ==========================
    // TODO: PROJECT
    // TODO: PROJECT --|-- saveProject
    /**
     * DB::saveProject()
     * 
     * @return void
     */
    function saveProject($data)
    {
        $app_prefix = $this->toFileName($data['project-name']);
        if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
        {
            mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
        }
        $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/project.json';
        $new_data = $data;
        $new_data['prefix'] = $app_prefix;

        if (isset($new_data['debugger']))
        {
            $new_data['debugger'] = true;
        } else
        {
            $new_data['debugger'] = false;
        }

        if (isset($new_data['show-file-line']))
        {
            $new_data['show-file-line'] = true;
        } else
        {
            $new_data['show-file-line'] = false;
        }


        $this->putContents($file_name, json_encode($new_data));
    }


    // TODO: PROJECT --|-- getProject
    /**
     * DB::getProject()
     * 
     * @return void
     */
    function getProject()
    {
        if (isset($_SESSION['CURRENT_PROJECT_DATA']))
        {
            $data = $_SESSION['CURRENT_PROJECT_DATA'];
            return $data['project'];
        } else
        {
            return null;
        }

    }


    // TODO: PROJECT --|-- getProjects
    /**
     * DB::getProjects()
     * 
     * @return
     */
    function getProjects()
    {
        $projects = array();
        foreach (glob(IHS_PROJECT_DIR . "/*/project.json") as $filename)
        {
            $projects[] = json_decode(file_get_contents($filename), true);
        }

        return $projects;
    }


    // TODO: PROJECT --|-- deleteProject
    /**
     * DB::deleteProject($project_name)
     * 
     * @return
     */
    function deleteProject($project_name = null)
    {
        if ($project_name == null)
        {
            $project_name = $_SESSION['CURRENT_PROJECT_PREFIX'];
        }
        foreach (glob(IHS_PROJECT_DIR . '/' . $project_name . '/*') as $filename)
        {
            $this->unLinkFile($filename);
        }
        rmdir(IHS_PROJECT_DIR . '/' . $project_name);

    }

    // TODO: ==========================
    // TODO: README
    // TODO: README --|-- saveReadMe
    /**
     * DB::saveReadMe()
     * 
     * @param mixed $data
     * @return void
     */
    function saveReadMe($data)
    {
        $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
        if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
        {
            mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
        }
        $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/readme.json';
        $new_data = $data;
        $new_data['prefix'] = $app_prefix;
        $this->putContents($file_name, json_encode($new_data));
    }


    // TODO: README --|-- getReadMe
    /**
     * DB::getReadMe()
     * 
     * @return
     */

    function getReadMe()
    {
        if (isset($_SESSION['CURRENT_PROJECT_DATA']))
        {
            $data = $_SESSION['CURRENT_PROJECT_DATA'];
            if (!isset($data['readme']))
            {
                $data['readme'] = array();
            }
            return $data['readme'];
        } else
        {
            return array();
        }
    }


    // TODO: ==========================
    // TODO: ROLES
    // TODO: ROLES --|-- saveRoles
    /**
     * DB::saveRoles()
     * 
     * @param mixed $data
     * @return void
     */
    function saveRoles($data)
    {
        if ($data['name'] != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $new_data = $data;
            $new_data['name'] = $this->toFileName($data['name']);
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/roles.' . $new_data['name'] . '.json';

            $this->putContents($file_name, json_encode($new_data));
        }
    }


    // TODO: ROLES --|-- getRoles
    /**
     * DB::getRoles()
     * 
     * @return
     */

    function getRoles()
    {
        if (isset($_SESSION['CURRENT_PROJECT_DATA']))
        {
            $data = $_SESSION['CURRENT_PROJECT_DATA'];
            if (!isset($data['roles']))
            {
                $data['roles'] = array();
            }
            return $data['roles'];
        } else
        {
            return array();
        }
    }

    // TODO: ROLES --|-- getRole
    /**
     * DB::getRole()
     * 
     * @return
     */

    function getRole($name)
    {
        $data = array();
        if ($name != '')
        {
            $rawData = $_SESSION['CURRENT_PROJECT_DATA'];
            if (isset($rawData['roles'][$name]))
            {
                $data = $rawData['roles'][$name];
            }
        }
        return $data;
    }

    // TODO: ROLES --|-- removeRole
    /**
     * DB::removeRole()
     * 
     * @return
     */

    function removeRole($name)
    {
        if ($name != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/roles.' . basename($name) . '.json';
            $this->unLinkFile($file_name);
        }
    }


    // TODO: ==========================
    // TODO: IMAGESIZE
    // TODO: IMAGESIZE --|-- saveImageSize
    /**
     * DB::saveImageSize()
     * 
     * @param mixed $data
     * @return void
     */
    function saveImageSize($data)
    {
        if ($data['name'] != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $new_data = $data;
            $new_data['name'] = $this->toFileName($data['name']);

            if (isset($data['crop']))
            {
                $new_data['crop'] = true;
            } else
            {
                $new_data['crop'] = false;
            }
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/image-sizes.' . $new_data['name'] . '.json';

            $this->putContents($file_name, json_encode($new_data));
        }
    }


    // TODO: IMAGESIZE --|-- getImageSizes
    /**
     * DB::getImageSizes()
     * 
     * @return
     */

    function getImageSizes()
    {
        if (isset($_SESSION['CURRENT_PROJECT_DATA']))
        {
            $data = $_SESSION['CURRENT_PROJECT_DATA'];
            if (!isset($data['image-sizes']))
            {
                $data['image-sizes'] = array();
            }
            return $data['image-sizes'];
        } else
        {
            return array();
        }
    }

    // TODO: IMAGESIZE --|-- getImageSize
    /**
     * DB::getImageSize()
     * 
     * @return
     */

    function getImageSize($name)
    {
        $data = array();
        if ($name != '')
        {
            $rawData = $_SESSION['CURRENT_PROJECT_DATA'];
            if (isset($rawData['image-sizes'][$name]))
            {
                $data = $rawData['image-sizes'][$name];
            }
        }
        return $data;
    }

    // TODO: IMAGESIZE --|-- removeImageSize
    /**
     * DB::removeImageSize()
     * 
     * @return
     */

    function removeImageSize($name)
    {
        if ($name != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/image-sizes.' . basename($name) . '.json';
            $this->unLinkFile($file_name);
        }
    }


    // TODO: ==========================
    // TODO: ENQUEUESCRIPTS
    // TODO: ENQUEUESCRIPTS --|-- saveEnqueueScripts
    /**
     * DB::saveEnqueueScripts()
     * 
     * @param mixed $data
     * @return void
     */
    function saveEnqueueScripts($data)
    {
        if ($data['name'] != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $new_data = $data;
            $new_data['name'] = $this->toFileName($data['name']);

            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/enqueue-scripts.' . $new_data['name'] . '.json';
            $this->putContents($file_name, json_encode($new_data));
        }
    }


    // TODO: ENQUEUESCRIPTS --|-- getEnqueueScripts()
    /**
     * DB::getEnqueueScripts()
     * 
     * @return
     */

    function getEnqueueScripts()
    {
        if (isset($_SESSION['CURRENT_PROJECT_DATA']))
        {
            $data = $_SESSION['CURRENT_PROJECT_DATA'];
            if (!isset($data['enqueue-scripts']))
            {
                $data['enqueue-scripts'] = array();
            }
            return $data['enqueue-scripts'];
        } else
        {
            return array();
        }
    }

    // TODO: ENQUEUESCRIPTS --|-- getEnqueueScript
    /**
     * DB::getEnqueueScript()
     * 
     * @return
     */

    function getEnqueueScript($name)
    {
        $data = array();
        if ($name != '')
        {
            $rawData = $_SESSION['CURRENT_PROJECT_DATA'];
            if (isset($rawData['enqueue-scripts'][$name]))
            {
                $data = $rawData['enqueue-scripts'][$name];
            }
        }
        return $data;
    }

    // TODO: ENQUEUESCRIPTS --|-- removeEnqueueScript
    /**
     * DB::removeEnqueueScript()
     * 
     * @return
     */

    function removeEnqueueScript($name)
    {
        if ($name != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/enqueue-scripts.' . basename($name) . '.json';
            $this->unLinkFile($file_name);
        }
    }


    // TODO: ==========================
    // TODO: ENQUEUESTYLES
    // TODO: ENQUEUESTYLES --|-- saveEnqueueStyle
    /**
     * DB::saveEnqueueStyle()
     * 
     * @param mixed $data
     * @return void
     */
    function saveEnqueueStyle($data)
    {
        if ($data['name'] != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $new_data = $data;
            $new_data['name'] = $this->toFileName($data['name']);

            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/enqueue-styles.' . $new_data['name'] . '.json';
            $this->putContents($file_name, json_encode($new_data));
        }
    }


    // TODO: ENQUEUESTYLES --|-- getEnqueueStyles()
    /**
     * DB::getEnqueueStyles()
     * 
     * @return
     */

    function getEnqueueStyles()
    {
        if (isset($_SESSION['CURRENT_PROJECT_DATA']))
        {
            $data = $_SESSION['CURRENT_PROJECT_DATA'];
            if (!isset($data['enqueue-styles']))
            {
                $data['enqueue-styles'] = array();
            }
            return $data['enqueue-styles'];
        } else
        {
            return array();
        }
    }

    // TODO: ENQUEUESTYLES --|-- getEnqueueStyle
    /**
     * DB::getEnqueueStyle()
     * 
     * @return
     */

    function getEnqueueStyle($name)
    {
        $data = array();
        if ($name != '')
        {
            $rawData = $_SESSION['CURRENT_PROJECT_DATA'];
            if (isset($rawData['enqueue-styles'][$name]))
            {
                $data = $rawData['enqueue-styles'][$name];
            }
        }
        return $data;
    }

    // TODO: ENQUEUESTYLES --|-- removeEnqueueStyle
    /**
     * DB::removeEnqueueScript()
     * 
     * @return
     */

    function removeEnqueueStyle($name)
    {
        if ($name != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/enqueue-styles.' . basename($name) . '.json';
            $this->unLinkFile($file_name);
        }
    }


    // TODO: ==========================
    // TODO: CUSTOM-POSTS

    // TODO: CUSTOM-POSTS --|-- saveCustomPost
    /**
     * DB::saveCustomPost()
     * 
     * @param mixed $data
     * @return void
     */
    function saveCustomPost($data)
    {
        if ($data['name'] != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $new_data = $data;
            $new_data['name'] = $this->toFileName($data['name']);

            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/custom-posts.' . $new_data['name'] . '.json';

            $this->putContents($file_name, json_encode($new_data));
        }
    }


    // TODO: CUSTOM-POSTS --|-- removeCustomPosts
    /**
     * DB::removeCustomPosts()
     * 
     * @return
     */

    function removeCustomPosts($name)
    {
        if ($name != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/custom-posts.' . basename($name) . '.json';
            $this->unLinkFile($file_name);
        }
    }


    // TODO: CUSTOM-POSTS --|-- getCustomPosts
    /**
     * DB::getCustomPosts()
     * 
     * @return
     */

    function getCustomPosts()
    {
        if (isset($_SESSION['CURRENT_PROJECT_DATA']))
        {
            $data = $_SESSION['CURRENT_PROJECT_DATA'];
            if (!isset($data['custom-posts']))
            {
                $data['custom-posts'] = array();
            }
            return $data['custom-posts'];
        } else
        {
            return array();
        }
    }

    // TODO: CUSTOM-POSTS --|-- getCustomPost
    /**
     * DB::getCustomPost()
     * 
     * @return
     */

    function getCustomPost($name)
    {
        $data = array();
        if ($name != '')
        {
            $rawData = $_SESSION['CURRENT_PROJECT_DATA'];
            if (isset($rawData['custom-posts'][$name]))
            {
                $data = $rawData['custom-posts'][$name];
            }
        }
        return $data;
    }


    // TODO: ==========================
    // TODO: TAXONOMIES
    // TODO: TAXONOMIES --|-- saveTaxonomies
    /**
     * DB::saveTaxonomies()
     * 
     * @param mixed $data
     * @return void
     */
    function saveTaxonomies($data)
    {
        if ($data['name'] != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $new_data = $data;
            $new_data['name'] = $this->toFileName($data['name']);
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/taxonomies.' . $new_data['name'] . '.json';

            $this->putContents($file_name, json_encode($new_data));
        }
    }


    // TODO: TAXONOMIES --|-- getTaxonomies
    /**
     * DB::getTaxonomies()
     * 
     * @return
     */

    function getTaxonomies()
    {
        if (isset($_SESSION['CURRENT_PROJECT_DATA']))
        {
            $data = $_SESSION['CURRENT_PROJECT_DATA'];
            if (!isset($data['taxonomies']))
            {
                $data['taxonomies'] = array();
            }
            return $data['taxonomies'];
        } else
        {
            return array();
        }
    }

    // TODO: TAXONOMIES --|-- getTaxonomy
    /**
     * DB::getTaxonomy()
     * 
     * @return
     */

    function getTaxonomy($name)
    {
        $data = array();
        if ($name != '')
        {
            $rawData = $_SESSION['CURRENT_PROJECT_DATA'];
            if (isset($rawData['taxonomies'][$name]))
            {
                $data = $rawData['taxonomies'][$name];
            }
        }
        return $data;
    }

    // TODO: TAXONOMIES --|-- removeTaxonomy
    /**
     * DB::removeTaxonomy()
     * 
     * @return
     */

    function removeTaxonomy($name)
    {
        if ($name != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/taxonomies.' . basename($name) . '.json';
            $this->unLinkFile($file_name);
        }
    }


    // TODO: ==========================
    // TODO: EXTRA-FIELDS
    // TODO: EXTRA-FIELDS --|-- saveMetaBoxes
    /**
     * DB::saveMetaBoxes()
     * 
     * @param mixed $data
     * @return void
     */
    function saveMetaBoxes($data)
    {
        if ($data['name'] != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $new_data = $data;
            $new_data['name'] = $this->toFileName($data['name']);
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/meta-boxes.' . $new_data['name'] . '.json';

            $this->putContents($file_name, json_encode($new_data));
        }
    }


    // TODO: EXTRA-FIELDS --|-- getMetaBoxes
    /**
     * DB::getMetaBoxes()
     * 
     * @return
     */

    function getMetaBoxes()
    {
        if (isset($_SESSION['CURRENT_PROJECT_DATA']))
        {
            $data = $_SESSION['CURRENT_PROJECT_DATA'];
            if (!isset($data['meta-boxes']))
            {
                $data['meta-boxes'] = array();
            }
            return $data['meta-boxes'];
        } else
        {
            return array();
        }
    }

    // TODO: EXTRA-FIELDS --|-- getMetaBox
    /**
     * DB::getMetaBox()
     * 
     * @return
     */

    function getMetaBox($name)
    {
        $data = array();
        if ($name != '')
        {
            $rawData = $_SESSION['CURRENT_PROJECT_DATA'];
            if (isset($rawData['meta-boxes'][$name]))
            {
                $data = $rawData['meta-boxes'][$name];
            }
        }
        return $data;
    }

    // TODO: EXTRA-FIELDS --|-- removeMetaBox
    /**
     * DB::removeMetaBox()
     * 
     * @return
     */

    function removeMetaBox($name)
    {
        if ($name != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/meta-boxes.' . basename($name) . '.json';
            $this->unLinkFile($file_name);
        }
    }


    // TODO: ==========================
    // TODO: EXTRA-FIELDS
    // TODO: EXTRA-FIELDS --|-- saveExtraFields
    /**
     * DB::saveExtraFields()
     * 
     * @param mixed $data
     * @return void
     */
    function saveExtraFields($data)
    {
        if ($data['name'] != '')
        {
            $name = $this->toFileName($data['name']);
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $new_data = $data;
            $new_data['name'] = $name;
            if (!isset($new_data['taxonomies']))
            {
                $new_data['taxonomies'] = array();
            }

            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/extra-fields.' . $new_data['name'] . '.json';
            $this->putContents($file_name, json_encode($new_data));
        }
    }


    // TODO: EXTRA-FIELDS --|-- getExtraFields
    /**
     * DB::getExtraFields()
     * 
     * @return
     */

    function getExtraFields()
    {
        if (isset($_SESSION['CURRENT_PROJECT_DATA']))
        {
            $data = $_SESSION['CURRENT_PROJECT_DATA'];
            if (!isset($data['extra-fields']))
            {
                $data['extra-fields'] = array();
            }
            return $data['extra-fields'];
        } else
        {
            return array();
        }
    }

    // TODO: EXTRA-FIELDS --|-- getExtraField
    /**
     * DB::getExtraField()
     * 
     * @return
     */

    function getExtraField($name)
    {
        $data = array();
        if ($name != '')
        {
            $rawData = $_SESSION['CURRENT_PROJECT_DATA'];
            if (isset($rawData['extra-fields'][$name]))
            {
                $data = $rawData['extra-fields'][$name];
            }
        }
        return $data;
    }

    // TODO: EXTRA-FIELDS --|-- removeExtraField
    /**
     * DB::removeExtraField()
     * 
     * @return
     */

    function removeExtraField($name)
    {
        if ($name != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/extra-fields.' . basename($name) . '.json';
            $this->unLinkFile($file_name);
        }
    }

    // TODO: ==========================
    // TODO: WIDGETS
    // TODO: WIDGETS --|-- saveWidget
    /**
     * DB::saveWidget()
     * 
     * @param mixed $data
     * @return void
     */
    function saveWidget($data)
    {
        if ($data['name'] != '')
        {
            $project = $this->getProject();
            $version = $project['version'];

            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $new_data = $data;
            $new_data['name'] = $this->toFileName($data['name']);

            if (isset($new_data['enqueue_scripts']['scripts']))
            {
                $script = null;
                $script['name'] = $new_data['name'] . '-widget';
                $script['src'] = 'assets/js/' . $new_data['name'] . "-widget.js";
                $script['note'] = '[AUTO] Generated by: Widgets';
                $script['ver'] = $version;
                $script['in_footer'] = true;
                $script['interface'] = "front-end";
                $script['deps'] = array('jquery');
                $script['hooks'] = array();
                $this->saveEnqueueScripts($script);
            } else
            {
                $this->removeEnqueueScript($new_data['name'] . '-widget');
            }
            if (isset($new_data['enqueue_scripts']['styles']))
            {
                $script = null;
                $script['name'] = $new_data['name'] . '-widget';
                $script['src'] = 'assets/css/' . $new_data['name'] . "-widget.css";
                $script['interface'] = "front-end";
                $script['note'] = '[AUTO] Generated by: Widgets';
                $script['ver'] = $version;
                $script['media'] = "all";
                $script['deps'] = array();
                $script['hooks'] = array();
                $this->saveEnqueueStyle($script);
            } else
            {
                $this->removeEnqueueStyle($new_data['name'] . '-widget');
            }
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/widgets.' . $new_data['name'] . '.json';
            $this->putContents($file_name, json_encode($new_data));
        }
    }


    // TODO: WIDGETS --|-- getWidgets
    /**
     * DB::getWidgets()
     * 
     * @return
     */

    function getWidgets()
    {
        if (isset($_SESSION['CURRENT_PROJECT_DATA']))
        {
            $data = $_SESSION['CURRENT_PROJECT_DATA'];
            if (!isset($data['widgets']))
            {
                $data['widgets'] = array();
            }
            return $data['widgets'];
        } else
        {
            return array();
        }
    }

    // TODO: WIDGETS --|-- getWidget
    /**
     * DB::getWidget()
     * 
     * @return
     */

    function getWidget($name)
    {
        $data = array();
        if ($name != '')
        {
            $rawData = $_SESSION['CURRENT_PROJECT_DATA'];
            if (isset($rawData['widgets'][$name]))
            {
                $data = $rawData['widgets'][$name];
            }
        }
        return $data;
    }

    // TODO: WIDGETS --|-- removeWidget
    /**
     * DB::removeWidget()
     * 
     * @return
     */

    function removeWidget($name)
    {
        if ($name != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/widgets.' . basename($name) . '.json';
            $this->unLinkFile($file_name);

            $this->removeEnqueueScript($name . '-widget');
            $this->removeEnqueueStyle($name . '-widget');

        }
    }

    // TODO: ==========================
    // TODO: PLUGIN-OPTIONS
    // TODO: PLUGIN-OPTIONS --|-- savePluginOption
    /**
     * DB::saveOption()
     * 
     * @param mixed $data
     * @return void
     */
    function savePluginOption($data)
    {
        if ($data['name'] != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $new_data = $data;
            $new_data['name'] = $this->toFileName($data['name']);

            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/plugin-options.' . $new_data['name'] . '.json';
            $this->putContents($file_name, json_encode($new_data));
        }
    }


    // TODO: PLUGIN-OPTIONS --|-- getPluginOptions
    /**
     * DB::getOptions()
     * 
     * @return
     */

    function getPluginOptions()
    {
        if (isset($_SESSION['CURRENT_PROJECT_DATA']))
        {
            $data = $_SESSION['CURRENT_PROJECT_DATA'];
            if (!isset($data['plugin-options']))
            {
                $data['plugin-options'] = array();
            }
            return $data['plugin-options'];
        } else
        {
            return array();
        }
    }

    // TODO: PLUGIN-OPTIONS --|-- getPluginOption
    /**
     * DB::getOption()
     * 
     * @return
     */

    function getPluginOption($name)
    {
        $data = array();
        if ($name != '')
        {
            $rawData = $_SESSION['CURRENT_PROJECT_DATA'];
            if (isset($rawData['plugin-options'][$name]))
            {
                $data = $rawData['plugin-options'][$name];
            }
        }
        return $data;
    }


    // TODO: PLUGIN-OPTIONS --|-- removeOption
    /**
     * DB::removeOption()
     * 
     * @return
     */

    function removePluginOption($name)
    {
        if ($name != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/plugin-options.' . basename($name) . '.json';
            $this->unLinkFile($file_name);
        }
    }


    // TODO: ==========================
    // TODO: SHORT-CODES
    // TODO: SHORT-CODES --|-- saveShortCode
    /**
     * DB::saveShortCodes()
     * 
     * @param mixed $data
     * @return void
     */
    function saveShortCode($data)
    {
        if ($data['name'] != '')
        {
            $project = $this->getProject();
            $version = $project['version'];

            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $new_data = $data;
            $new_data['name'] = $this->toFileName($data['name']);

            if (isset($new_data['enqueue_scripts']['scripts']))
            {
                $script = null;
                $script['name'] = $new_data['name'] . '-shortcode';
                $script['src'] = 'assets/js/' . $new_data['name'] . "-shortcode.js";
                $script['note'] = '[AUTO] Generated by: Short-codes';
                $script['ver'] = $version;
                $script['in_footer'] = true;
                $script['interface'] = "front-end";
                $script['deps'] = array('jquery');
                $script['hooks'] = array();
                $this->saveEnqueueScripts($script);
            } else
            {
                $this->removeEnqueueScript($new_data['name']);
            }
            if (isset($new_data['enqueue_scripts']['styles']))
            {
                $script = null;
                $script['name'] = $new_data['name'] . '-shortcode';
                $script['src'] = 'assets/css/' . $new_data['name'] . "-shortcode.css";
                $script['interface'] = "front-end";
                $script['note'] = '[AUTO] Generated by: Short-codes';
                $script['ver'] = $version;
                $script['media'] = "all";
                $script['deps'] = array();
                $script['hooks'] = array();
                $this->saveEnqueueStyle($script);
            } else
            {
                $this->removeEnqueueStyle($new_data['name']);
            }


            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/short-codes.' . $new_data['name'] . '.json';
            $this->putContents($file_name, json_encode($new_data));
        }
    }


    // TODO: SHORT-CODES --|-- getShortCodes
    /**
     * DB::getShortCodes()
     * 
     * @return
     */

    function getShortCodes()
    {
        if (isset($_SESSION['CURRENT_PROJECT_DATA']))
        {
            $data = $_SESSION['CURRENT_PROJECT_DATA'];
            if (!isset($data['short-codes']))
            {
                $data['short-codes'] = array();
            }
            return $data['short-codes'];
        } else
        {
            return array();
        }
    }

    // TODO: SHORT-CODES --|-- getShortCode
    /**
     * DB::getShortCode()
     * 
     * @return
     */

    function getShortCode($name)
    {
        $data = array();
        if ($name != '')
        {
            $rawData = $_SESSION['CURRENT_PROJECT_DATA'];
            if (isset($rawData['short-codes'][$name]))
            {
                $data = $rawData['short-codes'][$name];
            }
        }
        return $data;
    }

    // TODO: SHORT-CODES --|-- removeShortCode
    /**
     * DB::removeShortCode()
     * 
     * @return
     */

    function removeShortCode($name)
    {
        if ($name != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/short-codes.' . basename($name) . '.json';
            $this->unLinkFile($file_name);

            $this->removeEnqueueScript($name . '-shortcode');
            $this->removeEnqueueStyle($name . '-shortcode');


        }
    }


    // TODO: ==========================
    // TODO: CONTENT
    // TODO: CONTENT --|-- saveContent
    /**
     * DB::saveContent()
     * 
     * @param mixed $data
     * @return void
     */

    function saveContent($data)
    {
        if ($data['name'] != '')
        {
            $project = $this->getProject();
            $version = $project['version'];

            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $new_data = $data;
            $new_data['name'] = $this->toFileName($data['name']);


            if (isset($new_data['enqueue_scripts']['scripts']))
            {
                $script = null;
                $script['name'] = $new_data['name'] . '-content';
                $script['src'] = 'assets/js/' . $new_data['name'] . "-content.js";
                $script['note'] = '[AUTO] Generated by: Content';
                $script['ver'] = $version;
                $script['in_footer'] = true;
                $script['interface'] = "front-end";
                $script['deps'] = array('jquery');
                $script['hooks'] = array();
                $this->saveEnqueueScripts($script);
            } else
            {
                $this->removeEnqueueScript($new_data['name'] . '-content');
            }
            if (isset($new_data['enqueue_scripts']['styles']))
            {
                $script = null;
                $script['name'] = $new_data['name'] . '-content';
                $script['src'] = 'assets/css/' . $new_data['name'] . "-content.css";
                $script['interface'] = "front-end";
                $script['note'] = '[AUTO] Generated by: Content';
                $script['ver'] = $version;
                $script['media'] = "all";
                $script['deps'] = array();
                $script['hooks'] = array();
                $this->saveEnqueueStyle($script);
            } else
            {
                $this->removeEnqueueStyle($new_data['name'] . '-content');
            }


            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/content.' . $new_data['name'] . '.json';
            $this->putContents($file_name, json_encode($new_data));
        }
    }


    // TODO: CONTENT --|-- getContents
    /**
     * DB::getContent()
     * 
     * @return
     */

    function getContents()
    {
        if (isset($_SESSION['CURRENT_PROJECT_DATA']))
        {
            $data = $_SESSION['CURRENT_PROJECT_DATA'];
            if (!isset($data['content']))
            {
                $data['content'] = array();
            }
            return $data['content'];
        } else
        {
            return array();
        }
    }

    // TODO: CONTENT --|-- getContent
    /**
     * DB::getContent()
     * 
     * @return
     */

    function getContent($name)
    {
        $data = array();
        if ($name != '')
        {
            $rawData = $_SESSION['CURRENT_PROJECT_DATA'];
            if (isset($rawData['content'][$name]))
            {
                $data = $rawData['content'][$name];
            }
        }
        return $data;
    }

    // TODO: CONTENT --|-- removeContent
    /**
     * DB::removeContent()
     * 
     * @return
     */

    function removeContent($name)
    {
        if ($name != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/content.' . basename($name) . '.json';
            $this->unLinkFile($file_name);

            $this->removeEnqueueScript($name . '-content');
            $this->removeEnqueueStyle($name . '-content');

        }
    }


    // TODO: ==========================
    // TODO: ADMIN-BARS
    // TODO: ADMIN-BARS --|-- saveAdminBar
    /**
     * DB::saveAdminBars()
     * 
     * @param mixed $data
     * @return void
     */
    function saveAdminBar($data)
    {
        if ($data['name'] != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $new_data = $data;
            $new_data['name'] = $this->toFileName($data['name']);
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/admin-bars.' . $new_data['name'] . '.json';
            $this->putContents($file_name, json_encode($new_data));
        }
    }


    // TODO: ADMIN-BARS --|-- getAdminBars
    /**
     * DB::getAdminBars()
     * 
     * @return
     */

    function getAdminBars()
    {
        if (isset($_SESSION['CURRENT_PROJECT_DATA']))
        {
            $data = $_SESSION['CURRENT_PROJECT_DATA'];
            if (!isset($data['admin-bars']))
            {
                $data['admin-bars'] = array();
            }
            return $data['admin-bars'];
        } else
        {
            return array();
        }
    }

    // TODO: ADMIN-BARS --|-- getAdminBar
    /**
     * DB::getAdminBar()
     * 
     * @return
     */

    function getAdminBar($name)
    {
        $data = array();
        if ($name != '')
        {
            $rawData = $_SESSION['CURRENT_PROJECT_DATA'];
            if (isset($rawData['admin-bars'][$name]))
            {
                $data = $rawData['admin-bars'][$name];
            }
        }
        return $data;
    }

    // TODO: ADMIN-BARS --|-- removeAdminBar
    /**
     * DB::removeAdminBar()
     * 
     * @return
     */

    function removeAdminBar($name)
    {
        if ($name != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/admin-bars.' . basename($name) . '.json';
            $this->unLinkFile($file_name);
        }
    }


    // TODO: ==========================
    // TODO: ADMIN-NOTICES
    // TODO: ADMIN-NOTICES --|-- saveAdminNotice
    /**
     * DB::saveAdminNotice()
     * 
     * @param mixed $data
     * @return void
     */
    function saveAdminNotice($data)
    {
        if ($data['name'] != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $new_data = $data;
            $new_data['name'] = $this->toFileName($data['name']);
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/admin-notices.' . $new_data['name'] . '.json';
            $this->putContents($file_name, json_encode($new_data));
        }
    }


    // TODO: ADMIN-NOTICES --|-- getAdminNotices
    /**
     * DB::getAdminNotices()
     * 
     * @return
     */

    function getAdminNotices()
    {
        if (isset($_SESSION['CURRENT_PROJECT_DATA']))
        {
            $data = $_SESSION['CURRENT_PROJECT_DATA'];
            if (!isset($data['admin-notices']))
            {
                $data['admin-notices'] = array();
            }
            return $data['admin-notices'];
        } else
        {
            return array();
        }
    }

    // TODO: ADMIN-NOTICES --|-- getAdminNotice
    /**
     * DB::getAdminNotice()
     * 
     * @return
     */

    function getAdminNotice($name)
    {
        $data = array();
        if ($name != '')
        {
            $rawData = $_SESSION['CURRENT_PROJECT_DATA'];
            if (isset($rawData['admin-notices'][$name]))
            {
                $data = $rawData['admin-notices'][$name];
            }
        }
        return $data;
    }

    // TODO: ADMIN-NOTICES --|-- removeAdminNotice
    /**
     * DB::removeAdminNotice()
     * 
     * @return
     */

    function removeAdminNotice($name)
    {
        if ($name != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/admin-notices.' . basename($name) . '.json';
            $this->unLinkFile($file_name);
        }
    }


    // TODO: ==========================
    // TODO: ADMIN-PAGES
    // TODO: ADMIN-PAGES --|-- saveAdminBar
    /**
     * DB::saveAdminPage()
     * 
     * @param mixed $data
     * @return void
     */
    function saveAdminPage($data)
    {
        if ($data['name'] != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            $project = $this->getProject();
            $version = $project['version'];

            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $new_data = $data;
            $new_data['name'] = $this->toFileName($data['name']);


            if (isset($new_data['enqueue_scripts']['scripts']))
            {
                $script = null;
                $script['name'] = $new_data['name'] . '-admin-page';
                $script['src'] = 'assets/js/' . $new_data['name'] . "-admin-page.js";
                $script['note'] = '[AUTO] Generated by: Admin Pages';
                $script['ver'] = $version;
                $script['in_footer'] = true;
                $script['interface'] = "back-end";
                $script['deps'] = array('jquery');
                $script['hooks'][] = 'admin.php';
                $this->saveEnqueueScripts($script);
            } else
            {
                $this->removeEnqueueScript($new_data['name'] . '-admin-page');
            }

            if (isset($new_data['enqueue_scripts']['styles']))
            {
                $script = null;
                $script['name'] = $new_data['name'] . '-admin-page';
                $script['src'] = 'assets/css/' . $new_data['name'] . "-admin-page.css";
                $script['interface'] = "back-end";
                $script['note'] = '[AUTO] Generated by: Admin Pages';
                $script['ver'] = $version;
                $script['media'] = "all";
                $script['deps'] = array();
                $script['hooks'][] = 'admin.php';
                $this->saveEnqueueStyle($script);
            } else
            {
                $this->removeEnqueueStyle($new_data['name'] . '-admin-page');
            }


            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/admin-pages.' . $new_data['name'] . '.json';
            $this->putContents($file_name, json_encode($new_data));
        }
    }


    // TODO: ADMIN-PAGES --|-- getAdminPages
    /**
     * DB::getAdminPages()
     * 
     * @return
     */

    function getAdminPages()
    {
        if (isset($_SESSION['CURRENT_PROJECT_DATA']))
        {
            $data = $_SESSION['CURRENT_PROJECT_DATA'];
            if (!isset($data['admin-pages']))
            {
                $data['admin-pages'] = array();
            }
            return $data['admin-pages'];
        } else
        {
            return array();
        }
    }

    // TODO: ADMIN-PAGES --|-- getAdminPage
    /**
     * DB::getAdminPage()
     * 
     * @return
     */

    function getAdminPage($name)
    {
        $data = array();
        if ($name != '')
        {
            $rawData = $_SESSION['CURRENT_PROJECT_DATA'];
            if (isset($rawData['admin-pages'][$name]))
            {
                $data = $rawData['admin-pages'][$name];
            }
        }
        return $data;
    }

    // TODO: ADMIN-PAGES --|-- removeAdminPage
    /**
     * DB::removeAdminPage()
     * 
     * @return
     */

    function removeAdminPage($name)
    {
        if ($name != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/admin-pages.' . basename($name) . '.json';
            $this->unLinkFile($file_name);

            $this->removeEnqueueScript($name . '-admin-page');
            $this->removeEnqueueStyle($name . '-admin-page');
        }
    }


    // TODO: ==========================
    // TODO: AJAX-REQUEST
    // TODO: AJAX-REQUEST --|-- saveAjaxRequest
    /**
     * DB::saveAjaxRequests()
     * 
     * @param mixed $data
     * @return void
     */
    function saveAjaxRequest($data)
    {
        if ($data['name'] != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $new_data = $data;
            $new_data['name'] = $this->toFileName($data['name']);
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/ajax-requests.' . $new_data['name'] . '.json';
            $this->putContents($file_name, json_encode($new_data));
        }
    }


    // TODO: AJAX-REQUEST --|-- getAjaxRequests
    /**
     * DB::getAjaxRequests()
     * 
     * @return
     */

    function getAjaxRequests()
    {
        if (isset($_SESSION['CURRENT_PROJECT_DATA']))
        {
            $data = $_SESSION['CURRENT_PROJECT_DATA'];
            if (!isset($data['ajax-requests']))
            {
                $data['ajax-requests'] = array();
            }
            return $data['ajax-requests'];
        } else
        {
            return array();
        }
    }

    // TODO: AJAX-REQUEST --|-- getAjaxRequest
    /**
     * DB::getAjaxRequest()
     * 
     * @return
     */

    function getAjaxRequest($name)
    {
        $data = array();
        if ($name != '')
        {
            $rawData = $_SESSION['CURRENT_PROJECT_DATA'];
            if (isset($rawData['ajax-requests'][$name]))
            {
                $data = $rawData['ajax-requests'][$name];
            }
        }
        return $data;
    }

    // TODO: AJAX-REQUEST --|-- removeAjaxRequest
    /**
     * DB::removeAjaxRequest()
     * 
     * @return
     */

    function removeAjaxRequest($name)
    {
        if ($name != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/ajax-requests.' . basename($name) . '.json';
            $this->unLinkFile($file_name);

            $this->removeCustomPosts(basename($name));
            $this->removeMetaBox(basename($name));
        }
    }


    // TODO: ==========================
    // TODO: ELEMENTOR-WIDGET
    // TODO: ELEMENTOR-WIDGET --|-- saveElementorWidget
    /**
     * DB::saveElementorWidgets()
     * 
     * @param mixed $data
     * @return void
     */
    function saveElementorWidget($data)
    {
        if ($data['name'] != '')
        {
            $project = $this->getProject();
            $version = $project['version'];

            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $new_data = $data;
            $new_data['name'] = $this->toFileName($data['name']);
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/elementor-widgets.' . $new_data['name'] . '.json';
            $this->putContents($file_name, json_encode($new_data));


            if (isset($new_data['enqueue_scripts']['scripts']))
            {
                $script = null;
                $script['name'] = $new_data['name'] . '-elementor-widget';
                $script['src'] = 'assets/js/' . $new_data['name'] . "-elementor-widget.js";
                $script['note'] = '[AUTO] Generated by: Elementor Widget';
                $script['ver'] = $version;
                $script['in_footer'] = true;
                $script['interface'] = "front-end";
                $script['deps'] = array('jquery');
                $script['hooks'] = array();
                $this->saveEnqueueScripts($script);
            } else
            {
                $this->removeEnqueueScript($new_data['name'] . '-elementor-widget');
            }

            if (isset($new_data['enqueue_scripts']['styles']))
            {
                $script = null;
                $script['name'] = $new_data['name'] . '-elementor-widget';
                $script['src'] = 'assets/css/' . $new_data['name'] . "-elementor-widget.css";
                $script['interface'] = "front-end";
                $script['note'] = '[AUTO] Generated by: Elementor Widgets';
                $script['ver'] = $version;
                $script['media'] = "all";
                $script['deps'] = array();
                $script['hooks'] = array();
                $this->saveEnqueueStyle($script);
            } else
            {
                $this->removeEnqueueStyle($new_data['name'] . '-elementor-widget');
            }

            $is_exist = $this->getAdminNotice('elementor');
            if (!isset($is_exist['name']))
            {
                $admin_notice['name'] = 'elementor';
                $admin_notice['note'] = '[AUTO] Generated by: Elementor Widgets';
                $admin_notice['is_set'] = 'not_defined';
                $admin_notice['variable'] = 'ELEMENTOR_VERSION';
                $admin_notice['message'] = '<strong>%s</strong> requires <a target="_blank" href="https://wordpress.org/plugins/elementor/">Elementor</a> Plugin to be installed and activated on your site.';
                $admin_notice['message_type'] = 'error';
                $admin_notice['type_generator'] = 'auto';
                $admin_notice['copy_to_custom_code'] = true;
                $admin_notice['determine'] = 'elementor';
                $this->saveAdminNotice($admin_notice);
            }


        }
    }


    // TODO: ELEMENTOR-WIDGET --|-- getElementorWidgets
    /**
     * DB::getElementorWidgets()
     * 
     * @return
     */

    function getElementorWidgets()
    {
        if (isset($_SESSION['CURRENT_PROJECT_DATA']))
        {
            $data = $_SESSION['CURRENT_PROJECT_DATA'];
            if (!isset($data['elementor-widgets']))
            {
                $data['elementor-widgets'] = array();
            }
            return $data['elementor-widgets'];
        } else
        {
            return array();
        }
    }

    // TODO: ELEMENTOR-WIDGET --|-- getElementorWidget
    /**
     * DB::getElementorWidget()
     * 
     * @return
     */

    function getElementorWidget($name)
    {
        $data = array();
        if ($name != '')
        {
            $rawData = $_SESSION['CURRENT_PROJECT_DATA'];
            if (isset($rawData['elementor-widgets'][$name]))
            {
                $data = $rawData['elementor-widgets'][$name];
            }
        }
        return $data;
    }

    // TODO: ELEMENTOR-WIDGET --|-- removeElementorWidget
    /**
     * DB::removeElementorWidget()
     * 
     * @return
     */

    function removeElementorWidget($name)
    {
        if ($name != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/elementor-widgets.' . basename($name) . '.json';
            $this->unLinkFile($file_name);

            $this->removeEnqueueScript($name . '-elementor-widget');
            $this->removeEnqueueStyle($name . '-elementor-widget');
            $this->removeAdminNotice('elementor');
        }
    }


    // TODO: ==========================
    // TODO: WPBAKERY-PAGE-BUILDERS
    // TODO: WPBAKERY-PAGE-BUILDERS --|-- saveWpbakeryPageBuilder
    /**
     * DB::saveWpbakeryPageBuilder()
     * 
     * @param mixed $data
     * @return void
     */
    function saveWpbakeryPageBuilder($data)
    {
        if ($data['name'] != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            $project = $this->getProject();
            $version = $project['version'];

            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $new_data = $data;
            $new_data['name'] = $this->toFileName($data['name']);
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/wpbakery-page-builders.' . $new_data['name'] . '.json';
            $this->putContents($file_name, json_encode($new_data));

            if (isset($new_data['enqueue_scripts']['scripts']))
            {
                $script = null;
                $script['name'] = $new_data['name'] . '-wpbakery-page-builder';
                $script['src'] = 'assets/js/' . $new_data['name'] . "-wpbakery-page-builder.js";
                $script['note'] = '[AUTO] Generated by: WPBakery Page Builders';
                $script['ver'] = $version;
                $script['in_footer'] = true;
                $script['interface'] = "front-end";
                $script['deps'] = array('jquery');
                $script['hooks'] = array();
                $this->saveEnqueueScripts($script);
            } else
            {
                $this->removeEnqueueScript($new_data['name'] . '-wpbakery-page-builder');
            }

            if (isset($new_data['enqueue_scripts']['styles']))
            {
                $script = null;
                $script['name'] = $new_data['name'] . '-wpbakery-page-builder';
                $script['src'] = 'assets/css/' . $new_data['name'] . "-wpbakery-page-builder.css";
                $script['interface'] = "front-end";
                $script['note'] = '[AUTO] Generated by: WPBakery Page Builders';
                $script['ver'] = $version;
                $script['media'] = "all";
                $script['deps'] = array();
                $script['hooks'] = array();
                $this->saveEnqueueStyle($script);
            } else
            {
                $this->removeEnqueueStyle($new_data['name'] . '-wpbakery-page-builder');
            }

            $is_exist = $this->getAdminNotice('wpbakery-page-builders');
            if (!isset($is_exist['name']))
            {
                $admin_notice['name'] = 'wpbakery-page-builders';
                $admin_notice['note'] = '[AUTO] Generated by: WPBakery Page Builders';
                $admin_notice['is_set'] = 'not_defined';
                $admin_notice['variable'] = 'WPB_VC_VERSION';
                $admin_notice['message'] = '<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">WPBakery Page Builder</a></strong> plugin to be installed and activated on your site.';
                $admin_notice['message_type'] = 'error';
                $admin_notice['type_generator'] = 'auto';
                $admin_notice['copy_to_custom_code'] = true;
                $admin_notice['determine'] = 'vcomposer';
                $this->saveAdminNotice($admin_notice);
            }


        }
    }


    // TODO: WPBAKERY-PAGE-BUILDERS --|-- getWpbakeryPageBuilders
    /**
     * DB::getWpbakeryPageBuilders()
     * 
     * @return
     */

    function getWpbakeryPageBuilders()
    {
        if (isset($_SESSION['CURRENT_PROJECT_DATA']))
        {
            $data = $_SESSION['CURRENT_PROJECT_DATA'];
            if (!isset($data['wpbakery-page-builders']))
            {
                $data['wpbakery-page-builders'] = array();
            }
            return $data['wpbakery-page-builders'];
        } else
        {
            return array();
        }
    }

    // TODO: WPBAKERY-PAGE-BUILDERS --|-- getWpbakeryPageBuilder
    /**
     * DB::getWpbakeryPageBuilder()
     * 
     * @return
     */

    function getWpbakeryPageBuilder($name)
    {
        $data = array();
        if ($name != '')
        {
            $rawData = $_SESSION['CURRENT_PROJECT_DATA'];
            if (isset($rawData['wpbakery-page-builders'][$name]))
            {
                $data = $rawData['wpbakery-page-builders'][$name];
            }
        }
        return $data;
    }

    // TODO: WPBAKERY-PAGE-BUILDERS --|-- removeWpbakeryPageBuilder
    /**
     * DB::removeWpbakeryPageBuilder()
     * 
     * @return
     */

    function removeWpbakeryPageBuilder($name)
    {
        if ($name != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/wpbakery-page-builders.' . basename($name) . '.json';
            $this->unLinkFile($file_name);

            $this->removeAdminNotice('wpbakery-page-builders');
            $this->removeEnqueueScript($name . '-wpbakery-page-builder');
            $this->removeEnqueueStyle($name . '-wpbakery-page-builder');
        }
    }


    // TODO: ==========================
    // TODO: WOO-SETTINGS
    // TODO: WOO-SETTINGS --|-- saveWooSetting
    /**
     * DB::saveWooSettings()
     * 
     * @param mixed $data
     * @return void
     */
    function saveWooSetting($data)
    {
        if ($data['name'] != '')
        {
            $project = $this->getProject();
            $version = $project['version'];

            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $new_data = $data;
            $new_data['name'] = $this->toFileName($data['name']);
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/woo-settings.' . $new_data['name'] . '.json';
            $this->putContents($file_name, json_encode($new_data));

            $is_exist = $this->getAdminNotice('woo-settings');
            if (!isset($is_exist['name']))
            {
                $admin_notice['name'] = 'woo-settings';
                $admin_notice['note'] = '[AUTO] Generated by: WooCommerce Settings';
                $admin_notice['is_set'] = 'apply_filters';
                $admin_notice['variable'] = 'woocommerce/woocommerce.php';
                $admin_notice['message'] = '<strong>%s</strong> requires <a href="https://woocommerce.com/">WooCommerce</a> plugin to be installed and activated on your site.';
                $admin_notice['message_type'] = 'error';
                $admin_notice['type_generator'] = 'auto';
                $admin_notice['copy_to_custom_code'] = true;
                $admin_notice['determine'] = 'woocommerce';
                $this->saveAdminNotice($admin_notice);
            }


        }
    }


    // TODO: WOO-SETTINGS --|-- getWooSettings
    /**
     * DB::getWooSettings()
     * 
     * @return
     */

    function getWooSettings()
    {
        if (isset($_SESSION['CURRENT_PROJECT_DATA']))
        {
            $data = $_SESSION['CURRENT_PROJECT_DATA'];
            if (!isset($data['woo-settings']))
            {
                $data['woo-settings'] = array();
            }
            return $data['woo-settings'];
        } else
        {
            return array();
        }
    }

    // TODO: WOO-SETTINGS --|-- getWooSetting
    /**
     * DB::getWooSetting()
     * 
     * @return
     */

    function getWooSetting($name)
    {
        $data = array();
        if ($name != '')
        {
            $rawData = $_SESSION['CURRENT_PROJECT_DATA'];
            if (isset($rawData['woo-settings'][$name]))
            {
                $data = $rawData['woo-settings'][$name];
            }
        }
        return $data;
    }

    // TODO: WOO-SETTINGS --|-- removeWooSetting
    /**
     * DB::removeWooSetting()
     * 
     * @return
     */

    function removeWooSetting($name)
    {
        if ($name != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/woo-settings.' . basename($name) . '.json';
            $this->unLinkFile($file_name);


            $this->removeAdminNotice('woo-settings');
        }
    }


    // TODO: ==========================
    // TODO: WOO-CHECKOUT-FIELDS
    // TODO: WOO-CHECKOUT-FIELDS --|-- saveWooCheckoutField
    /**
     * DB::saveWooCheckoutField()
     * 
     * @param mixed $data
     * @return void
     */
    function saveWooCheckoutField($data)
    {
        if ($data['name'] != '')
        {
            $project = $this->getProject();
            $version = $project['version'];

            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $new_data = $data;
            $new_data['name'] = $this->toFileName($data['name']);
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/woo-checkout-fields.' . $new_data['name'] . '.json';
            $this->putContents($file_name, json_encode($new_data));
        }
    }


    // TODO: WOO-CHECKOUT-FIELDS --|-- getWooCheckoutFields
    /**
     * DB::getWooCheckoutFields()
     * 
     * @return
     */

    function getWooCheckoutFields()
    {
        if (isset($_SESSION['CURRENT_PROJECT_DATA']))
        {
            $data = $_SESSION['CURRENT_PROJECT_DATA'];
            if (!isset($data['woo-checkout-fields']))
            {
                $data['woo-checkout-fields'] = array();
            }
            return $data['woo-checkout-fields'];
        } else
        {
            return array();
        }
    }

    // TODO: WOO-CHECKOUT-FIELDS --|-- getWooCheckoutFields
    /**
     * DB::getWooSetting()
     * 
     * @return
     */

    function getWooCheckoutField($name)
    {
        $data = array();
        if ($name != '')
        {
            $rawData = $_SESSION['CURRENT_PROJECT_DATA'];
            if (isset($rawData['woo-checkout-fields'][$name]))
            {
                $data = $rawData['woo-checkout-fields'][$name];
            }
        }
        return $data;
    }

    // TODO: WOO-CHECKOUT-FIELDS --|-- removeWooCheckoutField
    /**
     * DB::removeWooCheckoutField()
     * 
     * @return
     */

    function removeWooCheckoutField($name)
    {
        if ($name != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/woo-checkout-fields.' . basename($name) . '.json';
            $this->unLinkFile($file_name);


        }
    }


    // TODO: ==========================
    // TODO: GET-RAW-PHP-CODES
    // TODO: GET-RAW-PHP-CODES --|-- saveRawPhpCode
    /**
     * DB::saveRawPhpCode()
     * 
     * @param mixed $data
     * @return void
     */
    function saveRawPhpCode($data)
    {
        if ($data['name'] != '')
        {
            $project = $this->getProject();
            $version = $project['version'];

            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $new_data = $data;
            $new_data['name'] = $this->toFileName($data['name']);
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/raw-php-codes.' . $new_data['name'] . '.json';
            $this->putContents($file_name, json_encode($new_data));
        }
    }


    // TODO: GET-RAW-PHP-CODES --|-- getRawPhpCodes
    /**
     * DB::getRawPhpCodes()
     * 
     * @return
     */

    function getRawPhpCodes()
    {
        if (isset($_SESSION['CURRENT_PROJECT_DATA']))
        {
            $data = $_SESSION['CURRENT_PROJECT_DATA'];
            if (!isset($data['raw-php-codes']))
            {
                $data['raw-php-codes'] = array();
            }
            return $data['raw-php-codes'];
        } else
        {
            return array();
        }
    }

    // TODO: GET-RAW-PHP-CODES --|-- getRawPhpCodes
    /**
     * DB::getWooSetting()
     * 
     * @return
     */

    function getRawPhpCode($name)
    {
        $data = array();
        if ($name != '')
        {
            $rawData = $_SESSION['CURRENT_PROJECT_DATA'];
            if (isset($rawData['raw-php-codes'][$name]))
            {
                $data = $rawData['raw-php-codes'][$name];
            }
        }
        return $data;
    }

    // TODO: GET-RAW-PHP-CODES --|-- removeRawPhpCode
    /**
     * DB::removeRawPhpCode()
     * 
     * @return
     */

    function removeRawPhpCode($name)
    {
        if ($name != '')
        {
            $app_prefix = $_SESSION['CURRENT_PROJECT_PREFIX'];
            if (!file_exists(IHS_PROJECT_DIR . '/' . $app_prefix))
            {
                mkdir(IHS_PROJECT_DIR . '/' . $app_prefix, 0777, true);
            }
            $file_name = IHS_PROJECT_DIR . '/' . $app_prefix . '/raw-php-codes.' . basename($name) . '.json';
            $this->unLinkFile($file_name);


        }
    }


    // TODO: ==========================
    // TODO: CURRENT
    // TODO: CURRENT --|-- current
    /**
     * DB::current()
     * 
     * @return
     */
    function current()
    {
        $current_app = null;

        foreach (glob(IHS_PROJECT_DIR . '/' . $_SESSION['CURRENT_PROJECT_PREFIX'] . '/*.json') as $filename)
        {
            $var_name = pathinfo($filename, PATHINFO_FILENAME);
            $var_subname = explode('.', $var_name);

            if (count($var_subname) == 1)
            {
                $current_app[$var_name] = json_decode(file_get_contents($filename), true);
            }
            if (count($var_subname) == 2)
            {
                $current_app[$var_subname[0]][$var_subname[1]] = json_decode(file_get_contents($filename), true);
            }
            if (count($var_subname) == 3)
            {
                $current_app[$var_subname[0]][$var_subname[1]][$var_subname[2]] = json_decode(file_get_contents($filename), true);
            }
        }
        $_SESSION['CURRENT_PROJECT_DATA'] = $current_app;
        return $current_app;
    }


    // TODO: ==========================
    // TODO: PRIVATE --|-- putContents
    /**
     * DB::putContents()
     * 
     * @return void
     */
    private function putContents($filename, $data)
    {
        if (defined('JSON_PRETTY_PRINT'))
        {
            file_put_contents($filename, json_encode(json_decode($data), JSON_PRETTY_PRINT));
        } else
        {
            file_put_contents($filename, $data);
        }

    }

    // TODO: ==========================
    // TODO: PRIVATE --|-- unlinkFile
    /**
     * DB::unlinkFile()
     * 
     * @param mixed $filename
     * @return void
     */


    private function unlinkFile($filename)
    {
        if (file_exists($filename))
        {
            unlink($filename);
        }
    }

    // TODO: PRIVATE --|-- toFileName
    /**
     * DB::toFileName()
     * 
     * @param mixed $string
     * @return
     */
    private function toFileName($string)
    {
        $string = strtolower(trim($string));
        $Allow = null;
        $char = ' abcdefghijklmnopqrstuvwxyz1234567890-_';
        for ($i = 0; $i < strlen($string); $i++)
        {
            if (strstr($char, $string[$i]) != false)
            {
                $Allow .= $string[$i];
            }
        }
        $Allow = str_replace(array('_', ' '), '-', strtolower($Allow));
        return trim($Allow);
    }


}

?>