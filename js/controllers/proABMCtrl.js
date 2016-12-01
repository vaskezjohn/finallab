angular
.module('TpPizzeria')
.controller('controlAlta', function($scope, $http, $state, FileUploader,$auth,cargador) 
{
   if($auth.isAuthenticated() && $auth.getPayload().tipo=="admin" || $auth.getPayload().tipo=="emple" || $auth.getPayload().tipo=="enca")  
   {
		$scope.DatoTest="ALTA DEL PRODUCTO";
		$scope.uploader=new FileUploader({url:'php/uploader.php'});
		$scope.mascota={};
		$scope.mascota.tipo= "Mozzarella" ;
		$scope.mascota.foto="clasica.jpg";
		$scope.mascota.precio="";
		$scope.mascota.ingredientes="";
		$scope.mascota.id_local=$auth.getPayload().id_local;


		$scope.uploader.onSuccessItem=function(item, response, status, headers)
		{
			console.info("Ya guardé el archivo.", item, response, status, headers);
		};

		$scope.Guardar=function(){

			console.log($scope.uploader.queue);
			if($scope.uploader.queue[0]!=undefined)
			{
				var nombreFoto = $scope.uploader.queue[0]._file.name;
				$scope.mascota.foto=nombreFoto;
			}
			$scope.uploader.uploadAll();
			console.log("mascota a guardar:");
			console.log($scope.mascota);

			cargador.InsertarProducto($scope.mascota).then(function(respuesta){
		      console.log(respuesta);
		      $state.go("grillaPro");
		    });

		}
	}
	else{
		$state.go("login");
	}
})//FIN ALTA

.controller('controlModificacion', function($scope, $http, $state, $stateParams, FileUploader,cargador)//, $routeParams, $location)
{
	$scope.mascota={};
	$scope.DatoTest="**Modificar**";
	$scope.uploader=new FileUploader({url:'php/nexo.php'});
	console.log($stateParams);//$scope.mascota=$stateParams;
	$scope.mascota.id=$stateParams.id;
	$scope.mascota.tipo=$stateParams.tipo;
	$scope.mascota.ingredientes=$stateParams.ingredientes;
	$scope.mascota.precio=$stateParams.precio;
	$scope.mascota.foto=$stateParams.foto;
	$scope.uploader.onSuccessItem=function(item, response, status, headers)
	{
		
		console.info("Ya guardé el archivo.", item, response, status, headers);
	};
	$scope.Guardar=function(mascota)
	{

		if($scope.uploader.queue[0]!=undefined)
		{
			var nombreFoto = $scope.uploader.queue[0]._file.name;
			$scope.mascota.foto=nombreFoto;
		}
		$scope.uploader.uploadAll();

		cargador.ModificarProducto($scope.mascota).then(function(respuesta){
	      console.log(respuesta);
	      $state.go("grillaPro");
	    });
	}
});//FIN MODIFICACION