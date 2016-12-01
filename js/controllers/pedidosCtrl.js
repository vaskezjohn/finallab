angular
.module('TpPizzeria')
.controller('controlPedidos',function($scope,$http,$auth,$state, cargador)
{
  if($auth.isAuthenticated())  
  {
  	    cargador.BuscarLocales().then(function(respuesta){
	       console.log(respuesta);
	       $scope.locales=respuesta;
	     });
		CargarGrilla();

	}
	else
	{
		$state.go("carta");
	}



	$scope.Borrar=function(objeto){
	  cargador.EliminarPedido(objeto).then(function(respuesta){
	 	CargarGrilla();
	    console.log(respuesta);
	  });

	}

	function CargarGrilla(){
	if($auth.getPayload().tipo=="admin" || $auth.getPayload().tipo=="enca"|| $auth.getPayload().tipo=="emple")  
	  {
	  	cargador.TraerPedidoPorLocal($auth.getPayload().id_local).then(function(respuesta){
	        console.log(respuesta.data);
	      	$scope.ListadoProductos=respuesta.data;
	      });
	  }else{
	  	  	cargador.TraerPedidoPorCliente($auth.getPayload().correo).then(function(respuesta){
	        console.log(respuesta.data);
	      	$scope.ListadoProductos=respuesta.data;
	      });
	  }
  	 

	}
});