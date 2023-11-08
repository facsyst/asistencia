<?php 
require_once("conexion.php");

class Docente{

    function listar($nombre, $nrodoc, $estado){
        $sql = "SELECT p.iddocente, p.nombre, t.nombre  tipodoc, p.nrodocumento, p.celular, p.email, p.estado
                FROM docente  p INNER JOIN tipodocumento t ON p.idtipodocumento =t.idtipodocumento 
                WHERE p.estado <2
                ";
        $parametros = array();
        if($nombre!=""){
            $sql.=" AND p.nombre LIKE :nombre ";
            $parametros[':nombre'] = "%".$nombre."%";            
        }

        if($nrodoc!=""){
            $sql.=" AND p.nrodocumento LIKE :nrodocumento ";
            $parametros[':nrodocumento'] = "%".$nrodoc."%";            
        }

        if($estado!=""){
            $sql.=" AND p.estado = :estado ";
            $parametros[':estado'] = $estado;            
        }

        $sql.=" ORDER BY p.nombre ASC ";
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function listarFechas(){

    }

    function insertar($nombre,$idtipodocumento, $nrodocumento,$celular,$email ,$estado){
        $sql = "INSERT INTO docente(iddocente, nombre,idtipodocumento,nrodocumento,celular,email, estado)
                VALUES(NULL, :nombre,:idtipodocumento, :nrodocumento,:celular,:email,:estado)";
        $parametros = array(
                            ':nombre'        =>$nombre,
                            ':idtipodocumento'=>$idtipodocumento,
                            ':nrodocumento'     => $nrodocumento,
                            ':celular'     =>  $celular, 
                            ':email'     =>  $email, 
                            ':estado'        =>$estado
                        );
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;        
    }

    function actualizar($iddocente,$nombre,$idtipodocumento, $nrodocumento, $celular,$email , $estado){
        $sql = "UPDATE docente SET nombre=:nombre,idtipodocumento=:idtipodocumento,
                                nrodocumento=:nrodocumento,celular=:celular,email=:email,estado=:estado
                WHERE iddocente=:iddocente";
        $parametros = array(':iddocente'=>$iddocente, 
                            ':nombre'=>$nombre, 
                            ':idtipodocumento'=>$idtipodocumento,
                            ':nrodocumento' => $nrodocumento,
                            ':celular'    => $celular,
                            ':email'    => $email,
                            ':estado'=>$estado);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;        
    }

    function cambiarEstado($iddocente, $estado){
        $sql = "UPDATE docente SET estado=:estado WHERE iddocente=:iddocente";
        $parametros = array(':iddocente'=>$iddocente,':estado'=>$estado);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function verificarDuplicado($nrodocumento, $iddocente=0){
        $sql = "SELECT * FROM docente 
                WHERE nrodocumento=:nrodocumento AND iddocente<>:iddocente AND estado<2";
        $parametros = array(':nrodocumento'=>$nrodocumento,':iddocente'=>$iddocente);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function consultar($iddocente){
        $sql = "SELECT * FROM docente WHERE iddocente=:iddocente AND estado<2";
        $parametros = array(':iddocente'=>$iddocente);
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