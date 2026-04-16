<?php

/**
 * Mermaid Diagrams extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2026 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\mermaid\tests\functional;

/**
 * @group functional
 */
class acp_mermaid_test extends \phpbb_functional_test_case
{
	use functional_test_case_trait;

	protected function init(): void
	{
		$this->add_lang_ext('alfredoramos/mermaid', 'acp/settings');
		$this->login();
		$this->admin_login();
	}

	public function test_settings_page()
	{
		$crawler = self::request('GET', 'adm/index.php?i=-alfredoramos-mermaid-acp-main_module&mode=settings&sid=' . $this->sid);
		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();

		$this->assertTrue($form->has('mermaid_theme'));
		$this->assertSame('default', $form->get('mermaid_theme')->getValue());

		$this->assertTrue($form->has('mermaid_look'));
		$this->assertSame('classic', $form->get('mermaid_look')->getValue());

		$this->assertTrue($form->has('mermaid_max_text_size'));
		$this->assertSame(50000, (int) $form->get('mermaid_max_text_size')->getValue());

		$this->assertTrue($form->has('mermaid_max_edges'));
		$this->assertSame(500, (int) $form->get('mermaid_max_edges')->getValue());

		$form = $crawler->selectButton($this->lang('SUBMIT'))->form([
			'mermaid_theme' => 'redux',
			'mermaid_look' => 'neo',
			'mermaid_max_text_size' => 1000000,
			'mermaid_max_edges' => 2000
		]);
		self::submit($form);

		$crawler = self::request('GET', 'adm/index.php?i=-alfredoramos-mermaid-acp-main_module&mode=settings&sid=' . $this->sid);
		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();

		$this->assertTrue($form->has('mermaid_theme'));
		$this->assertSame('redux', $form->get('mermaid_theme')->getValue());

		$this->assertTrue($form->has('mermaid_look'));
		$this->assertSame('neo', $form->get('mermaid_look')->getValue());

		$this->assertTrue($form->has('mermaid_max_text_size'));
		$this->assertSame(1000000, (int) $form->get('mermaid_max_text_size')->getValue());

		$this->assertTrue($form->has('mermaid_max_edges'));
		$this->assertSame(2000, (int) $form->get('mermaid_max_edges')->getValue());/*  */
	}
}
