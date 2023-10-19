<?php
require_once("../modelo/Equipo.php");

$objEq = new Equipo();

$nro = isset($_POST['nro']) ? $_POST['nro'] : null;
$estado = isset($_POST['estado']) ? $_POST['estado'] : null;

$listado = $objEq->listar($nro, $estado);
$estados= array(0=>"ANULADO",1=>"ACTIVO");
?>

<table id="tablaProducto" class="table table-bordered table-hover table-striped table-sm">
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
            <td><button class="btn btn-sm btn-info" onclick="Editar(<?= $fila['idproducto'];?>)"><span class="fa fa-edit"></span> </button>
            
            <?php if($fila['estado']==1){?>
                <button class="btn btn-sm btn-warning" onclick="CambiarEstadoModal(<?= $fila['idproducto'];?>,0,'<?= $fila['nombre'] ?>')"><span class="fa fa-ban"></span> </button>
            <?php }else{ ?>
                <button class="btn btn-sm btn-success" onclick="CambiarEstadoModal(<?= $fila['idproducto'];?>,1,'<?= $fila['nombre'] ?>')"><span class="fa fa-check"></span> </button>
            <?php }?>
            
            <button class="btn btn-sm btn-danger" onclick="CambiarEstadoModal(<?= $fila['idproducto'];?>,2,'<?= $fila['nombre'] ?>')"><span class="fa fa-trash"></span> </button></td>
        </tr>
        <?php }?>
    </tbody>
</table>
<script>
$("#tablaProducto").DataTable({
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
    }).buttons().container().appendTo('#tablaProducto_wrapper .col-md-6:eq(0)');

modoEdicion = false;
idsubcategoria = 0;
function Editar(idproducto){
    $.ajax({
        method: 'POST',
        url:    'controlador/contProducto.php',
        data:{
            'proceso':'CONSULTAR',
            'idproducto': idproducto
        },
        dataType: 'json'
    }).done(function(retorno){
        modoEdicion = true;
        $("#idproducto").val(retorno.idproducto);
        $("#nombre").val(retorno.nombre);
        $("#codigobarra").val(retorno.codigobarra);
        $("#pventa").val(retorno.pventa);
        $("#pcompra").val(retorno.pcompra);
        $("#stock").val(retorno.stock);
        $("#stockseguridad").val(retorno.stockseguridad);
  

        $("#proceso").val("ACTUALIZAR");
        $("#modal-formulario").modal('show');
        $("#modal-formulario").on('hidden.bs.modal', function(e){
            $("#formulario").trigger("reset");
            $("#idcategoria").val("").trigger("change");
            $("#idsubcategoria").val("").trigger("change");
        })
    });
}

function CambiarEstado(idproducto, estado){
    $.ajax({
        method: 'POST',
        url:    'controlador/contProducto.php',
        data:{
            'proceso':'CAMBIAR_ESTADO',
            'idproducto': idproducto,
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

function CambiarEstadoModal(idproducto,estado,nombre){
    $("#idcambiarestado").val(idproducto);
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