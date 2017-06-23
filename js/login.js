(function() {

	var saml = document.createElement('script');
	saml.type = 'text/javascript';
	(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(saml);
})();

$(document).ready(function(){
    $('<div id="login-oauth"></div>').css({
		'text-align': 'center',
    }).appendTo('form');

    $('<p><a id="login-saml-action" href="/index.php/apps/oauthclient">Iniciar sessió</a></p>').css(
    {
      'text-decoration': 'none',
			'background-color': '#9C1F1D',
    	'color': 'whitesmoke',
    	'padding': '8px 15px',
    	'font-weight': 'bold'
    }).appendTo('#login-oauth');

		$('</p><a id="toggle-form" href="#">Administrador?</a></p>').css({
			'color' : '#9C1F1D',
			'font-size' : '8pt',
			'text-decoration' : 'underline'
		}).appendTo('#login-oauth');

		$('#toggle-form').click(function(){
			$('form fieldset').toggle('slow');
		});
});
