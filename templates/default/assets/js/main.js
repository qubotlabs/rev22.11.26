$(document).ready(function(){
    
    "use strict";
    
	//icon filter
	$("#filter-icon").keyup(function() {
		var keyword = $(this).val();
		$(".icon-item").each(function() {
			var list_icon = $(this).attr('data-id');
			console.log('compare', keyword, list_icon);
			$(this).addClass('hidden');
			if (list_icon.toLowerCase().indexOf(keyword) >= 0) {
				$(this).removeClass('hidden');
			}
		});
	});
	$(".icon-list").on('click', function() {
		var icon = $(this).attr('data-icon');
		$(window.ICON_TARGET).val(icon);
		$(window.ICON_PREVIEW).attr('class', icon);
		$(window.ICON_PREVIEW).addClass(window.ICON_PREFIX);
		$(window.ICON_DIALOG).modal('hide');
	});
	$("*[data-type='icon-picker']").on('click', function() {
		window.ICON_TARGET = $(this).attr('data-target');
		window.ICON_DIALOG = $(this).attr('data-dialog');
		window.ICON_PREVIEW = $(this).attr('data-preview');
		window.ICON_PREFIX = $(this).attr('data-prefix');
		$(window.ICON_DIALOG).modal();
	});
	// tags
	if ($('*[data-type="tags"]')) {
		$('*[data-type="tags"]').tagsinput();
	}
	//data table
	$('table[data-type="datatable"]').DataTable();
	$('input[data-type="switch"]').each(function() {
		$(this).bootstrapSwitch('state', $(this).prop('checked'));
	});
	//markdown
	for (var ix = 0; ix < 10; ++ix) {
		if ($('textarea[data-type="markdown"]')[ix]) {
			var code_html5 = $('textarea[data-type="markdown"]')[ix];
			var editor = CodeMirror.fromTextArea(code_html5, {
				mode: "markdown",
				lineNumbers: true,
				theme: IHS_CODEMIRROR_THEME,
				extraKeys: {
					"Ctrl-Space": "autocomplete",
					"F11": function(cm) {
						cm.setOption("fullScreen", !cm.getOption("fullScreen"));
					},
					"Esc": function(cm) {
						if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
					}
				}
			});
		}
	}
	//php
	for (var ix = 0; ix < 10; ++ix) {
		if ($('textarea[data-type="php"]')[ix]) {
			var code_php = $('textarea[data-type="php"]')[ix];
			var editor = CodeMirror.fromTextArea(code_php, {
				mode: "text/x-php",
				lineNumbers: true,
				matchBrackets: true,
				indentUnit: 4,
				theme: IHS_CODEMIRROR_THEME,
				indentWithTabs: true,
				extraKeys: {
					"Ctrl-Space": "autocomplete",
					"F11": function(cm) {
						cm.setOption("fullScreen", !cm.getOption("fullScreen"));
					},
					"Esc": function(cm) {
						if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
					}
				}
			});
		}
	}
	//css
	for (var ix = 0; ix < 10; ++ix) {
		if ($('textarea[data-type="css3"]')[ix]) {
			var code_css3 = $('textarea[data-type="css3"]')[ix];
			var editor = CodeMirror.fromTextArea(code_css3, {
				mode: "text/css",
				lineNumbers: true,
				matchBrackets: true,
				indentUnit: 4,
				theme: IHS_CODEMIRROR_THEME,
				indentWithTabs: true,
				extraKeys: {
					"Ctrl-Space": "autocomplete",
					"F11": function(cm) {
						cm.setOption("fullScreen", !cm.getOption("fullScreen"));
					},
					"Esc": function(cm) {
						if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
					}
				}
			});
		}
	}
	//xml
	for (var ix = 0; ix < 10; ++ix) {
		if ($('textarea[data-type="xml"]')[ix]) {
			var code_xml = $('textarea[data-type="xml"]')[ix];
			var editor = CodeMirror.fromTextArea(code_xml, {
				mode: "text/xml",
				lineNumbers: true,
				matchBrackets: true,
				indentUnit: 4,
				theme: IHS_CODEMIRROR_THEME,
				indentWithTabs: true,
				extraKeys: {
					"Ctrl-Space": "autocomplete",
					"F11": function(cm) {
						cm.setOption("fullScreen", !cm.getOption("fullScreen"));
					},
					"Esc": function(cm) {
						if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
					}
				}
			});
		}
	}
	//js
	for (var ix = 0; ix < 10; ++ix) {
		if ($('textarea[data-type="js"]')[ix]) {
			var code_js = $('textarea[data-type="js"]')[ix];
			var editor = CodeMirror.fromTextArea(code_js, {
				mode: "javascript",
				lineNumbers: true,
				matchBrackets: true,
				indentUnit: 4,
				theme: IHS_CODEMIRROR_THEME,
				indentWithTabs: true,
				extraKeys: {
					"Ctrl-Space": "autocomplete",
					"F11": function(cm) {
						cm.setOption("fullScreen", !cm.getOption("fullScreen"));
					},
					"Esc": function(cm) {
						if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
					}
				}
			});
		}
	}
	$("*[data-type='checked']").on('click', function() {
		var data_target = $(this).attr("data-target");
		var data_reset = $(this).attr("data-reset");
		$(data_reset).prop("checked", false);
		$(data_target).prop("checked", "checked");
	});
	$(".remove-item").on("click", function() {
		var target = $(this).attr("data-target");
		$(target).replaceWith(' ');
		return false;
	});
    
	if ($.fn.jstree) {
		$('#treefiles').on('changed.jstree', function(e, data) {
			var i, j, file_hash, file_name,file_ext;
			for (i = 0, j = data.selected.length; i < j; i++) {
				file_hash = data.instance.get_node(data.selected[i]).li_attr['data-file'];
				file_ext = data.instance.get_node(data.selected[i]).li_attr['data-ext'];
				file_name = data.instance.get_node(data.selected[i]).text;
			}
			//console.log(file_name);
			if (file_ext) {
				open_file(file_hash, file_name, file_ext);
			}
		}).jstree();
	}
    
});



if (jQuery("#code-edit").length) {
	editAreaLoader.init({
		id: "code-edit",
		font_family: "Courier New",
		syntax_selection_allow: "css,html,js,php,xml,sql",
		syntax: "php",
		start_highlight: true,
		//allow_resize: "y",
		is_multi_files: true,
		allow_toggle: false,
		//fullscreen:true,
		EA_load_callback: "load_callback"
	});

	function load_callback() {
		open_file('', 'new file', 'php');
	}

	function open_file(a, b, c) {
		$.ajax({
			type: "get",
			url: "./plugins/viewsource/?f=source&hash_file=" + a + "",
			dataType: "html",
			success: function(result) {
				//console.log(result);
				var new_file = {
					id: b,
					text: result,
					syntax: c
				};
				editAreaLoader.openFile("code-edit", new_file);
			}
		});
	}
};

if ($.fn.jstree) {
	$('#treefiles').on('changed.jstree', function(e, data) {
		var i, j, file_hash, file_name, file_ext;
		for (i = 0, j = data.selected.length; i < j; i++) {
			file_hash = data.instance.get_node(data.selected[i]).li_attr['data-file'];
			file_ext = data.instance.get_node(data.selected[i]).li_attr['data-ext'];
			file_name = data.instance.get_node(data.selected[i]).text;
		}
		if (file_ext) {
			open_file(file_hash, file_name, file_ext);
		}
	}).jstree();
}