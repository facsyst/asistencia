<?php 
require_once("../modelo/Personal.php");

$objPersonal = new Personal();
$listar = $objPersonal->listar("","",1);

?>

<section class="content mt-2">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Asistencia</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Nro</span>
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
            <h4 class="modal-title">Asistencia</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="formulario">
                <div class="row">
                    <div class="col-12">                    
                        <div class="form-group">
                            <label>Tipo Personal</label>
                            <input type="hidden" id="idasistencia" name="idasistencia" value="0" />
                            <input type="hidden" id="proceso" name="proceso" value="" />
                            <select class="form-control select2bs4 required" id="idpersonal" name="idpersonal" >
                                <?php while($fila = $listar->fetch(PDO::FETCH_NAMED) ){ ?>
                                    <option value="<?= $fila['idpersonal']?>"><?= $fila['nombre']?></option>
                                <?php }?>
                            </select>
                        </div>   
                        <div class="form-group">
                            <label>Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" />
                        </div>
                        <div class="form-group">
                            <label>Hora Entrada</label>
                            <input type="time" class="form-control" id="horaentrada" name="horaentrada"/>
                        </div>   
                        <div class="form-group">
                            <label>Hora Salida</label>
                            <input type="time" class="form-control" id="horasalida" name="horasalida"  />
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

$("#idpersonal").select2({
    theme: 'bootstrap4'
});


function Buscar(){
    $.ajax({
        method: "POST",
        url: "vista/asistencias_listado.php",
        data:{
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