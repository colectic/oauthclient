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

 namespace OCA\OauthClient\Settings;
 use OCP\Template;
 use OCP\Settings\ISettings;
 use OCP\IConfig;

 class Admin implements ISettings {
  /** @var IConfig */
  protected $config;

  public function __construct(IConfig $config) { $this->config = $config; }

  public function getPanel() {

		$tmpl = new Template('oauthclient', 'admin');

    $clientid     = $this->config->getAppValue('oauthclient', 'clientid', '');
    $clientsecret = $this->config->getAppValue('oauthclient', 'clientsecret', '');
    $redirecturi  = $this->config->getAppValue('oauthclient', 'redirecturi', '');
    $autorizationendpoint = $this->config->getAppValue('oauthclient', 'autorizationendpoint', '');
    $tokenendpoint = $this->config->getAppValue('oauthclient', 'tokenendpoint', '');
    $apiendpoint = $this->config->getAppValue('oauthclient', 'apiendpoint', '');

    $tmpl->assign('clientid', $clientid);
    $tmpl->assign('clientsecret', $clientsecret);
    $tmpl->assign('redirecturi', $redirecturi);
    $tmpl->assign('autorizationendpoint', $autorizationendpoint);
    $tmpl->assign('tokenendpoint', $tokenendpoint);
    $tmpl->assign('apiendpoint', $apiendpoint);

		return $tmpl;
	}

  public function getSectionID() {
		return 'additional';
	}

  public function getPriority() {
		return 0;
	}
 }
