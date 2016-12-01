angular
.module('TpPizzeria')
.controller('controlAltaUser',function($scope,$http,$auth,$state, cargador, cargadorDeFoto, FileUploader)
{  
	$scope.DatoTest="ALTA DE USUARIO";

	//console.info($auth.getPayload().tipo);

		$scope.aceptar="Crear Cuenta";
		$scope.titulo="Nuevo Usuario";
		$scope.uploader=new FileUploader({url:'php/uploader.php'});
		$scope.usuario={};
		$scope.usuario.nombre= "Jonthan" ;
		$scope.usuario.calle="beazley 935";
		$scope.usuario.localidad="Villa Dominico";
		$scope.usuario.direccion= $scope.usuario.calle+","+$scope.usuario.localidad +", Buenos Aires, Argentina";
		$scope.usuario.correo= "john@john.com" ;
		$scope.usuario.clave= "111" ;
		$scope.usuario.foto="pordefecto.png";
		$scope.usuario.tipo="comp";
		$scope.usuario.id_local=0;

		cargadorDeFoto.CargarFoto($scope.usuario.foto, $scope.uploader);
		$scope.uploader.onSuccessItem=function(item, response, status, headers)
		{
			if(response=="correcto")
			{

				$scope.Insertar();
				console.info("Ya guardé el archivo.", item, response, status, headers);
			}
			else
			{
				alert(response);
			}
		};
		$scope.Insertar=function()
		{
			cargador.InsertarUsuario($scope.usuario)
			.then(function(respuesta)
			{   	
				console.log(respuesta);
				if($auth.isAuthenticated())
				{
					$state.go("grillaClientes");
				}else{
					$state.go("login");
				}
				

			});
		};
		$scope.Guardar=function()
		{
			if($scope.usuario.nombre!=undefined && $scope.usuario.correo!=undefined && $scope.usuario.clave!=undefined)
			{
				var datosVacios=false;
				for(var dato in $scope.usuario)
				{
					if(!$scope.usuario.hasOwnProperty(dato))
					{
						continue;
					}
					if($scope.usuario[dato]==="")
					{
						datosVacios=true;
					}
				}
				if(!datosVacios)
				{
					console.log($scope.uploader.queue);
					if($scope.uploader.queue[0]!=undefined && $scope.uploader.queue[0]._file.name!="../fotos/pordefecto.png")
					{
						var nombreFoto = $scope.uploader.queue[0]._file.name;
						$scope.usuario.foto=nombreFoto;
						$scope.uploader.uploadAll();
					}
					else
					{
						$scope.usuario.foto="pordefecto.png";
						$scope.Insertar();
					}
					console.log("usuario a guardar:");
					console.log($scope.usuario);
				}
				else
				{
					alert("No puede haber datos vacíos");
				}
			}
			else
			{
				alert("No puede haber datos vacíos");
			}
		}

});