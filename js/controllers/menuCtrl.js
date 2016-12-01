angular
.module('TpPizzeria')
.controller('controlMenu', function($scope, $http, $auth, $state,FileUploader, $log) {
	$scope.DatoTest="**Menu**";
	$scope.usuario={};

	//console.info($auth.isAuthenticated(), $auth.getPayload());
	$scope.altaPro=false;
	$scope.listaPro=false;
	$scope.listUser=false;
	$scope.report=false;
	$scope.altaCliente=false;
	$scope.altaPersonal=false;
	$scope.altaLocal=false;
	$scope.estadistica=false;
	$scope.mapa=false;
	$scope.listClie=false;
	$scope.aux=false;
  
  $scope.status = {
    isopen: false
  };

  $scope.toggled = function(open) {
    $log.log('Dropdown is now: ', open);
  };

  $scope.toggleDropdown = function($event) {
    $event.preventDefault();
    $event.stopPropagation();
    $scope.status.isopen = !$scope.status.isopen;
  };

  $scope.appendToEl = angular.element(document.querySelector('#dropdown-long-content'));


	if($auth.isAuthenticated())	
	{
		$scope.usuario.nombre=$auth.getPayload().correo;
		switch($auth.getPayload().tipo) {
		    case "comp":
		        break;
		    case "admin":
		        $scope.altaPro=true;
				$scope.listaPro=true;
				$scope.listUser=true;
				$scope.listClie=true;
				$scope.report=true;
				$scope.altaCliente=true;
				$scope.altaPersonal=true;
				$scope.estadistica=true;
				$scope.mapa=true;
				$scope.altaLocal=true;
				$scope.aux=true;
		        break;
		    case "emple":
		        $scope.altaPro=true;
				$scope.altaCliente=true;
				$scope.listClie=true;
				$scope.aux=true;
		        break;
		    case "enca":
		        $scope.altaPro=true;
				$scope.listPro=true;
				$scope.listUser=true;
				$scope.altaCliente=true;
				$scope.altaPersonal=true;
				$scope.listClie=true;
		        break;

		}

		$scope.Logout=function()
		{
			$auth.logout()
			.then(function()
			{
				$state.go("login");
			});
		};
	}
	else
	{
		$state.go("login");
	}
	$scope.crearCuenta=function()
	{
		$state.go("altaUser");
	};
});
