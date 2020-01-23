<?php

/**
 * Mermaid Diagrams extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\mermaid\tests\event;

use phpbb_test_case;
use phpbb\template\template;
use phpbb\routing\helper as routing_helper;
use alfredoramos\mermaid\event\listener;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @group event
 */
class listener_test extends phpbb_test_case
{
	protected $template;
	protected $routing_helper;

	public function setUp(): void
	{
		parent::setUp();

		$this->template = $this->getMockBuilder(template::class)->getMock();
		$this->routing_helper = $this->getMockBuilder(routing_helper::class)
			->disableOriginalConstructor()->getMock();
	}

	public function test_instance()
	{
		$this->assertInstanceOf(
			EventSubscriberInterface::class,
			new listener(
				$this->template,
				$this->routing_helper
			)
		);
	}

	public function test_subscribed_events()
	{
		$this->assertSame(
			[
				'core.user_setup',
				'core.user_setup_after',
				'core.text_formatter_s9e_configure_after'
			],
			array_keys(listener::getSubscribedEvents())
		);
	}
}
