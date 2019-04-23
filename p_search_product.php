<?php 
   require_once('includes/load.php');

    $a_products = join_product_table();

  

    if (isset($_POST['consulta'])){
        $a_products = search_product_table($_POST['consulta']);
    }

  if( count($a_products) > 0){
    foreach ($a_products as $product):

        $salida = "<tr>";

        $salida .= "<td class='serial'>".count_id() ."</td>";
        $salida .= "<td class='avatar'>";
                if($product['media_id'] === '0'): 
                    $salida .=  
                    " <div class='round-img'>
                        <a href='#'><img class='rounded-circle' src='uploads/products/no_image.jpg'></a>
                     </div>";
                else:
                $salida .= 
                "<div class='round-img'>
                <a href='#'><img class='rounded-circle' src='uploads/products/".$product['image'] . "'></a>
                </div>";
                endif; 
                $salida .= "</td>";
                $salida .= "<td> <span class='product'>" . remove_junk($product['name'])  . "</span></td>";
                $salida .= "<td> <span class='count'>" .remove_junk($product['quantity']) ."</span> </td>";
                $salida .= "<td> <span class='product'>$ " . remove_junk($product['buy_price']) ." </span> </td>";
                $salida .= "<td><span class='product'>$ " .remove_junk($product['sale_price']) . " </span></td>";
                $salida .= "<td><span class='name'> " . remove_junk($product['categorie']) ."</span></td>";
                $salida .= "<td><span>" .read_date($product['date']) ."</span></td>";
                $salida .= "<td>
                                    <a href='f_add_product.php'><span class='badge badge-enviar'><i class='fas fa-plus'></i></span></a> 
                                    <a href='f_edit_product.php?id=" . (int)$product['id']  . "'><span class='badge badge-editar'><i class='fas fa-edit'></i></span></a> 
                                    <a href='p_delete_product.php?id=" . (int)$product['id'] . "'><span class='badge badge-eliminar'><i class='fas fa-trash'></i></span></a> 
                                </td> ";
                $salida .= "</tr>";

                echo $salida;
    endforeach;
}else{
    echo "<td colspan='9'>No hay ningún resultado</td>";
}
?>