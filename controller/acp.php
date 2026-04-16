<?php

/**
 * Mermaid Diagrams extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2026 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\mermaid\controller;

use phpbb\config\config;
use phpbb\template\template;
use phpbb\request\request;
use phpbb\language\language;
use phpbb\user;
use phpbb\log\log;
use alfredoramos\mermaid\includes\helper;

class acp
{
	/** @var config */
	protected config $config;

	/** @var template */
	protected template $template;

	/** @var request */
	protected request $request;

	/** @var language */
	protected language $language;

	/** @var user */
	protected user $user;

	/** @var log */
	protected log $log;

	/** @var helper */
	protected helper $helper;

	/**
	 * Controller constructor.
	 *
	 * @param config	$config
	 * @param template	$template
	 * @param request	$request
	 * @param language	$language
	 * @param user		$user
	 * @param log		$log
	 * @param helper	$helper
	 *
	 * @return void
	 */
	public function __construct(config $config, template $template, request $request, language $language, user $user, log $log, helper $helper)
	{
		$this->config = $config;
		$this->template = $template;
		$this->request = $request;
		$this->language = $language;
		$this->user = $user;
		$this->log = $log;
		$this->helper = $helper;
	}

	/**
	 * Settings mode page.
	 *
	 * @param string $u_action
	 *
	 * @return void
	 */
	public function settings_mode(string $u_action = ''): void
	{
		if (empty($u_action))
		{
			return;
		}

		// Validation errors
		$errors = [];

		// Field filters
		$filters = [
			'mermaid_theme' => [
				'filter' => FILTER_VALIDATE_REGEXP,
				'options' => [
					'regexp' => '#\A' . implode('|', $this->helper::MERMAID_THEMES) . '\z#'
				]
			],
			'mermaid_look' => [
				'filter' => FILTER_VALIDATE_REGEXP,
				'options' => [
					'regexp' => '#\A' . implode('|', $this->helper::MERMAID_LOOKS) . '\z#'
				]
			],
			'mermaid_max_text_size' => [
				'filter' => FILTER_VALIDATE_INT,
				'options' => [
					'min_range' => $this->helper::MERMAID_MIN_TEXT_SIZE,
					'max_range' => $this->helper::MERMAID_MAX_TEXT_SIZE,
				]
			],
			'mermaid_max_edges' => [
				'filter' => FILTER_VALIDATE_INT,
				'options' => [
					'min_range' => $this->helper::MERMAID_MIN_EDGES,
					'max_range' => $this->helper::MERMAID_MAX_EDGES,
				]
			]
		];

		// Request form data
		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key('alfredoramos_mermaid'))
			{
				trigger_error($this->language->lang('FORM_INVALID') . adm_back_link($u_action), E_USER_WARNING);
			}

			// Form data
			$fields = [
				'mermaid_theme' => $this->request->variable('mermaid_theme', $this->helper::MERMAID_THEMES[0]),
				'mermaid_look' => $this->request->variable('mermaid_look', $this->helper::MERMAID_LOOKS[0]),
				'mermaid_max_text_size' => $this->request->variable('mermaid_max_text_size', $this->helper::MERMAID_DEFAULT_TEXT_SIZE),
				'mermaid_max_edges' => $this->request->variable('mermaid_max_edges', $this->helper::MERMAID_DEFAULT_EDGES)
			];

			// Validation check
			if ($this->helper->validate($fields, $filters, $errors))
			{
				// Save configuration
				foreach ($fields as $key => $value)
				{
					$this->config->set($key, $value);
				}

				// Admin log
				$this->log->add(
					'admin',
					$this->user->data['user_id'],
					$this->user->ip,
					'LOG_MERMAID_DATA',
					false,
					[$this->language->lang('SETTINGS')]
				);

				// Confirm dialog
				trigger_error($this->language->lang('CONFIG_UPDATED') . adm_back_link($u_action));
			}
		}

		// Assign template variables
		$this->template->assign_vars([
			'ACP_MERMAID_SETTINGS_EXPLAIN' => $this->language->lang(
				'ACP_MERMAID_SETTINGS_EXPLAIN',
				$this->helper::SUPPORT_FAQ,
				$this->helper::SUPPORT_URL,
				$this->helper::VENDOR_DONATE,
			),
			'MERMAID_THEME' => $this->config->offsetGet('mermaid_theme'),
			'MERMAID_LOOK' => $this->config->offsetGet('mermaid_look'),
			'MERMAID_CFG_MIN_TEXT_SIZE' => $this->helper::MERMAID_MIN_TEXT_SIZE,
			'MERMAID_CFG_MAX_TEXT_SIZE' => $this->helper::MERMAID_MAX_TEXT_SIZE,
			'MERMAID_CFG_DEFAULT_TEXT_SIZE' => $this->helper::MERMAID_DEFAULT_TEXT_SIZE,
			'MERMAID_MAX_TEXT_SIZE' => (int) $this->config->offsetGet('mermaid_max_text_size'),
			'MERMAID_CFG_MIN_EDGES' => $this->helper::MERMAID_MIN_EDGES,
			'MERMAID_CFG_MAX_EDGES' => $this->helper::MERMAID_MAX_EDGES,
			'MERMAID_CFG_DEFAULT_EDGES' => $this->helper::MERMAID_DEFAULT_EDGES,
			'MERMAID_MAX_EDGES' => (int) $this->config->offsetGet('mermaid_max_edges')
		]);

		// Theme list
		foreach ($this->helper::MERMAID_THEMES as $key => $value)
		{
			$this->template->assign_block_vars('MERMAID_THEME_LIST', [
				'NAME' => $this->language->lang(sprintf('ACP_MERMAID_THEME_%s', strtoupper(str_replace('-', '_', $value)))),
				'VALUE' => $value,
				'SELECTED' => ($this->config->offsetGet('mermaid_theme') === $value)
			]);
		}

		// Look list
		foreach ($this->helper::MERMAID_LOOKS as $key => $value)
		{
			$this->template->assign_block_vars('MERMAID_LOOK_LIST', [
				'NAME' => $this->language->lang(sprintf('ACP_MERMAID_LOOK_%s', strtoupper(str_replace('-', '_', $value)))),
				'VALUE' => $value,
				'SELECTED' => ($this->config->offsetGet('mermaid_look') === $value)
			]);
		}

		// Validation errors
		foreach ($errors as $key => $value)
		{
			$this->template->assign_block_vars('VALIDATION_ERRORS', [
				'MESSAGE' => $value['message']
			]);
		}
	}
}
