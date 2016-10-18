<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>INICIO | CASA HOMERO | HOGAR</title>
<link href="css/style.css" rel="stylesheet">
<link rel="stylesheet" href="Slider/sss.css" />
<script src="js/jquery-1.12.4.min.js"></script>
<script src="Slider/sss.min.js"></script>
</head>
<body>
	<div id="wrapper">
		<header>
			<h1>CASA HOMERO</h1>
			<h3>Materiales Electricos S.R.L.</h3>
		</header>
		<nav>
			<ul>
				<li><a href="#">HOME</a></li>
				<li><a href="catalogo.php">CATALOGO</a>
				
				<li><a href="servicios.html">SERVICIOS</a></li>
				<li><a href="contacto.html">CONTACTO</a></li>
				<li><a href="form_login.html">INGRESO</a></li>
			</ul>
		</nav>
		<section id="principal">
			<h1 style='text-align: center; color: #000000'>Listado de Productos</h1>
			<form style="display: block; margin: 0px auto; text-align: center;"
				name="frmbusqueda" accept-charset="utf-8" method="GET">
				<label>Producto a Buscar : </labeL> <input type="text"
					name="producto" maxlength="50"> <input type="submit" name="buscar"
					value="Buscar">
			</form>

			<br> 
           <?php
           header ( 'Content-Type: text/html;charset=UTF-8' );
           include_once 'includes/bdd.php';  
           $con = crearConexion ();
           $con->set_charset ( "utf8" ); 
           
           // si presiono el boton  usamos el where
           
           if (isset($_GET['buscar'])){
           	$claveBusqueda=$_GET['producto'];
           	$sql="select pro.id_producto, pro.descripcion,pro.precio,
           	pro.cantidad,cat.descripcion from categorias cat
           	inner join productos pro on cat.id_categoria=pro.id_categoria
           	where pro.descripcion like concat('%','$claveBusqueda','%')
           	order by pro.descripcion";
           	
           	// la primera vez tira todo
           	
           }
           else {
           	$sql="select pro.id_producto,pro.descripcion,
            pro.precio,pro.cantidad,cat.descripcion from categorias cat
            inner join productos pro on cat.id_categoria=pro.id_categoria
            order by pro.descripcion";
           }
           
           // tira el query y me devuelve o todo o lo filtrado por buscar
           
           $result=$con->query($sql);
           
           // empiezo a construir la tabla en php 
           
           echo "<table style='margin: 0px auto;border:1px solid
           #cccccc;font-family:Verdana, Arial, Helvetica'>";
           echo "<thead style='background-color:#16a085;color:#ffffff'>";
           echo "<tr>";
           echo "<th>";
           echo "Codigo";
           echo "</th>";
           echo "<th>";
           echo "Descripcion";
           echo "</th>";
           echo "<th>";
           echo "precio";
           echo "</th>";
           echo "<th>";
           echo "cantidad";
           echo "</th>";
           echo "<th>";
           
           echo "categoria";
           echo "</th>";
           echo "</thead>";
          
           // empiezo mi tbody, con fetch_row armo un array construyo con cada fila
           
           echo "<tbody>";
           while ($row=$result->fetch_row())
           {
           	echo "<tr>";
           	
           	// agarro los valores del array y los voy mostrando con foreach y los paso a $valor
           
           	foreach ($row as $valor){
           		echo "<td style='border:1px solid #ccc;text-align:center'>";
           		echo $valor;
           		echo "</td>";
           	}
           	echo "</tr>";
           }
           echo "</tbody>";
           echo "</table>";
           // cerrar la conexión 
           $con->close(); 
           ?>
                      


		</section>

		<footer>
			&copy 2016 | Casa Homero.com | <span id=destacado>Todos los derechos
				reservados </span>
		</footer>
	</div>
	<!-- fin wrapper -->
	<script>
		$(document).ready(function() {
			$(".slider").sss();

		});
	</script>
</body>
</html>
