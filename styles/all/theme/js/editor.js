/**
 * Mermaid Diagrams extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

(function($) {
	'use strict';

	// The instance must already exist
	if (typeof window.mermaid === 'undefined') {
		window.mermaid.initialize({startOnLoad: false});
	}

	// Global variables
	var $timer = null;
	var $itemName = 'mermaid_code';

	// Get modal box template
	$(document.body).on('contextmenu', '.bbcode-mermaid', function($event) {
		$event.preventDefault();

		// Get editor URL
		var $editorUrl = $(this).attr('data-editor-url').trim();

		// Editor URL is mandatory
		if ($editorUrl.length <= 0) {
			return;
		}

		// Get template
		$.ajax({
			url: $editorUrl
		}).done(function($data) {
			// Show modal box
			$($data).appendTo('body').modal();
		}).fail(function($data, $textStatus, $error) {
			try {
				// Parse JSON response
				var $responseBody = $.parseJSON($data.responseText);

				// Show error message
				phpbb.alert($error, $responseBody.message);
			} catch ($ex) {
				// Show exception message
				phpbb.alert($ex.name, $ex.message);
			}
		});
	});

	// Generate preview
	$(document.body).on('input', '#mermaid-text', function() {
		clearTimeout($timer);

		// Helpers
		var $text = $(this).val().trim();
		var $cssClass = 'mermaid';
		var $container = $(this).parents('.' + $cssClass + '-editor').first()
			.find('.' + $cssClass + '-preview > figure').first();
		var $errors = $(this).parents('.' + $cssClass + '-editor').first()
			.find('.mermaid-errors').first();

		// Cleanup
		$errors.fadeOut('fast');

		// Input delay
		$timer = setTimeout(function() {
			// Reset
			if ($text.length <= 0) {
				$container.html('');
				$container.removeClass($cssClass);
				$container.removeAttr('data-processed');
				$errors.html('');
				return;
			}

			// Render diagram
			try {
				window.mermaid.mermaidAPI.render($cssClass + '-' + Date.now(), $text, function($html) {
					if ($html.length <= 0) {
						return;
					}

					// Check if already processed
					if (!$container.hasClass($cssClass)) {
						$container.addClass($cssClass);
					}

					// Add SVG code
					$container.html($html);

					// Keep attribute helper
					if ($container.html().length <= 0) {
						$container.removeAttr('data-processed');
					} else {
						$container.attr('data-processed', true);
					}
				});
			} catch ($error) {
				// Show parse errors
				if ($error && $errors.length > 0) {
					$errors.html($error);
					$errors.fadeIn('fast');

					// Reset
					$container.html('');
					$container.removeClass($cssClass);
					$container.removeAttr('data-processed');
				}
			}
		}, 250);
	});

	// Insert button
	$(document.body).on('click', '.btn-mermaid.btn-insert', function() {
		var $code = $(this).parents('.mermaid-live-editor').first()
			.find('#mermaid-text').first();
		var $svg = $(this).parents('.mermaid-live-editor').first()
			.find('.mermaid-preview > figure.mermaid').first();
		var $text = '';

		// Check if SVG was generated
		if ($code.length > 0 && $svg.length && $svg.data('processed') === true) {
			$text = $code.val().trim();

			// Prevent button spamming
			$(this).prop('disabled', true);
		}

		// Check if text is available
		if ($text <= 0) {
			return;
		}

		// Add text to message
		insert_text('[mermaid]' + $text + '[/mermaid]');

		// Close modal box
		$.modal.getCurrent().close();
	});

	// Clear button
	$(document.body).on('click', '.btn-mermaid.btn-clear', function() {
		var $code = $(this).parents('.mermaid-live-editor').first()
			.find('#mermaid-text').first();

		// Clear textarea
		$code.val('');
		$code.trigger('input');

		// Clear session data
		if (typeof Storage !== 'undefined') {
			if (window.sessionStorage.getItem($itemName) !== 'null' &&
				window.sessionStorage.getItem($itemName) !== null
			) {
				window.sessionStorage.removeItem($itemName);
			}
		}
	});

	// Cancel button
	$(document.body).on('click', '.btn-mermaid.btn-cancel', function() {
		$.modal.getCurrent().close();
	});

	// Load diagram code from sessionStorage
	$(document.body).on($.modal.BEFORE_OPEN, '.mermaid-live-editor', function() {
		// Check if sessionStorage is available
		if (typeof Storage === 'undefined') {
			return;
		}

		if (window.sessionStorage.getItem($itemName) !== 'null' &&
			window.sessionStorage.getItem($itemName) !== null
		)
		{
			var $code = $(this).find('#mermaid-text').first();

			if ($code.length > 0) {
				$code.val(window.sessionStorage.getItem($itemName));
				$code.trigger('input');
			}
		}
	});

	// Save diagram code to sessionStorage
	$(document.body).on($.modal.BEFORE_CLOSE, '.mermaid-live-editor', function() {
		// Check if sessionStorage is available
		if (typeof Storage === 'undefined') {
			return;
		}

		var $code = $(this).find('#mermaid-text').first();
		var $svg = $(this).find('.mermaid-preview > figure.mermaid').first();
		var $text = '';

		// Check if SVG was generated
		if ($code.length > 0 && $svg.length && $svg.data('processed') === true) {
			$text = $code.val().trim();
		}

		// Check if text is available
		if ($text <= 0) {
			return;
		}

		// Save session data
		window.sessionStorage.setItem($itemName, $text);
	});

	// Remove session data
	if ($('.bbcode-mermaid').length <= 0) {
		// Check if sessionStorage is available
		if (typeof Storage !== 'undefined') {
			if (window.sessionStorage.getItem($itemName) !== 'null' &&
				window.sessionStorage.getItem($itemName) !== null
			) {
				window.sessionStorage.removeItem($itemName);
			}
		}
	}
})(jQuery);
