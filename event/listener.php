<?php

/**
 * Mermaid Diagrams extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\mermaid\event;

use phpbb\auth\auth;
use phpbb\config\config;
use phpbb\user;
use phpbb\request\request;
use phpbb\template\template;
use phpbb\language\language;
use alfredoramos\mermaid\includes\helper;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	/** @var auth */
	protected $auth;

	/** @var config */
	protected $config;

	/** @var user */
	protected $user;

	/** @var request */
	protected $request;

	/** @var template */
	protected $template;

	/** @var language */
	protected $language;

	/** @var helper */
	protected $helper;

	/** @array */
	protected $tables = [];

	/**
	 * Listener constructor.
	 *
	 * @param auth		$auth
	 * @param config	$config
	 * @param language	$language
	 *
	 * @return void
	 */
	public function __construct(auth $auth, config $config, language $language)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->language = $language;
	}

	/**
	 * Assign functions defined in this class to event listeners in the core.
	 *
	 * @return array
	 */
	static public function getSubscribedEvents()
	{
		return [
			'core.user_setup' => 'load_language',
			'core.text_formatter_s9e_configure_after' => 'configure_mermaid',
			'core.posting_modify_template_vars' => 'posting_template_variables',
		];
	}

	/**
	 * Load language files.
	 *
	 * @param object $event
	 *
	 * @return void
	 */
	public function load_language($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = [
			'ext_name'	=> 'alfredoramos/mermaid',
			'lang_set'	=> 'posting'
		];
		$event['lang_set_ext'] = $lang_set_ext;
	}

	/**
	 * Configure BBCode.
	 *
	 * @param object $event
	 *
	 * @return void
	 */
	public function configure_mermaid($event)
	{
		$configurator = $event['configurator'];
		$mermaid = [
			'bbcode_tag'	=> 'mermaid',
			'bbcode_match'	=> '[mermaid #disableAutoLineBreaks=true #createParagraphs=false #ignoreTags=true]{TEXT}[/mermaid]',
			'bbcode_tpl'	=> '<div class="mermaid-container"><figure class="mermaid">{TEXT}</figure><div class="mermaidTooltip"></div></div>'
		];

		// Remove previous definitions
		unset(
			$configurator->BBCodes[$mermaid['bbcode_tag']],
			$configurator->tags[$mermaid['bbcode_tag']]
		);

		// Create mermaid BBCode
		$configurator->BBCodes->addCustom(
			$mermaid['bbcode_match'],
			$mermaid['bbcode_tpl']
		);
	}

	/**
	 * Set template variables in posting editor.
	 *
	 * @param object $event
	 *
	 * @return void
	 */
	public function posting_template_variables($event)
	{
		$allowed = !empty($this->config['allow_bbcode']) &&
			!empty($this->auth->acl_get('f_bbcode', $event['forum_id']));

		$event['page_data'] = array_merge($event['page_data'], [
			'U_MERMAID_LIVE_EDITOR' => trim($this->config['mermaid_live_editor_url']),
			'S_MERMAID_ALLOWED' => $allowed,
			'L_MERMAID_STATUS' => $this->language->lang(
				'MERMAID_STATUS_FORMAT',
				$allowed ? $this->language->lang('MERMAID_IS_ON') : $this->language->lang('MERMAID_IS_OFF')
			),
			'S_MERMAID_CHECKED' => (empty($event['post_data']['enable_mermaid']) ? ' checked="checked"' : '')
		]);
	}
}
