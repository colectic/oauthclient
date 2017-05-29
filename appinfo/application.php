<?php
/**
 * ownCloud - oauthclient
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Fèlix Casanellas <felix.casanellas@elteb.org>
 * @copyright Fèlix Casanellas 2017
 */

namespace OCA\OauthClient\AppInfo;


use \OCP\AppFramework\App;
use \OCP\AppFramework\IAppContainer;

use \OCA\OauthClient\Controller\AuthController;
use \OCA\OauthClient\Controller\SettingsController;

class Application extends App {

	public function __construct (array $urlParams=array()) {
		parent::__construct('oauthclient', $urlParams);
		$container = $this->getContainer();

		/**
		 * Controllers
		 */
		$container->registerService('AuthController', function(IAppContainer $c) {
			$server = $c->getServer();
			return new AuthController(
				$c->getAppName(),
				$server->getRequest(),
				$server->getUserManager(),
				$server->getUserSession(),
				$server->getGroupManager(),
				$server->getConfig()
			);
		});

		$container->registerService('SettingsController', function(IAppContainer $c) {
			$server = $c->getServer();
			return new SettingsController(
				$c->getAppName(),
				$server->getRequest(),
				$server->getConfig()
			);
		});
	}

	public function registerSettings() {
		// Register settings scripts
		\OCP\App::registerAdmin('oauthclient', 'settings/admin');
	}
}
