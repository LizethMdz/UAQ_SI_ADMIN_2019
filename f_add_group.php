<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>

<?php
  if(isset($_POST['add'])){

   $req_fields = array('g-name','g-level');
   validate_fields($req_fields);

   if(find_by_groupName($_POST['g-name']) === false ){
     $session->msg('d','<b>Error!</b> El nombre de grupo ya existe en la base de datos');
     redirect('f_add_group.php', false);
   }elseif(find_by_groupLevel($_POST['g-level']) === false) {
     $session->msg('d','<b>Error!</b> El nivel de grupo realmente existe en la base de datos ');
     redirect('f_add_group.php', false);
   }
   if(empty($errors)){
           $name = remove_junk($db->escape($_POST['g-name']));
          $level = remove_junk($db->escape($_POST['g-level']));
         $status = remove_junk($db->escape($_POST['g-status']));

        $query  = "INSERT INTO user_groups (";
        $query .="group_name,group_level,group_status";
        $query .=") VALUES (";
        $query .=" '{$name}', '{$level}','{$status}'";
        $query .=")";
        if($db->query($query)){
          //sucess
          $session->msg('s',"Grupo ha sido creado! ");
          redirect('f_add_group.php', false);
        } else {
          //failed
          $session->msg('d','Lamentablemente no se pudo crear el grupo!');
          redirect('f_add_group.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('f_add_group.php',false);
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
            <!-- Add group -->
            <div class="row">
                    <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Agregar Grupo</strong>
                                </div>
                                <div class="card-body">
                                    <!-- Credit Card -->
                                    <div id="pay-invoice">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h5 class="text-center">Grupos</h5>
                                            </div>
                                            <hr>
                                            <form action="#" method="post" novalidate="novalidate">
                                                
                                                <div class="form-group">
                                                    <label for="cc-nombre" class="control-label mb-1">Nombre</label>
                                                    <input id="cc-nombre" type="text" class="form-control" aria-required="true" value="" name="g-name">
                                                </div>
                                                <div class="form-group">
                                                <label for="cc-nivel" class="control-label mb-1">Nivel del Grupo</label>
                                                    <input id="cc-nivel" type="number" class="form-control" aria-required="true" value="" name="g-level">
                                                </div>
                                                <div class="form-group">
                                                        <label for="g-status">Estado</label>
                                                        <select class="form-control" name="g-status">
                                                        <option value="1">Activo</option>
                                                        <option value="0">Inactivo</option>
                                                        </select>
                                                </div>
                                                <div>
                                                    <button id="payment-button" type="submit" class="btn btn-info btn-block" name="add">
                                                        <i class="fa fa-save"></i>&nbsp;
                                                        <span id="payment-button-amount">Agregar</span>
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
            <!--  /Add group -->
               

            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
<div class="clearfix"></div>

<?php include_once('layout/footer.php');?>