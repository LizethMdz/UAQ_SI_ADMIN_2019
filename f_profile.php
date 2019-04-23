<?php
  require_once('includes/load.php');
   page_require_level(2);
?>

<?php 
    //Validate password field with the current user
    $user = current_user(); 

?>

<?php
    //update user password
  if(isset($_POST['save'])){

    $req_fields = array('u-password','u-oldpass','id' );
    validate_fields($req_fields);

    if(empty($errors)){

             if(sha1($_POST['u-oldpass']) !== current_user()['password'] ){
               $session->msg('d', "Tu antigua contraseña no coincide");
               redirect('change_password.php',false);
             }

            $id = (int)$_POST['id'];
            $new = remove_junk($db->escape(sha1($_POST['u-password'])));
            $sql = "UPDATE users SET password ='{$new}' WHERE id='{$db->escape($id)}'";
            $result = $db->query($sql);
                if($result && $db->affected_rows() === 1):
                  $session->logout();
                  $session->msg('s',"Inicia sesión con tu nueva contraseña.");
                  redirect('index.php', false);
                else:
                  $session->msg('d',' Lo siento, actualización falló.');
                  redirect('f_profile.php', false);
                endif;
    } else {
      $session->msg("d", $errors);
      redirect('f_profile.php',false);
    }
  }
?>

<?php
    //update user image
    if(isset($_POST['submit'])) {
    $photo = new Media();
    $user_id = (int)$_POST['user_id'];
    $photo->upload($_FILES['file_upload']);
    if($photo->process_user($user_id)){
        $session->msg('s','La foto fue subida al servidor.');
            redirect('f_profile.php');
        } else{
        $session->msg('d',join($photo->errors));
         redirect('f_profile.php');
        }
    }
?>

<?php
 //update user other info
  if(isset($_POST['update'])){
    $req_fields = array('u-name','u-username' );
    validate_fields($req_fields);
    if(empty($errors)){
        $id = (int)$_SESSION['user_id'];
        $name = remove_junk($db->escape($_POST['u-name']));
        $username = remove_junk($db->escape($_POST['u-username']));
            $sql = "UPDATE users SET name ='{$name}', username ='{$username}' WHERE id='{$id}'";
        $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Cuenta actualizada. ");
            redirect('f_profile.php', false);
          } else {
            $session->msg('d',' Lo siento, actualización falló.');
            redirect('f_profile.php', false);
          }
    } else {
      $session->msg("d", $errors);
      redirect('f_profile.php',false);
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
            <!-- Profile -->
            <div class="row">
                    <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Editar Perfil</strong>
                                </div>
                                <div class="card-body">
                                    <!-- Credit Card -->
                                    <div id="pay-invoice">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h5 class="text-center">Perfil</h5>
                                            </div>
                                            <hr>
                                            <form method="post" action="f_profile.php?id=<?php echo (int)$user['id'];?>" >
                                                
                                                <div class="form-group">
                                                    <label for="cc-name" class="control-label mb-1">Nombre</label>
                                                    <input id="cc-name" name="u-name" type="text" class="form-control" aria-required="true" value="<?php echo remove_junk(ucwords($user['name'])); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="cc-username" class="control-label mb-1">Nombre de usuario</label>
                                                    <input id="cc-username" name="u-username" type="text" class="form-control" aria-required="true" value="<?php echo remove_junk(ucwords($user['username'])); ?>">
                                                </div>

                                                <div>
                                                    <button id="payment-button" type="submit" class="btn btn-info btn-block" name="update">
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

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Editar Foto de Perfil</strong>
                                </div>
                                <div class="card-body">
                                    <!-- Credit Card -->
                                    <div id="pay-invoice">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h5 class="text-center">Perfil</h5>
                                                <hr>
                                                <div class="user-img">
                                                    <div class="round-img">
                                                        <a href="#"><img class="rounded-circle" src="uploads/img/<?php echo $user['image'];?>" alt=""></a>
                                                    </div>
                                            </div>  
                                            </div>
                                            
                                            
                                            <form method="POST" action="f_profile.php"  enctype="multipart/form-data">
                                                <div class="row form-group">
                                                    <div class="col col-md-6 col-sm-2"><label for="file-input" class=" form-control-label">Archivo</label></div>
                                                    <div class="col-md-6 col-sm-5"><input type="file" id="file-input" multiple="multiple" name="file_upload" class="form-control-file"></div>
                                                </div>
                                               

                                                <div>
                                                <input type="hidden" name="user_id" value="<?php echo $user['id'];?>">
                                                    <button type="submit" class="btn btn-info btn-block" name="submit">
                                                        <i class="fa fa-save"></i>&nbsp;
                                                        <span id="payment-button-amount">Actualizar</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
    
                                </div>
                            </div> <!-- .card -->
    
                        </div><!--/.col-->
        
            </div>
            <!--  /Profile -->

            <!-- Password -->
            <div class="row">
                        
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Editar Contraseña</strong>
                                </div>
                                <div class="card-body">
                                    <!-- Credit Card -->
                                    <div id="pay-invoice">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h5 class="text-center">Contraseña</h5>
                                                <hr>
                                    
                                            </div>  

                                            <form action="f_profile.php" method="post">
                                                
                                                <div class="form-group">
                                                    <label for="cc-pass" class="control-label mb-1">Actual</label>
                                                    <input id="cc-pass" name="u-oldpass" type="password" class="form-control" aria-required="true" value="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="cc-newpass" class="control-label mb-1">Nueva</label>
                                                    <input id="cc-newpass" name="u-password" type="password" class="form-control" aria-required="true" value="">
                                                    <input type="hidden" name="id" value="<?php echo (int)$user['id'];?>">
                                                </div>

                                                <div>
                                                    <button id="payment-button" type="submit" class="btn btn-info btn-block" name="save">
                                                        <i class="fa fa-save"></i>&nbsp;
                                                        <span id="payment-button-amount">Cambiar</span>
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
            <!-- /Password -->
               

            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
<div class="clearfix"></div>

<?php include_once('layout/footer.php');?>