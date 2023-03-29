<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$db = new DB();
$string = new StringConvert();
$project = $db->getProject();


$module['name'] = 'wp-dropdown-users';
$module['label'] = 'WordPress ~ Dropdown Users';

$module['options']['value'] = 'subcriber';
$module['options']['placeholder'] = 'subcriber';
$module['options']['help'] = 'choose user role';

$module['default']['value'] = 'subcriber';
$module['default']['placeholder'] = 'subcriber';

$module['info']['value'] = '';
$module['info']['placeholder'] = '';

$current_page = null;
if (isset($__field['options']))
{
    if ($__field['options'] != '')
    {
        $current_page = $__field['options'];
    }
}

$module['render_content'] = null;
$module['render_content'] .= "\t\t" . '$current_data = get_post_meta($post->ID, "_{{VAR}}", true);' . "\r\n";
$module['render_content'] .= "\t\t" . 'if($current_data == ""){' . "\r\n";
$module['render_content'] .= "\t\t\t" . '$current_data = "{{DEFAULT}}";' . "\r\n";
$module['render_content'] .= "\t\t" . '}' . "\r\n";
$module['render_content'] .= "\t\t" . '$args = array(' . "\r\n";
if (isset($__field['options']))
{
    if ($__field['options'] != '')
    {
        if ($__field['options'] != 'none')
        {
            $module['render_content'] .= "\t\t\t" . '"role" => array("'.$__field['options'].'"),' . "\r\n";
        }
    }
}

$module['render_content'] .= "\t\t\t" . '"echo" => true,' . "\r\n";
$module['render_content'] .= "\t\t\t" . '"id" => "{{ID}}",' . "\r\n";
$module['render_content'] .= "\t\t\t" . '"name" => "{{NAME}}",' . "\r\n";
$module['render_content'] .= "\t\t\t" . '"class" => "regular-text {{SHORTNAME}}-form-control",' . "\r\n";
$module['render_content'] .= "\t\t\t" . '"selected" => $current_data,' . "\r\n";
$module['render_content'] .= "\t\t" . ');' . "\r\n";
$module['render_content'] .= "\t\t" . '?>' . "\r\n";
$module['render_content'] .= "\t\t" . '<tr>' . "\r\n";
$module['render_content'] .= "\t\t\t" . '<th scope="row">' . "\r\n";
$module['render_content'] .= "\t\t\t\t" . '<label for="{{ID}}"><?php _e("{{LABEL}}", "{{TEXT-DOMAIN}}"); ?></label>' . "\r\n";
$module['render_content'] .= "\t\t\t" . '</th>' . "\r\n";
$module['render_content'] .= "\t\t\t" . '<td>' . "\r\n";
$module['render_content'] .= "\t\t\t" . '<?php wp_dropdown_users($args); ?>' . "\r\n";
$module['render_content'] .= "\t\t\t" . '<p class="description"><?php _e("{{INFO}}", "{{TEXT-DOMAIN}}"); ?></p>' . "\r\n";
$module['render_content'] .= "\t\t\t" . '</td>' . "\r\n";
$module['render_content'] .= "\t\t" . '</tr>' . "\r\n";
$module['render_content'] .= "\t\t" . '<?php' . "\r\n";

$module['save_post'] = null;
$module['save_post'] .= "\t\t" . '$data = sanitize_text_field($_POST["{{NAME}}"]);' . "\r\n";
$module['save_post'] .= "\t\t" . 'update_post_meta($post_id, "_{{VAR}}", $data);' . "\r\n";


$module['admin_footer'] = null;
$module['admin_enqueue_scripts'] = null;

$__roles = array();
$__roles[] = array('value' => 'none', 'label' => 'None');
$__roles[] = array('value' => 'subcriber', 'label' => 'Subcriber (WP Core)');
$__roles[] = array('value' => 'author', 'label' => 'Author (WP Core)');
$__roles[] = array('value' => 'contributor', 'label' => 'Contributor (WP Core)');
$__roles[] = array('value' => 'editor', 'label' => 'Editor (WP Core)');


foreach ($db->getRoles() as $_role)
{

    $__roles[] = array('value' => $string->toVar($project['short-name'] . '_' . $_role['name']), 'label' => $string->toVar($project['short-name'] . '_' . $_role['name']) . ' (Custom Roles)');
}

$module['code']['js'] = null;
$module['code']['js'] .= "\t\t\t\t\t" . '' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '$("#meta-box-options-" + item_target).addClass("hidden");' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'var options = ' . json_encode($__roles) . ';' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'var select_custom_pages ="";' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'select_custom_pages += "<select onclick=\"setField(\'#meta-box-options-" + item_target + "\',this.value)\" id=\"#meta-box-options-select-option-" + item_target + "\" class=\"form-control\">"; ' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '$.each(options, function(i, item) {' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . 'var selected = "";' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . 'if(meta_box_options[item_target] == item.value ){' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . 'selected = "selected";' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . '}' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . 'select_custom_pages += "<option " + selected + " value=\"" + item.value +  "\">" + item.label +  "</option>"; ' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '});' . "\r\n";

$module['code']['js'] .= "\t\t\t\t\t" . 'select_custom_pages += "</select>"; ' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '$("#meta-box-options-select-" + item_target).html(select_custom_pages);' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '$("#meta-box-options-" + item_target).val(meta_box_options[item_target]);' . "\r\n";

?>