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

\OC_Util::checkAdminUser();

$tmpl = new OCP\Template('oauthclient', 'admin');

$clientid     = \OC::$server->getConfig()->getAppValue('oauthclient', 'clientid', '');
$clientsecret = \OC::$server->getConfig()->getAppValue('oauthclient', 'clientsecret', '');
$redirecturi  = \OC::$server->getConfig()->getAppValue('oauthclient', 'redirecturi', '');
$autorizationendpoint = \OC::$server->getConfig()->getAppValue('oauthclient', 'autorizationendpoint', '');
$tokenendpoint = \OC::$server->getConfig()->getAppValue('oauthclient', 'tokenendpoint', '');
$apiendpoint = \OC::$server->getConfig()->getAppValue('oauthclient', 'apiendpoint', '');

$tmpl->assign('clientid', $clientid);
$tmpl->assign('clientsecret', $clientsecret);
$tmpl->assign('redirecturi', $redirecturi);
$tmpl->assign('autorizationendpoint', $autorizationendpoint);
$tmpl->assign('tokenendpoint', $tokenendpoint);
$tmpl->assign('apiendpoint', $apiendpoint);

return $tmpl->fetchPage();
