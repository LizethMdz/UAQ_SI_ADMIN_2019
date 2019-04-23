<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  //Display all catgories.
  $categorie = find_by_id('categories',(int)$_GET['id']);
  if(!$categorie){
    $session->msg("d","Missing categorie id.");
    redirect('f_categories.php');
  }
?>

<?php
if(isset($_POST['edit_cat'])){
  $req_field = array('c-name');
  validate_fields($req_field);
  $cat_name = remove_junk($db->escape($_POST['c-name']));
  if(empty($errors)){
        $sql = "UPDATE categories SET name='{$cat_name}'";
       $sql .= " WHERE id='{$categorie['id']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Categoría actualizada con éxito.");
       redirect('f_categories.php',false);
     } else {
       $session->msg("d", "Lo siento, actualización falló.");
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
            <!--  Edit Categories  -->
            <div class="row">
                    <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Edición de Categorias</strong>
                                </div>
                                <div class="card-body">
                                    <!-- Credit Card -->
                                    <div id="pay-invoice">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h5 class="text-center">Editar</h5>
                                            </div>
                                            <hr>
                                            <form action="edit_categorie.php?id=<?php echo (int)$categorie['id'];?>" method="post" novalidate="novalidate">
                                                
                                                <div class="form-group">
                                                    <label for="cc-category" class="control-label mb-1">Nombre de la Categoría</label>
                                                    <input id="cc-category" name="c-name" type="text" class="form-control" aria-required="true" value="<?php echo remove_junk(ucfirst($categorie['name']));?>">
                                                </div>

                                                <div>
                                                    <button id="payment-button" type="submit" class="btn btn-info btn-block" name="edit_cat">
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
            <!--  /Edit Categories -->
               

            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
<div class="clearfix"></div>

<?php include_once('layout/footer.php');?>