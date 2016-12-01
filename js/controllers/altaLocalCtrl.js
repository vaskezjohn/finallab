angular
.module('TpPizzeria')
.controller('controlAltaLocal', function($scope, $http, $state, FileUploader,$auth,cargador,cargadorDeFoto) 
{
   if($auth.isAuthenticated() && $auth.getPayload().tipo=="admin" || $auth.getPayload().tipo=="emple" || $auth.getPayload().tipo=="enca")  
   {
		$scope.DatoTest="ALTA DE LOCAL";
		$scope.uploader=new FileUploader({url:'php/uploader.php'});
		$scope.local={};
		$scope.local.sucursal;
		$scope.local.direccion;
		$scope.local.foto="clasica.jpg";

		//cargadorDeFoto.CargarFoto($scope.local.foto, $scope.uploader);
		$scope.uploader.onSuccessItem=function(item, response, status, headers)
		{
			console.info("Ya guardé el archivo.", item, response, status, headers);
		};

		$scope.Guardar=function(){

			console.log($scope.uploader.queue);
			if($scope.uploader.queue[0]!=undefined)
			{
				var nombreFoto = $scope.uploader.queue[0]._file.name;
				$scope.local.foto=nombreFoto;
			}
			$scope.uploader.uploadAll();
			console.log("local a guardar:");
			console.log($scope.local);

			cargador.InsertarLocal($scope.local).then(function(respuesta){
		      console.log(respuesta);
		      //$state.go("grillaPro");
		    });

		}
	}
	else{
		$state.go("login");
	}
})//FIN ALTA