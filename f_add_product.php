<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $all_categories = find_all('categories');
  $all_photo = find_all('media');
?>

<?php
 if(isset($_POST['add_product'])){
   $req_fields = array('p-name','p-category','p-quantity','p-price-b', 'p-price-s' );
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['p-name']));
     $p_cat   = remove_junk($db->escape($_POST['p-category']));
     $p_qty   = remove_junk($db->escape($_POST['p-quantity']));
     $p_buy   = remove_junk($db->escape($_POST['p-price-b']));
     $p_sale  = remove_junk($db->escape($_POST['p-price-s']));
     if (is_null($_POST['p-img']) || $_POST['p-img'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['p-img']));
     }
     $date    = make_date();
     $query  = "INSERT INTO products (";
     $query .=" name,quantity,buy_price,sale_price,categorie_id,media_id,date";
     $query .=") VALUES (";
     $query .=" '{$p_name}', '{$p_qty}', '{$p_buy}', '{$p_sale}', '{$p_cat}', '{$media_id}', '{$date}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'";
     if($db->query($query)){
       $session->msg('s',"Producto agregado exitosamente. ");
       redirect('f_add_product.php', false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('f_products.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('f_add_product.php',false);
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
            <!-- Add product -->
            <div class="row">
                    <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Agregar Vegetales</strong>
                                </div>
                                <div class="card-body">
                                    <!-- Credit Card -->
                                    <div id="pay-invoice">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h5 class="text-center">Vegetales</h5>
                                            </div>
                                            <hr>
                                            <form action="f_add_product.php" method="post" novalidate="novalidate">
                                                
                                                <div class="form-group">
                                                    <label for="cc-name" class="control-label mb-1">Nombre</label>
                                                    <input id="cc-name" name="p-name" type="text" class="form-control" aria-required="true" value="">
                                                </div>
                                                <div class="form-group">
                                                        <label for="p-category">Categoria</label>
                                                        <select class="form-control" name="p-category">
                                                        <option value="">-- Seleccione --</option>
                                                        <?php  foreach ($all_categories as $cat): ?>
                                                        <option value="<?php echo (int)$cat['id'] ?>">
                                                            <?php echo $cat['name'] ?></option>
                                                        <?php endforeach; ?>
                                                        </select>
                                                </div>
                                                <div class="form-group">
                                                        <label for="p-img">Imagen</label>
                                                        <select class="form-control" name="p-img">
                                                        <option value="">-- Seleccione --</option>
                                                        <?php  foreach ($all_photo as $photo): ?>
                                                        <option value="<?php echo (int)$photo['id'] ?>">
                                                            <?php echo $photo['file_name'] ?></option>
                                                        <?php endforeach; ?>
                                                        </select>
                                                </div>

                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="cc-quantity" class="control-label mb-1">Cantidad</label>
                                                            <input id="cc-quantity" name="p-quantity" type="number" class="form-control" aria-required="true" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="cc-price-compra" class="control-label mb-1">Compra</label>
                                                            <input id="cc-price-compra" name="p-price-b" type="number" class="form-control" aria-required="true" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="cc-price-venta" class="control-label mb-1">Venta</label>
                                                            <input id="cc-price-venta" name="p-price-s" type="number" class="form-control" aria-required="true" value="">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div>
                                                    <button id="payment-button" type="submit" class="btn btn-info btn-block" name="add_product">
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

                        
                      
                        
            </div>
            <!--  /Add product -->
               

            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
<div class="clearfix"></div>

<?php include_once('layout/footer.php');?>