<?php
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
    page_require_level(1);
?>

<?php
 $c_categorie     = count_by_id('categories');
 $c_product       = count_by_id('products');
 $c_sale          = count_by_id('sales');
 $c_user          = count_by_id('users');
 $products_sold   = find_higest_saleing_product('10');
 $recent_products = find_recent_product_added('3');
 $recent_sales    = find_recent_sale_added('5')
?>

<?php include_once('layout/header.php');?>
<?php include_once('layout/admin_menu.php');?>

 <!-- Content -->
 <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                    <?php echo display_msg($msg); ?>
                    </div>
                </div>

                    <!-- Widgets  -->
                    <div class="row">
                        <div class="col-sm-12 col-lg-3">
                            <div class="card text-white bg-flat-color-1">
                                <div class="card-body">
                                    <div class="card-left pt-1 float-left">
                                        <h3 class="mb-0 fw-r">

                                            <span class="count">
                                            <?php  echo $c_product['total']; ?>
                                            </span>
                                        </h3>
                                        <p class="text-light mt-1 m-0">Productos</p>
                                    </div><!-- /.card-left -->

                                    <div class="card-right float-right text-right">
                                        <i class="icon fade-5 icon-lg fas fa-user-friends"></i>
                                    </div><!-- /.card-right -->

                                </div>

                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                                <div class="card text-white bg-flat-color-4">
                                    <div class="card-body">
                                        <div class="card-left pt-1 float-left">
                                            <h3 class="mb-0 fw-r">
                                                  <span class="count"><?php  echo $c_user['total']; ?></span>
                                            </h3>
                                            <p class="text-light mt-1 m-0"> Clientes Potenciales</p>
                                        </div><!-- /.card-left -->

                                        <div class="card-right float-right text-right">
                                            <i class="icon fade-5 icon-lg fas fa-street-view"></i>
                                        </div><!-- /.card-right -->

                                    </div>

                                </div>
                            </div>
                            <!--/.col-->

                            <div class="col-sm-6 col-lg-3">
                                <div class="card text-white bg-flat-color-3">
                                    <div class="card-body">
                                        <div class="card-left pt-1 float-left">
                                            <h3 class="mb-0 fw-r">
                                                <span class="count"><?php  echo $c_categorie['total']; ?></span>
                                            </h3>
                                            <p class="text-light mt-1 m-0">Categorias</p>
                                        </div><!-- /.card-left -->

                                        <div class="card-right float-right text-right">
                                            <i class="icon fade-5 icon-lg fas fa-cubes"></i>
                                        </div><!-- /.card-right -->

                                    </div>

                                </div>
                            </div>
                            <!--/.col-->

                            <div class="col-sm-6 col-lg-3">
                                <div class="card text-white bg-flat-color-2">
                                    <div class="card-body">
                                        <div class="card-left pt-1 float-left">
                                            <h3 class="mb-0 fw-r">
                                                <span class="currency float-left mr-1">$</span>
                                                <span class="count"><?php  echo $c_sale['total']; ?></span>
                                            </h3>
                                            <p class="text-light mt-1 m-0">Ventas</p>
                                        </div><!-- /.card-left -->

                                        <div class="card-right float-right text-right">
                                                <i class="icon fade-5 icon-lg fas fa-dollar-sign"></i>
                                        </div><!-- /.card-right -->

                                    </div>

                                </div>
                            </div>
                            <!--/.col-->
                </div>
                <!--/.Home-->

                <!-- GRAFICA -->
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['Comida', 'Frecuencia'],
            <?php


                foreach ($products_sold as  $product_sold):

                    echo "['".remove_junk(first_character($product_sold['name']))."',". (int)$product_sold['totalSold']."], ";

                endforeach;

            ?>


            ]);

            var options = {
            title: 'Productos Vendidos',
             is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
            }
            </script>

            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['Comida', '$ Total '],
            <?php
            foreach ($recent_sales as  $recent_sale):

                    echo "['".remove_junk(first_character($recent_sale['name']))."',".ucfirst($recent_sale['price'])."], ";

            endforeach;

            ?>


            ]);

            var options = {
            title: 'Últimos vendidos',
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('curve_chart2'));

            chart.draw(data, options);
            }
            </script>

            <!-- END GRAFICA -->

                    <div class="row">
                    <div class="col-md-5">
                            <div class="card">
                              <div class="card-header">
                                  <strong class="card-title">Productos más vendidos</strong>
                              </div>

                            <div id="curve_chart" style="width:100%; height: 300px"></div>

                          </div>  <!-- /.table -card -->
                      </div> <!-- /.table -col-->

                      <div class="col-md-7">
                        <div class="card">
                              <div class="card-header">
                                <strong class="card-title">Últimas Ventas</strong>
                              </div>

                              <div id="curve_chart2" style="width: 100%; height: 300px"></div>

                          </div>  <!-- /.table -card -->
                      </div> <!-- /.table -col-->
              </div>
                <!-- Tables about products and categories -->
                <div class="row">
                    <div class="col-md-6">
                    <div class="card">
                                                <div class="card-header">
                                                    <strong class="card-title">Productos más vendidos</strong>
                                                </div>
                                                <div class="table-stats order-table ov-h">
                                                    <table class="table text-center">
                                                        <thead>
                                                            <tr>
                                                                <th>Título</th>
                                                                <th>Total Vendido</th>
                                                                <th>Cantidad total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach ($products_sold as  $product_sold): ?>
                                                            <tr>
                                                                <td><?php echo remove_junk(first_character($product_sold['name'])); ?></td>
                                                                <td><span class="name"><?php echo (int)$product_sold['totalSold']; ?></span> </td>
                                                                <td><span class="name"><?php echo (int)$product_sold['totalQty']; ?></span></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div> <!-- /.table-stats -->
                                            </div>  <!-- /.table -card -->
                    </div> <!-- /.table -col-->
                    <div class="col-md-6">
                    <div class="card">
                                                <div class="card-header">
                                                    <strong class="card-title">Ultimas Ventas</strong>
                                                </div>
                                                <div class="table-stats order-table ov-h">
                                                    <table class="table text-center">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Producto</th>
                                                                <th>Fecha </th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach ($recent_sales as  $recent_sale): ?>
                                                            <tr>
                                                                <td><?php echo count_id();?></td>
                                                                <td><?php echo remove_junk(first_character($recent_sale['name'])); ?></td>
                                                                <td><span class="name"><?php echo remove_junk(ucfirst($recent_sale['date'])); ?></span> </td>
                                                                <td><span class="name">$<?php echo remove_junk(first_character($recent_sale['price'])); ?></span></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div> <!-- /.table-stats -->
                                            </div>  <!-- /.table -card -->
                    </div> <!-- /.table -col-->
                </div> <!-- /.table -row-->

                    <!-- Cards Products -->
                <div class="row">
                    <?php foreach ($recent_products as  $recent_product): ?>

                    <div class="col-md-4">
                        <a href="f_edit_product.php?id=<?php echo    (int)$recent_product['id'];?>">
                            <div class="card border border-primary">
                                <div class="card-header">
                                    <strong class="card-title"><?php echo remove_junk(first_character($recent_product['name']));?></strong>
                                </div>
                                <div class="card-body">
                                    <div class="mx-auto d-block">
                                        <?php if($recent_product['media_id'] === '0'): ?>
                                            <div class="round-img">
                                                <img class="rounded-circle mx-auto d-block" src="uploads/products/no_image.jpg" alt="">
                                            </div>
                                            <?php else: ?>
                                            <div class="round-img">
                                                <img class="rounded-circle mx-auto d-block" src="uploads/products/<?php echo $recent_product['image'];?>">
                                            </div>
                                        <?php endif;?>

                                        <div class="location text-sm-center">Precio: $<?php echo (int)$recent_product['sale_price']; ?></div>
                                        <div class="location text-sm-center">Categoría: <?php echo remove_junk(first_character($recent_product['categorie'])); ?></div>
                                    </div>
                                    <hr>
                                    <div class="card-footer">
                                        <small class="card-title mb-3">#Productos recientemente añadidos</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php endforeach; ?>
                </div>
                <!-- end row -->

            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
<div class="clearfix"></div>

<?php include_once('layout/footer.php');?>
