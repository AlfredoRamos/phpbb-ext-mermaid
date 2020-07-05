<?php

/**
 * Mermaid Diagrams extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\mermaid\event;

use phpbb\config\config;
use phpbb\template\template;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/**
	 * Event constructor.
	 *
	 * @param \phpbb\config\config		$config
	 * @param \phpbb\template\template	$template
	 *
	 * @return void
	 */
	public function __construct(config $config, template $template)
	{
		$this->config = $config;
		$this->template = $template;
	}

	/**
	 * Assign functions defined in this class to event listeners in the core.
	 *
	 * @return array
	 */
	static public function getSubscribedEvents()
	{
		return [
			'core.user_setup' => 'setup_language',
			'core.user_setup_after' => 'assign_template_variables',
			'core.text_formatter_s9e_configure_after' => 'configure_mermaid'
		];
	}

	/**
	 * Load language files.
	 *
	 * @param object $event
	 *
	 * @return void
	 */
	public function setup_language($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = [
			'ext_name'	=> 'alfredoramos/mermaid',
			'lang_set'	=> 'posting'
		];
		$event['lang_set_ext'] = $lang_set_ext;
	}

	/**
	 * Assign global template variables.
	 *
	 * @return void
	 */
	public function assign_template_variables()
	{
		if (empty($this->config['mermaid_live_editor_url']))
		{
			return;
		}

		$this->template->assign_var(
			'MERMAID_LIVE_EDITOR_URL',
			$this->config['mermaid_live_editor_url']
		);
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
			'bbcode_tpl'	=> '<figure class="mermaid">{TEXT}</figure>'
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
}
