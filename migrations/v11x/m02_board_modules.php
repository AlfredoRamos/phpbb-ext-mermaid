<?php

/**
 * Mermaid Diagrams extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2026 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\mermaid\migrations\v11x;

use phpbb\db\migration\migration;

class m02_board_modules extends migration
{
	/**
	 * Migration dependencies.
	 *
	 * @return array
	 */
	static public function depends_on()
	{
		return ['\alfredoramos\mermaid\migrations\v10x\m01_board_configuration'];
	}

	/**
	 * Add Mermaid modules.
	 *
	 * @return array
	 */
	public function update_data()
	{
		return [
			[
				'module.add',
				[
					'acp',
					'ACP_CAT_DOT_MODS',
					'ACP_MERMAID'
				]
			],
			[
				'module.add',
				[
					'acp',
					'ACP_MERMAID',
					[
						'module_basename' => '\alfredoramos\mermaid\acp\main_module',
						'modes'	=> ['settings']
					]
				]
			]
		];
	}
}
