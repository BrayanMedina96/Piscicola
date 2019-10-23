<?php

header("Location:../Piscicultura/web/view/login.php");
die();

?>

<!--<?php


require "Model/Conexion.php";
require  "Model/Persona.php";


$persona=new Persona();
$persona->perosnaNombre="Brayan";

echo $persona->perosnaNombre;

$conn=Conexion::getInstance()->cnn();


$sql = 'SELECT * FROM public."Ciudad";';
$result=pg_query($conn,$sql);

echo "<TABLE BORDER='1' width=50% align=center>";
echo "<TR align=center><TD><b>ID</b></TD><TD><b>Nombre Estado</bd></TD></TR>";
while ($fila=pg_fetch_array($result))
{
  echo "<TR><TD>".$fila["ciudadCodigo"]."</TD><TD>".$fila["ciudadNombre"]."</TD></TR>";
}


Conexion::cerrar($conn);





?>-->