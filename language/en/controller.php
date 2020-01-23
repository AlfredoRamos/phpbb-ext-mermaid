<?php

/**
 * Mermaid Diagrams extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 * @ignore
 */
if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

$lang = array_merge($lang, [
	'MERMAID_LIVE_EDITOR' => 'Mermaid Live Editor',
	'MERMAID_INSERT' => 'Insert',
	'MERMAID_CLEAR' => 'Clear',
	'MERMAID_CANCEL' => 'Cancel'
]);
