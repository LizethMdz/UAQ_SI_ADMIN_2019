<?php
  require_once('includes/load.php');
   page_require_level(2);
?>

<?php
  $user_id = (int)$_GET['id'];
  if(empty($user_id)):
    redirect('f_home.php',false);
  else:
    $user_p = find_by_id('users',$user_id);
  endif;
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
                                    <strong class="card-title">Editar Foto de Perfil</strong>
                                </div>
                                <div class="card-body">
                                    <!-- Credit Card -->
                                    <div id="pay-invoice">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h5 class="text-center">Perfil</h5>
                                                <hr>
                                                <?php if( $user_p['id'] === $user['id']):?>
                                                <div class="user-img">
                                                    <div class="round-img">
                                                        <a href="f_profile.php"><img class="rounded-circle" src="uploads/img/<?php echo $user['image'];?>" alt=""></a>
                                                    </div>
                                                </div>  
                                                <?php endif;?>
                                            </div>
                                            
                                            
                                           
                                        </div>
                                    </div>
    
                                </div>
                            </div> <!-- .card -->
    
                        </div><!--/.col-->
        
            </div>
            <!--  /Profile -->


               

            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
<div class="clearfix"></div>

<?php include_once('layout/footer.php');?>