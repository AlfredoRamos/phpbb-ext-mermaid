<?php

/**
 * Mermaid Diagrams extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2026 Alfredo Ramos
 * @license GPL-2.0-only
 */

/**
 * @ignore
 */
if (!defined('IN_PHPBB')) {
	exit;
}

/**
 * @ignore
 */
if (empty($lang) || !is_array($lang)) {
	$lang = [];
}

$lang = array_merge($lang, [
	'ACP_MERMAID_SETTINGS_EXPLAIN' => '<p>Here you can configure the MermaidJS library. Consult the <a href="%1$s" rel="external nofollow noreferrer noopener" target="_blank"><strong>FAQ</strong></a> for more information. If you require assistance, please visit the <a href="%2$s" rel="external nofollow noreferrer noopener" target="_blank"><strong>Support</strong></a> section.</p><p>If you like or found this extension useful and want to show some appreciation, you can consider supporting its development by <a href="%3$s" rel="external nofollow noreferrer noopener" target="_blank"><strong>giving a donation</strong></a>.</p>',

	'MERMAID_THEME' => 'Theme',
	'MERMAID_THEME_EXPLAIN' => 'The CSS style sheet to use.',
	'MERMAID_LOOK' => 'Look',
	'MERMAID_LOOK_EXPLAIN' => 'The main look to use for the diagram.',
	'MERMAID_MAX_TEXT_SIZE' => 'Text size',
	'MERMAID_MAX_TEXT_SIZE_EXPLAIN' => 'The maximum characters allowed of the diagram text.',
	'MERMAID_MAX_EDGES' => 'Edges',
	'MERMAID_MAX_EDGES_EXPLAIN' => 'The maximum number of edges that can be drawn in a diagram.',

	'ACP_MERMAID_THEME_DEFAULT' => 'Default',
	'ACP_MERMAID_THEME_BASE' => 'Base',
	'ACP_MERMAID_THEME_DARK' => 'Dark',
	'ACP_MERMAID_THEME_FOREST' => 'Forest',
	'ACP_MERMAID_THEME_NEUTRAL' => 'Neutral',
	'ACP_MERMAID_THEME_NEO' => 'Neo',
	'ACP_MERMAID_THEME_NEO_DARK' => 'Neo dark',
	'ACP_MERMAID_THEME_REDUX' => 'Redux',
	'ACP_MERMAID_THEME_REDUX_DARK' => 'Redux dark',
	'ACP_MERMAID_THEME_REDUX_COLOR' => 'Redux color',
	'ACP_MERMAID_THEME_REDUX_DARK_COLOR' => 'Redux dark color',
	'ACP_MERMAID_THEME_NULL' => 'Null',

	'ACP_MERMAID_LOOK_CLASSIC' => 'Classic',
	'ACP_MERMAID_LOOK_HANDDRAWN' => 'Hand-drawn',
	'ACP_MERMAID_LOOK_NEO' => 'Neo',

	'ACP_MERMAID_VALIDATE_INVALID_FIELDS' => 'Invalid values for fields: %s'
]);
