<?php
class Pedidos
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	public $id;
	public $nombre;
 	public $tipo;
    public $ingredientes;
    public $precio;
    public $cantidad;
	public $latitud;
	public $longitud;

//--------------------------------------------------------------------------------
//--GETTERS Y SETTERS
  	public function GetLatitud()
	{
		return $this->latitud;
	}
	public function GetLongitud()
	{
		return $this->longitud;
	}
  	public function GetId()
	{
		return $this->id;
	}
	public function GetIngredientes()
	{
		return $this->ingredientes;
	}
	public function GetPrecio()
	{
		return $this->precio;
	}
	public function GetCantidad()
	{
		return $this->cantidad;
	}
	public function Gettipo()
	{
		return $this->tipo;
	}
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function SetId($valor)
	{
		$this->id = $valor;
	}
	public function SetIngredientes($valor)
	{
		$this->ingredientes = $valor;
	}
	public function SetPrecio($valor)
	{
		$this->precio = $valor;
	}
	public function SetCantidad($valor)
	{
		$this->cantidad = $valor;
	}
	public function Settipo($valor)
	{
		$this->tipo = $valor;
	}
	public function SetNombre($valor)
	{
		$this->nombre = $valor;
	}
	
//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($id=NULL)
	{
		if($id != NULL){
			$obj = Pedidos::TraerUnamascota($id);
			
			$this->tipo = $obj->tipo;
			$this->nombre = $obj->nombre;
			$this->id = $id;
			$this->ingredientes=$ingredientes;
			$this->precio = $precio;
			$this->cantidad = $cantidad;
		}
	}

//--------------------------------------------------------------------------------
//--METODO DE CLASE
	public static function TraerPedidos()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta=$objetoAccesoDato->RetornarConsulta("select * from pedidos");
		$consulta->execute();			
		$arrPedidos= $consulta->fetchAll(PDO::FETCH_CLASS, "Pedidos");	
		return $arrPedidos;
	}

	public static function TraerPedidosMapa()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta=$objetoAccesoDato->RetornarConsulta("select p.nombre,u.direccion from pedidos p, misusuarios u where p.nombre=u.correo");
		$consulta->execute();			
		$arrPedidos= $consulta->fetchAll(PDO::FETCH_CLASS, "Pedidos");	
		return $arrPedidos;
	}


	public static function TraerPedidoPorLocal($idParametro) 
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from pedidos where id_local =:id");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerUnaPersona(:id)");
		$consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
		$consulta->execute();
		$arrPedidos= $consulta->fetchAll(PDO::FETCH_CLASS, "Pedidos");	
		return $arrPedidos;	
					
	}
	public static function TraerPedidoPorCliente($correo) 
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from pedidos where nombre =:correo");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerUnaPersona(:id)");
		$consulta->bindValue(':correo', $correo, PDO::PARAM_STR);
		$consulta->execute();
		$arrPedidos= $consulta->fetchAll(PDO::FETCH_CLASS, "Pedidos");	
		return $arrPedidos;	
					
	}
	
	public static function TraerTipos()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select distinct tipo ,SUM(cantidad) as total from pedidos group by tipo");
		$consulta->execute();			
		$arrPedidos= $consulta->fetchAll(PDO::FETCH_CLASS, "Pedidos");	
		return $arrPedidos;
	}
	
	public static function BorrarPedido($idParametro)
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("delete from pedidos	WHERE id=:id");		
		$consulta->bindValue(':id',$idParametro, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();	
	}

	public static function InsertarPedidos($value)
	{
	foreach ($value as $Pedidos) {
		
	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into pedidos (tipo,ingredientes,precio,cantidad,nombre,longitud,latitud,id_local)values(:tipo,:ingredientes,:precio,:cantidad,:nombre,'0','0',:id_local)");
	
		$consulta->bindValue(':tipo', $Pedidos->tipo, PDO::PARAM_STR);
		$consulta->bindValue(':ingredientes',$Pedidos->ingredientes, PDO::PARAM_STR);
		$consulta->bindValue(':precio', $Pedidos->precio, PDO::PARAM_STR);
		$consulta->bindValue(':cantidad', $Pedidos->cantidad, PDO::PARAM_STR);
		$consulta->bindValue(':nombre', $Pedidos->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':id_local', $Pedidos->id_local, PDO::PARAM_STR);
		$consulta->execute();
		}		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();				
	}	


}
