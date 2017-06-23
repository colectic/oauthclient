(function() {

	var saml = document.createElement('script');
	saml.type = 'text/javascript';
	(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(saml);
})();

$(document).ready(function(){
    $('<p id="login-button"></p>').css({
		'text-align': 'center',
		'background-color': '#9C1F1D',
		'padding': '8px 15px',
    }).appendTo('form');

    $('<a id="login-saml-action" href="/index.php/apps/oauthclient">Iniciar sessió</a>').css(
    {
      'text-decoration': 'none',
			'color': 'whitesmoke',
    	'font-weight': 'bold'
    }).appendTo('#login-button');

		$('<p><a id="toggle-form" href="#">Administrador</a></p>').css({
			'color' : '#9C1F1D',
			'font-size' : '8pt',
			'text-decoration' : 'underline',
			'text-align' : 'left',
			'margin-top' : '5px'
		}).appendTo('form');

		$('#toggle-form').click(function(){
			$('form fieldset').toggle('slow');
		});
});
