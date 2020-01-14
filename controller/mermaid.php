<?php

/**
 * Mermaid Diagrams extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\mermaid\controller;

use phpbb\user;
use phpbb\request\request;
use phpbb\controller\helper;
use phpbb\language\language;
use phpbb\exception\http_exception;

class mermaid
{
	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\language\language */
	protected $language;

	/**
	 * Controller helper.
	 *
	 * @param \phpbb\user				$user
	 * @param \phpbb\request\request	$request
	 * @param \phpbb\controller\helper	$helper
	 * @param \phpbb\language\language	$language
	 *
	 * @return void
	 */
	public function __construct(user $user, request $request, helper $helper, language $language)
	{
		$this->user = $user;
		$this->request = $request;
		$this->helper = $helper;
		$this->language = $language;
	}

	/**
	 * Mermaid live editor controller handler.
	 *
	 * @param string $hash
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function editor($hash = '')
	{
		// Users do not need to know this page exist
		if (!$this->request->is_ajax())
		{
			throw new http_exception(404, 'PAGE_NOT_FOUND');
		}

		// Security hash
		$hash = trim($hash);

		// CSRF protection and user verification
		if (
			empty($hash) ||
			!check_link_hash($hash, 'mermaid_editor') ||
			(int) $this->user->data['user_id'] === ANONYMOUS ||
			$this->user->data['is_bot']
		)
		{
			throw new http_exception(403, 'NO_AUTH_OPERATION');
		}

		$this->language->add_lang('viewtopic');
		$this->language->add_lang('controller', 'alfredoramos/mermaid');

		return $this->helper->render('mermaid_editor.html');
	}
}
