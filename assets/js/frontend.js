jQuery(document).ready(function(){
	jQuery.noConflict();
	//console.log(ExitBoxSettings);
	jQuery('head').append('<style>.ja_custom {' + ExitBoxSettings.custom_css + '}</style>');
	jQuery('head').append('<style>' + ExitBoxSettings.advanced_custom_css + '</style>');
	jQuery(function($) {
		function leave_now(event) {
			var urlsnippet = event.currentTarget.href;
			if (ExitBoxSettings.Include_URL === 'on') {
				if (event.currentTarget.href.length > 40) {
					urlsnippet = event.currentTarget.href.substr(0, 40) + "...";
				}
			}
			else {
				urlsnippet = '';
			}
			if (ExitBoxSettings.theme === '' ) {
				ExitBoxSettings.theme = 'default';
			}
			jQuery.jAlert({
				'type': 'confirm', 
				'title': ExitBoxSettings.title,
				'content': ExitBoxSettings.body,
				'confirmBtnText': ExitBoxSettings.GoButtonText + ' ' + urlsnippet,
				'denyBtnText': ExitBoxSettings.CancelButtonText,
				'theme': ExitBoxSettings.theme,
				'backgroundColor': ExitBoxSettings.backgroundcolor,
				'size': ExitBoxSettings.size,
				'showAnimation': ExitBoxSettings.showAnimation,
				'hideAnimation': ExitBoxSettings.hideAnimation,
				'onConfirm': function() {
					if (ExitBoxSettings.new_window === 'on') {
						window.open(event.currentTarget.href, 'New Window');
					}
					else {
						location.href = event.currentTarget.href;
					}
				}, 
				'onDeny': function(){
				}
			});
			if (ExitBoxSettings.enable_timeout === 'on') {
				//console.log("Setting " + ExitBoxSettings.timeout_seconds + " seconds timeout on the " + ExitBoxSettings.continue_or_cancel + " button.");
				if (ExitBoxSettings.continue_or_cancel === 'continue') {
					setTimeout(function() {
						jQuery(".confirmBtn").click();
					}, ExitBoxSettings.timeout_seconds*1000);
				}
				else if (ExitBoxSettings.continue_or_cancel === 'cancel') {
					setTimeout(function() {
						jQuery(".denyBtn").click();
					}, ExitBoxSettings.timeout_seconds*1000);
				}
			}
		    return false;
		}

		var select_external = 'a[href*="//"]:not([href*="' + ExitBoxSettings.siteroot + '"])';
//		console.log('apply_to_all_offsite_links: ' + ExitBoxSettings.apply_to_all_offsite_links);
//		console.log('jquery_selector_field: ' + ExitBoxSettings.jquery_selector_field);
		if (ExitBoxSettings.apply_to_all_offsite_links !== 'on') {
			select_external = ExitBoxSettings.jquery_selector_field;
		}
		jQuery(select_external).addClass('exitNotifierLink');
		jQuery(document).on( 'click', select_external, leave_now );
		if (ExitBoxSettings.visual === 'on') {
			jQuery(select_external).append('&nbsp;<img class="flat" src="' + ExitBoxSettings.siteurl + '/wp-content/plugins/exit-notifier/external-link.png" border=0>');
		}
	});
});