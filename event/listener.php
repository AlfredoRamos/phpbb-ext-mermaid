<?php

/**
 * Mermaid Diagrams extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\mermaid\event;

use phpbb\template\template;
use phpbb\routing\helper as routing_helper;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\routing\helper */
	protected $routing_helper;

	/**
	 * Listener constructor.
	 *
	 * @param \phpbb\template\template $template;
	 *
	 * @return void
	 */
	public function __construct(template $template, routing_helper $routing_helper)
	{
		$this->template = $template;
		$this->routing_helper = $routing_helper;
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
	 * Assign editor URL to template variable.
	 *
	 * @param object $event
	 *
	 * @return void
	 */
	public function assign_template_variables($event)
	{
		$this->template->assign_var(
			'MERMAID_EDITOR_URL',
			sprintf(
				'%s/%s',
				$this->routing_helper->route('alfredoramos_mermaid_editor'),
				generate_link_hash('mermaid_editor')
			)
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

		if (!isset($configurator->BBCodes['mermaid']))
		{
			$configurator->BBCodes->addCustom(
				'[mermaid #disableAutoLineBreaks=true #createParagraphs=false #ignoreTags=true]{TEXT}[/mermaid]',
				'<figure class="mermaid">{TEXT}</figure>'
			);
		}
	}
}
