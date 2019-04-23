<?php
include '../../class/database.php';
include '../../class/cajachica.php';
$conexion    =  new database();
$spend =  new cajachica($conexion);
setlocale(LC_MONETARY,"es_PE");
if((isset($_GET['desde'])) && (isset($_GET['hasta']))){
  $gastos = $spend->getGastosAdmin($_GET['desde'],$_GET['hasta']);
}else{
  $gastos = $spend->getGastosAdmin();
}
s

?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="data-table-list">
        <div class="table-responsive">
            <table id="data-table-basic" class="table table-striped">
                <thead>
                    <tr>
                        <th>Descripcion</th>
                        <th>Monto</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                  <?php foreach ($gastos as $gasto):?>
                  <tr>
                    <td><?php echo ucfirst($gasto['descripcion'])?></td>
                    <td><?php echo money_format('%#10n',$gasto['total']) ?></td>
                    <th><?php echo $gasto['usuario']?></th>
                    <th><?php echo $gasto['fecha']?></th>
                    <td>f</td>
                  </tr>
                  <?php endforeach; ?>
                    </tbody>
                      <tfoot>
                      <tr>
                        <th>Descripcion</th>
                        <th>Monto</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <td></td>
                      </tr>
                  </tfoot>
              </table>
          </div>
      </div>
  </div>
