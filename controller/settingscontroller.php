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
 use OCP\IConfig;

 class SettingsController extends Controller {
   public function __construct($AppName, $request, IConfig $config) {
		parent::__construct($AppName, $request);
    $this->config = $config;
	}

  /**
   * @UseSession
   * @NoCSRFRequired
   * @PublicPage
   */
  public function setsettings() {
    $settings = $_POST['settings'];

    if ($settings['clientid']) {
      $this->config->setAppValue('oauthclient', 'clientid', $settings['clientid']);
    } else {
      //Error
    }

    if ($settings['clientsecret']) {
      $this->config->setAppValue('oauthclient', 'clientsecret', $settings['clientsecret']);
    } else {
      //Error
    }

    if ($settings['redirecturi']) {
      $this->config->setAppValue('oauthclient', 'redirecturi', $settings['redirecturi']);
    } else {
      //Error
    }

    if ($settings['autorizationendpoint']) {
      $this->config->setAppValue('oauthclient', 'autorizationendpoint', $settings['autorizationendpoint']);
    } else {
      //Error
    }

    if ($settings['tokenendpoint']) {
      $this->config->setAppValue('oauthclient', 'tokenendpoint', $settings['tokenendpoint']);
    } else {
      //Error
    }

    if ($settings['apiendpoint']) {
      $this->config->setAppValue('oauthclient', 'apiendpoint', $settings['apiendpoint']);
    } else {
      //Error
    }

    return true;
  }
 }
