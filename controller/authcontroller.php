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
use \OCP\IGroupManager;

require_once __DIR__ . '/../3rdparty/vendor/autoload.php';

class AuthController extends Controller {

	private $userManager;
	private $userSession;
	private $groupManager;
	private $config;

  public function __construct($appName, $request,
    								IUserManager $userManager,
		                IUserSession $userSession,
										IGroupManager $groupManager,
										IConfig $config
  ){
      parent::__construct($appName, $request);
      $this->userSession = $userSession;
		  $this->userManager = $userManager;
			$this->groupManager = $groupManager;
			$this->config = $config;
  }

  /**
   * @NoAdminRequired
   * @NoCSRFRequired
   * @PublicPage
   */
  public function login($code=null) {
		$this->config->getAppValue('oauthclient', 'clientid', '');

		$clientid     = $this->config->getAppValue('oauthclient', 'clientid', '');
		$clientsecret = $this->config->getAppValue('oauthclient', 'clientsecret', '');
		$redirecturi  = $this->config->getAppValue('oauthclient', 'redirecturi', '');
		$autorizationendpoint = $this->config->getAppValue('oauthclient', 'autorizationendpoint', '');
		$tokenendpoint = $this->config->getAppValue('oauthclient', 'tokenendpoint', '');
		$apiendpoint = $this->config->getAppValue('oauthclient', 'apiendpoint', '');

    $oauthclient = new \OAuth2\Client($clientid, $clientsecret);

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
			$displayname = $result['full_name'];
			$groups = $result['list_groups'];

      //Check if user exists
      if ($this->userManager->userExists($uid)) {
        $user = $this->userManager->get($uid);
				$old_groups = $this->groupManager->getUserGroupIds($user);
				foreach ($groups as $guid) {
					if (!in_array($guid, $old_groups)) {
							//Add to new groups
							$group = $this->groupManager->get($guid);
							$group->addUser($user);
					}
				}
				foreach ($old_groups as $guid) {
					if (!in_array($guid, $groups)) {
						//Remove old group
						$group = $this->groupManager->get($guid);
						$group->removeUser($user);
					}
				}
        $user->setPassword($pass);
      } else {
				$user = $this->userManager->createUser($uid, $pass);
				$user->setDisplayName($displayname);
				foreach ($groups as $guid) {
					$group = $this->groupManager->get($guid);
					$group->addUser($user);
				}
      }
			$this->userSession->login($uid, $pass);
			$this->userSession->createSessionToken($this->request, $user->getUID(), $uid, $pass);
			return new RedirectResponse('/index.php/apps/files');
    }
  }
}
