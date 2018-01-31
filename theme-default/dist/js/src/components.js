/**
* Main header animation
* Uses Headroom.js from https://github.com/WickyNilliams/headroom.js
*/

// Polyfill matches
Element.prototype.matches = Element.prototype.matches ||
	Element.prototype.mozMatchesSelector ||
	Element.prototype.msMatchesSelector ||
	Element.prototype.oMatchesSelector ||
	Element.prototype.webkitMatchesSelector;

DO.Subscribe(['app:ready'], function (e, $) {
	'use strict';

	var body = document.body,
		header = document.querySelector('.header'),
		menu = document.querySelector('[data-menu]'),
		menuToggle = document.querySelector('[data-menu-toggle]');

	function init() {
		setup(document);
	}

	function setup(scope) {
		var headroom = new Headroom(header, getConfig().headroom);
		headroom.init();

		attachEvents(scope);
	}

	function getConfig() {
		return {
			headroom: {
				tolerance: {
					down: 10,
					up: 20
				},
				offset: 200,
				classes: {
					initial: 'header', // when element is initialised
					pinned: 'header--pinned', // when scrolling up
					unpinned: 'header--unpinned', // when scrolling down
					top: 'header--top', // when above offset
					notTop: 'header--not-top', // when below offset
					bottom: 'header--bottom', // when at bottom of scroll area
					notBottom: 'header--not-bottom' // when not at bottom of scroll area
				}
			},
			classActive: 'header--open',
			classBody: 'body--fixed'
		};
	}

	function attachEvents(scope) {
		menuToggle.addEventListener('click', toggleHeader);
		header.addEventListener('click', handleHeaderClick);
		scope.addEventListener('keydown', function(e) {
			if (e.keyCode === 27) { // screw you IE
				header.classList.remove(getConfig().classActive);
			}
		});
	}

	function toggleHeader() {
		var active = header.classList.contains(getConfig().classActive);
		header.classList[active ? 'remove' : 'add'](getConfig().classActive);
		toggleMenuAria(active);
		toggleBodyClasses(active);
	}

	function toggleBodyClasses(active) {
		body.classList[active ? 'remove' : 'add'](getConfig().classBody);
	}

	function toggleMenuAria(active) {
		menu.setAttribute('aria-hidden', active);
		menuToggle.setAttribute('aria-expanded', !active);
	}

	function handleHeaderClick(e) {
		if (!e.target.matches('[data-menu-toggle]') && header.classList.contains(getConfig().classActive)) {
			toggleHeader();
		}
	}

	init();
});

/**
* Slick slider init
*
*/
DO.Subscribe('app:ready', function(e, $) {
	'use strict';

	function init() {
		setup($(document));
	}

	function setup(scope) {
		if (scope.find('[data-slider]').length < 1) {
			return;
		}

		scope.find('[data-slider]').slick(getConfig());

		attachEvents(scope);
	}

	function attachEvents(scope) {
		if (scope.is(document)) {
			$(document).on('ajaxpages:contentloaded', function(e, data) {
				setup(data.target);
			});
		}
	}

	// [0, 568, 768, 1024, 1280]
	function getConfig() {
		return {
			mobileFirst: true,
			variableWidth: true,
			infinite: false,
			slidesToShow: 1,
			arrows: true,
			prevArrow: '<button type="button" class="pure-button pure-button-icononly slick-prev"><span class="sr-only">Previous</span></button>',
			nextArrow: '<button type="button" class="pure-button pure-button-icononly slick-next"><span class="sr-only">Next</span></button>',
			responsive: [{
				breakpoint: 1280,
				settings: {
					slidesToShow: 1
				}
			}, {
				breakpoint: 1024,
				settings: {
					slidesToShow: 1
				}
			}, {
				breakpoint: 600,
				settings: {
					slidesToShow: 1
				}
			}, {
				breakpoint: 480,
				settings: {
					arrows: true,
					slidesToShow: 1
				}
			}]
		};
	}

	init();
});

/**
 * Toggles and switches extra js (for accessibility).
 * Uses ../lib/toggles-switches.js from https://github.com/dsurgeons/Toggles-Switches
 */

DO.Subscribe('app:ready', function(e, $) {
	'use strict';

	var focusable = 'a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, *[tabindex], *[contenteditable]',
		focusableNative = 'a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed';

	/**
	 * Initialize Button actions
	 */
	function init() {
		setup($(document));
	}

	/**
	 * Apply setup to our newly loaded area (document, or scope)
	 *
	 * @param scope | DOMObject - the area of the page we are applying this functionality to
	 */
	function setup(scope) {
		// if aria hidden, we shouldn't be able to focus
		scope.find('[aria-hidden="true"]').find(focusable).attr('tabindex', '-1');

		attachEvents(scope);
	}

	/**
	 * If an element has the attribute data-toggle-aria we want to toggle the
	 * aria-hidden attribute of the data-toggle-aria value and the tabindex of
	 * all focusable children.
	 * @param scope | DOMObject
	 */
	function attachAriaHide(scope) {
		var targets = scope.find('[data-toggle-aria]');

		// Set aria hidden and tabindex -1
		targets.on('click', function() {
			var target = $(this).data('toggle-aria'),
				value = $(target).attr('aria-hidden') === 'false' ? 'true' : 'false',
				tabindex = value === 'false' ? '0' : '-1';

			$(target).attr('aria-hidden', value);
			$(target).find(focusable).attr('tabindex', tabindex);
		});
	}

	/**
	 * Attach events
	 * @param scope | DOMObject
	 */
	function attachEvents(scope) {
		attachAriaHide(scope);

		scope.find('[data-contain]').on('click', function(e) {
			e.stopPropagation();
		});

		// make sure we get the order of our events right
		setTimeout(function() {
			keyboardFocus(scope);
		}, 1000);

		if (scope.is(document)) {
			$(document).on('ajaxpages:contentloaded', function(e, data) {
				setup(data.target);
			});
		}
	}

	/**
	 * Allow a focus state that only appears for people using keyboards to navigate
	 * @param scope | DOMObject
	 */
	function keyboardFocus(scope) {
		scope.find(focusable).on('keyup', function(e) {
			$(e.target).addClass('hasfocus');

			if ($(e.target).is(focusableNative)) {
				return;
			}

			// trigger click if this element doesn't usually support click
			if (e.keyCode === 13) {
				e.preventDefault();
				e.stopPropagation();
				$(e.target).trigger('click');
			}
		}).on('blur focusout', function(e) {
			$(e.target).removeClass('hasfocus');
		});
	}

	init();
});
