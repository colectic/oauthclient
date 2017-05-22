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

  public function __construct($appName, $request,
    								IUserManager $userManager,
    								IUserSession $userSession
  ){
      parent::__construct($appName, $request);
      $this->userSession = $userSession;
		  $this->userManager = $userManager;
  }

  /**
   * @NoAdminRequired
   * @NoCSRFRequired
   */
  public function login() {
    /**
     * TODO: Agafar aquests paràmetres de la configuració
     */
    $clientid     = 'e63b7303a7a6443e7ce50414773b7d1f0a1b9033ae1020534c7440888e4e8633';
    $clientsecret = 'de5d9a3ed59694dacd5a5f06e6998c8d69a8ecbe044acb690dc99a72e8aed315';
    $redirect_uri  = ' 	https://betaowncloud.barcelonaencomu.cat/remote.php';
    $autorization_endpoint = 'https://betaparticipa.barcelonaencomu.cat/oauth/authorize';
    $token_endpoint         = 'https://betaparticipa.barcelonaencomu.cat/oauth/token';
    $api_endpoint = 'https://betaparticipa.barcelonaencomu.cat/api/v2/users/me';

    $oauthclient = new \OAuth2\Client($clientid, $clientsecret);
    $auth_url = $oauthclient->getAuthenticationUrl($autorization_endpoint, $redirect_uri);
    header('Location: ' . $auth_url);
    die('Redirect');
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
