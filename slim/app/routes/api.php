<?php
if(!defined("SPECIALCONSTANT")) die("Acceso denegado");

// GET: Para consultar y leer recursos
// POST: Para crear recursos
// PUT: Para editar recursos
// DELETE: Para eliminar recursos


//--------------------------------------------------------------------------------//
//--Usuarios
$app->get("/usuarios/", function() use($app)
{	
	$respuesta=Usuario::ToArray();

	$app->response->status(200);
	$app->response->body(json_encode($respuesta));
});

$app->get("/usuarios/clientes", function() use($app)
{	
	$respuesta=Usuario::TraerUsuariosClientes();

	$app->response->status(200);
	$app->response->body(json_encode($respuesta));
});

$app->get("/usuarios/porlocal/:id", function($id) use($app)
{
	$respuesta=Usuario::BuscarUsuariosPorLocal($id);
	$app->response->status(200);
	$app->response->body(json_encode($respuesta));
});

$app->get("/usuarios/:id", function($id) use($app)
{
	$respuesta=Usuario::BuscarUsuario($id);

	$app->response->status(200);
	$app->response->body(json_encode($respuesta));
});

// POST: Para crear recursos
$app->post("/usuarios/", function() use($app)
{
	$respuesta = json_decode($app->request->getBody());
	$datos=$respuesta->usuario;

	switch($respuesta->opcion)
	{
		case "alta":
		{
			$usuario=new Usuario(0, $datos->correo, $datos->nombre, $datos->clave, $datos->tipo, $datos->foto, $datos->id_local,$datos->direccion);
			$id=$usuario->InsertarUsuario();
			$datos=(array)$datos;
			$datos["id"]=$id;
			$datos=(object)$datos;
			if($datos->foto!="pordefecto.png")
			{
				$rutaVieja=".".$datos->foto;
				$rutaNueva=$datos->id.".".PATHINFO($rutaVieja, PATHINFO_EXTENSION);
				copy($rutaVieja, "../fotos/".$rutaNueva);
				if($rutaVieja!="../fotos/pordefecto.png")
				{
					unlink($rutaVieja);
				}
				$datos->foto=$rutaNueva;
				$usuario=new Usuario($datos->id, $datos->correo, $datos->nombre, $datos->clave, $datos->tipo, $datos->foto, $datos->id_local,$datos->direccion);
				$usuario->ModificarUsuario();
			}
			break;
		}
		case "baja":
		{
			Usuario::EliminarUsuario($datos->id);
			if($datos->foto!="pordefecto.png")
			{
				unlink("./fotos/".$datos->foto);
			}
			break;
		}
		case "modificacion":
		{
			if($datos->foto!="pordefecto.png" && $datos->modificarFoto)
			{
				$rutaVieja="..fotos/".$datos->foto;
				$rutaNueva=$datos->id.".".PATHINFO($rutaVieja, PATHINFO_EXTENSION);
				copy($rutaVieja, "..fotos/".$rutaNueva);
				unlink($rutaVieja);
				$datos->foto=$rutaNueva;
			}
			$usuario=new Usuario($datos->id, $datos->correo, $datos->nombre, $datos->clave, $datos->tipo, $datos->foto);
			$usuario->ModificarUsuario();
			break;
		}
		default:
		{
			break;
		}
	}
	$app->response->status(200);	
	$app->response->body(json_encode($datos));
});

//--------------------------------------------------------------------------------//
//--Productos
$app->get("/productos/", function() use($app)
{	
	$respuesta=Productos::TraerTodosLosProductos();
	$app->response->status(200);
	$app->response->body(json_encode($respuesta));
});
$app->get("/productos/:id", function($id) use($app)
{	
	$respuesta=Productos::TraerProductosPorLocal($id);
	$app->response->status(200);
	$app->response->body(json_encode($respuesta));
});

// POST: Para crear recursos
$app->post("/productos/", function() use($app)
{
	$respuesta = json_decode($app->request->getBody());
	$datos=$respuesta->producto;
	switch($respuesta->opcion)
	{
		case "alta":
		{
			$id=Productos::InsertarProducto($datos);
			$datos=(array)$datos;
			$datos["id"]=$id;
			$datos=(object)$datos;

			break;
		}
		case "baja":
		{
			Productos::BorrarProducto($datos->id);

			break;
		}
		case "modificacion":
		{	
			if($datos->foto!="clasica.jpg")
			{
				$rutaVieja="../fotos/".$datos->foto;
				$rutaNueva=$datos->id.".".PATHINFO($rutaVieja, PATHINFO_EXTENSION);
				copy($rutaVieja, "../fotos/".$rutaNueva);
				unlink($rutaVieja);
				$datos->foto=$rutaNueva;
			}
			Productos::ModificarProducto($datos);
			break;
		}
		default:
		{
			break;
		}
	}
	$app->response->status(200);	
	$app->response->body(json_encode($datos));
});

//--------------------------------------------------------------------------------//
//--Pedidos
$app->get("/pedidos/", function() use($app)
{	
	$respuesta=Pedidos::TraerPedidos();
	$app->response->status(200);
	$app->response->body(json_encode($respuesta));
});

$app->get("/pedidos/mapa", function() use($app)
{	
	$respuesta=Pedidos::TraerPedidosMapa();
	$app->response->status(200);
	$app->response->body(json_encode($respuesta));
});


$app->get("/pedidos/tipos/", function() use($app)
{	
	$respuesta= array();
    $respuesta['listado']=Pedidos::TraerTipos();
	$app->response->status(200);
	$app->response->body(json_encode($respuesta));
});
$app->get("/pedidos/:id", function($id) use($app)
{	
	$respuesta=Pedidos::TraerPedidoPorLocal($id);
	$app->response->status(200);
	$app->response->body(json_encode($respuesta));
});
$app->get("/pedidos/cliente/:correo", function($correo) use($app)
{	
	$respuesta=Pedidos::TraerPedidoPorCliente($correo);
	$app->response->status(200);
	$app->response->body(json_encode($respuesta));
});


// POST: Para crear recursos
$app->post("/pedidos/", function() use($app)
{
	$respuesta = json_decode($app->request->getBody());
	$datos=$respuesta->pedido;
	switch($respuesta->opcion)
	{
		case "alta":
		{
			$id=Pedidos::InsertarPedidos($datos);
			$datos=(array)$datos;
			$datos["id"]=$id;
			$datos=(object)$datos;

			break;
		}
		case "baja":
		{
			Pedidos::BorrarPedido($datos->id);

			break;
		}
		case "modificacion":
		{

			Pedidos::ModificarPedido($datos);
			break;
		}
		default:
		{
			break;
		}
	}
	$app->response->status(200);	
	$app->response->body(json_encode($datos));
});


//--------------------------------------------------------------------------------//
//--Locales
$app->get("/locales/", function() use($app)
{	
	$respuesta=locales::TraerLocales();
	$app->response->status(200);
	$app->response->body(json_encode($respuesta));
});
$app->get("/locales/:id", function($id) use($app)
{	
	$respuesta=locales::TraerUnLocal($id);
	$app->response->status(200);
	$app->response->body(json_encode($respuesta));
});

// POST: Para crear recursos
$app->post("/locales/", function() use($app)
{
	$respuesta = json_decode($app->request->getBody());
	$datos=$respuesta->locales;
	switch($respuesta->opcion)
	{
		case "alta":
		{
			$id=locales::InsertarLocal($datos);
			$datos=(array)$datos;
			$datos["id"]=$id;
			$datos=(object)$datos;

			break;
		}
		case "baja":
		{
			locales::BorrarLocal($datos->id);

			break;
		}
		case "modificacion":
		{	
			locales::ModificarLocal($datos);
			break;
		}
		default:
		{
			break;
		}
	}
	$app->response->status(200);	
	$app->response->body(json_encode($datos));
});


//--------------------------------------------------------------------------------//
//--Personal Datos
$app->get("/personal/", function() use($app)
{	
	$respuesta=PersonalDatos::TraerTodasLasPersonas();
	$app->response->status(200);
	$app->response->body(json_encode($respuesta));
});
$app->get("/personal/:id", function($id) use($app)
{	
	$respuesta=PersonalDatos::TraerUnaPersona($id);
	$app->response->status(200);
	$app->response->body(json_encode($respuesta));
});

// POST: Para crear recursos
$app->post("/personal/", function() use($app)
{
	$respuesta = json_decode($app->request->getBody());
	$datos=$respuesta->personal;
	switch($respuesta->opcion)
	{
		case "alta":
		{
			$id=PersonalDatos::InsertarPersona($datos);
			$datos=(array)$datos;
			$datos["id"]=$id;
			$datos=(object)$datos;

			break;
		}
		case "baja":
		{
			PersonalDatos::BorrarPersona($datos->id);

			break;
		}
		case "modificacion":
		{	
			PersonalDatos::ModificarPersona($datos);
			break;
		}
		default:
		{
			break;
		}
	}
	$app->response->status(200);	
	$app->response->body(json_encode($datos));
});



