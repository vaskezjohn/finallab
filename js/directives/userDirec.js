angular
.module('TpPizzeria')
.directive('midirectiva', function()
{
	return{
		restrict:'AE',
		scope: {
			usuario: '@'
		},
		templateUrl : "Usuario.html",
		link: function (scope,elemt,attr)
		{
			scope.clienteLogeado={};
			scope.clienteLogeado.nombre=attr.usuario;
		}
	};
});