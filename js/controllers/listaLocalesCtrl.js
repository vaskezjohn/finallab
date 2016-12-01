angular
.module('TpPizzeria')
.controller('controlListaLocales', function($scope, $http, $state,$auth,cargador) 
{
  if($auth.isAuthenticated())  
  {
  	$scope.DatoTest="SUCURSALES";

    CargarGrilla();


    $scope.Borrar=function(objeto)
    {

      cargador.EliminarProducto(objeto).then(function(respuesta){
        console.log(respuesta);
        CargarGrilla()
      });

    }

  }else
  {
   $state.go("login");
 }

 function CargarGrilla()
 {
  cargador.BuscarLocales().then(function(respuesta){

    $scope.listado=respuesta;
    console.log(respuesta);
  });
 } 

});