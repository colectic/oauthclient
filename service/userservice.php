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

namespace OCA\OauthClient\Service;

class UserService {

    private $userManager;

    public function __construct($userManager){
        $this->userManager = $userManager;
    }

    public function create($userId, $password) {
        return $this->userManager->create($userId, $password);
    }

    public function delete($userId) {
        return $this->userManager->get($userId)->delete();
    }

    // recoveryPassword is used for the encryption app to recover the keys
    public function setPassword($userId, $password, $recoveryPassword) {
        return $this->userManager->get($userId)->setPassword($password, $recoveryPassword);
    }

    public function disable($userId) {
        return $this->userManager->get($userId)->setEnabled(false);
    }

    public function getHome($userId) {
        return $this->userManager->get($userId)->getHome();
    }
}
