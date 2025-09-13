<?php

/**
 * Mermaid Diagrams extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
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
	'MERMAID' => 'Mermaid',
	'MERMAID_HELPLINE' => 'Mermaid diagram: [mermaid]diagram code[/mermaid]',
	'MERMAID_LIVE_EDITOR' => 'Mermaid live editor',
	'MERMAID_STATUS_FORMAT' => 'Mermaid is <em>%s</em>',
	'MERMAID_IS_ON' => 'ON',
	'MERMAID_IS_OFF' => 'OFF'
]);
