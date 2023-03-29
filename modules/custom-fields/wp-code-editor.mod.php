<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$module['name'] = 'wp-code-editor';
$module['label'] = 'WordPress ~ Code Editor (CodeMirror)';


$module['render_content'] = null;
$module['render_content'] .= "\t\t" . '$current_data = get_post_meta($post->ID, "_{{VAR}}", true);' . "\r\n";
$module['render_content'] .= "\t\t" . 'if($current_data == ""){' . "\r\n";
$module['render_content'] .= "\t\t\t" . '$current_data = "{{DEFAULT}}";' . "\r\n";
$module['render_content'] .= "\t\t" . '}' . "\r\n";
$module['render_content'] .= "\t\t" . '?>' . "\r\n";
$module['render_content'] .= "\t\t" . '<tr>' . "\r\n";
$module['render_content'] .= "\t\t\t" . '<th scope="row" colspan="2">' . "\r\n";
$module['render_content'] .= "\t\t\t\t" . '<label for="{{ID}}"><?php _e("{{LABEL}}", "{{TEXT-DOMAIN}}"); ?></label>' . "\r\n";
$module['render_content'] .= "\t\t\t\t" . '<textarea class="large-text {{SHORTNAME}}-form-control" id="{{ID}}" name="{{NAME}}"><?php echo esc_attr($current_data); ?></textarea>' . "\r\n";
$module['render_content'] .= "\t\t\t\t" . '<p class="description"><?php _e("{{INFO}}", "{{TEXT-DOMAIN}}"); ?></p>' . "\r\n";
$module['render_content'] .= "\t\t\t" . '</th>' . "\r\n";
$module['render_content'] .= "\t\t" . '</tr>' . "\r\n";
$module['render_content'] .= "\t\t" . '<?php' . "\r\n";

$module['save_post'] = null;
$module['save_post'] .= "\t\t" . '$data = htmlentities($_POST["{{NAME}}"]);' . "\r\n";
$module['save_post'] .= "\t\t" . 'update_post_meta($post_id, "_{{VAR}}", $data);' . "\r\n";


$module['admin_enqueue_scripts'] = null;
$module['admin_enqueue_scripts'] .= "\t\t" . 'wp_enqueue_code_editor(array("type" => "{{OPTIONS}}"));' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t" . 'wp_enqueue_script("wp-theme-plugin-editor");' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t" . 'wp_enqueue_style("wp-codemirror");' . "\r\n";

$module['admin_footer'] = null;
$module['admin_footer'] .= "\t\t" . '?>' . "\r\n";
$module['admin_footer'] .= "\t\t" . '<script type="text/javascript">' . "\r\n";
$module['admin_footer'] .= "\t\t" . '// custom-field - {{NAME}}' . "\r\n";
$module['admin_footer'] .= "\t\t" . '(function($){' . "\r\n";
$module['admin_footer'] .= "\t\t\t" . 'if($("#{{ID}}").length){' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t" . 'var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t" . 'editorSettings.codemirror = _.extend({},editorSettings.codemirror,{' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'mode: "{{OPTIONS}}",' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . 'autoRefresh:true,' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t" . '}' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t" . ');' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t" . 'var editor = wp.codeEditor.initialize( $("#{{ID}}"), editorSettings );' . "\r\n";
$module['admin_footer'] .= "\t\t\t" . '}' . "\r\n";
$module['admin_footer'] .= "\t\t" . '})(jQuery);' . "\r\n";
$module['admin_footer'] .= "\t\t" . '</script>' . "\r\n";
$module['admin_footer'] .= "\t\t" . '<?php' . "\r\n";
$module['admin_footer'] .= "\t\t" . '' . "\r\n";


$__opt = array();
$__opt[] = array('value' => 'htmlmixed', 'label' => 'HTML Mixed');
$__opt[] = array('value' => 'css', 'label' => 'CSS');
$__opt[] = array('value' => 'javascript', 'label' => 'Javascript');
 


$module['code']['js'] = null;
$module['code']['js'] .= "\t\t\t\t\t" . '' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '$("#meta-box-options-" + item_target).addClass("hidden");' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'var options = ' . json_encode($__opt) . ';' . "\r\n";
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