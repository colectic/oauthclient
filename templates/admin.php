<form id="oauthclient" class="section" action="#" method="post">
	<h2 class="inlineblock"><?php p($l->t('OAUTH Client')); ?></h2>
	<div id="oauthclient-save-indicator" class="msg success inlineblock" style="display: none;">Saved</div>

	<div id="oauthclient-settings">
		<p>
			<input id="oauthclient-clientid" name="oauthclient-clientid" value="<?php p(\OC::$server->getConfig()->getAppValue('oauthclient', 'clientid', 'xxx')) ?>">
			<label for="oauthclient-clientid">Client ID</label><br/>
		</p>
	</div>
</form>
