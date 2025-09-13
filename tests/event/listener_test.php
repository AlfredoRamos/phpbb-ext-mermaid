<?php

/**
 * Mermaid Diagrams extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\mermaid\tests\event;

use phpbb\auth\auth;
use phpbb\config\config;
use phpbb\language\language;
use alfredoramos\mermaid\event\listener;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @group event
 */
class listener_test extends \phpbb_test_case
{
	protected $auth;
	protected $config;
	protected $language;

	protected function setUp(): void
	{
		parent::setUp();
		$this->auth = $this->getMockBuilder(auth::class)->getMock();
		$this->config = $this->getMockBuilder(config::class)
			->disableOriginalConstructor()->getMock();
		$this->language = $this->getMockBuilder(language::class)
			->disableOriginalConstructor()->getMock();
	}

	public function test_instance()
	{
		$this->assertInstanceOf(
			EventSubscriberInterface::class,
			new listener(
				$this->auth,
				$this->config,
				$this->language
			)
		);
	}

	public function test_subscribed_events()
	{
		$this->assertSame(
			[
				'core.user_setup',
				'core.text_formatter_s9e_configure_after',
				'core.posting_modify_template_vars'
			],
			array_keys(listener::getSubscribedEvents())
		);
	}
}
