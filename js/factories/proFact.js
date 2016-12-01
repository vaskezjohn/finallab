angular
.module('TpPizzeria')
.factory('factoryProducto', function()
{
	var producto;
	return	{
		getProducto:function()
		{
			return producto;
		},
		setProducto:function(nuevaProducto)
		{
			producto=nuevaProducto;
		}
	}
});