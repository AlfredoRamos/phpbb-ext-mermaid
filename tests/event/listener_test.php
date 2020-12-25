<?php

/**
 * Mermaid Diagrams extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\mermaid\tests\event;

use phpbb\config\config;
use phpbb\template\template;
use alfredoramos\mermaid\event\listener;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @group event
 */
class listener_test extends \phpbb_test_case
{
	protected $config;
	protected $template;

	protected function setUp(): void
	{
		parent::setUp();
		$this->config = $this->getMockBuilder(config::class)
			->disableOriginalConstructor()->getMock();
		$this->template = $this->getMockBuilder(template::class)->getMock();
	}

	public function test_instance()
	{
		$this->assertInstanceOf(
			EventSubscriberInterface::class,
			new listener(
				$this->config,
				$this->template
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
