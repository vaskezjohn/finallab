angular
.module('TpPizzeria')
.controller('controlEleccion',function($scope, $http, $state, $stateParams, FileUploader,$auth,cargador,$stateParams)
{   
	$scope.usuario={};
	$scope.usuario.longitud;
	$scope.usuario.latitud;

	// var options = {enableHighAccuracy: true};

	// navigator.geolocation.getCurrentPosition(function(position) {
	// 	$scope.usuario.longitud=position.coords.latitude; 
	// 	$scope.usuario.latitud=position.coords.longitude;
	// }, function(error){
	// 	console.log("Could not get location");
	// }, options);

	console.info( $scope.usuario);

	if($auth.isAuthenticated())
	{
		$scope.ListadoProductos=[];
		//var nom =$auth.getPayload().nombre;

		console.log("estoy en controller eleccion:");

		cargador.BuscarProductoPorLocal($stateParams.id_local).then(function(respuesta){
		   $scope.ListadoProductos=respuesta;
		   console.log(respuesta);
		});

		
		$scope.guardarPedido=function(lista){
	

			for (var i = 0; i < lista.length; i++) 
			{
				// lista[i].longitud=$scope.usuario.longitud;
				// lista[i].latitud=$scope.usuario.latitud;
				lista[i].nombre=$auth.getPayload().correo;
				console.info(lista[i].cantidad);
				//if(lista[i].cantidad==0)
				//{
				  // lista.splice(i);
				//}
			};
			console.info(lista);

        


			console.log("estoy en guardarPedido");

			   cargador.InsertarPedidos(lista).then(function(respuesta){
			   console.log(respuesta);
			   $state.go("pedidos");
			   });
			
		}
	}else
	{
		$state.go("login");
	}
});

