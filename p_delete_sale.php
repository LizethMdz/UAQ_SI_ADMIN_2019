<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $d_sale = find_by_id('sales',(int)$_GET['id']);
  if(!$d_sale){
    $session->msg("d","ID vacío.");
    redirect('f_sales.php');
  }
?>
<?php
  $delete_id = delete_by_id('sales',(int)$d_sale['id']);
  if($delete_id){
      $session->msg("s","Venta eliminada.");
      redirect('f_sales.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('f_sales.php');
  }
?>
