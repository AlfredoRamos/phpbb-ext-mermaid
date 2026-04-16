<?php

/**
 * Mermaid Diagrams extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2026 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\mermaid\acp;

class main_info
{
	/**
	 * Set up ACP module.
	 *
	 * @return array
	 */
	public function module()
	{
		return [
			'filename'	=> '\alfredoramos\mermaid\acp\main_module',
			'title'		=> 'ACP_MERMAID',
			'modes'		=> [
				'settings'	=> [
					'title'	=> 'SETTINGS',
					'auth'	=> 'ext_alfredoramos/mermaid && acl_a_board && acl_a_extensions',
					'cat'	=> ['ACP_MERMAID']
				]
			]
		];
	}
}
