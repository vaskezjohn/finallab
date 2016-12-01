angular.module('TpPizzeria', ['ui.router','angularFileUpload','satellizer','ngMap'])

.config(function($stateProvider, $urlRouterProvider, $authProvider)
{  

    
	$authProvider.loginUrl = 'php/clases/Autentificador.php';
	$authProvider.signupUrl = 'php/clases/Autentificador.php';
	$authProvider.tokenName = 'tokenTest';
	$authProvider.tokenPrefix = 'ejemploabm';
	$authProvider.authHeader = 'data';
//$authProvider.loginUrl = 'facultad/TPv2/PHP/clases/Autentificador.php';
	//$authProvider.signupUrl = 'facultad/TPv2/PHP/clases/Autentificador.php';


	$stateProvider
	.state('menu',
		{url: '/menu',
		templateUrl: 'views/menu.html',
		controller: 'controlMenu'})

	.state('mapa',
		{url: '/mapa',
		templateUrl: 'views/mapa.html',
		controller: 'controlMapa'})

	.state('carta',
		{url:'/carta?id_local',
		templateUrl:'views/carta.html',
		controller:'controlEleccion'})

	.state('login',
		{url:'/login',
	    templateUrl:'login.html',
		controller:'controlLogin'})

	.state('altaUser',
		{url:'/altaUser',
		templateUrl:'views/altaUser.html',
		controller:'controlAltaUser'})

	.state('estadistica',
		{url:'/estadistica',
		templateUrl:'estadistica.php',
		controller:'controlEstadistica'})

	.state('listaSucursales',
		{url:'/listaSucursales',
		templateUrl:'views/listaSucursales.html',
		controller:'controlListaLocales'})

	.state('altaPersonal',
		{url:'/altaPersonal',
		templateUrl:'views/altaPersonal.html',
		controller:'controlAltaPersonal'})

	.state('grillaClientes',
		{url:'/grillaClientes',
		templateUrl:'views/grillaClientes.html',
		controller:'controlGrillaClientes'})

	.state('alta',
		{url: '/alta',
		templateUrl: 'views/altaPro.html',
		controller: 'controlAlta'})

	.state('altaLocal',
		{url: '/altaLocal',
		templateUrl: 'views/altaLocal.html',
		controller: 'controlAltaLocal'})

	.state('modificacion',
		{url: '/modificacion/{id}?:foto:tipo:ingredientes:precio',
		templateUrl: 'views/altaPro.html',
		controller: 'controlModificacion'})

	.state('pedidos',
		{url:'/pedidos',
		templateUrl:'views/pedidos.html',
		controller:'controlPedidos'})

	.state('grillaUsers',
		{url:'/grillaUser',
		templateUrl:'views/grillaUsers.html',
		controller:'controlGrillaUser'})

	.state('grillaPro',
		{url: '/grillaPro',
		templateUrl: 'views/grillaPro.html',
		controller: 'controlGrilla'})

	.state('reportes',
		{url:'/reportes',
		templateUrl:'views/reportes.html',
		controller:'controlReportes'});
	
	$urlRouterProvider.otherwise('/login');
});
