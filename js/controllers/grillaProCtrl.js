angular
.module('TpPizzeria')
.controller('controlGrilla', function($scope, $http, $state,$auth,cargador) 
{

  if($auth.isAuthenticated() && $auth.getPayload().tipo=="admin" || $auth.getPayload().tipo=="emple" || $auth.getPayload().tipo=="enca")  
  {
  	$scope.DatoTest="GRILLA DE PRODUCTOS";

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
  cargador.BuscarProductoPorLocal($auth.getPayload().id_local).then(function(respuesta){

    $scope.ListadoProductos=respuesta;
    console.log(respuesta);
  });
 } 

});