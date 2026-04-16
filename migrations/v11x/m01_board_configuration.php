<?php

/**
 * Mermaid Diagrams extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2026 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\mermaid\migrations\v11x;

use phpbb\db\migration\migration;

class m01_board_configuration extends migration
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
	 * Add Mermaid configuration.
	 *
	 * @return array
	 */
	public function update_data()
	{
		return [
			[
				'config.update',
				['mermaid_live_editor_url', 'https://mermaid.ai/live/']
			],
			[
				'config.add',
				['mermaid_theme', 'default']
			],
			[
				'config.add',
				['mermaid_look', 'classic']
			],
			[
				'config.add',
				['mermaid_max_text_size', 50000]
			],
			[
				'config.add',
				['mermaid_max_edges', 500]
			]
		];
	}
}
