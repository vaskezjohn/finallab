angular
.module('TpPizzeria')
.controller('controlLogin', function($scope,$auth,$state)
{
	$scope.Login=function()
	{
		$scope.DatoTest="Inìcie Sesión como Admin o User";
		$scope.correo;
		$scope.nombre;
		$scope.clave;

		$auth.login({correo:$scope.correo, nombre:$scope.nombre, clave:$scope.clave})
		.then(function(respuesta)
		{
			//console.log(respuesta);
			if($auth.isAuthenticated())
			{
				console.info($auth.isAuthenticated(), $auth.getPayload());
				$state.go("pedidos");
			}
			else
			{
				alert("No se encontró el usuario. Verifique los datos.");
			}
		});
	};

	$scope.LoginAdmin=function()
	{
		$scope.DatoTest="Inìcie Sesión como Admin o User";
		$scope.correo="admin@admin.com";
		$scope.nombre="admin";
		$scope.clave="123";

		$auth.login({correo:$scope.correo, nombre:$scope.nombre, clave:$scope.clave})
		.then(function(respuesta)
		{
			//console.log(respuesta);
			if($auth.isAuthenticated())
			{
				console.info($auth.isAuthenticated(), $auth.getPayload());
				$state.go("pedidos");
			}
			else
			{
				alert("No se encontró el usuario. Verifique los datos.");
			}
		});
	};

	$scope.LoginCliente=function()
	{ 
		$scope.DatoTest="Iniciar Sesión";
		$scope.correo="cliente@cliente.com";
		$scope.nombre="comp";
		$scope.clave="123";

		$auth.login({correo:$scope.correo, nombre:$scope.nombre, clave:$scope.clave})
		.then(function(respuesta)
		{
			console.log(respuesta);
			if($auth.isAuthenticated())
			{
				console.info($auth.isAuthenticated(), $auth.getPayload());
				$state.go("menu");
			}
			else
			{
				alert("No se encontró el usuario. Verifique los datos.");
			}
		});
	};

	$scope.LoginEnca=function()
	{ 
		$scope.DatoTest="Iniciar Sesión";
		$scope.correo="enca@enca.com";
		$scope.nombre="enca";
		$scope.clave="123";

		$auth.login({correo:$scope.correo, nombre:$scope.nombre, clave:$scope.clave})
		.then(function(respuesta)
		{
			console.log(respuesta);
			if($auth.isAuthenticated())
			{
				console.info($auth.isAuthenticated(), $auth.getPayload());
				$state.go("pedidos");
			}
			else
			{
				alert("No se encontró el usuario. Verifique los datos.");
			}
		});
	};

	$scope.LoginEmple=function()
	{ 
		$scope.DatoTest="Iniciar Sesión";
		$scope.correo="emple@emple.com";
		$scope.nombre="emple";
		$scope.clave="123";

		$auth.login({correo:$scope.correo, nombre:$scope.nombre, clave:$scope.clave})
		.then(function(respuesta)
		{
			console.log(respuesta);
			if($auth.isAuthenticated())
			{
				console.info($auth.isAuthenticated(), $auth.getPayload());
				$state.go("pedidos");
			}
			else
			{
				alert("No se encontró el usuario. Verifique los datos.");
			}
		});
	};

	$scope.crearCuenta2=function()
	{
		console.log("entro al metodo");
		$state.go("altaUser");
	};// fin cargar formulario

	$scope.crearCuenta=function()
	{
		$state.go("altaUser");
	};// fin cargar formulario
});