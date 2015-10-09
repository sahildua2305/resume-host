jQuery(function($) {
	// open a popup window at the center of the screen
	function open_popup(url, width, height, scroll) {
		var left = ($(window).width() - width) / 2,
			top = ($(window).height() - height) / 2,
			opts = 'status=1,' + (scroll ? 'scrollbars=1,' : '') + 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left;

		window.open(url, "", opts);
	}

	// add the sharing container on the page
	$('<div class="prepbootstrap-sharing-container"></div>')
		.appendTo(document.body)
		.append(
			$('<div class="sharing-item sharing-fb"><div class="sharing-img"></div></div>').click(function () {
				open_popup(
					"https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(document.location.href),
					600,
					350
				);
			}),
			$('<div class="sharing-item sharing-gp"><div class="sharing-img"></div></div>').click(function () {
				open_popup(
					"https://plus.google.com/share?url=" + encodeURIComponent(document.location.href),
					500,
					500
				);
			}),
			$('<div class="sharing-item sharing-tw"><div class="sharing-img"></div></div>').click(function () {
				open_popup(
					"https://twitter.com/share?url=" + encodeURIComponent(document.location.href) +
						"&text=" + encodeURIComponent($(document).find("title").text()),
					575,
					400,
					true
				);
			}),
			$('<div class="sharing-item sharing-li"><div class="sharing-img"></div></div>').click(function () {
				open_popup(
					"https://www.linkedin.com/shareArticle?mini=true&url=" +
						encodeURIComponent(document.location.href) +
						"&title=" + encodeURIComponent($(document).find("title").text()),
					750,
					400,
					true
				);
			})
		);
});