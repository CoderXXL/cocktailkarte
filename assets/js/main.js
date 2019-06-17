(function($) {

	let	$window = $(window),
		$body = $('body'),
		$wrapper = $('#wrapper');

	// Breakpoints.
		breakpoints({
			xlarge:  [ '1281px',  '1680px' ],
			large:   [ '981px',   '1280px' ],
			medium:  [ '737px',   '980px'  ],
			small:   [ '481px',   '736px'  ],
			xsmall:  [ null,      '480px'  ]
		});

		if (browser.name == 'ie')
			$body.addClass('ie');

		if (browser.mobile)
			$body.addClass('touch');

		if (browser.canUse('transition')) {

				$window.on('load', function() {
					window.setTimeout(function() {
						$body.removeClass('is-preload');
					}, 100);
				});

				let resizeTimeout;

				$window.on('resize', function() {

					window.clearTimeout(resizeTimeout);

					$body.addClass('is-resizing');

					resizeTimeout = window.setTimeout(function() {
						$body.removeClass('is-resizing');
					}, 100);

				});

		}

		$window.scrollTop(0);

	let $panels = $('.panel');

		$panels.each(function() {

			let $this = $(this),
				$toggles = $('[href="#' + $this.attr('id') + '"]'),
				$closer = $('<div class="closer" />').appendTo($this);

				$closer
					.on('click', function(event) {
						$this.trigger('---hide');
					});

				$this
					.on('click', function(event) {
						event.stopPropagation();
					})
					.on('---toggle', function() {

						if ($this.hasClass('active'))
							$this.triggerHandler('---hide');
						else
							$this.triggerHandler('---show');

					})
					.on('---show', function() {

							if ($body.hasClass('content-active'))
								$panels.trigger('---hide');

							$this.addClass('active');
							$toggles.addClass('active');

							$body.addClass('content-active');

					})
					.on('---hide', function() {

							$this.removeClass('active');
							$toggles.removeClass('active');

							$body.removeClass('content-active');

					});

				$toggles
					.removeAttr('href')
					.css('cursor', 'pointer')
					.on('click', function(event) {

						event.preventDefault();
						event.stopPropagation();

						$this.trigger('---toggle');

					});

		});

			$body
				.on('click', function(event) {

					if ($body.hasClass('content-active')) {

						event.preventDefault();
						event.stopPropagation();

						$panels.trigger('---hide');

					}

				});

			$window
				.on('keyup', function(event) {

					if (event.keyCode == 27
					&&	$body.hasClass('content-active')) {

						event.preventDefault();
						event.stopPropagation();

						$panels.trigger('---hide');

					}

				});

		let $header = $('#header');

			$header.find('a').each(function() {

				let $this = $(this),
					href = $this.attr('href');

					if (!href
					||	href.charAt(0) == '#')
						return;

				// Redirect on click.
					$this
						.removeAttr('href')
						.css('cursor', 'pointer')
						.on('click', function(event) {

							event.preventDefault();
							event.stopPropagation();

							window.location.href = href;

						});

			});

		let $footer = $('#footer');


			$footer.find('.copyright').each(function() {

				let $this = $(this),
					$parent = $this.parent(),
					$lastParent = $parent.parent().children().last();

				breakpoints.on('<=medium', function() {
					$this.appendTo($lastParent);
				});

				breakpoints.on('>medium', function() {
					$this.appendTo($parent);
				});

			});

		let $main = $('#main');

			$main.children('.thumb').each(function() {

				let	$this = $(this),
					$image = $this.find('.image'), $image_img = $image.children('img'),
					x;

					if ($image.length == 0)
						return;

						$image.css('background-image', 'url(' + $image_img.attr('src') + ')');

						if (x = $image_img.data('position'))
							$image.css('background-position', x);

						$image_img.hide();

			});

			$main.poptrox({
				baseZIndex: 20000,
				caption: function($a) {

					let s = '';

					$a.nextAll().each(function() {
						s += this.outerHTML;
					});

					return s;

				},
				fadeSpeed: 300,
				onPopupClose: function() { $body.removeClass('modal-active'); },
				onPopupOpen: function() { $body.addClass('modal-active'); },
				overlayOpacity: 0,
				popupCloserText: '',
				popupHeight: 150,
				popupLoaderText: '',
				popupSpeed: 300,
				popupWidth: 150,
				selector: '.thumb > a.image',
				usePopupCaption: true,
				usePopupCloser: true,
				usePopupDefaultStyling: false,
				usePopupForceClose: true,
				usePopupLoader: true,
				usePopupNav: true,
				windowMargin: 50
			});

				breakpoints.on('<=xsmall', function() {
					$main[0]._poptrox.windowMargin = 0;
				});

				breakpoints.on('>xsmall', function() {
					$main[0]._poptrox.windowMargin = 50;
				});

})(jQuery);