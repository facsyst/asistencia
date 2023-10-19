<?php 
require_once("../modelo/Venta.php");
$objVen =  new Venta();

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

$ventas = $objVen->reporteVentasPorComprobante($desde, $hasta);

$meses = array(1=>"Ene",2=>"Feb",3=>"Mar", 4=>"Abr", 5=>"May", 
            6=>"Jun", 7=>"Jul", 8=>"Ago", 9=>"Set", 10=>"Oct",
            11=>"Nov", 12=>"Dic");

$data = array();

$ventas = $ventas->fetchAll(PDO::FETCH_NAMED);

$anio_ini = date('Y');
$mes_ini = date('m');
$anio_fin = date('Y');
$mes_fin = date('m');

if(count($ventas)>0){
  $anio_ini = $ventas[0]['anio'];
  $mes_ini = $ventas[0]['mes'];

  $anio_fin = $ventas[count($ventas)-1]['anio'];
  $mes_fin = $ventas[count($ventas)-1]['mes'];
}

if($_POST['desde']!=''){
    $fdesde = explode('-',$_POST['desde']);
    $anio_ini = $fdesde[0];
    $mes_ini = (int) $fdesde[1];
}
if($_POST['hasta']!=''){
    $fhasta = explode('-',$_POST['hasta']);
    $anio_fin = $fhasta[0];
    $mes_fin = (int) $fhasta[1];
}


while($anio_fin>$anio_ini || ($anio_fin==$anio_ini && $mes_fin>=$mes_ini)){
  $data[$meses[$mes_ini].'-'.$anio_ini]['01']=0;
  $data[$meses[$mes_ini].'-'.$anio_ini]['03']=0;  
  if($mes_ini==12){
    $mes_ini=1;
    $anio_ini++;
  }else{
    $mes_ini++;
  }  
}

//while($fila = $ventas->fetch(PDO::FETCH_NAMED)){
foreach($ventas as $k=>$fila){
    $data[$meses[$fila['mes']].'-'.$fila['anio']][$fila['idtipocomprobante']] = $fila['total'];    
}

$labels = array();
$data01 = array();
$data02 = array();

foreach($data as $k => $v){
    $labels[] = $k;

    $data01[] = isset($v["01"])?$v["01"]:0;
    $data02[] = isset($v["03"])?$v["03"]:0;
}

?>

<!-- BAR CHART -->
<div class="card card-success">
    <div class="card-header">
    <h3 class="card-title">Bar Chart</h3>

    <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove">
        <i class="fas fa-times"></i>
        </button>
    </div>
    </div>
    <div class="card-body">
    <div class="chart">
        <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
    </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<script>
    var areaChartData = {
      labels  : ['<?= implode("','",$labels);?>'],
      datasets: [
        {
          label               : 'Facturas',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?= implode(",",$data01)?>]
        },
        {
          label               : 'Boletas',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?= implode(",",$data02)?>]
        },
      ]
    }

    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

</script>