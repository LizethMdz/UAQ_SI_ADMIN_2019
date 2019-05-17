<?php

  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
   
?>
<?php include_once('layout/header.php');?>

 <!-- Content -->
 <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                <?php echo display_msg($msg); ?>
                </div>
            </div>
            <!-- Ventas diarias -->
            <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="box-title">Listado de Ventas </h4>
                                <br><br>
                                <form class="clearfix" method="post" action="sales_report_process.php">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="desde" class="control-label mb-1">Desde</label>
                                            <input id="desde" name="s-date" type="date" class="form-control" aria-required="true" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hasta" class="control-label mb-1">Hasta</label>
                                            <input id="hasta" name="s-date-2" type="date" class="form-control" aria-required="true" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-primary">Generar Reporte</button>
                                </div>
                                </form>
                               

                            </div>
                             <!-- <div class="row">
                                    <div class="col-lg-12">
                                            <div class="card">

                                                <div class="table-stats order-table ov-h">
                                                    <table class="table text-center">
                                                        <thead>
                                                            <tr>
                                                                <th>No. Filas</th>
                                                                <th>Fecha</th>
                                                                <th>Nombre del Producto</th>
                                                                <th>Precio Compra</th>
                                                                <th>Precio Venta</th>
                                                                <th>Cantidad</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id = "sales"> -->
                                                        <!-- Data from product table with Ajax and Jquery -->
                                                        <!-- </tbody>
                                                        
                                                    </table>  -->
                                                <!-- </div>  /.table-stats -->
                                             <!-- </div>
                                        </div>  -->
                                
                            <!-- </div>  /.row -->
                            <div class="card-body"></div>
                        </div>
                    </div><!-- /# column -->
            </div><!-- end row table sales  -->

            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
<div class="clearfix"></div>

<?php include_once('layout/footer.php');?>