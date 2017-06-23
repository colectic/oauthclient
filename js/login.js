(function() {

	var saml = document.createElement('script');
	saml.type = 'text/javascript';
	(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(saml);
})();

$(document).ready(function(){
    $('<div id="login-oauth"><p id="login-button"></p></div>').css({
		'text-align': 'center',
    }).appendTo('form');

    $('<a id="login-saml-action" href="/index.php/apps/oauthclient">Iniciar sessió</a>').css(
    {
      'text-decoration': 'none',
			'background-color': '#9C1F1D',
    	'color': 'whitesmoke',
    	'padding': '8px 15px',
    	'font-weight': 'bold'
    }).appendTo('#login-button');

		$('</p><a id="toggle-form" href="#">Administrador</a></p>').css({
			'color' : '#9C1F1D',
			'font-size' : '8pt',
			'text-decoration' : 'underline',
			'text-align' : 'left'
		}).appendTo('#login-oauth');

		$('#toggle-form').click(function(){
			$('form fieldset').toggle('slow');
		});
});
