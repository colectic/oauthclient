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

if (\OCP\App::isEnabled('oauthclient')) {
  if (!\OCP\User::isLoggedIn()) {
		// Load js code in order to render the Oauth link and to hide parts of the normal login form
		\OCP\Util::addScript('oauthclient', 'login');
	}

  $app = new Application();
  $app->registerSettings();
}
