<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);

?>

<?php include_once('layout/header.php');?>

<?php include_once('layout/admin_menu.php');?>

<div class="breadcrumbs">
                <div class="breadcrumbs-inner">
                    <div class="row m-0">
                        <div class="col-sm-4">
                            <div class="page-header float-left">
                            <!-- Salida de la consulta -->
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
                                        <li><a href="#">Productos</a></li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                <?php echo display_msg($msg); ?>
                </div>
            </div>
            <!--  Products - Vegetables  -->
            <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="box-title">Listado de Ventas </h4>
                                <br><br>
                               
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
                               

                            </div>
                             <div class="row">
                                    <div class="col-lg-12">
                                            <div class="card">

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
                                                        <tbody id = "sales">
                                                        <!-- Data from product table with Ajax and Jquery -->
                                                        </tbody>
                                                        
                                                    </table> 
                                                 </div> <!-- /.table-stats -->
                                             </div>
                                        </div> 
                                
                             </div> <!-- /.row -->
                            <div class="card-body"></div>
                        </div>
                    </div><!-- /# column -->
            </div>
            <!--  /Products - Vegetables -->


            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>

<?php include_once('layout/footer.php');?>