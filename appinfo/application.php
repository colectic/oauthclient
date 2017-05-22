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

use \OCA\OauthClient\Controller\AuthController;
use \OCA\OauthClient\Service\UserService;


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
				$c->query('Request'),
				$c->query('UserService')
			);
		});

		$container->registerService('UserService', function($c) {
        return new UserService(
            $c->query('UserManager')
        );
    });

    $container->registerService('UserManager', function($c) {
        return $c->query('ServerContainer')->getUserManager();
    });
	}


}
