<?php 
$out = " ";
$results = '';
require_once('includes/load.php');

$start_date = $_POST['s-date'];
$end_date = $_POST['s-date-2'];

echo $start_date;
echo "<br>";
echo $end_date;

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

/**REVIEW  Consultas*/



?>

<?php include_once('layout/header.php');?>
<div class="breadcrumbs">
                <div class="breadcrumbs-inner">
                    <div class="row m-0">
                        <div class="col-sm-4">
                            <div class="page-header float-left">
                                <div class="page-title">
                                    <h1>Dashboard</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="page-header float-right">
                                <div class="page-title">
                                    <ol class="breadcrumb text-right">
                                        <li><a href="#">Dashboard</a></li>
                                        <li><a href="#">Reporte de Ventas</a></li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php if($results): ?>
        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">

            <!--  Sales List  -->
            <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="box-title">Listado del reporte </h4>
                                <strong><?php if(isset($start_date)){ echo $start_date;}?> a <?php if(isset($end_date)){echo $end_date;}?> </strong>
                            </div>
                            <div class="row">
                                    <div class="col-lg-12">
                                            <div class="card">
                                                
                                                <div class="table-stats order-table ov-h">
                                                    <table class="table text-center">
                                                        <thead>
                                                            <tr>
                                                            <th>Fecha</th>
                                                            <th>Descripción</th>
                                                            <th>Precio de compra</th>
                                                            <th>Precio de venta</th>
                                                            <th>Cantidad total</th>
                                                            <th>TOTAL</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach($results as $result): ?>
                                                            <tr>
                                                                <td class=""><?php echo remove_junk($result['date']);?></td>
                                                                <td class="desc">
                                                                    <h6><?php echo remove_junk(ucfirst($result['name']));?></h6>
                                                                </td>
                                                                <td class="text-right"><?php echo remove_junk($result['buy_price']);?></td>
                                                                <td class="text-right"><?php echo remove_junk($result['sale_price']);?></td>
                                                                <td class="text-right"><?php echo remove_junk($result['total_sales']);?></td>
                                                                <td class="text-right"><?php echo remove_junk($result['total_saleing_price']);?></td>
                                                            </tr>
                                                            <?php endforeach; ?>
                                                       
                                                        </tbody>
                                                        <tfoot>
                                                                <tr class="text-right">
                                                                <td colspan="4"></td>
                                                                <td colspan="1"> Total </td>
                                                                <td> $
                                                                <?php echo number_format(@total_price($results)[0], 2);?>
                                                                </td>
                                                                </tr>
                                                                <tr class="text-right">
                                                                <td colspan="4"></td>
                                                                <td colspan="1">Utilidad</td>
                                                                <td> $<?php echo number_format(@total_price($results)[1], 2);?></td>
                                                                </tr>
                                                                </tfoot>
                                                    </table>
                                                </div> <!-- /.table-stats -->
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
  <?php
    else:
        $session->msg("d", "No se encontraron ventas. ");
        redirect('f_sales_report.php', false);
     endif;
  ?>

<?php include_once('layout/footer.php');?>
<?php if(isset($db)) { $db->db_disconnect(); } ?>







