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

use OCP\AppFramework\Controller;
use OCP\IUserSession;
use OCP\IUserManager;

require_once __DIR__ . '/../3rdparty/vendor/autoload.php';

class AuthController extends Controller {

	private $userManager;
	private $userSession;
  private $oauthClient;

  public function __construct($appName, $request,
    								IUserManager $userManager,
    								IUserSession $userSession
  ){
      parent::__construct($appName, $request);
      $this->userSession = $userSession;
		  $this->userManager = $userManager;

      /**
       * TODO: Agafar aquests paràmetres de la configuració
       */
      $client_id     = 'e63b7303a7a6443e7ce50414773b7d1f0a1b9033ae1020534c7440888e4e8633';
      $client_secret = 'de5d9a3ed59694dacd5a5f06e6998c8d69a8ecbe044acb690dc99a72e8aed315';
      $this->oauthClient = new \OAuth2\Client($client_id, $client_secret);
  }

  /**
   * @NoAdminRequired
   * @NoCSRFRequired
   */
  public function login() {
    $users = $this->userManager->countUsers();
    print_r($users); die('hi');
  }

  /**
   * @NoAdminRequired
   * @NoCSRFRequired
   */
  public function callback() {
    $users = $this->userManager->countUsers();
    print_r($users); die('hi');
  }
}
