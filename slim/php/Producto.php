<?php
class Productos
{
//--------------------------------------------------------------------------------
//--ATRIBUTOS
	public $id;
 	public $tipo;
    public $ingredientes;
    public $precio;
    public $cantidad;
  	public $foto;

//--------------------------------------------------------------------------------
//--GETTERS Y SETTERS
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
	public function GetFoto()
	{
		return $this->foto;
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
	
//--------------------------------------------------------------------------------
//--CONSTRUCTOR
	public function __construct($id=NULL)
	{
		if($id != NULL){
			$obj = Productos::TraerUnamascota($id);
		
			$this->tipo = $obj->tipo;
			$this->id = $id;
			$this->ingredientes=$ingredientes;
			$this->precio = $precio;
			$this->cantidad = $cantidad;
			$this->foto = $obj->foto;
		}
	}

//--------------------------------------------------------------------------------
//--METODO DE CLASE
	public static function TraerUnProducto($idParametro) 
	{	


		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from productos where id =:id");
		$consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
		$consulta->execute();
		$unProducto= $consulta->fetchObject('Productos');
		return $unProducto;	
					
	}

	public static function TraerProductosPorLocal($idParametro) 
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from productos where id_local =:id");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerUnaPersona(:id)");
		$consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
		$consulta->execute();
		$arrPedidos= $consulta->fetchAll(PDO::FETCH_CLASS, "Productos");	
		return $arrPedidos;	
					
	}


	public static function TraerTodosLosProductos()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from productos");
		$consulta->execute();			
		$arrProductos= $consulta->fetchAll(PDO::FETCH_CLASS, "Productos");	
		return $arrProductos;
	}
	public static function BuscarProducto($idParametro)
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("delete from productos	WHERE id=:id");	
		$consulta->bindValue(':id',$idParametro, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
		
	}
	
	public static function ModificarProducto($Productos)
	{	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update productos 
				set tipo=:tipo,
				precio=:precio,
				ingredientes=:ingredientes,
				foto=:foto
				WHERE id=:id");
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta->bindValue(':id',$Productos->id, PDO::PARAM_INT);
			$consulta->bindValue(':tipo', $Productos->tipo, PDO::PARAM_STR);
			$consulta->bindValue(':ingredientes',$Productos->ingredientes, PDO::PARAM_STR);
			$consulta->bindValue(':foto', $Productos->foto, PDO::PARAM_STR);
			$consulta->bindValue(':precio', $Productos->precio, PDO::PARAM_STR);
	
			return $consulta->execute();
	}

	public static function InsertarProducto($Productos)
	{
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into productos (tipo,ingredientes,foto,precio,id_local)values(:tipo,:ingredientes,:foto,:precio,:id_local)");
		
		$consulta->bindValue(':tipo', $Productos->tipo, PDO::PARAM_STR);
		$consulta->bindValue(':ingredientes',$Productos->ingredientes, PDO::PARAM_STR);
		$consulta->bindValue(':foto', $Productos->foto, PDO::PARAM_STR);
		$consulta->bindValue(':precio', $Productos->precio, PDO::PARAM_STR);
		$consulta->bindValue(':id_local', $Productos->id_local, PDO::PARAM_STR);
		$consulta->execute();		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
				
	}	
	public static function BorrarProducto($idParametro)
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("delete from productos	WHERE id=:id");	
		$consulta->bindValue(':id',$idParametro, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
		
	}

}
