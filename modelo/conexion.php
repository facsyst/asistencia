<?php
session_start();

if(!(isset($_SESSION['idusuario']) && $_SESSION['idusuario']>0)){
    if(!(isset($_POST['proceso']) && $_POST['proceso']=="LOGIN")){
        header("Location: index.php");
    }
}

$manejador = "mysql";
$servidor = "localhost";
$usuario = "root"; // usuario con acceso a la base de datos, generalmente root
$pass = "alexis1904";// aquí coloca la clave de la base de datos del servidor o hosting
$base = "bdasistencia"; //nombre de la base de datos
$cadena = "$manejador:host=$servidor;dbname=$base";

$cnx = new PDO($cadena, $usuario, $pass, array(PDO::ATTR_PERSISTENT => "true", PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

/*
$nombre = "%ga%";
$sql = "SELECT * FROM producto WHERE nombre LIKE :nombre";
//$resultado = $cnx->query($sql);
$resultado = $cnx->prepare($sql);
$parametros = array(
        ':nombre'=>$nombre
);
$resultado->execute($parametros);

while($fila = $resultado->fetch()){
    echo $fila["idproducto"]." - ".$fila["nombre"]." - ".$fila["codigobarra"]."<br/>";
}

$sql = "INSERT INTO categoria(idcategoria, nombre, estado) 
        VALUES(:idcategoria, :nombre, :estado)";
$pre = $cnx->prepare($sql);
$parametros = array(
    ":idcategoria"=>NULL,
    ":nombre"=>"CATEGORIA Z",
    ":estado"=>1
);
$pre->execute($parametros);
*/
?>