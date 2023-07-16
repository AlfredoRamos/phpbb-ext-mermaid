<?php

/**
 * Mermaid Diagrams extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@protonmail.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\mermaid\tests\functional;

/**
 * @group functional
 */
class mermaid_test extends \phpbb_functional_test_case
{
	static protected function setup_extensions()
	{
		return ['alfredoramos/mermaid'];
	}

	protected function setUp(): void
	{
		parent::setUp();
		$this->add_lang_ext('alfredoramos/mermaid', 'posting');
		$this->login();
	}

	public function test_post_mermaid()
	{
		$bbcode = <<<EOT
[mermaid]graph TD;
    A-->B;
    A-->C;
    B-->D;
    C-->D;[/mermaid]
EOT;
		$post = $this->create_topic(
			2,
			'Mermaid functional test 1',
			$bbcode
		);

		$crawler = self::request('GET', sprintf(
			'viewtopic.php?t=%d&sid=%s',
			$post['topic_id'],
			$this->sid
		));

		if (version_compare(PHP_VERSION, '7.3.0', '<'))
		{
			$expected = <<<EOT
<div class="mermaid-wrapper">
<figure class="mermaid">graph TD;
    A--&gt;B;
    A--&gt;C;
    B--&gt;D;
    C--&gt;D;</figure><div class="mermaidTooltip"></div>
</div>
EOT;
		}
		else
		{
			$expected = <<<EOT
<div class="mermaid-wrapper"><figure class="mermaid">graph TD;
    A--&gt;B;
    A--&gt;C;
    B--&gt;D;
    C--&gt;D;</figure><div class="mermaidTooltip"></div></div>
EOT;
		}

		$result = $crawler->filter(sprintf(
			'#post_content%d .content',
			$post['topic_id']
		));

		$elements = $result->filter('.mermaid');

		$this->assertSame(1, $elements->count());
		$this->assertStringContainsString($expected, $result->html());
	}

	public function test_post_mermaid_reply()
	{
		$crawler = self::request('GET', sprintf(
			'posting.php?mode=reply&f=2&t=1&sid=%s',
			$this->sid
		));

		$button = $crawler->filter('.format-buttons .bbcode-mermaid');

		$this->assertSame(1, $button->count());
		$this->assertStringContainsString(
			$this->lang('MERMAID'),
			$button->attr('value')
		);
		$this->assertStringContainsString(
			$this->lang('MERMAID_HELPLINE'),
			$button->attr('title')
		);
		$this->assertSame('m', $button->attr('accesskey'));
	}
}
