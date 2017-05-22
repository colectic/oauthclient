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
use \OCP\IContainer;

use \OCA\OauthClient\Controller\PageController;


class Application extends App {


	public function __construct (array $urlParams=array()) {
		parent::__construct('oauthclient', $urlParams);

		$container = $this->getContainer();

		/**
		 * Controllers
		 */
		$container->registerService('AuthController', function(IContainer $c) {
			return new AuthController(
				$c->query('AppName'),
				$c->query('Request')
			);
		});
	}


}
