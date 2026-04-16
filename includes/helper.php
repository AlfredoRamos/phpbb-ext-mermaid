<?php

/**
 * Mermaid Diagrams extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2026 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\mermaid\includes;

use phpbb\language\language;

class helper
{
	/** @var language */
	protected language $language;

	/** @var array */
	// https://mermaid.ai/open-source/config/schema-docs/config-properties-theme.html
	public const MERMAID_THEMES = ['default', 'base', 'dark', 'forest', 'neutral', 'neo', 'neo-dark', 'redux', 'redux-dark', 'redux-color', 'redux-dark-color', 'null'];

	/** @var array */
	// https://mermaid.ai/open-source/config/schema-docs/config-properties-look.html
	public const MERMAID_LOOKS = ['classic', 'handDrawn', 'neo'];

	/** @var int */
	public const MERMAID_MIN_TEXT_SIZE = 5000;

	/** @var int */
	public const MERMAID_DEFAULT_TEXT_SIZE = 50000;

	/** @var int */
	public const MERMAID_MAX_TEXT_SIZE = 5000000;

	/** @var int */
	public const MERMAID_MIN_EDGES = 50;

	/** @var int */
	public const MERMAID_DEFAULT_EDGES = 500;

	/** @var int */
	public const MERMAID_MAX_EDGES = 50000;

	/** @var string */
	public const SUPPORT_FAQ = 'https://www.phpbb.com/customise/db/extension/mermaid/faq';

	/** @var string */
	public const SUPPORT_URL = 'https://www.phpbb.com/customise/db/extension/mermaid/support';

	/** @var string */
	public const VENDOR_DONATE = 'https://alfredoramos.mx/donate/';

	/**
	 * Helper constructor.
	 *
	 * @param language $language
	 *
	 * @return void
	 */
	public function __construct(language $language)
	{
		$this->language = $language;
	}

	/**
	 * Validate form fields with given filters.
	 *
	 * @param array $fields		Pair of field name and value
	 * @param array $filters	Filters that will be passed to filter_var_array()
	 * @param array $errors		Array of message errors
	 *
	 * @return bool
	 */
	public function validate(array &$fields = null, array &$filters = null, array &$errors = null): bool
	{
		$fields = $fields ?? [];
		$filters = $filters ?? [];
		$errors = $errors ?? [];

		if (empty($fields) || empty($filters))
		{
			return false;
		}

		// Filter fields
		$data = filter_var_array($fields, $filters, false);

		// Invalid fields helper
		$invalid = [];

		// Validate fields
		foreach ($data as $key => $value)
		{
			// Remove and generate error if field did not pass validation
			// Not using empty() because an empty string can be a valid value
			if (!isset($value) || $value === false)
			{
				$invalid[] = $this->language->lang(strtoupper($key));
				unset($fields[$key]);
			}
		}

		if (!empty($invalid))
		{
			$errors[]['message'] = $this->language->lang(
				'ACP_MERMAID_VALIDATE_INVALID_FIELDS',
				implode($this->language->lang('COMMA_SEPARATOR'), $invalid)
			);
		}

		// Validation check
		return empty($errors);
	}
}
