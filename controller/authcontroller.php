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

class AuthController extends Controller {

  /** @var IUserManager */
	private $userManager;

	/** @var IUserSession */
	private $userSession;

  public function __construct($appName,
                    IRequest $request,
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
  public function callback() {
    $users = $this->userManager->countUsers();
    print_r($users); die('hi');
  }
}
