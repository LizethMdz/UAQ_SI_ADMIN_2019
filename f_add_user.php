<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $groups = find_all('user_groups');
?>

<?php
  if(isset($_POST['add_user'])){

   $req_fields = array('u-name','u-username','u-password','u-level' );
   validate_fields($req_fields);

   if(empty($errors)){
           $name   = remove_junk($db->escape($_POST['u-name']));
       $username   = remove_junk($db->escape($_POST['u-username']));
       $password   = remove_junk($db->escape($_POST['u-password']));
       $user_level = (int)$db->escape($_POST['u-level']);
       $password = sha1($password);
        $query = "INSERT INTO users (";
        $query .="name,username,password,user_level,status";
        $query .=") VALUES (";
        $query .=" '{$name}', '{$username}', '{$password}', '{$user_level}','1'";
        $query .=")";
        if($db->query($query)){
          //sucess
          $session->msg('s'," Cuenta de usuario ha sido creada");
          redirect('f_add_user.php', false);
        } else {
          //failed
          $session->msg('d',' No se pudo crear la cuenta.');
          redirect('f_add_user.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('f_add_user.php',false);
   }
 }
?>

<?php include_once('layout/header.php');?>

 <!-- Content -->
 <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">

            <!-- Add user -->
            <div class="row">
                    <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Agregar Personal</strong>
                                </div>
                                <div class="card-body">
                                    <!-- Credit Card -->
                                    <div id="pay-invoice">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h5 class="text-center">Nuevo</h5>
                                            </div>
                                            <hr>
                                            <form action="#" method="post" novalidate="novalidate">
                                                
                                                <div class="form-group">
                                                    <label for="cc-name" class="control-label mb-1">Nombre</label>
                                                    <input id="cc-name" name="u-name" type="text" class="form-control" aria-required="true" value="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="cc-username" class="control-label mb-1">Nombre de Usuario</label>
                                                    <input id="cc-username" name="u-username" type="text" class="form-control" aria-required="true" value="">
                                                </div>
                                                <div class="form-group">
                                                <label for="cc-pass" class="control-label mb-1">Contraseña</label>
                                                    <input id="cc-pass" name="u-password" type="password" class="form-control" aria-required="true" value="">
                                                </div>
                                                <div class="form-group">
                                                        <label for="u-level">Rol</label>
                                                        <select class="form-control" name="u-level">
                                                        <?php foreach ($groups as $group ):?>
                                                            <option value="<?php echo $group['group_level'];?>"><?php echo ucwords($group['group_name']);?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                </div>


                                                <div>
                                                    <button id="payment-button" type="submit" class="btn btn-info btn-block" name="add_user">
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
            <!--  /Add user -->
               

            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
<div class="clearfix"></div>

<?php include_once('layout/footer.php');?>