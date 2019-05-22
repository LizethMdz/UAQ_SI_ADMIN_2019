<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
 $year = date('Y');
 $sales = monthlySales($year);
?>
<?php include_once('layout/header.php');?>

<?php include_once('layout/admin_menu.php');?>

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
                                        <li><a href="#">Ventas Mensuales</a></li>
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
            <!--  Ventas Mensuales  -->
            <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="box-title">Listado de Ventas Mensuales </h4>
                            </div>
                            <div class="row">
                                    <div class="col-lg-12">
                                            <div class="card">
                                            <div class="table-stats order-table ov-h">
                                                    <table class="table text-center">
                                                        <thead>
                                                            <tr>
                                                                <th class="serial">#</th>
                                                                <th>Nombre del Producto</th>
                                                                <th>Cantidad</th>
                                                                <th>Total</th>
                                                                <th>Fecha</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach ($sales as $sale):?>
                                                            <tr>
                                                                <td class="serial"><?php echo count_id();?></td>
                                                                <td>  <span class="name"><?php echo remove_junk($sale['name']); ?></span> </td>
                                                                <td> <span class="count"><?php echo (int)$sale['qty']; ?></span> </td>
                                                                <td><span class="product">$ <?php echo remove_junk($sale['total_saleing_price']); ?></span></td>
                                                                <td><span><?php echo date("d/m/Y", strtotime ($sale['date'])); ?></span></td>
                                                                <td class="text-center">
                                                                <a href="p_delete_sale.php?id=<?php echo (int)$sale['id'];?>"><span class="badge badge-eliminar">Eliminar</span></a>
                                                                </td>
                                                            </tr>
                                                            <?php endforeach;?>
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
            <!--  /Ventas Mensuales -->


            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>

<?php include_once('layout/footer.php');?>