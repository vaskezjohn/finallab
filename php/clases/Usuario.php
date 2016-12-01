<?php
require_once("AccesoDatos.php");
class Usuario
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
		private $_id;
		private $_correo;
		private $_nombre;
		private $_clave;
		private $_tipo;

//--------------------------------------------------------------------------------
//--GETTERS Y SETTERS
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

//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	 	public function __construct($id, $correo, $nombre, $clave, $tipo, $foto)
		{
			$this->_id=$id;
			$this->_correo=$correo;
			$this->_nombre=$nombre;
			$this->_clave=$clave;
			$this->_tipo=$tipo;
			$this->_foto=$foto;
		}
		public static function ToArray()
		{
			$conexion=AccesoDatos::dameUnObjetoAcceso();
			$sentencia=$conexion->RetornarConsulta("SELECT * FROM misusuarios");
			$sentencia->Execute();
			$usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			$conexion=null;
			return $usuarios;
		}
		public static function TraerUsuarios()
		{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT id,correo,nombre,tipo,foto  FROM misusuarios");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerTodasLasmascotas() ");
		$consulta->execute();			
		$arrUsers= $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");	
		return $arrUsers;
		}
		public static function BuscarUsuario($id)
		{
			$conexion=AccesoDatos::dameUnObjetoAcceso();
			$sentencia=$conexion->RetornarConsulta("SELECT id,correo,nombre,tipo,foto FROM misusuarios WHERE id=:id");
			$sentencia->bindValue(":id", $id, PDO::PARAM_INT);
			$sentencia->Execute();
			$usuario=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			$conexion=null;
			return $usuario;
		}
		public function InsertarUsuario($user)
		{
			$conexion=AccesoDatos::dameUnObjetoAcceso();
			$sentencia=$conexion->RetornarConsulta("INSERT INTO misusuarios(correo, nombre, clave, tipo, foto) VALUES (:correo, :nombre, :clave, :tipo, :foto)");
			$sentencia->bindValue(":correo", $user->_correo, PDO::PARAM_STR);
			$sentencia->bindValue(":nombre", $user->_nombre, PDO::PARAM_STR);
			$sentencia->bindValue(":clave", $user->_clave, PDO::PARAM_STR);
			$sentencia->bindValue(":tipo", $user->_tipo, PDO::PARAM_STR);
			$sentencia->bindValue(":foto", $user->_foto, PDO::PARAM_STR);
			$sentencia->Execute();
			$id=$conexion->lastInsertId();
			$conexion=null;
			return $id;
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
			$conexion=null;
		}
		public static function EliminarUsuario($id)
		{
			$conexion=AccesoDatos::dameUnObjetoAcceso();
			$sentencia=$conexion->RetornarConsulta("DELETE FROM misusuarios WHERE id=:id");
			$sentencia->bindValue(":id", $id, PDO::PARAM_INT);
			$sentencia->Execute();
			$conexion=null;
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

	}
?>