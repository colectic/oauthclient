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
use \OCP\AppFramework\Http\RedirectResponse;
use \OCP\IUserManager;
use \OCP\IUserSession;

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
   * @PublicPage
   */
  public function login($code=null) {
    /**
     * TODO: Agafar aquests paràmetres de la configuració
     */
    $clientid     = 'e63b7303a7a6443e7ce50414773b7d1f0a1b9033ae1020534c7440888e4e8633';
    $clientsecret = 'de5d9a3ed59694dacd5a5f06e6998c8d69a8ecbe044acb690dc99a72e8aed315';
    $redirecturi  = 'https://betafitxers.barcelonaencomu.cat/index.php/apps/oauthclient';
    $autorizationendpoint = 'https://betaparticipa.barcelonaencomu.cat/oauth/authorize';
    $tokenendpoint         = 'https://betaparticipa.barcelonaencomu.cat/oauth/token';
    $apiendpoint = 'https://betaparticipa.barcelonaencomu.cat/api/v2/users/me';

    $oauthclient = new \OAuth2\Client($clientid, $clientsecret);

    /*$user = $this->userManager->get('usu1');
    $pass = rand();
    $user->setPassword($pass, $pass);
    $this->userSession->login('usu1', $pass);
    $this->userSession->createSessionToken($this->request, 'usu1', 'usu1', $pass);
    return new RedirectResponse('/index.php/apps/files');*/

    if (!$code) {
      $authurl = $oauthclient->getAuthenticationUrl($autorizationendpoint, $redirecturi);
      return new RedirectResponse($authurl);
    } else {
      $params = array('code' => $code, 'redirect_uri' => $redirecturi);
      $response = $oauthclient->getAccessToken($tokenendpoint, 'authorization_code', $params);
      $oauthclient->setAccessToken($response['result']['access_token']);
      $response = $oauthclient->fetch($apiendpoint);
      $result = $response['result'];

			if(empty($result)) die('token error'); //TODO: tractar l'error

			$pass = rand();
			$uid = 'oauth-user-'.$result['id'];
			$displayname = ucwords(tr_replace('-', ' '));


      //Check if user exists
      if ($this->userManager->userExists($uid)) {
        $user = $this->userManager->get($uid);
        $user->setPassword($pass);
      } else {
				$user = $this->userManager->createUser($uid, $pass);
				$user->setDisplayName($displayname);
      }
			$this->userSession->login($uid, $pass);
			$this->userSession->createSessionToken($this->request, $user->getUID(), $uid, $pass);
			return new RedirectResponse('/index.php/apps/files');
    }
  }
}
