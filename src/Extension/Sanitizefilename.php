<?php

/**
 * @package     Joomla.Plugin
 * @subpackage  Media-Action.sanitizefilename
 *
 * @copyright   Copyright (C) 2025 HKweb <https://hkweb.nl>
 * @license     GNU General Public License version 3; see LICENSE.txt
 */

declare(strict_types=1);

namespace Joomla\Plugin\MediaAction\Sanitizefilename\Extension;

use Joomla\CMS\Event\Model\BeforeSaveEvent;
use Joomla\CMS\Factory;
use Joomla\Component\Media\Administrator\Plugin\MediaActionPlugin;
use Joomla\Event\SubscriberInterface;
use Joomla\Plugin\MediaAction\Sanitizefilename\Enum\ReplacementChar;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') || die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Media Manager Sanitize Filename Action
 * Automatically sanitizes filenames by replacing spaces and special characters
 *
 * @since  1.0.0
 */
final class Sanitizefilename extends MediaActionPlugin implements SubscriberInterface
{
	/**
	 * Returns an array of events this subscriber will listen to.
	 *
	 * @return  array
	 *
	 * @since   1.0.0
	 */
	public static function getSubscribedEvents(): array
	{
		return array_merge(parent::getSubscribedEvents(), [
			'onContentBeforeSave' => 'onContentBeforeSave',
		]);
	}

	/**
	 * The save event. Sanitize filename by replacing spaces and special characters.
	 *
	 * @param   BeforeSaveEvent $event  The event instance
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function onContentBeforeSave(BeforeSaveEvent $event): void
	{
		$context = $event->getContext();
		$item    = $event->getItem();

		// Only process media files
		if ($context !== 'com_media.file') {
			return;
		}

		// Get original filename
		$filename = $item->name ?? '';

		if (empty($filename)) {
			return;
		}

		// Split filename and extension
		$pathInfo  = pathinfo($filename);
		$basename  = $pathInfo['filename'] ?? $filename;
		$extension = isset($pathInfo['extension']) ? '.' . $pathInfo['extension'] : '';

		// Apply sanitization
		$sanitized = $this->sanitizeFilename($basename);

		// Never end up with an empty basename (for example when nothing usable is left)
		if ($sanitized === '') {
			$sanitized = $this->buildFallbackName();
		}

		// Update the item name
		$item->name = $sanitized . $extension;
	}

	/**
	 * Sanitize a filename string
	 *
	 * @param   string  $filename  The filename to sanitize
	 *
	 * @return  string  The sanitized filename
	 *
	 * @since   1.0.0
	 */
	private function sanitizeFilename(string $filename): string
	{
		$replaceSpaces     = (bool) $this->params->get('replace_spaces', 1);
		$replacementChar   = $this->params->get('replacement_char', '-');
		$lowercase         = (bool) $this->params->get('lowercase', 1);
		$removeSpecial     = (bool) $this->params->get('remove_special', 1);
		$transliterate     = (bool) $this->params->get('transliterate', 0);

		// Get replacement character enum
		$replacement = ReplacementChar::tryFromValue($replacementChar) ?? ReplacementChar::HYPHEN;
		$replaceWith = $replacement->getValue();

		// Optionally convert non-Latin scripts to ASCII
		if ($transliterate) {
			$filename = $this->transliterate($filename);
		}

		// Replace spaces and underscores with chosen character
		if ($replaceSpaces) {
			$filename = str_replace([' ', '_'], $replaceWith, $filename);
		}

		// Remove special characters
		if ($removeSpecial) {
			// Transliterated names stay ASCII, otherwise keep letters, marks and numbers of any script
			$keepChars = $transliterate ? 'A-Za-z0-9\-_\.' : '\p{L}\p{M}\p{N}\-_\.';
			$filename  = (string) preg_replace('/[^' . $keepChars . ']/u', '', $filename);
		}

		// Convert to lowercase
		if ($lowercase) {
			$filename = mb_strtolower($filename, 'UTF-8');
		}

		// Remove multiple consecutive replacement characters (if not empty)
		if ($replaceWith !== '') {
			$pattern  = '/' . preg_quote($replaceWith, '/') . '+/u';
			$filename = (string) preg_replace($pattern, $replaceWith, $filename);

			// Trim replacement character from start and end
			$filename = trim($filename, $replaceWith);
		}

		return $filename;
	}

	/**
	 * Convert a string to ASCII. Uses the PHP intl extension when available and falls back
	 * to the Joomla language transliteration otherwise.
	 *
	 * @param   string  $value  The string to transliterate
	 *
	 * @return  string  The transliterated string
	 *
	 * @since   1.1.0
	 */
	private function transliterate(string $value): string
	{
		if (\function_exists('transliterator_transliterate')) {
			$transliterated = transliterator_transliterate('Any-Latin; Latin-ASCII', $value);

			if (\is_string($transliterated)) {
				return $transliterated;
			}
		}

		return Factory::getApplication()->getLanguage()->transliterate($value);
	}

	/**
	 * Build a fallback basename for when sanitizing leaves nothing usable.
	 *
	 * @return  string  The fallback basename
	 *
	 * @since   1.1.0
	 */
	private function buildFallbackName(): string
	{
		return 'file-' . bin2hex(random_bytes(4));
	}
}
