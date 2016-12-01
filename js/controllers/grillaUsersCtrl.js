angular
.module('TpPizzeria')
.controller('controlGrillaUser',function($scope,$http,$auth,$state, cargador, cargadorDeFoto, FileUploader)
{
  if($auth.isAuthenticated() && $auth.getPayload().tipo=="admin" || $auth.getPayload().tipo=="enca")  
  {	
      switch($auth.getPayload().tipo) {
		    case "admin":
		       	CargarGrilla();
		        break;
		    case "enca":
		        CargarGrillaLocal($auth.getPayload().id_local);      
		        break;

		}

	}
	else
	{
		$state.go("carta");
	}

	$scope.Borrar=function(usuario)
	{
		cargador.EliminarUsuario(usuario);
		location.reload();

	};


	function CargarGrilla()
	{
		cargador.BuscarUsuarios().then(function(respuesta){

		$scope.ListadoProductos=respuesta;
		console.log(respuesta);
		});
	}

	function CargarGrillaLocal(id)
	{
		cargador.BuscarUsuarioPorLocal(id).then(function(respuesta){

		$scope.ListadoProductos=respuesta;
		console.log(respuesta);
		});
	}


});
