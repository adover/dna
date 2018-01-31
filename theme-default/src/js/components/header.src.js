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
