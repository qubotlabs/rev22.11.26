<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2020
 * @package WP-Dev Tools
 * @license Commercial License
 **/

$module['name'] = 'wp-code-editor';
$module['label'] = 'WordPress ~ Code Editor (CodeMirror)';

$module['settings_field'] = null;
$module['settings_field'] .= "\t\t" . 'add_settings_field(' . "\r\n";
$module['settings_field'] .= "\t\t\t" . '"{{VAR}}", //id' . "\r\n";
$module['settings_field'] .= "\t\t\t" . '__("{{LABEL}}","{{TEXT-DOMAIN}}"), //title' . "\r\n";
$module['settings_field'] .= "\t\t\t" . 'array($this,"{{CALLBACK}}"), //callback' . "\r\n";
$module['settings_field'] .= "\t\t\t" . '"{{PAGE}}", //page' . "\r\n";
$module['settings_field'] .= "\t\t\t" . '"{{SECTION}}" //section' . "\r\n";
$module['settings_field'] .= "\t\t" . ');' . "\r\n";

$module['sanitize'] = null;
$module['sanitize'] .= "\t\t" . 'if(isset($input["{{VAR}}"]))' . "\r\n";
$module['sanitize'] .= "\t\t\t" . '$new_input["{{VAR}}"] = htmlentities($input["{{VAR}}"]);' . "\r\n";
$module['sanitize'] .= "\t\t" . '' . "\r\n";


$module['callback'] = null;
$module['callback'] .= "\t\t" . 'if(isset($this->{{SETTING}}["{{VAR}}"])){' . "\r\n";
$module['callback'] .= "\t\t\t" . '$value = esc_attr($this->{{SETTING}}["{{VAR}}"]);' . "\r\n";
$module['callback'] .= "\t\t" . '}else{' . "\r\n";
$module['callback'] .= "\t\t\t" . '$value = "{{DEFAULT}}";' . "\r\n";
$module['callback'] .= "\t\t" . '}' . "\r\n";
$module['callback'] .= "\t\t" . '?>' . "\r\n";
$module['callback'] .= "\t\t" . '<textarea class="large-text {{SHORTNAME}}-form-control" id="{{ID}}" name="{{SETTING}}[{{VAR}}]"><?php echo $value; ?></textarea>' . "\r\n";
$module['callback'] .= "\t\t" . '<p class="description"><?php _e("{{INFO}}","{{TEXT-DOMAIN}}") ?></p>' . "\r\n";
$module['callback'] .= "\t\t" . '<?php' . "\r\n";


$module['admin_enqueue_scripts'] = null;
$module['admin_enqueue_scripts'] .= "\t\t\t" . 'wp_enqueue_code_editor(array("type" => "{{OPTIONS}}"));' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t" . 'wp_enqueue_script("wp-theme-plugin-editor");' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t" . 'wp_enqueue_style("wp-codemirror");' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t" . '?>' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t" . '<style type="text/css">' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . '.CodeMirror{' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t\t" . 'border: 1px solid #7e8993;' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t\t" . '}' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t" . '</style>' . "\r\n";
$module['admin_enqueue_scripts'] .= "\t\t\t" . '<?php' . "\r\n";

$module['admin_footer'] = null;
$module['admin_footer'] .= "\t\t\t" . '?>' . "\r\n";
$module['admin_footer'] .= "\t\t\t" . '<script type="text/javascript">' . "\r\n";
$module['admin_footer'] .= "\t\t\t" . '// custom-field - {{NAME}}' . "\r\n";
$module['admin_footer'] .= "\t\t\t" . '(function($){' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t" . 'if($("#{{ID}}").length){' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t" . 'var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t" . 'editorSettings.codemirror = _.extend({},editorSettings.codemirror,{' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t\t" . 'mode: "{{OPTIONS}}",' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t\t" . 'autoRefresh:true,' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t\t" . '}' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t\t" . ');' . "\r\n";

$module['admin_footer'] .= "\t\t\t\t\t" . 'var editor = wp.codeEditor.initialize( $("#{{ID}}"), editorSettings );' . "\r\n";
$module['admin_footer'] .= "\t\t\t\t" . '}' . "\r\n";
$module['admin_footer'] .= "\t\t\t" . '})(jQuery);' . "\r\n";
$module['admin_footer'] .= "\t\t\t" . '</script>' . "\r\n";
$module['admin_footer'] .= "\t\t\t" . '<?php' . "\r\n";
$module['admin_footer'] .= "\t\t\t" . '' . "\r\n";

$module['rest_api_callback'] = null;
$module['rest_api_callback'] .= "" . '' . "\r\n";
$module['rest_api_callback'] .= "\t\t" . 'if(isset($options["{{VAR}}"])){' . "\r\n";
$module['rest_api_callback'] .= "\t\t\t" . '$data["{{VAR}}"] = esc_html($options["{{VAR}}"]);' . "\r\n";
$module['rest_api_callback'] .= "\t\t" . '}else{' . "\r\n";
$module['rest_api_callback'] .= "\t\t\t" . '$data["{{VAR}}"] = null;' . "\r\n";
$module['rest_api_callback'] .= "\t\t" . '}' . "\r\n";


$__opt = array();
$__opt[] = array('value' => 'htmlmixed', 'label' => 'HTML Mixed');
$__opt[] = array('value' => 'css', 'label' => 'CSS');
$__opt[] = array('value' => 'javascript', 'label' => 'Javascript');


$module['code']['js'] = null;
$module['code']['js'] .= "\t\t\t\t\t" . '' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '$("#plugin-options-options-" + item_target).addClass("hidden");' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'var options = ' . json_encode($__opt) . ';' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'var select_custom_pages ="";' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . 'select_custom_pages += "<select onclick=\"setField(\'#plugin-options-options-" + item_target + "\',this.value)\" id=\"#plugin-options-options-select-option-" + item_target + "\" class=\"form-control\">"; ' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '$.each(options, function(i, item) {' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . 'var selected = "";' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . 'if(option_field_options[item_target] == item.value ){' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . 'selected = "selected";' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . '}' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t\t" . 'select_custom_pages += "<option " + selected + " value=\"" + item.value +  "\">" + item.label +  "</option>"; ' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '});' . "\r\n";

$module['code']['js'] .= "\t\t\t\t\t" . 'select_custom_pages += "</select>"; ' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '$("#plugin-options-options-select-" + item_target).html(select_custom_pages);' . "\r\n";
$module['code']['js'] .= "\t\t\t\t\t" . '$("#plugin-options-options-" + item_target).val(option_field_options[item_target]);' . "\r\n";

?>