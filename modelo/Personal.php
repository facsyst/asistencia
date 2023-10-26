<?php 
require_once("conexion.php");

class Personal{

    function listar($nombre, $nrodoc, $estado){
        $sql = "SELECT p.idpersonal, p.nombre, t.nombre as tipodoc, p.nrodocumento, p.tipopersonal, p.celular, p.email, p.estado
                FROM personal as p INNER JOIN tipodocumento t ON p.idtipodocumento =t.idtipodocumento 
                WHERE p.estado <2;
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

    function insertar($nombre,$idtipodocumento, $nrodocumento,$tipopersonal,$celular,$email ,$estado){
        $sql = "INSERT INTO personal(idpersonal, nombre,idtipodocumento,nrodocumento, tipopersonal,celular,email, estado)
                VALUES(NULL, :nombre,:idtipodocumento, :nrodocumento, :tipopersonal,:celular,:email,:estado)";
        $parametros = array(
                            ':nombre'        =>$nombre,
                            ':idtipodocumento'=>$idtipodocumento,
                            ':nrodocumento'     => $nrodocumento,
                            ':tipopersonal'     =>  $tipopersonal, 
                            ':celular'     =>  $celular, 
                            ':email'     =>  $email, 
                            ':estado'        =>$estado
                        );
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;        
    }

    function actualizar($idpersonal,$nombre,$idtipodocumento, $nrodocumento,$tipopersonal, $celular,$email , $estado){
        $sql = "UPDATE personal SET nombre=:nombre,idtipodocumento=:idtipodocumento,
                                nrodocumento=:nrodocumento, tipopersonal=:tipopersonal,celular=:celular,email=:email,estado=:estado
                WHERE idpersonal=:idpersonal";
        $parametros = array(':idpersonal'=>$idpersonal, 
                            ':nombre'=>$nombre, 
                            ':idtipodocumento'=>$idtipodocumento,
                            ':nrodocumento' => $nrodocumento,
                            ':tipopersonal'    => $tipopersonal,
                            ':celular'    => $celular,
                            ':email'    => $email,
                            ':estado'=>$estado);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;        
    }

    function cambiarEstado($idpersonal, $estado){
        $sql = "UPDATE personal SET estado=:estado WHERE idpersonal=:idpersonal";
        $parametros = array(':idpersonal'=>$idpersonal,':estado'=>$estado);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function verificarDuplicado($nrodocumento, $idpersonal=0){
        $sql = "SELECT * FROM personal 
                WHERE nrodocumento=:nrodocumento AND idpersonal<>:idpersonal AND estado<2";
        $parametros = array(':nrodocumento'=>$nrodocumento,':idpersonal'=>$idpersonal);
        global $cnx;
        $pre = $cnx->prepare($sql);
        $pre->execute($parametros);
        return $pre;
    }

    function consultar($idpersonal){
        $sql = "SELECT * FROM personal WHERE idpersonal=:idpersonal AND estado<2";
        $parametros = array(':idpersonal'=>$idpersonal);
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