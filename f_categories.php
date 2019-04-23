<?php

  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $all_categories = find_all('categories');
?>

<?php
 if(isset($_POST['add_cat'])){
   $req_field = array('c-name');
   validate_fields($req_field);
   $cat_name = remove_junk($db->escape($_POST['c-name']));
   if(empty($errors)){
      $sql  = "INSERT INTO categories (name)";
      $sql .= " VALUES ('{$cat_name}')";
      if($db->query($sql)){
        $session->msg("s", "Categoría agregada exitosamente.");
        redirect('f_categories.php',false);
      } else {
        $session->msg("d", "Lo siento, registro falló");
        redirect('f_categories.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('f_categories.php',false);
   }
 }
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

            <!--  Add Categories  -->
            <div class="row">
                    <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Alta de Categorias</strong>
                                </div>
                                <div class="card-body">
                                    <!-- Credit Card -->
                                    <div id="pay-invoice">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h5 class="text-center">Crear Categorias</h5>
                                            </div>
                                            <hr>
                                            <form action="#" method="post" novalidate="novalidate">
                                                
                                                <div class="form-group">
                                                    <label for="cc-category" class="control-label mb-1">Nombre de la Categoría</label>
                                                    <input id="cc-category" name="c-name" type="text" class="form-control" aria-required="true" value="">
                                                </div>

                                                <div>
                                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="add_cat">
                                                        <i class="fa fa-save"></i>&nbsp;
                                                        <span id="payment-button-amount">Guardar</span>
                                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
    
                                </div>
                            </div> <!-- .card -->
    
                        </div><!--/.col-->

                        <!-- LISTA DE CATEGORIAS -->
                        <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="box-title">Listado de Categorias </h4>
                            </div>
                            <div class="row">
                                    <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <strong class="card-title">Custom Table</strong>
                                                </div>
                                                <div class="table-stats order-table ov-h">
                                                    <table class="table text-center">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Name</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach ($all_categories as $cat):?>
                                                            <tr>
                                                                
                                                                <td><?php echo count_id();?></td>
                                                                <td>  <span class="name"><?php echo remove_junk(ucfirst($cat['name'])); ?></span> </td>
                                                                <td>
                                                                <a href="f_edit_category.php?id=<?php echo (int)$cat['id'];?>"><span class="badge badge-editar">Editar</span></a>
                                                                <a href="f_delete_category.php?id=<?php echo (int)$cat['id'];?>"><span class="badge badge-eliminar">Eliminar</span></a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div> <!-- /.table-stats -->
                                            </div>
                                        </div>
                                
                            </div> <!-- /.row -->
                            <div class="card-body"></div>
                        </div>
                    </div><!-- /# column List Categories -->
                        
            </div>
            <!--  /Add Categories -->
               

            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
<div class="clearfix"></div>

<?php include_once('layout/footer.php');?>