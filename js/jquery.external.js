/* Korean initialisation for the jQuery calendar extension. */
/* Written by DaeKwon Kang (ncrash.dk@gmail.com). */
jQuery(function($){
	$.datepicker.regional['ko'] = {
		closeText: '닫기',
		prevText: '이전달',
		nextText: '다음달',
		currentText: '오늘',
		monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		dayNames: ['일','월','화','수','목','금','토'],
		dayNamesShort: ['일','월','화','수','목','금','토'],
		dayNamesMin: ['일','월','화','수','목','금','토'],
		weekHeader: 'Wk',
		dateFormat: 'yy-mm-dd',
		firstDay: 0,
		isRTL: false,
		showMonthAfterYear: true,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['ko']);
});

/*!
 * jQuery Cookie Plugin v1.3
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2011, Klaus Hartl
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.opensource.org/licenses/GPL-2.0
 */
(function ($, document, undefined) {

	var pluses = /\+/g;

	function raw(s) {
		return s;
	}

	function decoded(s) {
		return decodeURIComponent(s.replace(pluses, ' '));
	}

	var config = $.cookie = function (key, value, options) {

		// write
		if (value !== undefined) {
			options = $.extend({}, config.defaults, options);

			if (value === null) {
				options.expires = -1;
			}

			if (typeof options.expires === 'number') {
				var days = options.expires, t = options.expires = new Date();
				t.setDate(t.getDate() + days);
			}

			value = config.json ? JSON.stringify(value) : String(value);

			return (document.cookie = [
				encodeURIComponent(key), '=', config.raw ? value : encodeURIComponent(value),
				options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
				options.path    ? '; path=' + options.path : '',
				options.domain  ? '; domain=' + options.domain : '',
				options.secure  ? '; secure' : ''
			].join(''));
		}

		// read
		var decode = config.raw ? raw : decoded;
		var cookies = document.cookie.split('; ');
		for (var i = 0, l = cookies.length; i < l; i++) {
			var parts = cookies[i].split('=');
			if (decode(parts.shift()) === key) {
				var cookie = decode(parts.join('='));
				return config.json ? JSON.parse(cookie) : cookie;
			}
		}

		return null;
	};

	config.defaults = {};

	$.removeCookie = function (key, options) {
		if ($.cookie(key) !== null) {
			$.cookie(key, null, options);
			return true;
		}
		return false;
	};

})(jQuery, document);


// Autosize 1.9 - jQuery plugin for textareas
// (c) 2011 Jack Moore - jacklmoore.com
// license: www.opensource.org/licenses/mit-license.php

(function ($, undefined) {
	var 
	hidden = 'hidden',
	borderBox = 'border-box',
	copy = '<textarea style="position:absolute; top:-9999px; left:-9999px; right:auto; bottom:auto; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden">',
	// line-height is omitted because IE7/IE8 doesn't return the correct value.
	copyStyle = [
		'fontFamily',
		'fontSize',
		'fontWeight',
		'fontStyle',
		'letterSpacing',
		'textTransform',
		'wordSpacing',
		'textIndent'
	],
	oninput = 'oninput',
	onpropertychange = 'onpropertychange',
	test = $(copy)[0];

	test.setAttribute(oninput, "return");

	if ($.isFunction(test[oninput]) || onpropertychange in test) {
		$.fn.autosize = function (className) {
			return this.each(function () {
				var 
				ta = this,
				$ta = $(ta),
				mirror,
				minHeight = $ta.height(),
				maxHeight = parseInt($ta.css('maxHeight'), 10),
				active,
				i = copyStyle.length,
				resize,
				boxOffset = 0;

				if ($ta.css('box-sizing') === borderBox || $ta.css('-moz-box-sizing') === borderBox || $ta.css('-webkit-box-sizing') === borderBox){
					boxOffset = $ta.outerHeight() - $ta.height();
				}

				if ($ta.data('mirror') || $ta.data('ismirror')) {
					// if autosize has already been applied, exit.
					// if autosize is being applied to a mirror element, exit.
					return;
				} else {
					mirror = $(copy).data('ismirror', true).addClass(className || 'autosizejs')[0];

					resize = $ta.css('resize') === 'none' ? 'none' : 'horizontal';

					$ta.data('mirror', $(mirror)).css({
						overflow: hidden, 
						overflowY: hidden, 
						wordWrap: 'break-word',
						resize: resize
					});
				}

				// Opera returns '-1px' when max-height is set to 'none'.
				maxHeight = maxHeight && maxHeight > 0 ? maxHeight : 9e4;

				// Using mainly bare JS in this function because it is going
				// to fire very often while typing, and needs to very efficient.
				function adjust() {
					var height, overflow;
					// the active flag keeps IE from tripping all over itself.  Otherwise
					// actions in the adjust function will cause IE to call adjust again.
					if (!active) {
						active = true;

						mirror.value = ta.value;

						mirror.style.overflowY = ta.style.overflowY;

						// Update the width in case the original textarea width has changed
						mirror.style.width = $ta.css('width');

						// Needed for IE to reliably return the correct scrollHeight
						mirror.scrollTop = 0;

						// Set a very high value for scrollTop to be sure the 
						// mirror is scrolled all the way to the bottom.
						mirror.scrollTop = 9e4;

						height = mirror.scrollTop;
						overflow = hidden;
						if (height > maxHeight) {
							height = maxHeight;
							overflow = 'scroll';
						} else if (height < minHeight) {
							height = minHeight;
						}
						ta.style.overflowY = overflow;

						ta.style.height = height + boxOffset + 'px';
						
						// This small timeout gives IE a chance to draw it's scrollbar
						// before adjust can be run again (prevents an infinite loop).
						setTimeout(function () {
							active = false;
						}, 1);
					}
				}

				// mirror is a duplicate textarea located off-screen that
				// is automatically updated to contain the same text as the 
				// original textarea.  mirror always has a height of 0.
				// This gives a cross-browser supported way getting the actual
				// height of the text, through the scrollTop property.
				while (i--) {
					mirror.style[copyStyle[i]] = $ta.css(copyStyle[i]);
				}

				$('body').append(mirror);

				if (onpropertychange in ta) {
					if (oninput in ta) {
						// Detects IE9.  IE9 does not fire onpropertychange or oninput for deletions,
						// so binding to onkeyup to catch most of those occassions.  There is no way that I
						// know of to detect something like 'cut' in IE9.
						ta[oninput] = ta.onkeyup = adjust;
					} else {
						// IE7 / IE8
						ta[onpropertychange] = adjust;
					}
				} else {
					// Modern Browsers
					ta[oninput] = adjust;
				}

				$(window).resize(adjust);

				// Allow for manual triggering if needed.
				$ta.bind('autosize', adjust);

				// Call adjust in case the textarea already contains text.
				adjust();
			});
		}; 
	} else {
		// Makes no changes for older browsers (FireFox3- and Safari4-)
		$.fn.autosize = function () {
			return this;
		};
	}

}(jQuery));

$(function(){
	// Input Clear
	var iText = $('.iLabel').next('.iText');
	$('.iLabel').css('position','absolute');
	iText
		.focus(function(){
			$(this).prev('.iLabel').css('visibility','hidden');
		})
		.blur(function(){
			if($(this).val() == ''){
				$(this).prev('.iLabel').css('visibility','visible');
			} else {
				$(this).prev('.iLabel').css('visibility','hidden');
			}
		})
		.change(function(){
			if($(this).val() == ''){
				$(this).prev('.iLabel').css('visibility','visible');
			} else {
				$(this).prev('.iLabel').css('visibility','hidden');
			}
		})
		.blur();


	$('textarea.autoresize').focus(function(){
		$('textarea.autoresize').autosize(); // comment textarea auto size start
	});

});