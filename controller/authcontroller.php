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

namespace OCA\OauthClient\Controller;

use \OCP\AppFramework\Controller;

class AuthController extends Controller {

  /**
   * @NoAdminRequired
   * @NoCSRFRequired
   */
  public function callback() {
    die('hola');
  }

}
