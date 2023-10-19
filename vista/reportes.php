<section class="content mt-2">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Ventas</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Desde</span>
                            </div>
                            <input type="date" class="form-control" id="txtFechaDesde" name="txtFechaDesde" value="<?= date('Y-01-01'); ?>"/>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Hasta</span>
                            </div>
                            <input type="date" class="form-control" id="txtFechaHasta" name="txtFechaHasta"/>
                        </div>
                    </div>                    
                    <div class="col-4">
                     <button type="button" class="btn btn-info" onclick="listarReporte();">Ver Reporte</button> 
                    </div>
                </div>
                <div id="divListado">

                </div>
            </div>
        </div>
    </div>
</section>
</div>
<script>
function listarReporte(){
  $.ajax({
    method: "POST",
    url: "vista/reportes_listado.php",
    data: {
        desde: $("#txtFechaDesde").val(),
        hasta: $("#txtFechaHasta").val()
      }
  }).done(function(resultado){
      $("#divListado").html(resultado);
  })
}

listarReporte();
</script>