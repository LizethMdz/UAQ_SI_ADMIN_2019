<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
  $e_user = find_by_id('users',(int)$_GET['id']);
  $groups  = find_all('user_groups');
  if(!$e_user){
    $session->msg("d","Missing user id.");
    redirect('f_users.php');
  }
?>

<?php
//Update User basic info
  if(isset($_POST['edit_user'])) {
    $req_fields = array('u-name','u-username','u-level');
    validate_fields($req_fields);
    if(empty($errors)){
             $id = (int)$e_user['id'];
           $name = remove_junk($db->escape($_POST['u-name']));
       $username = remove_junk($db->escape($_POST['u-username']));
          $level = (int)$db->escape($_POST['u-level']);
       $status   = remove_junk($db->escape($_POST['u-status']));
            $sql = "UPDATE users SET name ='{$name}', username ='{$username}',user_level='{$level}',status='{$status}' WHERE id='{$db->escape($id)}'";
         $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Acount Updated ");
            redirect('f_edit_user.php?id='.(int)$e_user['id'], false);
          } else {
            $session->msg('d',' Lo siento no se actualizó los datos.');
            redirect('f_edit_user.php?id='.(int)$e_user['id'], false);
          }
    } else {
      $session->msg("d", $errors);
      redirect('f_edit_user.php?id='.(int)$e_user['id'],false);
    }
  }
?>

<?php
// Update user password
if(isset($_POST['edit_ct'])) {
  $req_fields = array('u-password');
  validate_fields($req_fields);
  if(empty($errors)){
           $id = (int)$e_user['id'];
     $password = remove_junk($db->escape($_POST['u-password']));
     $h_pass   = sha1($password);
          $sql = "UPDATE users SET password='{$h_pass}' WHERE id='{$db->escape($id)}'";
       $result = $db->query($sql);
        if($result && $db->affected_rows() === 1){
          $session->msg('s',"Se ha actualizado la contraseña del usuario. ");
          redirect('f_edit_user.php?id='.(int)$e_user['id'], false);
        } else {
          $session->msg('d','No se pudo actualizar la contraseña de usuario..');
          redirect('f_edit_user.php?id='.(int)$e_user['id'], false);
        }
  } else {
    $session->msg("d", $errors);
    redirect('f_edit_user.php?id='.(int)$e_user['id'],false);
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
            <!-- Edit user -->
            <div class="row">
                    <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Editar Personal</strong>
                                </div>
                                <div class="card-body">
                                    <!-- Credit Card -->
                                    <div id="pay-invoice">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h5 class="text-center">Editar</h5>
                                            </div>
                                            <hr>
                                            <form action="f_edit_user.php?id=<?php echo (int)$e_user['id'];?>" method="post" novalidate="novalidate">
                                                
                                                <div class="form-group">
                                                    <label for="cc-name" class="control-label mb-1">Nombre</label>
                                                    <input id="cc-name" name="u-name" type="text" class="form-control" aria-required="true" value="<?php echo remove_junk(ucwords($e_user['name'])); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="cc-username" class="control-label mb-1">Nombre de Usuario</label>
                                                    <input id="cc-username" name="u-username" type="text" class="form-control" aria-required="true" value="<?php echo remove_junk(ucwords($e_user['username'])); ?>">
                                                </div>
                                                <div class="form-group">
                                                        <label for="u-status">Estado</label>
                                                        <select class="form-control" name="u-status">
                                                        <option <?php if($e_user['status'] === '1') echo 'selected="selected"';?>value="1">Activo</option>
                                                        <option <?php if($e_user['status'] === '0') echo 'selected="selected"';?> value="0">Inactivo</option>
                                                        </select>
                                                </div>
                                                <div class="form-group">
                                                        <label for="u-level">Rol</label>
                                                        <select class="form-control" name="u-level">
                                                        <?php foreach ($groups as $group ):?>
                                                        <option <?php if($group['group_level'] === $e_user['user_level']) echo 'selected="selected"';?> value="<?php echo $group['group_level'];?>"><?php echo ucwords($group['group_name']);?></option>
                                                        <?php endforeach;?>
                                                        </select>
                                                </div>


                                                <div>
                                                    <button id="payment-button" type="submit" class="btn btn-info btn-block" name="edit_user">
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

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Cambiar Contraseña</strong>
                                </div>
                                <div class="card-body">
                                    <!-- Credit Card -->
                                    <div id="pay-invoice">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h5 class="text-center">Modificar</h5>
                                            </div>
                                            <hr>
                                            <form action="#" method="post" novalidate="novalidate">
                                                
                                                <div class="form-group">
                                                    <label for="password" class="control-label mb-1">Contraseña</label>
                                                    <input id="password" name="u-password" type="text" class="form-control" aria-required="true" value="">
                                                </div>

                                                <div>
                                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="edit_ct">
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
            <!--  /Edit user -->
               

            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
<div class="clearfix"></div>

<?php include_once('layout/footer.php');?>