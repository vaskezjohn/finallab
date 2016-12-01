angular
.module('TpPizzeria')
.controller('controlAltaPersonal', function($scope, $http, $state, FileUploader,$auth,cargador,cargadorDeFoto) 
{
   if($auth.isAuthenticated() && $auth.getPayload().tipo=="admin" || $auth.getPayload().tipo=="emple" || $auth.getPayload().tipo=="enca")  
   {
		$scope.DatoTest="ALTA DE PERSONAL";
		$scope.uploader=new FileUploader({url:'php/uploader.php'});
		$scope.personal={};
		$scope.personal.nombre;
		$scope.personal.apellido;
		$scope.personal.tipo;
		$scope.personal.correo;
		$scope.personal.clave;
		$scope.personal.copiaclave;
		$scope.personal.id_local;
		$scope.locales;
		$scope.personal.foto="pordefecto.png";
		
		$scope.enca=true;

		if ($auth.getPayload().tipo=="enca") {
			$scope.enca=false;
		};
		

		



		cargador.BuscarLocales().then(function(respuesta){
	      console.log(respuesta);
	      $scope.locales=respuesta;
	      //$state.go("grillaPro");
	    });


		//cargadorDeFoto.CargarFoto($scope.local.foto, $scope.uploader);
		$scope.uploader.onSuccessItem=function(item, response, status, headers)
		{
			console.info("Ya guardé el archivo.", item, response, status, headers);
		};

		$scope.Guardar=function(){
			$scope.usuario={};
			$scope.usuario.nombre=$scope.personal.nombre;
			$scope.usuario.tipo=$scope.personal.tipo;
			$scope.usuario.correo=$scope.personal.correo;
			$scope.usuario.clave=$scope.personal.clave;
			$scope.usuario.copiaclave=$scope.personal.copiaclave;
			$scope.usuario.direccion="";
			$scope.usuario.foto="pordefecto.png";
			$scope.usuario.id_local=$scope.personal.id_local;
			
			console.info($scope.usuario);
			

			console.log($scope.uploader.queue);
			if($scope.uploader.queue[0]!=undefined)
			{
				var nombreFoto = $scope.uploader.queue[0]._file.name;
				$scope.personal.foto=nombreFoto;
			}
			$scope.uploader.uploadAll();
			console.log("personal a guardar:");
			console.log($scope.personal);

			cargador.InsertarEmpleado($scope.personal).then(function(respuesta){
		      console.log(respuesta);
		      //$state.go("grillaPro");
		    });
		    cargador.InsertarUsuario($scope.usuario)
			.then(function(respuesta)
			{   	
				console.log(respuesta);
				$state.go("grillaUsers");

			});

		}
	}
	else{
		$state.go("login");
	}
})//FIN ALTA