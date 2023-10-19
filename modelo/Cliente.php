<?php 
require_once("conexion.php");

class Cliente{

    function listar($nombre, $nrodoc, $estado){
        $sql = "SELECT idcliente, nombre, nrodocumento, direccion, estado 
                FROM cliente
                WHERE estado<2 
                ";
        $parametros = array();
        if($nombre!=""){
            $sql.=" AND nombre LIKE :nombre ";
            $parametros[':nombre'] = "%".$nombre."%";            
        }

        if($nrodoc!=""){
            $sql.=" AND nrodocumento LIKE :nrodocumento ";
            $parametros[':nrodocumento'] = "%".$nrodoc."%";            
        }

        if($estado!=""){
            $sql.=" AND estado = :estado ";
            $parametros[':estado'] = $estado;            
        }

            $sql.=" ORDER BY nombre ASC ";
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function insertar($nombre, $idtipodocumento, $nrodocumento, $direccion, $estado){
        $sql = "INSERT INTO cliente(idcliente, nombre, idtipodocumento, nrodocumento,
                            direccion, estado)
                VALUES(NULL, :nombre, :idtipodocumento, :nrodocumento, 
                            :direccion, :estado)";
        $parametros = array(
                            ':nombre'        =>$nombre,
                            ':idtipodocumento'=>$idtipodocumento,
                            ':nrodocumento'     => $nrodocumento,
                            ':direccion'     =>  $direccion, 
                            ':estado'        =>$estado
                        );
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;        
    }

    function actualizar($idcliente, $nombre, $idtipodocumento, $nrodocumento, $direccion, $estado){
        $sql = "UPDATE cliente SET nombre=:nombre, idtipodocumento=:idtipodocumento,
                                nrodocumento=:nrodocumento, direccion=:direccion,
                                estado=:estado
                WHERE idcliente=:idcliente";
        $parametros = array(':idcliente'=>$idcliente, 
                            ':nombre'=>$nombre, 
                            ':idtipodocumento'=>$idtipodocumento,
                            ':nrodocumento' => $nrodocumento,
                            ':direccion'    => $direccion,
                            ':estado'=>$estado);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;        
    }

    function cambiarEstado($idcliente, $estado){
        $sql = "UPDATE cliente SET estado=:estado WHERE idcliente=:idcliente";
        $parametros = array(':idcliente'=>$idcliente,':estado'=>$estado);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function verificarDuplicado($nrodocumento, $idcliente=0){
        $sql = "SELECT * FROM cliente 
                WHERE nrodocumento=:nrodocumento AND idcliente<>:idcliente AND estado<2";
        $parametros = array(':nrodocumento'=>$nrodocumento,':idcliente'=>$idcliente);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function consultar($idcliente){
        $sql = "SELECT * FROM cliente WHERE idcliente=:idcliente AND estado<2";
        $parametros = array(':idcliente'=>$idcliente);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function listarTipoDocumento(){
        $sql = "SELECT * FROM tipodocumento where estado=1";
        global $cnx;
        $pre = $cnx->query($sql);
        return $pre;
    }


}

?>