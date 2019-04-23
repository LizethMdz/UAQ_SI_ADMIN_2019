<?php

  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
  $all_groups = find_all('user_groups');
?>

<?php include_once('layout/header.php');?>

<?php include_once('layout/admin_menu.php');?>

<div class="breadcrumbs">
                <div class="breadcrumbs-inner">
                    <div class="row m-0">
                        <div class="col-sm-4">
                            <div class="page-header float-left">
                                <div class="page-title">
                                    <h1>Dashboard</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="page-header float-right">
                                <div class="page-title">
                                    <ol class="breadcrumb text-right">
                                        <li><a href="#">Dashboard</a></li>
                                        <li><a href="#">Grupos</a></li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                <?php echo display_msg($msg); ?>
                </div>
            </div>

            <!--  Groups -List  -->
            <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="box-title">Listado de Grupos </h4>
                            </div>
                            <div class="row">
                                    <div class="col-lg-12">
                                            <div class="card">
                                                
                                                <div class="table-stats order-table ov-h">
                                                    <table class="table text-center">
                                                        <thead>
                                                            <tr>
                                                                <th class="serial">#</th>
                                                                <th>G. Nombre</th>
                                                                <th>G. Nivel</th>
                                                                <th>G. Estatus</th>
                                                                <th class="text-center" colspan="2">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach($all_groups as $a_group): ?>
                                                            <tr>
                                                                <td class="serial"><?php echo count_id();?></td>
                                                                <td><span class="name"><?php echo remove_junk(ucwords($a_group['group_name']))?></span> </td>
                                                                <td><span class="name"><?php echo remove_junk(ucwords($a_group['group_level']))?></span> </td>
                                                                <td>
                                                                <?php if($a_group['group_status'] === '1'): ?>
                                                                    <span class="badge badge-complete">Activo</span>
                                                                <?php else: ?>
                                                                    <span class="badge badge-pending">Inactivo</span>
                                                                <?php endif; ?>
                                                                </td>
                                                                <td class="text-center" colspan="2">
                                                                <a href="f_add_group.php"><span class="badge badge-enviar">Agregar</span></a>
                                                                <a href="f_edit_group.php?id=<?php echo (int)$a_group['id'];?>"><span class="badge badge-editar">Editar</span></a>
                                                                <a href="p_delete_group.php?id=<?php echo (int)$a_group['id'];?>"><span class="badge badge-eliminar">Eliminar</span></a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>                                                            
                                                        </tbody>
                                                    </table>
                                                </div> <!-- /.table-stats -->
                                            </div>
                                        </div>
                                
                            </div> <!-- /.row -->
                            <div class="card-body"></div>
                        </div>
                    </div><!-- /# column -->
            </div>
            <!--  /Groups -List -->


            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>

<?php include_once('layout/footer.php');?>