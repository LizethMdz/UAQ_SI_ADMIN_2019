<?php 
$results = '';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
 page_require_level(2);

?>

<?php
  if(isset($_POST['submit'])){
    $req_dates = array('s-date','s-date-2');
    validate_fields($req_dates);

    if(empty($errors)):
      $start_date   = remove_junk($db->escape($_POST['s-date']));
      $end_date     = remove_junk($db->escape($_POST['s-date-2']));
      $results      = find_sale_by_dates($start_date,$end_date);
    else:
      $session->msg("d", $errors);
      redirect('f_sales_report.php', false);
    endif;

  } else {
    $session->msg("d", "Select dates");
    redirect('f_sales_report.php', false);
  }
?>

<?php include_once('layout/header.php');?>

<!-- Content -->
<div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">

             <!--  Sales List  -->
             <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="box-title">Ventas </h4>
                            </div>
                            <div class="row">
                                    <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <strong class="card-title"> REPORTE DE VENTAS</strong>
                                                    <br>
                                                    <small class="card-title"> 
                                                    <?php if(isset($start_date)){ echo $start_date;}?> a <?php if(isset($end_date)){echo $end_date;}?>
                                                    </small>
                                                </div>

                                                <?php if($results): ?>
                                                
                                                <div class="table-stats order-table ov-h">
                                                    <table class="table text-center">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha</th>
                                                                <th>Nombre del Producto</th>
                                                                <th>Precio Compra</th>
                                                                <th>Precio Venta</th>
                                                                <th>Cantidad</th>
                                                                <th>Total</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach($results as $result): ?>
                                                            <tr>
                                                                <td><span><?php echo remove_junk($result['date']);?></span></td>
                                                                <td>  <span class="name"><?php echo remove_junk($result['name']);?></span> </td>
                                                                <td> <span class="product"><?php echo remove_junk($result['buy_price']);?></span> </td>
                                                                <td><span class="product"><?php echo remove_junk($result['sale_price']);?></span></td>
                                                                <td><span><?php echo remove_junk($result['total_sales']);?></span></td>
                                                                <td><span><?php echo remove_junk($result['total_saleing_price']);?></span></td>

                                                            </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                        <tfoot>
                                                        <tr >
                                                        <td colspan="4"></td>
                                                        <td colspan="1"> Total </td>
                                                        <td> $
                                                        <?php echo number_format(@total_price($results)[0], 2); ?>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                        <td colspan="4"></td>
                                                        <td colspan="1">Utilidad</td>
                                                        <td> $<?php echo number_format(@total_price($results)[1], 2);?></td>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div> <!-- /.table-stats -->

                                                <?php
                                                    else:
                                                        $session->msg("d", "No se encontraron ventas. ");
                                                        redirect('sales_report.php', false);
                                                    endif;
                                                ?>
                                            </div>
                                        </div>
                                
                            </div> <!-- /.row -->
                            <div class="card-body"></div>
                        </div>
                    </div><!-- /# column -->
            </div>
            <!--  /Sales List -->
               

            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
<div class="clearfix"></div>

<?php include_once('layout/footer.php');?>