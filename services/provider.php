<?php

/**
 * @package     Joomla.Plugin
 * @subpackage  Media-Action.sanitizefilename
 *
 * @copyright   Copyright (C) 2025 HKweb <https://hkweb.nl>
 * @license     GNU General Public License version 3; see LICENSE.txt
 */

\defined('_JEXEC') || die;

use Joomla\CMS\Extension\PluginInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Plugin\MediaAction\Sanitizefilename\Extension\Sanitizefilename;

return new class () implements ServiceProviderInterface {
	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function register(Container $container): void
	{
		$container->set(
			PluginInterface::class,
			function (Container $container) {
				$plugin     = new Sanitizefilename(
					(array) PluginHelper::getPlugin('media-action', 'sanitizefilename')
				);
				$plugin->setApplication(Factory::getApplication());

				return $plugin;
			}
		);
	}
};
