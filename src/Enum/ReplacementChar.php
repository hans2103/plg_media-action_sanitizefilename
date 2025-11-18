<?php

/**
 * @package     Joomla.Plugin
 * @subpackage  Media-Action.sanitizefilename
 *
 * @copyright   Copyright (C) 2025 HKweb <https://hkweb.nl>
 * @license     GNU General Public License version 3; see LICENSE.txt
 */

namespace Joomla\Plugin\MediaAction\Sanitizefilename\Enum;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') || die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Replacement character options for filename sanitization
 *
 * @since  25.47.2
 */
enum ReplacementChar: string
{
	/**
	 * Replace with hyphen (-)
	 *
	 * @since  25.47.2
	 */
	case HYPHEN = '-';

	/**
	 * Replace with underscore (_)
	 *
	 * @since  25.47.2
	 */
	case UNDERSCORE = '_';

	/**
	 * Replace with dot (.)
	 *
	 * @since  25.47.2
	 */
	case DOT = '.';

	/**
	 * Remove spaces without replacement
	 *
	 * @since  25.47.2
	 */
	case NONE = '';

	/**
	 * Get human-readable label for the replacement character
	 *
	 * @return  string  The label
	 *
	 * @since   25.47.2
	 */
	public function getLabel(): string
	{
		return match($this) {
			self::HYPHEN => 'PLG_MEDIA-ACTION_SANITIZEFILENAME_REPLACEMENT_HYPHEN',
			self::UNDERSCORE => 'PLG_MEDIA-ACTION_SANITIZEFILENAME_REPLACEMENT_UNDERSCORE',
			self::DOT => 'PLG_MEDIA-ACTION_SANITIZEFILENAME_REPLACEMENT_DOT',
			self::NONE => 'PLG_MEDIA-ACTION_SANITIZEFILENAME_REPLACEMENT_NONE',
		};
	}

	/**
	 * Get replacement character value
	 *
	 * @return  string  The replacement character
	 *
	 * @since   25.47.2
	 */
	public function getValue(): string
	{
		return $this->value;
	}

	/**
	 * Create enum from string value
	 *
	 * @param   string  $value  The value to convert
	 *
	 * @return  self|null  The enum case or null if invalid
	 *
	 * @since   25.47.2
	 */
	public static function tryFromValue(string $value): ?self
	{
		return self::tryFrom($value);
	}
}
