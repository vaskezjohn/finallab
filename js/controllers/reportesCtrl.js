angular
.module('TpPizzeria')
.controller('controlReportes',function($scope, $http, $auth, $state,cargador)
{
	if($auth.isAuthenticated() && $auth.getPayload().tipo=="admin" || $auth.getPayload().tipo=="enca")  
  	{
		$scope.GenerarPdf=function()
		{
			//window.open('php/plantillapdf.php');
			window.open('http://vaskezjohn.esy.es/php/plantillapdf.php');

		};
		$scope.GenerarExcel=function()
		{
			window.open('http://vaskezjohn.esy.es/php/rep_excel.php');	
			//window.open('php/rep_excel.php');
		};

	}else
	{
		$state.go("carta");

	}


});