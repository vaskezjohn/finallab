angular
.module('TpPizzeria')
.controller('controlEstadistica',function($scope,$http,$auth,$state, cargador)
{  
	$scope.saludo="hola";
	if($auth.isAuthenticated() && $auth.getPayload().tipo=="admin")
	{	
         cargador.BuscarPedidosTipo().then(function(respuesta){

			console.log("control en estadistica");
			console.log(respuesta.data.listado);

			var dato=[];

			for (var i = 0; i < respuesta.data.listado.length; i++) {
				dato.push(parseInt(respuesta.data.listado[i].total));
				dato.push(respuesta.data.listado[i].tipo);

                 }//fin for
                 console.log(dato);
                 $(function () {
                 	Highcharts.chart('container', {
                 		chart: {
                 			type: 'column',
                 			options3d: {
                 				enabled: false,
                 				alpha: 10,
                 				beta: 25,
                 				depth: 70
                 			}
                 		},
                 		title: {
                 			text: 'ESTADISTICA DE LAS VENTAS'
                 		},
                 		subtitle: {
                 			text: 'Cantidad de Pizzas vendidas segùn su tipo'
                 		},
                 		plotOptions: {
                 			column: {
                 				depth: 25
                 			}
                 		},
                 		xAxis: {
                 			categories:(function()
                 				{  var data=[];

                 					for (var i = 0; i < respuesta.data.listado.length; i++) {
                 						data.push(respuesta.data.listado[i].tipo);

                 					}
                 					return data;
            //console.log(data);
        }
        //fin funcion
            //
        )()// llamo a la funciòn anònima con "()" Highcharts.getOptions().lang.shortMonths
    },
    yAxis: {
    	title: {
    		text: null
    	}
    },
    series: [{
    	name: 'VENTAS',
    	data:dato }] 

    });
});

},function errorCallback(response) {
	$scope.ListadoProductos= [];
	console.log( response);
});
}else
{   
	$state.go("login");
}
});
