$(buscar_datos());

function buscar_datos(consulta){
    $.ajax({
        url:'p_search_product.php',
        type: 'POST',
        dataType: 'html',
        data: {consulta : consulta},
    })
    .done(function(respuesta){
        $("#datos").html(respuesta)
    })
    .fail(function(){
        console.log("error");
    })
}

$(document).on('keyup' , '#search_box', function () {
    var value = $(this).val();
    if (value != ""){
        buscar_datos(value);
    }else{
        buscar_datos();
    }
}) ;