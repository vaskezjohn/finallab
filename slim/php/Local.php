<?php
class Locales
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	public $id;
	public $direccion;
	public $sucursal;
 	public $foto;


//--------------------------------------------------------------------------------
//--GETTERS Y SETTERS
  	public function GetId()
	{
		return $this->id;
	}
	public function GetSucursal()
	{
		return $this->sucursal;
	}
	public function GetDireccion()
	{
		return $this->direccion;
	}
	public function GetFoto()
	{
		return $this->foto;
	}
	public function SetId($valor)
	{
		$this->id = $valor;
	}
	public function SetSucursal($valor)
	{
		$this->sucursal = $valor;
	}
	public function SetDireccion($valor)
	{
		$this->direccion = $valor;
	}
	public function SetFoto($valor)
	{
		$this->foto = $valor;
	}
	
//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($id=NULL)
	{
		if($id != NULL){
			$obj = Locales::TraerUnamascota($id);
			$this->id = $id;
			$this->direccion = $obj->direccion;
			$this->foto = $obj->foto;
		}
	}

//--------------------------------------------------------------------------------
//--METODO DE CLASE
	public static function TraerLocales()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta=$objetoAccesoDato->RetornarConsulta("select * from locales");
		$consulta->execute();			
		$arrPedidos= $consulta->fetchAll(PDO::FETCH_CLASS, "Locales");	
		return $arrPedidos;
	}
	public static function TraerUnLocal($idParametro) 
	{	


		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from locales where id_local =:id");
		$consulta->bindValue(':id', $idParametro, PDO::PARAM_INT);
		$consulta->execute();
		$unProducto= $consulta->fetchObject('Locales');
		return $unProducto;	
				
	}

	public static function BorrarLocal($idParametro)
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("delete from locales	WHERE id=:id");		
		$consulta->bindValue(':id',$idParametro, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();	
	}

	public static function InsertarLocal($value)
	{		
	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into locales (direccion,foto,nomSucursal)values(:direccion,:foto,:sucursal)");
	
		$consulta->bindValue(':direccion', $value->direccion, PDO::PARAM_STR);
		$consulta->bindValue(':sucursal', $value->sucursal, PDO::PARAM_STR);
		$consulta->bindValue(':foto',$value->foto, PDO::PARAM_STR);
		$consulta->execute();
		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();				
	}	


}
