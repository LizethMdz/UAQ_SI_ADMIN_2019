<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
$product = find_by_id('products',(int)$_GET['id']);
$all_categories = find_all('categories');
$all_photo = find_all('media');
if(!$product){
  $session->msg("d","Missing product id.");
  redirect('f_products.php');
}
?>

<?php
 if(isset($_POST['edit_product'])){
    $req_fields = array('p-name','p-category','p-quantity','p-price-b', 'p-price-s' );
    validate_fields($req_fields);

   if(empty($errors)){
       $p_name  = remove_junk($db->escape($_POST['p-name']));
       $p_cat   = (int)$_POST['p-category'];
       $p_qty   = remove_junk($db->escape($_POST['p-quantity']));
       $p_buy   = remove_junk($db->escape($_POST['p-price-b']));
       $p_sale  = remove_junk($db->escape($_POST['p-price-s']));
       if (is_null($_POST['p-img']) || $_POST['p-img'] === "") {
         $media_id = '0';
       } else {
         $media_id = remove_junk($db->escape($_POST['p-img']));
       }
       $query   = "UPDATE products SET";
       $query  .=" name ='{$p_name}', quantity ='{$p_qty}',";
       $query  .=" buy_price ='{$p_buy}', sale_price ='{$p_sale}', categorie_id ='{$p_cat}',media_id='{$media_id}'";
       $query  .=" WHERE id ='{$product['id']}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Producto ha sido actualizado. ");
                 redirect('f_products.php', false);
               } else {
                 $session->msg('d',' Lo siento, la actualización falló.');
                 redirect('f_edit_product.php?id='.$product['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('f_edit_product.php?id='.$product['id'], false);
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
            <!-- Edit product -->
            <div class="row">
                    <div class="col-lg-8">
                    <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Editar Vegetales</strong>
                                </div>
                                <div class="card-body">
                                    <!-- Credit Card -->
                                    <div id="pay-invoice">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h5 class="text-center">Vegetales</h5>
                                            </div>
                                            <hr>
                                            <form action="f_edit_product.php?id=<?php echo (int)$product['id'] ?>" method="post">
                                                
                                                <div class="form-group">
                                                    <label for="cc-name" class="control-label mb-1">Nombre</label>
                                                    <input id="cc-name" name="p-name" type="text" class="form-control" aria-required="true" value="<?php echo remove_junk($product['name']);?>">
                                                </div>
                                                <div class="form-group">
                                                        <label for="p-category">Categoria</label>
                                                        <select class="form-control" name="p-category">
                                                        <option value="">-- Selecciona --</option>
                                                        <?php  foreach ($all_categories as $cat): ?>
                                                            <option value="<?php echo (int)$cat['id']; ?>" <?php if($product['categorie_id'] === $cat['id']): echo "selected"; endif; ?> >
                                                            <?php echo remove_junk($cat['name']); ?></option>
                                                        <?php endforeach; ?>
                                                        </select>
                                                </div>
                                                <div class="form-group">
                                                        <label for="p-img">Imagen</label>
                                                        <select class="form-control" name="p-img">
                                                        <option value="">-- Selecciona --</option>
                                                        <?php  foreach ($all_photo as $photo): ?>
                                                            <option value="<?php echo (int)$photo['id'];?>" <?php if($product['media_id'] === $photo['id']): echo "selected"; endif; ?> >
                                                            <?php echo $photo['file_name'] ?></option>
                                                        <?php endforeach; ?>
                                                        </select>
                                                </div>

                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="cc-quantity" class="control-label mb-1">Cantidad</label>
                                                            <input id="cc-quantity" name="p-quantity" type="number" class="form-control" aria-required="true"  value="<?php echo remove_junk($product['quantity']); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="cc-price-compra" class="control-label mb-1">Compra</label>
                                                            <input id="cc-price-compra" name="p-price-b" type="number" class="form-control" aria-required="true" value="<?php echo remove_junk($product['buy_price']);?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="cc-price-venta" class="control-label mb-1">Venta</label>
                                                            <input id="cc-price-venta" name="p-price-s" type="number" class="form-control" aria-required="true"  value="<?php echo remove_junk($product['sale_price']);?>">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div>
                                                    <button id="payment-button" type="submit" class="btn btn-info btn-block" name="edit_product">
                                                        <i class="fa fa-save"></i>&nbsp;
                                                        <span id="payment-button-amount">Actualizar</span>
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
            <!--  /Edit product -->
               

            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
<div class="clearfix"></div>

<?php include_once('layout/footer.php');?>