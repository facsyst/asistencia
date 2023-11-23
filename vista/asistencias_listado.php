<?php
require_once("../modelo/Equipo.php");

$objEq = new Equipo();

$nro = isset($_POST['nro']) ? $_POST['nro'] : null;
$estado = isset($_POST['estado']) ? $_POST['estado'] : null;

$listado = $objEq->listar($nro, $estado);
$estados= array(0=>"ANULADO",1=>"ACTIVO");
?>

<table id="tablaEquipo" class="table table-bordered table-hover table-striped table-sm">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nro</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Serie</th>
            <th>Estado</th>
            <th>Opciones</th>
           
        </tr>
    </thead>
    <tbody>
        <?php while($fila = $listado->fetch(PDO::FETCH_NAMED)){ ?>
        <tr class="<?= $fila['estado']==1?'':'text-red'?>">
            <td><?= $fila['idequipo'] ?></td>
            <td><?= $fila['nro'] ?></td>
            <td><?= $fila['marca'] ?></td>
            <td><?= $fila['modelo'] ?></td>
            <td><?= $fila['serie'] ?></td>
            <td><?= $estados[$fila['estado']] ?>
            <td><button class="btn btn-sm btn-info" onclick="Editar(<?= $fila['idequipo'];?>)"><span class="fa fa-edit"></span> </button>
            
            <?php if($fila['estado']==1){?>
                <button class="btn btn-sm btn-warning" onclick="CambiarEstadoModal(<?= $fila['idequipo'];?>,0,'<?= $fila['nombre'] ?>')"><span class="fa fa-ban"></span> </button>
            <?php }else{ ?>
                <button class="btn btn-sm btn-success" onclick="CambiarEstadoModal(<?= $fila['idequipo'];?>,1,'<?= $fila['nombre'] ?>')"><span class="fa fa-check"></span> </button>
            <?php }?>
            
            <button class="btn btn-sm btn-danger" onclick="CambiarEstadoModal(<?= $fila['idequipo'];?>,2,'<?= $fila['nombre'] ?>')"><span class="fa fa-trash"></span> </button></td>
        </tr>
        <?php }?>
    </tbody>
</table>
<script>
$("#tablaEquipo").DataTable({
      "paging": true,
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "ordering": true,
      "searching": false,
      "info": true,
      "language": {
			 "info": "Del _START_ al _END_ de _TOTAL_ registros",
             "paginate": {
				       "next": "Siguiente",
                       "previous": "Anterior"
				 }
			},
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tablaEquipo_wrapper .col-md-6:eq(0)');

modoEdicion = false;
idsubcategoria = 0;
function Editar(idequipo){
    $.ajax({
        method: 'POST',
        url:    'controlador/contEquipo.php',
        data:{
            'proceso':'CONSULTAR',
            'idequipo': idequipo
        },
        dataType: 'json'
    }).done(function(retorno){
        modoEdicion = true;
        $("#idequipo").val(retorno.idequipo);
        $("#nro").val(retorno.nro);
        $("#marca").val(retorno.marca);
        $("#modelo").val(retorno.modelo);
        $("#serie").val(retorno.serie);
        $("#estado").val(retorno.estado);

        $("#proceso").val("ACTUALIZAR");
        $("#modal-formulario").modal('show');
        $("#modal-formulario").on('hidden.bs.modal', function(e){
            $("#formulario").trigger("reset");
            $("#idcategoria").val("").trigger("change");
            $("#idsubcategoria").val("").trigger("change");
        })
    });
}

function CambiarEstado(idequipo, estado){
    $.ajax({
        method: 'POST',
        url:    'controlador/contEquipo.php',
        data:{
            'proceso':'CAMBIAR_ESTADO',
            'idequipo': idequipo,
            'estado': estado
        },
        dataType: 'json'
    }).done(function(resultado){
        $("#modal-confirmacion").modal('hide');
        if(resultado.correcto){
            toastCorrecto(resultado.mensaje);
            Buscar();            
        }else{
            toastError(resultado.mensaje);
        }
    });
}

function CambiarEstadoModal(idequipo,estado,nombre){
    $("#idcambiarestado").val(idequipo);
    $("#cambioestado").val(estado);
    texto_accion="ELIMINAR";
    if(estado==1){ texto_accion="ACTIVAR"; }
    if(estado==0){ texto_accion="ANULAR"}
    texto_accion="<b>"+texto_accion+"</b>";
    texto_accion = texto_accion + " el producto " + nombre;
    $("#texto_accion").html(texto_accion);
    $("#modal-confirmacion").modal('show');
    $("#modal-confirmacion").on('hidden.bs.modal', function(e){
        $("#formulario").trigger("reset");
    });
}

function CambiarEstadoConfirmacion(){
    CambiarEstado($("#idcambiarestado").val(), $("#cambioestado").val());
}


</script>