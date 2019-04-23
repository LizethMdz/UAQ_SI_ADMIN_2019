<?php

  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php $media_files = find_all('media');?>

<?php
  if(isset($_POST['save_img'])) {
  $photo = new Media();
  $photo->upload($_FILES['file_upload']);
    if($photo->process_media()){
        $session->msg('s','Imagen subida al servidor.');
        redirect('f_media.php');
    } else{
      $session->msg('d',join($photo->errors));
      redirect('f_media.php');
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

            <!-- Media -->
            <div class="row">
                    <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Agregar - Listar</strong>
                                </div>
                                <div class="card-body">
                                    <!-- Credit Card -->
                                    <div id="pay-invoice">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h5 class="text-center">Imágenes</h5>
                                            </div>
                                            <hr>
                                            <form action="f_media.php" method="post" enctype="multipart/form-data">
                                                
                                                <div class="row form-group">
                                                    <div class="col col-md-1 col-sm-2"><label for="file-input" class=" form-control-label">Archivo</label></div>
                                                    <div class="col-md-7 col-sm-5"><input type="file" id="file-input" name="file_upload" class="form-control-file"></div>
                                                    <div class="col-md-3  col-sm-5">
                                                    <button id="payment-button" type="submit" class="btn btn-info btn-block" name="save_img">
                                                        <i class="fa fa-save"></i>&nbsp;
                                                        <span id="payment-button-amount">Guardar</span>
                                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                    </button>
                                                    </div>
                                                </div>

                                                
                                            </form>
                                            <hr>

                                        </div>
                                    </div>
    
                                </div>
                            </div> <!-- .card -->
    
                        </div><!-- /.col-->

                        <div class="panel panel-default"></div>
                        
                      
                        
            </div>
            <!--  /Media -->

            <!-- IMAGES LIST -->
            <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="box-title">Listado de Recursos </h4>
                            </div>
                            <div class="row">
                                    <div class="col-lg-12">
                                            <div class="card">
                                                
                                                <div class="table-stats order-table ov-h">
                                                    <table class="table text-center">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th class="avatar">Imagen</th>
                                                                <th>Nombre</th>
                                                                <th>Tipo</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach ($media_files as $media_file): ?>
                                                            <tr>

                                                                <td><?php echo count_id();?></td>
                                                                <td class="avatar">
                                                                    <div class="round-img">
                                                                        <a href="#"><img class="rounded-circle" src="uploads/products/<?php echo $media_file['file_name'];?>" alt=""></a>
                                                                    </div>
                                                                </td>
                                                                <td><span class="name"><?php echo $media_file['file_name'];?></span> </td>
                                                                <td><span class="name"><?php echo $media_file['file_type'];?></span> </td>
                                                                
                                                                <td class="text-center" >
                                                                
                                                                <a href="p_delete_media.php?id=<?php echo (int) $media_file['id'];?>"><span class="badge badge-eliminar">Eliminar</span></a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach;?>
                                                        </tbody>
                                                    </table>
                                                </div> <!-- /.table-stats -->
                                            </div>
                                        </div>
                                
                            </div> <!-- /.row -->
                            <div class="card-body"></div>
                        </div>
                    </div><!-- /# column -->
            </div><!-- IMAGES LIST -->
            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
<div class="clearfix"></div>

<?php include_once('layout/footer.php');?>