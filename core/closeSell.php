<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
include '../class/database.php';
include '../class/ventas.php';
include '../class/pedidos.php';
$conexion = new database();


$usuario  = $_SESSION['usuario'];
$total =$_POST['total'];
$metodoPago=$_POST['metodoPago'];
if($_COOKIE['modoventa']=="delivery"){
    $nombre=$_POST['nombre'];
    $telefono=$_POST['telefono'];
    $direccion=$_POST['direccion'];
    $observaciones=$_POST['observaciones'];
    $pedidos  = new pedidos($conexion);
    $cliente=$pedidos->addCliente($nombre,$telefono,$direccion);
    $pedir = $pedidos->hacerPedido($observaciones,$metodoPago,$total,$usuario,$telefono);
    if($pedir){
      setcookie('codigo','',time()-1000,'/','inv.donjuerguero.com');
      echo "OK";

    }else{
      echo "ERROR";
    }
}else{
  $ventas   = new ventas($conexion);
  $vender = $ventas->vender($usuario,$total,$metodoPago);
  if($vender){
    setcookie('codigo','',time()-1000,'/','inv.donjuerguero.com');
    echo "OK";
  }else{
    echo "ERROR";
  }

}



?>
