<?php

listarArchivos("C:\laragon\www\Scrum\svg");

function listarArchivos( $path ){
$dir = opendir($path);
$files = array();
while ($elemento = readdir($dir)){
if( $elemento != "." && $elemento != ".."){

if( is_dir($path.$elemento) ){
listarArchivos( $path.$elemento.'/' );
}
else{
$files[] = $elemento;
}

}
}
echo $path;

for($x=0; $x<count( $files ); $x++)
{
echo  $files[$x]."=> <img width=100 height=100 src=http://localhost:8000/Scrum/svg/".$files[$x].">";
}
echo "<BR>";
}

listarArchivos( './' );
?>