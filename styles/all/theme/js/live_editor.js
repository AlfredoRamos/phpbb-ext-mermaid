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

	var $timer = null;

	$(document.body).on('contextmenu', '.bbcode-mermaid', function($event) {
		$event.preventDefault();

		var $cssClass = 'mermaid-editor';
		var $html = '';

		// Editor content
		$html += '<h3>Mermaid Live Editor</h3>';

		$html += '<div class="mermaid-editor-wrapper">';
		$html += '<div class="mermaid-editor-code">';
		$html += '<h4>Code</h4><br><textarea id="mermaid-editor-text"></textarea>';
		$html += '</div>';
		$html += '<div class="mermaid-editor-preview">';
		$html += '<h4>Preview</h4><div></div>'
		$html += '</div>';
		$html += '</div>';

		$html += '<div class="mermaid-errors"></div>';
		
		$html += '<fieldset class="submit-buttons">';
		$html += '<input type="button" name="confirm" value="Insert" class="btn-mermaid btn-confirm">';
		$html += '&nbsp;';
		$html += '<input type="button" name="cancel" value="Cancel" class="btn-mermaid btn-cancel">';
		$html += '</fieldset>';

		// Live editor
		var $confirmBox = phpbb.confirm($html, function($confirmed) {
			// Remove custom CSS class
			if ($('#phpbb_confirm').hasClass($cssClass) && !$confirmed) {
				$('#phpbb_confirm').removeClass($cssClass);
			}
		});

		// Add custom CSS class
		if (!$confirmBox.hasClass($cssClass)) {
			$confirmBox.addClass($cssClass);
		}
	});

	$(document.body).on('input', '#mermaid-editor-text', function() {
		clearTimeout($timer);

		var $text = $(this).val().trim();
		var $cssClass = 'mermaid';
		var $container = $(this).parents('.' + $cssClass + '-editor-wrapper').first()
			.find('.' + $cssClass + '-editor-preview > div').first();

		// Input delay
		$timer = setTimeout(function() {
			// Reset
			if ($text.length <= 0) {
				$container.html('');
				$container.removeClass($cssClass);
				$container.removeAttr('data-processed');

				return;
			}

			// Render diagram
			mermaid.mermaidAPI.render($cssClass + '-preview-' + (Math.floor(Math.random() * 10000)).toString(), $text, function($html) {
				if ($html.length <= 0) {
					return;
				}

				// Check if already processed
				if (!$container.hasClass($cssClass)) {
					$container.addClass($cssClass);
				}

				$container.html($html);

				if ($container.html().length <= 0) {
					$container.removeAttr('data-processed');
				} else {
					$container.attr('data-processed', 'true');
				}
			});
		}, 250);
	});
})(jQuery);
