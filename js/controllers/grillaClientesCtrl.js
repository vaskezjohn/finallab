angular
.module('TpPizzeria')
.controller('controlGrillaClientes',function($scope,$http,$auth,$state, cargador, cargadorDeFoto, FileUploader)
{
  if($auth.isAuthenticated() && $auth.getPayload().tipo=="admin" || $auth.getPayload().tipo=="enca"|| $auth.getPayload().tipo=="emple")  
  {	

		cargador.BuscarUsuariosClientes().then(function(respuesta){

			$scope.ListadoClientes=respuesta;
			console.log(respuesta);
		});

	}//fin if
	else
	{
		$state.go("carta");
	}//fin else

	$scope.Borrar=function(usuario)
	{
		cargador.EliminarUsuario(usuario);
		location.reload();
	};


});
