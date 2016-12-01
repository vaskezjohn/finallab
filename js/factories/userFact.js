angular
.module('TpPizzeria')
.factory('factoryUsuario', function()
{
	var usuario;
	return	{
		getUsuario:function()
		{
			return usuario;
		},
		setUsuario:function(nuevaUsuario)
		{
			usuario=nuevaUsuario;
		}
	}
});