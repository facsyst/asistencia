<?php

require_once("../modelo/Asistencia.php");
require_once("../modelo/Equipo.php");

$objAs = new Asistencia();
$asistencias = $objAs->listarAsistenciaPersonal();


$obEq = new Equipo();
$equipos = $obEq->listar("",1);

?>


<section class="content mt-2">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Uso Equipos</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Nombre</span>
                        </div>
                        <input type="text" class="form-control" id="txtBusquedaNombre" name="txtBusquedaNombre" onkeyup="Buscar()" />
                    </div>
                </div>
                <div class="col-md-4">
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
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary" onclick="Buscar()"><span class="fa fa-search"></span> Buscar</button> 
                    <button type="button" class="btn btn-success" onclick="Nuevo()"><span class="fa fa-plus"></span> Nuevo</button>
                </div>

                <div class="col-md-4 mt-2">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Desde</span>
                        </div>
                        <input type="date" class="form-control" id="txtFechaDesde" name="txtFechaDesde" value="<?= date('Y-m-01'); ?>"/>
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Hasta</span>
                        </div>
                        <input type="date" class="form-control" id="txtFechaHasta" name="txtFechaHasta"/>
                    </div>
                    
                </div>
                <div class="col-md-4 mt-2">
                    <button type="button" class="btn btn-primary" onclick="window.location.href='vista/pdfUsoEquipo.php'"><span class="fa fa-print"></span> Imprimir PDF</button> 
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
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header bg-primary">
            <h4 class="modal-title">Uso de Equipo</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="formulario">
                <div class="row">
                    <div class="col-12">                    
                        <div class="form-group">
                            <label>Nombre Personal</label>
                            <input type="hidden" id="idusoequipo" name="idusoequipo" value="0" />
                            <input type="hidden" id="proceso" name="proceso" value="" />
                            <select class="form-control select2bs4" style="width: 100%;" name="idasistencia" id="idasistencia">
                                <option value="">Seleccione uno</option>
                                <?php while($fila = $asistencias->fetch(PDO::FETCH_NAMED)){ ?>
                                    <option value="<?= $fila['idasistencia'] ?>"><b><?= $fila['nombre'] ?></b></option>
                                <?php }?>
                            </select>
                        </div>    
                        <div class="form-group">
                            <label>N° de Equipo</label>
                            <select class="form-control select2bs4" style="width: 100%;" name="idequipo" id="idequipo">
                                <option value="">Seleccione uno</option>
                                <?php while($fila = $equipos->fetch(PDO::FETCH_NAMED)){ ?>
                                    <option value="<?= $fila['idequipo'] ?>"><b><?= $fila['nro'] ?></b></option>
                                <?php }?>
                            </select>
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
$("#idcategoria").select2({
    theme: 'bootstrap4'
});
$("#idsubcategoria").select2({
    theme: 'bootstrap4'
});

function Buscar(){
    $.ajax({
        method: "POST",
        url: "vista/usosequipos_listado.php",
        data:{
            desde: $("#txtFechaDesde").val(),
            hasta: $("#txtFechaHasta").val(),
            nombre: $("#txtBusquedaNombre").val(),
            estado: $("#cboBusquedaEstado").val()
        }
    }).done(function(resultado){
        $("#divResultadoBusqueda").html(resultado);
    });
}
Buscar();


function Nuevo(){
    $("#proceso").val("NUEVO");
    $("#urlimagen").val("");
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
            url: "controlador/contUsoEquipo.php",
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
    $(".required").each(function(){
        $(this).removeClass("is-invalid");
        if($(this).val()=="" || $(this).val()=="0"){
            $(this).addClass("is-invalid");
            retorno = false;
        }
    });

  

    return retorno;
}




</script>