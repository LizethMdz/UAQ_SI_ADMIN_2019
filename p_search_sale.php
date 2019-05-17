<?php 
$out = " ";
$results = '';
require_once('includes/load.php');

$start_date = $_POST['desde'];
$end_date = $_POST['hasta'];

$results      = find_sale_by_dates($start_date,$end_date);
if (isset($start_date) == false) {
    $start_date = $end_date;
    $results      = find_sale_by_dates($start_date,$end_date);
} 

if (isset($end_date) == false) {
    $end_date = $start_date;
    $results      = find_sale_by_dates($start_date,$end_date);
}

/**REVIEW  */

if(($results->num_rows) > 0){
    foreach($results as $result): 
        $salida = "<tr>";
        $salida .= " <td><span>" . print( $results->num_rows) ."</span></td>";
        $salida .= " <td><span>" . remove_junk($result['date']) ."</span></td>";
        $salida .= " <td>  <span class='name'>" . remove_junk($result['name']) ." </span> </td>" ;
        $salida .= "    <td> <span class='product'>" . remove_junk($result['buy_price'])."</span> </td>";
        $salida .= "    <td><span class='product'>" . remove_junk($result['sale_price'])."</span></td>";
        $salida .= "    <td><span>" . remove_junk($result['total_sales'])."</span></td>";
        $salida .= "    <td><span>" . remove_junk($result['total_saleing_price'])."</span></td>";
        $salida .= "</tr>";
       
    endforeach; 
    $salida .= "
    
        <tr>
            <td colspan='4'></td>
            <td colspan='1'> Total </td>
            <td class='text-primary'>  
            ".number_format(@total_price($results)[0], 2) ."
            </td>
        </tr>
        <tr>
            <td colspan='4'></td>
            <td colspan='1'>Utilidad</td>
            <td class='text-primary'>".number_format(@total_price($results)[1], 2)." </td>
        </tr>
        ";
    echo $salida;
}
else{
    echo "<td colspan='6'>No hay ningún resultado</td>";
}

?>