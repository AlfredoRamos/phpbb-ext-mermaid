<?php

/**
 * Mermaid Diagrams extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@protonmail.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\mermaid\migrations\v10x;

use phpbb\db\migration\migration;

class m01_board_configuration extends migration
{
	/**
	 * Add Mermaid configuration.
	 *
	 * @return array
	 */
	public function update_data()
	{
		return [
			[
				'config.add',
				['mermaid_live_editor_url', 'https://mermaid-js.github.io/mermaid-live-editor']
			]
		];
	}
}
