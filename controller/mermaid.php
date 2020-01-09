<?php

/**
 * Mermaid Diagrams extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\mermaid\controller;

use phpbb\controller\helper;
use phpbb\language\language;

class mermaid
{
	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\language\language */
	protected $language;

	/**
	 * Controller helper.
	 *
	 * @param \phpbb\controller\helper
	 * @param \phpbb\language\language
	 *
	 * @return void
	 */
	public function __construct(helper $helper, language $language)
	{
		$this->helper = $helper;
		$this->language = $language;
	}

	/**
	 * Mermaid live editor controller handler.
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function editor()
	{
		$this->language->add_lang('viewtopic');
		$this->language->add_lang('controller', 'alfredoramos/mermaid');

		return $this->helper->render('mermaid_live_editor.html');
	}
}
