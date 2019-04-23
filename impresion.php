<?php
setlocale(LC_MONETARY,"es_PE");
require "vendor/autoload.php";
setlocale(LC_MONETARY,"es_PE");
include 'class/ventas.php';
include 'class/database.php';
include 'class/pedidos.php';
$conexion=new database();
$codigo=$_GET['codigo'];
$ventasClass=new ventas($conexion);
$pedidosClass=new pedidos($conexion);

if($_GET['delivery']){
    $ventaGeneral=$pedidosClass->getPedidoAdmin($codigo);
}else{
    $ventaGeneral=$ventasClass->getVenta($codigo);

}
 $ventas=$ventasClass->getVentaAdmin($codigo);
$html="<p class='centrado'>Licoreria Sucre <br>{$ventaGeneral['fecha']} {$ventaGeneral['hora']}</p><br>".ucfirst($ventaGeneral['direccion'])."<br>".ucfirst($ventaGeneral['nombre'])." {$ventaGeneral['telefono']}";
foreach($ventas as $venta){
    $html.= "<p>{$venta['cantidad']} {$venta['producto']} S/. {$venta['precio']}      </p>";
}
$html.= "<br>
            <p>Total ". money_format('%(#10n',$ventaGeneral['total'])."</p>";
$html.= "<br><p>Metodo de pago {$ventaGeneral['metodoPago']}<p>";
  $htmlSalidas=utf8_encode($html);
  $mpdf = new mPDF('R','A4', 11,'Arial');
  $mpdf->SetTitle("Ticket");
  $mpdf->WriteHTML($htmlSalidas,2);
  if($_POST['d']){
    $mpdf->Output($name,'D');
  }else{
    $mpdf->Output();
  }

?>
