angular
.module('TpPizzeria')
.service('cargador', function($http)
{
	function MostrarError(error)
	{
		console.log(error);
	}
	//var url="slim/";
	var url="http://vaskezjohn.esy.es/slim/";
	


	this.BuscarUsuarios=function()
	{
		return $http.get(url+"usuarios")
		.then(function(respuesta)
		{
			return respuesta.data;
		}, MostrarError);
	}
	this.BuscarUsuarioPorLocal=function(id)
	{
		return $http.get(url+"usuarios/porlocal/"+id)
		.then(function(respuesta)
		{
			return respuesta.data;
		}, MostrarError);
	}
	this.BuscarUsuariosClientes=function()
	{
		return $http.get(url+"usuarios/clientes")
		.then(function(respuesta)
		{
			return respuesta.data;
		}, MostrarError);
	}
	this.BuscarUsuario=function(id)
	{
		return $http.get(url+"usuarios/"+id)
		.then(function(respuesta)
		{
			return respuesta.data;
		}, MostrarError);
	}
	this.InsertarUsuario=function(usuario)
	{
		return $http.post(url+"usuarios", {opcion:"alta", usuario:usuario})
		.then(function(respuesta)
		{
			return respuesta.data;
		}, MostrarError)
	}
	this.EliminarUsuario=function(usuario)
	{
		return $http.post(url+"usuarios", {opcion:"baja", usuario:usuario},{headers: {'Content-Type': 'application/x-www-form-urlencoded'}})
		.then(function(respuesta)
		{
			return respuesta.data;
		}, MostrarError)
	}
	this.ModificarUsuario=function(usuario)
	{
		return $http.post(url+"usuarios", {opcion:"modificacion", usuario:usuario})
		.then(function(respuesta)
		{
			return respuesta.data;
		}, MostrarError)
	}


	this.BuscarProductos=function()
	{
		return $http.get(url+"productos")
		.then(function(respuesta)
		{
			return respuesta.data;
		}, MostrarError);
	}
	this.BuscarProductoPorLocal=function(id)
	{
		return $http.get(url+"productos/"+id)
		.then(function(respuesta)
		{
			return respuesta.data;
		}, MostrarError);
	}
	this.InsertarProducto=function(producto)
	{
		return $http.post(url+"productos", {opcion:"alta", producto:producto})
		.then(function(respuesta)
		{
			return respuesta.data;
		}, MostrarError)
	}
	this.EliminarProducto=function(producto)
	{
		return $http.post(url+"productos", {opcion:"baja", producto:producto},{headers: {'Content-Type': 'application/x-www-form-urlencoded'}})
		.then(function(respuesta)
		{   
			return respuesta.data;
		}, MostrarError)
    
  	}
	this.ModificarProducto=function(producto)
	{
		return $http.post(url+"productos", {opcion:"modificacion", producto:producto})
		.then(function(respuesta)
		{
			return respuesta.data;
		}, MostrarError)
	}



	this.BuscarPedidos=function()
	{
		return $http.get(url+"pedidos")
		.then(function(respuesta)
		{
			return respuesta.data;
		}, MostrarError);
	}

	this.BuscarPedidosMapa=function()
	{
		return $http.get(url+"pedidos/mapa")
		.then(function(respuesta)
		{
			return respuesta.data;
		}, MostrarError);
	}

	this.BuscarPedidosTipo=function()
	{
		return $http.get(url+"pedidos/tipos/")
		.then(function(respuesta)
		{
			return respuesta;
		}, MostrarError);
	}
	this.TraerPedidoPorLocal=function(id)
	{
		return $http.get(url+"pedidos/"+id)
		.then(function(respuesta)
		{
			return respuesta;
		}, MostrarError);
	}

	this.TraerPedidoPorCliente=function(correo)
	{
		return $http.get(url+"pedidos/cliente/"+correo)
		.then(function(respuesta)
		{
			return respuesta;
		}, MostrarError);
	}

	this.InsertarPedidos=function(objeto)
	{
		return $http.post(url+"pedidos", {opcion:"alta", pedido:objeto})
		.then(function(respuesta)
		{
			return respuesta.data;
		}, MostrarError)
	}
	this.EliminarPedido=function(objeto)
	{
		return $http.post(url+"pedidos", {opcion:"baja", pedido:objeto},{headers: {'Content-Type': 'application/x-www-form-urlencoded'}})
		.then(function(respuesta)
		{   
			return respuesta.data;
		}, MostrarError)
    
  	}
	this.ModificarPedido=function(objeto)
	{
		return $http.post(url+"pedidos", {opcion:"modificacion", pedido:objeto})
		.then(function(respuesta)
		{
			return respuesta.data;
		}, MostrarError)
	}




	this.BuscarLocales=function()
	{
		return $http.get(url+"locales")
		.then(function(respuesta)
		{
			return respuesta.data;
		}, MostrarError);
	}
	this.BuscarLocal=function(id)
	{
		return $http.get(url+"locales/"+id)
		.then(function(respuesta)
		{
			return respuesta.data;
		}, MostrarError);
	}
	this.InsertarLocal=function(objeto)
	{
		return $http.post(url+"locales", {opcion:"alta", locales:objeto})
		.then(function(respuesta)
		{
			return respuesta.data;
		}, MostrarError)
	}
	this.EliminarLocal=function(objeto)
	{
		return $http.post(url+"locales", {opcion:"baja", locales:objeto},{headers: {'Content-Type': 'application/x-www-form-urlencoded'}})
		.then(function(respuesta)
		{   
			return respuesta.data;
		}, MostrarError)
    
  	}
	this.ModificarLocal=function(objeto)
	{
		return $http.post(url+"locales", {opcion:"modificacion", locales:objeto})
		.then(function(respuesta)
		{
			return respuesta.data;
		}, MostrarError)
	}



	this.BuscarEmpleados=function()
	{
		return $http.get(url+"personal")
		.then(function(respuesta)
		{
			return respuesta.data;
		}, MostrarError);
	}
	this.BuscarUnEmpleado=function(id)
	{
		return $http.get(url+"personal/"+id)
		.then(function(respuesta)
		{
			return respuesta.data;
		}, MostrarError);
	}
	this.InsertarEmpleado=function(objeto)
	{
		return $http.post(url+"personal", {opcion:"alta", personal:objeto})
		.then(function(respuesta)
		{
			return respuesta.data;
		}, MostrarError)
	}
	this.EliminarEmpleado=function(objeto)
	{
		return $http.post(url+"personal", {opcion:"baja", personal:objeto},{headers: {'Content-Type': 'application/x-www-form-urlencoded'}})
		.then(function(respuesta)
		{   
			return respuesta.data;
		}, MostrarError)
    
  	}
	this.ModificarEmpleado=function(objeto)
	{
		return $http.post(url+"personal", {opcion:"modificacion", personal:objeto})
		.then(function(respuesta)
		{
			return respuesta.data;
		}, MostrarError)
	}
});