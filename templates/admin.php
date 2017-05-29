<?php script('oauthclient', 'admin'); ?>

<div id="oauthclientForm" class="section">
	<h2 class="app-name">OAUTH Client</h2>

	<input id="clientid" name="clientid" value="<?php p($_["clientid"]) ?>">
	<label for="clientid">Client ID</label><br/>

	<input id="clientsecret" name="clientsecret" value="<?php p($_["clientsecret"]) ?>">
	<label for="clientsecret">Client Secret</label><br/>

	<input id="redirecturi" name="redirecturi" value="<?php p($_["redirecturi"]) ?>">
	<label for="redirecturi">Redirect URI</label><br/>

	<input id="autorizationendpoint" name="autorizationendpoint" value="<?php p($_["autorizationendpoint"]) ?>">
	<label for="autorizationendpoint">Autorization Endpoint</label><br/>

	<input id="tokenendpoint" name="tokenendpoint" value="<?php p($_["tokenendpoint"]) ?>">
	<label for="tokenendpoint">Token Endpoint</label><br/>

	<input id="apiendpoint" name="apiendpoint" value="<?php p($_["apiendpoint"]) ?>">
	<label for="apiendpoint">API Endpoint</label><br/>

	<input type="submit" name="submitOauthclientSettings" id="submitOauthclientSettings" value="Save"/>
</div>
