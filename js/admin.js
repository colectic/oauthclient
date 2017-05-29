function setSettings(val, success, failure) {
	$.post(OC.generateUrl('apps/oauthclient/ajax/setsettings'), {settings: val})
		.done(success)
		.error(failure);
}

$(document).ready(function() {
  event.preventDefault();
	$('#submitMessage').remove();
  $('#submitOauthclientSettings').click(function(event) {
    var settings = {
      clientid : $('#clientid').val(),
			clientsecret : $('#clientsecret').val(),
			redirecturi : $('#redirecturi').val(),
			autorizationendpoint : $('#autorizationendpoint').val(),
			tokenendpoint : $('#tokenendpoint').val(),
			apiendpoint : $('#apiendpoint').val()
    };
    setSettings(settings, function(data) {
      // Say it saved
			$('#submitOauthclientSettings').after('<span class="msg success" id="submitMessage">Saved</span>');
			setTimeout(function() {
				$('#setUploadMessage').remove();
			},3000);
    }, function(err) {
			// Failure
			$('#submitOauthclientSettings').after('<span class="msg error" id="submitMessage">There was an error saving</span>');
		});
  });
});
