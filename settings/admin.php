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

 class Admin implements ISettings {

  public function __construct() {}

  public function getPanel() {
		// we must use the same container
		$tmpl = new Template('oauthclient', 'admin');
		return $tmpl;
	}

  public function getSectionID() {
		return 'additional';
	}

  public function getPriority() {
		return 0;
	}
 }
