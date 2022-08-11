<style>
	.error {
		color: red;
		font-style: !important;
	}
</style>
<pre>
	<h1>Estadísticas BCRA</h1>
<?php
/*
* Docu: https://www.estadisticasbcra.com/api/documentacion
*/
require_once('dataBase.php');
require_once('functions.php');
require_once('tablas.php');
startDb();
foreach ($variable = tablas() as $value) {
	$tabla = $value[0];
	$type_tabla = $value[1];
	switch ($type_tabla) {
		case 'milestones':
			estadisticasBcra(createBaseMilestones($tabla), $tabla);
			break;
		case 'float':
			estadisticasBcra(createBaseFloat($tabla), $tabla);
			break;
		case 'int':
			estadisticasBcra(createBaseInt($tabla), $tabla);
			break;
		
		default:
			echo '<p class="error">Error in type of data base</p>';
			die;
			break;
	}
}
?>
<h2>Script FINALIZADO</h2>
</pre>
