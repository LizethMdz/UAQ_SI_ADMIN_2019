<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $u_sale = find_by_id('sales',(int)$_GET['id']);
  $u_status = (int)$u_sale['status'];
  if(!$u_sale){
    $session->msg("d","ID vacío.");
    redirect('f_sales.php');
  }

  if($u_status == 0){
        $u_status = 1;
        redirect('f_sales.php');
        $update_status = update_sale_by_id((int)$u_sale['id'], $u_status);
        if($update_status){
            update_product_qty($u_sale['qty'], (int)$u_sale['product_id']);

            $session->msg("s","Venta atendida.");
            redirect('f_sales.php');
        } else {
            $session->msg("d","Veta no actualizada");
            redirect('f_sales.php');
        }
  }else{
    $session->msg("d","Veta no actualizada, porque ya ha sido modificada");
    redirect('f_sales.php');
  }

?>
<?php
 
?>