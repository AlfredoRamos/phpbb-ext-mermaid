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
	'ACP_MERMAID_SETTINGS_EXPLAIN' => '<p>Aquí puedes configurar la biblioteca MermaidJS. Consulta las <a href="%1$s" rel="external nofollow noreferrer noopener" target="_blank"><strong>Preguntas Frecuentes</strong></a> para obtener más información. Si requieres de ayuda, por favor visita la sección de <a href="%2$s" rel="external nofollow noreferrer noopener" target="_blank"><strong>Soporte</strong></a> section.</p><p>Si te gustó o encontraste útil esta extensión y quieres mostrar un gesto de agradecimiento, puedes considerar contribuir a su desarrollo realizando una <a href="%3$s" rel="external nofollow noreferrer noopener" target="_blank"><strong>donación</strong></a>.</p>',

	'MERMAID_THEME' => 'Tema',
	'MERMAID_THEME_EXPLAIN' => 'La hoja de estilos CSS a usar.',
	'MERMAID_LOOK' => 'Aspecto',
	'MERMAID_LOOK_EXPLAIN' => 'El aspecto principal a usar en los diagramas.',
	'MERMAID_MAX_TEXT_SIZE' => 'Tamaño de texto',
	'MERMAID_MAX_TEXT_SIZE_EXPLAIN' => 'El número máximo de caracteres permitidos para el texto del diagrama.',
	'MERMAID_MAX_EDGES' => 'Bordes',
	'MERMAID_MAX_EDGES_EXPLAIN' => 'El número máximo de aristas que se pueden dibujar en un diagrama.',

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

	'ACP_MERMAID_VALIDATE_INVALID_FIELDS' => 'Valores inválidos para los campos: %s'
]);
