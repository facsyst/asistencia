<?php 
require_once("../modelo/Asistencia.php");

$objPer = new Personal();
$listar = $objPer->listar("",1);

?>
<section class="content mt-2">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Asistencia</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Nombre</span>
                        </div>
                        <input type="text" class="form-control" id="txtBusquedaNombre" name="txtBusquedaNombre" onkeyup="Buscar()" />
                    </div>
                </div>
	 
               <div class="col-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Nro. Doc.</span>
                        </div>
                        <input type="text" class="form-control" id="txtBusquedaNroDoc" name="txtBusquedaNroDoc" onkeyup="Buscar()" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Estado</span>
                        </div>
                        <select class="form-control" id="cboBusquedaEstado" name="cboBusquedaEstado" onchange="Buscar()">
                            <option value="">- Todos -</option>
                            <option value="1">Activos</option>
                            <option value="0">Anulado</option>
                        </select>
                    </div>                
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary" onclick="Buscar()"><span class="fa fa-search"></span> Buscar</button> 
                    <button type="button" class="btn btn-success" onclick="Nuevo()"><span class="fa fa-plus"></span> Nuevo</button>   
                </div>
            </div>
        </div>
    </div>
    <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Resultados de la búsqueda</h3>
    </div>
    <div class="card-body">
        <div id="divResultadoBusqueda">
        </div>
    </div>
</div>


<div class="modal fade" id="modal-formulario">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header bg-primary">
            <h4 class="modal-title">Asistencia</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="formulario">
                <div class="row">
                    <div class="col-md-6">
                       
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" maxlength="100" />
                            <input type="hidden" id="idAsistencia" name="idAsistencia" value="0" />
                            <input type="hidden" id="proceso" name="proceso" value="" />
                        </div>      
                        <div class="form-group">
                            <label>Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" maxlength="100" />
                        </div>                  
                        <div class="form-group">
                            <label>Tipo Documento</label>
                            <select class="form-control" id="idtipodocumento" name="idtipodocumento" >
                                <?php while($fila = $tipodocumentos->fetch(PDO::FETCH_NAMED) ){ ?>
                                    <option value="<?= $fila['idtipodocumento']?>"><?= $fila['nombre']?></option>
                                <?php }?>
                            </select>
                        </div>                        
                        <div class="form-group">
                            <label>N° Documento</label>
                            <div class="input-group">                            
                                <input type="text" class="form-control" id="nrodocumento" name="nrodocumento" maxlength="100" />
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" onclick="ConsultarDocumento();">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Tipo Asistencia</label>
                            <select class="form-control" id="tipoAsistencia" name="tipoAsistencia">
                                <option value="ESTUDIANTE">ESTUDIANTE</option>
                                <option value="DOCENTE">DOCENTE</option>
                                <option value="ADMINISTRATIVO">ADMINISTRATIVO</option>
                                <option value="EXTERNO">EXTERNO</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Celular</label>
                            <input type="number" class="form-control" id="celular" name="celular" maxlength="200" />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" id="email" name="email" maxlength="100" />
                        </div>
                        <div class="form-group">
                            <label>Estado</label>
                            <select class="form-control" id="estado" name="estado">
                                <option value="1">Activo</option>
                                <option value="0">Anulado</option>
                            </select>
                        </div>
                    </div>
                </div>
            <form>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="Guardar()">Guardar</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modal-confirmacion">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header bg-danger">
            <h5 class="modal-title">Confirmación</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="formulario">
                <div class="row">
                    <div class="col-md-12">                    
                        <center><h4>¿Está seguro de <span id='texto_accion'></span>?</h4></center>
                        <input type="hidden" id="idcambiarestado" value="0" />
                        <input type="hidden" id="cambioestado" value="" />                                       
                    </div>
                </div>
            <form>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="CambiarEstadoConfirmacion()">Confirmar</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</section>
<script>

function Buscar(){
    $.ajax({
        method: "POST",
        url: "vista/Asistencia_listado.php",
        data:{
            nombre: $("#txtBusquedaNombre").val(),
            nrodocumento: $("#txtBusquedaNroDoc").val(),
            estado: $("#cboBusquedaEstado").val(),
        }
    }).done(function(resultado){
        $("#divResultadoBusqueda").html(resultado);
    });
}

Buscar();


function Nuevo(){
    $("#proceso").val("NUEVO");
    $("#modal-formulario").modal('show');
    $("#modal-formulario").on('hidden.bs.modal', function(e){
        $("#formulario").trigger("reset");
    })
}

function Guardar(){
    if(ValidarFormulario()){
        datax = $("#formulario").serializeArray();
        $.ajax({
            method: "POST",
            url: "controlador/contAsistencia.php",
            data: datax,
            dataType: 'json'
        }).done(function(resultado){
            if(resultado.correcto){
                $("#modal-formulario").modal('hide');
                Buscar();
                toastCorrecto(resultado.mensaje);
            }else{
                toastError(resultado.mensaje);
            }
        });
    }else{
        toastError("Existe errores en tu formulario.");
    }
}

function ValidarFormulario(){
    retorno = true;

    $("#nombre").removeClass("is-invalid");
    if($("#nombre").val()==""){
        $("#nombre").addClass("is-invalid");
        retorno = false;
    }

    if($("#apellido").val()==""){
        $("#apellido").addClass("is-invalid");
        retorno = false;
    }

  
    $("#nrodocumento").removeClass("is-invalid");
    if($("#nrodocumento").val()==""){
        $("#nrodocumento").addClass("is-invalid");
        retorno = false;
    }


    return retorno;
}

function ConsultarDocumento(){
    $.ajax({
        method: "POST",
        url: "controlador/contAsistencia.php",
        data:{
            proceso: "CONSULTAR_WS",
            nrodocumento: $("#nrodocumento").val(),
            idtipodocumento: $("#idtipodocumento").val()
        },
        dataType: "json"
    }).done(function(resultado){
        $("#nombre").val(resultado.nombre);
        $("#direccion").val(resultado.direccion);
        $("#idtipodocumento").val(resultado.idtipodocumento);
    });    
}

</script>