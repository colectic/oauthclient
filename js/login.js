(function() {

	var saml = document.createElement('script');
	saml.type = 'text/javascript';
	(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(saml);
})();

$(document).ready(function(){
    $('<div id="login-oauth"></div>').css({
		'text-align': 'center',
    }).appendTo('form');

    $('<a id="login-saml-action" href="/index.php/apps/oauthclient" ><i class="fa fa-user"></i>Iniciar sessió</a>').css(
    {
      'text-decoration': 'none',
			'background-color': '#9C1F1D',
    	'color': 'whitesmoke',
    	'padding': '5px 10px',
    	'font-weight': 'bold'
    }).appendTo('#login-oauth');

		$('<a id="toggle-form" href="#">Formulari</a>').appendTo('#login-oauth');

		$('#toggle-form').click(function(){
			$('form').toggle();
		});
});
