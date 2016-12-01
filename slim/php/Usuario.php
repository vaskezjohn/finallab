<?php
class Usuario
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $_id;
	private $_correo;
	private $_nombre;
	private $_clave;
	private $_tipo;
	private $_id_local;
	private $_direccion;
	
//--------------------------------------------------------------------------------//
//--PROPIEDADES SOLO LECTURA
	public function getId()
	{
		return $this->_id;
	}
	public function getMail()
	{
		return $this->_correo;
	}
	public function getUser()
	{
		return $this->_nombre;
	}
	public function getPass()
	{
		return $this->_clave;
	}
	public function getTipo()
	{
		return $this->_tipo;
	}

	public function getIdLocal()
	{
		return $this->_id_local;
	}

	public function getDireccion()
	{
		return $this->_direccion;
	}

//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($id, $correo, $nombre, $clave, $tipo, $foto, $id_local,$direccion)
	{
		$this->_id=$id;
		$this->_correo=$correo;
		$this->_nombre=$nombre;
		$this->_clave=$clave;
		$this->_tipo=$tipo;
		$this->_foto=$foto;
		$this->_id_local=$id_local;
		$this->_direccion=$direccion;
		
		
	}

//--------------------------------------------------------------------------------//
//--METODO DE CLASE
	public static function ToArray()
	{
		$conexion=AccesoDatos::dameUnObjetoAcceso();
		$sentencia=$conexion->RetornarConsulta("SELECT id,correo,nombre,tipo,foto,id_local FROM misusuarios where tipo<>'comp'");
		$sentencia->Execute();
		$usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);
		$conexion=null;
		return $usuarios;
	}

	public static function BuscarUsuariosPorLocal($id)
	{
		$conexion=AccesoDatos::dameUnObjetoAcceso();
		$sentencia=$conexion->RetornarConsulta("SELECT id,correo,nombre,tipo,foto FROM misusuarios where id_local=:id_local and tipo='emple'");
		$sentencia->bindValue(":id_local", $id, PDO::PARAM_INT);
		$sentencia->Execute();
		$usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);
		$conexion=null;
		return $usuarios;
	}
	public static function TraerUsuarios()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select id,correo,nombre,tipo,foto,id_local from misusuarios");
		$consulta->execute();			
		$arrUsers= $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");	
		return $arrUsers;
	}
	public static function TraerUsuariosClientes()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select id,correo,nombre,tipo,foto,id_local  from misusuarios where tipo='comp'");
		$consulta->execute();			
		$usuarios=$consulta->fetchAll(PDO::FETCH_ASSOC);
		return $usuarios;
	}
	public static function BuscarUsuario($id)
	{
		$conexion=AccesoDatos::dameUnObjetoAcceso();
		$sentencia=$conexion->RetornarConsulta("SELECT * FROM misusuarios WHERE id=:id");
		$sentencia->bindValue(":id", $id, PDO::PARAM_INT);
		$sentencia->Execute();
		$usuario=$sentencia->fetchAll(PDO::FETCH_ASSOC);
		$conexion=null;
		return $usuario;
	}
	public function InsertarUsuario()
	{
		$conexion=AccesoDatos::dameUnObjetoAcceso();
		$sentencia=$conexion->RetornarConsulta("INSERT INTO misusuarios(correo, nombre, clave, tipo, foto, id_local,direccion) VALUES (:correo, :nombre, :clave, :tipo, :foto, :id_local,:direccion)");
		$sentencia->bindValue(":correo", $this->_correo, PDO::PARAM_STR);
		$sentencia->bindValue(":nombre", $this->_nombre, PDO::PARAM_STR);
		$sentencia->bindValue(":clave", $this->_clave, PDO::PARAM_STR);
		$sentencia->bindValue(":tipo", $this->_tipo, PDO::PARAM_STR);
		$sentencia->bindValue(":foto", $this->_foto, PDO::PARAM_STR);
		$sentencia->bindValue(":id_local", $this->_id_local, PDO::PARAM_STR);
		$sentencia->bindValue(":direccion", $this->_direccion, PDO::PARAM_STR);
		$sentencia->Execute();
		//$conexion=null;
		return $conexion->RetornarUltimoIdInsertado();
	}

	public function ModificarUsuario()
	{
		$conexion=AccesoDatos::dameUnObjetoAcceso();
		$sentencia=$conexion->RetornarConsulta("UPDATE misusuarios SET correo=:correo, nombre=:nombre, clave=:clave, tipo=:tipo, foto=:foto WHERE id=:id");
		$sentencia->bindValue(":id", $this->_id, PDO::PARAM_INT);
		$sentencia->bindValue(":correo", $this->_correo, PDO::PARAM_STR);
		$sentencia->bindValue(":nombre", $this->_nombre, PDO::PARAM_STR);
		$sentencia->bindValue(":clave", $this->_clave, PDO::PARAM_STR);
		$sentencia->bindValue(":tipo", $this->_tipo, PDO::PARAM_STR);
		$sentencia->bindValue(":foto", $this->_foto, PDO::PARAM_STR);
		$sentencia->Execute();
		//$conexion=null;
		return $conexion->RetornarUltimoIdInsertado();
	}
	public static function EliminarUsuario($id)
	{
		$conexion=AccesoDatos::dameUnObjetoAcceso();
		$sentencia=$conexion->RetornarConsulta("DELETE FROM misusuarios WHERE id=:id");
		$sentencia->bindValue(":id", $id, PDO::PARAM_INT);
		$sentencia->Execute();
		$conexion=null;
	}
}
?>