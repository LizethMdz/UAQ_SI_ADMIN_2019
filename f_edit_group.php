<?php
  $page_title = 'Editar Grupo';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
  $e_group = find_by_id('user_groups',(int)$_GET['id']);
  if(!$e_group){
    $session->msg("d","Id Grupo Faltante.");
    redirect('f_groups.php');
  }
?>

<?php
  if(isset($_POST['edit_group'])){

   $req_fields = array('g-name','g-level');
   validate_fields($req_fields);
   if(empty($errors)){
        $name = remove_junk($db->escape($_POST['g-name']));
        $level = remove_junk($db->escape($_POST['g-level']));
        $status = remove_junk($db->escape($_POST['g-status']));

        $query  = "UPDATE user_groups SET ";
        $query .= "group_name='{$name}',group_level='{$level}',group_status='{$status}'";
        $query .= "WHERE ID='{$db->escape($e_group['id'])}'";
        $result = $db->query($query);
         if($result && $db->affected_rows() === 1){
          //sucess
          $session->msg('s',"Grupo se ha actualizado! ");
          redirect('f_edit_group.php?id='.(int)$e_group['id'], false);
        } else {
          //failed
          $session->msg('d','Lamentablemente no se ha actualizado el grupo!');
          redirect('f_edit_group.php?id='.(int)$e_group['id'], false);
        }
   } else {
     $session->msg("d", $errors);
    redirect('f_edit_group.php?id='.(int)$e_group['id'], false);
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
            <!-- Edit group -->
            <div class="row">
                    <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Editar Grupo</strong>
                                </div>
                                <div class="card-body">
                                    <!-- Credit Card -->
                                    <div id="pay-invoice">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h5 class="text-center">Grupos</h5>
                                            </div>
                                            <hr>
                                            <form action="f_edit_group.php?id=<?php echo (int)$e_group['id'];?>" method="post" novalidate="novalidate">
                                                
                                                <div class="form-group">
                                                    <label for="cc-nombre" class="control-label mb-1">Nombre</label>
                                                    <input id="cc-nombre" type="text" class="form-control" aria-required="true" value="<?php echo remove_junk(ucwords($e_group['group_name'])); ?>" name="g-name">
                                                </div>
                                                <div class="form-group">
                                                <label for="cc-nivel" class="control-label mb-1">Nivel del Grupo</label>
                                                    <input id="cc-nivel" type="numeric" class="form-control" value=" <?php echo (int)$e_group['group_level']; ?>" name="g-level">
                                                </div>
                                                <div class="form-group">
                                                        <label for="g-status">Estado</label>
                                                        <select class="form-control" name="g-status">
                                                        <option <?php if($e_group['group_status'] === '1') echo 'selected="selected"';?> value="1"> Activo </option>
                                                        <option <?php if($e_group['group_status'] === '0') echo 'selected="selected"';?> value="0">Inactivo</option>
                                                        </select>
                                                </div>

                                                <div>
                                                    <button id="payment-button" type="submit" class="btn btn-info btn-block" name="edit_group">
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
            <!--  /Edit group -->
               

            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
<div class="clearfix"></div>

<?php include_once('layout/footer.php');?>