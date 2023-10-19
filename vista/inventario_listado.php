<?php
require_once("../modelo/Producto.php");

$objPro = new Producto();

$listado = $objPro->listar($_POST['nombre'], $_POST['estado']);
$estados= array(0=>"ANULADO",1=>"ACTIVO");
?>
<style>
    .imagen_zoom:hover{
        width: 200px;
        height: 200px;
        display: block;
    }
</style>
<table id="tablaProducto" class="table table-bordered table-hover table-striped table-sm">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th class="bg-maroon">Stock</th>
            <th class="bg-yellow">Seguridad</th>
            <th>Estado</th>
            <th>Movimientos</th>
        </tr>
    </thead>
    <tbody>
        <?php while($fila = $listado->fetch(PDO::FETCH_NAMED)){ ?>
        <tr class="<?= $fila['estado']==1?'':'text-red'?>">
            <td><?= $fila['codigobarra'] ?></td>
            <td><?= $fila['nombre'] ?></td>
            <td class="bg-maroon"><?= $fila['stock'] ?></td>
            <td class="bg-yellow"><?= $fila['stockseguridad'] ?></td>
            <td data-sort="<?= $fila['stock']<$fila['stockseguridad']?0:1;?>"><?php
                if($fila['stock']<$fila['stockseguridad']){
                    echo "<li class='fa fa-thumbs-down text-red'></li>";
                }else{
                    echo "<li class='fa fa-thumbs-up text-green'></li>";
                }
            
            ?></td>
            <td><button class="btn btn-sm btn-info" onclick="VerMovimientos(<?= $fila['idproducto'];?>,'<?= $fila['nombre']  ?>')"><span class="fa fa-eyes"></span> Movimientos</button></td>
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


function VerMovimientos(idproducto, producto){
    $("#divNombreProducto").html(producto);
    boton="<button class='btn btn-primary btn-sm' onclick='VerMovimientos("+idproducto+",\""+producto+"\")'>Buscar</button>";
    $("#divBotonBuscar").html(boton);
    $.ajax({
        method: 'POST',
        url:    'controlador/contProducto.php',
        data:{
            'proceso':'VER_MOVIMIENTOS',
            'idproducto': idproducto,
            'fechadesde': $("#fechadesde").val(),
            'fechahasta': $("#fechahasta").val()
        }
    }).done(function(retorno){
        $("#divMovimientosProducto").html(retorno);
        $("#modal-movimiento-producto").modal('show');
        $("#modal-movimiento-producto").on('hidden.bs.modal', function(e){
            $("#divMovimientosProducto").html("");
            $("#fechadesde").val("");
            $("#fechahasta").val("");
            $("#divBotonBuscar").html("");
            $("#divNombreProducto").html("");
        })
    });
}
</script>