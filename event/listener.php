<?php

/**
 * Mermaid extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\mermaid\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	public function __construct()
	{
	}

	static public function getSubscribedEvents()
	{
		return [
			'core.text_formatter_s9e_configure_after' => 'configure_mermaid'
		];
	}

	public function configure_mermaid($event)
	{
		$configurator = $event['configurator'];

		if (!isset($configurator->BBCodes['mermaid']))
		{
			$configurator->BBCodes->addCustom(
				'[mermaid #disableAutoLineBreaks=true #createParagraphs=false #ignoreTags=true]{TEXT}[/mermaid]',
				'<div class="mermaid">{TEXT}</div>'
			);
		}
	}
}
