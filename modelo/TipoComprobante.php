<?php
require_once("conexion.php");

class TipoComprobante{
    function listarTipoComprobantes(){
        $sql = "SELECT * FROM tipocomprobante";
        global $cnx;
        $resultado = $cnx->query($sql);
        return $resultado;
    }
}
?>