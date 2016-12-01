angular
.module('TpPizzeria')
.controller('controlMapa',function($scope, $http, $auth, $state,cargador)
{
	if($auth.isAuthenticated() && $auth.getPayload().tipo=="admin")	
	{
       $scope.ListadoProductos={};

       

       cargador.BuscarPedidosMapa().then(function(respuesta){
		$scope.ListadoProductos=respuesta;
		console.log(respuesta);
		});

       cargador.BuscarLocales().then(function(respuesta){
		$scope.ListadoSucursales=respuesta;
		console.log(respuesta);
		});
		    

	}else
	{
      $state.go("carta");

	}


});
