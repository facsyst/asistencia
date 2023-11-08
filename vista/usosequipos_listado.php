<?php
require_once("../modelo/UsoEquipo.php");

$objUsEq = new UsoEquipo();

$listado = $objUsEq->listar($_POST['desde'],$_POST['hasta'],$_POST['nombre'], $_POST['estado']);
$estados= array(0=>"ANULADO",1=>"ACTIVO");
?>

<table id="tablaUsoEqui" class="table table-bordered table-hover table-striped table-sm">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Documento</th>
            <th>Fecha</th>
            <th>H.Entrada</th>
            <th>H.Salida</th>
            <th>Nro</th>
            <th>Marca</th>
            <th>Serie</th>
            <th>Estado</th>
            <th>Opciones</th> 
        </tr>
    </thead>
    <tbody>
        <?php while($fila = $listado->fetch(PDO::FETCH_NAMED)){ ?>
        <tr class="<?= $fila['estado']==1?'':'text-red'?>">
            <td><?= $fila['idusoequipo'] ?></td>
            <td><?= $fila['nombre'] ?></td>
            <td><?= $fila['nrodocumento'] ?></td>
            <td><?= $fila['fecha'] ?></td>
            <td><?= $fila['horaentrada'] ?></td>
            <td><?= $fila['horasalida'] ?></td>
            <td><?= $fila['nro'] ?></td>
            <td><?= $fila['marca'] ?></td>
            <td><?= $fila['serie'] ?></td>
            <td><?= $estados[$fila['estado']] ?></td>
            <td><button class="btn btn-sm btn-info" onclick="Editar(<?= $fila['idusoequipo'];?>)"><span class="fa fa-edit"></span> </button>
            
            <?php if($fila['estado']==1){?>
                <button class="btn btn-sm btn-warning" onclick="CambiarEstadoModal(<?= $fila['idusoequipo'];?>,0,'<?= $fila['nombre'] ?>')"><span class="fa fa-ban"></span> </button>
            <?php }else{ ?>
                <button class="btn btn-sm btn-success" onclick="CambiarEstadoModal(<?= $fila['idusoequipo'];?>,1,'<?= $fila['nombre'] ?>')"><span class="fa fa-check"></span> </button>
            <?php }?>
            
            <button class="btn btn-sm btn-danger" onclick="CambiarEstadoModal(<?= $fila['idusoequipo'];?>,2,'<?= $fila['nombre'] ?>')"><span class="fa fa-trash"></span> </button></td>
        </tr>
        <?php }?>
    </tbody>
</table>
<div class="col-md-4 mt-2">
    <button type="button" class="btn btn-primary" onclick='imprimir()'><span class="fa fa-print"></span> Imprimir PDF</button> 
</div>
<script>
$("#tablaUsoEqui").DataTable({
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
    }).buttons().container().appendTo('#tablaUsoEqui_wrapper .col-md-6:eq(0)');

   
$(document).ready(function() {
    $('#tablaUsoEqui').DataTable();
});


function imprimir() {
  // Obtén los datos de la tabla
  var table = $('#tablaUsoEqui').DataTable();
  var datos = table.rows().data().toArray();

  // Realiza la solicitud AJAX para generar el PDF
  $.ajax({
    method: "POST",
    url: "vista/pdfUsoEquipo.php",
    data: { datos: datos },
    dataType: 'json',
    success: function(response) {

        console.log(response);
        console.log(datos);
      // La respuesta del servidor contiene la URL del PDF generado
      alert('PDF generado correctamente. Abriendo el PDF en una nueva ventana.');

      // Abre el PDF en una nueva ventana
      window.open(response.url, '_blank');
    },
    error: function(error) {
      alert('Error al generar el PDF.');
      console.error(error);
    }
  });
}














function Editar(idusoequipo){
    $.ajax({
        method: 'POST',
        url:    'controlador/contUsoEquipo.php',
        data:{
            'proceso':'CONSULTAR',
            'idusoequipo': idusoequipo
        },
        dataType: 'json'
    }).done(function(retorno){
        $("#idusoequipo").val(retorno.idusoequipo);
        $("#idasistencia").val(retorno.idasistencia).trigger("change");
        $("#idequipo").val(retorno.idequipo).trigger("change");
        $("#estado").val(retorno.estado);

        $("#proceso").val("ACTUALIZAR");
        $("#modal-formulario").modal('show');
        $("#modal-formulario").on('hidden.bs.modal', function(e){
            $("#formulario").trigger("reset");
        })
    });
}

function CambiarEstado(idusoequipo, estado){
    $.ajax({
        method: 'POST',
        url:    'controlador/contUsoEquipo.php',
        data:{
            'proceso':'CAMBIAR_ESTADO',
            'idusoequipo': idusoequipo,
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

function CambiarEstadoModal(idusoequipo,estado,nombre){
    $("#idcambiarestado").val(idusoequipo);
    $("#cambioestado").val(estado);
    texto_accion="ELIMINAR";
    if(estado==1){ texto_accion="ACTIVAR"; }
    if(estado==0){ texto_accion="ANULAR"}
    texto_accion="<b>"+texto_accion+"</b>";
    texto_accion = texto_accion + " El Personal " + nombre;
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