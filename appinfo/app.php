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

namespace OCA\OauthClient\AppInfo;


\OCP\App::addNavigationEntry(array(
    // the string under which your app will be referenced in owncloud
    'id' => 'oauthclient',

    // sorting weight for the navigation. The higher the number, the higher
    // will it be listed in the navigation
    'order' => 10,

    // the route that will be shown on startup
    'href' => \OCP\Util::linkToRoute('oauthclient.page.index'),

    // the icon that will be shown in the navigation
    // this file needs to exist in img/
    'icon' => \OCP\Util::imagePath('oauthclient', 'app.svg'),

    // the title of your application. This will be used in the
    // navigation or on the settings page of your app
    'name' => 'Oauth Client'
));
