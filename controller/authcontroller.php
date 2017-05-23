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

use \OC\User\Session;
use \OCP\AppFramework\Controller;
use \OCP\AppFramework\Http\RedirectResponse;
use \OCP\IUserManager;
use \OCP\IUserSession;

require_once __DIR__ . '/../3rdparty/vendor/autoload.php';

class AuthController extends Controller {

	private $userManager;
	private $userSession;

  public function __construct($appName, $request,
    								IUserManager $userManager
		                IUserSession $userSession
  ){
      parent::__construct($appName, $request);
      $this->userSession = $userSession;
		  $this->userManager = $userManager;
  }

  /**
   * @NoAdminRequired
   * @NoCSRFRequired
   * @PublicPage
   */
  public function login($code=null) {
    /**
     * TODO: Agafar aquests paràmetres de la configuració
     */
    $clientid     = 'e63b7303a7a6443e7ce50414773b7d1f0a1b9033ae1020534c7440888e4e8633';
    $clientsecret = 'de5d9a3ed59694dacd5a5f06e6998c8d69a8ecbe044acb690dc99a72e8aed315';
    $redirect_uri  = 'https://betaowncloud.barcelonaencomu.cat/index.php/apps/oauthclient';
    $autorization_endpoint = 'https://betaparticipa.barcelonaencomu.cat/oauth/authorize';
    $token_endpoint         = 'https://betaparticipa.barcelonaencomu.cat/oauth/token';
    $api_endpoint = 'https://betaparticipa.barcelonaencomu.cat/api/v2/users/me';

    $oauthclient = new \OAuth2\Client($clientid, $clientsecret);

    if (!$code) {
      $auth_url = $oauthclient->getAuthenticationUrl($autorization_endpoint, $redirect_uri);
      return new RedirectResponse($auth_url);
    } else {
      $params = array('code' => $code, 'redirect_uri' => $redirect_uri);
      $response = $oauthclient->getAccessToken($token_endpoint, 'authorization_code', $params);
      $oauthclient->setAccessToken($response['result']['access_token']);
      $response = $oauthclient->fetch($api_endpoint);
      $result = $response['result'];

      //Check if user exists
      if ($this->userManager->userExists($result['username'])) {
        //Set user
        $user = $this->userManager->get($result['username']);
        $loginResult = $this->userManager->checkPassword($result['username'], '123456789');

        $this->userSession->login($result['username'], '123456789');
        $this->session->createSessionToken($this->request, $loginResult->getUID(), $result['username'], '123456789');

        //print_r($loginResult); die();

        //$this->userSession->setUser($user);
        //$this->session->login($result['username'], '123456789');
        return new RedirectResponse('/');
      } else {
        //Create the user
        die('create user');
      }
      print_r($response); die();
    }
  }
}
